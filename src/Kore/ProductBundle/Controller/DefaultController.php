<?php

namespace Kore\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KoreProductBundle:Default:index.html.twig');
    }
}
