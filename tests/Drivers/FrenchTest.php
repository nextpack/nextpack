<?php
namespace Nextpack\Nextpack\Drivers\Tests;

use Nextpack\Library\UndefinedPropertyException;
use Nextpack\Nextpack\Tests\TestCase;
use Nextpack\Nextpack\Drivers\French;

/**
 * Class FrenchTest
 *
 * @category test
 * @package  Nextpack\Nextpack\Drivers\Tests
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class FrenchTest extends TestCase
{

    /**
     * Test reading the configurations
     */
    public function testReadingConfigurations()
    {
        $configurations = [
            'format' => 'Salut %s.',
        ];

        $input = 'Mahmoud Zalt';
        $expectedOutput = 'Salut Mahmoud Zalt.';

        $driver = New French($configurations);
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

        $driver = New French($configurations);
        $driver->hello($input);

    }

}
