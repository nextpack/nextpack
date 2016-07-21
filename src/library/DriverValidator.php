<?php
namespace Nextpack\Library;

/**
 * Class DriverValidator
 *
 * @category Validator
 * @package  Nextpack\Library
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class DriverValidator extends AbstractValidator
{

    /**
     * Validate the $input not empty
     *
     * @param $driverClass
     *
     * @throws UnsupportedDriverException
     */
    public function validate($driverClass)
    {
        // TODO: make sure it extends the driver abstract class (add interface on the abstract and check against it)
        if (!class_exists($driverClass)) {
            throw new UnsupportedDriverException("The driver ($driverClass) does not exist.");
        }
    }

}
