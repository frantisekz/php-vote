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
        $this->assertTrue(register("test", "test", "test", 3, 0));

    }

    public function testLogin()
    {
        $user = new User("test", 0);
        $this->assertTrue($user->login("test", "test"));
        $this->assertTrue($user->logged_in());
    }

    public function testGet_cur_username()
    {
        $user = new User("test", 0);
        $user->load_file("test");
        $this->assertEquals("test", $user->get_cur_username("test"));
    }

    public function testGet_email()
    {
        $user = new User("test", 0);
        $user->load_file("test");
        $this->assertEquals("test", $user->get_email("test"));
    }

    public function testGet_level()
    {
        $user = new User("test", 0);
        $user->load_file("test");
        $this->assertEquals("3", $user->get_level("test"));
    }

    public function testDelete_user()
    {
        $user = new User("test", 0);
        $user->load_file("test");
        $this->assertTrue($user->delete_user("test"));
    }
}
?>