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
use AppBundle\Entity\Letter;
use AppBundle\Form\Type\LetterType;

class LetterController extends BaseController
{
  /**
   * @Route("/letter", name="letterpage")
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $letters = $em
    ->getRepository('AppBundle:Letter')->findall();
    if (!$letters) {
      return $this->redirectToRoute('lettercreate', array());
    }
    return $this->render('letter/index.html.twig', array('letters' => $letters));
  }

  /**
   * @Route("/letter/create", name="lettercreate")
   */
  public function createAction(Request $request)
  {
    $letter = new Letter();
    $form = $this->createForm(LetterType::class, $letter, array('forupdate' => false));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($letter);
      $em->flush();
      return $this->redirectToRoute('lettershow', array('regNo' => $form->getData()->getRegNo()));
    }
    return $this->render('letter/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/letter/{regNo}/edit", name="letteredit")
   */
  public function editAction(Request $request, $regNo)
  {
    $letter = $this->getDoctrine()
      ->getRepository('AppBundle:Letter')->findOneByRegNo($regNo);
    $form = $this->createForm(LetterType::class, $letter, array('forupdate' => true));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($letter);
      $em->flush();
      return $this->redirectToRoute('lettershow', array('regNo' => $regNo));
    }
    return $this->render('letter/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/letter/{regNo}/delete", name="letterdelete")
   */
  public function deleteAction(Request $request, $regNo)
  {
    return new Response('<html><title>Delete letter</title><body><h1>Delete letter <small><i>with regNo ' .$regNo. '</i></small></h1></body></html>');
  }

  /**
   * @Route("/letter/{regNo}", name="lettershow")
   */
  public function showAction(Request $request, $regNo)
  {
    $letter = $this->getDoctrine()
    ->getRepository('AppBundle:Letter')->findOneByRegNo($regNo);
    if (!$letter) {
      throw $this->createNotFoundException('No letter found for regNo '.$regNo);
    }
    return $this->render('letter/show.html.twig', array('letter' => $letter));
  }
}
