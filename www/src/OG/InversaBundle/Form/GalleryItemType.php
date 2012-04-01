<?php

namespace OG\InversaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GalleryItemType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', null, array('required' => true, 'label' => 'Name'))
            ->add('description', null, array('required' => false, 'label' => 'Beschreibung'))
            ->add('images', 'collection',
                    array('type' => new ImageType(),
                          'allow_add' => true,
                          'allow_delete' => true,
                          'prototype' => true,
                          'by_reference' => false,
                          'label' => 'Bilder'));
    }

    public function getName()
    {
        return 'og_inversabundle_galleryitemtype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'OG\InversaBundle\Entity\GalleryItem');
    }
}
