<?php
namespace Nextpack\Library;

/**
 * Class DriversFactory is responsible of initializing objects based on the default driver name.
 *
 * @category Factory
 * @package  Nextpack\Library
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class DriversFactory
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * @var string
     */
    protected $namespace;

    /**
     * all the config file items
     *
     * @var []
     */
    protected $appConfig;

    /**
     * read the required configurations values from the config file and attach them
     * on this object to be used internally when needed.
     *
     * @param \Nextpack\Library\Config $config
     *
     * @throws \Nextpack\Library\MissingConfigurationException
     */
    public function __construct(Config $config)
    {
        $this->name = $config->driverName();
        $this->namespace = $config->read('namespace');
        $this->parameters = $config->driverParameters();
        $this->appConfig = $config->all();

        $this->checkRequiredFields();
    }

    /**
     * TODO: this function should not be in this class, the validation must happen on another layer.
     * make sure required fields exist and throw exceptions if any of the required fields is missed
     */
    private function checkRequiredFields()
    {
        $validator = new ConfigurationValidator();
        $validator->validate($this->name);
        $validator->validate($this->namespace);
    }

    /**
     * initialize the driver instance and return it
     *
     * @param null $name       Driver name
     * @param null $parameters Configurations specific on for a driver
     * @param null $namespace  Drivers namespace
     * @param null $appConfig  Configurations found on the root of the config file
     *
     * @return \Nextpack\Nextpack\Contracts\DriverInterface
     */
    public function make($name = null, $parameters = null, $namespace = null, $appConfig = null)
    {
        $name = $name ? : $this->name;
        $parameters = $parameters ? : $this->parameters;
        $namespace = $namespace ? : $this->namespace;
        $appConfig = $appConfig ? : $this->appConfig;

        // prepare the full driver class name
        $driverClass = $namespace . ucwords($name);

        // validate the driver exist and can be initialized
        (new DriverValidator())->validate($driverClass);

        // initialize the driver object and pass the parameters to it's constructor
        return (new $driverClass())->make($parameters, $appConfig);
    }

}
