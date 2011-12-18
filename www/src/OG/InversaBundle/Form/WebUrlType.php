<?php

namespace OG\InversaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class WebUrlType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('url')
            ->add('agendaitem')
            ->add('projectitem')
            ->add('pressitem')
        ;
    }

    public function getName()
    {
        return 'og_inversabundle_weburltype';
    }
}
