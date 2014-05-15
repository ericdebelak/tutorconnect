<?php
    // session start
	session_start();
	include("php/header.php");
?>
	<div id="content">
		<link rel="stylesheet" type="text/css" href="css/stylesheetForm.css"/>
		<script src="js/facebook.js" type="text/javascript"></script>
		<script src="js/register_validation.js" type="text/javascript"></script>
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
				 
				<input type="submit" value="Create Account" class="btnAccount" />
			 
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
<?php
	include("php/footer.php");
?>