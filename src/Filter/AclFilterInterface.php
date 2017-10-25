<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 14:54
 */

namespace ObjectivePHP\Acl\Filter;


use ObjectivePHP\Acl\Request\AclRequestInterface;

interface AclFilterInterface
{
    public function filter(AclRequestInterface $request);
}
