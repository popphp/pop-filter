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

use InvalidArgumentException;

/**
 * Filterable trait
 *
 * @category   Pop
 * @package    Pop\Filter
 * @author     Nick Sagona, III <dev@noladev.com>
 * @copyright  Copyright (c) 2009-2025 NOLA Interactive, LLC.
 * @license    https://www.popphp.org/license     New BSD License
 * @version    4.0.0
 */
trait FilterableTrait
{

    /**
     * Form filters
     * @var array
     */
    protected array $filters = [];

    /**
     * Add filter
     *
     * @param  mixed $filter
     * @throws InvalidArgumentException
     * @return static
     */
    public function addFilter(mixed $filter): static
    {
        if (!($filter instanceof FilterInterface) && is_callable($filter)) {
            $filter = new Filter($filter);
        }
        if (!($filter instanceof FilterInterface)) {
            throw new \InvalidArgumentException(
                'Error: The filter must be a callable or an instance of Pop\Filter\FilterInterface.'
            );
        }
        $this->filters[] = $filter;
        return $this;
    }

    /**
     * Add filters
     *
     * @param  array $filters
     * @return static
     */
    public function addFilters(array $filters): static
    {
        foreach ($filters as $filter) {
            $this->addFilter($filter);
        }
        return $this;
    }

    /**
     * Has filters
     *
     * @return bool
     */
    public function hasFilters(): bool
    {
        return (count($this->filters) > 0);
    }

    /**
     * Get filters
     *
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * Clear filters
     *
     * @return static
     */
    public function clearFilters(): static
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
    public function filterAll(array $values): array
    {
        foreach ($this->filters as $filter) {
            $values = array_map([$filter, 'filter'], $values);
        }

        return $values;
    }

    /**
     * Filter values
     *
     * @param  mixed $values
     * @return mixed
     */
    abstract public function filter(mixed $values): mixed;

}
