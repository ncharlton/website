<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Admin;

use App\Entity\Video;
use App\Entity\YoutubeVideo;
use App\Form\Admin\AdminConfirmType;
use App\Service\Youtube\YoutubeVideoService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminVideoController
 * @package App\Controller\Admin
 *
 * @IsGranted({"ROLE_ADMIN", "ROLE_MOD"})
 */
class AdminVideoController extends AbstractController
{
    /**
     * @Route("/admin/videos", name="admin_video_list")
     */
    public function listAction() {
        $videos = $this->getDoctrine()->getRepository('App:Video')
            ->fetchNewest();

        return $this->render('admin/video/list.html.twig', [
            'videos' => $videos
        ]);
    }

    /**
     * @Route("/admin/video/new", name="admin_video_new")
     */
    public function newAction(Request $request, YoutubeVideoService $videoService) {
        $form = $this->createForm('App\Form\Admin\AdminVideoType');
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())  {
            /** @var Video $video */
            $video = $form->getData();

            // fetch youtube video data
            $youtubeData = $videoService->fetchVideoById($form['youtube']->getData());

            /** @var YoutubeVideo $youtubeVideo */
            $youtubeVideo = $videoService->convert($youtubeData);

            $video->setVideo($youtubeVideo);

            // flush
            $em = $this->getDoctrine()->getManager();
            $em->persist($video);
            $em->persist($youtubeVideo);
            $em->flush();

            // save thumbnails
            $videoService->saveThumbnails($youtubeVideo, $youtubeData->snippet->thumbnails);

            $this->addFlash(
                'success',
                'Successfully added video'
            );
        }

        return $this->render('admin/video/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/video/{slug}", name="admin_video_view")
     * @ParamConverter("video", options={"mapping": {"slug":"slug"}})
     */
    public function viewAction(Video $video) {
        return $this->render('admin/video/view.html.twig', [
            'video' => $video
        ]);
    }

    /**
     * @Route("/admin/video/{slug}/delete", name="admin_video_delete")
     * @ParamConverter("video", options={"mapping": {"slug":"slug"}})
     */
    public function deleteAction(Video $video, Request $request) {
        $form = $this->createForm(AdminConfirmType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($video);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Succesfully deleted %s', $video->getTitle())
            );

            return $this->redirectToRoute('admin_video_list');
        }

        return $this->render('admin/video/delete.html.twig', [
            'form' => $form->createView(),
            'video' => $video
        ]);
    }
}