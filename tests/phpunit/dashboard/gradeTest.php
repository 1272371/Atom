<?php
require __DIR__ .'/../../../dashboard/autoload.php';
/**
 * @covers dashboard::listClasses
 */
class gradeTest extends PHPUnit_Framework_TestCase{

    function buttonDropdown(){
        $this->expectOutputString('pass');
        print 'pass';
    }
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