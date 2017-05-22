<?php

namespace Kore\ProductBundle\Controller;

use Kore\ProductBundle\Entity\OrderStatus;
use Kore\ProductBundle\Form\OrderStatusType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Orderstatus controller.
 *
 */
class OrderStatusController extends Controller
{

    /**
     * Lists all OrderStatus entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $orderStatuses = $em->getRepository('KoreProductBundle:OrderStatus')->findBy(array(), array($sort => $direction));
        else $orderStatuses = $em->getRepository('KoreProductBundle:OrderStatus')->findAll();
        $paginator = $this->get('knp_paginator');
        $orderStatuses = $paginator->paginate($orderStatuses, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($orderStatuses as $key => $orderStatus) {
            $deleteForms[] = $this->createDeleteForm($orderStatus)->createView();
        }

        return $this->render('KoreProductBundle:OrderStatus:index.html.twig', array(
            'orderStatuses' => $orderStatuses,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new OrderStatus entity.
     *
     */
    public function newAction(Request $request)
    {
        $orderStatus = new OrderStatus();
        $newForm = $this->createNewForm($orderStatus);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($orderStatus);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'orderStatus.new.flash' );
                return $this->redirect($this->generateUrl('orderstatus_index'));
            }
        }

        return $this->render('KoreProductBundle:OrderStatus:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new OrderStatus entity.
     *
     * @param OrderStatus $orderStatus The OrderStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(OrderStatus $orderStatus)
    {
        return $this->createForm('Kore\ProductBundle\Form\OrderStatusType', $orderStatus, array(
            'action' => $this->generateUrl('orderstatus_new'),
        ));
    }

    /**
     * Finds and displays a OrderStatus entity.
     *
     */
    public function showAction(OrderStatus $orderStatus)
    {
        $editForm = $this->createEditForm($orderStatus);
        $deleteForm = $this->createDeleteForm($orderStatus);

        return $this->render('KoreProductBundle:OrderStatus:show.html.twig', array(
            'orderStatus' => $orderStatus,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing OrderStatus entity.
     *
     */
    public function editAction(Request $request, OrderStatus $orderStatus)
    {
        $editForm = $this->createEditForm($orderStatus);
        $deleteForm = $this->createDeleteForm($orderStatus);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($orderStatus);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'orderStatus.edit.flash' );
                return $this->redirect($this->generateUrl('orderstatus_index'));
            }
        }

        return $this->render('KoreProductBundle:OrderStatus:edit.html.twig', array(
            'orderStatus' => $orderStatus,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a OrderStatus entity.
     *
     * @param OrderStatus $orderStatus The OrderStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(OrderStatus $orderStatus)
    {
        return $this->createForm('Kore\ProductBundle\Form\OrderStatusType', $orderStatus, array(
            'action' => $this->generateUrl('orderstatus_edit', array('id' => $orderStatus->getId())),
        ));
    }

    /**
     * Deletes a OrderStatus entity.
     *
     */
    public function deleteAction(Request $request, OrderStatus $orderStatus)
    {
        $deleteForm = $this->createDeleteForm($orderStatus);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($orderStatus);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'orderStatus.delete.flash' );
        }

        return $this->redirect($this->generateUrl('orderstatus_index'));
    }

    /**
     * Creates a form to delete a OrderStatus entity.
     *
     * @param OrderStatus $orderStatus The OrderStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(OrderStatus $orderStatus)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('orderstatus_delete', array('id' => $orderStatus->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
