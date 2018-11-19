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
        UserTest::init_User();
        $this->assertNull($this->userTesting-> __construct($this->db));
    }
    /**
     * @covers User::getUser
     */
    public function testGetUser()
    {
        UserTest::init_User();
        $this->assertNull($this->userTesting->getUser());
    }
    /**
     * @covers User::get
     */
    public function testGet()
    {
        UserTest::init_User();
        $this->assertNotEmpty($this->userTesting->get());
    }

    /**
     * @covers User::getUsersByName
     */
public  function testGetUsersByName(){
    UserTest::init_User();
    $this->assertNotEmpty($this->userTesting->getUsersByName());
}
    /**
     * @covers User::addUser
     */
    public  function testAddUser(){
        UserTest::init_User();
        $this->assertNull($this->userTesting->addUser());
    }
    public function init_User(){
        $conn = new Database($this->host, $this->name, $this->user, $this->pass);
        $this->db=$conn->connect();
        $this->userTesting = new User($this->db);
        $this->userTesting->user_id=500594;
        $this->userTesting->user_name="Michael";
        $this->userTesting->user_surname="Chaphole";
        $this->userTesting->user_password;
        $this->userTesting->user_yearofstudy=null;
        $this->userTesting->faculty_name=5;
        $this->userTesting->user_type="student";

    }
}
