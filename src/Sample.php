<?php

namespace Nextpack\Nextpack;

/**
 * Class Sample
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Sample
{

    /**
     * @var  \Nextpack\Nextpack\Config
     */
    private $config;

    /**
     * Sample constructor.
     *
     * @param \Nextpack\Nextpack\Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param $name
     *
     * @return  string
     */
    public function sayHello($name)
    {
        $greeting = $this->config->get('greeting');

        return $greeting . ' ' . $name;
    }

}
