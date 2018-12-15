<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Admin;

use App\Entity\Game;
use App\Form\Admin\AdminConfirmType;
use App\Form\Admin\AdminGameType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminGameController
 * @package App\Controller\Admin
 */
class AdminGameController extends AbstractController
{
    /**
     * List all games
     *
     * @Route("/admin/games", name="admin_game_list")
     * @return Response
     */
    public function listAction()
    {
        $games = $this->getDoctrine()->getRepository('App:Game')
            ->findAll();

        return $this->render('admin/game/list.html.twig', [
            'games' => $games
        ]);
    }

    /**
     * Create new game
     *
     * @Route("/admin/game/new", name="admin_game_new")
     * @var Request $request
     *
     * @return Response
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(AdminGameType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var Game $game */
            $game = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            $this->addFlash(
                'notice',
                'You have successfully created a new game'
            );

            return $this->redirectToRoute('admin_game_list');
        }

        return $this->render('admin/game/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Edits a game
     *
     * @Route("/admin/game/{slug}/edit", name="admin_game_edit")
     * @ParamConverter("game", options={"mapping": {"slug":"slug"}})
     * @var Game $game
     * @var Request $request
     * @return Response
     */
    public function editAction(Game $game, Request $request):Response
    {
        $form = $this->createForm(AdminGameType::class, $game);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Game $game */
            $game = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Successfully edited %s', $game->getName())
            );
        }

        return $this->render('admin/game/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Deletes a game
     *
     * @Route("/admin/game/{slug}/delete", name="admin_game_delete")
     * @ParamConverter("game", options={"mapping": {"slug":"slug"}})
     * @var Game $game
     * @var Request $request
     * @return Response
     */
    public function deleteAction(Game $game, Request $request)
    {
        $form = $this->createForm(AdminConfirmType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($game);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Succesfully deleted %s', $game->getName())
            );

            return $this->redirectToRoute('admin_game_list');
        }

        return $this->render('admin/game/delete.html.twig', [
            'form' => $form->createView(),
            'game' => $game
        ]);
    }
}