<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Main;

use App\Entity\MapPack;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class MapPackController extends AbstractController
{
    /**
     * @Route("/mappacks", name="main_mappack_list")
     */
    public function listAction()
    {
        $mappacks = $this->getDoctrine()->getRepository(MapPack::class)
            ->findAll();

        return $this->render('main/mappack/list.html.twig', [
            'mappacks' => $mappacks
        ]);
    }

    /**
     * @Route("/mappack/{slug}", name="main_mappack_view")
     * @ParamConverter("mappack", options={"mapping":{"slug":"slug"}})
     */
    public function viewAction(MapPack $mapPack)
    {
        if(!$mapPack->getPublished()) {
            throw new NotFoundHttpException();
        }

        return $this->render('main/mappack/view.html.twig', [
            'mappack' => $mapPack
        ]);
    }
}