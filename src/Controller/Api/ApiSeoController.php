<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Api;

use App\Entity\SeoPage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiSeoController
 * @package App\Controller\Api
 */
class ApiSeoController extends AbstractController
{
    /**
     * @Route("/api/seo/new", name="api_seo_new")
     * @param Request $request
     */
    public function newAction(Request $request)
    {
        if($request->query->has('type') && $request->query->has('id')) {

            $type = $request->query->get('type');
            $id = $request->query->get('id');

//            $seoPage = new SeoPage();
//            $seoPage->setTitle($request->request->get('title'));
//            $seoPage->setDescription($request->request->get('description'));
//            $seoPage->setKeywords($request->request->get('keywords'));
//
            $em = $this->getDoctrine()->getConnection();

            $query = 'SELECT id FROM %s WHERE %s.id = %d';
            $query = sprintf($query, $type, $type, $id);

            $em->getConnection();

            echo $query;

        }

        return new Response("hi");
    }
}