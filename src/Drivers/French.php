<?php
namespace Nextpack\Nextpack\Drivers;

use Nextpack\Nextpack\Contracts\SayInterface;

/**
 * Class French
 *
 * @category Driver
 * @package  Nextpack\Nextpack\Drivers
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class French extends Driver implements SayInterface
{

    /**
     * {@inheritdoc}
     */
    public function hello($name)
    {
        return sprintf($this->get('format'), $name);
    }

}
