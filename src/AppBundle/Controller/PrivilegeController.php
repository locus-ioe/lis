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
use AppBundle\Entity\Privilege;
use AppBundle\Form\Type\PrivilegeType;

class PrivilegeController extends BaseController
{
  /**
   * @Route("/privilege", name="privilegepage")
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $privileges = $em
    ->getRepository('AppBundle:Privilege')->findall();
    if (!$privileges) {
      return $this->redirectToRoute('privilegecreate', array());
    }
    return $this->render('privilege/index.html.twig', array('privileges' => $privileges));
  }

  /**
   * @Route("/privilege/create", name="privilegecreate")
   */
  public function createAction(Request $request)
  {
    $privilege = new Privilege();
    $form = $this->createForm(PrivilegeType::class, $privilege, array('forupdate' => false));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $privilege->setSlug($this->get('app.slugger')->slugify($privilege->getName()));
      $em = $this->getDoctrine()->getManager();
      $em->persist($privilege);
      $em->flush();
      return $this->redirectToRoute('privilegeshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('privilege/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/privilege/{slug}/edit", name="privilegeedit")
   */
  public function editAction(Request $request, $slug)
  {
    $privilege = $this->getDoctrine()
      ->getRepository('AppBundle:Privilege')->findOneBySlug($slug);
    $form = $this->createForm(PrivilegeType::class, $privilege, array('forupdate' => true));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $privilege->setSlug($this->get('app.slugger')->slugify($privilege->getName()));
      $em = $this->getDoctrine()->getManager();
      $em->persist($privilege);
      $em->flush();
      return $this->redirectToRoute('privilegeshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('privilege/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/privilege/{slug}/delete", name="privilegedelete")
   */
  public function deleteAction(Request $request, $slug)
  {
    return new Response('<html><title>Delete privilege</title><body><h1>Delete privilege <small><i>with slug ' .$slug. '</i></small></h1></body></html>');
  }

  /**
   * @Route("/privilege/{slug}", name="privilegeshow")
   */
  public function showAction(Request $request, $slug)
  {
    $privilege = $this->getDoctrine()
    ->getRepository('AppBundle:Privilege')->findOneBySlug($slug);
    if (!$privilege) {
      throw $this->createNotFoundException('No privilege found for slug '.$slug);
    }
    return $this->render('privilege/show.html.twig', array('privilege' => $privilege));
  }
}
