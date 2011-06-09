<?php

namespace Desymfony\DesymfonyBundle\Validator;

use Symfony\Component\Validator\Constraint;

class DNI extends Constraint
{

    public $message = 'No es un DNI válido';

    public function getTargets()
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
