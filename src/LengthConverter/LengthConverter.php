<?php
/**
 * Length Converter
 */

declare(strict_types = 1);

namespace LengthConverter;

/**
 * Convert a number in many other unit lengths
 *
 * Example usage:
 * $converter = new LengthConverter(1);
 * echo $converter->from('inchs')->to('cm')->show();
 * echo $converter->from('m')->to('mm')->show(0, ',', '.');
 *
 * @package LengthConverter
 * @author  Diego Gonçalves Arent
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    http://github.com/diegoarent
 * @access  public
 */
class LengthConverter
{
    /*
     * Length Units
     */
    private const UNITS = [
        'mm'    => 0.001,
        'cm'    => 0.01,
        'inchs' => 0.0254,
        'dm'    => 0.1,
        'feets' => 0.3048,
        'yards' => 0.9144,
        'm'     => 1,
        'dam'   => 10,
        'hm'    => 100,
        'km'    => 1000,
        'miles' => 1609.34
    ];

    /**
     * Converter attributes
     *
     * @var string $value    Original value
     * @var float  $unitFrom Unit ratio (from)
     * @var float  $unitTo   Unit ratio (to)
     */
    private $value, $unitFrom, $unitTo;


    /**
     * LengthConverter constructor
     * Set the value that to be converted
     *
     * @param float $value Original value
     */
    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * Set the initial unit of the conversion
     *
     * @param string $unit Initial unit
     *
     * @return LengthConverter LengthConveter object updated
     */
    public function from(string $unit) : LengthConverter
    {
        // If is a valid unit, set from
        if (array_key_exists($unit, self::UNITS)) :
            $this->unitFrom = self::UNITS[$unit];
        endif;

        return $this;
    }

    /**
     * Set the converted unit of the conversion
     *
     * @param string $unit Converted unit
     *
     * @return LengthConverter LengthConveter object updated
     */
    public function to(string $unit) : LengthConverter
    {
        // If is a valid unit, set to
        if (array_key_exists($unit, self::UNITS)) :
            $this->unitTo = self::UNITS[$unit];
        endif;

        return $this;
    }

    /**
     * Calculate and format the result of the conversion
     *
     * @param int|null    $decimals           Decimal places
     * @param null|string $separator          Decimal separator
     * @param null|string $thousandsSeparator Thousands separator
     *
     * @return string Converted number formatted
     */
    public function show(?int $decimals = null, ?string $separator = null, ?string $thousandsSeparator = null) : string
    {
        // Get result
        $result = $this->calc();

        // Format
        return number_format(
            $result,
            $decimals ?? 2,
            $separator ?? '.',
            $thousandsSeparator ?? ','
        );
    }

    /**
     * Calculate the result of the conversion
     *
     * @return float Converted number
     */
    public function calc() : float
    {
        $calc = 0.0;

        // If valid units
        if (!empty($this->unitFrom) && !empty($this->unitTo)) :
            $calc = $this->value * $this->unitFrom * (1 / $this->unitTo);
        endif;

        return $calc;
    }
}
