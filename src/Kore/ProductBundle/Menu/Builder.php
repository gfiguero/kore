<?php

namespace Kore\ProductBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('sidemenu.category', array('route' => 'category_index'))->setAttribute('icon', 'database fa-fw')->setAttribute('translation_domain', 'KoreProductBundle');
        $sidemenu->addChild('sidemenu.subcategory', array('route' => 'subcategory_index'))->setAttribute('icon', 'database fa-fw')->setAttribute('translation_domain', 'KoreProductBundle');
        $sidemenu->addChild('sidemenu.product', array('route' => 'product_index'))->setAttribute('icon', 'database fa-fw')->setAttribute('translation_domain', 'KoreProductBundle');
        $sidemenu->addChild('sidemenu.paymentmethod', array('route' => 'paymentmethod_index'))->setAttribute('icon', 'database fa-fw')->setAttribute('translation_domain', 'KoreProductBundle');
        $sidemenu->addChild('sidemenu.orderstatus', array('route' => 'orderstatus_index'))->setAttribute('icon', 'database fa-fw')->setAttribute('translation_domain', 'KoreProductBundle');
        $sidemenu->addChild('sidemenu.order', array('route' => 'order_index'))->setAttribute('icon', 'database fa-fw')->setAttribute('translation_domain', 'KoreProductBundle');
        return $sidemenu;
    }

}