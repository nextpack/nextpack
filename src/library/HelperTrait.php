<?php
namespace Nextpack\Library;

use ReflectionClass;
use Symfony\Component\Finder\Finder;

/**
 * Class Helper
 *
 * @category Trait
 * @package  Nextpack\Library
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
trait HelperTrait
{

    /**
     * create an instance of the config file.
     *
     * @return \Nextpack\Library\Config
     */
    public function makeConfig()
    {
        // check if properties defined by the user and pass them to the config file if so
        $configFilePath = $this->getProperty(self::CONFIG_FILE_PATH_PROPERTY, false);

        // config file path is not defined by the user then get the config file path automatically
        if (is_null($configFilePath)) {
            $configFilePath = $this->getConfigFilePath();
        }

        return new Config($configFilePath);
    }

    /**
     * get the config file path
     *
     * @return string
     */
    public function getConfigFilePath()
    {
        // get the child class full path (the Client class)
        $fullFilePathName = (new ReflectionClass(get_class($this)))->getFileName();

        // remove the file name (to get the package root directory) and move forward to the Config directory
        return $this->removeLastDir($fullFilePathName, 1) . '/Config';
    }

    /**
     * @param \Nextpack\Library\Config $config
     *
     * @return \Nextpack\Library\DriversFactory
     */
    public function makeDriversFactory(Config $config)
    {
        return new DriversFactory($config);
    }

    /**
     * remove the last `$level` of directories from a path
     * example 'aaa/bbb/ccc' remove 2 levels will return aaa/
     *
     * @param $path
     * @param $level
     *
     * @return mixed
     */
    public function removeLastDir($path, $level)
    {
        if (is_int($level) && $level > 0) {
            $path = preg_replace('#\/[^/]*$#', '', $path);

            return $this->removeLastDir($path, (int)$level - 1);
        }

        return $path;
    }


    /**
     * check if property is defined on this class or any of it's childes
     *
     * @param $property
     *
     * @return bool
     */
    public function checkIfExist($property)
    {
        $result = false;
        $propertiesArray = get_object_vars($this);

        if ($this->arrayHas($propertiesArray, $property)) {
            $result = true;
        }

        return $result;
    }

    /**
     * @param $array
     * @param $key
     *
     * @return  bool
     */
    private function arrayHas($array, $key)
    {
        if (!$array) {
            return false;
        }

        if (is_null($key)) {
            return false;
        }

        if ($this->exists($array, $key)) {
            return true;
        }

        foreach (explode('.', $key) as $segment) {
            if ($this->accessible($array) && $this->exists($array, $segment)) {
                $array = $array[$segment];
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * @param $array
     * @param $key
     *
     * @return  bool
     */
    private function exists($array, $key)
    {
        if ($array instanceof ArrayAccess) {
            return $array->offsetExists($key);
        }

        return array_key_exists($key, $array);
    }

    /**
     * @param $value
     *
     * @return  bool
     */
    private function accessible($value)
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }

    /**
     * return property after checking if it exist
     *
     * @param      $property
     * @param bool $allow allow to fail or not (true means throw exception when not exist)
     *
     * @return null
     */
    public function getProperty($property, $allow = true)
    {
        $value = null;

        $exist = $this->checkIfExist($property);

        if (!$exist && $allow) {
            // yes throw exception from there
            throw new UndefinedPropertyException(
                "Trying to access undefined property ($property) which doesn't exist in the config file."
            );
        }

        $propertiesArray = get_object_vars($this);

        if ($this->arrayHas($propertiesArray, $property)) {
            $value = $propertiesArray[$property];
        }

        return $value;
    }


    /**
     * Get the configuration files for the selected environment
     *
     * @param $path
     *
     * @return array
     */
    public function getConfigurationFiles($path)
    {
        if (!is_dir($path)) {
            return [];
        }

        $files = [];
        $phpFiles = Finder::create()->files()->name('*.php')->in($path)->depth(0);

        foreach ($phpFiles as $file) {
            $files[basename($file->getRealPath(), '.php')] = $file->getRealPath();
        }

        return $files;
    }

    /**
     * Load the configuration items from all of the files.
     *
     * @param $files
     */
    public function loadConfigurationFiles($files)
    {
        foreach ($files as $fileKey => $path) {
            $this->set($fileKey, require $path);
        }

        foreach ($files as $fileKey => $path) {
            $envConfig = require $path;

            foreach ($envConfig as $envKey => $value) {
                $this->set($fileKey . '.' . $envKey, $value);
            }
        }
    }

    /**
     * @param $configuration
     * @param $defaultConfiguration
     *
     * @return array
     */
    public function mergeConfiguration($configuration, $defaultConfiguration)
    {
        if ($defaultConfiguration) {
            $configuration = array_merge($defaultConfiguration, $configuration);
        }

        return $configuration;
    }

}
