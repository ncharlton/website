<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Main;

use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_home")
     */
    public function homeAction() {
        /** @var News $highlightNews */
        $highlightNews = $this->getDoctrine()->getRepository(News::class)
            ->fetchHighlight();

        if($highlightNews) {
            $highlightNews = $highlightNews[0];
        }

        return $this->render('main/main/home.html.twig', [
            'newsHighlight' => $highlightNews
        ]);
    }
}