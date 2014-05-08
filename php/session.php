<?php
    class Session
    {
        // state variable
        private $id;
        private $studentId;
        private $tutorId;
        private $studentLog;
        private $studentNextSteps;
        private $tutorLog;
        private $tutorNextSteps;
        private $date;
        
        /* constructor for the session
         * function construct
         * input: (integer) new id
         * input: (integer) new student id
         * input: (integer) new tutor id
         * input: (string) new student log
         * input: (string) new student next steps
         * input: (string) new tutor log
         * input: (string) new tutor next steps
         * throws: when invalid input detected
         */
        public function __construct($newId, $newTutorId, $newStudentId, $newTutorLog, $newTutorNextSteps, $newStudentLog, $newStudentNextSteps, $newDate)
        {
            try
            {
                $this->setId($newId);
                $this->setStudentId($newStudentId);
                $this->setTutorId($newTutorId);
                $this->setStudentLog($newStudentLog);
                $this->setStudentNextSteps($newStudentNextSteps);
                $this->setTutorLog($newTutorLog);
                $this->setTutorNextSteps($newTutorNextSteps);
                $this->setDate($newDate);
                
            }
            catch(Exception $exception)
            {
                // rethrow exception
                throw(new Exception("Unable to build session"));
            }
        }

        /* accessor method for id
         * input: N/A
         * output: value of id */
        public function getId()
        {
            return($this->id);
        }
    
        /* mutator method for id
         * input: new value of id
         * output: N/A */
        public function setId($newId)
        {
            // make sure it is numeric
            if(is_numeric($newId) === false)
            {
                throw(new Exception("Invalid id detected: $newId"));
            }
            
            // convert the id to an integer
            $newId = intval($newId);
            
            // throw out negative ids except -1, which is our placeholder for new sessions
            if($newId < -1)
            {
                throw(new Exception("Invalid id detected: $newId"));
            }
            
            $this->id = $newId;
        }
    
        /* accessor method for studentId
         * input: N/A
         * output: value of studentId */
        public function getStudentId()
        {
            return($this->studentId);
        }
    
        /* mutator method for studentId
         * input: new value of studentId
         * output: N/A */
        public function setStudentId($newStudentId)
        {
            // make sure it is numeric
            if(is_numeric($newStudentId) === false)
            {
                    throw(new Exception("Invalid id detected: $newStudentId"));
            }
            
            // convert the id to an integer
            $newStudentId = intval($newStudentId);
            
            // throw out negative ids
            if($newStudentId < 0)
            {
                    throw(new Exception("Invalid id detected: $newStudentId"));
            }
            
            $this->studentId = $newStudentId;
        }
    
        /* accessor method for tutorId
         * input: N/A
         * output: value of tutorId */
        public function getTutorId()
        {
            return($this->tutorId);
        }
    
        /* mutator method for tutorId
         * input: new value of tutorId
         * output: N/A */
        public function setTutorId($newTutorId)
        {
            // make sure it is numeric
            if(is_numeric($newTutorId) === false)
            {
                    throw(new Exception("Invalid id detected: $newTutorId"));
            }
            
            // convert the id to an integer
            $newTutorId = intval($newTutorId);
            
            // throw out negative ids
            if($newTutorId < 0)
            {
                    throw(new Exception("Invalid id detected: $newTutorId"));
            }
            
            $this->tutorId = $newTutorId;
        }
    
        /* accessor method for studentLog
         * input: N/A
         * output: value of studentLog */
        public function getStudentLog()
        {
            return($this->studentLog);
        }
    
        /* mutator method for studentLog
         * input: new value of studentLog
         * output: N/A */
        public function setStudentLog($newStudentLog)
        {
            // strip out html tags
            $newStudentLog  = htmlspecialchars($newStudentLog);
            
            $this->studentLog = $newStudentLog;
        }
    
        /* accessor method for studentNextSteps
         * input: N/A
         * output: value of studentNextSteps */
        public function getStudentNextSteps()
        {
            return($this->studentNextSteps);
        }
    
        /* mutator method for studentNextSteps
         * input: new value of studentNextSteps
         * output: N/A */
        public function setStudentNextSteps($newStudentNextSteps)
        {
            // strip out html tags
            $newStudentNextSteps  = htmlspecialchars($newStudentNextSteps);
            
            $this->studentNextSteps = $newStudentNextSteps;
        }
    
        /* accessor method for tutorLog
         * input: N/A
         * output: value of tutorLog */
        public function getTutorLog()
        {
            return($this->tutorLog);
        }
    
        /* mutator method for tutorLog
         * input: new value of tutorLog
         * output: N/A */
        public function setTutorLog($newTutorLog)
        {
            // strip out html tags
            $newTutorLog  = htmlspecialchars($newTutorLog);
            
            $this->tutorLog = $newTutorLog;
        }
    
        /* accessor method for tutorNextSteps
         * input: N/A
         * output: value of tutorNextSteps */
        public function getTutorNextSteps()
        {
            return($this->tutorNextSteps);
        }
    
        /* mutator method for tutorNextSteps
         * input: new value of tutorNextSteps
         * output: N/A */
        public function setTutorNextSteps($newTutorNextSteps)
        {
            // strip out html tags
            $newTutorNextSteps  = htmlspecialchars($newTutorNextSteps);
            
            $this->tutorNextSteps = $newTutorNextSteps;
        }
        
        /* accessor method for date
         * input: N/A
         * output: value of date */
        public function getDate()
        {
            return($this->date);
        }
    
        /* mutator method for date
         * input: new value of date
         * output: N/A */
        public function setDate($newDate)
        {
            $regexp = "/^(20[\d]{2})-(0[1-9]|1[0-2])-(0[1-9]|[1-2][\d]|3[01])$/";
            if(preg_match($regexp, $newDate) !== 1)
            {
                    throw(new Exception("Invalid time detected: $newDate"));
            }
            
            $this->date = $newDate;
        }
        
// **********************************************mySQL mutator methods**************************************************
    
        /* insert a new object into mySQL
         * function insert
         * input: (pointer) mySQL connection, by reference
         * output: N/A
         * throws if the object could not be inserted
         */
        
        public function insert(&$mysqli)
        {
            // handle degenerate cases
            if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
            {
                throw(new Exception("Non mySQL pointer detected."));
            }
            
            // verify the id is -1 (i.e., a new session)
            if($this->id !== -1)
            {
                throw(new Exception("Non new id detected."));
            }
            
            // a create a query template
            $query = "INSERT INTO session (id, tutorId, studentId, tutorLog, tutorNextSteps, studentLog, studentNextSteps, date) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare the statement."));
            }
            
            // bind parameters to the query template
            $wasClean = $statement->bind_param("iiisssss", $this->id, $this->tutorId, $this->studentId, $this->tutorLog, $this->tutorNextSteps, $this->studentLog, $this->studentNextSteps, $this->date);
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
            
            // reassign the id, grabbing it from mySQL
            try
            {
                $this->setId($mysqli->insert_id);
            }
            catch(Exception $exception)
            {
                throw(new Exception("Unable to determine session id", 0, $exception));
            }
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
            $query = "DELETE FROM session WHERE id = ?";
            
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
            $query = "UPDATE session SET tutorId = ?, studentId = ?, tutorLog = ?, tutorNextSteps = ?, studentLog = ?, studentNextSteps = ?, date = ? WHERE id = ?";
            
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare statement."));
            }
            
            // bind parameters to the query template
            $wasClean = $statement->bind_param("iisssssi", $this->tutorId, $this->studentId, $this->tutorLog, $this->tutorNextSteps, $this->studentLog, $this->studentNextSteps, $this->date, $this->id);
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
    
    
// *****************************************************Static Methods**************************************************

        /* static method to get session by tutor id, student id, and date
        * input: (pointer) to mysql
        * input: (integer) tutor id
        * input: (integer) student id
        * input: (string) date
        * output: (object) session
        * throws if not found */
        public static function getSessionByTutorIdStudentIdDate(&$mysqli, $tutorId, $studentId, $date)
        {
            // check for a good mySQL pointer
            if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
            {
                throw(new Exception("Non mySQL pointer detected."));
            }
            
            // create the query template
            $query = "SELECT id, tutorId, studentId, tutorLog, tutorNextSteps, studentLog, studentNextSteps, date FROM session WHERE tutorId = ? AND studentId = ? AND date = ?";
            
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare statement."));
            }
            
            // bind parameters to the query template
            $wasClean = $statement->bind_param("iis", $tutorId, $studentId, $date);
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
                throw(new Exception("Unable to find session."));
            }
            
            // get the row and create the object
            $row = $result->fetch_assoc();
            $session = new Session($row["id"], $row["tutorId"], $row["studentId"], $row["tutorLog"], $row["tutorNextSteps"], $row["studentLog"], $row["studentNextSteps"], $row["date"]);
            return($session);
            
            $statement->close();
        }
        
        /* static method to get session by tutor id, student id
        * input: (pointer) to mysql
        * input: (integer) tutor id
        * input: (integer) student id
        * output: (array of object) session
        * throws if not found*/
        public static function getSessionByTutorIdStudentId(&$mysqli, $tutorId, $studentId)
        {
            // check for a good mySQL pointer
            if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
            {
                throw(new Exception("Non mySQL pointer detected."));
            }
            
            // create the query template
            $query = "SELECT id, tutorId, studentId, tutorLog, tutorNextSteps, studentLog, studentNextSteps, date FROM session WHERE tutorId = ? AND studentId = ?";
            
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare statement."));
            }
            
            // bind parameters to the query template
            $wasClean = $statement->bind_param("ii", $tutorId, $studentId);
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
            if($result === false || $result->num_rows < 1)
            {
                throw(new Exception("Unable to find sessions."));
            }
            
            // get the rows
            $session = array();
            while($row = $result->fetch_assoc())
            {
                // get the rows and push to array
                $session[] = new Session($row["id"], $row["tutorId"], $row["studentId"], $row["tutorLog"], $row["tutorNextSteps"], $row["studentLog"], $row["studentNextSteps"], $row["date"]);
            }
            $statement->close();
            return($session);
        }
        
        /* static method to get session by tutor id
        * input: (pointer) to mysql
        * input: (integer) tutor id
        * output: (array of objects) session
        * throws if not found*/
        public static function getSessionByTutorId(&$mysqli, $tutorId)
        {
            // check for a good mySQL pointer
            if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
            {
                throw(new Exception("Non mySQL pointer detected."));
            }
            
            // create the query template
            $query = "SELECT id, tutorId, studentId, tutorLog, tutorNextSteps, studentLog, studentNextSteps, date FROM session WHERE tutorId = ?";
            
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare statement."));
            }
            
            // bind parameters to the query template
            $wasClean = $statement->bind_param("i", $tutorId);
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
            if($result === false || $result->num_rows < 1)
            {
                throw(new Exception("Unable to find sessions."));
            }
            
            // get the rows
            $session = array();
            while($row = $result->fetch_assoc())
            {
                // get the rows and push the arrays
                $session[] = new Session($row["id"], $row["tutorId"], $row["studentId"], $row["tutorLog"], $row["tutorNextSteps"], $row["studentLog"], $row["studentNextSteps"], $row["date"]);
            }
            $statement->close();
            return($session);
        }
        
        /* static method to get session by student id
        * input: (pointer) to mysql
        * input: (integer) student id
        * output: (array of object) session
        * throws if not found*/
        public static function getSessionByStudentId(&$mysqli, $studentId)
        {
            // check for a good mySQL pointer
            if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
            {
                throw(new Exception("Non mySQL pointer detected."));
            }
            
            // create the query template
            $query = "SELECT id, tutorId, studentId, tutorLog, tutorNextSteps, studentLog, studentNextSteps, date FROM session WHERE studentId = ?";
            
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare statement."));
            }
            
            // bind parameters to the query template
            $wasClean = $statement->bind_param("i", $studentId);
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
            if($result === false || $result->num_rows < 1)
            {
                throw(new Exception("Unable to find sessions."));
            }
            
            // get the rows
            $session = array();
            while($row = $result->fetch_assoc())
            {
                // get the rows and push to array
                $session[] = new Session($row["id"], $row["tutorId"], $row["studentId"], $row["tutorLog"], $row["tutorNextSteps"], $row["studentLog"], $row["studentNextSteps"], $row["date"]);
            }
            $statement->close();
            return($session);
        }
        
        /* static method to get session by id
        * input: (pointer) to mysql
        * input: (integer) student id
        * output: (object) session
        * throws if not found*/
        public static function getSessionBySessionId(&$mysqli, $sessionId)
        {
            // check for a good mySQL pointer
            if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
            {
                throw(new Exception("Non mySQL pointer detected."));
            }
            
            // create the query template
            $query = "SELECT id, tutorId, studentId, tutorLog, tutorNextSteps, studentLog, studentNextSteps, date FROM session WHERE id = ?";
            
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare statement."));
            }
            
            // bind parameters to the query template
            $wasClean = $statement->bind_param("i", $sessionId);
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
                throw(new Exception("Unable to find sessions."));
            }
            
            // get the row
            $row = $result->fetch_assoc();
            $session = new Session($row["id"], $row["tutorId"], $row["studentId"], $row["tutorLog"], $row["tutorNextSteps"], $row["studentLog"], $row["studentNextSteps"], $row["date"]);
            
            $statement->close();
            return($session);
        }
    }
?>