<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/03
 * Time: 11:36 PM
 */

include_once __DIR__ .'../../../../../api/models/Mark.php';
include_once __DIR__ .'../../../../../api/config/Database.php';
class MarkTest extends PHPUnit\Framework\TestCase
{
    private $host = '127.0.0.1';
    private $dbname = 'risk';
    private $user = 'root';
    private $user_='admin';
    private $pass = '';
    private $mark;
    private $conn;
    /**
     * @covers Mark::get
     */
    public function testGet()
    {
        $this->conn = new Database($this->host, $this->dbname, $this->user, $this->pass);
        $this->db=$this->conn->connect();
        $this->mark = new Mark($this->db);
        $this->assertNotEmpty($this->mark->get());
    }

    public function testGetMarksByAssessmentId()
    {
        $this->conn = new Database($this->host, $this->dbname, $this->user, $this->pass);
        $this->db=$this->conn->connect();
        $this->mark = new Mark($this->db);
        $this->assertNotEmpty($this->mark->get());
        $id = $this->mark->course_id;
        $this->assertNotEmpty($this->mark->getMarksByAssessmentId($id));
    }

    public function testGetMarksByUserId()
    {

    }

    public function test__construct()
    {

    }
}
