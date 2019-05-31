<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 02/11/2017
 * Time: 15:29
 */

namespace ObjectivePHP\Acl\Filter;


use ObjectivePHP\Acl\Request\AclRequestInterface;
use ObjectivePHP\Primitives\Collection\Collection;

abstract class AbstractAclFilterGroup implements AclFilterGroupInterface
{
    
    /** @var Collection  */
    protected $filters;
    
    /**
     * MatchAllAclFilterGroup constructor.
     *
     * @param array $filters
     */
    public function __construct(AclFilterInterface ...$filters)
    {
        $this->filters = Collection::cast($filters);
    }
    
    /**
     * @return Collection
     */
    public function getFilters(): Collection
    {
        return $this->filters;
    }
    
    /**
     * @param Collection $filters
     *
     * @return $this
     */
    public function setFilters(...$filters)
    {
        $this->filters = Collection::cast($filters);
        
        return $this;
    }
    
}
