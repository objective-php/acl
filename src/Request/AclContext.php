<?php
namespace ObjectivePHP\Acl\Request;

/**
 * Class AclContext
 *
 * @package ObjectivePHP\Acl\Request
 */
class AclContext implements AclRequestContextInterface
{
    /**
     * @var array
     */
    protected $values;

    /** @var int */
    protected $pos;

    /** @inheritdoc */
    public function offsetExists($offset)
    {
        return isset($this->values[$offset]);
    }

    /** @inheritdoc */
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->values[$offset];
        }

        return null;
    }

    /** @inheritdoc */
    public function offsetSet($offset, $value)
    {
        $this->values[$offset] = $value;
    }

    /** @inheritdoc */
    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->values[$offset]);
        }
    }

    /** @inheritdoc */
    public function current()
    {
        return $this->values[$this->pos];
    }

    /** @inheritdoc */
    public function next()
    {
        ++$this->pos;
    }

    /** @inheritdoc */
    public function key()
    {
        return $this->pos;
    }

    /** @inheritdoc */
    public function valid()
    {
        return isset($this->values[$this->pos]);
    }

    /** @inheritdoc */
    public function rewind()
    {
        $this->pos = 0;
    }
}
