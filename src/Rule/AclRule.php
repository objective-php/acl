<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 16:47
 */

namespace ObjectivePHP\Acl\Rule;

use ObjectivePHP\Acl\Filter\AclFilterInterface;

class AclRule implements AclRuleInterface
{
    
    const ALLOW = true;
    const DENY = false;
    
    /** @var  string */
    protected $permissionPattern;
    
    /** @var array */
    protected $filters = [];
    
    /** @var bool  */
    protected $rule;
    
    /**
     * AclRule constructor.
     *
     * @param string $permissionPattern
     * @param bool   $rule                  Should this rule ALLOW (true) or DENY (false) the permission
     * @param array  $filters
     */
    public function __construct($permissionPattern, bool $rule, AclFilterInterface ...$filters)
    {
        $this->permissionPattern = $permissionPattern;
        $this->filters           = $filters;
        $this->rule = $rule;
    }
    
    
    /**
     * @return string
     */
    public function getPermissionPattern(): string
    {
        return $this->permissionPattern;
    }
    
    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }
    
    public function addFilter(AclFilterInterface ...$filters)
    {
        $this->filters = array_merge($this->filters, $filters);
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function getRule(): bool
    {
        return $this->rule;
    }
}
