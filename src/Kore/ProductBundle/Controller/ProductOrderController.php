<?php

namespace Kore\ProductBundle\Controller;

use Kore\ProductBundle\Entity\ProductOrder;
use Kore\ProductBundle\Form\ProductOrderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Productorder controller.
 *
 */
class ProductOrderController extends Controller
{

    /**
     * Lists all ProductOrder entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $productOrders = $em->getRepository('KoreProductBundle:ProductOrder')->findBy(array(), array($sort => $direction));
        else $productOrders = $em->getRepository('KoreProductBundle:ProductOrder')->findAll();
        $paginator = $this->get('knp_paginator');
        $productOrders = $paginator->paginate($productOrders, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($productOrders as $key => $productOrder) {
            $deleteForms[] = $this->createDeleteForm($productOrder)->createView();
        }

        return $this->render('KoreProductBundle:ProductOrder:index.html.twig', array(
            'productOrders' => $productOrders,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new ProductOrder entity.
     *
     */
    public function newAction(Request $request)
    {
        $productOrder = new ProductOrder();
        $newForm = $this->createNewForm($productOrder);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($productOrder);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'productOrder.new.flash' );
                return $this->redirect($this->generateUrl('productorder_index'));
            }
        }

        return $this->render('KoreProductBundle:ProductOrder:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new ProductOrder entity.
     *
     * @param ProductOrder $productOrder The ProductOrder entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(ProductOrder $productOrder)
    {
        return $this->createForm('Kore\ProductBundle\Form\ProductOrderType', $productOrder, array(
            'action' => $this->generateUrl('productorder_new'),
        ));
    }

    /**
     * Finds and displays a ProductOrder entity.
     *
     */
    public function showAction(ProductOrder $productOrder)
    {
        $editForm = $this->createEditForm($productOrder);
        $deleteForm = $this->createDeleteForm($productOrder);

        return $this->render('KoreProductBundle:ProductOrder:show.html.twig', array(
            'productOrder' => $productOrder,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProductOrder entity.
     *
     */
    public function editAction(Request $request, ProductOrder $productOrder)
    {
        $editForm = $this->createEditForm($productOrder);
        $deleteForm = $this->createDeleteForm($productOrder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($productOrder);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'productOrder.edit.flash' );
                return $this->redirect($this->generateUrl('productorder_index'));
            }
        }

        return $this->render('KoreProductBundle:ProductOrder:edit.html.twig', array(
            'productOrder' => $productOrder,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a ProductOrder entity.
     *
     * @param ProductOrder $productOrder The ProductOrder entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ProductOrder $productOrder)
    {
        return $this->createForm('Kore\ProductBundle\Form\ProductOrderType', $productOrder, array(
            'action' => $this->generateUrl('productorder_edit', array('id' => $productOrder->getId())),
        ));
    }

    /**
     * Deletes a ProductOrder entity.
     *
     */
    public function deleteAction(Request $request, ProductOrder $productOrder)
    {
        $deleteForm = $this->createDeleteForm($productOrder);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productOrder);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'productOrder.delete.flash' );
        }

        return $this->redirect($this->generateUrl('productorder_index'));
    }

    /**
     * Creates a form to delete a ProductOrder entity.
     *
     * @param ProductOrder $productOrder The ProductOrder entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProductOrder $productOrder)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productorder_delete', array('id' => $productOrder->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
