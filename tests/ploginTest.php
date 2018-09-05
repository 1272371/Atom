<?php
    /**
     * Created by PhpStorm.
     * User: root
     * Date: 2018/08/29
     * Time: 5:24 PM
     */
    use PHPUnit\Framework\TestCase;
    require __DIR__ . "/../php/login.php";

    class ploginTest extends TestCase
    {
        var $fvalue   = 0;
        var $pvalue   = 1;
        var $password = "password";
        var $username = "1234567";

        public
        function testInit ()
        {
            new login( $this->username , $this->password );
           $this->assertNotEmpty (Login::username);
           $this->assertNotEmpty (Login::password);
        }
        public
        function testLogin ()
        {
            $this->assertEquals ( $this->fvalue ,new login( $this->username , $this->password ) );
            $this->assertEquals ( $this->pvalue , new login( $this->username , $this->password ) );

        }

        public
        function write (
            $file , $content
        )
        {
            $file = fopen ( $file , 'w' );
            if ( $file == false ) {
                return false;
            }
        }
    }
