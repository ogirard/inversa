<?php

namespace OG\InversaBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class WebUrlType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name')->add('url');
    }

    public function getName()
    {
        return 'og_inversabundle_weburltype';
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'OG\InversaBundle\Entity\WebUrl');
    }
}
