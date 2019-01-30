<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Service\Voobly;

use Unirest\Request;

/**
 * Class VooblyService
 * @package App\Service\Voobly
 */
class VooblyService
{
    private $key;

    private $api = 'http://www.voobly.com/api';

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function fetchUserIdByUsername($username) {
        $headers = [];

        $url = $this->api . '/finduser/' . $username . '&key=' . $this->key;
        $result = Request::get($url, $headers)->body;
        $result = str_replace('uid,name', '', $result);
        $result = explode(",", $result);

        return (int) $result[0];
    }

    public function fetchUserByUsername($username) {
        $headers = [];

        $this->fetchUserIdByUsername();

        $url = $this->api . '/user';
    }

    public function fetchRankByUserId($id) {
        $headers = [];

        $url = $this->api . '/ladder/10?key=' . $this->key . '&uid=' . $id;
        die($url);
        $result = Request::get($url, $headers)->body;

        return $result;
    }
}