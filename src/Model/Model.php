<?php

namespace Qoverflow\Model;

class Model
{
    protected $f3;
    protected $primaryKey;

    public function __construct(array $data = [])
    {
        $this->f3 = \Base::instance();
        foreach ($data as $property => $value) {
            // assemble the "set" method for this property
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $property)));

            // check that the "set" method exists (is callable)
            if (is_callable(array($this, $method))) {
                // call the method to set the value
                $this->$method($value);
            }
        }
    }

    public function toArray(): array
    {
        $ret = [];
        foreach (get_object_vars($this) as $property => $value) {
            if ($value === null) {
                continue;
            }
            
            // assemble the "get" method for this property
            $method = 'get'.str_replace(' ', '', ucwords(str_replace('_', ' ', $property)));
            // check that the "get" method exists (is callable)
            if (is_callable(array($this, $method))) {
                // call the method to get the value
                $ret[$property] = $this->$method();
            }
        }
 
        return $ret;
    }

    public function getId()
    {
        $method = 'get'.str_replace(' ', '', ucwords(str_replace('_', ' ', $this->primaryKey)));
        
        return $this->$method();
    }
}