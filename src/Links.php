<?php
/**
 * Pop PHP Framework (http://www.popphp.org/)
 *
 * @link       https://github.com/popphp/popphp-framework
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2015 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 */

/**
 * @namespace
 */
namespace Pop\Filter;

/**
 * Filter links class
 *
 * @category   Pop
 * @package    Pop_Filter
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2015 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    2.0.0
 */
class Links
{

    /**
     * Convert any links in the string to HTML links.
     *
     * @param  string $string
     * @param  string $target
     * @return string
     */
    public static function filter($string, $target = null)
    {
        $target = (null !== $target) ? 'target="' . $target . '" ' : '';

        $string = preg_replace('/[ftp|http|https]+:\/\/[^\s]*/', '<a href="$0">$0</a>', $string);
        $string = preg_replace('/\s[\w]+[a-zA-Z0-9\.\-\_]+(\.[a-zA-Z]{2,4})/', ' <a href="http://$0">$0</a>', $string);
        $string = preg_replace('/[a-zA-Z0-9\.\-\_+%]+@[a-zA-Z0-9\-\_\.]+\.[a-zA-Z]{2,4}/', '<a href="mailto:$0">$0</a>', $string);
        $string = str_replace(
            [
                'href="http:// ',
                'href="https:// ',
                '"> ',
                '<a '
            ],
            [
                'href="http://',
                'href="https://',
                '">',
                '<a ' . $target
            ],
            $string
        );

        return $string;
    }

}
