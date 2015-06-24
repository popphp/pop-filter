<?php

namespace Pop\Filter\Test;

use Pop\Filter\ConvertCase;

class CaseTest extends \PHPUnit_Framework_TestCase
{

    public function testCamelCaseToDash()
    {
        $this->assertEquals('hello-world', ConvertCase::camelCaseToDash('helloWorld'));
    }

    public function testCamelCaseToSeparator()
    {
        $this->assertEquals('hello/world', ConvertCase::camelCaseToSeparator('helloWorld'));
    }

    public function testCamelCaseToUnderscore()
    {
        $this->assertEquals('hello_world', ConvertCase::camelCaseToUnderscore('helloWorld'));
    }

    public function testDashToCamelCase()
    {
        $this->assertEquals('helloWorld', ConvertCase::dashToCamelcase('hello-world'));
    }

    public function testDashToSeparator()
    {
        $this->assertEquals('hello/world', ConvertCase::dashToSeparator('hello-world'));
    }

    public function testDashToUnderscore()
    {
        $this->assertEquals('hello_world', ConvertCase::dashToUnderscore('hello-world'));
    }

    public function testUnderscoreToCamelCase()
    {
        $this->assertEquals('helloWorld', ConvertCase::underscoreToCamelCase('hello_world'));
    }

    public function testUnderscoreToDash()
    {
        $this->assertEquals('hello-world', ConvertCase::underscoreToDash('hello_world'));
    }

    public function testUnderscoreToSeparator()
    {
        $this->assertEquals('hello/world', ConvertCase::underscoreToSeparator('hello/world'));
    }

}
