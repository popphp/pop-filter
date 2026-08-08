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

    public function testHasFilter()
    {
        $filter = new TestFilter\Filter();
        $stripTags = new Filter('strip_tags');
        $filter->addFilter($stripTags);

        $this->assertTrue($filter->hasFilter($stripTags));
        $this->assertFalse($filter->hasFilter(new Filter('trim')));
    }

    public function testRemoveFilter()
    {
        $filter    = new TestFilter\Filter();
        $stripTags = new Filter('strip_tags');
        $trim      = new Filter('trim');
        $filter->addFilters([$stripTags, $trim]);

        $filter->removeFilter($stripTags);

        $this->assertEquals(1, count($filter->getFilters()));
        $this->assertFalse($filter->hasFilter($stripTags));
        $this->assertTrue($filter->hasFilter($trim));
    }

    public function testFilterEach()
    {
        $filter = new TestFilter\Filter();
        $filter->addFilter(new Filter('strip_tags'));
        $values = $filter->filterEach([
            'username' => '<b>Admin</b>',
            'email'    => '<i>test@test.com</i>',
        ]);

        $this->assertEquals('Admin', $values['username']);
        $this->assertEquals('test@test.com', $values['email']);
    }

    public function testFilterEachRespectsExcludeByName()
    {
        $filter = new TestFilter\Filter();
        $filter->addFilter(new Filter('strip_tags', null, 'username'));
        $values = $filter->filterEach([
            'username' => '<b>Admin</b>',
            'email'    => '<i>test@test.com</i>',
        ]);

        $this->assertEquals('<b>Admin</b>', $values['username']);
        $this->assertEquals('test@test.com', $values['email']);
    }

    public function testHostFilterRespectsExcludeByName()
    {
        $filter = new TestFilter\Filter();
        $filter->addFilter(new Filter('strip_tags', null, 'username'));
        $values = $filter->filter([
            'username' => '<b>Admin</b>',
            'email'    => '<i>test@test.com</i>',
        ]);

        $this->assertEquals('<b>Admin</b>', $values['username']);
        $this->assertEquals('test@test.com', $values['email']);
    }

}