<?php
/**
 * This file is part of `oanhnn/slim-skeleton` project.
 *
 * (c) Oanh Nguyen <oanhnn.bk@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace App\Model\Entity;

use Doctrine\Common\Util\Inflector;

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
