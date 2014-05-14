<!DOCTYPE html>
 <html>
	<head>
		<title>Login, login with Facebook log or login with Google</title>
		<link rel="stylesheet" type="text/css" href="../css/stylesheetForm.css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/additional-methods.min.js"></script>
		<script src="../js/jquery_formvalidation.js" type="text/javascript"></script>
	        <script src="facebook.js" type="text/javascript"></script>

	</head>
	<body>
		<div class="page">
			<h1>Please Login</h1>
			<form id="logon" method="post" action="login_proc.php">
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
       + 			<form id="userForm" method="post" action="facebook_user.php">
				       <input type="hidden" name="firstName" id="firstName" />
				       <input type="hidden" name="lastName" id="lastName" />
				       <input type="hidden" name="email" id="email" />
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
		

				 </fieldset>
			</form>	
		</div>
	</body>
</html>