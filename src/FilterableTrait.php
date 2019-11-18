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
 * Filterable trait
 *
 * @category   Pop
 * @package    Pop\Filter
 * @author     Nick Sagona, III <dev@nolainteractive.com>
 * @copyright  Copyright (c) 2009-2020 NOLA Interactive, LLC. (http://www.nolainteractive.com)
 * @license    http://www.popphp.org/license     New BSD License
 * @version    3.0.0
 */
trait FilterableTrait
{

    /**
     * Form filters
     * @var array
     */
    protected $filters = [];

    /**
     * Add filter
     *
     * @param  FilterInterface $filter
     * @return FilterableTrait
     */
    public function addFilter(FilterInterface $filter)
    {
        $this->filters[] = $filter;
        return $this;
    }

    /**
     * Add filters
     *
     * @param  array $filters
     * @return FilterableTrait
     */
    public function addFilters(array $filters)
    {
        foreach ($filters as $filter) {
            $this->addFilter($filter);
        }
        return $this;
    }

    /**
     * Has filters
     *
     * @return boolean
     */
    public function hasFilters()
    {
        return (count($this->filters) > 0);
    }

    /**
     * Get filters
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Clear filters
     *
     * @return FilterableTrait
     */
    public function clearFilters()
    {
        $this->filters = [];
        return $this;
    }

    /**
     * Filter all values, ignoring excludes
     *
     * @param  array $values
     * @return array
     */
    public function filterAll(array $values)
    {
        foreach ($this->filters as $filter) {
            $values = array_map([$filter, 'filter'], $values);
        }

        return $values;
    }

    /**
     * Filter values
     *
     * @param  array $values
     * @return array
     */
    abstract public function filter(array $values);

}