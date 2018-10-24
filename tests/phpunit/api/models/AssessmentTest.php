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
    private $name = 'risk';
    private $user = 'root';
    private $user_='admin';
    private $pass = '';
    /**
     * @covers Database::connect
     */
    /**
     * @covers Assessment::addAssessment
     */
    public function testAddAssessment()
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

    public function testGetPassRate()
    {

    }

    public function testGetSummary()
    {

    }
}
