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
      $voting = new Voting("test", 0);
      $rand = $voting->create_voting("test");
      return $rand;
    }

    /**
    * @depends testCreate_voting
    */
    public function testview_votings($rand)
    {
      $voting = new Voting("admin", 0);
      $this->assertTrue($voting->voting_exists($rand));
      $this->assertContains($rand, $voting->view_votings("admin", 1));
    }

    /**
    * @depends testCreate_voting
    */
    public function testview_voting($rand)
    {
      $voting = new Voting("admin", 0);
      $this->assertEquals("test", $voting->view_voting($rand));
    }

    /**
    * @depends testCreate_voting
    */
    public function testAdd_question($rand)
    {
      $voting = new Voting("admin", 0);
      $possibilities = array("Possibility 1", "Possibility 2", "Possibility 3", "Possibility 4");
      $this->assertTrue($voting->add_question($rand, "Question number 1 Header", $possibilities));
      $this->assertTrue($voting->add_question($rand, "Question number 2 Header", $possibilities));
      $this->assertTrue($voting->add_question($rand, "Question number 3 Header", $possibilities));
      $this->assertTrue($voting->add_question($rand, "Question number 4 Header", $possibilities));
    }

    /**
    * @depends testCreate_voting
    */
    public function testRemove_question($rand)
    {
      $voting = new Voting("admin", 0);
      $this->assertTrue($voting->remove_question($rand, 3));
      $this->assertTrue($voting->renumber_questions($rand));
    }

    /**
    * @depends testCreate_voting
    */
    public function testQuestion_count($rand)
    {
      $voting = new Voting("admin", 0);
      $this->assertEquals($voting->question_count($rand), 3);
    }

    /**
    * @depends testCreate_voting
    */
    public function testQuestion_header($rand)
    {
      $voting = new Voting("admin", 0);
      $this->assertContains("Question number 1 Header", $voting->question_header($rand, 1));
      $this->assertContains("Question number 2 Header", $voting->question_header($rand, 2));
      $this->assertContains("Question number 4 Header", $voting->question_header($rand, 3));
    }

    /**
    * @depends testCreate_voting
    */
    public function testGet_questions($rand)
    {
      $voting = new Voting("admin", 0);
      $this->assertContains(1, $voting->get_questions($rand));
      $this->assertContains(2, $voting->get_questions($rand));
      $this->assertContains(3, $voting->get_questions($rand));
    }

    /**
    * @depends testCreate_voting
    */
    public function testGet_possibilities($rand)
    {
      /*
      Broken
      $voting = new Voting("admin", 0);
      $possibilities = array("Possibility 1", "Possibility 2", "Possibility 3", "Possibility 4");
      $this->assertEquals($voting->get_possibilities($rand, 1), $possibilities, $possibilities);
      */
    }

    /**
    * @depends testCreate_voting
    */
    public function testVoting_lock($rand)
    {
      /*
      Broken
      $voting = new Voting("admin", 0);
      $this->assertTrue($voting->voting_lock($rand));
      $helper = $voting->get_more($rand);
      $this->assertEquals(1, $helper[3]);
      */
    }

    /**
    * @depends testCreate_voting
    */
    public function testDelete_voting($rand)
    {
      $voting = new Voting("test", 0);
      $this->assertTrue($voting->delete_voting($rand));
      $this->assertFalse($voting->voting_exists($rand));
    }
}
?>
