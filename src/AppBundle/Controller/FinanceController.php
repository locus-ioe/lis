<?php

namespace AppBundle\Controller;

// Sensio bundles
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// Symfony components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// Symfony form types
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
// User-defined classes
use AppBundle\Entity\Finance;
use AppBundle\Form\Type\FinanceType;

class FinanceController extends BaseController
{
  /**
   * @Route("/finance", name="financepage")
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $finances = $em
    ->getRepository('AppBundle:Finance')->findall();
    if (!$finances) {
      return $this->redirectToRoute('financecreate', array());
    }
    return $this->render('finance/index.html.twig', array('finances' => $finances));
  }

  /**
   * @Route("/finance/create", name="financecreate")
   */
  public function createAction(Request $request)
  {
    $finance = new Finance();
    $form = $this->createForm(FinanceType::class, $finance, array('forupdate' => false));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($finance);
      $em->flush();
      return $this->redirectToRoute('financeshow', array('billNumber' => $form->getData()->getBillNumber()));
    }
    return $this->render('finance/create.html.twig', array('form' => $form->createView(), 'title' => 'Create', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/finance/{billNumber}/edit", name="financeedit")
   */
  public function editAction(Request $request, $billNumber)
  {
    $finance = $this->getDoctrine()
      ->getRepository('AppBundle:Finance')->findOneByBillNumber($billNumber);
    $form = $this->createForm(FinanceType::class, $finance, array('forupdate' => true));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($finance);
      $em->flush();
      return $this->redirectToRoute('financeshow', array('billNumber' => $billNumber));
    }
    return $this->render('finance/create.html.twig', array('form' => $form->createView(), 'title' => 'Edit', 'message' => 'Unable to proceed the submitted form and/or form data'));
  }

  /**
   * @Route("/finance/{billNumber}/delete", name="financedelete")
   */
  public function deleteAction(Request $request, $billNumber)
  {
    return new Response('<html><title>Delete finance</title><body><h1>Delete finance <small><i>with billNumber ' .$billNumber. '</i></small></h1></body></html>');
  }

  /**
   * @Route("/finance/{billNumber}", name="financeshow")
   */
  public function showAction(Request $request, $billNumber)
  {
    $finance = $this->getDoctrine()
    ->getRepository('AppBundle:Finance')->findOneByBillNumber($billNumber);
    if (!$finance) {
      throw $this->createNotFoundException('No finance found for billNumber '.$billNumber);
    }
    return $this->render('finance/show.html.twig', array('finance' => $finance));
  }
}
