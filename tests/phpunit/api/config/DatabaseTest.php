<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/03
 * Time: 11:32 PM
 */
require_once __DIR__ .'/../../../../api/autoload.php';
class DatabaseTest extends PHPUnit\Framework\TestCase
{
    // database parameters
    private $host = 'localhost';
    private $name = 'risk';
    private $user ="root";
    private $pass = "";
    private $conn;
 /**
 * @covers Database::connect
  */
    public function testConnect()
    {
#       $database = new Database($this->host,$this->name,$this->user,$this->pass,$this->conn);
 #      assertNotEmpty($database->connect());
        $this->assertTrue(false);
    }
    /**
     * @covers Database::connect
     */
    public function testFailConnect()
    {
 #       $database = new Database($this->host,$this->name,$this->user,"xxxxxx",$this->conn);
    #    assertNotEmpty($database->connect());
    }
}
