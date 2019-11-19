<?php

namespace Pop\Filter\Test;

use Pop\Filter\Filter;
use PHPUnit\Framework\TestCase;

class FilterableTest extends TestCase
{

    public function testAddFilter()
    {
        $filter = new TestFilter\Filter();
        $filter->addFilter(new Filter('strip_tags'));
        $filter->addFilters([new Filter('htmlentities')]);
        $this->assertTrue($filter->hasFilters());
        $this->assertEquals(2, count($filter->getFilters()));
    }

    public function testAddCallableFilter()
    {
        $filter = new TestFilter\Filter();
        $filter->addFilter('strip_tags');
        $this->assertTrue($filter->hasFilters());
        $this->assertEquals(1, count($filter->getFilters()));
    }

    public function testAddFilterException()
    {
        $this->expectException('InvalidArgumentException');
        $filter = new TestFilter\Filter();
        $filter->addFilter('bad');
    }

    public function testClearFilters()
    {
        $filter = new TestFilter\Filter();
        $filter->addFilter(new Filter('strip_tags'));
        $filter->addFilters([new Filter('htmlentities')]);
        $filter->clearFilters();
        $this->assertFalse($filter->hasFilters());
        $this->assertEquals(0, count($filter->getFilters()));
    }

    public function testFilterAll()
    {
        $filter = new TestFilter\Filter();
        $filter->addFilter(new Filter('strip_tags'));
        $values = [
            '<strong>Header</strong>',
            '<em>Subheader</em>'
        ];
        $values = $filter->filterAll($values);

        $this->assertEquals('Header', $values[0]);
        $this->assertEquals('Subheader', $values[1]);
    }

}