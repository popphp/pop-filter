<?php
/**
 * Pop PHP Framework (http://www.popphp.org/)
 *
 * @link       https://github.com/popphp/popphp-framework
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2016 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 */

/**
 * @namespace
 */
namespace Pop\Filter;

/**
 * Filter random class
 *
 * @category   Pop
 * @package    Pop_Filter
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2016 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    2.0.0
 */
class Random
{

    /**
     * Constants for string type
     */
    const ALPHA     = 1;
    const ALPHANUM  = 2;
    const LOWERCASE = 4;
    const UPPERCASE = 8;

    /**
     * Generate a random string of a predefined length.
     *
     * @param  int $length
     * @param  int $options
     * @return string
     */
    public static function create($length, $options = 2)
    {
        $type = null; // 'alpha', 'alphanum'
        $case = null; // 'lower', 'upper

        switch ($options) {
            case self::ALPHA:
                $type = 'alpha';
                break;
            case self::LOWERCASE:
                $case = 'lower';
                break;
            case self::UPPERCASE:
                $case = 'upper';
                break;
            case self::ALPHA|self::LOWERCASE:
                $type = 'alpha';
                $case = 'lower';
                break;
            case self::ALPHA|self::UPPERCASE:
                $type = 'alpha';
                $case = 'upper';
                break;
            case self::ALPHANUM:
                $type = 'alphanum';
                break;
            case self::ALPHANUM|self::LOWERCASE:
                $type = 'alphanum';
                $case = 'lower';
                break;
            case self::ALPHANUM|self::UPPERCASE:
                $type = 'alphanum';
                $case = 'upper';
                break;
        }

        $chars = [
            0 => str_split('abcdefghjkmnpqrstuvwxyz'),
            1 => str_split('ABCDEFGHJKLMNPQRSTUVWXYZ'),
            2 => str_split('23456789'),
            3 => str_split('!#$%&()*+-,.:;=?@[]^_{|}')
        ];

        switch ($type) {
            case 'alpha':
                $indices = [0, 1];
                break;
            case 'alphanum':
                $indices = [0, 1, 2];
                break;
            default:
                $indices = [0, 1, 2, 3];
        }

        switch ($case) {
            case 'lower':
                unset($indices[1]);
                break;
            case 'upper':
                unset($indices[0]);
                break;
        }

        $indices = array_values($indices);
        $str     = '';

        for ($i = 0; $i < $length; $i++) {
            $index = $indices[rand(0, (count($indices) - 1))];
            $subIndex = rand(0, (count($chars[$index]) - 1));
            $str .= $chars[$index][$subIndex];
        }

        return $str;
    }

}
