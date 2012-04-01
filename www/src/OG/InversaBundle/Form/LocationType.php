<?php

namespace OG\InversaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', null, array('required' => true, 'label' => 'Name'))
            ->add('description', null, array('required' => false, 'label' => 'Beschreibung'))
            ->add('address', null, array('required' => false, 'label' => 'Adresse'))
            ->add('image', new ImageType(), array('required' => false, 'label' => 'Bild'))
            ->add('mapurl', null, array('required' => false, 'label' => 'Karte (URL)'))
            ->add('isactive', null, array('required' => false, 'label' => 'Aktiv?'));
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
