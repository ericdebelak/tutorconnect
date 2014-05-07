<?php
	// grab the unit test framework
	require_once("/usr/lib/php5/simpletest/autorun.php");
	
	// grab the functions under scrutiny
	require_once("../php/session.php");
        
        // grab the config file
        require_once("/home/bradg/tutorconnect/config.php");
	
	class SessionTest extends UnitTestCase
	{
            private $mysqli = null;
            
            // variable to hold the mysql user
            private $sqlSession;
            private $session;
            
            // constant variables to reuse
            private $id;
            private $studentId = 7;
            private $tutorId = 8;
            private $studentLog = null;
            private $studentNextSteps = null;
            private $tutorLog = null;
            private $tutorNextSteps = null;
            private $date = "2014-05-06";
            
            public function setUp()
            {
                try
                {
                    if($this->mysqli === null)
                    {
                        $this->mysqli = Pointer::getMysqli();
                    }
                    $this->session = new Session (-1, $this->tutorId, $this->studentId, $this->tutorLog, $this->tutorNextSteps, $this->studentLog, $this->studentNextSteps, $this->date);			
                    $this->session->insert($this->mysqli);
                }
                catch(mysqli_sql_exception $exception)
                {
                        echo "Unable to connect to mySQL: " . $exception->getMessage();
                }
            }
            
            public function testgetSessionByTutorIdStudentIdDate()
            {
                    $this->sqlSession = Session::getSessionByTutorIdStudentIdDate($this->mysqli, $this->tutorId, $this->studentId, $this->date);
                    $this->assertIdentical($this->session, $this->sqlSession);
            }
            
            public function testgetSessionByTutorIdStudentIdDateInvalid()
            {
                    $this->expectException("Exception");
                    @Session::getSessionByTutorIdStudentIdDate($this->mysqli, 0, 0, 0000-00-00);
            }
            
            public function testgetSessionByTutorIdStudentId()
            {
                    $this->sqlSession = Session::getSessionByTutorIdStudentId($this->mysqli, $this->tutorId, $this->studentId);
                    $this->assertIdentical($this->session, $this->sqlSession[0]);
            }
            
            public function testgetSessionByTutorIdStudentIdInvalid()
            {
                    $this->expectException("Exception");
                    @Session::getSessionByTutorIdStudentId($this->mysqli, 0, 0);
            }
            
            public function testgetSessionByTutorId()
            {
                    $this->sqlSession = Session::getSessionByTutorId($this->mysqli, $this->tutorId);
                    $this->assertIdentical($this->session, $this->sqlSession[0]);
            }
            
            public function testgetSessionByTutorIdInvalid()
            {
                    $this->expectException("Exception");
                    @Session::getSessionByTutorId($this->mysqli, 0);
            }
            
            public function testgetSessionByStudentId()
            {
                    $this->sqlSession = Session::getSessionByStudentId($this->mysqli, $this->studentId);
                    $this->assertIdentical($this->session, $this->sqlSession[0]);
            }
            
            public function testgetSessionByStudentIdInvalid()
            {
                    $this->expectException("Exception");
                    @Session::getSessionByStudentId($this->mysqli, 0);
            }
            
            public function testValidUpdateSession()
            {	
                    $newLog = "test";
                    $this->session->setStudentLog($newLog);
                    $this->session->update($this->mysqli);
                    
                    //select the user from mySQL and assert it was inserted properly
                    $this->sqlSession = Session::getSessionByTutorIdStudentIdDate($this->mysqli, $this->tutorId, $this->studentId, $this->date);
                    
                    // verify the log changed
                    $this->assertIdentical($this->sqlSession->getStudentLog(), $newLog);
            }
            
            // teardown
            public function tearDown()
            {
                    $this->session->delete($this->mysqli);
            }
        }
?>