<?php

namespace Arslanim\Auth\Wordpress; 

use Flarum\Http\Controller\ControllerInterface;
use Flarum\Forum\AuthenticationResponseFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Flarum\Settings\SettingsRepositoryInterface;
use Arma\Auth\Wordpress\Server\Wordpress;

class WordpressAuthController implements ControllerInterface {

	protected $authResponse;

	protected $settings;

	public function __construct(AuthenticationResponseFactory $authResponse, SettingsRepositoryInterface $settings) {
		$this->authResponse = $authResponse;
        $this->settings = $settings;
	}

	public function handle(Request $request, array $routeParams = []) {
	}

}