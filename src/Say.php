<?php

namespace Nextpack\Nextpack;

use Nextpack\Nextpack\Validators\NameValidator;

/**
 * The Access Point to your package functionality.
 *
 * @category Access Point
 *
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class Say extends Handler
{
    /**
     * @var \Nextpack\Nextpack\Validators\NameValidator
     */
    private $nameValidator;

    /**
     * @param \Nextpack\Nextpack\Validators\NameValidator $nameValidator
     */
    public function __construct(NameValidator $nameValidator)
    {
        $this->nameValidator = $nameValidator;
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function hello($name)
    {
        // validate input $name, if not valid an Exception will be thrown
        $this->nameValidator->validate($name);

        // create an instance of the default driver defined in the config file, and call a method on it.
        return $this->driver()->hello($name);
    }
}
