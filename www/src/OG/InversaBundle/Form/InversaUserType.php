<?php

namespace OG\InversaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class InversaUserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username', null, array('required' => true, 'label' => 'Benutzername'))
            ->add('name', null, array('required' => false, 'label' => 'Name'))
            ->add('firstname', null, array('required' => false, 'label' => 'Vorname'))
            ->add('email', null, array('required' => false, 'label' => 'Email'))
            ->add('oldpassword', 'password', array('required' => false, 'label' => 'Altes Passwort', 'always_empty' => true))
            ->add('newpassword', 'password', array('required' => false, 'label' => 'Neues Passwort', 'always_empty' => true))
            ->add('repeatpassword', 'password', array('required' => false, 'label' => 'Neues Passwort bestätigen', 'always_empty' => true))
            ->add('isactive', null, array('required' => false, 'label' => 'Aktiv?'));
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
