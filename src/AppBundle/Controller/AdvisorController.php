<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// User-defined classes
use AppBundle\Entity\Advisor;

class AdvisorController extends BaseController
{
    // Show Advisor Index Page
    /**
     * @Route("/advisor", name="advisorpage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $advisors = $em
        ->getRepository('AppBundle:Advisor')->findall();
        if (!$advisors) {
            return $this->redirectToRoute('advisorcreate', array());
        }
        return $this->render('advisor/index.html.twig', array('advisors' => $advisors));
    }

    // Show the advisor-create form
    /**
     * @Route("/advisor/create", name="advisorcreate")
     * @Method({"GET", "HEAD"})
     */
    public function createAction(Request $request)
    {
        return $this->render('advisor/create.html.twig', array('title' => 'Create'));
    }

    // Show the advisor-edit form
    /**
     * @Route("/advisor/edit/{id}", name="advisoredit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $id)
    {
        return $this->render('advisor/create.html.twig', array('title' => 'Edit'));
    }

    // Display the specified advisor
    /**
     * @Route("/advisor/delete/{id}", name="advisordelete", requirements={"page": "\d+"})
     */
    public function deleteAction(Request $request, $id)
    {
        return new Response('<html><title>Delete Advisor</title><body><h1>Delete Advisor <small><i>with id ' .$id. '</i></small></h1></body></html>');
    }

    // Display the specified advisor
    /**
     * @Route("/advisor/{id}", name="advisorshow")
     */
    public function showAction(Request $request, $id)
    {
        $advisor = $this->getDoctrine()
        ->getRepository('AppBundle:Advisor')->find($id);
        if (!$advisor) {
            throw $this->createNotFoundException('No advisor found for id '.$id);
        }
        return $this->render('advisor/show.html.twig', array('advisor' => $advisor));
    }
}
