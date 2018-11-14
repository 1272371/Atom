<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/03
 * Time: 11:36 PM
 */
include_once __DIR__ .'../../../../../api/config/Database.php';
include_once __DIR__ .'../../../../../api/models/Mark.php';
class MarkTest extends PHPUnit\Framework\TestCase
{
    private $host = '127.0.0.1';
    private $dbname = 'risk';
    private $user = 'root';
    private $user_='admin';
    private $pass ='';
    //test Mark

    public $mark;
    /**
     * @covers Mark::__construct
     */
    public function test__construct()
    {
        MarkTest::initMark();
        $this->assertNull($this->mark->__construct($this->db));
    }
    /**
     * @covers Mark::get
     */
    public function testGet()
    {
        MarkTest::initMark();
        $this->assertNotEmpty($this->mark->get());

    }

    /**
     * @covers Mark::getMarksByAssessmentId
     */
    public function testGetMarksByAssessmentId()
    {
        MarkTest::initMark();
        $this->assertNotEmpty($this->mark->getMarksByAssessmentId(1));
        $this->assertEmpty($this->mark->getMarksByAssessmentId(-1));
    }
    /**
     * @covers Mark::getMarksByUserId
     */
    public function testGetMarksByUserId()
    {
        MarkTest::initMark();
        $this->assertEquals(74,$this->mark->getMarksByUserId($this->mark->user_id));
        $this->assertEquals(0,$this->mark->getMarksByUserId(100000000000000000000000000001));
    }
    public function initMark(){
        // database stuff
        $this->conn = new Database($this->host, $this->dbname, $this->user, $this->pass);
        $this->db=$this->conn->connect();
        $this->mark = new Mark($this->db);
        // properties
        $this->mark->user_id=500594;
        $this->mark->user_name="Michael";
        $this->mark->user_surname = "Chaphole";
        $this->mark->assessment_name = "Exam";
        $this->mark->mark_total=86.30;
        $this->mark->course_id=1;
        $this->mark->course_name="Basic Computer Organisation";
    }
}
