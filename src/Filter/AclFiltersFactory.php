<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 14:52
 */

namespace ObjectivePHP\Acl\Filter;


use ObjectivePHP\Acl\Exception\InvalidAclFilterServiceSpecException;
use ObjectivePHP\ServicesFactory\ServicesFactory;
use ObjectivePHP\ServicesFactory\Specs\PrefabServiceSpecs;

class AclFiltersFactory extends ServicesFactory implements AclFiltersFactoryInterface
{
    public function registerService(...$servicesSpecs)
    {
        
        foreach($servicesSpecs as $servicesSpec)
        {
            if(!$servicesSpec instanceof AclFilterServiceSpecs && (!$servicesSpec instanceof PrefabServiceSpecs || !$servicesSpec->getInstance() instanceof AclFilterInterface)) {
                throw new InvalidAclFilterServiceSpecException('One filter service at least is neither an "' . AclFilterServiceSpecs::class . '" instance or an "' . PrefabServiceSpecs::class . '" embedding an "' . AclFilterInterface::class . '" instance.');
            }
        }
        
        return parent::registerService(...$servicesSpecs);
    }
    
}
