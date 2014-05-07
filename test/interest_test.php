<?php
	// grab the unit test framework
	require_once("/usr/lib/php5/simpletest/autorun.php");
	
	// grab the functions under scrutiny
	require_once("../php/interest.php");
        
        // grab the config file
        require_once("/home/bradg/tutorconnect/config.php");
	
	class HobbyTest extends UnitTestCase
	{
            private $mysqli = null;
            
            // variable to hold the mysql user
            private $sqlInterest;
            private $interest;
            
            // constant variables to reuse
            private $id;
            private $userId = 7;
            private $skill = "JavaScript";
            private $description = "Loads of interest";
            
            public function setUp()
            {
                try
                {
                    if($this->mysqli === null)
                    {
                        $this->mysqli = Pointer::getMysqli();
                    }
                    $this->interest = new Interest (-1, $this->userId, $this->skill, $this->description);			
                    $this->interest->insert($this->mysqli);
                }
                catch(mysqli_sql_exception $exception)
                {
                        echo "Unable to connect to mySQL: " . $exception->getMessage();
                }
            }
            
            public function testgetInterestByUserId()
            {
                    $this->sqlInterest = Interest::getInterestByUserId($this->mysqli, $this->userId);
                    $this->assertIdentical($this->interest, $this->sqlInterest[0]);
            }
            
            public function testgetInterestByUserIdInvalid()
            {
                    $this->expectException("Exception");
                    @Interest::getInterestByUserId($this->mysqli, 0);
            }
	    
	    public function testgetInterestByHobby()
            {
                    $this->sqlInterest = Interest::getInterestByHobby($this->mysqli, $this->skill);
                    $this->assertIdentical($this->interest, $this->sqlInterest[0]);
            }
            
            public function testgetInterestByHobbyInvalid()
            {
                    $this->expectException("Exception");
                    @Interest::getInterestByHobby($this->mysqli, "Cheese");
            }
            
            public function testValidUpdateInterest()
            {	
                    $newHobby = "PHP";
                    $this->interest->setInterest($newHobby);
                    $this->interest->update($this->mysqli);
                    
                    //select the user from mySQL and assert it was inserted properly
                    $this->sqlInterest = Interest::getInterestByUserId($this->mysqli, $this->userId);
                    
                    // verify the skill changed
                    $this->assertIdentical($this->sqlInterest[0]->getInterest(), $newHobby);
            }
            
            // teardown
            public function tearDown()
            {
                    $this->interest->delete($this->mysqli);
            }
        }
?>