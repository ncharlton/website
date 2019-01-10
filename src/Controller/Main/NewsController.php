<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Main;

use App\Entity\News;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NewsController
 * @package App\Controller\Main
 */
class NewsController extends AbstractController
{
    /**
     * @Route("/news/{slug}", name="main_news_view")
     * @ParamConverter("news", options={"mapping": {"slug":"slug"}})
     */
    public function viewAction(News $news) {
        if(!$news->getPublished()) {
            return new NotFoundHttpException();
        }

        return new Response($news);
    }

    /**
     * @Route("/news/{slug}/preview", name="main_news_preview")
     * @ParamConverter("news", options={"mapping": {"slug":"slug"}})
     * @IsGranted("ROLE_ADMIN")
     * @param News $news
     * @return Response
     */
    public function previewAction(News $news) {
        return $this->render('main/news/preview.html.twig', [
            'news' => $news
        ]);
    }
}