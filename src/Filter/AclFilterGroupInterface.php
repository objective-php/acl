<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 14:54
 */

namespace ObjectivePHP\Acl\Filter;

use ObjectivePHP\Primitives\Collection\Collection;

interface AclFilterGroupInterface extends AclFilterInterface
{
    public function getFilters() : Collection;
    
}
