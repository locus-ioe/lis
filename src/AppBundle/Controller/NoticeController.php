<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// User-defined classes
use AppBundle\Entity\Notice;

class NoticeController extends BaseController
{
    // Show Notice Index Page
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

    // Show the notice-create form
    /**
     * @Route("/notice/create", name="noticecreate")
     * @Method({"GET", "HEAD"})
     */
    public function createAction(Request $request)
    {
        return $this->render('notice/create.html.twig', array('title' => 'Create'));
    }

    // Show the notice-edit form
    /**
     * @Route("/notice/edit/{id}", name="noticeedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $id)
    {
        return $this->render('notice/create.html.twig', array('title' => 'Edit'));
    }

    // Display the specified notice
    /**
     * @Route("/notice/delete/{id}", name="noticedelete", requirements={"page": "\d+"})
     */
    public function deleteAction(Request $request, $id)
    {
        return new Response('<html><title>Delete Notice</title><body><h1>Delete Notice <small><i>with id ' .$id. '</i></small></h1></body></html>');
    }

    // Display the specified notice
    /**
     * @Route("/notice/{id}", name="noticeshow")
     */
    public function showAction(Request $request, $id)
    {
        $notice = $this->getDoctrine()
        ->getRepository('AppBundle:Notice')->find($id);
        if (!$notice) {
            throw $this->createNotFoundException('No notice found for id '.$id);
        }
        return $this->render('notice/show.html.twig', array('notice' => $notice));
    }
}
