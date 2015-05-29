<?php
namespace Nextpack\Nextpack\Tests;

use Nextpack\Nextpack\Say;
use Nextpack\Nextpack\Validators\NameValidator;

/**
 * Class SayTest
 *
 * @category Test
 * @package  Nextpack\Nextpack\Tests
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class SayTest extends TestCase
{

    /**
     * Test the hello function is returning the expected result.
     */
    public function testSayingHello()
    {
        $input = 'Mahmoud Zalt';
        $expectedOutput = 'Hello, Mahmoud Zalt.';

        print $output = (new Say(new NameValidator()))->hello($input); // printing just for fun :)

        $this->assertEquals($output, $expectedOutput);
    }

    /**
     * @expectedException \Nextpack\Nextpack\Exceptions\MissedNameException
     */
    public function testThrowExceptionWhenNameIsEmpty()
    {
        $input = '';

        print $output = (new Say(new NameValidator()))->hello($input); // printing just for fun :)
    }
}
