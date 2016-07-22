<?php

namespace Nextpack\Nextpack\Tests;

use Nextpack\Nextpack\Config;
use Nextpack\Nextpack\Sample;

/**
 * Class SampleTest
 *
 * @category Test
 * @package  Nextpack\Nextpack\Tests
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class SampleTest extends TestCase
{

    public function testSayHello()
    {
        $config = new Config();
        $sample = new Sample($config);

        $name = 'Mahmoud Zalt';

        $result = $sample->sayHello($name);

        $expected = $config->get('greeting') . ' ' . $name;

        $this->assertEquals($result, $expected);

    }

}
