<?php

namespace Pop\Filter\Test\TestFilter;

use Pop\Filter\AbstractFilterable;

class Filter extends AbstractFilterable
{

    /**
     * Filter values
     *
     * @param  array $values
     * @return array
     */
    public function filter(array $values)
    {
        foreach ($this->filters as $filter) {
            foreach ($values as $key => $value) {
                $values[$key] = $filter->filter($value);
            }
        }

        return $values;
    }

}