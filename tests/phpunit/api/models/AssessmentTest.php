<?php /** @noinspection ALL */

/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/21
 * Time: 6:42 PM
 */
include_once __DIR__ .'../../../../../api/models/Assessment.php';
include_once __DIR__ .'../../../../../api/config/Database.php';
include_once __DIR__ .'../../../../../api/models/Mark.php';

class AssessmentTest extends PHPUnit\Framework\TestCase
{
    private $host = '127.0.0.1';
    private $dbname = 'risk';
    private $user = 'root';
    private $user_ = 'admin';
    private $pass = '';
    private $db = 'risk';
    private $courseArray = [1];
    public $assessment;

    /**
     * @covers Assessment::__constructor
     */
    public function test__construct()
    {
        AssessmentTest::init();
        $this->assertNull($this->assessment->__construct($this->db));
    }

    /**
     * @covers Assessment::getMinMaxYear
     */
    public function testgetMinMaxYear()
    {
        AssessmentTest::init();
        $this->assertNotNull($this->assessment->getMinMaxYear($this->assessment->course_id));
    }

    /**
     * @covers Assessment::getPassRate
     */
    public function testGetPassRate()
    {
        AssessmentTest::init();
        $this->assertNotEmpty($this->assessment->getPassRate(1, 60));
    }

    /**
     * @covers Assessment::getSummary
     */

    public function testGetSummary()
    {
        AssessmentTest::init();
        $this->assertNotEmpty($this->assessment->getSummary($this->courseArray));
    }

    /**
     * @covers Assessment::addAssessment
     */
    public function testAddAssessment()
    {
        AssessmentTest::init();
        $this->assertNotEmpty($this->assessment->AddAssessment());
    }

    public function init()
    {
        $this->conn = new Database($this->host, $this->dbname, $this->user, $this->pass);
        $this->db = $this->conn->connect();
        $this->assessment = new Assessment($this->db);
        $this->assessment->assessment_name = "Exam";
        $this->assessment->assessment_weight = 60;
        $this->assessment->assessment_total = 90;
        $this->assessment->assessment_date = '2013-05-05';
        $this->assessment->course_id = 1;
        $this->assessment->assessment_id = 3;
        $this->assessment->ail_id = 1;
        $this->assessment->aml_id = 1;
        $this->assessment->atl_id = 2;
        $this->assessment->csv = ["/opt/lampp/htdocs/Atom/csv/COMS1015-BCO-2013.csv"];
    }
}