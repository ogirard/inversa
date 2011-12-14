<?php
// src/OG/InversaBundle/Form/Type/DocumentType.php

namespace OG\InversaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name');
        $builder->add('file');
    }

    public function getName()
    {
        return 'name';
    }
}
