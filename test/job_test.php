<?php
	// grab the unit test framework
	require_once("/usr/lib/php5/simpletest/autorun.php");
	
	// grab the functions under scrutiny
	require_once("../php/job.php");
        
	// grab the config file
	require_once("/home/bradg/tutorconnect/config.php");
	
	class JobTest extends UnitTestCase
	{
		private $mysqli = null;
            
		// variable to hold the mysqli objects
		private $sqlJob;
		private $job;
            
		// constant variables to reuse
		private $id;
		private $userId = 7;
		private $title = "CSS help for YOU";
		private $details = "How to describe how awesome you can be AFTER my tutoring?: EPIC";
            
		public function setUp()
		{
			try
			{
				if($this->mysqli === null)
				{
					$this->mysqli = Pointer::getMysqli();
				}
				$this->job = new Job (-1, $this->userId, $this->title, $this->details);			
				$this->job->insert($this->mysqli);
			}
			catch(mysqli_sql_exception $exception)
			{
				echo "Unable to connect to mySQL: " . $exception->getMessage();
			}
		}
            
		public function testGetJobsByUserId()
		{
			$this->sqlJob = Job::getJobsByUserId($this->mysqli, $this->userId);
			$this->assertIdentical($this->job, $this->sqlJob[0]);
		}

		public function testGetJobsByUserIdInvalid()
		{
			$this->expectException("Exception");
			@Job::getJobsByUserId($this->mysqli, 0);
		}
     
		public function testValidUpdateJob()
		{	
			$newTitle = "HTML is better";
			$newDetails = "Just ask me and I'll tell you.";
			$this->job->setTitle($newTitle);
			$this->job->setDetails($newDetails);
			$this->job->update($this->mysqli);
		
			//select the user from mySQL and assert it was inserted properly
			$this->sqlJob = Job::getJobsByUserId($this->mysqli, $this->userId);
		
			// verify the title and details changed
			$this->assertIdentical($this->sqlJob[0]->getTitle(), $newTitle);
			$this->assertIdentical($this->sqlJob[0]->getDetails(), $newDetails);
            }
            
            // teardown
            public function tearDown()
            {
                $this->job->delete($this->mysqli);
            }
        }
?>