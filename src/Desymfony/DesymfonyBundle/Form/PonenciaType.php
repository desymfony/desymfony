<?php
namespace Desymfony\DesymfonyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PonenciaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('titulo');
        $builder->add('descripcion');
        $builder->add('fecha');
        $builder->add('hora');
        $builder->add('duracion');
        $builder->add('idioma', 'choice', array(
            'choices' => array('es' => 'Español', 'en' => 'Inglés')
        ));
        $builder->add('ponente', 'entity', array(
            'class'         => 'Desymfony\\DesymfonyBundle\\Entity\\Ponente',
            'query_builder' => function ($repositorio) {
                return $repositorio->createQueryBuilder('p')->orderBy('p.nombre', 'ASC');
            },
        ));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Desymfony\DesymfonyBundle\Entity\Ponencia',
        );
    }

    public function getName()
    {
        return 'ponencia';
    }
}
