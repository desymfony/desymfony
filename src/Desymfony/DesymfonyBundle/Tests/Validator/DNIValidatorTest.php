<?php
namespace Desymfony\DesymfonyBundle\Tests\Validator;

use Desymfony\DesymfonyBundle\Validator\DNIValidator;
use Desymfony\DesymfonyBundle\Validator\DNI;

class DNIValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testIsValid()
    {
        $dniValidator = new DniValidator();
        $this->assertTrue($dniValidator->isValid("11111111H", new DNI()), "DNI válido valida");
        $this->assertTrue($dniValidator->isValid("11111111h", new DNI()), "La letra del DNI puede ser minúscula");
        $this->assertTrue($dniValidator->isValid("11111W", new DNI()), "DNI corto valida");
    }

    public function testIsNotValid()
    {
        $dniValidator = new DniValidator();
        $this->assertFalse($dniValidator->isValid("11111111A", new DNI()), "DNI con letra incorrecta no valida");
        $this->assertFalse($dniValidator->isValid("11111111-H", new DNI()), "DNI con guion no valida");
        $this->assertFalse($dniValidator->isValid("H11111111", new DNI()), "DNI con letra al principio no valida");
        $this->assertFalse($dniValidator->isValid("11111111 H", new DNI()), "DNI con espacio no valida");
        $this->assertFalse($dniValidator->isValid("11111111", new DNI()), "DNI sin letra no valida");
        $this->assertFalse($dniValidator->isValid("11111111111111111111H", new DNI()), "DNI demasiado largo no valida");

    }
}
