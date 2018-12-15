<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Admin;

use App\Entity\Clip;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminClipController
 * @package App\Controller\Admin
 */
class AdminClipController extends AbstractController
{
    /**
     * @Route("/admin/clips", name="admin_clip_list")
     */
    public function listAction() {
        $clips = $this->getDoctrine()->getRepository('App:Clip')
            ->findAll();

        return $this->render("admin/clip/list.html.twig", [
            'clips' => $clips
        ]);
    }

    /**
     * @Route("/admin/clip/{slug}/edit", name="admin_clip_edit")
     * @ParamConverter("clip", options={"mapping": {"slug": "slug"}})
     */
    public function editAction(Clip $clip, Request $request) {
        $form = $this->createForm('App\Form\Admin\AdminClipType', $clip);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Clip $clip */
            $clip = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($clip);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Successfully edited: %s', $clip->getTitle())
            );
        }

        return $this->render('admin/clip/edit.html.twig', [
            'clip' => $clip,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/clip/{slug}/delete", name="admin_clip_delete")
     * @ParamConverter("clip", options={"mapping": {"slug": "slug"}})
     */
    public function deleteAction(Clip $clip, Request $request) {
        $form = $this->createForm('App\Form\Admin\AdminConfirmType');
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($clip);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Succesfully deleted %s', $clip->getTitle())
            );

            return $this->redirectToRoute('admin_clip_list');
        }

        return $this->render('admin/clip/delete.html.twig', [
            'clip' => $clip,
            'form' => $form->createView()
        ]);
    }
}