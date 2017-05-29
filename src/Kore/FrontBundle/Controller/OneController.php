<?php

namespace Kore\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OneController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $frontpage = $em->getRepository('KorePageBundle:Frontpage')->findOneById(1);
        return $this->render('KoreFrontBundle:One:index.html.twig', array(
            'frontpage' => $frontpage,
        ));
    }
}
