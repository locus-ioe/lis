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
use AppBundle\Entity\Notice;
use AppBundle\Form\Type\NoticeType;

class NoticeController extends BaseController
{
  /**
   * @Route("/notice", name="noticepage")
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $notices = $em
    ->getRepository('AppBundle:Notice')->findall();
    if (!$notices) {
      return $this->redirectToRoute('noticecreate', array());
    }
    return $this->render('notice/index.html.twig', array('notices' => $notices));
  }

  /**
   * @Route("/notice/create", name="noticecreate")
   */
  public function createAction(Request $request)
  {
    $notice = new Notice();
    $form = $this->createForm(NoticeType::class, $notice, array('forupdate' => false));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $toSlugify = $notice->getSubject(). ' '.$notice->getDate()->format('M d Y');
      $notice->setSlug($this->get('app.slugger')->slugify($toSlugify));
      $em = $this->getDoctrine()->getManager();
      $em->persist($notice);
      $em->flush();
      return $this->redirectToRoute('noticeshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('notice/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/notice/{slug}/edit", name="noticeedit")
   */
  public function editAction(Request $request, $slug)
  {
    $notice = $this->getDoctrine()
      ->getRepository('AppBundle:Notice')->findOneBySlug($slug);
    $form = $this->createForm(NoticeType::class, $notice, array('forupdate' => true));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $toSlugify = $notice->getSubject(). ' '.$notice->getDate()->format('M d Y');
      $notice->setSlug($this->get('app.slugger')->slugify($toSlugify));
      $em = $this->getDoctrine()->getManager();
      $em->persist($notice);
      $em->flush();
      return $this->redirectToRoute('noticeshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('notice/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/notice/{slug}/delete", name="noticedelete")
   */
  public function deleteAction(Request $request, $slug)
  {
    return new Response('<html><title>Delete notice</title><body><h1>Delete notice <small><i>with slug ' .$slug. '</i></small></h1></body></html>');
  }

  /**
   * @Route("/notice/{slug}", name="noticeshow")
   */
  public function showAction(Request $request, $slug)
  {
    $notice = $this->getDoctrine()
    ->getRepository('AppBundle:Notice')->findOneBySlug($slug);
    if (!$notice) {
      throw $this->createNotFoundException('No notice found for slug '.$slug);
    }
    return $this->render('notice/show.html.twig', array('notice' => $notice));
  }
}
