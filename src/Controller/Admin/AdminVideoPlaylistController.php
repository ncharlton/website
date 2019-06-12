<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Admin;

use App\Entity\VideoPlaylist;
use App\Form\Admin\AdminConfirmType;
use App\Form\Admin\AdminVideoPlaylistType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminVideoPlaylistController
 * @package App\Controller\Admin
 */
class AdminVideoPlaylistController extends AbstractController
{
    /**
     * @Route("/admin/playlists", name="admin_playlist_list")
     */
    public function listAction() {
        /** @var VideoPlaylist[] $playlists */
        $playlists = $this->getDoctrine()->getRepository(VideoPlaylist::class)
            ->fetchOrderByPosition();

        return $this->render('admin/playlist/list.html.twig', [
            'playlists' => $playlists
        ]);
    }

    /**
     * @Route("/admin/playlist/new", name="admin_playlist_new")
     */
    public function newAction(Request $request) {
        $form = $this->createForm(AdminVideoPlaylistType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var VideoPlaylist $videoPlaylist */
            $videoPlaylist = $form->getData();

            if($videoPlaylist->getPublished()) {
                $videoPlaylist->setPublishedAt(new \DateTime());
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($videoPlaylist);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully created video playlist'
            );

            return $this->redirectToRoute('admin_playlist_list');
        }

        return $this->render('admin/playlist/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/playlist/{slug}", name="admin_playlist_view")
     * @ParamConverter("playlist", options={"mapping": {"slug":"slug"}}, class="App\Entity\VideoPlaylist")
     */
    public function viewAction(VideoPlaylist $playlist) {
        return $this->render('admin/playlist/view.html.twig', [
            'playlist' => $playlist
        ]);
    }

    /**
     * @Route("/admin/playlist/{slug}/edit", name="admin_playlist_edit")
     * @ParamConverter("playlist", options={"mapping": {"slug":"slug"}}, class="App\Entity\VideoPlaylist")
     */
    public function editAction(VideoPlaylist $playlist, Request $request) {
        $form = $this->createForm(AdminVideoPlaylistType::class, $playlist);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var VideoPlaylist $videoPlaylist */
            $videoPlaylist = $form->getData();

            if($videoPlaylist->getPublished() && $videoPlaylist->getPublished() !== $playlist->getPublished()) {
                $videoPlaylist->setPublishedAt(new \DateTime());
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($videoPlaylist);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully edited video playlist'
            );

            return $this->redirectToRoute('admin_playlist_view', ['slug' => $videoPlaylist->getSlug()]);
        }

        return $this->render('admin/playlist/edit.html.twig', [
            'form' => $form->createView(),
            'playlist' => $playlist
        ]);
    }

    /**
     * @Route("/admin/playlist/{slug}/delete", name="admin_playlist_delete")
     * @ParamConverter("playlist", options={"mapping": {"slug":"slug"}}, class="App\Entity\VideoPlaylist")
     */
    public function deleteAction(VideoPlaylist $playlist, Request $request) {
        $form = $this->createForm(AdminConfirmType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($playlist);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Succesfully deleted %s', $playlist->getTitle())
            );

            return $this->redirectToRoute('admin_playlist_list');
        }

        return $this->render('admin/playlist/delete.html.twig', [
            'form' => $form->createView(),
            'playlist' => $playlist
        ]);
    }
}