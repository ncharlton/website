<?php
/**
 * @author Nicolas Charlton
*/

namespace App\Service\Twitch;

use Unirest\Request;

/**
 * Class TwitchClipService
 * @package App\Service\Twitch
 * @see https://dev.twitch.tv/docs/api/reference/#get-clips
 */
class TwitchClipService
{
    /**
     * @var string $clipUrl
     */
    private $clipUrl = 'https://api.twitch.tv/helix/clips';

    /**
     * @var string $clientId
     */
    private $clientId;

    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }

    public function fetchClipById(string $id) : array
    {

        $headers = [
            'Client-ID' => $this->clientId,
            'Accept' => 'application/vnd.twitchtv.v5+json',
        ];

        return $result = Request::get($this->clipUrl, $headers, [
            'id' => $id
        ])->body->data;
    }

    public function getClipIdFromUrl($url) : string
    {
        $id = str_replace("https://clips.twitch.tv/", "", $url);
        return $id;
    }
}