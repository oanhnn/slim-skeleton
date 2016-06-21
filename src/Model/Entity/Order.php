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

/**
 * Order model entity
 * This entity is used for example
 */
class Order extends Base
{

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $message;

    /**
     * @var \DateTime
     */
    public $createdAt;

    /**
     * @param string $time
     */
    public function setCreatedAt($time = null)
    {
        if ($time) {
            $this->createdAt = new \DateTime($time);
        }
    }
}
