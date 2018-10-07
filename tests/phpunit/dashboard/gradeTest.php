<?php
require __DIR__ .'/../../../dashboard/autoload.php';
/**
 * @covers gradeTest::TestingGrade
 */
class gradeTest extends PHPUnit_Framework_TestCase{

    function listClasses(){
        $this->expectOutputString('pass');
        print 'pass';
    }
    function listDates(){
    	$this->expectOutputString('pass');
        print 'pass';
    }
    function getStudentList(){
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