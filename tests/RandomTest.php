<?php

namespace Pop\Filter\Test;

use Pop\Filter\Random;

class RandomTest extends \PHPUnit_Framework_TestCase
{

    public function testRandom()
    {
        $this->assertEquals(6, strlen(Random::create(6, Random::ALPHA)));
        $this->assertEquals(8, strlen(Random::create(8, Random::LOWERCASE)));
        $this->assertEquals(7, strlen(Random::create(7, Random::UPPERCASE)));
        $this->assertEquals(5, strlen(Random::create(5, Random::ALPHA|Random::LOWERCASE)));
        $this->assertEquals(9, strlen(Random::create(9, Random::ALPHA|Random::UPPERCASE)));
        $this->assertEquals(10, strlen(Random::create(10, Random::ALPHANUM)));
        $this->assertEquals(11, strlen(Random::create(11, Random::ALPHANUM|Random::LOWERCASE)));
        $this->assertEquals(12, strlen(Random::create(12, Random::ALPHANUM|Random::UPPERCASE)));
    }

}