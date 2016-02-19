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
 * Filter slug class
 *
 * @category   Pop
 * @package    Pop_Filter
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2016 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    2.0.0
 */
class Slug
{

    /**
     * Convert the string into an SEO-friendly slug.
     *
     * @param  string $string
     * @param  string $sep
     * @return string
     */
    public static function filter($string, $sep = null)
    {
        if (strlen($string) > 0) {
            if (null !== $sep) {
                $strAry = explode($sep, $string);
                $tmpStrAry = [];

                foreach ($strAry as $value) {
                    $str = strtolower($value);
                    $str = str_replace('&', 'and', $str);
                    $str = preg_replace('/([^a-zA-Z0-9 \-\/])/', '', $str);
                    $str = str_replace('/', '-', $str);
                    $str = str_replace(' ', '-', $str);
                    $str = preg_replace('/-*-/', '-', $str);
                    $tmpStrAry[] = $str;
                }

                $string = implode('/', $tmpStrAry);
                $string = str_replace('/-', '/', $string);
                $string = str_replace('-/', '/', $string);
            } else {
                $string = strtolower($string);
                $string = str_replace('&', 'and', $string);
                $string = preg_replace('/([^a-zA-Z0-9 \-\/])/', '', $string);
                $string = str_replace('/', '-', $string);
                $string = str_replace(' ', '-', $string);
                $string = preg_replace('/-*-/', '-', $string);
            }
        } else {
            $string = '';
        }

        return $string;
    }

}
