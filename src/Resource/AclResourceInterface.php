<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 14:58
 */

namespace ObjectivePHP\Acl\Resource;


interface AclResourceInterface
{
    public function getOwner();
    
    public function getGroup();
    
}
