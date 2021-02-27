<?php

namespace App\Model\Entity;

use App\Utility\Inflector;

/**
 * Base model entity
 */
class Base
{

    /**
     * Magic set
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $property = Inflector::camelize($name);
        $method = 'set' . ucfirst($property);

        if (method_exists($this, $method)) {
            $this->{$method}($value);
        } elseif (property_exists($this, $property)) {
            $this->{$property} = $value;
        }
    }

    /**
     * Magic get
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        $property = Inflector::camelize($name);
        $method = 'get' . ucfirst($property);

        if (method_exists($this, $method)) {
            return $this->{$method}();
        } elseif (property_exists($this, $property)) {
            return $this->{$property};
        }
    }
}
