<?php
namespace Nextpack\Library;

/**
 * Interface InitializableInterface
 * @package Nextpack\Library
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
interface InitializableInterface
{

    /**
     * @param null $driverConfig
     * @param null $appConfig
     *
     * @return $this
     */
    public function make($driverConfig = null, $appConfig = null);

}
