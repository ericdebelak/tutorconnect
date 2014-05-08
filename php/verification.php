<?php
    class Verify
    {
        private $userId;
        private $verificationCode;
        
        /* constructor for the session
         * function construct
         * input: (integer) user id
         * input: (integer) verification code
         * throws: when invalid input detected
         */
        public function __construct($userId, $verificationCode)
        {
            try
            {
                $this->setUserId($userId);
                $this->setVerificationCode($verificationCode);
            }
            catch(Exception $exception)
            {
                // rethrow exception
                throw(new Exception("Unable to build verification code"));
            }
        }

        /* accessor method for userId
         * input: N/A
         * output: value of userId */
        public function getUserId()
        {
            return($this->userId);
        }
    
        /* mutator method for userId
         * input: new value of userId
         * output: N/A */
        public function setUserId($newUserId)
        {
            // make sure it is numeric
            if(is_numeric($newUserId) === false)
            {
                throw(new Exception("Invalid id detected: $newUserId"));
            }
            
            // convert the id to an integer
            $newUserId = intval($newUserId);
            
            // throw out negative ids except -1, which is our placeholder for new experiences
            if($newUserId < -1)
            {
                throw(new Exception("Invalid id detected: $newUserId"));
            }
            
            $this->userId = $newUserId;
        }
    
        /* accessor method for verificationCode
         * input: N/A
         * output: value of verificationCode */
        public function getVerificationCode()
        {
            return($this->verificationCode);
        }
    
        /* mutator method for verificationCode
         * input: new value of verificationCode
         * output: N/A */
        public function setVerificationCode($newVerificationCode)
        {
            $regexp = "/^[a-f\d]{32}$/";
            if(preg_match($regexp, $newVerificationCode) === false)
            {
                throw(new Exception("Invalid verification code detected: $newVerificationCode"));
            }
            
            $this->verificationCode = $newVerificationCode;
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
            
            // a create a query template
            $query = "INSERT INTO verification (userId, code) VALUES(?, ?)";
            
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare the statement."));
            }
            
            // bind parameters to the query template
            $wasClean = $statement->bind_param("is", $this->userId, $this->verificationCode);
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
            
            // create the query template
            $query = "DELETE FROM verification WHERE userId = ?";
            
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare statement."));
            }
            
            // bind parameters to the query template
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
            
            // create the query template
            $query = "UPDATE verification SET userId = ?, code = ? WHERE userId = ?";
            
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare statement."));
            }
            
            // bind parameters to the query template
            $wasClean = $statement->bind_param("is", $this->userId, $this->verificationCode, $this->userId);
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
    }
?>