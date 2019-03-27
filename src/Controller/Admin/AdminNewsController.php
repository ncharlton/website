<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Admin;

use App\Entity\News;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminNewsController
 * @package App\Controller\Admin
 */
class AdminNewsController extends AbstractController
{
    /**
     * @Route("/admin/news", name="admin_news_list")
     */
    public function listAction(Request $request, PaginatorInterface $paginator) {

        $query = $this->getDoctrine()->getRepository('App:News')
            ->fetchNewest(true);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/news/list.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/admin/news/new", name="admin_news_new")
     */
    public function newAction(Request $request) {
        $form = $this->createForm("App\Form\Admin\AdminNewsType");
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var News $news */
            $news = $form->getData();

            if($news->getPublished()) {
                $news->setPublishedAt(new \DateTime());
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully created news'
            );

            return $this->redirectToRoute('admin_news_view', ['slug' => $news->getSlug()]);
        } else {

        }

        return $this->render('admin/news/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/news/{slug}", name="admin_news_view")
     * @ParamConverter("news", options={"mapping": {"slug":"slug"}})
     */
    public function viewAction(News $news) {

        return $this->render('admin/news/view.html.twig', [
            'news' => $news
        ]);
    }

    /**
     * @Route("/admin/news/{slug}/delete", name="admin_news_delete")
     * @ParamConverter("news", options={"mapping": {"slug":"slug"}})
     */
    public function deleteAction(News $news, Request $request) {
        $form = $this->createForm("App\Form\Admin\AdminConfirmType");
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($news);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully deleted news'
            );

            return $this->redirectToRoute('admin_news_list');
        }

        return $this->render('admin/news/delete.html.twig', [
            'form' => $form->createView(),
            'news' => $news
        ]);
    }

    /**
     * @Route("/admin/news/{slug}/edit", name="admin_news_edit")
     * @ParamConverter("news", options={"mapping":{"slug":"slug"}})
     */
    public function editAction(News $news, Request $request) {
        $form = $this->createForm('App\Form\Admin\AdminNewsType', $news);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var News $news */
            $news = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Successfully edited %s', $news->getTitle())
            );
        }

        return $this->render('admin/news/edit.html.twig', [
            'form' => $form->createView(),
            'news' => $news
        ]);
    }
}