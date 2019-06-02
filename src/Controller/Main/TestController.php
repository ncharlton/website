<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 22.11.2018
 * Time: 16:29
 */

namespace App\Controller\Main;

use App\Entity\Tag;
use App\Service\Twitch\TwitchStreamService;
use App\Service\Voobly\VooblyService;
use App\Service\Youtube\YoutubeVideoService;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test/tags")
     *
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function tagTest(SerializerInterface $serializer) {
        $tags = $this->getDoctrine()->getRepository('App:Tag')
            ->findAll();

        $tags = $serializer->serialize($tags, 'json');

        return new Response($tags, 200, array('application/json'));
    }

    /**
     * @Route("test/voobly")
     * @param VooblyService $voobly
     */
    public function vooblyTest(VooblyService $voobly) {
        $name = 'TheViper';

        $id = $voobly->fetchUserIdByUsername($name);
        var_dump($id);

        $rank = $voobly->fetchRankByUserId($id);
        var_dump($rank);

        return new Response();
    }

    /**
     * @Route("/test/stream/status")
     * @param TwitchStreamService $streamService
     */
    public function streamStatusTest(TwitchStreamService $streamService) {
        $result = $streamService->isStreamerLive();
        if($result ) {
            echo true;
        } else {
            echo "asdsa";
        }
        die();
    }

    /**
     * @Route("test/video")
     */
    public function videoTest(YoutubeVideoService $videoService) {
        $id = '5LrNTJHmTSE';

        $video = $videoService->fetchVideoById($id);
        //print_r($video);
//        echo $video->items[0]->id;
//        echo "<br>";
//        echo $video->items[0]->etag;
//        echo "<br>";
//        echo $video->items[0]->snippet->title;
//        echo "<br>";
//        echo $video->items[0]->snippet->description;
//        echo "<br>";
//        echo $video->items[0]->snippet->publishedAt;
//        echo "<br>";
//        echo $video->items[0]->contentDetails->duration;
//        echo "<br>";
//        echo $video->items[0]->contentDetails->definition;
//        echo "<br>";
        print_r($video->snippet->thumbnails);

//        echo "<br>";
//        echo $video->items[0]->status->embeddable;
//        echo "<br>";
//        echo $video->items[0]->statistics->viewCount;
//        echo "<br>";
//        echo $video->items[0]->statistics->likeCount;
//        echo "<br>";
//        echo $video->items[0]->statistics->dislikeCount;
//        echo "<br>";
//        echo $video->items[0]->statistics->commentCount;
//
//        echo "<hr>";
//        echo $video->items[0]->player->embedHtml;


        return new Response();
    }
}