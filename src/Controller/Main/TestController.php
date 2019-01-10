<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 22.11.2018
 * Time: 16:29
 */

namespace App\Controller\Main;

use App\Service\Youtube\VideoService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @Route("test/video")
     */
    public function videoTest(VideoService $videoService) {
        $id = '5LrNTJHmTSE';

        $video = $videoService->fetchVideoById($id);
        print_r($video);

        echo $video->items[0]->player->embedHtml;

        return new Response();
    }
}