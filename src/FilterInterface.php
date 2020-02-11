<?php
/**
 * Pop PHP Framework (http://www.popphp.org/)
 *
 * @link       https://github.com/popphp/popphp-framework
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2020 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 */

/**
 * @namespace
 */
namespace Pop\Filter;

use Pop\Utils\CallableObject;

/**
 * Filter interface
 *
 * @category   Pop
 * @package    Pop\Filter
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2020 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    3.0.0
 */
interface FilterInterface
{

    /**
     * Set callable
     *
     * @param  mixed $callable
     * @return FilterInterface
     */
    public function setCallable($callable);

    /**
     * Set params
     *
     * @param  mixed $params
     * @return FilterInterface
     */
    public function setParams($params);

    /**
     * Set exclude by name
     *
     * @param  mixed $excludeByName
     * @return FilterInterface
     */
    public function setExcludeByName($excludeByName);

    /**
     * Set exclude by type
     *
     * @param  mixed $excludeByType
     * @return FilterInterface
     */
    public function setExcludeByType($excludeByType);

    /**
     * Get callable
     *
     * @return CallableObject
     */
    public function getCallable();

    /**
     * Get params
     *
     * @return array
     */
    public function getParams();

    /**
     * Get exclude by name
     *
     * @return array
     */
    public function getExcludeByName();

    /**
     * Get exclude by type
     *
     * @return array
     */
    public function getExcludeByType();

    /**
     * Has callable
     *
     * @return boolean
     */
    public function hasCallable();

    /**
     * Has params
     *
     * @return boolean
     */
    public function hasParams();

    /**
     * Has exclude by name
     *
     * @return boolean
     */
    public function hasExcludeByName();

    /**
     * Has exclude by type
     *
     * @return boolean
     */
    public function hasExcludeByType();

    /**
     * Filter value
     *
     * @param  mixed  $value
     * @param  string $name
     * @param  mixed  $type
     * @return mixed
     */
    public function filter($value, $name = null, $type = null);

}