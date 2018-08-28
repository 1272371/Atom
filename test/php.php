<?php
/**
 * PHPUnit test class for LoginPHP.
 */
class TestLogins extends \PHPUnit_Framework_TestCase
{
    /** Test login success */   
    public function TestLoginPass()
    {
        $this->assertEquals(1, Login(1234567,password));
    }
      /** Test login fail */  
     public function TestLoginFail()
    {
        $this->assertEquals(0,Login(1234565,password));
    }
}
