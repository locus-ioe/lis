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
use AppBundle\Entity\Theme;
use AppBundle\Form\Type\ThemeType;

class ThemeController extends BaseController
{
  /**
   * @Route("/theme", name="themepage")
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $themes = $em
    ->getRepository('AppBundle:Theme')->findall();
    if (!$themes) {
      return $this->redirectToRoute('themecreate', array());
    }
    return $this->render('theme/index.html.twig', array('themes' => $themes));
  }

  /**
   * @Route("/theme/create", name="themecreate")
   */
  public function createAction(Request $request)
  {
    $theme = new Theme();
    $form = $this->createForm(ThemeType::class, $theme, array('forupdate' => false));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $toSlugify = $theme->getName().' '.$theme->getExhibition()->getYear()->format('Y');
      $theme->setSlug($this->get('app.slugger')->slugify($toSlugify));
      $em = $this->getDoctrine()->getManager();
      $em->persist($theme);
      $em->flush();
      return $this->redirectToRoute('themeshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('theme/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/theme/{slug}/edit", name="themeedit")
   */
  public function editAction(Request $request, $slug)
  {
    $theme = $this->getDoctrine()
      ->getRepository('AppBundle:Theme')->findOneBySlug($slug);
    $form = $this->createForm(ThemeType::class, $theme, array('forupdate' => true));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $toSlugify = $theme->getName().' '.$theme->getExhibition()->getYear()->format('Y');
      $theme->setSlug($this->get('app.slugger')->slugify($toSlugify));
      $em = $this->getDoctrine()->getManager();
      $em->persist($theme);
      $em->flush();
      return $this->redirectToRoute('themeshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('theme/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/theme/{slug}/delete", name="themedelete")
   */
  public function deleteAction(Request $request, $slug)
  {
    return new Response('<html><title>Delete theme</title><body><h1>Delete theme <small><i>with slug ' .$slug. '</i></small></h1></body></html>');
  }

  /**
   * @Route("/theme/{slug}", name="themeshow")
   */
  public function showAction(Request $request, $slug)
  {
    $theme = $this->getDoctrine()
    ->getRepository('AppBundle:Theme')->findOneBySlug($slug);
    if (!$theme) {
      throw $this->createNotFoundException('No theme found for slug '.$slug);
    }
    return $this->render('theme/show.html.twig', array('theme' => $theme));
  }
}
