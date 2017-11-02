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
        
        foreach ($servicesSpecs as $servicesSpec) {
            if (!$servicesSpec instanceof AclFilterServiceSpecs &&
                (!$servicesSpec instanceof PrefabServiceSpecs
                    || !$servicesSpec->getInstance() instanceof AclFilterInterface
                )
            ) {
                throw new InvalidAclFilterServiceSpecException(sprintf(
                    'One filter service at least is neither an "%s" instance 
                    or an "%s" embedding an "%s" instance.',
                    AclFilterServiceSpecs::class,
                    PrefabServiceSpecs::class,
                    AclFilterInterface::class
                ));
            }
        }
        
        return parent::registerService(...$servicesSpecs);
    }
}
