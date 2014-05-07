<?php
	// grab the unit test framework
	require_once("/usr/lib/php5/simpletest/autorun.php");
	
	// grab the function(s) under scrutiny
    require_once("../php/user.php");
	require_once("../php/sessions.php");
	require_once("../php/feedback.php");
	
	class FeedbackTest extends UnitTestCase
	{
		//variables to hold our mySQL instance
		private $mysqli;
		// variable to hold the mySQL feedback
		private $sqlFeedback;
		private $sqlFeedback2;
		// private data for this test
		private $testTutorId = 1;
		private $testStudentId = 2;
		private $testSessionId = 1;
		private $testRating = 4;
		private $testComments = "This guy is awesome, and so is this site!";
		private $testUpdateRating = 1;
		private $testUpdateComments = "On second thought, maybe not...";
		
		
		// setUp() is before *EACH* test
		function setUp()
		{
			require_once("../../../tutorconnect/config.php");
		}
		
		function testCreateFeedback()
		{
			// create & insert the feedback
			$feedback = new Feedback($this->testTutorId, $this->testStudentId, $this->testSessionId, $this->testRating, $this->testComments);
			$feedback->insert($this->mysqli);
			
			// select the feedback from mySQL and assert it was inserted properly
			$query = "SELECT tutorId, studentId, sessionId, rating, comments FROM feedback WHERE tutorId = ? AND studentId = ? AND sessionId = ?";
			$statement = $this->mysqli->prepare($query);
			$this->assertNotEqual($statement, false);
			
			// bind parameters to the query template
			$wasClean = $statement->bind_param("iii", $this->testTutorId, $this->testStudentId, $this->testSessionId);
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
			$this->sqlFeedback = new Feedback($row["tutorId"], $row["studentId"], $row["sessionId"], $row["rating"], $row["comments"]);
			
			// test variables to make sure they're right
			$this->assertIdentical($this->sqlFeedback->getTutorId(), $this->tutorId);
			$this->assertIdentical($this->sqlFeedback->getStudentId(), $this->studentId);
			$this->assertIdentical($this->sqlFeedback->getSessionId(), $this->sessionId);
			$this->assertIdentical($this->sqlFeedback->getRatings(), $this->ratings);
			$this->assertIdentical($this->sqlFeedback->getComments(), $this->comments);
			$statement->close();
		}
		
		function testUpdateFeedback()
		{	// change feedback info and call update method
			$feedback->setRating = $testUpdateRating;
			$feedback->setComments = $testUpdateComments;
			$feedback->update($this->mysqli);
			
			// select the feedback from mySQL and assert it was inserted properly
			$query = "SELECT tutorId, studentId, sessionId, rating, comments FROM feedback WHERE tutorId = ? AND studentId = ? AND sessionId = ?";
			$statement = $this->mysqli->prepare($query);
			$this->assertNotEqual($statement, false);
			
			// bind parameters to the query template
			$wasClean = $statement->bind_param("iii", $this->testTutorId, $this->testStudentId, $this->testSessionId);
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
			$this->sqlFeedback2 = new Feedback($row["tutorId"], $row["studentId"], $row["sessionId"], $row["rating"], $row["comments"]);
			
			// test variables to make sure they're right
			$this->assertIdentical($this->sqlFeedback2->getTutorId(), $this->tutorId);
			$this->assertIdentical($this->sqlFeedback2->getStudentId(), $this->studentId);
			$this->assertIdentical($this->sqlFeedback2->getSessionId(), $this->sessionId);
			$this->assertIdentical($this->sqlFeedback2->getRatings(), $this->testUpdateRating);
			$this->assertIdentical($this->sqlFeedback2->getComments(), $this->testUpdateComments);
			$statement->close();
		}
		
		function testDeleteFeedback()
		{	// use the delete function to remove the object previously inserted
			$this->$feedback->delete($this-mysqli);
			//now check to make sure it's not there anymore
			$query = "SELECT tutorId, studentId, sessionId, rating, comments FROM feedback WHERE tutorId = ? AND studentId = ? AND sessionId = ?";
			$statement = $this->mysqli->prepare($query);
			$this->assertNotEqual($statement, false);
			
			// bind parameters to the query template
			$wasClean = $statement->bind_param("iii", $this->testTutorId, $this->testStudentId, $this->testSessionId);
			$this->assertNotEqual($wasClean, false);
			
			// execute the statement
			$executed = $statement->execute();
			$this->assertNotEqual($executed, false);
			
			// get the result & verify we didn't have any rows to verify it was deleted.
			$result = $statement->get_result();
			$this->assertNotEqual($result, false);
			$this->assertIdentical($result->num_rows, 0);
		}
		
		// tearDown() is after *EACH* test
		function tearDown()
		{
			unset($this->sqlFeedback);
			unset($this->sqlFeedback2);
		}
	}
	
?>