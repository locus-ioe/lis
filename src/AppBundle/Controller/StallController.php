<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// User-defined classes
use AppBundle\Entity\Stall;

class StallController extends BaseController
{
    // Show Stall Index Page
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

    // Show the stall-create form
    /**
     * @Route("/stall/create", name="stallcreate")
     * @Method({"GET", "HEAD"})
     */
    public function createAction(Request $request)
    {
        return $this->render('stall/create.html.twig', array('title' => 'Create'));
    }

    // Show the stall-edit form
    /**
     * @Route("/stall/edit/{id}", name="stalledit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $id)
    {
        return $this->render('stall/create.html.twig', array('title' => 'Edit'));
    }

    // Display the specified stall
    /**
     * @Route("/stall/delete/{id}", name="stalldelete", requirements={"page": "\d+"})
     */
    public function deleteAction(Request $request, $id)
    {
        return new Response('<html><title>Delete Stall</title><body><h1>Delete Stall <small><i>with id ' .$id. '</i></small></h1></body></html>');
    }

    // Display the specified stall
    /**
     * @Route("/stall/{id}", name="stallshow")
     */
    public function showAction(Request $request, $id)
    {
        $stall = $this->getDoctrine()
        ->getRepository('AppBundle:Stall')->find($id);
        if (!$stall) {
            throw $this->createNotFoundException('No stall found for id '.$id);
        }
        return $this->render('stall/show.html.twig', array('stall' => $stall));
    }
}
