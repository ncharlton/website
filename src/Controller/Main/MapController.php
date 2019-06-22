<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Main;

use App\Entity\Map;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Handler\DownloadHandler;

/**
 * Class MapController
 * @package App\Controller\Main
 */
class MapController extends AbstractController
{
    /**
     * @Route("/maps", name="main_map_list")
     *
     * @return Response
     */
    public function listAction(SerializerInterface $serializer): Response
    {
        $maps = $this->getDoctrine()->getRepository(Map::class)
            ->findAll();

        $maps = $serializer->serialize($maps, 'json', SerializationContext::create()->setGroups(['list']));

        return $this->render('main/map/list.html.twig', [
            'maps' => $maps,
        ]);
    }

    /**
     * @Route("/map/{slug}", name="main_map_view")
     * @ParamConverter("map", class="App\Entity\Map", options={"mapping":{"slug":"slug"}})
     *
     * @param Map $map
     * @return Response
     */
    public function viewAction(Map $map): Response
    {
        if(!$map->getPublished()) {
            throw new NotFoundHttpException();
        }

        return $this->render('main/map/view.html.twig', [
            'map' => $map
        ]);
    }

    /**
     * @Route("/map/{slug}/download", name="main_map_download")
     * @ParamConverter("map", class="App\Entity\Map", options={"mapping":{"slug":"slug"}})
     *
     * @param DownloadHandler $downloadHandler
     * @param Map $map
     * @return Response
     */
    public function downloadAction(DownloadHandler $downloadHandler, Map $map): Response
    {
        return $downloadHandler->downloadObject($map, 'downloadFile');
    }


}