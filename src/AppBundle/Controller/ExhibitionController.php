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
use AppBundle\Entity\Exhibition;
use AppBundle\Form\Type\ExhibitionType;

class ExhibitionController extends BaseController
{
  /**
   * @Route("/exhibition", name="exhibitionpage")
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $exhibitions = $em
    ->getRepository('AppBundle:Exhibition')->findall();
    if (!$exhibitions) {
      return $this->redirectToRoute('exhibitioncreate', array());
    }
    return $this->render('exhibition/index.html.twig', array('exhibitions' => $exhibitions));
  }

  /**
   * @Route("/exhibition/create", name="exhibitioncreate")
   */
  public function createAction(Request $request)
  {
    $exhibition = new Exhibition();
    $form = $this->createForm(ExhibitionType::class, $exhibition, array('forupdate' => false));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $toSlugify = 'Locus '.$exhibition->getYear()->format('Y');
      $exhibition->setSlug($this->get('app.slugger')->slugify($toSlugify));
      $em = $this->getDoctrine()->getManager();
      $em->persist($exhibition);
      $em->flush();
      return $this->redirectToRoute('exhibitionshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('exhibition/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/exhibition/{slug}/edit", name="exhibitionedit")
   */
  public function editAction(Request $request, $slug)
  {
    $exhibition = $this->getDoctrine()
      ->getRepository('AppBundle:Exhibition')->findOneBySlug($slug);
    $form = $this->createForm(ExhibitionType::class, $exhibition, array('forupdate' => true));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $toSlugify = 'Locus '.$exhibition->getYear()->format('Y');
      $exhibition->setSlug($this->get('app.slugger')->slugify($toSlugify));
      $em = $this->getDoctrine()->getManager();
      $em->persist($exhibition);
      $em->flush();
      return $this->redirectToRoute('exhibitionshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('exhibition/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/exhibition/{slug}/delete", name="exhibitiondelete")
   */
  public function deleteAction(Request $request, $slug)
  {
    return new Response('<html><title>Delete exhibition</title><body><h1>Delete exhibition <small><i>with slug ' .$slug. '</i></small></h1></body></html>');
  }

  /**
   * @Route("/exhibition/{slug}", name="exhibitionshow")
   */
  public function showAction(Request $request, $slug)
  {
    $exhibition = $this->getDoctrine()
    ->getRepository('AppBundle:Exhibition')->findOneBySlug($slug);
    if (!$exhibition) {
      throw $this->createNotFoundException('No exhibition found for slug '.$slug);
    }
    return $this->render('exhibition/show.html.twig', array('exhibition' => $exhibition));
  }
}
