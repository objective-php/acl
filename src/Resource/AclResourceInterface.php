<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 14:58
 */

namespace ObjectivePHP\Acl\Resource;

use ObjectivePHP\Acl\Actor\AclActorInterface;

interface AclResourceInterface
{
    /** @return AclActorInterface */
    public function getOwner(): AclActorInterface;
    
    public function getGroup();
}
