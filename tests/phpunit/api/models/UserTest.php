<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/03
 * Time: 11:38 PM
 */
include_once __DIR__ .'../../../../../api/models/User.php';
include_once __DIR__ .'../../../../../api/config/Database.php';
class UserTest extends PHPUnit\Framework\TestCase
{
    private $host = '127.0.0.1';
    private $name = 'risk';
    private $user = 'root';
    private $pass = '';
    private $userTesting;
    private $db;
    /**
     * @covers User::__construct
     */
    public function test__construct()
    {
        $conn = new Database($this->host, $this->name, $this->user, $this->pass);
        $this->db=$conn->connect();
        $this->userTesting = new User($this->db);
        $this->assertNull($this->userTesting-> __construct($this->db));
    }
    /**
     * @covers User::getUser
     */
    public function testGetUser()
    {

    }
    /**
     * @covers User::get
     */
    public function testGet()
    {

    }
}
