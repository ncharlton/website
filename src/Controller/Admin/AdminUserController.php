<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Admin;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class AdminUserController
 * @package App\Controller\Admin
 */
class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_user_list")
     */
    public function listAction() {
        /** @var User[] $users */
        $users = $this->getDoctrine()->getRepository('App:User')
            ->findAll();

        return $this->render('admin/user/list.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/admin/user/{username}", name="admin_user_view")
     * @ParamConverter("user", class="App\Entity\User")
     */
    public function viewAction(User $user) {
        return $this->render('admin/user/view.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/admin/user/{username}/edit", name="admin_user_edit")
     * @ParamConverter("user", class="App\Entity\User")
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function editAction(User $user, Request $request) {
        $form = $this->createForm("App\Form\Admin\AdminUserType", $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Successfully edited %s', $user->getUsername())
            );

            return $this->redirectToRoute('admin_user_edit', ['username' => $user->getUsername()]);
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/user/{username}/delete", name="admin_user_delete")
     * @ParamConverter("user", class="App\Entity\User")
     */
    public function deleteAction(User $user, Request $request) {
        $form = $this->createForm('App\Form\Admin\AdminConfirmType');
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Successfully deleted %s', $user->getUsername())
            );

            return $this->redirectToRoute('admin_user_list');
        }

        return $this->render('admin/user/delete.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * @Route("/admin/user/{username}/block", name="admin_user_block")
     * @ParamConverter("user", class="App\Entity\User")
     */
    public function blockAction(User $user, Request $request) {
        $form = $this->createForm('App\Form\Admin\AdminConfirmType');
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user->setStatus(2);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Successfully blocked %s', $user->getUsername())
            );

            return $this->redirectToRoute('admin_user_list');
        }

        return $this->render('admin/user/block.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
}