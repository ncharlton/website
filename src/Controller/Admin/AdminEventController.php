<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Admin;

use App\Entity\Event;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminEventController
 * @package App\Controller\Admin
 */
class AdminEventController extends AbstractController
{
    /**
     * @Route("/admin/events", name="admin_event_list")
     */
    public function listAction() {
        $events = $this->getDoctrine()->getRepository('App:Event')
            ->fetchNewest();

        return $this->render('admin/event/list.html.twig', [
            'events' => $events
        ]);
    }

    /**
     * @Route("/admin/event/new", name="admin_event_new")
     */
    public function newAction(Request $request) {
        $form = $this->createForm('App\Form\Admin\AdminEventType');
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Event $event */
            $event = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully created new event'
            );

            return $this->redirectToRoute('admin_event_view', ['slug' => $event->getSlug()]);
        }

        return $this->render('admin/event/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/event/{slug}", name="admin_event_view")
     * @ParamConverter("event", options={"mapping":{"slug":"slug"}})
     */
    public function viewAction(Event $event) {
        return $this->render('admin/event/view.html.twig', [
            'event' => $event
        ]);
    }

    /**
     * @Route("/admin/event/{slug}/edit", name="admin_event_edit")
     * @ParamConverter("event", options={"mapping":{"slug":"slug"}})
     */
    public function editAction(Event $event, Request $request) {
        $form = $this->createForm('App\Form\Admin\AdminEventType', $event);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Event $event */
            $event = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            $this->addFlash(
                'Success',
                'Great'
            );

            return $this->redirectToRoute('admin_event_view', ['slug' => $event->getSlug()]);
        }

        return $this->render('admin/event/edit.html.twig', [
            'form' => $form->createView(),
            'event' => $event
        ]);
    }

    /**
     * @Route("/admin/event/{slug}/delete", name="admin_event_delete")
     * @ParamConverter("event", options={"mapping":{"slug":"slug"}})
     */
    public function deleteAction(Event $event, Request $request) {
        $form = $this->createForm('App\Form\Admin\AdminConfirmType');
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();

            $this->addFlash(
                'success',
                'Great'
            );

            return $this->redirectToRoute('admin_event_list');
        }

        return $this->render('admin/event/delete.html.twig', [
            'form' => $form->createView(),
            'event' => $event
        ]);
    }

}