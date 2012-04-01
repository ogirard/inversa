<?php

namespace OG\InversaBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class WebUrlType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', null, array('required' => true, 'label' => 'Name'))
                ->add('url', null, array('required' => false, 'label' => 'URL'));
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
