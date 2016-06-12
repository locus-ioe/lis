<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// User-defined classes
use AppBundle\Entity\Committee;

class CommitteeController extends BaseController
{
    // Show Committee Index Page
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

    // Show the committee-create form
    /**
     * @Route("/committee/create", name="committeecreate")
     * @Method({"GET", "HEAD"})
     */
    public function createAction(Request $request)
    {
        return $this->render('committee/create.html.twig', array('title' => 'Create'));
    }

    // Show the committee-edit form
    /**
     * @Route("/committee/edit/{id}", name="committeeedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $id)
    {
        return $this->render('committee/create.html.twig', array('title' => 'Edit'));
    }

    // Display the specified committee
    /**
     * @Route("/committee/delete/{id}", name="committeedelete", requirements={"page": "\d+"})
     */
    public function deleteAction(Request $request, $id)
    {
        return new Response('<html><title>Delete Committee</title><body><h1>Delete Committee <small><i>with id ' .$id. '</i></small></h1></body></html>');
    }

    // Display the specified committee
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
