<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Service\Twitch;

use Unirest\Request;

/**
 * Class TwitchStreamService
 * @package App\Service\Twitch
 */
class TwitchStreamService
{
    private $clientId;

    public function __construct(string $clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * Checks if streamer (membtv) has active stream
     *
     * @return mixed
     */
    public function isStreamerLive() {
        $headers = [
            'Client-ID' => $this->clientId
        ];

        $url = "https://api.twitch.tv/helix/streams?user_login=membtv";

        $result = Request::get($url, $headers);

        return $result->body->data;
    }
}