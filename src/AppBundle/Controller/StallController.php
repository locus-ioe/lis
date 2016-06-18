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
use AppBundle\Entity\Stall;
use AppBundle\Form\Type\StallType;

class StallController extends BaseController
{
  /**
   * @Route("/stall", name="stallpage")
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $stalls = $em
    ->getRepository('AppBundle:Stall')->findall();
    if (!$stalls) {
      return $this->redirectToRoute('stallcreate', array());
    }
    return $this->render('stall/index.html.twig', array('stalls' => $stalls));
  }

  /**
   * @Route("/stall/create", name="stallcreate")
   */
  public function createAction(Request $request)
  {
    $stall = new Stall();
    $form = $this->createForm(StallType::class, $stall, array('forupdate' => false));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $toSlugify = $stall->getNumber(). ' '.$stall->getSize().' '.$stall->getExhibition()->getYear()->format('Y');
      $stall->setSlug($this->get('app.slugger')->slugify($toSlugify));
      $em = $this->getDoctrine()->getManager();
      $em->persist($stall);
      $em->flush();
      return $this->redirectToRoute('stallshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('stall/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/stall/{slug}/edit", name="stalledit")
   */
  public function editAction(Request $request, $slug)
  {
    $stall = $this->getDoctrine()
      ->getRepository('AppBundle:Stall')->findOneBySlug($slug);
    $form = $this->createForm(StallType::class, $stall, array('forupdate' => true));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $toSlugify = $stall->getNumber(). ' '.$stall->getSize().' '.$stall->getExhibition()->getYear()->format('Y');
      $stall->setSlug($this->get('app.slugger')->slugify($toSlugify));
      $em = $this->getDoctrine()->getManager();
      $em->persist($stall);
      $em->flush();
      return $this->redirectToRoute('stallshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('stall/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/stall/{slug}/delete", name="stalldelete")
   */
  public function deleteAction(Request $request, $slug)
  {
    return new Response('<html><title>Delete stall</title><body><h1>Delete stall <small><i>with slug ' .$slug. '</i></small></h1></body></html>');
  }

  /**
   * @Route("/stall/{slug}", name="stallshow")
   */
  public function showAction(Request $request, $slug)
  {
    $stall = $this->getDoctrine()
    ->getRepository('AppBundle:Stall')->findOneBySlug($slug);
    if (!$stall) {
      throw $this->createNotFoundException('No stall found for slug '.$slug);
    }
    return $this->render('stall/show.html.twig', array('stall' => $stall));
  }
}
