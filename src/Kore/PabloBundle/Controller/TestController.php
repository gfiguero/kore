<?php 

namespace Kore\PabloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Kore\PabloBundle\Form\TestingType;
use Kore\PabloBundle\Entity\Testing;

class TestController extends Controller 
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $testings = $em->getRepository('KorePabloBundle:Testing')->findAll();
        $testing = new Testing();
        $form = $this->createForm(new TestingType(), $testing, array(
            'action' => $this->generateUrl('kore_pablo_new'),
        ));
        return $this->render('KorePabloBundle:Test:index.html.twig', array( 
            'form' => $form->createView(),
            'testings' => $testings,
        ));
    }

    public function newAction(Request $request) {
        $testing = new Testing();
        $form = $this->createForm(new TestingType(), $testing);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($testing);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('kore_pablo_index'));
    }
}
