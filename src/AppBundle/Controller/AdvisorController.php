<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// User-defined classes
use AppBundle\Entity\Advisor;

class AdvisorController extends BaseController
{
  /**
   * @Route("/advisor", name="advisorpage")
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $advisors = $em
    ->getRepository('AppBundle:Advisor')->findall();
    if (!$advisors) {
      return $this->redirectToRoute('advisorcreate', array());
    }
    return $this->render('advisor/index.html.twig', array('advisors' => $advisors));
  }

  /**
   * @Route("/advisor/create", name="advisorcreate")
   */
  public function createAction(Request $request)
  {
    $advisor = new Advisor();
    $form = $this->createForm(AdvisorType::class, $advisor, array('forupdate' => false));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($advisor);
      $em->flush();
      return $this->redirectToRoute('advisorshow', array('id' => $form->getData()->getId()));
    }
    return $this->render('advisor/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/advisor/{id}/edit", name="advisoredit")
   */
  public function editAction(Request $request, $id)
  {
    $advisor = $this->getDoctrine()
    ->getRepository('AppBundle:Advisor')->find($id);
    $form = $this->createForm(AdvisorType::class, $advisor, array('forupdate' => true));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($advisor);
      $em->flush();
      return $this->redirectToRoute('advisorshow', array('id' => $id));
    }
    return $this->render('advisor/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/advisor/{id}/delete", name="advisordelete")
   */
  public function deleteAction(Request $request, $id)
  {
    return new Response('<html><title>Delete Advisor</title><body><h1>Delete Advisor <small><i>with id ' .$id. '</i></small></h1></body></html>');
  }

  /**
   * @Route("/advisor/{id}", name="advisorshow")
   */
  public function showAction(Request $request, $id)
  {
    $advisor = $this->getDoctrine()
    ->getRepository('AppBundle:Advisor')->find($id);
    if (!$advisor) {
      throw $this->createNotFoundException('No advisor found for id '.$id);
    }
    return $this->render('advisor/show.html.twig', array('advisor' => $advisor));
  }
}
