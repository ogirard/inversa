<?php

namespace OG\InversaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MediaItemType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', null, array('label' => 'Name'))
                ->add('description', null, array('label' => 'Beschreibung'))
                ->add('mediafile', null, array('label' => 'Audio oder Video Datei'))
                ->add('webpath', null, array('attr' => array('class' => 'webpathinput'), 'required' => false))
                ->add('image', new ImageType(), array('required' => false, 'label' => 'Bild'))
                ->add('isactive', null, array('required' => false, 'label' => 'Aktiv?'));
    }

    public function getName()
    {
        return 'og_inversabundle_mediaitemtype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'OG\InversaBundle\Entity\MediaItem');
    }
}
