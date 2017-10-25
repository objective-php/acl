<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 15:33
 */

namespace ObjectivePHP\Acl;


use ObjectivePHP\Acl\Actor\AclActorInterface;
use ObjectivePHP\Acl\Exception\InvalidAclFilterServiceSpecException;
use ObjectivePHP\Acl\Filter\AclFilterInterface;
use ObjectivePHP\Acl\Filter\AclFiltersFactory;
use ObjectivePHP\Acl\Filter\AclFiltersFactoryInterface;
use ObjectivePHP\Acl\Request\AclRequest;
use ObjectivePHP\Acl\Request\AclRequestContextInterface;
use ObjectivePHP\Acl\Request\AclRequestInterface;
use ObjectivePHP\Acl\Resource\AclResourceInterface;
use ObjectivePHP\Acl\Rule\AclRule;
use ObjectivePHP\Acl\Rule\AclRuleInterface;
use ObjectivePHP\Matcher\Matcher;
use ObjectivePHP\ServicesFactory\Exception\Exception;
use ObjectivePHP\ServicesFactory\Specs\PrefabServiceSpecs;

class AclEngine implements AclEngineInterface
{
    /** @var  AclFiltersFactoryInterface */
    protected $filtersFactory;
    
    /** @var  Matcher */
    protected $matcher;
    
    /** @var array */
    protected $rules = [];
    
    public function isDenied(
        AclActorInterface $actor,
        string $permission,
        AclResourceInterface $resource = null,
        AclRequestContextInterface $context = null
    ): bool {
        return !$this->isAllowed($actor, $permission, $resource, $context);
    }
    
    public function isAllowed(
        AclActorInterface $actor,
        string $permission,
        AclResourceInterface $resource = null,
        AclRequestContextInterface $context = null
    ): bool {
        
        $request = new AclRequest($actor, $permission, $resource);
        
        return $this->query($request);
        
    }
    
    protected function query(AclRequestInterface $request): bool
    {
        $matcher = $this->getMatcher();
        
        $match = false;
        
        /** @var AclRuleInterface $rule */
        foreach ($this->getRules() as $rule) {
            
            if ($matcher->match($rule->getPermissionPattern(), $request->getPermission())) {
                if ($filters = $rule->getFilters()) {
                    $match = true;
                    /** @var AclFilterInterface $filter */
                    foreach ($filters as $filter) {
                        if (!$filter->filter($request)) {
                            $match = false;
                            break;
                        }
                    }
                } else {
                    $match = true;
                }
                
                switch ($rule->getRule()) {
                    
                    case AclRule::DENY:
                        if ($match) {
                            return false;
                        }
                        break;
                    
                    case AclRule::ALLOW:
                        if ($match) {
                            return true;
                        }
                        break;
                }
                
            }
            
            
        }
        
        return $match;
    }
    
    /**
     * @return Matcher
     */
    public
    function getMatcher(): Matcher
    {
        
        if (is_null($this->matcher)) {
            $this->matcher = new Matcher();
        }
        
        return $this->matcher;
    }
    
    /**
     * @param Matcher $matcher
     *
     * @return $this
     */
    public
    function setMatcher(
        $matcher
    ) {
        $this->matcher = $matcher;
        
        return $this;
    }
    
    public
    function getRules(): array
    {
        return $this->rules;
    }
    
    public
    function registerRule(
        AclRuleInterface $rule
    ) {
        $this->rules[] = $rule;
    }
    
    public
    function registerFilter(
        string $id,
        AclFilterInterface $filter
    ) {
        $factory = $this->getFiltersFactory();
        try {
            $factory->registerService(new PrefabServiceSpecs($id, $filter));
        } catch (Exception $exception) {
            throw new InvalidAclFilterServiceSpecException('Something went wrong when trying to register an ACL filter.',
                0, $exception);
        }
    }
    
    /**
     * @return AclFiltersFactory
     */
    public
    function getFiltersFactory(): AclFiltersFactoryInterface
    {
        return $this->filtersFactory;
    }
    
    /**
     * @param AclFiltersFactory $filtersFactory
     */
    public
    function setFiltersFactory(
        AclFiltersFactoryInterface $filtersFactory
    ) {
        $this->filtersFactory = $filtersFactory;
        
        return $this;
    }
    
}
