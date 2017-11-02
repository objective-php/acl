<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 15:02
 */

namespace ObjectivePHP\Acl\Rule;

interface AclRuleInterface
{
    
    public function getPermissionPattern() : string;
    
    public function getFilters() : array;
    
    public function getRule() : bool;
}
