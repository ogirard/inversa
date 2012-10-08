<?php

namespace OG\InversaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class NewInversaUserType extends AbstractType
{
  public function buildForm(FormBuilder $builder, array $options)
  {
    $builder->add('username', null, array('required' => true, 'label' => 'Benutzername'))
            ->add('name', null, array('required' => false, 'label' => 'Name'))
            ->add('firstname', null, array('required' => false, 'label' => 'Vorname'))
            ->add('email', null, array('required' => false, 'label' => 'Email'))
            ->add('newpassword', 'password', array('required' => true, 'label' => 'Passwort'))
            ->add('repeatpassword', 'password', array('required' => true, 'label' => 'Passwort bestätigen'))
            ->add('isactive', null, array('required' => false, 'label' => 'Aktiv?'));
  }

  public function getName()
  {
    return 'og_inversabundle_newinversausertype';
  }

  public function getDefaultOptions(array $options)
  {
    return array('data_class' => 'OG\InversaBundle\Entity\InversaUser');
  }
}
