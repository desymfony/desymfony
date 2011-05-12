<?php

namespace Desymfony\DesymfonyBundle\Validator;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

class DNIValidator extends ConstraintValidator
{
    public function isValid($value, Constraint $constraint)
    {
        $this->setMessage($constraint->message);
        
        return preg_match("/^\d{1,8}[a-zA-A]{1}$/",$value);
    }
}
