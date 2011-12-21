<?php

namespace OG\InversaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('address')
            ->add('mapurl')
            ->add('isactive')
            ->add('image')
        ;
    }

    public function getName()
    {
        return 'og_inversabundle_locationtype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'OG\InversaBundle\Entity\Location');
    }
}
