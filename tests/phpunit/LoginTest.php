<?php
#this require wont work with everyone ,therefore you will need the following
#locate DB.php
#then copy the path and replace the one in the brackets
require_once('/opt/lampp/htdocs/Atom/api/DB.php');
require_once('/opt/lampp/htdocs/Atom/api/index.php');
require_once('/opt/lampp/htdocs/Atom/php/connect.php');

use PHPUnit_Framework_TestCase;
use PHPUnit_DbUnit_TestCaseTrait;


class loginTest extends TestCase{
       var $fvalue   = 0;
       var $pvalue   = 1;
       var $username = "1234567";
       var $password = "password";
    static private $pdo;
    static private $conn;

    final public function getConnection()
    {
        if (is_null(static::$conn))
        {
            if (is_null(static::$pdo))
            {
                static::$pdo=new DB('127.0.0.1', 'd815108','s815108','random123');
            }

            static::$conn = $this->createDefaultDBConnection(static::$pdo, 'dbname');
        }

        return static::$conn;
    }
  }

?>