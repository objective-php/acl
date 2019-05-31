<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 02/11/2017
 * Time: 15:29
 */

namespace ObjectivePHP\Acl\Filter;


use ObjectivePHP\Acl\Request\AclRequestInterface;

class MatchAllAclFilterGroup extends AbstractAclFilterGroup
{
    
    
    public function filter(AclRequestInterface $request): bool
    {
        foreach($this->getFilters() as $filter) {
            if(!$filter->filter($request)) return false;
        }
        
        return true;
    }
}
