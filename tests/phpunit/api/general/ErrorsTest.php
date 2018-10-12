<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2018/10/03
 * Time: 11:35 PM
 */
require __DIR__ .'/../../../../api/autoload.php';
include_once __DIR__ .'../../../../../api/general/Error.php';
class ErrorsTest extends PHPUnit\Framework\TestCase
{

    /**
     * @covers Errors::getErrorPage
     */
    public function testGetErrorPage()
    {
        $err=new Errors();
        /**
         * @codeCoverIgnore
         */
    }
}
