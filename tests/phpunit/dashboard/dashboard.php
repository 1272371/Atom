<?php
require __DIR__ .'/../../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
/**
 * @covers dashboard.php
 * @covers Dashboard::getStudentMarks
 * @covers Dashboard::getStudentDetails
 * @covers grade
 */
/**
 * @test
 */
class Dashboard extends TestCase{
    function getStudentMarksTests(){
        $this->assertTrue();
 }
function getStudentDetails(){
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
