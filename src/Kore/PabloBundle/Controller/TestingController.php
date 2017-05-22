<?php

namespace Kore\PabloBundle\Controller;

use Kore\PabloBundle\Entity\Testing;
use Kore\PabloBundle\Form\TestingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Testing controller.
 *
 */
class TestingController extends Controller
{

    /**
     * Lists all Testing entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $testings = $em->getRepository('KorePabloBundle:Testing')->findBy(array(), array($sort => $direction));
        else $testings = $em->getRepository('KorePabloBundle:Testing')->findAll();
        $paginator = $this->get('knp_paginator');
        $testings = $paginator->paginate($testings, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($testings as $key => $testing) {
            $deleteForms[] = $this->createDeleteForm($testing)->createView();
        }

        return $this->render('KorePabloBundle:Testing:index.html.twig', array(
            'testings' => $testings,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Testing entity.
     *
     */
    public function newAction(Request $request)
    {
        $testing = new Testing();
        $newForm = $this->createNewForm($testing);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($testing);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'testing.new.flash' );
                return $this->redirect($this->generateUrl('testing_index'));
            }
        }

        return $this->render('KorePabloBundle:Testing:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Testing entity.
     *
     * @param Testing $testing The Testing entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Testing $testing)
    {
        return $this->createForm('Kore\PabloBundle\Form\TestingType', $testing, array(
            'action' => $this->generateUrl('testing_new'),
        ));
    }

    /**
     * Finds and displays a Testing entity.
     *
     */
    public function showAction(Testing $testing)
    {
        $editForm = $this->createEditForm($testing);
        $deleteForm = $this->createDeleteForm($testing);

        return $this->render('KorePabloBundle:Testing:show.html.twig', array(
            'testing' => $testing,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Testing entity.
     *
     */
    public function editAction(Request $request, Testing $testing)
    {
        $editForm = $this->createEditForm($testing);
        $deleteForm = $this->createDeleteForm($testing);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($testing);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'testing.edit.flash' );
                return $this->redirect($this->generateUrl('testing_index'));
            }
        }

        return $this->render('KorePabloBundle:Testing:edit.html.twig', array(
            'testing' => $testing,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Testing entity.
     *
     * @param Testing $testing The Testing entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Testing $testing)
    {
        return $this->createForm('Kore\PabloBundle\Form\TestingType', $testing, array(
            'action' => $this->generateUrl('testing_edit', array('id' => $testing->getId())),
        ));
    }

    /**
     * Deletes a Testing entity.
     *
     */
    public function deleteAction(Request $request, Testing $testing)
    {
        $deleteForm = $this->createDeleteForm($testing);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($testing);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'testing.delete.flash' );
        }

        return $this->redirect($this->generateUrl('testing_index'));
    }

    /**
     * Creates a form to delete a Testing entity.
     *
     * @param Testing $testing The Testing entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Testing $testing)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('testing_delete', array('id' => $testing->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
