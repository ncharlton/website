<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Api;

use App\Entity\Map;
use App\Entity\MapDetail;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiMapController extends AbstractController
{
    /**
     * @Route("/api/maps", name="api_maps_fetch_all")
     *
     * Filters:
     * start
     * scout
     *
     *
     * Orders:
     * title
     * created
     */
    public function fetchAllAction(SerializerInterface $serializer, Request $request)
    {
        $load = [
            'start' => 0,
            'page' => 1,
            'orderBy' => 'title',
            'orderDirection' => 'asc',

            'start' => '',
            'scout' => '',
        ];

        $orders = ['title', 'created'];
        $orderDirections = ['asc', 'desc'];

        // map type
        if($request->query->has('fStart')) {
            $fStart = $request->query->get('fStart');
            if(in_array($fStart, MapDetail::START)) {
                $load['start'] = $fStart;
            }
        }

        // map scout
        if($request->query->has('fScout')) {
            $fScout = $request->query->get('fScout');
            if(in_array($fScout, MapDetail::SCOUT)) {
                $load['scout'] = $fScout;
            }
        }

        if($request->query->has('order')) {
            $order = $request->query->get('order');
            if(in_array($order, $orders)) {
                $load['orderBy'] = $order;
            }
        }

        if($request->query->has('direction')) {
            $orderDirection = $request->query->get('direction');
            if(in_array($orderDirection, $orderDirections)) {
                $load['orderDirection'] = $orderDirection;
            }
        }


        /** @var Map[] $maps */
        $maps = $this->getDoctrine()->getRepository(Map::class)
            ->filter($load);

        $maps = $serializer->serialize($maps, 'json', SerializationContext::create()->setGroups(['list']));

        return JsonResponse::fromJsonString($maps);
    }
}