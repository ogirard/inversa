<?php

namespace OG\InversaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class InversaUserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('name')
            ->add('firstname')
            ->add('email')
            ->add('password')
            ->add('lastlogin')
            ->add('isactive')
        ;
    }

    public function getName()
    {
        return 'og_inversabundle_inversausertype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'OG\InversaBundle\Entity\InversaUser');
    }
}
