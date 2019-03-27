<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Main;

use App\Entity\Video;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VideoController
 * @package App\Controller\Main
 */
class VideoController extends AbstractController
{
    /**
     * @Route("/videos", name="main_video_list")
     */
    public function listAction(SerializerInterface $serializer) {
        $playlists = $this->getDoctrine()->getRepository('App:VideoPlaylist')
            ->fetchPublishedPlaylists();

        $playlists = $serializer->serialize($playlists, 'json');

        return $this->render('main/playlist/list.html.twig', [
            'playlists' => $playlists
        ]);
    }

    /**
     * @Route("/video/{slug}", name="main_video_view")
     * @ParamConverter("video", options={"mapping": {"slug":"slug"}})
     */
    public function viewAction(Video $video, SerializerInterface $serializer) {
        $videoJson = $serializer->serialize($video, 'json');

        return $this->render('main/video/view.html.twig', [
            'video' => $video,
            'video_json' => $videoJson
        ]);
    }
}