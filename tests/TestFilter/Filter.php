<?php

namespace Pop\Filter\Test\TestFilter;

use Pop\Filter\FilterableTrait;

class Filter
{

    use FilterableTrait;

    /**
     * Filter values
     *
     * @param  mixed $values
     * @return array
     */
    public function filter($values)
    {
        foreach ($this->filters as $filter) {
            foreach ($values as $key => $value) {
                $values[$key] = $filter->filter($value);
            }
        }

        return $values;
    }

}