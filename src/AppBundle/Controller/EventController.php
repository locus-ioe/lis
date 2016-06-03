<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Symfony form
use AppBundle\Form\Type\EventType;

// User-defined classes
use AppBundle\Entity\Event;

class EventController extends Controller
{
    // Show Event Index Page
    /**
     * @Route("/event", name="eventpage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em
        ->getRepository('AppBundle:Event')->findall();

        if (!$events) {
            throw $this->createNotFoundException('No event found for id '.$eventId);
        }

        return $this->render('event/index.html.twig', array('events' => $events));
    }

    // Show the event-create form
    /**
     * @Route("/event/create", name="eventcreate")
     * @Method({"GET", "HEAD"})
     */
    public function createAction(Request $request)
    {
        $event = new Event();

        $form = $this->createForm(EventType::class, $event, array('forupdate' => false));

        return $this->render('event/create.html.twig', array('form' => $form->createView(),));
    }

    // Handle the create form and store created event
    /**
     * @Route("/event/create", name="eventstore")
     * @Method("POST")
     */
    public function storeAction(Request $request)
    {
        $event = new Event();

        $form = $this->createForm(EventType::class, $event, array('forupdate' => false));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->render('event/show.html.twig', array('event' => $event));
        }

        return $this->render('event/create.html.twig', array('form' => $form->createView(),));
    }

    // Show the event-edit form
    /**
     * @Route("/event/edit/{eventId}", name="eventedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $eventId)
    {
        $event = $this->getDoctrine()
        ->getRepository('AppBundle:Event')
        ->find($eventId);

        if (!$event) {
            throw $this->createNotFoundException('No event found for id '.$eventId);
        }

        $form = $this->createForm(EventType::class, $event, array('forupdate' => true));

        return $this->render('event/create.html.twig', array('form' => $form->createView(),));
    }

    // Handle the create form and store created event
    /**
     * @Route("/event/edit/{eventId}", name="eventupdate")
     * @Method("POST")
     */
    public function updateAction(Request $request, $eventId)
    {
        $event = new Event();

        $form = $this->createForm(EventType::class, $event, array('forupdate' => true));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $fetched = $em
            ->getRepository('AppBundle:Event')->find($eventId);

            if (!$fetched) {
                throw $this->createNotFoundException('No event found for id '.$eventId);
            }

            $fetched->setTitle($event->getTitle());
            $fetched->setDatetime($event->getDatetime());
            $fetched->setVenue($event->getVenue());
            $fetched->setType($event->getType());
            $fetched->setDescription($event->getDescription());
            $fetched->setReport($event->getReport());

            $em->flush();

            return $this->render('event/show.html.twig', array('event' => $fetched));
        }

        return $this->render('event/create.html.twig', array('form' => $form->createView(),));
    }

    // Display the specified event
    /**
     * @Route("/event/delete/{eventId}", name="eventdelete", requirements={"page": "\d+"})
     */
    public function deleteAction(Request $request, $eventId)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em
        ->getRepository('AppBundle:Event')->find($eventId);

        if (!$event) {
            throw $this->createNotFoundException('No event found for id '.$eventId);
        }

        $em->remove($event);
        $em->flush();

        return $this->render('event/index.html.twig', array('message' => 'Event with eventId = '.$eventId.' deleted'));
    }

    // Display the specified event
    /**
     * @Route("/event/{eventId}", name="eventshow", requirements={"page": "\d+"})
     */
    public function showAction(Request $request, $eventId)
    {
        $event = $this->getDoctrine()
        ->getRepository('AppBundle:Event')->find($eventId);

        if (!$event) {
            throw $this->createNotFoundException('No event found for id '.$eventId);
        }

        return $this->render('event/show.html.twig', array('event' => $event));
    }

    /**
     * @Route("/api/event/{eventId}", name="apieventshow")
     */
    public function apiShowAction($eventId)
    {
        $event = $this->getDoctrine()
        ->getRepository('AppBundle:Event')->find($eventId);

        if (!$event) {
            throw $this->createNotFoundException('No event found for id '.$eventId);
        }

        $data = array(
            'id' => $event->getId(),
            'title' => $event->getTitle(),
            'datetime' => "TODO: datetime conversion to string",
            'venue' => $event->getVenue(),
            'description' => $event->getDescription(),
            'report' => $event->getReport()
        );
        return new Response(json_encode($data),200,array('Content-Type' =>'application/json'));
    }
}
