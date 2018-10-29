<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/21
 * Time: 6:44 PM
 */

include_once __DIR__ .'../../../../../api/models/Statistic.php';
class StatisticTest extends PHPUnit\Framework\TestCase
{
    /**
     * @covers Statistic::getAverage
     */
    public function testGetAverage()
    {
        $statistic = new Statistic();
        $data =[2,3,4];
        $this->assertNotEmpty($statistic->getAverage($data));
        $this->assertEmpty($statistic->getAverage([]));
    }
    /**
     * @covers Statistic::get_numeric
     */
    public function testGet_numeric()
    {
        $statistic = new Statistic();
        $val =1;
        $this->assertNotEmpty($statistic->get_numeric($val));
        //test fail
        $this->assertEmpty($statistic->get_numeric("a"));
    }
}
