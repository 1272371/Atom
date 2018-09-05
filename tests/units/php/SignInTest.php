<?php

use php\Signing\SignIn;

class SignInTest extends PHPUnit_Framework_TestCase {
    
    public function testReturnTrueReturnsTrue() {

        $signin = new SignIn;
        $this->assertTrue($signin->returnTrue());

    }

}