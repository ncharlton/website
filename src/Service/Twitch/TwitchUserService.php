<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Service\Twitch;

use Unirest\Request;

/**
 * Class TwitchUserService
 * @package App\Service\Twitch
 */
class TwitchUserService
{
    /**
     * Fetches twitch user information via Bearer / Access Token
     *
     * @param string $token
     * @return array
     */
    public function fetchUserByBearerToken($token) {
        $url = 'https://api.twitch.tv/helix/users';
        $headers = array(
            'Authorization' => 'Bearer '. $token,
            'Accept: application/vnd.twitchtv.v5+json'
        );

        $result = Request::get($url, $headers)->body->data[0];

        return array(
            'twitchId' => $result->id,
            'twitchUsername' => $result->display_name,
            'twitchEmail' => $result->email,
            'twitchProfileUrl' => $result->profile_image_url,
            'twitchOfflineUrl' => $result->offline_image_url,
        );
    }
}