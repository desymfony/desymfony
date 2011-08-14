<?php

namespace Desymfony\DesymfonyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Desymfony\DesymfonyBundle\Validator\Constraints\DNI;

class UsuarioType extends AbstractType
{

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('nombre');
        $builder->add('apellidos');
        $builder->add('dni', 'text', array('label' => 'DNI'));
        $builder->add('telefono');
        $builder->add('direccion', 'textarea');
        $builder->add('email', 'email');
        $builder->add('password', 'repeated', array('type' => 'password'));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Desymfony\DesymfonyBundle\Entity\Usuario',
        );
    }

    public function getName()
    {
        return 'usuario';
    }

}
