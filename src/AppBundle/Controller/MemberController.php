<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// User-defined classes
use AppBundle\Entity\Member;

class MemberController extends BaseController
{
    // Show Member Index Page
    /**
     * @Route("/member", name="memberpage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $members = $em
        ->getRepository('AppBundle:Member')->findall();
        if (!$members) {
            return $this->redirectToRoute('membercreate', array());
        }
        return $this->render('member/index.html.twig', array('members' => $members));
    }

    // Show the member-create form
    /**
     * @Route("/member/create", name="membercreate")
     * @Method({"GET", "HEAD"})
     */
    public function createAction(Request $request)
    {
        return $this->render('member/create.html.twig', array('title' => 'Create'));
    }

    // Show the member-edit form
    /**
     * @Route("/member/edit/{username}", name="memberedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $username)
    {
        return $this->render('member/create.html.twig', array('title' => 'Edit'));
    }

    // Display the specified member
    /**
     * @Route("/member/delete/{username}", name="memberdelete", requirements={"page": "\d+"})
     */
    public function deleteAction(Request $request, $username)
    {
        return new Response('<html><title>Delete Member</title><body><h1>Delete Member <small><i>with username ' .$username. '</i></small></h1></body></html>');
    }

    // Display the specified member
    /**
     * @Route("/member/{username}", name="membershow")
     */
    public function showAction(Request $request, $username)
    {
        $member = $this->getDoctrine()
        ->getRepository('AppBundle:Member')->findOneByUsername($username);
        if (!$member) {
            throw $this->createNotFoundException('No member found for username '.$username);
        }
        return $this->render('member/show.html.twig', array('member' => $member));
    }
}
