<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// Symfony form types
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
// User-defined classes
use AppBundle\Entity\Event;
use AppBundle\Form\Type\EventType;

class EventController extends BaseController
{
  /**
   * @Route("/event", name="eventpage")
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $events = $em
    ->getRepository('AppBundle:Event')->findall();
    if (!$events) {
      return $this->redirectToRoute('eventcreate', array());
    }
    return $this->render('event/index.html.twig', array('events' => $events));
  }

  /**
   * @Route("/event/create", name="eventcreate")
   */
  public function createAction(Request $request)
  {
    $event = new Event();
    $form = $this->createForm(EventType::class, $event, array('forupdate' => false));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $toSlugify = $event->getTitle(). ' '.$event->getDatetime()->format('M d Y');
      $event->setSlug($this->get('app.slugger')->slugify($toSlugify));
      $em = $this->getDoctrine()->getManager();
      $em->persist($event);
      $em->flush();
      return $this->redirectToRoute('eventshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('event/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/event/{slug}/edit", name="eventedit")
   */
  public function editAction(Request $request, $slug)
  {
    $event = $this->getDoctrine()
      ->getRepository('AppBundle:Event')->findOneBySlug($slug);
    $form = $this->createForm(EventType::class, $event, array('forupdate' => true));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $toSlugify = $event->getTitle(). ' '.$event->getDatetime()->format('M d Y');
      $event->setSlug($this->get('app.slugger')->slugify($toSlugify));
      $em = $this->getDoctrine()->getManager();
      $em->persist($event);
      $em->flush();
      return $this->redirectToRoute('eventshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('event/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/event/{slug}/delete", name="eventdelete")
   */
  public function deleteAction(Request $request, $slug)
  {
    return new Response('<html><title>Delete event</title><body><h1>Delete event <small><i>with slug ' .$slug. '</i></small></h1></body></html>');
  }

  /**
   * @Route("/event/{slug}", name="eventshow")
   */
  public function showAction(Request $request, $slug)
  {
    $event = $this->getDoctrine()
    ->getRepository('AppBundle:Event')->findOneBySlug($slug);
    if (!$event) {
      throw $this->createNotFoundException('No event found for slug '.$slug);
    }
    return $this->render('event/show.html.twig', array('event' => $event));
  }
}
