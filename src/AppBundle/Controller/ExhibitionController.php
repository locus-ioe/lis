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
use AppBundle\Form\Type\ExhibitionType;
// User-defined classes
use AppBundle\Entity\Exhibition;

class ExhibitionController extends Controller
{
    // Show Exhibition Index Page
    /**
     * @Route("/exhibition", name="exhibitionpage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $exhibitions = $em
        ->getRepository('AppBundle:Exhibition')->findall();
        if (!$exhibitions) {
            throw $this->createNotFoundException('No exhibition found');
        }
        return $this->render('exhibition/index.html.twig', array('exhibitions' => $exhibitions));
    }

    // Show the exhibition-create form
    /**
     * @Route("/exhibition/create", name="exhibitioncreate")
     * @Method({"GET", "HEAD"})
     */
    public function createAction(Request $request)
    {
        $exhibition = new Exhibition();
        $form = $this->createForm(ExhibitionType::class, $exhibition, array('forupdate' => false));
        return $this->render('exhibition/create.html.twig', array('form' => $form->createView(), 'title' => 'Create'));
    }

    // Handle the create form and store created exhibition
    /**
     * @Route("/exhibition/create", name="exhibitionstore")
     * @Method("POST")
     */
    public function storeAction(Request $request)
    {
        $exhibition = new Exhibition();
        $form = $this->createForm(ExhibitionType::class, $exhibition, array('forupdate' => false));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($exhibition);
            $em->flush();
            return $this->render('exhibition/show.html.twig', array('exhibition' => $exhibition));
        }
        return $this->render('exhibition/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
    }

    // Show the exhibition-edit form
    /**
     * @Route("/exhibition/edit/{exhibitionId}", name="exhibitionedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $exhibitionId)
    {
        $exhibition = $this->getDoctrine()
        ->getRepository('AppBundle:Exhibition')->find($exhibitionId);
        if (!$exhibition) {
            throw $this->createNotFoundException('No exhibition found for id '.$exhibitionId);
        }
        $form = $this->createForm(ExhibitionType::class, $exhibition, array('forupdate' => true));
        return $this->render('exhibition/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit'));
    }

    // Handle the create form and store created exhibition
    /**
     * @Route("/exhibition/edit/{exhibitionId}", name="exhibitionupdate")
     * @Method("POST")
     */
    public function updateAction(Request $request, $exhibitionId)
    {
        $em = $this->getDoctrine()->getManager();
        $exhibition = $em->getRepository('AppBundle:Exhibition')->find($exhibitionId);
        $form = $this->createForm(ExhibitionType::class, $exhibition, array('forupdate' => true));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            if (!$exhibition) {
                throw $this->createNotFoundException('No exhibition found for id '.$exhibitionId);
                $em->flush();
                return $this->render('exhibition/show.html.twig', array('exhibition' => $exhibition));
            }
        }
        return $this->render('exhibition/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit'));
    }

    // Display the specified exhibition
    /**
     * @Route("/exhibition/delete/{exhibitionId}", name="exhibitiondelete", requirements={"page": "\d+"})
     */
    public function deleteAction(Request $request, $exhibitionId)
    {
        $em = $this->getDoctrine()->getManager();
        $exhibition = $em
        ->getRepository('AppBundle:Exhibition')->find($exhibitionId);
        if (!$exhibition) {
            throw $this->createNotFoundException('No exhibition found for id '.$exhibitionId);
        }
        $em->remove($exhibition);
        $em->flush();
        return $this->render('exhibition/index.html.twig', array('message' => 'Exhibition with exhibitionId = '.$exhibitionId.' deleted'));
    }

    // Display the specified exhibition
    /**
     * @Route("/exhibition/{exhibitionId}", name="exhibitionshow", requirements={"page": "\d+"})
     */
    public function showAction(Request $request, $exhibitionId)
    {
        $exhibition = $this->getDoctrine()
        ->getRepository('AppBundle:Exhibition')->find($exhibitionId);
        if (!$exhibition) {
            throw $this->createNotFoundException('No exhibition found for id '.$exhibitionId);
        }
        return $this->render('exhibition/show.html.twig', array('exhibition' => $exhibition));
    }
}
