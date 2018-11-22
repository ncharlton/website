<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminUserController
 * @package App\Controller\Admin
 */
class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_user_list")
     */
    public function indexAction() {
        /** @var User[] $users */
        $users = $this->getDoctrine()->getRepository('App:User')
            ->findAll();

        return $this->render('admin/user/list.html.twig', [
            'users' => $users
        ]);
    }

}