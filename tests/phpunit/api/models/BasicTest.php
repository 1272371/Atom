<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/21
 * Time: 6:45 PM
 */
include_once __DIR__ .'../../../../../api/models/Basic.php';
include_once __DIR__ .'../../../../../api/config/Database.php';
class BasicTest extends \PHPUnit\Framework\TestCase
{
    private $host = '127.0.0.1';
    private $name = 'risk';
    private $user = 'root';
    private $pass = '';
    private $basic;
    private $db;
    /**
     * @covers Basic::getLookups
     */
    public function testGetLookups()
    {
        $conn = new Database($this->host, $this->name, $this->user, $this->pass);
        $this->db=$conn->connect();
        $this->basic = new Basic($this->db);
        $this->assertNull( $this->basic->getLookups());
    }
    /**
     * @covers Basic::getSubjects
     */
    public function testGetSubjects()
    {
        $conn = new Database($this->host, $this->name, $this->user, $this->pass);
        $this->db=$conn->connect();
        $this->basic = new Basic($this->db);
        $this->assertNotEmpty($this->basic->getSubjects());
    }
    /**
     * @covers Basic::getStudents
     */
    public function testGetStudents() {
        $conn = new Database($this->host, $this->name, $this->user, $this->pass);
        $this->db=$conn->connect();
        $this->basic = new Basic($this->db);
        $this->assertNotEmpty($this->basic->getStudents());
    }
    /**
     * @covers Basic::__construct
     */
    public function test__construct()
    {
        $conn = new Database($this->host, $this->name, $this->user, $this->pass);
        $this->db=$conn->connect();
        $this->basic = new Basic($this->db);
        $this->assertNull($this->basic->__construct($this->db));
    }
}
