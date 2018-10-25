<?php /** @noinspection ALL */

/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/21
 * Time: 6:42 PM
 */
include_once __DIR__ .'../../../../../api/models/Assessment.php';
include_once __DIR__ .'../../../../../api/config/Database.php';

class AssessmentTest extends PHPUnit\Framework\TestCase
{
    /**
     * Created by PhpStorm.
     * User: root
     * Date: 2018/10/03
     * Time: 11:32 PM
     */
    private $host = '127.0.0.1';
    private $dbname = 'risk';
    private $user = 'root';
    private $user_='admin';
    private $pass = '';
    private $db = 'risk';
    private $courseArray = [1,2,3];
    /**
     * @covers Assessment::addAssessment
     */
    public function testAddAssessment()
    {
        $this->conn = new Database($this->host, $this->dbname, $this->user, $this->pass);
        $this->db=$this->conn->connect();
        $assessment = new Assessment($this->db);
        $this->assertNotEmpty($assessment->AddAssessment());
    }
    /**
     * @covers Assessment::getPassRate
     */
    public function testGetPassRate()
    {
        $this->conn = new Database($this->host, $this->dbname, $this->user, $this->pass);
        $this->db=$this->conn->connect();
        $assessment = new Assessment($this->db);
        $this->assertNotEmpty($assessment->getPassRate(1,60));
    }
    /**
     * @covers Assessment::getSummary
     */

    public function testGetSummary()
    {
        $this->conn = new Database($this->host, $this->dbname, $this->user, $this->pass);
        $this->db=$this->conn->connect();
        $assessment = new Assessment($this->db);
        $this->assertNotEmpty($assessment->getSummary($this->courseArray));
    }
    /**
     * @covers Assessment::getMinMaxYear
     */

    public function testgetMinMaxYear()
    {
        $this->conn = new Database($this->host, $this->dbname, $this->user, $this->pass);
        $this->db=$this->conn->connect();
        $assessment = new Assessment($this->db);
        $course_id =$assessment->course_id;
        $this->assertNull($assessment->getMinMaxYear($course_id));
    }

    /**
     * @covers Assessment::__constructor
     */
public function test__construct()
    {
        $this->conn = new Database($this->host, $this->dbname, $this->user, $this->pass);
        $this->db=$this->conn->connect();
        $assessment = new Assessment($this->db);
        $this->assertNull($assessment->__construct($this->db));
    }

}
