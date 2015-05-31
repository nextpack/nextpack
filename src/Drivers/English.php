<?php
namespace Nextpack\Nextpack\Drivers;

use Nextpack\Nextpack\Contracts\SayInterface;

/**
 * Class English
 *
 * @category Driver
 * @package  Nextpack\Nextpack\Drivers
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class English extends Driver implements SayInterface
{

    /**
     * {@inheritdoc}
     */
    public function hello($name)
    {
        return sprintf($this->get('format'), 'Hello', $name);
    }

}
