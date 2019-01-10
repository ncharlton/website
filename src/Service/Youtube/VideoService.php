<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Service\Youtube;

use Unirest\Request;

/**
 * Class VideoService
 * @package App\Service\Youtube
 * @see https://developers.google.com/youtube/v3/docs/videos/list#usage
 */
class VideoService
{
    /**
     * @var \Google_Client $client
     */
    private $client;

    /**
     * @var string $apikey
     */
    private $apikey = 'AIzaSyCdii-VCfIqst6B1qvtIHXswXX_NaSz1QQ';

    /**
     * @var string $api
     */
    private $api = 'https://www.googleapis.com/youtube/v3/videos';

//    public function __construct(string $apikey)
//    {
//        $this->apikey = $apikey;
//    }

    public function getClient() {
        $this->client = new \Google_Client();
        $this->client->setApplicationName('Membsite');
        $this->client->setScopes(['https://www.googleapis.com/auth/youtube.force-ssl']);

    }

    public function fetchVideoById($id) {
        $url = $this->api . '?id=' . $id . '&part=snippet,contentDetails,statistics,status,player&key=' . $this->apikey;

        $result = Request::get($url)->body;

        return $result;
    }
}