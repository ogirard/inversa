<?php

namespace OG\InversaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', null, array('required' => true, 'label' => 'Name'))
                ->add('description', null, array('required' => false, 'label' => 'Beschreibung'))
                ->add('file', null, array('required' => false, 'label' => 'Neues Bild'))
                ->add('webpath', null, array('attr' => array('class' => 'webpathinput'), 'required' => false));
    }

    public function getName()
    {
        return 'og_inversabundle_imagetype';
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'OG\InversaBundle\Entity\Image');
    }
}
