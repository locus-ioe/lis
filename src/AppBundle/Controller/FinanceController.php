<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// User-defined classes
use AppBundle\Entity\Finance;

class FinanceController extends BaseController
{
    // Show Finance Index Page
    /**
     * @Route("/finance", name="financepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $finances = $em
        ->getRepository('AppBundle:Finance')->findall();
        if (!$finances) {
            return $this->redirectToRoute('financecreate', array());
        }
        return $this->render('finance/index.html.twig', array('finances' => $finances));
    }

    // Show the finance-create form
    /**
     * @Route("/finance/create", name="financecreate")
     * @Method({"GET", "HEAD"})
     */
    public function createAction(Request $request)
    {
        return $this->render('finance/create.html.twig', array('title' => 'Create'));
    }

    // Show the finance-edit form
    /**
     * @Route("/finance/edit/{id}", name="financeedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $id)
    {
        return $this->render('finance/create.html.twig', array('title' => 'Edit'));
    }

    // Display the specified finance
    /**
     * @Route("/finance/delete/{id}", name="financedelete", requirements={"page": "\d+"})
     */
    public function deleteAction(Request $request, $id)
    {
        return new Response('<html><title>Delete Finance</title><body><h1>Delete Finance <small><i>with id ' .$id. '</i></small></h1></body></html>');
    }

    // Display the specified finance
    /**
     * @Route("/finance/{id}", name="financeshow")
     */
    public function showAction(Request $request, $id)
    {
        $finance = $this->getDoctrine()
        ->getRepository('AppBundle:Finance')->find($id);
        if (!$finance) {
            throw $this->createNotFoundException('No finance found for id '.$id);
        }
        return $this->render('finance/show.html.twig', array('finance' => $finance));
    }
}
