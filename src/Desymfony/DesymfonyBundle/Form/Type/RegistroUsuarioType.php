<?php

namespace Desymfony\DesymfonyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Desymfony\DesymfonyBundle\Validator\Constraints\DNI;

class RegistroUsuarioType extends AbstractType
{

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('usuario',new UsuarioType())
            ->add('eresUnRobot', 'choice', array(
                'choices'   => array(
                    true => 'Por supuesto',
                    false => 'Va a ser que no'
                ),
                'required'  => true
            ))
        ;        
       
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Desymfony\DesymfonyBundle\Form\RegistroUsuario',
        );
    }

}
