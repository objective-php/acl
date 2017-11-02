<?php
namespace Filter;


use ObjectivePHP\Acl\Exception\InvalidAclFilterServiceSpecException;
use ObjectivePHP\Acl\Filter\AclFilterServiceSpecs;

class AclFilterSpecsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests
    public function testClassMustBeAnInstanceOfAclFilterInterface()
    {
        $this->expectException(InvalidAclFilterServiceSpecException::class);
        new AclFilterServiceSpecs('test', \stdClass::class);
    }
}
