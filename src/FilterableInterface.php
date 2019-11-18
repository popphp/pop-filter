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

/**
 * Filterable interface
 *
 * @category   Pop
 * @package    Pop\Filter
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2020 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    3.0.0
 */
interface FilterableInterface
{

    /**
     * Add filter
     *
     * @param  FilterInterface $filter
     * @return FilterableInterface
     */
    public function addFilter(FilterInterface $filter);

    /**
     * Add filters
     *
     * @param  array $filters
     * @return FilterableInterface
     */
    public function addFilters(array $filters);

    /**
     * Clear filters
     *
     * @return FilterableInterface
     */
    public function clearFilters();

    /**
     * Filter values
     *
     * @param  array $values
     * @return array
     */
    public function filter(array $values);

}