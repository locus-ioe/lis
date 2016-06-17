<?php

namespace AppBundle\Controller;
// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Symfony form
use AppBundle\Form\Type\MeetingType;

// User-defined classes
use AppBundle\Entity\Meeting;

class MeetingController extends BaseController
{
    // Show Meeting Index Page
    /**
     * @Route("/meeting", name="meetingpage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $meetings = $em
        ->getRepository('AppBundle:Meeting')->findall();
        if (!$meetings) {
            return $this->redirectToRoute('meetingcreate', array());
            // throw $this->createNotFoundException('No meeting found');
        }
        return $this->render('meeting/index.html.twig', array('meetings' => $meetings));
    }

    // Show the meeting-create form * @Security("has_role('ROLE_ADMIN')")
    /**
     * @Route("/meeting/create", name="meetingcreate")
     * @Method({"GET", "HEAD"})
     */
    public function createAction(Request $request)
    {
        $meeting = new Meeting();
        $form = $this->createForm(MeetingType::class, $meeting, array('forupdate' => false));
        return $this->render('meeting/create.html.twig', array('form' => $form->createView(), 'title' => 'Create'));
    }

    // Handle the create form and store created meeting
    /**
     * @Route("/meeting/create", name="meetingstore")
     * @Method("POST")
     */
    public function storeAction(Request $request)
    {
        $meeting = new Meeting();
        $form = $this->createForm(MeetingType::class, $meeting, array('forupdate' => false));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $meeting->getDatetime()->format('Ymd Hi');
            $slug = $this->get('app.slugger')->slugify($slug);
            $meeting->setSlug($slug);
            $em = $this->getDoctrine()->getManager();
            $em->persist($meeting);
            $em->flush();
            return $this->render('meeting/show.html.twig', array('meeting' => $meeting));
        }
        return $this->render('meeting/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
    }

    // Show the meeting-edit form
    /**
     * @Route("/meeting/{slug}/edit", name="meetingedit")
     * @Method({"GET", "HEAD"})
     */
    public function editAction(Request $request, $slug)
    {
        $meeting = $this->getDoctrine()
        ->getRepository('AppBundle:Meeting')->findOneBySlug($slug);
        if (!$meeting) {
            throw $this->createNotFoundException('No meeting found for id '.$slug);
        }
        $form = $this->createForm(MeetingType::class, $meeting, array('forupdate' => true));
        return $this->render('meeting/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit'));
    }

    // Handle the create form and store created meeting
    /**
     * @Route("/meeting/edit/{slug}", name="meetingupdate")
     * @Method("POST")
     */
    public function updateAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $meeting = $em->getRepository('AppBundle:Meeting')->findOneBySlug($slug);
        if (!$meeting) {
            throw $this->createNotFoundException('No meeting found for id '.$slug);
        }
        $form = $this->createForm(MeetingType::class, $meeting, array('forupdate' => true));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $slug = $meeting->getDatetime()->format('Ymd Hi');
            $slug = $this->get('app.slugger')->slugify($slug);
            $meeting->setSlug($slug);
            $em->flush();
            return $this->render('meeting/show.html.twig', array('meeting' => $meeting));
        }
        return $this->render('meeting/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit'));
    }

    // Display the specified meeting
    /**
     * @Route("/meeting/delete/{slug}", name="meetingdelete")
     */
    public function deleteAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $meeting = $em
        ->getRepository('AppBundle:Meeting')->findOneBySlug($slug);
        if (!$meeting) {
            throw $this->createNotFoundException('No meeting found for id '.$slug);
        }
        $em->remove($meeting);
        $em->flush();
        return $this->render('meeting/index.html.twig', array('message' => 'Meeting with slug = '.$slug.' deleted'));
    }

    // Display the specified meeting
    /**
     * @Route("/meeting/{slug}", name="meetingshow")
     */
    public function showAction(Request $request, $slug)
    {
        $meeting = $this->getDoctrine()
        ->getRepository('AppBundle:Meeting')->findOneBySlug($slug);
        if (!$meeting) {
            throw $this->createNotFoundException('No meeting found for id '.$slug);
        }
        return $this->render('meeting/show.html.twig', array('meeting' => $meeting));
    }
}
