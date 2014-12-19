<?php
/**
 * Pop PHP Framework (http://www.popphp.org/)
 *
 * @link       https://github.com/popphp/popphp
 * @category   Pop
 * @package    Pop_Filter
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2014 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 */

/**
 * @namespace
 */
namespace Pop\Filter;

/**
 * Filter convert case class
 *
 * @category   Pop
 * @package    Pop_Filter
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2014 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    2.0.0a
 */
class ConvertCase
{

    /**
     * Convert the string from camelCase to dash format
     *
     * @param  string $string
     * @return string
     */
    public static function camelCaseToDash($string)
    {
       return self::convertCamelCase($string, '-');
    }

    /**
     * Convert the string from camelCase to separator format
     *
     * @param  string $string
     * @param  string $sep
     * @return string
     */
    public static function camelCaseToSeparator($string, $sep = DIRECTORY_SEPARATOR)
    {
        return self::convertCamelCase($string, $sep);
    }

    /**
     * Convert the string from camelCase to under_score format
     *
     * @param  string $string
     * @return string
     */
    public static function camelCaseToUnderscore($string)
    {
        return self::convertCamelCase($string, '_');
    }

    /**
     * Convert the string from dash to camelCase format
     *
     * @param  string $string
     * @return string
     */
    public static function dashToCamelcase($string)
    {
        $strAry    = explode('-', $string);
        $camelCase = null;

        $i = 0;
        foreach ($strAry as $word) {
            $camelCase .=  ($i == 0) ? $word : ucfirst($word);
            $i++;
        }

        return $camelCase;
    }

    /**
     * Convert the string from dash to separator format
     *
     * @param  string $string
     * @param  string $sep
     * @return string
     */
    public static function dashToSeparator($string, $sep = DIRECTORY_SEPARATOR)
    {
        return str_replace('-', $sep, $string);
    }

    /**
     * Convert the string from dash to under_score format
     *
     * @param  string $string
     * @return string
     */
    public static function dashToUnderscore($string)
    {
        return str_replace('-', '_', $string);
    }

    /**
     * Convert the string from under_score to camelCase format
     *
     * @param  string $string
     * @return string
     */
    public static function underscoreToCamelcase($string)
    {
        $strAry    = explode('_', $string);
        $camelCase = null;

        $i = 0;
        foreach ($strAry as $word) {
            $camelCase .= ($i == 0) ? $word : ucfirst($word);
            $i++;
        }

        return $camelCase;
    }

    /**
     * Convert the string from under_score to dash format
     *
     * @param  string $string
     * @return string
     */
    public static function underscoreToDash($string)
    {
        return str_replace('_', '-', $string);
    }

    /**
     * Convert the string from under_score to separator format
     *
     * @param  string $string
     * @param  string $sep
     * @return string
     */
    public static function underscoreToSeparator($string, $sep = DIRECTORY_SEPARATOR)
    {
        return str_replace('_', $sep, $string);
    }

    /**
     * Convert a camelCase string using the $sep value passed
     *
     * @param string $string
     * @param string $sep
     * @return string
     */
    protected static function convertCamelCase($string, $sep)
    {
        $strAry  = str_split($string);
        $convert = null;

        $i = 0;
        foreach ($strAry as $chr) {
            if ($i == 0) {
                $convert .= strtolower($chr);
            } else {
                $convert .= (ctype_upper($chr)) ? ($sep . strtolower($chr)) : $chr;
            }
            $i++;
        }

        return $convert;
    }

}
