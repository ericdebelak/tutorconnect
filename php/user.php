<?php
	class User
	{
		// state (member) variables
		private $id;
		private $email;
		private $password;
		private $salt;
		private $verified;
		private $externalId;
		
		/* constructor for a user object
		 * input: (int) new Id
		 * input: (string) new email
		 * input: (string) new password
		 * input: (string) new salt
		 * throws: when invalid input detected */
		public function __construct($newId, $newEmail, $newPassword, $newSalt, $newVerified, $newExternalId)
		{
			try
			{
				// use the mutator methods since they have all input sanitization built in
				$this->setId($newId);
				$this->setEmail($newEmail);
				$this->setPassword($newPassword);
				$this->setSalt($newSalt);
				$this->setVerified($newVerified);
				$this->setExternalId($newExternalId);
				
			}
			catch(Exception $exception)
			{
				// rethrow the exception to the caller
				throw(new Exception("Unable to build user", 0, $exception));
			}
		}
		
// getters (or accessors)
		/* getter method for id
		 * input: N/A
		 * output: (id) id of the user */
		public function getId()
		{
			return($this->id);
		}
		
		/* getter method for email
		 * input: N/A
		 * output: (string) email of the user */
		public function getEmail()
		{
			return($this->email);
		}
		
		/* getter method for password
		 * input: N/A
		 * output: (string) password of the user */
		public function getPassword()
		{
			return($this->password);
		}
		
		/* getter method for salt
		 * input: N/A
		 * output: (string) salt of the user */
		public function getSalt()
		{
			return($this->salt);
		}
		
		/* getter method for verified
		 * input: N/A
		 * output: (integer) 0 for not verified 1, for verified */
		public function getVerified()
		{
			return($this->verified);
		}
		
		/* getter method for external Id
		 * input: N/A
		 * output: (string)  */
		public function getExternalId()
		{
			return($this->externalId);
		}
		
// setters (or mutators)
		/* setter method for id
		 * input: (int) new id
		 * output: N/A */
		public function setId($newId)
		{
			// throw out leading and trailing spaces  (sanitization1)
			$newId = trim($newId);
			// throw out obviously bad IDs (sanitization2)
			if(is_numeric($newId) === false)
			{
				throw(new Exception("Invalid user id detected: $newId is not numeric"));
			}
			// convert the ID to an integer (sanitization3)
			$newId = intval($newId);
			// throw out negative IDs except -1, which is our "new" user (sanitization4)
			if($newId < -1)
			{
				throw(new Exception("Invalid user id detected: $newId is less than -1"));
			}
			// sanitized, assign the value
			$this->id = $newId;
		}
		
		/* setter method for email
		 * input: (string) new email
		 * output: N/A */
		public function setEmail($newEmail)
		{
			// throw out leading and trailing spaces (sanitization1)
			$newEmail = trim($newEmail);
			// check to see if the email has a @ in it (sanitization2)
			if(strpos($newEmail, "@") === false)
			{
				throw(new Exception("Invalid email address detected: $newEmail"));
			}
			// sanitized, assign the value
			$this->email = $newEmail;
		}
		
		/* setter method for password
		 * input: (string) new password
		 * output: N/A */
		public function setPassword($newPassword)
		{
			
			if($newPassword !== null)
			{
				// throw out leading and trailing spaces (sanitization1)
				$newPassword = trim($newPassword);
				// convert A-F to a-f (sanitization2)
				$newPassword = strtolower($newPassword);
				// enforce 128 hexadecimal bytes
				$regexp = "/^([\da-f]){128}$/";
				if(preg_match($regexp, $newPassword) !== 1)
				{
					throw(new Exception("Invalid password detected: $newPassword"));
				}
			}
			// sanitized, assign the value
			$this->password = $newPassword;
		}
		
		/* setter method for salt
		 * input: new value
		 * output: N/A */
		public function setSalt($newSalt)
		{
			if($newSalt !== null)
			{
				// throw out leading and trailing spaces (sanitization1)
				$newSalt = trim($newSalt);
				// convert A-F to a-f (sanitization2)
				$newSalt = strtolower($newSalt);
				// enforce 128 hexadecimal bytes
				$regexp = "/^([\da-f]){64}$/";
				if(preg_match($regexp, $newSalt) !== 1)
				{
					throw(new Exception("Invalid salt detected: $newSalt"));
				}
			}
			// sanitized, assign the value
			$this->salt = $newSalt;
		}
		
		/* setter for verified
		* input: (int) whether or not verified
		 * output: N/A */
		public function setVerified($newVerified)
		{
			// throw out obviously bad input (sanitization2)
			if(is_numeric($newVerified) === false)
			{
				throw(new Exception("Invalid verification detected: $newVerified is not numeric"));
			}
			// convert the value to an integer (sanitization3)
			$newVerified = intval($newVerified);
			// throw out negative IDs except -1, which is our "new" user (sanitization4)
			if($newVerified < 0 || $newVerified > 1)
			{
				throw(new Exception("Invalid value detected: $newVerified"));
			}
			// sanitized, assign the value
			$this->verified = $newVerified;
		}
		
		/* setter for external Id
		* input: (int) whether or not verified
		 * output: N/A */
		public function setExternalId($newExternalId)
		{
			$this->externalId = $newExternalId;
		}
		
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
			// verify the id is -1 (i.e..., a new record)
			if($this->id !== -1)
			{
				throw(new Exception("Non new id detected"));
			}
			// create a query template
			$query = "INSERT INTO user(email, password, salt, verified, externalId) VALUES(?, ?, ?, ?, ?)";
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement. DOH!"));
			}
			// bind parameters to the query template
			$wasClean = $statement->bind_param("sssis", $this->email, $this->password, $this->salt, $this->verified, $this->externalId);
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
			
			$statement = null;
			$query = "SELECT id FROM user WHERE email = ?";
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement"));
			}
			// bind parameters to the query template
			$wasClean = $statement->bind_param("s", $this->email);
			if($wasClean === false)
			{
				throw(new Exception("Unable to bind parameters"));
			}
			// okay now do it
			if($statement->execute() === false)
			{
				throw(new Exception("Unable to execute statement"));
			}
			// get the result & make sure only 1 row is there
			$result = $statement->get_result();
			if($result === false || $result->num_rows !== 1)
			{
				throw(new Exception("Unable to determine user id: invalid result set"));				
			}
			// get the row and set the id, if you have a lot of rows, do this in a while
			$row = $result->fetch_assoc();
			$newId = $row["id"];
			try
			{
				$this->setId($newId);
			}
			catch(Exception $exception)
			{
				// re-throw if the id is bad
				throw(new Exception("Unable to determine user id", 0, $exception));
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
			// verify the id is not -1 (i.e..., a new record)
			if($this->id === -1)
			{
				throw(new Exception("new id detected"));
			}
			// create a query template
			$query = "DELETE FROM user WHERE id = ?";
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement. DOH!"));
			}
			// bind parameters to the query template
			$wasClean = $statement->bind_param("i", $this->id);
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
			// verify the id is not -1 (i.e..., a new record)
			if($this->id === -1)
			{
				throw(new Exception("new id detected"));
			}
			// create a query template
			$query = "UPDATE user SET email = ?, password = ?, salt = ?, verified = ?, externalId = ? WHERE id = ?";
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement. DOH!"));
			}
			// bind parameters to the query template
			$wasClean = $statement->bind_param("sssisi", $this->email, $this->password, $this->salt, $this->verified, $this->externalId, $this->id);
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
		
		//static methods
		
		/* static method to get user by email
		 * input: (pointer) to mysql
		 * input: (string) email to search by
		 * output: (object) user */
		public static function getUserByEmail(&$mysqli, $email)
		{
			// check for a good mySQL pointer
			if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
			{
				throw(new Exception("Non mySQL pointer detected."));
			}
			
			// create the query template
			$query = "SELECT id, email, password, salt, verified, externalId FROM user WHERE email = ?";
			
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement."));
			}
			
			// bind parameters to the query template
			$wasClean = $statement->bind_param("s", $email);
			if($wasClean === false)
			{
				throw(new Exception("Unable to bind paramenters."));
			}
			
			// ok, let's rock!
			if($statement->execute() === false)
			{
				throw(new Exception("Unable to execute the statement."));
			}
			
			// get the result and make a new object
			$result = $statement->get_result();
			if($result === false || $result->num_rows !== 1)
			{
				throw(new Exception("Unable to determine user: email not found."));
			}
			
			// get the row and create the user object
			$row = $result->fetch_assoc();
			$user = new User($row["id"], $row["email"], $row["password"], $row["salt"], $row["verified"], $row["externalId"]);
			return($user);
			
			$statement->close();
		}
		
		/* static method to get user by id
		 * input: (pointer) to mysql
		 * input: (string) id to search by
		 * output: (object) user */
		public static function getUserById(&$mysqli, $id)
		{
			// check for a good mySQL pointer
			if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
			{
				throw(new Exception("Non mySQL pointer detected."));
			}
			
			// create the query template
			$query = "SELECT id, email, password, salt, verified, externalId FROM user WHERE id = ?";
			
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement."));
			}
			
			// bind parameters to the query template
			$wasClean = $statement->bind_param("i", $id);
			if($wasClean === false)
			{
				throw(new Exception("Unable to bind paramenters."));
			}
			
			// ok, let's rock!
			if($statement->execute() === false)
			{
				throw(new Exception("Unable to execute the statement."));
			}
			
			// get the result
			$result = $statement->get_result();
			if($result === false || $result->num_rows !== 1)
			{
				throw(new Exception("Unable to determine user: id not found."));
			}
			
			// get the row and create a user object
			$row = $result->fetch_assoc();
			$user = new User($row["id"], $row["email"], $row["password"], $row["salt"], $row["verified"], $row["externalId"]);
			return($user);
			
			$statement->close();
		}
	}

?>