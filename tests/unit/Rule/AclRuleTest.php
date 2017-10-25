<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 16:50
 */

namespace Tests\ObjectivePHP\Acl\Rule;


use Codeception\Test\Unit;
use ObjectivePHP\Acl\Filter\AclFilterInterface;
use ObjectivePHP\Acl\Rule\AclRule;

class AclRuleTest extends Unit
{
    public function testConstructor()
    {
        
        $filter = $this->getMockBuilder(AclFilterInterface::class)->getMock();
        $rule = new AclRule('pattern', AclRule::ALLOW, $filter);
        $this->assertSame($filter, $rule->getFilters()[0]);
    }
    
    
    public function testFilterAddition()
    {
        
        $filter = $this->getMockBuilder(AclFilterInterface::class)->getMock();
        $rule = new AclRule('pattern', AclRule::ALLOW, $filter);
        $secondFilter = $this->getMockBuilder(AclFilterInterface::class)->getMock();
        $rule->addFilter($secondFilter);
        $this->assertSame($secondFilter, $rule->getFilters()[1]);
    }
}

