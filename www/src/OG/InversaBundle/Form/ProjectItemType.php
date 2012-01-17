<?php

namespace OG\InversaBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ProjectItemType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name')
                ->add('description')
                ->add('day', 'text', array('attr' => array('class' => 'datetimefield'), 'required' => false))
                ->add('isactive')
                ->add('documents', 'collection',
                      array('type' => new DocumentType(),
                            'allow_add' => true,
                            'allow_delete' => true,
                            'prototype' => true))
                ->add('links', 'collection',
                      array('type' => new WebUrlType(),
                            'allow_add' => true,
                            'allow_delete' => true,
                            'prototype' => true))
                ->add('images', 'collection',
                      array('type' => new ImageType(),
                            'allow_add' => true,
                            'allow_delete' => true,
                            'prototype' => true));        
        
        // 'options'  => array('required' => false, 'attr' => array('class' => 'someclass'))
    }

    public function getName()
    {
        return 'og_inversabundle_projectitemtype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'OG\InversaBundle\Entity\ProjectItem');
    }
}
