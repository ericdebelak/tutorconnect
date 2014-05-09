<?php
	// grab the unit test framework
	require_once("/usr/lib/php5/simpletest/autorun.php");
	
	// grab the functions under scrutiny
	require_once("../php/verification.php");
        
        // grab the config file
        require_once("/home/bradg/tutorconnect/config.php");
	
	class VerifyTest extends UnitTestCase
	{
            private $mysqli = null;
            
            // variable to hold the mysql user
            private $sqlVerify;
            private $code;
            
            // constant variables to reuse
            private $userId = 7;
	    private $verificationCode = "12345678901234567890abcdefabcdef";
            
            public function setUp()
            {
                try
                {
                    if($this->mysqli === null)
                    {
                        $this->mysqli = Pointer::getMysqli();
                    }
                    $this->code = new Verify ($this->userId, $this->verificationCode);			
                    $this->code->insert($this->mysqli);
                }
                catch(mysqli_sql_exception $exception)
                {
                    echo "Unable to connect to mySQL: " . $exception->getMessage();
                }
            }
            
            public function testgetVerifyByCode()
            {
                $this->sqlVerify = Verify::getUserByCode($this->mysqli, $this->verificationCode);
                $this->assertIdentical($this->code, $this->sqlVerify);
            }
            
            public function testgetVerifyByTutorIdStudentIdDateInvalid()
            {
                $this->expectException("Exception");
                @Verify::getUserByCode($this->mysqli, "12345678901234567890abcdefabcdee");
            }
            
            public function testValidUpdateVerify()
            {	
                $newVerificationCode = "12345678901234567890abcdefabcdee";
                $this->code->setVerificationCode($newVerificationCode);
                $this->code->update($this->mysqli);
                
                //select the user from mySQL and assert it was inserted properly
                $this->sqlVerify = Verify::getUserByCode($this->mysqli, $newVerificationCode);
                
                // verify the log changed
                $this->assertIdentical($this->sqlVerify, $this->code);
            }
            
            // teardown
            public function tearDown()
            {
                $this->code->delete($this->mysqli);
            }
        }
?>