<?php

namespace Nextpack\Nextpack\Drivers\Tests;

use Nextpack\Nextpack\Drivers\French;
use Nextpack\Nextpack\Tests\TestCase;

/**
 * Class FrenchTest.
 *
 * @category test
 *
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class FrenchTest extends TestCase
{
    /**
     * Test reading the configurations.
     */
    public function testReadingConfigurations()
    {
        $configurations = [
            'format' => '%s, %s...',
        ];

        $input = 'Mahmoud Zalt';
        $expectedOutput = 'Bonjour, Mahmoud Zalt...';

        $driver = (new French())->make($configurations);
        $output = $driver->hello($input);

        $this->assertEquals($output, $expectedOutput);
    }

    /**
     * @expectedException \Nextpack\Library\UndefinedPropertyException
     */
    public function testAccessingEmptyConfigurationThrowsException()
    {
        $configurations = [
            // empty configuration
        ];

        $input = 'Mahmoud Zalt';

        $driver = (new French())->make($configurations);
        $driver->hello($input);
    }
}
