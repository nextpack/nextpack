<?php
namespace Nextpack\Library;

use Illuminate\Config\Repository;

/**
 * Class Config extends the Laravel `Illuminate\Config\Repository` thus it can be used as in Laravel.
 * it also contains some helper functions to facilitate reading the configuration from this package.
 * Once an object of this class is initialized it will automatically read the package config file.
 *
 * @category Adapter
 * @package  Nextpack\Library
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class Config extends Repository
{

    use HelperTrait;

    /**
     * @param array $configFilePath
     */
    public function __construct($configFilePath)
    {
        $files = $this->getConfigurationFiles($configFilePath);

        // Warning: This assumes there's only one config file per package
        // the app can load multiple files automatically, but to prevent the
        // user from providing the config file name to use the package, we
        // use the `reset()` to read only the first file in the config directory.
        // TODO: make this supports multiple files
        $this->configFileName = basename(reset($files), '.php');

        $this->loadConfigurationFiles($files);
    }

    /**
     * extend the functionality of the default get() from the Repository
     * by always prepending the keys with the config file name
     *
     * @param      $key
     * @param null $configurationFileName
     *
     * @return mixed
     */
    public function read($key, $configurationFileName = null)
    {
        $configFileName = '';
        if(is_null($configurationFileName)){
            $configFileName = $this->configFileName;
        }

        return $this->get($configFileName . '.' . $key);
    }

    /**
     * helper function to return the driver default name
     *
     * @return mixed
     */
    public function driverName()
    {
        return $this->read('default');
    }

    /**
     * helper function to return the parameters of the driver
     *
     * @param $name
     *
     * @return mixed
     */
    public function driverParameters($name = null)
    {
        $name = !is_null($name) ? $name : $this->driverName();

        return $this->read('drivers' . '.' . $name);
    }
}
