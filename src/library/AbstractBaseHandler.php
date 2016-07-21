<?php
namespace Nextpack\Library;

/**
 * Class AbstractBaseHandler
 *
 * @category Abstract
 * @package  Nextpack\Library
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class AbstractBaseHandler
{

    use HelperTrait;

    /**
     * expected property name for default configuration file path
     */
    const CONFIG_FILE_PATH_PROPERTY = 'configFilePath';

    /**
     * create an instance of the driver
     *
     * @return \Nextpack\Nextpack\Contracts\DriverInterface
     */
    public function driver()
    {
        return $this->makeDriversFactory($this->makeConfig())->make();
    }

}
