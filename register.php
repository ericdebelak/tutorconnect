<?php
    // session start
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link href="css/tutorconnect.css"  type="text/css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="css/stylesheetForm.css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/additional-methods.min.js"></script>
		<script src="js/jquery_formvalidation.js" type="text/javascript"></script>
	        <script src="js/facebook.js" type="text/javascript"></script>
		<script src="js/google.js" type="text/javascript"></script>
		<script src="js/tutorconnect.js" type="text/javascript"></script>
		<script src="js/canvasLogo.js" type="text/javascript"></script>
		<meta name="viewport" content="width=device-width,initial-scale=1" />
	</head>
	<body onLoad="canvasLogo();">
		<header>
			<div id="top">
				<a href="index.html"><canvas id="canvasLogo" width="240" height="91">
					Your browser doesn't support canvas. DOH!
				</canvas></a>
			</div>
			<nav>
				<a href="search.html"><div>Search Postings</div></a>
				<a href="post.html"><div>Post a Job</div></a>
				<a href="profile.html"><div>Profile</div></a>
				<a href="testimonials.html"><div>Testimonials</div></a>
			</nav>
		</header>
		<div id="login">Login / Register</div>
		<div id="mobileMenu">Menu &darr;
			<div id="dropDown">
				<div>Search Postings</div>
				<div>Post a Job</div>
				<div>Profiles</div>
				<div>Testimonials</div>
			</div>
		</div>
		<div id="content">
			<h1>Please Register</h1>
			<form id="register" method="post" action="php/registrationProcess.php">
				<fieldset>
					<h2 class="Usernameandpassword">User Name and Password</h2>
			
					<div class="fields">
						<p class="row">
							<label for="email">Email</label>
							<input type="text" id="email" name="email" class="field-large" placeholder="name@email.com"/><p><em>*Please enter your email address for user name.</em></p>
					
						</p>
						<p class="row">
							<label for="password">Password</label>
							<input type="password" id="password" name="password" />	
					
						</p>
						<p class="row">
							<label for="confirmPassword">Confirm Password</label>
							<input type="password" id="confirmPassword" name="confirmPassword" />	
						</p>		
					</div>
					 
					<input type="submit" value="Create Account" class="btn" />
				 
			</form>
			 <!-- facebook login and javascript begins here -->    
		     <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
				   </fb:login-button>
				   <div id="status">
				   </div>
				   <div id="fb-root">
				   </div>
				   <div id="userStatus">
				   </div>
        			<form id="userForm" method="post" action="php/facebookRegister.php">
				       <input type="hidden" name="firstName" id="firstName" />
				       <input type="hidden" name="lastName" id="lastName" />
				       <input type="hidden" name="fbemail" id="fbemail" />
				       <input type="hidden" name="fbid" id="fbid" />
				       
		     </form>
		     <form>
		     <span id="signinButton">
			 <span
			   class="g-signin"
			   data-callback="signinCallback"
			   data-clientid="599980833060-1lgsbv7cpvaldfrp8roq2k0jf4m2ku0u.apps.googleusercontent.com"
			   data-cookiepolicy="single_host_origin"
			   data-requestvisibleactions="http://schemas.google.com/AddActivity"
			   data-scope="https://www.googleapis.com/auth/plus.login">
			 </span>
		     </script>
		     <script type="text/javascript">
		     (function()
		      {
		      var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		      po.src = 'https://apis.google.com/js/client:plusone.js';
		      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		    })();
		     </script>
		</div>
		<footer>
		
		</footer>
	</body>
</html>