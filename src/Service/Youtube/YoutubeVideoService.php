<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Service\Youtube;

use App\Entity\VideoThumbnail;
use App\Entity\YoutubeVideo;
use Doctrine\ORM\EntityManagerInterface;
use Unirest\Request;

/**
 * Class VideoService
 *
 * @package App\Service\Youtube
 * @see https://developers.google.com/youtube/v3/docs/videos/list#usage
 */
class YoutubeVideoService
{
    /**
     * @var \Google_Client $client
     */
    private $client;

    /**
     * @var string $apikey
     */
    private $apikey;

    /**
     * @var EntityManagerInterface $em
     */
    private $em;

    /**
     * @var string $api
     */
    private $api = 'https://www.googleapis.com/youtube/v3/videos';

    public function __construct(EntityManagerInterface $em, string $apikey)
    {
        $this->em = $em;
        $this->apikey = $apikey;
    }

    /**
     * Fetches youtube video data by youtube video id
     *
     * @param string $id
     * @return mixed
     */
    public function fetchVideoById(string $id) {
        $url = $this->api . '?id=' . $id . '&part=snippet,contentDetails,statistics,status,player&key=' . $this->apikey;

        $result = Request::get($url)->body->items[0];

        return $result;
    }

    /**
     * Converts youtube video data to youtube video entity
     *
     * @param $obj
     * @return YoutubeVideo
     */
    public function convert($obj) {
        $video = new YoutubeVideo();
        $video->setYoutubeId($obj->id);
        $video->setEtag($obj->etag);
        $video->setTitle($obj->snippet->title);
        $video->setDescription($obj->snippet->description);
        $video->setChannelId($obj->snippet->channelId);
        $video->setChannelTitle($obj->snippet->channelTitle);

        $dateObject = new \DateTime($obj->snippet->publishedAt);
        $video->setPublishedAt($dateObject);

        $video->setDuration($obj->contentDetails->duration);
        $video->setDefinition($obj->contentDetails->definition);
        $video->setEmbeddable(true);
        $video->setViewCount($obj->statistics->viewCount);
        $video->setLikeCount($obj->statistics->likeCount);
        $video->setDislikeCount($obj->statistics->dislikeCount);
        $video->setCommentCount($obj->statistics->commentCount);
        $video->setEmbedHtml($obj->player->embedHtml);
        return $video;
    }

    /**
     * Saves thumbnails related to a youtube video
     *
     * @param YoutubeVideo $video
     * @param $obj
     */
    public function saveThumbnails(YoutubeVideo $video, $obj) {
        $i = 1;

        foreach($obj as $thumb) {
            $thumbnail = new VideoThumbnail();
            $thumbnail->setUrl($thumb->url);
            $thumbnail->setWidth($thumb->width);
            $thumbnail->setHeight($thumb->height);
            $thumbnail->setOrderNumber($i);

            $thumbnail->setVideo($video);

            $this->em->persist($thumbnail);

            $i++;
        }

        try {
            $this->em->flush();

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
}