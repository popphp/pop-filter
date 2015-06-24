<?php

namespace Pop\Filter\Test;

use Pop\Filter\Slug;

class SlugTest extends \PHPUnit_Framework_TestCase
{

    public function testSlug()
    {
        $this->assertEquals('hello-world', Slug::filter('Hello World'));
        $this->assertEquals('hello-world/how-are-you', Slug::filter('Hello World | How Are You?', ' | '));
        $this->assertEquals('', Slug::filter(''));
    }

}