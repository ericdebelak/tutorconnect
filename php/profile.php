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
        private $hobby;
        private $rate;
/* constructor for a Profile object
        * input: (integer) new Id
        * input: (integer) new userId
        * input: (string) new first name
        * input: (string) new last name
        * input: (integer) new picture
        * input: (integer) new travel
        * input: (text) new hobby
        * input: (decimal) new rate */
        public function __construct($newId, $newUserId, $newFirstName, $newLastName, $newBirthday, $newPicture, $newTravel, $newHobby, $newRate)
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
                $this->setHobby($newHobby);
                $this->setRate($newRate);
            }
            catch(Exception $exception)
            {
                //rethrow the exception to the caller
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
        public function getHobby()
        {
                return($this->hobby);
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
                // gets file size and throws if > 200kb
                if(filesize($filename) > 204800)
                {
                        throw(new Exception("File size can not be greater than 200kb"));
                }
                           
                //breaks the file into parts
                $file_parts = pathinfo($filename);
                
                switch($file_parts["extension"])
                {
                    case "jpg":
                        break;
                    case "JPG":
                        break;
                    case "png":
                        break;
                    case "PNG":
                        break;
                    default:
                        throw(new Exception("invalid image format"));
                }
                $this->picture = $newPicture;
        }
        public function setTravel($newTravel)
        {
                //makes sure that this is an integer
                 if(is_numeric($newUserId) === false)
                {
                        throw(new Exception("Invalid user id detected: $newUserId"));
                }
                // convert to an integer
                $newUserId = intval($newUserId);
                // trims the whie space
                $newTravel = trim($newTravel);
                
                $this->travel = newTravel;
        }
        public function setHobby($newHobby)
        public function setSpecialNeeds ($specialNeeds)
        {	// SPECIAL NEEDS IS AN INT
                // trim just in case something got passed in with spaces (sanitization1)
                $specialNeeds = trim($specialNeeds);
                if(is_numeric($specialNeeds) == false) //(sanitization2)
                {
                        throw(new Exception("Invalid special needs detected: $specialNeeds"));
                } 
                // convert the data to an integer (sanitization3)
                $specialNeeds = intval($specialNeeds);
                // throw out numbers that aren't 0 or 1(sanitization4)
                if($specialNeeds > 1 || $specialNeeds < 0)
                {
                        throw(new Exception("Invalid specialNeeds detected: $specialNeeds"));
                }
                // now that the data is clean-ish (haven't checked it against database) assign the new UserId
                $this->specialNeeds = $specialNeeds;
    }

    
    
    
    
    
    
    
    
    
?>