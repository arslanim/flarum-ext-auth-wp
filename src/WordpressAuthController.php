<?php

namespace Arslanim\Auth\Wordpress; 

use Flarum\Http\Controller\ControllerInterface;
use Flarum\Forum\AuthenticationResponseFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Flarum\Settings\SettingsRepositoryInterface;
use Arslanim\Auth\Wordpress\Server\Wordpress;

class WordpressAuthController implements ControllerInterface {

	protected $authResponse;

	protected $settings;

	public function __construct(AuthenticationResponseFactory $authResponse, SettingsRepositoryInterface $settings) {
		$this->authResponse = $authResponse;
        $this->settings = $settings;
	}

	public function handle(Request $request, array $routeParams = []) {

		$redirectUri = (string) $request->getAttribute('originalUri', $request->getUri())->withQuery('');

		//server class (wordpress site)
		$server = new Wordpress([
			'identifier' => $this->settings->get('arslanim/auth/wp.app_id'),
			'secret' => $this->settings->get('arslanim/auth/wp.app_secret'),
			'callbac_uri' => $redirectUri
		], null, $redirectUri, $this->settings->get('arslanim/auth/wp.wp_site_url'));

		$session = $request->getAttribute('session');
		$queryParams = $request->getQueryParams();
		$oAuthToken = array_get($queryParams, 'oauth_token');
		$oAuthVerifier = array_get($queryParams, 'oauth_verifier');
		if (!$oAuthToken || !$oAuthVerifier) {
			$temporaryCredentials = $server->getTemporaryCredentials();

			$session->set('temporary_credentials', serialize($temporaryCredentials));
			$session->save();

			$server->authorize($temporaryCredentials);
			exit;
		}

		$temporaryCredentials = unserialize($session->get('temporary_credentials'));

		$tokenCredentials = $server->getTokenCredentials($temporaryCredentials, $oAuthToken, $oAuthVerifier);

		$user = $server->getUserDetails($tokenCredentials);

		$identification = ['wordpress_id' => $user->uid];
		$suggestions = [
            'username' => $user->nickname,
            'avatarUrl' => str_replace('_normal', '', $user->imageUrl)
        ];

        return $this->authResponse->make($request, $identification, $suggestions);

	}

}
