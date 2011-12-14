<?php
// src/OG/InversaBundle/Form/Type/AgendaItemType.php

namespace OG\InversaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AgendaItemType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name');
        $builder->add('description', null, array('required' => false));
    }

    public function getName()
    {
        return 'name';
    }
}
