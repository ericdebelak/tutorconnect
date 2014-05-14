<?php
    class Job
    {
        // state variable
		private $id;
        private $userId;
        private $title;
        private $details;
        
        /* constructor for job
         * input: (integer) new id (auto incremented)
         * input: (integer) user id of tutor
         * input: (string) title of job
         * input: (string) details of job (description)
         * throws: when invalid input detected
         */
        public function __construct($newId, $newUserId, $newTitle, $newDetails)
        {
            try
            {
                $this->setId($newId);
                $this->setUserId($newUserId);
                $this->setTitle($newTitle);
                $this->setDetails($newDetails);
            }
            catch(Exception $exception)
            {	// rethrow exception
                throw(new Exception("Unable to build job. Uh oh!"));
            }
        }
/**************** GETTER METHODS ****************//**************** GETTER METHODS ****************/
        /* getter method for id
         * input: N/A
         * output: (int) value of id */
        public function getId()
        {
            return($this->id);
        }
        /* getter method for userId
         * input: N/A
         * output: (int) value of userId */
        public function getUserId()
        {
            return($this->userId);
        }
        /* getter method for title
         * input: N/A
         * output: (string) value of title */
        public function getTitle()
        {
            return($this->title);
        }
        /* getter method for details
         * input: N/A
         * output: (string) value of details */
        public function getDetails()
        {
            return($this->details);
        }
/**************** SETTER METHODS ****************//**************** SETTER METHODS ****************/
        /* setter method for id
         * input: (int) new value of id
         * output: N/A */
        public function setId($newId)
        {	// make sure it is numeric
            if(is_numeric($newId) === false)
            {
                throw(new Exception("Invalid id detected: $newId is not numeric"));
            }
            // convert the id to an integer
            $newId = intval($newId);
            // throw out negative ids except -1, which is our placeholder for new job
            if($newId < -1)
            {
                throw(new Exception("Invalid id detected: $newId is less than negative 1!"));
            }
            $this->id = $newId;
        }
        /* setter method for userId
         * input: (int) new value of userId
         * output: N/A */
        public function setUserId($newUserId)
        {	// make sure it is numeric
            if(is_numeric($newUserId) === false)
            {
                throw(new Exception("Invalid id detected: $newUserId is not numeric"));
            }
            // convert the id to an integer
            $newUserId = intval($newUserId);
            // throw out negative ids
            if($newUserId < 0)
            {
                throw(new Exception("Invalid id detected: $newUserId is a negative number!"));
            }
            $this->userId = $newUserId;
        }
		/* setter method for title
         * input: (string) new value of title
         * output: N/A */
        public function setTitle($newTitle)
        {	// prevent scripting attacks
            $newTitle = htmlspecialchars($newTitle);
            $this->title = $newTitle;
        }
		/* setter method for details
         * input: new value of details
         * output: N/A */
        public function setDetails ($newDetails)
        {	// prevent scripting attacks
            $newDetails = htmlspecialchars($newDetails);
            
            $this->details = $newDetails;
        }
/**************** MYSQLi METHODS ****************//**************** MYSQLi METHODS ****************/
    
        /* function inserts a new object into mySQL
         * input: (pointer) mySQL connection, by reference
         * output: N/A
         * throws if the object could not be inserted
         */
        public function insert(&$mysqli)
        {	// handle degenerate cases
            if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
            {
                throw(new Exception("Non mySQL pointer detected when handling degenerate cases, WTF?"));
            }
            // verify the id is -1 (i.e., a new job)
            if($this->id !== -1)
            {
                throw(new Exception("Non new id detected. ID for insert was not negative 1!"));
            }
            // a create a query template
            $query = "INSERT INTO job (id, userId, title, details) VALUES(?, ?, ?, ?)";
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare the statement. The syntax is wrong somewhere."));
            }
            // bind parameters to the query template
            $wasClean = $statement->bind_param("iiss", $this->id, $this->userId, $this->title, $this->details);
            if($wasClean === false)
            {
                throw(new Exception("Unable to bind parameters. One or more must not follow the query or bind type"));
            }
            // execute the statement on the server
            if($statement->execute() === false)
            {
                throw(new Exception("Unable to execute the statement. Perhaps you have a duplicate, or invalid type, or bad syntax, or something else I didn't think of!"));
            }
            $statement->close();
            // reassign the id, grabbing the auto-incremented one from mySQL
            try
            {	//set id to the auto generated id used in the last query see (http://www.php.net/manual/en/mysqli.insert-id.php) for details
                $this->setId($mysqli->insert_id);
            }
            catch(Exception $exception)
            {
                throw(new Exception("Unable to determine job id!", 0, $exception));
            }
        }
        /* function to delete
         * input: (pointer) mySQL connection, by reference
         * output: N/A
         * throws: if the object could not be deleted */
        public function delete(&$mysqli)
        {	// handle degenerate cases
            if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
            {
                throw(new Exception("Non mySQL pointer detected when handling degenerate cases, WTF?"));
            }
            // verify the id is not -1 (which would be a new user, why would it be deleted before being inserted?)
            if($this->id === -1)
            {
                throw(new Exception("New id detected"));
            }
            // create the query template
            $query = "DELETE FROM job WHERE id = ?";
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare the statement. The syntax is wrong somewhere."));
            }
            // bind parameters to the query template
            $wasClean = $statement->bind_param("i", $this->id);
            if($wasClean === false)
            {
                throw(new Exception("Unable to bind parameters. One or more must not follow the query or bind type"));
            }
            // execute the statement on the database
            if($statement->execute() === false)
            {
                throw(new Exception("unable to execute the statement. Perhaps you have a duplicate, or invalid type, or bad syntax, or something else I didn't think of!"));
            }
            $statement->close();
        }
        /* update function
         * input: (pointer) mysqli connection
         * output: n/a
         * throws: when the object did not update */
        public function update(&$mysqli)
        {	// handle degenerate cases
            if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
            {
                throw(new Exception("Non mySQL pointer detected when handling degenerate cases, WTF?"));
            }
            // verify the id is not -1 (which would be a new user, why would you update before insert?)
            if($this->id === -1)
            {
                throw(new Exception("New id detected"));
            }
            // create the query template
            $query = "UPDATE job SET userId = ?, title = ?, details = ? WHERE id = ?";
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare the statement. The syntax is wrong somewhere."));
            }
            // bind parameters to the query template
            $wasClean = $statement->bind_param("issi", $this->userId, $this->title, $this->details, $this->id);
            if($wasClean === false)
            {
                throw(new Exception("Unable to bind parameters. One or more must not follow the query or bind type"));
            }
            // execute the statement on the database
            if($statement->execute() === false)
            {
                throw(new Exception("unable to execute the statement. Perhaps you have a duplicate, or invalid type, or bad syntax, or something else I didn't think of!"));
            }
            $statement->close();
        }
        
// *****************************************************Static Methods**************************************************

        /* static method to get job by userId
        * input: (pointer) to mysql
        * input: (integer) userId
        * output: (object) job
        * throws if not found*/
        public static function getJobsByUserId(&$mysqli, $userId)
        {	// handle degenerate cases
            if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
            {
                throw(new Exception("Non mySQL pointer detected when handling degenerate cases, WTF?"));
            }
            // create the query template
            $query = "SELECT id, userId, title, details FROM job WHERE userId = ?";
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare the statement. The syntax is wrong somewhere."));
            }
            // bind parameters to the query template
            $wasClean = $statement->bind_param("i", $userId);
            if($wasClean === false)
            {
                throw(new Exception("Unable to bind parameters. One or more must not follow the query or bind type"));
            }
            // execute the statement on the database
            if($statement->execute() === false)
            {
                throw(new Exception("unable to execute the statement. Perhaps you have a duplicate, or invalid type, or bad syntax, or something else I didn't think of!"));
            }
            // get the result and make a new object
            $result = $statement->get_result();
            if($result === false || $result->num_rows < 1)
            {
                throw(new Exception("Unable to find user."));
            }
            // get the rows
            $jobs = array();
            while($row = $result->fetch_assoc())
            {	// get the row and set the id
                $job[] = new Job($row["id"], $row["userId"], $row["title"], $row["details"]);
            }
            $statement->close();
            return($job);
        }
    }
?>