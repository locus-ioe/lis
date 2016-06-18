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
use AppBundle\Entity\Member;
use AppBundle\Form\Type\MemberType;

class MemberController extends BaseController
{
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

  /**
   * @Route("/member/create", name="membercreate")
   */
  public function createAction(Request $request)
  {
    $member = new Member();
    $form = $this->createForm(MemberType::class, $member, array('forupdate' => false));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($member);
      $em->flush();
      return $this->redirectToRoute('membershow', array('username' => $form->getData()->getUsername()));
    }
    return $this->render('member/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/member/{username}/edit", name="memberedit")
   */
  public function editAction(Request $request, $username)
  {
    $member = $this->getDoctrine()
      ->getRepository('AppBundle:Member')->findOneByUsername($username);
    $form = $this->createForm(MemberType::class, $member, array('forupdate' => true));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($member);
      $em->flush();
      return $this->redirectToRoute('membershow', array('username' => $username));
    }
    return $this->render('member/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/member/{username}/delete", name="memberdelete")
   */
  public function deleteAction(Request $request, $username)
  {
    return new Response('<html><title>Delete member</title><body><h1>Delete member <small><i>with username ' .$username. '</i></small></h1></body></html>');
  }

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
