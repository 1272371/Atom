<?php

// includePath configured in phpunit.xml, so following will work
include_once 'Guestbook.php';

// if no includePath configured, then use following
// include_once 'src/Guestbook.php';

use app\models\Guestbook;

class GuestbookTest extends PHPUnit_Extensions_Database_TestCase
{

    static private $pdo = null;

    private $conn = null;

    public function getConnection()
    {
        if (!$this->conn) {
            if (!self::$pdo) {
                self::$pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_NAME']);
        }

        return $this->conn;
    }

    public function getDataSet()
    {
        // fill tables with data
        return new PHPUnit_Extensions_Database_DataSet_YamlDataSet(__DIR__ . '/_data/guestbook.yml');
    }

    public function testGuestbookHasTwoRows()
    {
        // there should be 2 rows in guestbook table
        $this->assertEquals(2, $this->getConnection()->getRowCount('guestbook'));
    }

    public function testGuestbookAddThirdRow()
    {
        // add new row into guestbook table
        $gb = new Guestbook();
        $gb->content = 'Third';
        $gb->user = 'john';
        $gb->created = '2016-12-11 10:00:00';
        $gb->add();

        // now there should be 3 rows in guestbook table
        $this->assertEquals(3, $this->getConnection()->getRowCount('guestbook'));

        // get last inserted rows - 3rd row
        $queryTable = $this->getConnection()->createQueryTable('guestbook', 'select * from guestbook');
        $lastRow = $queryTable->getRow(2); // get 3rd row

        // compare last row fields with guestbook object properties
        $this->assertEquals($gb->id, $lastRow['id']);
        $this->assertEquals($gb->content, $lastRow['content']);
        $this->assertEquals($gb->user, $lastRow['user']);
        $this->assertEquals($gb->created, $lastRow['created']);
    }

}