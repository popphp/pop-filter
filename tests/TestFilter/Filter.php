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
    public function filter(mixed $values): array
    {
        return $this->filterEach($values);
    }

}