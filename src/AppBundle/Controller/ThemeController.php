<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// User-defined classes
use AppBundle\Entity\Theme;

class ThemeController extends BaseController
{
    // Show Theme Index Page
    /**
     * @Route("/theme", name="themepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $themes = $em
        ->getRepository('AppBundle:Theme')->findall();
        if (!$themes) {
            return $this->redirectToRoute('themecreate', array());
        }
        return $this->render('theme/index.html.twig', array('themes' => $themes));
    }

    // Show the theme-create form
    /**
     * @Route("/theme/create", name="themecreate")
     * @Method({"GET", "HEAD"})
     */
    public function createAction(Request $request)
    {
        return $this->render('theme/create.html.twig', array('title' => 'Create'));
    }

    // Show the theme-edit form
    /**
     * @Route("/theme/edit/{id}", name="themeedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $id)
    {
        return $this->render('theme/create.html.twig', array('title' => 'Edit'));
    }

    // Display the specified theme
    /**
     * @Route("/theme/delete/{id}", name="themedelete", requirements={"page": "\d+"})
     */
    public function deleteAction(Request $request, $id)
    {
        return new Response('<html><title>Delete Theme</title><body><h1>Delete Theme <small><i>with id ' .$id. '</i></small></h1></body></html>');
    }

    // Display the specified theme
    /**
     * @Route("/theme/{id}", name="themeshow")
     */
    public function showAction(Request $request, $id)
    {
        $theme = $this->getDoctrine()
        ->getRepository('AppBundle:Theme')->find($id);
        if (!$theme) {
            throw $this->createNotFoundException('No theme found for id '.$id);
        }
        return $this->render('theme/show.html.twig', array('theme' => $theme));
    }
}
