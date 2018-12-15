<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Main;

use App\Entity\Clip;
use App\Service\Twitch\TwitchClipService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ClipController
 * @package App\Controller\Main
 */
class ClipController extends AbstractController
{
    /**
     * @Route("/clips", name="main_clip_list")
     */
    public function listAction() {
        $clips = $this->getDoctrine()->getRepository('App:Clip')
            ->findAll();

        return $this->render('main/clip/list.html.twig', [
            'clips' => $clips
        ]);
    }

    /**
     * @Route("/clip/new", name="main_clip_new")
     */
    public function newAction(Request $request, TwitchClipService $clipService) {
        $form = $this->createForm('App\Form\Main\ClipNewType');
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // get clip id from url
            $id = $clipService->getClipIdFromUrl($form->get('url')->getData());
            // get clip info from twitch api
            $result = $clipService->fetchClipById($id)[0];
            echo "<pre>".var_dump($result)."</pre>";
            if(!empty($result)) {
                /**
                 * @var Clip $clip
                 * @see https://dev.twitch.tv/docs/api/reference/#get-clips
                 */
                $clip = new Clip();
                $clip->setTwitchId($result->id);
                $clip->setUrl($result->url);
                $clip->setEmbedUrl($result->embed_url);
                $clip->setCreatorId($result->creator_id);
                $clip->setCreatorName($result->creator_name);

                if(strlen($form->get('title')->getData()) >= 10) {
                    $clip->setTitle($form->get('title')->getData());
                } else {
                    $clip->setTitle($result->title);
                }

                // convert time to DateTime
                $date = new \DateTime();
                $date->setTimestamp(strtotime($result->created_at));
                $clip->setCreatedAt($date);
                $clip->setThumbnailUrl($result->thumbnail_url);

                $em = $this->getDoctrine()->getManager();
                $em->persist($clip);
                $em->flush();

                return $this->redirectToRoute('main_clip_view', ['slug' => $clip->getSlug()]);
            } else {
                $error = new FormError("This twitch clip doesn't exist. Please check the url you've entered");
                $form->get('url')->addError($error);
            }
        }

        return $this->render('main/clip/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/clip/{slug}", name="main_clip_view")
     * @ParamConverter("clip", class="App\Entity\Clip")
     */
    public function viewAction(Clip $clip) {
        return $this->render('main/clip/view.html.twig', [
            'clip' => $clip
        ]);
    }
}