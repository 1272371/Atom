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
    /**
     * @covers Mark::get
     */
    public function testGet()
    {
        $db = new Database($this->host, $this->dbname, $this->user, $this->pass);
        $mark = new Mark($this->$db);
        $this->assertNotEmpty($mark->get());
    }
}
