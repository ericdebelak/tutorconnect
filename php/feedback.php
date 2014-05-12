<?php
	class Feedback
	{
		private $subjectId;
		private $reviewerId;
		private $sessionId;
		private $rating;
		private $comments;
		
		/* constructor for a feedback object
		 * input: (int) subjectId (from User class) **foreignkey**
		 * input: (int) reviewerId (from User class) **foreignkey**
		 * input: (int) sessionId (from Session class) **foreignkey**
		 * input: (int) rating between 0 and 5
		 * input: (string) comments written review of subject and session
		 * throws: for a host of reasons that happen when invalid input detected */
		public function __construct($subjectId, $reviewerId, $sessionId, $rating, $comments)
		{
			try
			{	// use the setter methods since they have all input sanitization built in
				$this->setSubjectId($subjectId);
				$this->setReviewerId($reviewerId);
				$this->setSessionId($sessionId);
				$this->setRating($rating);
				$this->setComments($comments);
			}
			catch(Exception $exception)
			{	// rethrow the exception to the caller
				throw(new Exception("Unable to build feedback", 0, $exception));
			}
		}
		
// *********************** GETTERS *********************** //	
		/* getter method for subjectId
		 * input: N/A
		 * output: (id) id of the user ABOUT WHOM the review is written */
		public function getSubjectId()
		{
			return($this->subjectId);
		}
		/* getter method for reviewerId
		 * input: N/A
		 * output: (id) id of the reviewer */
		public function getReviewerId()
		{
			return($this->reviewerId);
		}
		/* getter method for sessionId
		 * input: N/A
		 * output: the id of the session where the reviewer and subject worked together */
		public function getSessionId()
		{
			return($this->sessionId);
		}
		/* getter method for rating
		 * input: N/A
		 * output: rating given to the subject by reviewer */
		public function getRating()
		{
			return($this->rating);
		}
		/* getter method for comments
		 * input: N/A
		 * output: comments left by reviewer ABOUT subject*/
		public function getComments()
		{
			return($this->comments);
		}
		
// *********************** SETTERS *********************** //	
		/* setter method for subjectId
		 * input: (int) userId of subject ABOUT WHOM the feedback is given
		 * output: N/A 
		 * throws: for a variety of reasons, see exception */
		public function setSubjectId($inputSubjectId)
		{	// throw out leading and trailing spaces (sanitization1)
			$inputSubjectId = trim($inputSubjectId);
			// test to ensure the input is numeric (sanitization2)
			if(is_numeric($inputSubjectId) === false)
			{
				throw(new Exception("Invalid user id detected: $inputSubjectId is not numeric"));
			}
			// convert the ID to an integer (sanitization3)
			$inputSubjectId = intval($inputSubjectId);
			// throw out negative IDs, only established user IDs should be passed in. (sanitization4)
			if($inputSubjectId < 0)
			{
				throw(new Exception("Invalid user id detected: $inputSubjectId is less than 0"));
			}
			// sanitized, assign the value
			$this->subjectId = $inputSubjectId;
		}
		/* setter method for reviewerId
		 * input: (int) userId of reviewer writing about subject
		 * output: N/A
		 * throws: for a variety of reasons, see exception */
		public function setReviewerId($inputReviewerId)
		{	// throw out leading and trailing spaces  (sanitization1)
			$inputReviewerId = trim($inputReviewerId);
			// throw out obviously bad IDs (sanitization2)
			if(is_numeric($inputReviewerId) === false)
			{
				throw(new Exception("Invalid user id detected: $inputReviewerId is not numeric"));
			}
			// convert the ID to an integer (sanitization3)
			$inputReviewerId = intval($inputReviewerId);
			// throw out negative IDs, only established user IDs should be passed in. (sanitization4)
			if($inputReviewerId < 0)
			{
				throw(new Exception("Invalid user id detected: $inputReviewerId is less than 0"));
			}
			// sanitized, assign the value
			$this->reviewerId = $inputReviewerId;
		}
		/* setter method for sessionId
		 * input: (int) id number of session
		 * output: N/A 
		 * throws: for a variety of reasons, see exception */
		public function setSessionId($inputSessionId)
		{	// throw out leading and trailing spaces  (sanitization1)
			$inputSessionId = trim($inputSessionId);
			// throw out obviously bad IDs (sanitization2)
			if(is_numeric($inputSessionId) === false)
			{
				throw(new Exception("Invalid session id detected: $inputSessionId is not numeric"));
			}
			// convert the ID to an integer (sanitization3)
			$inputSessionId = intval($inputSessionId);
			// throw out negative IDs, only established session IDs should be passed in. (sanitization4)
			if($inputSessionId < 0)
			{
				throw(new Exception("Invalid session id detected: $inputSessionId is less than 0"));
			}
			// sanitized, assign the value
			$this->sessionId = $inputSessionId;
		}
		/* setter method for rating
		 * input: (int) rating between 1 and 5
		 * output: N/A 
		 * throws: for a variety of reasons, see exception */
		public function setRating($inputRating)
		{	
			// throw out leading and trailing spaces  (sanitization1)
			$inputRating = trim($inputRating);
			// throw out obviously bad IDs (sanitization2)
			if(is_numeric($inputRating) === false)
			{
				throw(new Exception("Invalid user id detected: $inputRating is not numeric"));
			}
			// convert the ID to an integer (sanitization3)
			$inputRating = intval($inputRating);
			// throw out invalid numbers, only numbers between 0 and 5 should be passed in. (sanitization4)
			if($inputRating < 0 || $inputRating > 5)
			{
				throw(new Exception("Invalid rating detected: $inputRating is not between 0 and 5"));
			}
			// sanitized, assign the value
			$this->rating = $inputRating;
		}
		/* setter mothod for comments
		 * input: (string) comments from reviewer ABOUT subject 
		 * output: N/A 
		 * throws: for a variety of reasons, see exception */
		public function setComments($inputComments)
		{	// throw out leading and trailing spaces (sanitization1)
			$inputComments = trim($inputComments);
			// make sure comments don't have any html tags, or script tags, or any other funny business. (sanitization2)
			$inputComments = htmlspecialchars($inputComments);
			// lacking any other sanitization, consider this sanitized. Assign the value
			$this->comments = $inputComments;
		}

// *********************** Database manipulation functions *********************** //	
		/* inserts a new object into mySQl
		 * input: (pointer) mySQL connection, by reference
		 * output: N/A
		 * throws: if the object could not be inserted */
		public function insert(&$mysqli)
		{
			// handle degenerate cases
			if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
			{
				throw(new Exception("Non mySQL pointer detected"));
			}
			// create a query template
			$query = "INSERT INTO feedback(subjectId, reviewerId, sessionId, rating, comments) VALUES(?, ?, ?, ?, ?)";
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement. $query"));
			}
			// bind parameters to the query template
			$wasClean = $statement->bind_param("iiiis", $this->subjectId, $this->reviewerId, $this->sessionId, $this->rating, $this->comments);
			if($wasClean === false)
			{
				throw(new Exception("Unable to bind parameters"));
			}
			// okay now do it
			if($statement->execute() === false)
			{
			var_dump($statement);
				throw(new Exception("Unable to execute statement"));
			}
			// clean up the statement
			$statement->close();
		}
		
		public function delete(&$mysqli)
		{
			// handle degenerate cases
			if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
			{
				throw(new Exception("Non mySQL pointer detected"));
			}
			// create a query template
			$query = "DELETE FROM feedback WHERE subjectId  = ? AND reviewerId = ? AND sessionId = ?";
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement."));
			}
			// bind parameters to the query template
			$wasClean = $statement->bind_param("iii", $this->subjectId, $this->reviewerId, $this->sessionId);
			if($wasClean === false)
			{
				throw(new Exception("Unable to bind parameters"));
			}
			// okay now do it
			if($statement->execute() === false)
			{
				throw(new Exception("Unable to execute statement"));
			}
			// clean up the statement
			$statement->close();
		}
		/* updates this object in mySQL
		 * input (pointer) mySQL connection, by reference
		 * output: N/A
		 * throws: if the object could not be updated */
		public function update(&$mysqli)
		{	
			// handle degenerate cases
			if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
			{
				throw(new Exception("Non mySQL pointer detected"));
			}
			// make sure we're working with a valid objects
			if($this->subjectId < 0 || $this->reviewerId < 0 || $this->sessionId < 0)
			{
				if($this->subjectId < 0)
				{
					throw(new Exception("invalid subjectId"));
				}
				elseif($this->reviewerId < 0)
				{
					throw(new Exception("invalid reviewerId"));
				}
				elseif($this->sessionId < 0)
				{
					throw(new Exception("invalid sessionId"));
				}
				else
				{
					throw(new Exception("WTF"));
				}
			}
			// create a query template
			$query = "UPDATE feedback SET rating = ?, comments = ? WHERE subjectId = ? AND reviewerId = ? AND sessionId = ?";
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement. DOH!"));
			}
			// bind parameters to the query template
			$wasClean = $statement->bind_param("isiii", $this->rating, $this->comments, $this->subjectId, $this->reviewerId, $this->sessionId);
			if($wasClean === false)
			{
				throw(new Exception("Unable to bind parameters"));
			}
			// okay now do it
			if($statement->execute() === false)
			{
				throw(new Exception("Unable to execute statement"));
			}
			// clean up the statement
			$statement->close();
		}
// *********************** STATIC METHODS *********************** //
		public static function getFeedbackBySubjectId(&$mysqli,$subjectId)
		{
			// check for a good mySQL pointer
            if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
            {
                throw(new Exception("Non mySQL pointer detected."));
            }
            // create the query template
            $query = "SELECT subjectId, reviewerId, sessionId, rating, comments FROM feedback WHERE subjectId = ?";
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare statement."));
            }            
            // bind parameters to the query template
            $wasClean = $statement->bind_param("i", $subjectId);
            if($wasClean === false)
            {
                throw(new Exception("Unable to bind paramenters."));
            }
            // execute the statment in the database
            if($statement->execute() === false)
            {
                throw(new Exception("Unable to execute the statement."));
            }
            // get the result and make a new object
            $result = $statement->get_result();
            if($result === false || $result->num_rows < 1)
            {
                throw(new Exception("Unable to find subject, maybe they have no feedback yet."));
            }
            // get the array of feedback(s) if they exist
            $feedbackArray = array();
            while($row = $result->fetch_assoc())
            {
                // add feedback objects into the array row by row
                $feedbackArray[] = new Feedback($row["subjectId"], $row["reviewerId"], $row["sessionId"], $row["rating"], $row["comments"]);
            }
            $statement->close();
            return($feedbackArray);
		}
		public static function getAverageRatingBySubjectId(&$mysqli,$subjectId)
		{
			// check for a good mySQL pointer
            if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
            {
                throw(new Exception("Non mySQL pointer detected."));
            }
            // create the query template
            $query = "SELECT rating FROM feedback WHERE subjectId = ?";
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare statement."));
            }            
            // bind parameters to the query template
            $wasClean = $statement->bind_param("i", $subjectId);
            if($wasClean === false)
            {
                throw(new Exception("Unable to bind paramenters."));
            }
            // execute the statment in the database
            if($statement->execute() === false)
            {
                throw(new Exception("Unable to execute the statement."));
            }
            // get the result and make a new object
            $result = $statement->get_result();
            if($result === false || $result->num_rows < 1)
            {
                throw(new Exception("Unable to find subject, maybe they have no feedback yet."));
            }
            // get the array of feedback(s) if they exist
            $ratingArray = array();
            while($row = $result->fetch_assoc())
            {
                // add feedback objects into the array row by row
                $ratingArray[] = $row["rating"];
            }
            $statement->close();
            return(array_sum($ratingArray));
		}
	}
?>






