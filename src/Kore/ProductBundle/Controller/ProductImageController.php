<?php

namespace Kore\ProductBundle\Controller;

use Kore\ProductBundle\Entity\ProductImage;
use Kore\ProductBundle\Form\ProductImageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Productimage controller.
 *
 */
class ProductImageController extends Controller
{

    /**
     * Lists all ProductImage entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $productImages = $em->getRepository('KoreProductBundle:ProductImage')->findBy(array(), array($sort => $direction));
        else $productImages = $em->getRepository('KoreProductBundle:ProductImage')->findAll();
        $paginator = $this->get('knp_paginator');
        $productImages = $paginator->paginate($productImages, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($productImages as $key => $productImage) {
            $deleteForms[] = $this->createDeleteForm($productImage)->createView();
        }

        return $this->render('KoreProductBundle:ProductImage:index.html.twig', array(
            'productImages' => $productImages,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new ProductImage entity.
     *
     */
    public function newAction(Request $request)
    {
        $productImage = new ProductImage();
        $newForm = $this->createNewForm($productImage);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($productImage);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'productImage.new.flash' );
                return $this->redirect($this->generateUrl('productimage_index'));
            }
        }

        return $this->render('KoreProductBundle:ProductImage:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new ProductImage entity.
     *
     * @param ProductImage $productImage The ProductImage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(ProductImage $productImage)
    {
        return $this->createForm('Kore\ProductBundle\Form\ProductImageType', $productImage, array(
            'action' => $this->generateUrl('productimage_new'),
        ));
    }

    /**
     * Finds and displays a ProductImage entity.
     *
     */
    public function showAction(ProductImage $productImage)
    {
        $editForm = $this->createEditForm($productImage);
        $deleteForm = $this->createDeleteForm($productImage);

        return $this->render('KoreProductBundle:ProductImage:show.html.twig', array(
            'productImage' => $productImage,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProductImage entity.
     *
     */
    public function editAction(Request $request, ProductImage $productImage)
    {
        $editForm = $this->createEditForm($productImage);
        $deleteForm = $this->createDeleteForm($productImage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($productImage);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'productImage.edit.flash' );
                return $this->redirect($this->generateUrl('productimage_index'));
            }
        }

        return $this->render('KoreProductBundle:ProductImage:edit.html.twig', array(
            'productImage' => $productImage,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a ProductImage entity.
     *
     * @param ProductImage $productImage The ProductImage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ProductImage $productImage)
    {
        return $this->createForm('Kore\ProductBundle\Form\ProductImageType', $productImage, array(
            'action' => $this->generateUrl('productimage_edit', array('id' => $productImage->getId())),
        ));
    }

    /**
     * Deletes a ProductImage entity.
     *
     */
    public function deleteAction(Request $request, ProductImage $productImage)
    {
        $deleteForm = $this->createDeleteForm($productImage);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productImage);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'productImage.delete.flash' );
        }

        return $this->redirect($this->generateUrl('productimage_index'));
    }

    /**
     * Creates a form to delete a ProductImage entity.
     *
     * @param ProductImage $productImage The ProductImage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProductImage $productImage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productimage_delete', array('id' => $productImage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
