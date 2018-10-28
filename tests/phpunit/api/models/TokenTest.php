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
    private $dbname = 'risk';
    private $user = 'root';
    private $user_ = 'admin';
    private $pass = '';
    private $db = '';
    private $token;
    private $conn ;

    /**
     * @covers Token::setToken
     */
    public function testSetToken()
    {
        TokenTest::init_Token();
        $this->assertNull( $this->token->setToken());

    }

    /**
     * @covers Token::deleteToken
     */
    public function testDeleteToken()
    {
        TokenTest::init_Token();
        $this->assertFalse( $this->token->deleteToken());
    }

    /**
     * @covers Token::getToken
     */
    public function testGetToken()
    {
        TokenTest::init_Token();
        $this->assertNull($this->token->getToken());
    }

    /**
     * @covers Token::__construct
     */
    public function test__construct()
    {
        TokenTest::init_Token();
        $this->assertFalse($this->token->ok);
    }

        public function init_Token(){
            $this->conn = new Database($this->host, $this->dbname, $this->user, $this->pass);
            $this->db = $this->conn->connect();
            $this->token = new Token($this->db);
            $this->token->user_id=500594;
            $this->token->user_name="Michael";
            $this->token->user_type="Chaphole";
            $this->token->user_surname="Chaphole";
            $this->token->user_password="password";
            $this->token->utl_id=1;
        }
}