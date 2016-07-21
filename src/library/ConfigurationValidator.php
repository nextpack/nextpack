<?php
namespace Nextpack\Library;

/**
 * Class ConfigurationValidator
 *
 * @category Validator
 * @package  Nextpack\Nextpack\Validators
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class ConfigurationValidator extends AbstractValidator
{

    /**
     * Validate the $input not empty
     *
     * @param $input
     *
     * @throws MissedConfigurationException
     */
    public function validate($input)
    {
        if (!$input) {
            throw new MissedConfigurationException("Missing the ($input) from the config file.");
        }
    }

}
