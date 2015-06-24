<?php

namespace Pop\Filter\Test;

use Pop\Filter\Links;

class LinksTest extends \PHPUnit_Framework_TestCase
{

    public function testLinks()
    {
        $str = <<<TEXT
http://www.google.com
ftp://ftp.server.com
test@test.com
TEXT;
        $links = Links::filter($str);
        $this->assertContains('<a href="http://www.google.com">http://www.google.com</a>', $links);
        $this->assertContains('<a href="ftp://ftp.server.com">ftp://ftp.server.com</a>', $links);
        $this->assertContains('<a href="mailto:test@test.com">test@test.com</a>', $links);
    }

}