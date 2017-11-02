<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 15:01
 */

namespace ObjectivePHP\Acl;

use ObjectivePHP\Acl\Actor\AclActorInterface;
use ObjectivePHP\Acl\Filter\AclFilterInterface;
use ObjectivePHP\Acl\Filter\AclFiltersFactoryInterface;
use ObjectivePHP\Acl\Request\AclRequestContextInterface;
use ObjectivePHP\Acl\Resource\AclResourceInterface;
use ObjectivePHP\Acl\Rule\AclRuleInterface;

interface AclEngineInterface
{
    public function isAllowed(
        AclActorInterface $actor,
        string $permission,
        AclResourceInterface $resource = null,
        AclRequestContextInterface $context = null
    ): bool;
    
    public function isDenied(
        AclActorInterface $actor,
        string $permission,
        AclResourceInterface $resource = null,
        AclRequestContextInterface $context = null
    ): bool;
    
    public function registerRule(AclRuleInterface $rule);
    
    public function setFiltersFactory(AclFiltersFactoryInterface $filtersFactory);
    
    public function registerFilter(string $id, AclFilterInterface $filter);
    
    public function getRules(): array;
}
