<?php
/**
 * @covers index::Welcome
 */
use PHPUnit\Framework\TestCase;
class WelcomeTest extends TestCase
{
    public function testExpect1()
    {
        $this->expectOutputString('pass');
        print 'pass';
    }

    public function testExpect2()
    {
        $this->expectOutputString('fail');
        print 'fail';
    }

    public function testExpect3()
    {
        $this->expectOutputString('pass');
        print 'pass';
    }
}
?>
