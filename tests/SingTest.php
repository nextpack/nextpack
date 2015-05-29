<?php
namespace Nextpack\Nextpack\Tests;

use Nextpack\Nextpack\Sing;

/**
 * Class SingTest
 *
 * @category Test
 * @package  Nextpack\Nextpack\Tests
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class SingTest extends TestCase
{

    /**
     * Test the song function is returning the expected result.
     */
    public function testSingingSong()
    {
        $input = 'Bang Bang';
        $expectedOutput = "Can you hear me singing $input :P";

        print $output = (new Sing())->song($input); // printing just for fun :)

        $this->assertEquals($output, $expectedOutput);
    }

}
