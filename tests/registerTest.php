<?php
class registerTest extends PHPUnit_Framework_TestCase {

    private $user;

    protected function setUp()
    {
        include("functions.php");
        if (phpversion() < 5.5)
        {
            require_once ('../passwordLib.php');
        }
        $this->user = new user("test", 1);
    }

    public function testRegister()
    {
        $this->assertTrue(register("test", "test", "test", 3));
        unlink("users/test.txt"); // CLeanup
    }
}
?>