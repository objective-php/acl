<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 14:59
 */

namespace ObjectivePHP\Acl\Request;


use ObjectivePHP\Acl\Actor\AclActorInterface;

interface AclRequestInterface
{
    public function getActor(): AclActorInterface;
    
    public function hasResource() : bool;
    
    public function getResource();
    
    public function getPermission(): string;
}
