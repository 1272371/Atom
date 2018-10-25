<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/25
 * Time: 12:19 PM
 */


include_once __DIR__ .'../../../../../api/models/Token.php';
include_once __DIR__ .'../../../../../api/config/Database.php';
class TokenTest extends \PHPUnit\Framework\TestCase
{
    private $host = '127.0.0.1';
    private $name = 'risk';
    private $user = 'root';
    private $pass = '';
    private $token;
    private $db;

    /**
     * @covers Token::setToken
     */
    public function testSetToken()
    {
        $conn = new Database($this->host, $this->name, $this->user, $this->pass);
        $this->db=$conn->connect();
        $this->token = new Token($this->db);
        $this->assertNull( $this->token->setToken());

    }

    /**
     * @covers Token::deleteToken
     */
    public function testDeleteToken()
    {
        $this->token = new Token($this->db);
        $this->assertTrue( $this->token->deleteToken());
    }

    /**
     * @covers Token::getToken
     */
    public function testGetToken()
    {
        $this->token = new Token($this->db);
        $this->assertNotEmpty($this->token->getToken());
    }

    /**
     * @covers Token::__construct
     */
    public function test__construct()
    {
        $this->token = new Token($this->db);
        $this->assertFalse($this->token->ok);
    }
}