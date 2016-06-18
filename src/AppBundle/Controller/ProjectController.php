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
use AppBundle\Entity\Project;
use AppBundle\Form\Type\ProjectType;

class ProjectController extends BaseController
{
  /**
   * @Route("/project", name="projectpage")
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $projects = $em
    ->getRepository('AppBundle:Project')->findall();
    if (!$projects) {
      return $this->redirectToRoute('projectcreate', array());
    }
    return $this->render('project/index.html.twig', array('projects' => $projects));
  }

  /**
   * @Route("/project/create", name="projectcreate")
   */
  public function createAction(Request $request)
  {
    $project = new Project();
    $form = $this->createForm(ProjectType::class, $project, array('forupdate' => false));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $toSlugify = $project->getTitle(). ' '.$project->getStall()->getExhibition()->getYear()->format('Y');
      $project->setSlug($this->get('app.slugger')->slugify($toSlugify));
      $em = $this->getDoctrine()->getManager();
      $em->persist($project);
      $em->flush();
      return $this->redirectToRoute('projectshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('project/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/project/{slug}/edit", name="projectedit")
   */
  public function editAction(Request $request, $slug)
  {
    $project = $this->getDoctrine()
      ->getRepository('AppBundle:Project')->findOneBySlug($slug);
    $form = $this->createForm(ProjectType::class, $project, array('forupdate' => true));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $toSlugify = $project->getTitle(). ' '.$project->getStall()->getExhibition()->getYear()->format('Y');
      $project->setSlug($this->get('app.slugger')->slugify($toSlugify));
      $em = $this->getDoctrine()->getManager();
      $em->persist($project);
      $em->flush();
      return $this->redirectToRoute('projectshow', array('slug' => $form->getData()->getSlug()));
    }
    return $this->render('project/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/project/{slug}/delete", name="projectdelete")
   */
  public function deleteAction(Request $request, $slug)
  {
    return new Response('<html><title>Delete project</title><body><h1>Delete project <small><i>with slug ' .$slug. '</i></small></h1></body></html>');
  }

  /**
   * @Route("/project/{slug}", name="projectshow")
   */
  public function showAction(Request $request, $slug)
  {
    $project = $this->getDoctrine()
    ->getRepository('AppBundle:Project')->findOneBySlug($slug);
    if (!$project) {
      throw $this->createNotFoundException('No project found for slug '.$slug);
    }
    return $this->render('project/show.html.twig', array('project' => $project));
  }
}
