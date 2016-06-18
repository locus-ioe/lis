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
use AppBundle\Entity\Meeting;
use AppBundle\Form\Type\MeetingType;

class MeetingController extends BaseController
{
  /**
   * @Route("/meeting", name="meetingpage")
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $meetings = $em
    ->getRepository('AppBundle:Meeting')->findall();
    if (!$meetings) {
      return $this->redirectToRoute('meetingcreate', array());
    }
    return $this->render('meeting/index.html.twig', array('meetings' => $meetings));
  }

  /**
   * @Route("/meeting/create", name="meetingcreate")
   */
  public function createAction(Request $request)
  {
    $meeting = new Meeting();
    $form = $this->createForm(MeetingType::class, $meeting, array('forupdate' => false));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $toSlugify = $meeting->getDatetime()->format('mdY Hi');
      $meeting->setSlug($this->get('app.slugger')->slugify($toSlugify));
      $em = $this->getDoctrine()->getManager();
      $em->persist($meeting);
      $em->flush();
      return $this->redirectToRoute('meetingshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('meeting/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/meeting/{slug}/edit", name="meetingedit")
   */
  public function editAction(Request $request, $slug)
  {
    $meeting = $this->getDoctrine()
      ->getRepository('AppBundle:Meeting')->findOneBySlug($slug);
    $form = $this->createForm(MeetingType::class, $meeting, array('forupdate' => true));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $toSlugify = $meeting->getDatetime()->format('mdY Hi');
      $meeting->setSlug($this->get('app.slugger')->slugify($toSlugify));
      $em = $this->getDoctrine()->getManager();
      $em->persist($meeting);
      $em->flush();
      return $this->redirectToRoute('meetingshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('meeting/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/meeting/{slug}/delete", name="meetingdelete")
   */
  public function deleteAction(Request $request, $slug)
  {
    return new Response('<html><title>Delete meeting</title><body><h1>Delete meeting <small><i>with slug ' .$slug. '</i></small></h1></body></html>');
  }

  /**
   * @Route("/meeting/{slug}", name="meetingshow")
   */
  public function showAction(Request $request, $slug)
  {
    $meeting = $this->getDoctrine()
    ->getRepository('AppBundle:Meeting')->findOneBySlug($slug);
    if (!$meeting) {
      throw $this->createNotFoundException('No meeting found for slug '.$slug);
    }
    return $this->render('meeting/show.html.twig', array('meeting' => $meeting));
  }
}
