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
use AppBundle\Entity\Institution;
use AppBundle\Form\Type\InstitutionType;

class InstitutionController extends BaseController
{
  /**
   * @Route("/institution", name="institutionpage")
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $institutions = $em
    ->getRepository('AppBundle:Institution')->findall();
    if (!$institutions) {
      return $this->redirectToRoute('institutioncreate', array());
    }
    return $this->render('institution/index.html.twig', array('institutions' => $institutions));
  }

  /**
   * @Route("/institution/create", name="institutioncreate")
   */
  public function createAction(Request $request)
  {
    $institution = new Institution();
    $form = $this->createForm(InstitutionType::class, $institution, array('forupdate' => false));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $institution->setSlug($this->get('app.slugger')->slugify($institution->getName()));
      $em = $this->getDoctrine()->getManager();
      $em->persist($institution);
      $em->flush();
      return $this->redirectToRoute('institutionshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('institution/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/institution/{slug}/edit", name="institutionedit")
   */
  public function editAction(Request $request, $slug)
  {
    $institution = $this->getDoctrine()
      ->getRepository('AppBundle:Institution')->findOneBySlug($slug);
    $form = $this->createForm(InstitutionType::class, $institution, array('forupdate' => true));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $institution->setSlug($this->get('app.slugger')->slugify($institution->getName()));
      $em = $this->getDoctrine()->getManager();
      $em->persist($institution);
      $em->flush();
      return $this->redirectToRoute('institutionshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('institution/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/institution/{slug}/delete", name="institutiondelete")
   */
  public function deleteAction(Request $request, $slug)
  {
    return new Response('<html><title>Delete institution</title><body><h1>Delete institution <small><i>with slug ' .$slug. '</i></small></h1></body></html>');
  }

  /**
   * @Route("/institution/{slug}", name="institutionshow")
   */
  public function showAction(Request $request, $slug)
  {
    $institution = $this->getDoctrine()
    ->getRepository('AppBundle:Institution')->findOneBySlug($slug);
    if (!$institution) {
      throw $this->createNotFoundException('No institution found for slug '.$slug);
    }
    return $this->render('institution/show.html.twig', array('institution' => $institution));
  }
}
