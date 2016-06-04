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
use AppBundle\Form\Type\InstitutionType;
// User-defined classes
use AppBundle\Entity\Institution;

class InstitutionController extends Controller
{
    // Show Institution Index Page
    /**
     * @Route("/institution", name="institutionpage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $institutions = $em
        ->getRepository('AppBundle:Institution')->findall();
        if (!$institutions) {
            throw $this->createNotFoundException('No institution found');
        }
        return $this->render('institution/index.html.twig', array('institutions' => $institutions));
    }

    // Show the institution-create form
    /**
     * @Route("/institution/create", name="institutioncreate")
     * @Method({"GET", "HEAD"})
     */
    public function createAction(Request $request)
    {
        $institution = new Institution();
        $form = $this->createForm(InstitutionType::class, $institution, array('forupdate' => false));
        return $this->render('institution/create.html.twig', array('form' => $form->createView(), 'title' => 'Create'));
    }

    // Handle the create form and store created institution
    /**
     * @Route("/institution/create", name="institutionstore")
     * @Method("POST")
     */
    public function storeAction(Request $request)
    {
        $institution = new Institution();
        $form = $this->createForm(InstitutionType::class, $institution, array('forupdate' => false));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($institution);
            $em->flush();
            return $this->render('institution/show.html.twig', array('institution' => $institution));
        }
        return $this->render('institution/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
    }

    // Show the institution-edit form
    /**
     * @Route("/institution/edit/{institutionId}", name="institutionedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $institutionId)
    {
        $institution = $this->getDoctrine()
        ->getRepository('AppBundle:Institution')->find($institutionId);
        if (!$institution) {
            throw $this->createNotFoundException('No institution found for id '.$institutionId);
        }
        $form = $this->createForm(InstitutionType::class, $institution, array('forupdate' => true));
        return $this->render('institution/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit'));
    }

    // Handle the create form and store created institution
    /**
     * @Route("/institution/edit/{institutionId}", name="institutionupdate")
     * @Method("POST")
     */
    public function updateAction(Request $request, $institutionId)
    {
        $em = $this->getDoctrine()->getManager();
        $institution = $em->getRepository('AppBundle:Institution')->find($institutionId);
        $form = $this->createForm(InstitutionType::class, $institution, array('forupdate' => true));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            if (!$institution) {
                throw $this->createNotFoundException('No institution found for id '.$institutionId);
                $em->flush();
                return $this->render('institution/show.html.twig', array('institution' => $institution));
            }
        }
        return $this->render('institution/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit'));
    }

    // Display the specified institution
    /**
     * @Route("/institution/delete/{institutionId}", name="institutiondelete", requirements={"page": "\d+"})
     */
    public function deleteAction(Request $request, $institutionId)
    {
        $em = $this->getDoctrine()->getManager();
        $institution = $em
        ->getRepository('AppBundle:Institution')->find($institutionId);
        if (!$institution) {
            throw $this->createNotFoundException('No institution found for id '.$institutionId);
        }
        $em->remove($institution);
        $em->flush();
        return $this->render('institution/index.html.twig', array('message' => 'Institution with institutionId = '.$institutionId.' deleted'));
    }

    // Display the specified institution
    /**
     * @Route("/institution/{institutionId}", name="institutionshow", requirements={"page": "\d+"})
     */
    public function showAction(Request $request, $institutionId)
    {
        $institution = $this->getDoctrine()
        ->getRepository('AppBundle:Institution')->find($institutionId);
        if (!$institution) {
            throw $this->createNotFoundException('No institution found for id '.$institutionId);
        }
        return $this->render('institution/show.html.twig', array('institution' => $institution));
    }
}
