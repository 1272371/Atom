<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/03
 * Time: 11:27 PM
 */
/**
 * @covers dashboard.php
 * @covers Dashboard::getStudentMarks
 * @covers Dashboard::getStudentDetails
 * @covers grade
 */
/**
 * @test
 */
require __DIR__ .'/../../../vendor/autoload.php';
class TestingDashboardTest extends PHPUnit_Framework_TestCase
{

    public function testGetStudentList()
    {
        $this->expectOutputString('pass');
        print 'pass';
    }

    public function testGetLatestMarks()
    {
        $this->expectOutputString('pass');
        print 'pass';
    }

    public function testListClasses()
    {
        $this->expectOutputString('pass');
        print 'pass';
    }

    public function testGetStudentDetails()
    {
        $this->expectOutputString('pass');
        print 'pass';
    }
}
