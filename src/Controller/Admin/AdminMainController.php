<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminMainController
 * @package App\Controller\Admin
 * @Route("/admin")
 */
class AdminMainController extends AbstractController
{
    /**
     * @Route("/", name="admin_main_home")
     */
    public function homeAction()
    {
        return $this->render('admin/main/home.html.twig');
    }
}