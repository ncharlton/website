<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Controller\Main;

use App\Entity\Event;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EventController
 * @package App\Controller\Main
 */
class EventController extends AbstractController
{
    /**
     * @Route("/events", name="main_event_list")
     */
    public function listAction() {
        $events = $this->getDoctrine()->getRepository('App:Event')
            ->fetchPublished();

        return $this->render('main/event/list.html.twig', [
            'events' => $events
        ]);
    }

    /**
     * @Route("/event/{slug}", name="main_event_view")
     * @ParamConverter("event", options={"mapping":{"slug":"slug"}})
     */
    public function viewAction(Event $event) {
        if(!$event->getPublished()) {
            throw new NotFoundHttpException();
        }

        return $this->render('main/event/view.html.twig', [
            'event' => $event
        ]);
    }
}