<?php
	// grab the unit test framework
	require_once("/usr/lib/php5/simpletest/autorun.php");
	
	// grab the function(s) under scrutiny
	require("../persistance/php_files/php_functions.php");
	
	class HtmlReadfileTest extends UnitTestCase
	{
		// setUp() is before *EACH* test
		function setUp()
		{
		
		}
		
		// tearDown() is after *EACH* test
		function tearDown()
		{
		
		}
		
		function testValidFileName()
		{
		
		}
		
		function testInvalidFileName()
		{
		
		}
		
		function testValidFileWithoutPermission()
		{
		
		}
	}
	
?>