<?php
namespace Desymfony\DesymfonyBundle\Tests\Validator;

use Desymfony\DesymfonyBundle\Validator\DNIValidator;
use Desymfony\DesymfonyBundle\Validator\DNI;

class DNIValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testIsValid()
    {
        $dniValidator = new DniValidator();
        $this->assertTrue($dniValidator->isValid("11111111H", new DNI()));
        $this->assertFalse($dniValidator->isValid("11111111A", new DNI()));
    }
}
