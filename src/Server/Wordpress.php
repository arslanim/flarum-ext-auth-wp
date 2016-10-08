<?php
namespace Arslanim\Auth\Wordpress\Server;

use League\OAuth1\Client\Credentials\TokenCredentials;
use League\OAuth1\Client\Server\Server;
use League\OAuth1\Client\Server\User;
use League\OAuth1\Client\Signature\SignatureInterface;
use League\OAuth1\Client\Credentials\TemporaryCredentials;

class Wordpress extends Server {

	public $callbackUrl;

	public $wordpressSiteUrl;

	public function __construct($clientCredentials, SignatureInterface $signature = null, $callbackUrl, $wordpressSiteUrl) {
		
		parent::__construct($clientCredentials, $signature);

		$this->callbackUrl = $callbackUrl;
		
		if (!is_string($wordpressSiteUrl) || empty($wordpressSiteUrl)) {
			throw new \InvalidArgumentException('Wordpress site url must be a not empty string.');
		} else {
			$this->wordpressSiteUrl = $wordpressSiteUrl;
		}
	}

	public function urlTemporaryCredentials() {
		return $this->wordpressSiteUrl . '/oauth1/request';
	}

	public function urlAuthorization() {
		return $this->wordpressSiteUrl . '/oauth1/authorize';
	}

	public function urlTokenCredentials() {
		return $this->wordpressSiteUrl . '/oauth1/access';
	}

	public function urlUserDetails() {
		return $this->wordpressSiteUrl . '/wp-json/wp/v2/users/me?_envelope';
	}

	public function userDetails($data, TokenCredentials $tokenCredentials) {
		//create user
		$user = new User();

		//fill new user with data
		$user->uid = $data['body']['id'];
		$user->nickname = $data['body']['name'];
		$user->name = $data['body']['name'];
		$user->location = $data['body']['url'];
		$user->description = $data['body']['description'];

		//$user->imageUrl = $this->userAvatar($data);

		$user->email = null;
        if (isset($data['body']['email'])) {
            $user->email = $data['body']['email'];
        }

        return $user;
	}

	public function userUid($data, TokenCredentials $tokenCredentials) {
		return $data['body']['id'];
	}

	public function userEmail($data, TokenCredentials $tokenCredentials) {
		return;
	}

	public function userScreenName($data, TokenCredentials $tokenCredentials) {
		return $data['body']['name'];
	}

	/**
     * Get user avatar url from WP site
     *
     * @param array $data
     *
     * @return string
     */
	public function userAvatar($data) {
		$avatarUrl = '';
		if (is_array($data['body']['avatar_urls'])) {
			foreach ($data['body']['avatar_urls'] as $_avatarUrl) {
				$avatarUrl = $_avatarUrl;
			}
		}

		return $avatarUrl;
	}

	/**
     * Get the authorization URL by passing in the temporary credentials
     * identifier or an object instance. Overrided from Server class
     *
     * @param TemporaryCredentials|string $temporaryIdentifier
     *
     * @return string
     */
   	public function getAuthorizationUrl($temporaryIdentifier)
    {
    	// Somebody can pass through an instance of temporary
        // credentials and we'll extract the identifier from there.
        if ($temporaryIdentifier instanceof TemporaryCredentials) {
            $temporaryIdentifier = $temporaryIdentifier->getIdentifier();
        }

        $parameters = array('oauth_token' => $temporaryIdentifier, 'oauth_callback' => $this->callbackUrl);

        $url = $this->urlAuthorization();
        $queryString = http_build_query($parameters);

        return $this->buildUrl($url, $queryString);
    }

}