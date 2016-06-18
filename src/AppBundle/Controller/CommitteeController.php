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
use AppBundle\Entity\Committee;
use AppBundle\Form\Type\CommitteeType;

class CommitteeController extends BaseController
{
  /**
   * @Route("/committee", name="committeepage")
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $committees = $em
    ->getRepository('AppBundle:Committee')->findall();
    if (!$committees) {
      return $this->redirectToRoute('committeecreate', array());
    }
    return $this->render('committee/index.html.twig', array('committees' => $committees));
  }

  /**
   * @Route("/committee/create", name="committeecreate")
   */
  public function createAction(Request $request)
  {
    $committee = new Committee();
    $form = $this->createForm(CommitteeType::class, $committee, array('forupdate' => false));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($committee);
      $em->flush();
      return $this->redirectToRoute('committeeshow', array('id' => $form->getData()->getId()));
    }
    return $this->render('committee/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/committee/{id}/edit", name="committeeedit")
   */
  public function editAction(Request $request, $id)
  {
    $committee = $this->getDoctrine()
      ->getRepository('AppBundle:Committee')->find($id);
    $form = $this->createForm(CommitteeType::class, $committee, array('forupdate' => true));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($committee);
      $em->flush();
      return $this->redirectToRoute('committeeshow', array('id' => $id));
    }
    return $this->render('committee/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/committee/{id}/delete", name="committeedelete")
   */
  public function deleteAction(Request $request, $id)
  {
    return new Response('<html><title>Delete committee</title><body><h1>Delete committee <small><i>with id ' .$id. '</i></small></h1></body></html>');
  }

  /**
   * @Route("/committee/{id}", name="committeeshow")
   */
  public function showAction(Request $request, $id)
  {
    $committee = $this->getDoctrine()
    ->getRepository('AppBundle:Committee')->find($id);
    if (!$committee) {
      throw $this->createNotFoundException('No committee found for id '.$id);
    }
    return $this->render('committee/show.html.twig', array('committee' => $committee));
  }
}
