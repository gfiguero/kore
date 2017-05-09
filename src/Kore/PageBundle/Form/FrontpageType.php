<?php

namespace Kore\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FrontpageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('name', null, array(
                'label' => 'frontpage.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KorePageBundle',
            )) 
            ->add('title', null, array(
                'label' => 'frontpage.form.title',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KorePageBundle',
            )) 
            ->add('subtitle', null, array(
                'label' => 'frontpage.form.subtitle',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KorePageBundle',
            )) 
            ->add('about', null, array(
                'label' => 'frontpage.form.about',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KorePageBundle',
            )) 
            ->add('subabout', null, array(
                'label' => 'frontpage.form.subabout',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KorePageBundle',
            )) 
            ->add('service', null, array(
                'label' => 'frontpage.form.service',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KorePageBundle',
            )) 
            ->add('subservice', null, array(
                'label' => 'frontpage.form.subservice',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KorePageBundle',
            )) 
            ->add('calltoaction', null, array(
                'label' => 'frontpage.form.calltoaction',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KorePageBundle',
            )) 
            ->add('contact', null, array(
                'label' => 'frontpage.form.contact',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KorePageBundle',
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kore\PageBundle\Entity\Frontpage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kore_pagebundle_frontpage';
    }


}
