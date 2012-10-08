<?php

namespace OG\InversaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CdItemType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', null, array('required' => true, 'label' => 'Name'))
            ->add('description', null, array('required' => false, 'label' => 'Beschreibung'))
            ->add('songs', null, array('required' => false, 'label' => 'Lieder'))
            ->add('published', 'date',
                    array('attr' => array('class' => 'datetimefield'), 'required' => false, 'label' => 'Datum',
                            'widget' => 'single_text', 'format' => 'dd.MM.yyyy'))
            ->add('image', new ImageType(), array('required' => false, 'label' => 'Bild'))
            ->add('canorder', null, array('required' => false, 'label' => 'Bestellformular aktiv?'))
            ->add('price', null, array('required' => false, 'label' => 'Preis'))
            ->add('isactive', null, array('required' => false, 'label' => 'Aktiv?'));
    }

    public function getName()
    {
        return 'og_inversabundle_cditemtype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'OG\InversaBundle\Entity\CdItem');
    }
}
