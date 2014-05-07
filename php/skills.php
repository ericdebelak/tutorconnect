<?php
    class Experience
    {
        // state variable
        private $id;
        private $userId;
        private $experience;
        private $description;
        
        /* constructor for the skill
         * function construct
         * input: (integer) new id
         * input: (integer) new user id
         * input: (string) new experience
         * input: (string) new description
         * throws: when invalid input detected
         */
        public function __construct($newId, $newUserId, $newExperience, $newDescription)
        {
            try
            {
                $this->setId($newId);
                $this->setUserId($newUserId);
                $this->setExperience($newExperience);
                $this->setDescription($newDescription);
                
            }
            catch(Exception $exception)
            {
                // rethrow exception
                throw(new Exception("Unable to build experience"));
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
            
            // throw out negative ids except -1, which is our placeholder for new experiences
            if($newId < -1)
            {
                throw(new Exception("Invalid id detected: $newId"));
            }
            
            $this->id = $newId;
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
            
            // throw out negative ids
            if($newUserId < 0)
            {
                throw(new Exception("Invalid id detected: $newUserId"));
            }
            
            $this->userId = $newUserId;
        }
    
        /* accessor method for experience
         * input: N/A
         * output: value of experience */
        public function getExperience()
        {
            return($this->experience);
        }
    
        /* mutator method for experience
         * input: new value of experience
         * output: N/A */
        public function setExperience($newExperience)
        {
            // prevent cross-site scripting
            $newExperience = htmlspecialchars($newExperience);
            
            $this->experience = $newExperience;
        }
    
        /* accessor method for description
         * input: N/A
         * output: value of description */
        public function getDescription()
        {
            return($this->description);
        }
    
        /* mutator method for description
         * input: new value of description
         * output: N/A */
        public function setDescription($newDescription)
        {
            // prevent cross site scripting
            $newDescription = htmlspecialchars($newDescription);
            
            $this->description = $newDescription;
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
            
            // verify the id is -1 (i.e., a new experience)
            if($this->id !== -1)
            {
                throw(new Exception("Non new id detected."));
            }
            
            // a create a query template
            $query = "INSERT INTO experience (id, userId, experience, description) VALUES(?, ?, ?, ?)";
            
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare the statement."));
            }
            
            // bind parameters to the query template
            $wasClean = $statement->bind_param("iiss", $this->id, $this->userId, $this->experience, $this->description);
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
                throw(new Exception("Unable to determine experience id", 0, $exception));
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
            $query = "DELETE FROM experience WHERE id = ?";
            
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
            $query = "UPDATE experience SET userId = ?, description = ?, experience = ? WHERE id = ?";
            
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare statement."));
            }
            
            // bind parameters to the query template
            $wasClean = $statement->bind_param("issi", $this->userId, $this->description, $this->experience, $this->id);
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

        /* static method to get experience by user id
        * input: (pointer) to mysql
        * input: (integer) user id
        * output: (object) experience
        * throws if not found*/
        public static function getExperienceByUserId(&$mysqli, $userId)
        {
            // check for a good mySQL pointer
            if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
            {
                throw(new Exception("Non mySQL pointer detected."));
            }
            
            // create the query template
            $query = "SELECT id, userId, experience, description FROM experience WHERE userId = ?";
            
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
            if($result === false || $result->num_rows < 1)
            {
                throw(new Exception("Unable to find user."));
            }
            
            // get the rows
            $experience = array();
            while($row = $result->fetch_assoc())
            {
                // get the row and set the id
                $experience[] = new Experience($row["id"], $row["userId"], $row["experience"], $row["description"]);
            }
            $statement->close();
            return($experience);
        }
        
        /* static method to get experience by skill
        * input: (pointer) to mysql
        * input: (integer) experience
        * output: (object) experience
        * throws if not found*/
        public static function getExperienceBySkill(&$mysqli, $skill)
        {
            // check for a good mySQL pointer
            if(is_object($mysqli) === false || get_class($mysqli) !== "mysqli")
            {
                throw(new Exception("Non mySQL pointer detected."));
            }
            
            // create the query template
            $query = "SELECT id, userId, experience, description FROM experience WHERE experience = ?";
            
            // prepare the query statement
            $statement = $mysqli->prepare($query);
            if($statement === false)
            {
                throw(new Exception("Unable to prepare statement."));
            }
            
            // bind parameters to the query template
            $wasClean = $statement->bind_param("s", $skill);
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
                throw(new Exception("Unable to find experience."));
            }
            
            // get the rows
            $experience = array();
            while($row = $result->fetch_assoc())
            {
                // get the row and set the id
                $experience[] = new Experience($row["id"], $row["userId"], $row["experience"], $row["description"]);
            }
            $statement->close();
            return($experience);
        }
    
    }
?>