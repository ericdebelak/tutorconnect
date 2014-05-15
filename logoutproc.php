<?php
	include("php/header.php");
	// always use this to start/resume session
	session_start();
	
	$_SESSION["id"] = null;
	// first empty out the session array
	$_SESSION = array();
	
	// second, delete the session cookie, if we're configured to use cookies (by default, php uses cookies)
	if(ini_get("session.use_cookies")) // returns PHP config value from php.ini
	{
		$params = session_get_cookie_params();
		setcookie(session_name(), "", 1, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
	}
	// finally destroy the session
	session_destroy();
	echo "<section>You are now logged out.</section>";
	include("php/footer.php");
	
?>