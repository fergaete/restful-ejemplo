<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComentarioType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('autor')
            ->add('contenido')
            ->add('creadoAt', 'datetime', array(
                'widget' => 'single_text',
                'format' => 'yyyy/MM/dd'
            ))
            ->add('updatedAt', 'datetime', array(
                'widget' => 'single_text',
                'format' => 'yyyy/MM/dd'
            ))
            ->add('post');
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class'      => 'AppBundle\Entity\Comentario',
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'comentario_form';
    }
}
