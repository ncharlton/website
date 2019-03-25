<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Admin;

use App\Entity\Page;
use App\Form\Admin\AdminConfirmType;
use App\Form\Admin\AdminPageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminPageController
 * @package App\Controller\Admin
 */
class AdminPageController extends AbstractController
{
    /**
     * @Route("/admin/pages", name="admin_page_list")
     *
     * @return Response
     */
    public function listAction() {
        $pages = $this->getDoctrine()->getRepository(Page::class)
            ->findAll();

        return $this->render('admin/page/list.html.twig', [
            'pages' => $pages
        ]);
    }

    /**
     * @Route("/admin/page/new", name="admin_page_new")
     *
     * @param Request $request
     * @return RedirectResponse | Response
     */
    public function newAction(Request $request) {
        $form = $this->createForm(AdminPageType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Page $page */
            $page = $form->getData();

            if($page->getPublished()) {
                $page->setPublishedAt(new \DateTime());
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully created page'
            );

            return $this->redirectToRoute('admin_page_view', ['slug' => $page->getSlug()]);
        }

        return $this->render('admin/page/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/page/{slug}", name="admin_page_view")
     * @ParamConverter("page", options={"mapping": {"slug":"slug"}})
     *
     * @param Page $page
     * @return Response
     */
    public function viewAction(Page $page) {
        return $this->render('admin/page/view.html.twig', [
            'page' =>$page
        ]);
    }

    /**
     * @Route("/admin/page/{slug}/edit", name="admin_page_edit")
     * @ParamConverter("page", options={"mapping": {"slug":"slug"}})
     *
     * @param Page $page
     * @param Request $request
     * @return Response
     */
    public function editAction(Page $page, Request $request) {
        $form = $this->createForm(AdminPageType::class, $page);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Page $editedPage */
            $editedPage = $form->getData();

            if($editedPage->getPublished() && !$page->getPublished()) {
                $editedPage->setPublishedAt(new \DateTime());
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($editedPage);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully edited page'
            );

            return $this->redirectToRoute('admin_page_view', ['slug' => $editedPage->getSlug()]);
        }

        return $this->render('admin/page/edit.html.twig', [
            'form' => $form->createView(),
            'page' => $page
        ]);
    }

    /**
     * @Route("/admin/page/{slug}/delete", name="admin_page_delete")
     * @ParamConverter("page", options={"mapping": {"slug":"slug"}})
     *
     * @param Page $page
     * @param Request $request
     *
     * @return Response
     */
    public function deleteAction(Page $page, Request $request) {

        $form = $this->createForm(AdminConfirmType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($page);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Succesfully deleted %s', $page->getTitle())
            );

            return $this->redirectToRoute('admin_page_list');
        }

        return $this->render('admin/page/delete.html.twig', [
            'form' => $form->createView(),
            'page' => $page,
        ]);
    }
}