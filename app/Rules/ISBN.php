<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * This class is inspired by Intervention Validator Package
 */
class ISBN implements Rule
{
    private $value;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->value = $value;

        switch (strlen($this->filteredValue())) {
            case 10:
                return $this->shortChecksumMatches();

            case 13:
                return $this->longChecksumMatches();
        }

        return false;
    }

    /**
     * Determine if checksum for short ISBN numbers is valid
     *
     * @return bool
     */
    private function shortChecksumMatches()
    {
        return $this->getShortChecksum() % 11 === 0;
    }

    /**
     * Calculate checksum of short ISBN numbers
     *
     * @return int
     */
    private function getShortChecksum()
    {
        $checksum = 0;
        $multiplier = 10;
        foreach (str_split($this->filteredValue()) as $digit) {
            $digit = strtolower($digit) == 'x' ? 10 : intval($digit);
            $checksum += $digit * $multiplier;
            $multiplier--;
        }

        return $checksum;
    }


    /**
     * Determine if long checksum is valid
     *
     * @return bool
     */
    private function longChecksumMatches()
    {
        return $this->getLongChecksum() % 10 === 0;
    }

    /**
     * Calculate checksum for long ISBN numbers
     *
     * @return int
     */
    private function getLongChecksum()
    {
        $checksum = 0;
        foreach (str_split($this->filteredValue()) as $num => $digit) {
            $multiplier = $num % 2 ? 3 : 1;
            $checksum += intval($digit) * $multiplier;
        }

        return $checksum;
    }

    /**
     * filter value to validate
     *
     * @return string
     */
    public function filteredValue()
    {
        return preg_replace("/[^0-9x]/i", '', $this->value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid ISBN 10 or ISBN 13 number';
    }
}
