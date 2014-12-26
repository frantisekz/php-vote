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
      $this->assertFalse(is_safe("+++"));
      $this->assertFalse(is_safe("++"));
      $this->assertFalse(is_safe("+test+"));
      $this->assertFalse(is_safe("+test"));
      $this->assertFalse(is_safe("test+"));
      $this->assertFalse(is_safe("test+++test"));
      $this->assertTrue(is_safe("test++test"));
    }

    public function testCreate_voting()
    {
      $code = date("y") . 1111;
      $voting = new Voting("test", 0);
      $voting->create_voting("test");
      $this->assertTrue($voting->voting_exists($code));
    }

    public function testview_votings()
    {
      $code = date("y") . 1111;
      $voting = new Voting("admin", 0);
      $this->assertContains($code, $voting->view_votings());
    }

    public function testview_voting()
    {
      $code = date("y") . 1111;
      $voting = new Voting("admin", 0);
      $this->assertEquals("test", $voting->view_voting($code));
    }

    public function testDelete_voting()
    {
      $code = date("y") . 1111;
      $voting = new Voting("test", 0);
      $this->assertTrue($voting->delete_voting($code));
      $this->assertFalse($voting->voting_exists($code));
    }
}
?>
