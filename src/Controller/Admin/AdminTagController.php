<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Form\Admin\AdminTagType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminTagController
 * @package App\Controller\Admin
 */
class AdminTagController extends AbstractController
{
    /**
     * @Route("/admin/tags", name="admin_tag_list")
     */
    public function listAction() {
        $tags = $this->getDoctrine()->getRepository('App:Tag')
            ->findAll();

        return $this->render('admin/tag/list.html.twig', [
            'tags' => $tags
        ]);
    }

    /**
     * @Route("/admin/tag/new", name="admin_tag_new")
     */
    public function newAction(Request $request) {
        $form = $this->createForm(AdminTagType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Tag $tag */
            $tag = $form->getData();
            $tag->setTag(trim($tag->getTag()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully created tag'
            );
        }

        return $this->render('admin/tag/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}