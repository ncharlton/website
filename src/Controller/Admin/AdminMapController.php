<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Admin;

use App\Entity\Map;
use App\Form\Admin\AdminConfirmType;
use App\Form\Admin\AdminMapType;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminMapController extends AbstractController
{
    /**
     * @Route("/admin/maps", name="admin_map_list")
     */
    public function listAction(Request $request ,PaginatorInterface $paginator) {
        $query =  $this->getDoctrine()->getRepository(Map::class)
            ->findAll();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/map/list.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/admin/map/new", name="admin_map_new")
     */
    public function newAction(Request $request) {
        $form = $this->createForm(AdminMapType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Map $map */
            $map = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($map);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully created map'
            );

            $this->redirectToRoute('admin_map_view', ['slug' => $map->getSlug()]);
        }

        return $this->render('admin/map/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/map/{slug}", name="admin_map_view")
     * @ParamConverter("map", options={"mapping":{"slug":"slug"}})
     */
    public function viewAction(Map $map) {
        return $this->render('admin/map/view.html.twig', [
            'map' => $map
        ]);
    }

    /**
     * @Route("/admin/map/{slug}/edit", name="admin_map_edit")
     * @ParamConverter("map", class="App\Entity\Map", options={"mapping":{"slug":"slug"}})
     */
    public function editAction(Request $request, Map $map) {
        $form = $this->createForm(AdminMapType::class, $map);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Map $map */
            $map = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($map);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully created map'
            );

            $this->redirectToRoute('admin_map_view', ['slug' => $map->getSlug()]);
        }

        return $this->render('admin/map/edit.html.twig', [
            'form' => $form->createView(),
            'map' => $map,
        ]);
    }

    /**
     * @Route("/admin/map/{slug}/delete", name="admin_map_delete")
     * @ParamConverter("map", options={"mapping":{"slug":"slug"}})
     */
    public function deleteAction(Request $request, Map $map) {
        $form = $this->createForm(AdminConfirmType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($map);
            $em->flush();

            $this->addFlash(
                'success',
                'Great'
            );

            return $this->redirectToRoute('admin_map_list');
        }

        return $this->render('admin/map/delete.html.twig', [
            'form' => $form,
            'map' => $map,
        ]);
    }
}