<?php
class VotingTest extends PHPUnit_Framework_TestCase {

    protected function setUp()
    {
        include_once("functions.php");
        if (phpversion() < 5.5)
        {
            require_once ("passwordLib.php");
        }
    }

    public function testIs_safe()
    {
        $voting = new Voting("test", 0);
        $this->assertFalse($voting->is_safe("+++"));
        $this->assertFalse($voting->is_safe("++"));
        $this->assertFalse($voting->is_safe("+test+"));
        $this->assertFalse($voting->is_safe("+test"));
        $this->assertFalse($voting->is_safe("test+"));
        $this->assertFalse($voting->is_safe("test+++test"));
        $this->assertTrue($voting->is_safe("test++test"));
    }

    public function testCreate_delete_voting()
    {
        $voting = new Voting("test", 0);
        $code = date("y") . $voting->create_voting("test");
        $this->assertTrue($voting->voting_exists($code));
        $this->assertTrue($voting->delete_voting($code));
        $this->assertFalse($voting->voting_exists($code));
    }
}
?>