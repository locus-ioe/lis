<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Advisor;

class AdvisorController extends Controller
{
    /**
     * @Route("/advisor", name="advisorpage")
     */
    public function indexAction(Request $request)
    {
        return new Response('<p>Home page for advisors.</p>');
    }

    /**
    * @Route("/advisor/create", name="advisorcreatepost")
    * @Method("POST")
    */
    public function createAction(Request $request)
    {
        $advisor = new Advisor();

        $form = $this->createFormBuilder($advisor)
        ->add('memberId', TextType::class)
        ->add('post', TextType::class)
        ->add('save', SubmitType::class, array('label' => 'Create Advisor'))->getForm();

        $data = $form->getData();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() ){
            return new Response ('<p>Submitted Data:</p> <p>'.$data->getMemberId().'<br>'.$data->getPost().'</p>');
        }

        return new Response ('<p>Submission unsuccessful.</p>');
    }

    /**
     * @Route("/advisor/{id}", name="advisorshow", defaults={"id" = 1}, requirements={"id": "\d+"})
     * @Method({"GET","HEAD"})
     */
    public function showAction(Request $request, $id)
    {
        return new Response ('<p>Individual advisor page.</p>');
    }

    /**
     * @Route("/advisor/edit/{id}", name="advisoredit", defaults={"id" = 1}, requirements={"id": "\d+"})
     * @Method("PUT")
     */
    public function editAction(Request $request, $id)
    {
        return new Response ('<p>Edit an advisor.</p>');
    }

    /**
     * @Route("/advisor/delete/{id}", name="advisordelete", defaults={"id" = 1}, requirements={"id": "\d+"})
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        return new Response ('<p>Delete an advisor.</p>');
    }

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
