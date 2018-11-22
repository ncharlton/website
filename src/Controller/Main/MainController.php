<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Main;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_home")
     */
    public function homeAction() {
        return $this->render('main/main/home.html.twig');
    }
}