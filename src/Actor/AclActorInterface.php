<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 14:55
 */

namespace ObjectivePHP\Acl\Actor;

interface AclActorInterface
{
    public function getAclGroups(): array;
    
    public function getAclId();
}
