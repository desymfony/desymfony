<?php

namespace Desymfony\DesymfonyBundle\Validator;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

class DNIValidator extends ConstraintValidator
{
    public function isValid($value, Constraint $constraint)
    {
        $this->setMessage($constraint->message);
        if (preg_match("/^(\d{1,8})([a-zA-Z]{1})$/", $value, $matches)) {
            return $this->letra_nif($matches[1]) == strtoupper($matches[2]);
        } else {
            return false;
        }
    }

    protected function letra_nif($dni)
    {
        return substr("TRWAGMYFPDXBNJZSQVHLCKE", strtr($dni, "XYZ", "012")%23, 1);
    }
}
