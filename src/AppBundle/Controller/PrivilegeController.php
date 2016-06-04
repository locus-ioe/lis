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
use AppBundle\Form\Type\PrivilegeType;
// User-defined classes
use AppBundle\Entity\Privilege;

class PrivilegeController extends Controller
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
            throw $this->createNotFoundException('No privilege found');
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
            $em = $this->getDoctrine()->getManager();
            $em->persist($privilege);
            $em->flush();
            return $this->render('privilege/show.html.twig', array('privilege' => $privilege));
        }
        return $this->render('privilege/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
    }

    // Show the privilege-edit form
    /**
     * @Route("/privilege/edit/{privilegeId}", name="privilegeedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $privilegeId)
    {
        $privilege = $this->getDoctrine()
        ->getRepository('AppBundle:Privilege')->find($privilegeId);
        if (!$privilege) {
            throw $this->createNotFoundException('No privilege found for id '.$privilegeId);
        }
        $form = $this->createForm(PrivilegeType::class, $privilege, array('forupdate' => true));
        return $this->render('privilege/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit'));
    }

    // Handle the create form and store created privilege
    /**
     * @Route("/privilege/edit/{privilegeId}", name="privilegeupdate")
     * @Method("POST")
     */
    public function updateAction(Request $request, $privilegeId)
    {
        $em = $this->getDoctrine()->getManager();
        $privilege = $em->getRepository('AppBundle:Privilege')->find($privilegeId);
        $form = $this->createForm(PrivilegeType::class, $privilege, array('forupdate' => true));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            if (!$privilege) {
                throw $this->createNotFoundException('No privilege found for id '.$privilegeId);
                $em->flush();
                return $this->render('privilege/show.html.twig', array('privilege' => $privilege));
            }
        }
        return $this->render('privilege/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit'));
    }

    // Display the specified privilege
    /**
     * @Route("/privilege/delete/{privilegeId}", name="privilegedelete", requirements={"page": "\d+"})
     */
    public function deleteAction(Request $request, $privilegeId)
    {
        $em = $this->getDoctrine()->getManager();
        $privilege = $em
        ->getRepository('AppBundle:Privilege')->find($privilegeId);
        if (!$privilege) {
            throw $this->createNotFoundException('No privilege found for id '.$privilegeId);
        }
        $em->remove($privilege);
        $em->flush();
        return $this->render('privilege/index.html.twig', array('message' => 'Privilege with privilegeId = '.$privilegeId.' deleted'));
    }

    // Display the specified privilege
    /**
     * @Route("/privilege/{privilegeId}", name="privilegeshow", requirements={"page": "\d+"})
     */
    public function showAction(Request $request, $privilegeId)
    {
        $privilege = $this->getDoctrine()
        ->getRepository('AppBundle:Privilege')->find($privilegeId);
        if (!$privilege) {
            throw $this->createNotFoundException('No privilege found for id '.$privilegeId);
        }
        return $this->render('privilege/show.html.twig', array('privilege' => $privilege));
    }
}
