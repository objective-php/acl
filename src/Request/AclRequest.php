<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 25/10/2017
 * Time: 17:29
 */

namespace ObjectivePHP\Acl\Request;

use ObjectivePHP\Acl\Actor\AclActorInterface;
use ObjectivePHP\Acl\Resource\AclResourceInterface;

class AclRequest implements AclRequestInterface
{

    /** @var  string */
    protected $permission;

    /** @var  AclActorInterface */
    protected $actor;

    /** @var  AclResourceInterface */
    protected $resource;

    /** @var  AclRequestContextInterface */
    protected $context;

    /**
     * AclRequest constructor.
     *
     * @param AclActorInterface               $actor
     * @param string                          $permission
     * @param AclResourceInterface|null       $resource
     * @param AclRequestContextInterface|null $context
     */
    public function __construct(
        AclActorInterface $actor,
        string $permission,
        AclResourceInterface $resource = null,
        AclRequestContextInterface $context = null
    ) {
        $this->setPermission($permission);
        $this->setActor($actor);

        if ($resource) {
            $this->setResource($resource);
        }

        if ($context) {
            $this->setContext($context);
        }
    }


    /**
     * @return string
     */
    public function getPermission(): string
    {
        return $this->permission;
    }

    /**
     * @param string $permission
     *
     * @return $this
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * @return AclActorInterface
     */
    public function getActor(): AclActorInterface
    {
        return $this->actor;
    }

    /**
     * @param AclActorInterface $actor
     *
     * @return $this
     */
    public function setActor($actor)
    {
        $this->actor = $actor;

        return $this;
    }

    /**
     * @return AclResourceInterface
     */
    public function getResource(): AclResourceInterface
    {
        return $this->resource;
    }

    /**
     * @param AclResourceInterface $resource
     *
     * @return $this
     */
    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasResource(): bool
    {
        return !empty($this->resource);
    }

    /**
     * @inheritdoc
     */
    public function hasContexts(): bool
    {
        return !empty($this->resource);
    }

    /**
     * Get Contexts
     *
     * @return AclRequestContextInterface
     */
    public function getContext(): AclRequestContextInterface
    {
        return $this->context;
    }

    /**
     * Set Contexts
     *
     * @param AclRequestContextInterface $context
     *
     * @return AclRequestInterface
     */
    public function setContext(AclRequestContextInterface $context): AclRequestInterface
    {
        $this->context = $context;

        return $this;
    }
}
