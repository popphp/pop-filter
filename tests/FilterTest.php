<?php

namespace Pop\Filter\Test;

use Pop\Filter\Filter;
use PHPUnit\Framework\TestCase;

class FilterTest extends TestCase
{

    public function testHasAndGetters()
    {
        $filter = new Filter('htmlentities', ENT_QUOTES, 'email', 'email');
        $this->assertTrue($filter->hasCallable());
        $this->assertTrue($filter->hasParams());
        $this->assertTrue($filter->hasExcludeByType());
        $this->assertTrue($filter->hasExcludeByName());
        $this->assertNotEmpty($filter->getCallable());
        $this->assertNotEmpty($filter->getParams());
        $this->assertNotEmpty($filter->getExcludeByType());
        $this->assertNotEmpty($filter->getExcludeByName());
    }

    public function testSetParams()
    {
        $filter = new Filter('htmlentities', [ENT_QUOTES, 'UTF-8'], 'email', 'email');
        $this->assertTrue($filter->hasParams());
    }

    public function testFilterValue()
    {
        $filter = new Filter('strip_tags');
        $value  = $filter->filter('<strong>Header</strong>');
        $this->assertEquals('Header', $value);
    }

    public function testFilterArrayValue()
    {
        $filter = new Filter('strip_tags');
        $values = $filter->filter([
            '<strong>Header</strong>',
            '<em>Subheader</em>'
        ]);

        $this->assertEquals('Header', $values[0]);
        $this->assertEquals('Subheader', $values[1]);
    }

    public function testFilterSkipsValueExcludedByName()
    {
        $filter = new Filter('strip_tags', null, 'username');
        $value  = $filter->filter('<b>admin</b>', 'username');
        $this->assertEquals('<b>admin</b>', $value);
    }

    public function testFilterSkipsValueExcludedByType()
    {
        $filter = new Filter('strip_tags', null, null, 'textarea');
        $value  = $filter->filter('<b>admin</b>', null, 'textarea');
        $this->assertEquals('<b>admin</b>', $value);
    }

    public function testFilterAppliesValueNotExcludedByNameOrType()
    {
        $filter = new Filter('strip_tags', null, 'username', 'textarea');
        $value  = $filter->filter('<b>admin</b>', 'email', 'text');
        $this->assertEquals('admin', $value);
    }

    public function testFilterParamAsClosureIsInvokedOnEachCall()
    {
        $calls   = 0;
        $default = function () use (&$calls) {
            $calls++;
            return '-';
        };

        $filter = new Filter('str_pad', [1, $default]);
        $filter->filter('a');
        $filter->filter('a');

        $this->assertEquals(2, $calls);
    }

    public function testRemoveCallable()
    {
        $filter = new Filter('strip_tags');
        $this->assertTrue($filter->hasCallable());
        $filter->removeCallable();
        $this->assertFalse($filter->hasCallable());
    }

    public function testFilterWithNoCallableReturnsValueUnchanged()
    {
        $filter = new Filter('strip_tags');
        $filter->removeCallable();
        $this->assertEquals('<b>admin</b>', $filter->filter('<b>admin</b>'));
    }

    public function testFilterNestedArrayValue()
    {
        $filter = new Filter('strip_tags');
        $values = $filter->filter([
            'header' => '<strong>Header</strong>',
            'nested' => ['<em>One</em>', '<em>Two</em>'],
        ]);

        $this->assertEquals('Header', $values['header']);
        $this->assertEquals('One', $values['nested'][0]);
        $this->assertEquals('Two', $values['nested'][1]);
    }

}