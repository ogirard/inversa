<?php

namespace OG\InversaBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ProjectItemType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', null, array('required' => true, 'label' => 'Name'))
                ->add('description', null, array('required' => false, 'label' => 'Beschreibung'))
                ->add('day', 'date',
                        array('attr' => array('class' => 'datetimefield'), 'required' => false, 'label' => 'Datum',
                                'widget' => 'single_text', 'format' => 'dd.MM.yyyy'))
                ->add('location', 'entity',
                        array('required' => false, 'label' => 'Ort', 'class' => 'OGInversaBundle:Location'))
                ->add('documents', 'collection',
                        array('type' => new DocumentType(), 'allow_add' => true, 'allow_delete' => true,
                                'prototype' => true, 'by_reference' => false, 'label' => 'Dokumente'))
                ->add('links', 'collection',
                        array('type' => new WebUrlType(), 'allow_add' => true, 'allow_delete' => true,
                                'prototype' => true, 'by_reference' => false, 'label' => 'Links'))
                ->add('images', 'collection',
                        array('type' => new ImageType(), 'allow_add' => true, 'allow_delete' => true,
                                'prototype' => true, 'by_reference' => false, 'label' => 'Bilder'))
                ->add('isactive', null, array('required' => false, 'label' => 'Aktiv?'));
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
