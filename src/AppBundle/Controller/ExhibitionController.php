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
            $year = $exhibition->getYear()->format('Y');
            $slug = 'Locus ' . $year;
            $slug = $this->get('app.slugger')->slugify($slug);
            $exhibition->setSlug($slug);
            $em = $this->getDoctrine()->getManager();
            $em->persist($exhibition);
            $em->flush();
            return $this->render('exhibition/show.html.twig', array('exhibition' => $exhibition));
        }
        return $this->render('exhibition/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
    }

    // Show the exhibition-edit form
    /**
     * @Route("/exhibition/edit/{slug}", name="exhibitionedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $slug)
    {
        $exhibition = $this->getDoctrine()
        ->getRepository('AppBundle:Exhibition')->findOneBySlug($slug);
        if (!$exhibition) {
            throw $this->createNotFoundException('No exhibition found for id '.$slug);
        }
        $form = $this->createForm(ExhibitionType::class, $exhibition, array('forupdate' => true));
        return $this->render('exhibition/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit'));
    }

    // Handle the create form and store created exhibition
    /**
     * @Route("/exhibition/edit/{slug}", name="exhibitionupdate")
     * @Method("POST")
     */
    public function updateAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $exhibition = $em->getRepository('AppBundle:Exhibition')->findOneBySlug($slug);
        if (!$exhibition) {
            throw $this->createNotFoundException('No exhibition found for id '.$slug);
        }
        $form = $this->createForm(ExhibitionType::class, $exhibition, array('forupdate' => true));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $year = $exhibition->getYear()->format('Y');
            $slug = 'Locus ' . $year;
            $slug = $this->get('app.slugger')->slugify($slug);
            $exhibition->setSlug($slug);
            $em->flush();
            return $this->render('exhibition/show.html.twig', array('exhibition' => $exhibition));
        }
        return $this->render('exhibition/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit'));
    }

    // Display the specified exhibition
    /**
     * @Route("/exhibition/delete/{slug}", name="exhibitiondelete")
     */
    public function deleteAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $exhibition = $em
        ->getRepository('AppBundle:Exhibition')->findOneBySlug($slug);
        if (!$exhibition) {
            throw $this->createNotFoundException('No exhibition found for id '.$slug);
        }
        $em->remove($exhibition);
        $em->flush();
        return $this->render('exhibition/index.html.twig', array('message' => 'Exhibition with slug = '.$slug.' deleted'));
    }

    // Display the specified exhibition
    /**
     * @Route("/exhibition/{slug}", name="exhibitionshow")
     */
    public function showAction(Request $request, $slug)
    {
        $exhibition = $this->getDoctrine()
        ->getRepository('AppBundle:Exhibition')->findOneBySlug($slug);
        if (!$exhibition) {
            throw $this->createNotFoundException('No exhibition found for id '.$slug);
        }
        return $this->render('exhibition/show.html.twig', array('exhibition' => $exhibition));
    }
}
