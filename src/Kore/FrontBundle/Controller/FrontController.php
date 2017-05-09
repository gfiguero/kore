<?php

namespace Kore\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $frontpage = $em->getRepository('KorePageBundle:Frontpage')->findOneById(1);
        return $this->render(':Front:index.html.twig', array(
            'frontpage' => $frontpage,
        ));
    }
}
