<?php
/**
 * Pop PHP Framework (https://www.popphp.org/)
 *
 * @link       https://github.com/popphp/popphp-framework
 * @author     Nick Sagona, III <dev@noladev.com>
 * @copyright  Copyright (c) 2009-2025 NOLA Interactive, LLC.
 * @license    https://www.popphp.org/license     New BSD License
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
 * @author     Nick Sagona, III <dev@noladev.com>
 * @copyright  Copyright (c) 2009-2025 NOLA Interactive, LLC.
 * @license    https://www.popphp.org/license     New BSD License
 * @version    4.0.2
 */
interface FilterInterface
{

    /**
     * Set callable
     *
     * @param  mixed $callable
     * @return FilterInterface
     */
    public function setCallable(mixed $callable): FilterInterface;

    /**
     * Set params
     *
     * @param  mixed $params
     * @return FilterInterface
     */
    public function setParams(mixed $params): FilterInterface;

    /**
     * Set exclude by name
     *
     * @param  mixed $excludeByName
     * @return FilterInterface
     */
    public function setExcludeByName(mixed $excludeByName): FilterInterface;

    /**
     * Set exclude by type
     *
     * @param  mixed $excludeByType
     * @return FilterInterface
     */
    public function setExcludeByType(mixed $excludeByType): FilterInterface;

    /**
     * Get callable
     *
     * @return CallableObject
     */
    public function getCallable(): CallableObject;

    /**
     * Get params
     *
     * @return array
     */
    public function getParams(): array;

    /**
     * Get exclude by name
     *
     * @return array
     */
    public function getExcludeByName(): array;

    /**
     * Get exclude by type
     *
     * @return array
     */
    public function getExcludeByType(): array;

    /**
     * Has callable
     *
     * @return bool
     */
    public function hasCallable(): bool;

    /**
     * Has params
     *
     * @return bool
     */
    public function hasParams(): bool;

    /**
     * Has exclude by name
     *
     * @return bool
     */
    public function hasExcludeByName(): bool;

    /**
     * Has exclude by type
     *
     * @return bool
     */
    public function hasExcludeByType(): bool;

    /**
     * Filter value
     *
     * @param  mixed   $value
     * @param  ?string $name
     * @param  mixed   $type
     * @return mixed
     */
    public function filter(mixed $value, ?string $name = null, mixed $type = null): mixed;

}
