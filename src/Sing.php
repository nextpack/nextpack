<?php

namespace Nextpack\Nextpack;

/**
 * The Access Point to your package functionality.
 *
 * @category Access Point
 *
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
