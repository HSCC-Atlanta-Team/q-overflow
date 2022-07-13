<?php

namespace Qoverflow\Model;

class UpdateOperation extends Model
{
    protected $operation;
    protected $target;



    /**
     * Get the value of operation
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Set the value of operation
     */
    public function setOperation($operation): self
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * Get the value of target
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set the value of target
     */
    public function setTarget($target): self
    {
        $this->target = $target;

        return $this;
    }
}