<?php

namespace OG\InversaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AgendaItemType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('eventdate')
            ->add('participants')
            ->add('isactive')
            ->add('location')
        ;
    }

    public function getName()
    {
        return 'og_inversabundle_agendaitemtype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'OG\InversaBundle\Entity\AgendaItem');
    }
}
