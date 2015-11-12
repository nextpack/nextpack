<?php

namespace Nextpack\Nextpack\Contracts;

/**
 * Interface SayInterface.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
interface SayInterface
{
    /**
     * Say hello :).
     *
     * @param string $name
     *
     * @return string
     */
    public function hello($name);
}
