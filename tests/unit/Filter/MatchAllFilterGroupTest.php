<?php
namespace Filter;


use ObjectivePHP\Acl\Exception\InvalidAclFilterServiceSpecException;
use ObjectivePHP\Acl\Filter\AclFilterInterface;
use ObjectivePHP\Acl\Filter\AclFilterServiceSpecs;
use ObjectivePHP\Acl\Filter\MatchAllAclFilterGroup;
use ObjectivePHP\Acl\Request\AclRequest;
use ObjectivePHP\Acl\Request\AclRequestInterface;

class MatchAllFilterGrouptest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests
    public function testPassingFilter()
    {
        $request = $this->getMockBuilder(AclRequest::class)->disableOriginalConstructor()->getMock();
        
        $filter = new class implements AclFilterInterface {
            public function filter(AclRequestInterface $request): bool
            {
                return true;
            }
    
        };
    
        $filter2 = new class implements AclFilterInterface
        {
            public function filter(AclRequestInterface $request): bool
            {
                return true;
            }
        
        };
        
        $group = new MatchAllAclFilterGroup($filter, $filter);
        
        $this->assertTrue($group->filter($request));
    }
}
