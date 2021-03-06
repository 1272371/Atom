<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/24
 * Time: 11:26 PM
 */

include_once __DIR__ .'../../../../../api/config/Database.php';
class DatabaseTest extends PHPUnit\Framework\TestCase
{


    private $host = '127.0.0.1';
    private $name = 'risk';
    private $user = 'root';
    private $user_='admin';
    private $pass = '';
    /**
     * @covers Database::connect
     */
    public function testConnect()
    {
        $database = new Database($this->host, $this->name, $this->user, $this->pass);
        $this->assertNotEmpty($database->connect());
    }
    public function testFailConnect()
    {
        $database = new Database($this->host,$this->name,$this->user_,$this->pass);
        $conn=$database->connect();
        if($conn instanceof \Exception){
            throw $conn;
        }
        $this->assertNull($conn);
    }

}
