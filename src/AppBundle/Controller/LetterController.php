<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// User-defined classes
use AppBundle\Entity\Letter;

class LetterController extends BaseController
{
    // Show Letter Index Page
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

    // Show the letter-create form
    /**
     * @Route("/letter/create", name="lettercreate")
     * @Method({"GET", "HEAD"})
     */
    public function createAction(Request $request)
    {
        return $this->render('letter/create.html.twig', array('title' => 'Create'));
    }

    // Show the letter-edit form
    /**
     * @Route("/letter/edit/{id}", name="letteredit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $id)
    {
        return $this->render('letter/create.html.twig', array('title' => 'Edit'));
    }

    // Display the specified letter
    /**
     * @Route("/letter/delete/{id}", name="letterdelete", requirements={"page": "\d+"})
     */
    public function deleteAction(Request $request, $id)
    {
        return new Response('<html><title>Delete Letter</title><body><h1>Delete Letter <small><i>with id ' .$id. '</i></small></h1></body></html>');
    }

    // Display the specified letter
    /**
     * @Route("/letter/{id}", name="lettershow")
     */
    public function showAction(Request $request, $id)
    {
        $letter = $this->getDoctrine()
        ->getRepository('AppBundle:Letter')->find($id);
        if (!$letter) {
            throw $this->createNotFoundException('No letter found for id '.$id);
        }
        return $this->render('letter/show.html.twig', array('letter' => $letter));
    }
}
