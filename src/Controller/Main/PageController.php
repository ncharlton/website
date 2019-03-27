<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Main;

use App\Entity\Page;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PageController
 * @package App\Controller\Main
 */
class PageController extends AbstractController
{
    /**
     * @Route("/page/{slug}", name="main_page_view")
     * @ParamConverter("page", options={"mapping":{"slug":"slug"}})
     */
    public function viewAction(Page $page) {
        if(!$page->getPublished()) {
            throw new NotFoundHttpException();
        }

        return $this->render('main/page/view.html.twig', [
            'page' => $page
        ]);
    }

    /**
     * @Route("/page/{slug}/preview", name="main_page_preview")
     * @ParamConverter("page", options={"mapping":{"slug":"slug"}})
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function previewAction(Page $page) {
        return $this->render('main/page/view.html.twig', [
            'page' => $page
        ]);
    }
}