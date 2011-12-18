<?php

namespace OG\InversaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PressItemType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('published')
            ->add('isactive')
        ;
    }

    public function getName()
    {
        return 'og_inversabundle_pressitemtype';
    }
}
