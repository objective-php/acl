<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 16:00
 */

namespace Tests\ObjectivePHP\Acl\Filter;


use Codeception\Test\Unit;
use ObjectivePHP\Acl\Exception\InvalidAclFilterServiceSpecException;
use ObjectivePHP\Acl\Filter\AclFilterInterface;
use ObjectivePHP\Acl\Filter\AclFilterServiceSpecs;
use ObjectivePHP\Acl\Filter\AclFiltersFactory;
use ObjectivePHP\Acl\Request\AclRequestInterface;
use ObjectivePHP\ServicesFactory\Specs\ClassServiceSpecs;
use ObjectivePHP\ServicesFactory\Specs\PrefabServiceSpecs;

class AclFiltersFactoryTest extends Unit
{
    public function testOnlyAclFilterOrPrefabServiceSpecsAreAllowed()
    {
        $factory = new AclFiltersFactory();
    
        $validService = new AclFilterServiceSpecs('first', AclFactoryTestFilter::class);
    
        $factory->registerService($validService);
    
        $otherValidService = new PrefabServiceSpecs('second', new AclFactoryTestFilter());
    
        $factory->registerService($otherValidService);
    
    }
    
    public function testServicesSpecsOtherThanAclFilterOrPrefabServiceSpecsAreRejected()
    {
        $factory = new AclFiltersFactory();
        
        $this->expectException(InvalidAclFilterServiceSpecException::class);
        $invalidService = new ClassServiceSpecs('third', \stdClass::class);
        $factory->registerService($invalidService);
    }
    
    public function testPrefabServiceNotEmbeddingAnAclFilterInterfaceInstanceAreRejected()
    {
        $factory = new AclFiltersFactory();
        $this->expectException(InvalidAclFilterServiceSpecException::class);
        $invalidService = new PrefabServiceSpecs('whatever', new \stdClass);
        $factory->registerService($invalidService);
    }
    
}

class AclFactoryTestFilter implements AclFilterInterface {
    
    public function filter(AclRequestInterface $request)
    {
        // TODO: Implement filter() method.
    }
    
}
