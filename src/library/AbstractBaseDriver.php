<?php
namespace Nextpack\Library;

/**
 * Class AbstractBaseDriver
 *
 * @category Abstract
 * @package  Nextpack\Library
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class AbstractBaseDriver implements InitializableInterface
{

    use HelperTrait;

    /**
     * expected property name for default configurations
     */
    const DEFAULT_CONFIGURATION_PROPERTY = 'defaultConfiguration';

    /**
     * {@inheritdoc}
     */
    public function make($driverConfig = null, $appConfig = null)
    {
        $this->attachAppConfiguration($appConfig);
        $this->attachDriverConfiguration($driverConfig);

        return $this;
    }

    /**
     * set the attributes on the class after validating them
     *
     * @param $configuration
     */
    private function attachDriverConfiguration($configuration)
    {
        foreach ($this->overrideMissedConfigs($configuration) as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * attach all the configurations on the `appConfig` property
     *
     * @param $configuration
     */
    private function attachAppConfiguration($configuration)
    {
        $this->appConfig = $configuration;
    }

    /**
     * check for missed configurations and override them by the default configurations
     * specified by the user.
     *
     * @param $configuration
     *
     * @return array
     */
    private function overrideMissedConfigs($configuration)
    {
        $defaultConfiguration = $this->getProperty(self::DEFAULT_CONFIGURATION_PROPERTY, false);

        return $this->mergeConfiguration($configuration, $defaultConfiguration);
    }

    /**
     * return the requested property if exist or throw an exception
     *
     * @param $property
     *
     * @return bool
     */
    public function get($property)
    {
        $propertyValue = $this->getProperty($property, true);

        return $propertyValue;
    }

    /**
     * get all the configurations
     *
     * @return bool
     */
    public function getAll()
    {
        return $this->get('appConfig');
    }


}
