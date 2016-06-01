<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Symfony form
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

// User-defined classes
use AppBundle\Entity\Advisor;
use AppBundle\Entity\Member;

class AdvisorController extends Controller
{
    // Show Advisor Index Page
    /**
     * @Route("/advisor", name="advisorpage")
     */
    public function indexAction(Request $request)
    {
        return new Response('<p>Home page for advisors.</p>');
    }

    // Handle Advisor Create Form Submission
    /**
    * @Route("/advisor/create", name="advisorcreatepost")
    * @Method("POST")
    */
    public function createAction(Request $request)
    {
        return new Response ('<p>Handle Advisor Create Form Submission.</p>');
    }

    // Show Advisor Profile Page
    /**
     * @Route("/advisor/{id}", name="advisorshow", defaults={"id" = 1}, requirements={"id": "\d+"})
     * @Method({"GET","HEAD"})
     */
    public function showAction(Request $request, $id)
    {
        return new Response ('<p>Individual advisor page.</p>');
    }

    // Handle Advisor Update Form
    /**
     * @Route("/advisor/edit/{id}", name="advisoredit", defaults={"id" = 1}, requirements={"id": "\d+"})
     * @Method("PUT")
     */
    public function editAction(Request $request, $id)
    {
        return new Response ('<p>Edit an advisor.</p>');
    }

    // Handle Advisor Delete Form Submission
    /**
     * @Route("/advisor/delete/{id}", name="advisordelete", defaults={"id" = 1}, requirements={"id": "\d+"})
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        return new Response ('<p>Delete an advisor.</p>');
    }

    // Show Advisor Create Form
    /**
     * @Route("/advisor/create", name="advisorcreate")
     */
    public function drawFormAction(Request $request)
    {
        $advisor = new Advisor();

        $advisor->setMemberId(1);
        $advisor->setPost("Coordinator");
        $form = $this->createFormBuilder($advisor)
        ->add('memberId', TextType::class)
        ->add('post', TextType::class)
        ->add('save', SubmitType::class, array('label' => 'Create Advisor'))
        ->getForm();
        return $this->render('default/new.html.twig', array('form' => $form->createView(),
        ));
    }
}
