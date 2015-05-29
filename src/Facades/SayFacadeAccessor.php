<?php
namespace Nextpack\Nextpack\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class SayFacadeAccessor the Facade Accessor of the Say Facade
 *
 * @category
 * @package Nextpack\Nextpack\Facades
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class SayFacadeAccessor extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'nextpack.say';
    }
}
