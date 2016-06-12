<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// User-defined classes
use AppBundle\Entity\Project;

class ProjectController extends BaseController
{
    // Show Project Index Page
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

    // Show the project-create form
    /**
     * @Route("/project/create", name="projectcreate")
     * @Method({"GET", "HEAD"})
     */
    public function createAction(Request $request)
    {
        return $this->render('project/create.html.twig', array('title' => 'Create'));
    }

    // Show the project-edit form
    /**
     * @Route("/project/edit/{id}", name="projectedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $id)
    {
        return $this->render('project/create.html.twig', array('title' => 'Edit'));
    }

    // Display the specified project
    /**
     * @Route("/project/delete/{id}", name="projectdelete", requirements={"page": "\d+"})
     */
    public function deleteAction(Request $request, $id)
    {
        return new Response('<html><title>Delete Project</title><body><h1>Delete Project <small><i>with id ' .$id. '</i></small></h1></body></html>');
    }

    // Display the specified project
    /**
     * @Route("/project/{id}", name="projectshow")
     */
    public function showAction(Request $request, $id)
    {
        $project = $this->getDoctrine()
        ->getRepository('AppBundle:Project')->find($id);
        if (!$project) {
            throw $this->createNotFoundException('No project found for id '.$id);
        }
        return $this->render('project/show.html.twig', array('project' => $project));
    }
}
