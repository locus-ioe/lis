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
            throw $this->createNotFoundException('No exhibition found for id '.$exhibitionId);
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

        return $this->render('exhibition/create.html.twig', array('form' => $form->createView(),));
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

        return $this->render('exhibition/create.html.twig', array('form' => $form->createView(),));
    }

    // Show the exhibition-edit form
    /**
     * @Route("/exhibition/edit/{exhibitionId}", name="exhibitionedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $exhibitionId)
    {
        $exhibition = $this->getDoctrine()
        ->getRepository('AppBundle:Exhibition')
        ->find($exhibitionId);

        if (!$exhibition) {
            throw $this->createNotFoundException('No exhibition found for id '.$exhibitionId);
        }

        $form = $this->createForm(ExhibitionType::class, $exhibition, array('forupdate' => true));

        return $this->render('exhibition/create.html.twig', array('form' => $form->createView(),));
    }

    // Handle the create form and store created exhibition
    /**
     * @Route("/exhibition/edit/{exhibitionId}", name="exhibitionupdate")
     * @Method("POST")
     */
    public function updateAction(Request $request, $exhibitionId)
    {
        $exhibition = new Exhibition();

        $form = $this->createForm(ExhibitionType::class, $exhibition, array('forupdate' => true));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $fetched = $em
            ->getRepository('AppBundle:Exhibition')->find($exhibitionId);

            if (!$fetched) {
                throw $this->createNotFoundException('No exhibition found for id '.$exhibitionId);
            }

            $fetched->setTheme($exhibition->getTheme());
            $fetched->setYear($exhibition->getYear());
            $fetched->setDate($exhibition->getDate());
            $fetched->setLocationMap($exhibition->getLocationMap());

            $em->flush();

            return $this->render('exhibition/show.html.twig', array('exhibition' => $fetched));
        }

        return $this->render('exhibition/create.html.twig', array('form' => $form->createView(),));
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

    /**
     * @Route("/api/exhibition/{exhibitionId}", name="apiexhibitionshow")
     */
    public function apiShowAction($exhibitionId)
    {
        $exhibition = $this->getDoctrine()
        ->getRepository('AppBundle:Exhibition')->find($exhibitionId);

        if (!$exhibition) {
            throw $this->createNotFoundException('No exhibition found for id '.$exhibitionId);
        }

        $data = array(
            'id' => $exhibition->getId(),
            'theme' => $exhibition->getTheme(),
            'year' => "TODO: datetime conversion to string",
            'date' => $exhibition->getDate(),
            'locationMap' => $exhibition->getLocationMap()
        );
        return new Response(json_encode($data),200,array('Content-Type' =>'application/json'));
    }
}
