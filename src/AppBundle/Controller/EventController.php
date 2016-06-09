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
            throw $this->createNotFoundException('No event found');
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
        return $this->render('event/create.html.twig', array('form' => $form->createView(), 'title' => 'Create'));
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
            $slug = $this->get('app.slugger')->slugify($event->getTitle());
            $event->setSlug($slug);
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return $this->render('event/show.html.twig', array('event' => $event));
        }
        return $this->render('event/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
    }

    // Show the event-edit form
    /**
     * @Route("/event/edit/{slug}", name="eventedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $slug)
    {
        $event = $this->getDoctrine()
        ->getRepository('AppBundle:Event')->findOneBySlug($slug);
        if (!$event) {
            throw $this->createNotFoundException('No event found for id '.$slug);
        }
        $form = $this->createForm(EventType::class, $event, array('forupdate' => true));
        return $this->render('event/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit'));
    }

    // Handle the create form and store created event
    /**
     * @Route("/event/edit/{slug}", name="eventupdate")
     * @Method("POST")
     */
    public function updateAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('AppBundle:Event')->findOneBySlug($slug);
        if (!$event) {
            throw $this->createNotFoundException('No event found for id '.$slug);
        }
        $form = $this->createForm(EventType::class, $event, array('forupdate' => true));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $year = $event->getDatetime()->format('M d Y');
            $slug = $event->getTitle(). ' ' . $year;
            $slug = $this->get('app.slugger')->slugify($slug);
            $event->setSlug($slug);
            $em->flush();
            return $this->render('event/show.html.twig', array('event' => $event));
        }
        return $this->render('event/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit'));
    }

    // Display the specified event
    /**
     * @Route("/event/delete/{slug}", name="eventdelete", requirements={"page": "\d+"})
     */
    public function deleteAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em
        ->getRepository('AppBundle:Event')->findOneBySlug($slug);
        if (!$event) {
            throw $this->createNotFoundException('No event found for id '.$slug);
        }
        $em->remove($event);
        $em->flush();
        return $this->render('event/index.html.twig', array('message' => 'Event with slug = '.$slug.' deleted'));
    }

    // Display the specified event
    /**
     * @Route("/event/{slug}", name="eventshow")
     */
    public function showAction(Request $request, $slug)
    {
        $event = $this->getDoctrine()
        ->getRepository('AppBundle:Event')->findOneBySlug($slug);
        if (!$event) {
            throw $this->createNotFoundException('No event found for id '.$slug);
        }
        return $this->render('event/show.html.twig', array('event' => $event));
    }
}
