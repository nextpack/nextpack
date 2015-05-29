<?php
namespace Nextpack\Nextpack\Validators;

use Nextpack\Nextpack\Exceptions\MissedNameException;

/**
 * Class NameValidator
 *
 * @category Validator
 * @package Nextpack\Nextpack\Validators
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class NameValidator extends Validator
{

    /**
     * Validate the $input not empty
     *
     * @param $input
     * @throws MissedNameException
     */
    public function validate($input)
    {
        if (!$input) {
            throw new MissedNameException("You missed the Name.");
        }
    }

}
