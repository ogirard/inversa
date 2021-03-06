<?php

namespace OG\InversaBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', null, array('label' => 'Name'))
                ->add('file', null, array('label' => 'Neue Datei'))
                ->add('webpath', null, array('attr' => array('class' => 'webpathinput'), 'required' => false));
    }

    public function getName()
    {
        return 'og_inversabundle_documenttype';
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'OG\InversaBundle\Entity\Document');
    }
}
