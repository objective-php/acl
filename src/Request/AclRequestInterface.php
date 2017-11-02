<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 14:59
 */

namespace ObjectivePHP\Acl\Request;

use ObjectivePHP\Acl\Actor\AclActorInterface;
use ObjectivePHP\Acl\Resource\AclResourceInterface;

interface AclRequestInterface
{
    public function getActor(): AclActorInterface;

    public function hasResource() : bool;

    public function getResource(): AclResourceInterface;

    public function getPermission(): string;

    public function hasContexts(): bool;

    public function getContexts(): AclRequestContextInterface;
}
