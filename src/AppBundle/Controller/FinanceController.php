<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// User-defined classes
use AppBundle\Entity\Finance;

class FinanceController extends BaseController
{
    // Show Finance Index Page
    /**
     * @Route("/finance", name="financepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
}
