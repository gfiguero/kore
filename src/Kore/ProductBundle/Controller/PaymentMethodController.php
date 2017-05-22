<?php

namespace Kore\ProductBundle\Controller;

use Kore\ProductBundle\Entity\PaymentMethod;
use Kore\ProductBundle\Form\PaymentMethodType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Paymentmethod controller.
 *
 */
class PaymentMethodController extends Controller
{

    /**
     * Lists all PaymentMethod entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $paymentMethods = $em->getRepository('KoreProductBundle:PaymentMethod')->findBy(array(), array($sort => $direction));
        else $paymentMethods = $em->getRepository('KoreProductBundle:PaymentMethod')->findAll();
        $paginator = $this->get('knp_paginator');
        $paymentMethods = $paginator->paginate($paymentMethods, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($paymentMethods as $key => $paymentMethod) {
            $deleteForms[] = $this->createDeleteForm($paymentMethod)->createView();
        }

        return $this->render('KoreProductBundle:PaymentMethod:index.html.twig', array(
            'paymentMethods' => $paymentMethods,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new PaymentMethod entity.
     *
     */
    public function newAction(Request $request)
    {
        $paymentMethod = new PaymentMethod();
        $newForm = $this->createNewForm($paymentMethod);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($paymentMethod);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'paymentMethod.new.flash' );
                return $this->redirect($this->generateUrl('paymentmethod_index'));
            }
        }

        return $this->render('KoreProductBundle:PaymentMethod:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new PaymentMethod entity.
     *
     * @param PaymentMethod $paymentMethod The PaymentMethod entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(PaymentMethod $paymentMethod)
    {
        return $this->createForm('Kore\ProductBundle\Form\PaymentMethodType', $paymentMethod, array(
            'action' => $this->generateUrl('paymentmethod_new'),
        ));
    }

    /**
     * Finds and displays a PaymentMethod entity.
     *
     */
    public function showAction(PaymentMethod $paymentMethod)
    {
        $editForm = $this->createEditForm($paymentMethod);
        $deleteForm = $this->createDeleteForm($paymentMethod);

        return $this->render('KoreProductBundle:PaymentMethod:show.html.twig', array(
            'paymentMethod' => $paymentMethod,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PaymentMethod entity.
     *
     */
    public function editAction(Request $request, PaymentMethod $paymentMethod)
    {
        $editForm = $this->createEditForm($paymentMethod);
        $deleteForm = $this->createDeleteForm($paymentMethod);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($paymentMethod);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'paymentMethod.edit.flash' );
                return $this->redirect($this->generateUrl('paymentmethod_index'));
            }
        }

        return $this->render('KoreProductBundle:PaymentMethod:edit.html.twig', array(
            'paymentMethod' => $paymentMethod,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a PaymentMethod entity.
     *
     * @param PaymentMethod $paymentMethod The PaymentMethod entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(PaymentMethod $paymentMethod)
    {
        return $this->createForm('Kore\ProductBundle\Form\PaymentMethodType', $paymentMethod, array(
            'action' => $this->generateUrl('paymentmethod_edit', array('id' => $paymentMethod->getId())),
        ));
    }

    /**
     * Deletes a PaymentMethod entity.
     *
     */
    public function deleteAction(Request $request, PaymentMethod $paymentMethod)
    {
        $deleteForm = $this->createDeleteForm($paymentMethod);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paymentMethod);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'paymentMethod.delete.flash' );
        }

        return $this->redirect($this->generateUrl('paymentmethod_index'));
    }

    /**
     * Creates a form to delete a PaymentMethod entity.
     *
     * @param PaymentMethod $paymentMethod The PaymentMethod entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PaymentMethod $paymentMethod)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paymentmethod_delete', array('id' => $paymentMethod->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
