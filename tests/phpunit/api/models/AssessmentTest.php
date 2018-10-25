<?php /** @noinspection ALL */

/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/21
 * Time: 6:42 PM
 */
include_once __DIR__ .'../../../../../api/models/Assessment.php';

class AssessmentTest extends PHPUnit\Framework\TestCase
{
    /**
     * Created by PhpStorm.
     * User: root
     * Date: 2018/10/03
     * Time: 11:32 PM
     */
    private $db = 'risk';
    private $courseArray = ['e'];
    /**
     * @covers Assessment::addAssessment
     */
    public function testAddAssessment()
    {
        $assessment = new Assessment($this->db);
        $this->assertNotEmpty($assessment->AddAssessment());
    }
    /**
     * @covers Assessment::getPassRate
     */
    public function testGetPassRate()
    {

    }
    /**
     * @covers Assessment::getSummary
     */

    public function testGetSummary()
    {
        $assessment = new Assessment($this->db);
        $this->assertNotEmpty($assessment->getSummary($this->courseArray));
    }
    /**
     * @covers Assessment::getMinMaxYear
     */

    public function testgetMinMaxYear()
    {
        $assessment = new Assessment($this->db);
        $this->assertNotEmpty($assessment->getMinMaxYear());
    }
}
