<?php
	// grab the unit test framework
	require_once("/usr/lib/php5/simpletest/autorun.php");
	
	// grab the function(s) under scrutiny
    require_once("../php/user.php");
	//require_once("../php/sessions.php");
	require_once("../php/feedback.php");
	require_once("../../../tutorconnect/config.php");
	
	class FeedbackTest extends UnitTestCase
	{
		//variables to hold our mySQL instance
		private $mysqli;
		private $feedback;
		// private data for this test
		private $testSubjectId = 7;
		private $testReviewerId = 8;
		private $testSessionId = 31;
		private $testRating = 4;
		private $testComments = "This guy is awesome, and so is this site!";
		private $testUpdateRating = 1;
		private $testUpdateComments = "On second thought, he wanted to see my buttcrack!...";
		
		// setUp() is before *EACH* test
		public function setUp()
		{
			$this->mysqli = Pointer::getMysqli();
			// create & insert the feedback
			$this->feedback = new Feedback($this->testSubjectId, $this->testReviewerId, $this->testSessionId, $this->testRating, $this->testComments);
			$this->feedback->insert($this->mysqli);
		}
		
		public function testCreateFeedback()
		{	// select the feedback from mySQL and assert it was inserted properly
			$query = "SELECT subjectId, reviewerId, sessionId, rating, comments FROM feedback WHERE subjectId = ? AND reviewerId = ? AND sessionId = ?";
			$statement = $this->mysqli->prepare($query);
			$this->assertNotEqual($statement, false);
			
			// bind parameters to the query template
			$wasClean = $statement->bind_param("iii", $this->testSubjectId, $this->testReviewerId, $this->testSessionId);
			$this->assertNotEqual($wasClean, false);
			
			// execute the statement
			$executed = $statement->execute();
			$this->assertNotEqual($executed, false);
			
			// get the result & verify we only had 1
			$result = $statement->get_result();
			$this->assertNotEqual($result, false);
			$this->assertIdentical($result->num_rows, 1);
			
			// examine the result & assert we got what we want
			$row = $result->fetch_assoc();
			$sqlFeedback = new Feedback($row["subjectId"], $row["reviewerId"], $row["sessionId"], $row["rating"], $row["comments"]);
			
			// test variables to make sure they're right
			$this->assertIdentical($sqlFeedback->getSubjectId(), 	$this->testSubjectId);
			$this->assertIdentical($sqlFeedback->getReviewerId(), 	$this->testReviewerId);
			$this->assertIdentical($sqlFeedback->getSessionId(), 	$this->testSessionId);
			$this->assertIdentical($sqlFeedback->getRating(), 		$this->testRating);
			$this->assertIdentical($sqlFeedback->getComments(), 	$this->testComments);
			$statement->close();
			// unset($sqlFeedback);
		}
		
		public function testUpdateFeedback()
		{	// change feedback info and call update method
			$this->feedback->setRating($this->testUpdateRating);
			$this->feedback->setComments($this->testUpdateComments);
			$this->feedback->update($this->mysqli);
			
			// select the feedback from mySQL and assert it was inserted properly
			$query = "SELECT subjectId, reviewerId, sessionId, rating, comments FROM feedback WHERE subjectId = ? AND reviewerId = ? AND sessionId = ?";
			$statement = $this->mysqli->prepare($query);
			$this->assertNotEqual($statement, false);
			
			// bind parameters to the query template
			$wasClean = $statement->bind_param("iii", $this->testSubjectId, $this->testReviewerId, $this->testSessionId);
			$this->assertNotEqual($wasClean, false);
			
			// execute the statement
			$executed = $statement->execute();
			$this->assertNotEqual($executed, false);
			
			// get the result & verify we only had 1
			$result = $statement->get_result();
			$this->assertNotEqual($result, false);
			$this->assertIdentical($result->num_rows, 1);
			
			// examine the result & assert we got what we want
			$row = $result->fetch_assoc();
			$sqlFeedback2 = new Feedback($row["subjectId"], $row["reviewerId"], $row["sessionId"], $row["rating"], $row["comments"]);
			
			// test variables to make sure they're right
			$this->assertIdentical($sqlFeedback2->getSubjectId(), $this->testSubjectId);
			$this->assertIdentical($sqlFeedback2->getReviewerId(), $this->testReviewerId);
			$this->assertIdentical($sqlFeedback2->getSessionId(), $this->testSessionId);
			$this->assertIdentical($sqlFeedback2->getRating(), $this->testUpdateRating);
			$this->assertIdentical($sqlFeedback2->getComments(), $this->testUpdateComments);
			$statement->close();
			// unset($this->sqlFeedback2);
		}
			
		// tearDown() is after *EACH* test
		public function tearDown()
		{
			$this->feedback->delete($this->mysqli);
		}
	}
	
?>