<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 11:55
 */

namespace Tests\ObjectivePHP\Acl;


use Codeception\Test\Unit;
use ObjectivePHP\Acl\AclEngine;
use ObjectivePHP\Acl\Actor\AclActorInterface;
use ObjectivePHP\Acl\Exception\InvalidAclFilterServiceSpecException;
use ObjectivePHP\Acl\Filter\AclFilterInterface;
use ObjectivePHP\Acl\Filter\AclFilterServiceSpecs;
use ObjectivePHP\Acl\Filter\AclFiltersFactory;
use ObjectivePHP\Acl\Request\AclRequestInterface;
use ObjectivePHP\Acl\Resource\AclResourceInterface;
use ObjectivePHP\Acl\Rule\AclRule;
use ObjectivePHP\Matcher\Matcher;
use ObjectivePHP\ServicesFactory\Specs\PrefabServiceSpecs;

class AclEngineTest extends Unit
{
    public function testFilterRegistration()
    {
        $acl = new AclEngine();
        
        $filtersFactory = $this->getMockBuilder(AclFiltersFactory::class)->getMock();
        $validFilter    = $this->getMockBuilder(AclFilterInterface::class)->getMock();
        
        $filtersFactory->expects($this->once())->method('registerService')->with(new PrefabServiceSpecs('test',
            $validFilter
        ))
        ;
        
        $acl->setFiltersFactory($filtersFactory);
        
        $acl->registerFilter('test', $validFilter);
        
    }
    
    public function testDefaultMatcherIsInstantiatedOnDemandIfNeeded()
    {
        $engine = new AclEngine();
        
        $this->assertInstanceOf(Matcher::class, $engine->getMatcher());
        
        $matcher = new Matcher();
        
        $engine->setMatcher($matcher);
        
        $this->assertSame($matcher, $engine->getMatcher());
    }
    
    public function testFiltersFactoryExceptionsAreCaught()
    {
        $acl = new AclEngine();
        
        $filtersFactory = new AclFiltersFactory();
        
        $validFilter = $this->getMockBuilder(AclFilterInterface::class)->getMock();
        
        $filtersFactory->registerService((new AclFilterServiceSpecs('test', get_class($validFilter)))->setFinal());
        
        $acl->setFiltersFactory($filtersFactory);
        
        $this->expectException(InvalidAclFilterServiceSpecException::class);
        $acl->registerFilter('test', $validFilter);
        
    }
    
    public function testRuleRegistration()
    {
        $acl = new AclEngine();
        
        $rule = new AclRule('resource.*', AclRule::ALLOW);
        $acl->registerRule($rule);
        
        $this->assertSame($rule, $acl->getRules()[0]);
        
    }
    
    public function testIsAllowed()
    {
        $acl = new AclEngine();
    
        $rule = new AclRule('resource.*', AclRule::ALLOW);
        $acl->registerRule($rule);
    
        $actor = $this->getMockBuilder(AclActorInterface::class)->getMock();
        $resource = $this->getMockBuilder(AclResourceInterface::class)->getMock();
        $this->assertTrue($acl->isAllowed($actor, 'resource.create'));
        $this->assertFalse($acl->isDenied($actor, 'resource.create'));
    
    }
    
    public function testIsDenied()
    {
        $acl = new AclEngine();
    
        $rule = new AclRule('resource.*', AclRule::DENY);
        $acl->registerRule($rule);
    
        $actor = $this->getMockBuilder(AclActorInterface::class)->getMock();
        $resource = $this->getMockBuilder(AclResourceInterface::class)->getMock();
        
        $this->assertFalse($acl->isAllowed($actor, 'resource.create', $resource));
        $this->assertTrue($acl->isDenied($actor, 'resource.create', $resource));
    
    }
    
    public function testIsAllowedWithFilters()
    {
        $acl = new AclEngine();
        
        $rule = new AclRule('resource.*', AclRule::ALLOW, new class implements AclFilterInterface {
            public function filter(AclRequestInterface $request) : bool {
                return false;
            }
        });
        $acl->registerRule($rule);
        
        $actor    = $this->getMockBuilder(AclActorInterface::class)->getMock();
        $this->assertFalse($acl->isAllowed($actor, 'resource.create'));
        $this->assertTrue($acl->isDenied($actor, 'resource.create'));
        
    }
    
    public function testIsDeniedWithFilters()
    {
        $acl = new AclEngine();
    
        $rule = new AclRule('resource.*', AclRule::DENY, new class implements AclFilterInterface
        {
            public function filter(AclRequestInterface $request): bool
            {
                $actor = $request->getActor();
                $resource = $request->hasResource() ? $request->getResource() : null;
                return false;
            }
        });
        $acl->registerRule($rule);
    
        $actor    = $this->getMockBuilder(AclActorInterface::class)->getMock();
        $resource = $this->getMockBuilder(AclResourceInterface::class)->getMock();
        $this->assertFalse($acl->isAllowed($actor, 'resource.create', $resource));
        $this->assertTrue($acl->isDenied($actor, 'resource.create', $resource));
    }
}
