<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Admin;

use App\Entity\MapPack;
use App\Form\Admin\AdminConfirmType;
use App\Form\Admin\AdminMapPackType;
use App\Repository\MapPackRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminMapPackController
 * @package App\Controller\Admin
 */
class AdminMapPackController extends AbstractController
{
    /**
     * @Route("/admin/mappacks", name="admin_mappack_list")
     */
    public function listAction(Request $request, PaginatorInterface $paginator)
    {
        $query = $this->getDoctrine()->getRepository(MapPack::class)
            ->findAll();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/mappack/list.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/admin/mappack/{slug}", name="admin_mappack_view")
     * @ParamConverter("mappack", class="App\Entity\MapPack", options={"mapping":{"slug":"slug"}})
     */
    public function viewAction(MapPack $mappack) {

        return $this->render('admin/mappack/view.html.twig', [
            'mappack' => $mappack
        ]);
    }

    /**
     * @Route("/admin/mappack/new", name="admin_mappack_new")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(AdminMapPackType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            /** @var MapPack $mapPack */
            $mapPack = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($mapPack);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully created new map pack'
            );

            return $this->redirectToRoute('admin_mappack_list');
        }

        return $this->render('admin/mappack/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/admin/mappack/{slug}/edit", name="admin_mappack_edit")
     * @ParamConverter("mappack", class="App\Entity\MapPack", options={"mapping":{"slug":"slug"}})
     */
    public function editAction(Request $request, MapPack $mappack)
    {
        $form = $this->createForm(AdminMapPackType::class, $mappack);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            /** @var MapPack $mapPack */
            $mappack = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($mappack);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully edited'
            );

            return $this->redirectToRoute('admin_mappack_list');
        }

        return $this->render('admin/mappack/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/mappack/{slug}/delete", name="admin_mappack_delete")
     * @ParamConverter("mappack", class="App\Entity\MapPack", options={"mapping":{"slug":"slug"}})
     */
    public function deleteAction(Request $request, MapPack $mappack) {
        $form = $this->createForm(AdminConfirmType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mappack);
            $em->flush();

            $this->addFlash(
                'success',
                'Great'
            );

            return $this->redirectToRoute('admin_mappack_list');
        }

        return $this->render('admin/map/delete.html.twig', [
            'form' => $form->createView(),
            'mappack' => $mappack,
        ]);
    }
}