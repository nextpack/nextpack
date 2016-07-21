<?php
namespace Nextpack\Library;

use PHPUnit_Framework_TestCase as PHPUnit;

/**
 * Class AbstractTestCase
 *
 * @category Abstract
 * @package  Nextpack\Library
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class AbstractTestCase extends PHPUnit
{

    public function __construct()
    {
        parent::__construct();
    }

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

}
