<?php
namespace ObjectivePHP\Acl\Filter;

use ObjectivePHP\Acl\Request\AclRequestInterface;

/**
 * Check whether or not the actor of the resource is the same as the actor of the acl request
 *
 * @package ObjectivePHP\Acl\Filter
 */
class IsOwner implements AclFilterInterface
{
    /**
     * @inheritdoc
     */
    public function filter(AclRequestInterface $request): bool
    {
        if ($request->hasResource()) {
            return $request->getResource()->getOwner()->getAclId() === $request->getActor()->getAclId();
        }

        return false;
    }
}
