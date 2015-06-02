<?php
namespace Nextpack\Nextpack;

use Nextpack\Library\Config;

/**
 * The Access Point to your package functionality.
 *
 * @category Access Point
 * @package  Nextpack\Nextpack
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class Sing extends Handler
{

    /**
     * @param $songName
     *
     * @return string
     */
    public function song($songName)
    {
        return "Can you hear me singing $songName :P";
    }

}
