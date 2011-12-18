<?php

namespace OG\InversaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('doctype')
            ->add('path')
            ->add('agendaitem')
            ->add('projectitem')
            ->add('pressitem')
        ;
    }

    public function getName()
    {
        return 'og_inversabundle_documenttype';
    }
}
