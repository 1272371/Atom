<?php
require __DIR__ .'/../../vendor/autoload.php';
/**
 * @covers index::Welcome
 */

class WelcomeTest extends \PHPUnit_Framework_TestCase
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
