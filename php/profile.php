<?php
    class Profile
    {
        //state variables
        private $id;
        private $userId;
        private $firstName;
        private $lastName;
        private $birthday;
        private $picture;
        private $travel;
        private $rate;
/* constructor for a Profile object
        * input: (integer) new Id
        * input: (integer) new userId
        * input: (string) new first name
        * input: (string) new last name
        * input: (integer) new picture
        * input: (integer) new travel
        * input: (decimal) new rate */
        public function __construct($newId, $newUserId, $newFirstName, $newLastName, $newBirthday, $newPicture, $newTravel, $newRate)
        {
            try
            {
                //use the mutator methods since they have all input santization
                $this->setId($newId);
                $this->setUserId($newUserId);
                $this->setFirstName($newFirstName);
                $this->setLastName($newLastName);
                $this->setBirthday($newBirthday);
                $this->setPicture($newPicture);
                $this->setTravel($newTravel);
                $this->setRate($newRate);
            }
            catch(Exception $exception)
            {
                //rethrow the exception to the caller
                echo $exception->getMessage();
                throw(new Exception("Unable to build profile", 0, $exception));
            }
        }
// accessor functions
        public function getId()
        {
                return($this->id);
        }
        public function getUserId()
        {
                return($this->userId);
        }
        public function getFirstName()
        {
                return($this->firstName);
        }
        public function getLastName()
        {
                return($this->lastName);
        }
        public function getBirthday()
        {
                return($this->birthday);
        }
        public function getPicture()
        {
                return($this->picture);
        }
        public function getTravel()
        {
                return($this->travel);
        }
        public function getRate()
        {
                return($this->rate);
        }
// mutator functions
        /* for id
        * input: (integer) new id
        * output: n/a
        * throws: invalid input detected*/
        public function setId($newId)
        {
                if(is_numeric($newId) === false)
                {
                        throw(new Exception("Invalid user id detected: $newId"));
                }
                
                // convert the id to an integer
                $newId = intval($newId);
                
                // throw out negative ids except -1, which is our placeholder
                if($newId < -1)
                {
                        throw(new Exception("Invalid user id detected: $newId"));
                }
                
                // sanitized; assign value
                $this->id = $newId;
        }
		
        /* for user id
        * input: (integer) new user id
        * output: n/a
        * throws: invalid input detected */
        public function setUserId($newUserId)
        {
                if(is_numeric($newUserId) === false)
                {
                        throw(new Exception("Invalid user id detected: $newUserId"));
                }
                
                // convert the id to an integer
                $newUserId = intval($newUserId);
                
                // throw out negative ids, which is our placeholder
                if($newUserId < 0)
                {
                        throw(new Exception("Invalid user id detected: $newUserId"));
                }
                
                // sanitized; assign value
                $this->userId = $newUserId;
        }
        
        /* for first name
        * input: (string) new first name
        * output: n/a
        * throws: invalid first name */
        public function setFirstName($newFirstName)
        {
                // trim the name
                $newFirstName = trim($newFirstName);
                
                // require characters only
                $regexp = "/^[A-Za-z\-\']*$/";
                if(preg_match($regexp, $newFirstName) === false)
                {
                        throw(new Exception("Invalid name detected: $newFirstName"));
                }
                
                // sanitized; assign the value
                $this->firstName = $newFirstName;
        }
        
        /* for last name
        * input: (string) new last name
        * output: n/a
        * throws: invalid first name */
        public function setLastName($newLastName)
        {
                // trim the name
                $newLastName = trim($newLastName);
                
                // require characters only
                $regexp = "/^[A-Za-z\-\']*$/";
                if(preg_match($regexp, $newLastName) === false)
                {
                        throw(new Exception("Invalid name detected: $newLastName"));
                }
                
                // sanitized; assign the value
                $this->lastName = $newLastName;
        }
        
        /* for birthday
        * input: (string) new birthday
        * output: n/a
        * throws: invalid birthday */
        public function setBirthday($newBirthday)
        {	
                // require the right format
                $regexp = "/^[\d]{4}\-[\d]{2}\-[\d]{2}$/";
                if(preg_match($regexp, $newBirthday) === 0)
                {
                        throw(new Exception("Invalid date: $newBirthday. Please use yyyy-mm-dd"));
                }
                // sanitized; assign the value
                $this->birthday = $newBirthday;
        }	
        public function setPicture($newPicture)
        {
                // WE NEED TO FIX THIS LATER
                // gets file size and throws if > 200kb
                //if(filesize($newPicture) > 204800)
                //{
                //        throw(new Exception("File size can not be greater than 200kb"));
                //}
                //           
                ////breaks the file into parts
                //$file_parts = pathinfo($newPicture);
                //
                //switch($file_parts["extension"])
                //{
                //    case "jpg":
                //        break;
                //    case "JPG":
                //        break;
                //    case "png":
                //        break;
                //    case "PNG":
                //        break;
                //    default:
                //        throw(new Exception("invalid image format"));
                //}
                $this->picture = $newPicture;
        }
        public function setTravel($newTravel)
        {
                //makes sure that this is an integer
                 if(is_numeric($newTravel) === false)
                {
                        throw(new Exception("Invalid travel  detected: $newTravel"));
                }
                // convert to an integer
                $newUserId = intval($newTravel);
                // trims the whie space
                $newTravel = trim($newTravel);
                
                $this->travel = $newTravel;
        }
        public function setRate($newRate)
        {	// throw out leading and trailing spaces  (sanitization1)
                $newRate = trim($newRate);
                // throw out obviously bad IDs (sanitization2)
                if(is_numeric($newRate) === false)
                {
                        throw(new Exception("Invalid user id detected: $newRate is not numeric"));
                }
                // make sure there are at least two trailing digits(sanitization3)
                $newRate = number_format((float)$newRate, 2, '.', '');
                // convert the ID to a double (sanitization4)
                $newRate = floatval($newRate);
                // Round trailing digits so there are ONLY two (sanitization5)
                $newRate = round($newRate, 2);
                // throw out bad prices by testing against regular expression (sanitization6)
                $regex = "/^[\d]{1,4}(\.[\d]{2})?$/";
                if(preg_match($regex, $newRate) !== 1)
                {
                        var_dump($newRate);
                        throw(new Exception("Invalid cost detected: $newRate, failed RegEx test."));
                }
                // sanitized, assign the value
                $this->rate = $newRate;
        }
    // mySQL mutator methods
        
        /* inserts a new object into mySQL
        * input: (pointer) mySQL connection, by reference
        * output: n/a
        * throws: if the object could not be inserted */
        public function insert(&$mysqli)
        {
                // handle degenerate cases
                if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
                {
                        throw(new Exception("Non mySQL pointer detected."));
                }
                
                // verify the id is -1 (i.e., a new user)
                if($this->id !== -1)
                {
                        throw(new Exception("Non new id detected."));
                }
                
                // a create a query template
                $query = "INSERT INTO profile (userId, firstName, lastName, birthday, picture, travel, rate) VALUES(?, ?, ?, ?, ?, ?, ?)";
                
                // prepare the query statement
                $statement = $mysqli->prepare($query);
                if($statement === false)
                {
                        throw(new Exception("Unable to prepare the statement."));
                }
                
                // bind parameters to the query template
                $wasClean = $statement->bind_param("issssid", $this->userId, $this->firstName, $this->lastName, $this->birthday, $this->picture, $this->travel, $this->rate);
                if($wasClean === false)
                {
                        throw(new Exception("Unable to bind paramenters."));
                }
                
                // ok, let's rock!
                if($statement->execute() === false)
                {
                        throw(new Exception("Unable to execute the statement."));
                }
                
                $statement->close();
                
                // trash the statement and create another
                $statement = null;
                $query = "SELECT id FROM profile WHERE userId = ?";
                $statement = $mysqli->prepare($query);
                if($statement === false)
                {
                        throw(new Exception("Unable to prepare the statement."));
                }
                
                // bind the query
                $wasClean = $statement->bind_param("i", $this->userId);
                if($wasClean === false)
                {
                        throw(new Exception("Unable to bind paramenters."));
                }
                
                // ok, let's rock!
                if($statement->execute() === false)
                {
                        throw(new Exception("Unable to execute the statement."));
                }
                
                // get the result and make sure only 1 row is deleted
                $result = $statement->get_result();
                if($result === false || $result->num_rows !== 1)
                {
                        throw(new Exception("Unable to determine user id: invalid result set"));
                }
                
                // get the row and set the id
                $row = $result->fetch_assoc();
                $newId = $row["id"];
                try
                {
                        $this->setId($newId);
                }
                catch(Exception $exception)
                {
                        throw(new Exception("Unable to determine user id", 0, $exception));
                }
                
                $statement->close();
                
        }
        /* function to delete
		 * input: (pointer) mySQL connection, by reference
		 * output: N/A
		 * throws: if the object could not be deleted */
		public function delete(&$mysqli)
		{
			// check for a good mySQL pointer
			if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
			{
				throw(new Exception("Non mySQL pointer detected."));
			}
			
			// verify the id is not -1 (which would be a new user)
			if($this->id === -1)
			{
				throw(new Exception("New id detected"));
			}
			
			// create the query template
			$query = "DELETE FROM profile WHERE id = ?";
			
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement."));
			}
			
			// bind parameters to the query template
			$wasClean = $statement->bind_param("i", $this->id);
			if($wasClean === false)
			{
				throw(new Exception("Unable to bind paramenters."));
			}
			
			// ok, let's rock!
			if($statement->execute() === false)
			{
				throw(new Exception("Unable to execute the statement."));
			}
			
			$statement->close();
			
		}
		/* update function
		 * input: (pointer) mysql connection
		 * output: n/a
		 * throws: when the object was not updated */
		public function update(&$mysqli)
		{
			// check for a good mySQL pointer
			if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
			{
				throw(new Exception("Non mySQL pointer detected."));
			}
			
			// verify the id is not -1 (which would be a new user)
			if($this->id === -1)
			{
				throw(new Exception("New id detected"));
			}
			
			// create the query template
			$query = "UPDATE profile SET firstName = ?, lastName = ?, birthday = ?, picture = ?, travel = ?, rate = ? WHERE id = ?";
			
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement."));
			}
			
			// bind parameters to the query template
			$wasClean = $statement->bind_param("sssssdi", $this->firstName, $this->lastName, $this->birthday, $this->picture, $this->travel, $this->rate,$this->id);
			if($wasClean === false)
			{
				throw(new Exception("Unable to bind paramenters."));
			}
			
			// ok, let's rock!
			if($statement->execute() === false)
			{
				throw(new Exception("Unable to execute the statement."));
			}
			
			$statement->close();
		}
		//static methods
		
		/* static method to get user by email
		 * input: (pointer) to mysql
		 * input: (string) email to search by
		 * output: (object) user */
		public static function getProfileByUserId(&$mysqli, $userId)
		{
			// check for a good mySQL pointer
			if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
			{
				throw(new Exception("Non mySQL pointer detected."));
			}
			
			// create the query template
			$query = "SELECT id, userId, firstName, lastName, birthday, picture, travel, rate FROM profile WHERE userId = ?";
			
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement."));
			}
			
			// bind parameters to the query template
			$wasClean = $statement->bind_param("i", $userId);
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
				throw(new Exception("Unable to determine user: id not found."));
			}
			
			// get the row and set the id
			$row = $result->fetch_assoc();
			$profile = new Profile($row["id"], $row["userId"], $row["firstName"], $row["lastName"], $row["birthday"], $row["picture"], $row["travel"], $row["rate"]);
			
			$statement->close();
			
			return($profile);
		}
		
        /* static method to get user by id
		 * input: (pointer) to mysql
		 * input: (string) id to search by
		 * output: (object) user */
		public static function getProfileById(&$mysqli, $id)
		{
			// check for a good mySQL pointer
			if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
			{
				throw(new Exception("Non mySQL pointer detected."));
			}
			
			// create the query template
			$query = "SELECT id, userId, firstName, lastName, birthday, picture, travel, rate FROM profile WHERE id = ?";
			
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
			
			// get the result and make a new object
			$result = $statement->get_result();
			if($result === false || $result->num_rows !== 1)
			{
				throw(new Exception("Unable to determine user: id not found."));
			}
			
			// get the row and set the id
			$row = $result->fetch_assoc();
			$profile = new Profile($row["id"], $row["userId"], $row["firstName"], $row["lastName"], $row["birthday"], $row["picture"], $row["travel"], $row["rate"]);
			
			$statement->close();
			
			return($profile);
		}
                
    }
   ?>