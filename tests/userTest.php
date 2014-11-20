<?php
class UserTest extends PHPUnit_Framework_TestCase {

    protected function setUp()
    {
        include_once("functions.php");
        if (phpversion() < 5.5)
        {
            require_once ("passwordLib.php");
        }
    }

    public function testRegister()
    {
        $this->assertTrue(register("test", "test", "test", 3));
    }

    public function testLogin()
    {
        $user = new User("test", 0);
        $this->assertTrue($user->login("test", "test"));
        unlink("users/test.txt");
    }
}
?>