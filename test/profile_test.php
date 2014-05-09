<?php
	// grab the unit test framework
	require_once("/usr/lib/php5/simpletest/autorun.php");
	
	// grab the function(s) under scrutiny
        require_once("../php/user.php");
        require_once("../php/profile.php");
        //require_once("../php/interest");
        //require_once("../php/skills");
	//require_once("../php/sessions.php");
	// require_once("../php/feedback.php");
        //require_once("../php/registration.php");
	require_once("/home/bradg/tutorconnect/config.php");
        
        
        class ProfileTest extends UnitTestCase
	{
		private $mysqli;
		
		// variable to hold the mysql user
		private $sqlProfile;
		private $profile;
		
		// constant variables to reuse
		private $userId = 7;
		private $firstName = "Hello";
		private $lastName = "Kitty";
		private $birthday = "1111-12-12";
		private $picture = "20480090";
                private $travel = "25";
                private $rate = 40.55;
		
		public function setUp()
		{
			$this->mysqli = Pointer::getMysqli();
			// create & insert the profile 
			$this->profile = new Profile(-1, $this->userId, $this->firstName, $this->lastName, $this->birthday, $this->picture, $this->travel, $this->rate);
			$this->profile->insert($this->mysqli);
		}
		public function testGetByUserId()
		{
			$this->sqlProfile = Profile::getProfileByUserId($this->mysqli, $this->userId);
			$this->assertIdentical($this->profile, $this->sqlProfile);
		}
		
		public function testGetByUserIdInvalid()
		{
			$this->expectException("Exception");
			@Profile::getProfileByUserId($this->mysqli, -2);
		}
		
		public function testProfileById()
		{
			$this->sqlProfile = Profile::getProfileById($this->mysqli, $this->profile->getId());
			$this->assertIdentical($this->profile, $this->sqlProfile);
		}
		
		public function testGetProfileByIdInvalid()
		{
			
			$this->expectException("Exception");
			@Profile::getProfileById($this->mysqli, -2);
		}
		
		public function testCreateValidProfile()
		{
			//select the user from mySQL and assert it was inserted properly
			$this->sqlProfile = Profile::getProfileByUserId($this->mysqli, $this->userId);
			$this->assertIdentical($this->sqlProfile->getFirstName(), $this->firstName);
			$this->assertIdentical($this->sqlProfile->getLastName(), $this->lastName);
			$this->assertIdentical($this->sqlProfile->getBirthday(), $this->birthday);
			$this->assertIdentical($this->sqlProfile->getPicture(), $this->picture);
                        $this->assertIdentical($this->sqlProfile->getTravel(), $this->travel);
			$this->assertIdentical($this->sqlProfile->getRate(), $this->rate);
			$this->assertTrue($this->sqlProfile->getId() > 0);
		}
		
		public function testValidUpdateValidProfile()
		{	
			$newLastName = "Happy";
			$this->profile->setLastName($newLastName);
			$this->profile->update($this->mysqli);
			
			//select the user from mySQL and assert it was inserted properly
			$this->sqlProfile = Profile::getProfileByUserId($this->mysqli, $this->userId);
			
			// verify the lastName changed
			$this->assertIdentical($this->sqlProfile, $this->profile);
                        $this->assertTrue($this->sqlProfile->getId() > 0);
		}
		
		// teardown
		public function tearDown()
		{
			$this->profile->delete($this->mysqli);
		}
	}
?>