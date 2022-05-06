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
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $this->value = $value;

        return match (strlen($this->filteredValue())) {
            10 => $this->shortChecksumMatches(),
            13 => $this->longChecksumMatches(),
            default => false,
        };
    }

    /**
     * filter value to validate
     *
     * @return string
     */
    public function filteredValue(): string
    {
        return preg_replace("/[^0-9x]/i", '', $this->value);
    }

    /**
     * Determine if checksum for short ISBN is valid
     *
     * @return bool
     */
    private function shortChecksumMatches(): bool
    {
        return $this->getShortChecksum() % 11 === 0;
    }

    /**
     * Calculate checksum of short ISBN
     *
     * @return float|int
     */
    private function getShortChecksum(): float|int
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
    private function longChecksumMatches(): bool
    {
        return $this->getLongChecksum() % 10 === 0;
    }

    /**
     * Calculate checksum for long ISBN
     *
     * @return float|int
     */
    private function getLongChecksum(): float|int
    {
        $checksum = 0;
        foreach (str_split($this->filteredValue()) as $num => $digit) {
            $multiplier = $num % 2 ? 3 : 1;
            $checksum += intval($digit) * $multiplier;
        }

        return $checksum;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute must be a valid ISBN 10 or ISBN 13 number';
    }
}
