<?php

namespace AppBundle\Controller;
// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Symfony form
use AppBundle\Form\Type\PrivilegeType;

// User-defined classes
use AppBundle\Entity\Privilege;

class PrivilegeController extends BaseController
{
    // Show Privilege Index Page
    /**
     * @Route("/privilege", name="privilegepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $privileges = $em
        ->getRepository('AppBundle:Privilege')->findall();
        if (!$privileges) {
            return $this->redirectToRoute('privilegecreate', array());
            // throw $this->createNotFoundException('No privilege found');
        }
        return $this->render('privilege/index.html.twig', array('privileges' => $privileges));
    }

    // Show the privilege-create form
    /**
     * @Route("/privilege/create", name="privilegecreate")
     * @Method({"GET", "HEAD"})
     */
    public function createAction(Request $request)
    {
        $privilege = new Privilege();
        $form = $this->createForm(PrivilegeType::class, $privilege, array('forupdate' => false));
        return $this->render('privilege/create.html.twig', array('form' => $form->createView(), 'title' => 'Create'));
    }

    // Handle the create form and store created privilege
    /**
     * @Route("/privilege/create", name="privilegestore")
     * @Method("POST")
     */
    public function storeAction(Request $request)
    {
        $privilege = new Privilege();
        $form = $this->createForm(PrivilegeType::class, $privilege, array('forupdate' => false));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $this->get('app.slugger')->slugify($privilege->getName());
            $privilege->setSlug($slug);
            $em = $this->getDoctrine()->getManager();
            $em->persist($privilege);
            $em->flush();
            return $this->render('privilege/show.html.twig', array('privilege' => $privilege));
        }
        return $this->render('privilege/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
    }

    // Show the privilege-edit form
    /**
     * @Route("/privilege/edit/{slug}", name="privilegeedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $slug)
    {
        $privilege = $this->getDoctrine()
        ->getRepository('AppBundle:Privilege')->findOneBySlug($slug);
        if (!$privilege) {
            throw $this->createNotFoundException('No privilege found for id '.$slug);
        }
        $form = $this->createForm(PrivilegeType::class, $privilege, array('forupdate' => true));
        return $this->render('privilege/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit'));
    }

    // Handle the create form and store created privilege
    /**
     * @Route("/privilege/edit/{slug}", name="privilegeupdate")
     * @Method("POST")
     */
    public function updateAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $privilege = $em->getRepository('AppBundle:Privilege')->findOneBySlug($slug);
        if (!$privilege) {
            throw $this->createNotFoundException('No privilege found for id '.$slug);
        }
        $form = $this->createForm(PrivilegeType::class, $privilege, array('forupdate' => true));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $slug = $this->get('app.slugger')->slugify($privilege->getName());
            $privilege->setSlug($slug);
            $em->flush();
            return $this->render('privilege/show.html.twig', array('privilege' => $privilege));
        }
        return $this->render('privilege/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit'));
    }

    // Display the specified privilege
    /**
     * @Route("/privilege/delete/{slug}", name="privilegedelete")
     */
    public function deleteAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $privilege = $em
        ->getRepository('AppBundle:Privilege')->findOneBySlug($slug);
        if (!$privilege) {
            throw $this->createNotFoundException('No privilege found for id '.$slug);
        }
        $em->remove($privilege);
        $em->flush();
        return $this->render('privilege/index.html.twig', array('message' => 'Privilege with slug = '.$slug.' deleted'));
    }

    // Display the specified privilege
    /**
     * @Route("/privilege/{slug}", name="privilegeshow")
     */
    public function showAction(Request $request, $slug)
    {
        $privilege = $this->getDoctrine()
        ->getRepository('AppBundle:Privilege')->findOneBySlug($slug);
        if (!$privilege) {
            throw $this->createNotFoundException('No privilege found for id '.$slug);
        }
        return $this->render('privilege/show.html.twig', array('privilege' => $privilege));
    }
}
