<?php
namespace Nextpack\Nextpack\Drivers\Tests;

use Nextpack\Nextpack\Drivers\English;
use Nextpack\Nextpack\Tests\TestCase;

/**
 * Class EnglishTest
 *
 * @category Test
 * @package  Nextpack\Nextpack\Drivers\Tests
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class EnglishTest extends TestCase
{

    /**
     * Test reading the configurations
     */
    public function testReadingConfigurations()
    {
        $configurations = [
            'format' => '%s, %s :D',
        ];

        $input = 'Mahmoud Zalt';
        $expectedOutput = 'Hello, Mahmoud Zalt :D';

        $driver = (New English())->make($configurations);
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

        $driver = (New English())->make($configurations);
        $driver->hello($input);
    }

}
