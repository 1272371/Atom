<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/03
 * Time: 11:32 PM
 */

require __DIR__ .'/../../../../vendor/autoload.php';
class DatabaseTest extends PHPUnit_Framework_TestCase
{
    // database parameters
    private $host = 'localhost';
    private $name = 'risk';
    private $user ="root";
    private $pass = "";
    private $conn;

    public function testConnect()
    {
       $database = new Database($this->host,$this->name,$this->user,$this->pass,$this->conn);
       assertNotEmpty($database->connect());
    }
    public function testFailConnect()
    {
        $database = new Database($this->host,$this->name,$this->user,"xxxxxx",$this->conn);
        assertNotEmpty($database->connect());
    }
}
