<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Admin;

use App\Entity\User;
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
        $newUsers = $this->getDoctrine()->getRepository(User::class)
            ->fetchNewestUsersWithLimit(5);

        return $this->render('admin/main/home.html.twig', [
            'newUsers' => $newUsers
        ]);
    }
}