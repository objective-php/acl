<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 15:19
 */

namespace ObjectivePHP\Acl\Filter;


use ObjectivePHP\Acl\Exception\InvalidAclFilterServiceSpecException;
use ObjectivePHP\ServicesFactory\Specs\ClassServiceSpecs;

class AclFilterServiceSpecs extends ClassServiceSpecs
{
    public function setClass($class)
    {
        if(!is_subclass_of($class, AclFilterInterface::class))
        {
            throw new InvalidAclFilterServiceSpecException('Only instances of "' . AclFilterServiceSpecs::class . ' can be registered as Acl filter');
        }
        
        return parent::setClass($class);
    }
    
    
}
