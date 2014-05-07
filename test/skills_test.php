<?php
	// grab the unit test framework
	require_once("/usr/lib/php5/simpletest/autorun.php");
	
	// grab the functions under scrutiny
	require_once("../php/skills.php");
        
        // grab the config file
        require_once("/home/bradg/tutorconnect/config.php");
	
	class SkillTest extends UnitTestCase
	{
            private $mysqli = null;
            
            // variable to hold the mysql user
            private $sqlExperience;
            private $experience;
            
            // constant variables to reuse
            private $id;
            private $userId = 7;
            private $skill = "JavaScript";
            private $description = "Loads of experience";
            
            public function setUp()
            {
                try
                {
                    if($this->mysqli === null)
                    {
                        $this->mysqli = Pointer::getMysqli();
                    }
                    $this->experience = new Experience (-1, $this->userId, $this->skill, $this->description);			
                    $this->experience->insert($this->mysqli);
                }
                catch(mysqli_sql_exception $exception)
                {
                    echo "Unable to connect to mySQL: " . $exception->getMessage();
                }
            }
            
            public function testgetExperienceByUserId()
            {
		$this->sqlExperience = Experience::getExperienceByUserId($this->mysqli, $this->userId);
		$this->assertIdentical($this->experience, $this->sqlExperience[0]);
            }
            
            public function testgetExperienceByUserIdInvalid()
            {
		$this->expectException("Exception");
		@Experience::getExperienceByUserId($this->mysqli, 0);
            }
	    
	    public function testgetExperienceBySkill()
            {
		$this->sqlExperience = Experience::getExperienceBySkill($this->mysqli, $this->skill);
		$this->assertIdentical($this->experience, $this->sqlExperience[0]);
            }
            
            public function testgetExperienceBySkillInvalid()
            {
		$this->expectException("Exception");
		@Experience::getExperienceBySkill($this->mysqli, "Cheese");
            }
            
            public function testValidUpdateExperience()
            {	
		$newSkill = "PHP";
		$this->experience->setExperience($newSkill);
		$this->experience->update($this->mysqli);
		
		//select the user from mySQL and assert it was inserted properly
		$this->sqlExperience = Experience::getExperienceByUserId($this->mysqli, $this->userId);
		
		// verify the skill changed
		$this->assertIdentical($this->sqlExperience[0]->getExperience(), $newSkill);
            }
            
            // teardown
            public function tearDown()
            {
                $this->experience->delete($this->mysqli);
            }
        }
?>