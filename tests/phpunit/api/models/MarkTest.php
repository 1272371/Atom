<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/03
 * Time: 11:36 PM
 */

require __DIR__ .'/../../../../api/autoload.php';
include_once __DIR__ .'../../../../../api/marks/get.php';
class MarkTest extends PHPUnit\Framework\TestCase
{
    private $db='';
    /**
     * @covers Mark::get
     */
    public function testGet()
    {
/*        $mark = new Mark($this->db);
        $results = $mark->get();
        $this->assertNotEmpty($results);*/
    }
}
