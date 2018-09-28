<?php
use PHPUnit\Framework\TestCase;
/**
 * @covers dashboard::listClasses
 */
class gradeTest extends TestCase{
    function buttonDropdown(){
        $this->assertTrue();
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