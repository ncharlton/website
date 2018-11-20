<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Service\Twitch;

use Unirest\Request as Unirest;

class TwitchAuthenticationService
{
    /**
     * @var string $privateKey
     *
     * twitch private api key
     */
    private $privateKey;

    /**
     * @var string $publicKey
     *
     * twitch public api pey
     */
    private $publicKey;

    /**
     * @var string $authUrl
     *
     * twitch bearer auth url
     */
    private $authUrl;

    /**
     * @var string $redirectUrl
     *
     * url to which twitch will redirect after login
     */
    private $redirectUrl;

    /**
     * @var integer $channelId
     *
     * twitch channel id
     */
    private $channelId;

    /**
     * TwitchAuthenticationService constructor.
     * @param string $privateKey
     * @param string $publicKey
     * @param string $redirectUrl
     * @param string $authUrl
     * @param integer $channelId
     */
    public function __construct($privateKey, $publicKey, $redirectUrl, $authUrl, $channelId)
    {
        $this->privateKey = $privateKey;
        $this->publicKey = $publicKey;
        $this->redirectUrl = $redirectUrl;
        $this->authUrl = $authUrl;
        $this->channelId = $channelId;
    }

    /**
     * Returns twitch login url
     *
     * @return string
     */
    public function authorizeUrl() {
        $url = $this->authUrl .
            'oauth2/authorize?client_id=' . $this->publicKey .
            '&redirect_uri=' . $this->redirectUrl .
            '&response_type=code' .
            '&scope=user:read:email';

        return $url;
    }

    /**
     * @param string $code
     * @return array
     */
    public function getTokens($code) {
        $url = $this->authUrl .
            'oauth2/token?client_id=' . $this->publicKey .
            '&client_secret=' . $this->privateKey .
            '&code=' . $code .
            '&grant_type=authorization_code' .
            '&redirect_uri=' . $this->redirectUrl;

        $result = Unirest::post($url);

        return array(
            'accessToken' => $result->body->access_token,
            'refreshToken' => $result->body->refresh_token
        );
    }


}