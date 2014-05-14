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
		 
		     <h1>Create Account</h1>
		     <form id="userForm" method="post" action="facebook_user.php">
  
<!-- Help Eric I don't know what to do here -->
		     <form method="post" id="signupForm" form action="sendmail.php">
			         <fieldset>
				   <p><label for="name">Name:</label><br/>
				   <input type="text" size="25" id="name" name="name" /></p>
				 </fieldset>
				<fieldset>
				  <h2 class="hdr-account">Account</h2>
					<div class="fields">
						<p class="row">
							<label for="firstname">First Name:</label>
							<input type="text" id="firstname" name="firstname" class="field-large" />
						</p>
						<p class="row">
							<label for="lastname">Last Name:</label>
							<input type="text" id="lastname" name="lastname" class="field-large" required="required"/>
						</p> 
					 </div>
				</fieldset>
				<fieldset>
					<h2 class="hdr-address">Address</h2>
			
					<div class="fields">
						<p class="row">
							<label for="street-address">Street Address:</label>
							<input type="text" id="street-address" name="street-address" class="field-large"required="required" />
						</p>
						<p class="row">
							<label for="city">City:</label>
							<input type="text" id="city" name="city" class="field-large"required="required" />	
						</p>
						<p class="row">
							<label for="state">State</label>
							<select id="state" name="state">
								<option value="AL">Alabama</option>
								<option value="AK">Alaska</option>
								<option value="AZ">Arizona</option>
								<option value="AR">Arkansas</option>
								<option value="CA">California</option>
								<option value="CO">Colorado</option>
								<option value="CT">Connecticut</option>
								<option value="DE">Delaware</option>
								<option value="DC">District of Columbia</option>
								<option value="FL">Florida</option>
								<option value="GA">Georgia</option>
								<option value="HI">Hawaii</option>
								<option value="ID">Idaho</option>
								<option value="IL">Illinois</option>
								<option value="IN">Indiana</option>
								<option value="IA">Iowa</option>
								<option value="KS">Kansas</option>
								<option value="KY">Kentucky</option>
								<option value="LA">Louisiana</option>
								<option value="ME">Maine</option>
								<option value="MD">Maryland</option>
								<option value="MA">Massachusetts</option>
								<option value="MI">Michigan</option>
								<option value="MN">Minnesota</option>
								<option value="MS">Mississippi</option>
								<option value="MO">Missouri</option>
								<option value="MT">Montana</option>
								<option value="NE">Nebraska</option>
								<option value="NV">Nevada</option>
								<option value="NH">New Hampshire</option>
								<option value="NJ">New Jersey</option>
								<option value="NM">New Mexico</option>
								<option value="NY">New York</option>
								<option value="NC">North Carolina</option>
								<option value="ND">North Dakota</option>
								<option value="OH">Ohio</option>
								<option value="OK">Oklahoma</option>
								<option value="OR">Oregon</option>
								<option value="PA">Pennsylvania</option>
								<option value="RI">Rhode Island</option>
								<option value="SC">South Carolina</option>
								<option value="SD">South Dakota</option>
								<option value="TN">Tennessee</option>
								<option value="TX">Texas</option>
								<option value="UT">Utah</option>
								<option value="VT">Vermont</option>
								<option value="VA">Virginia</option>
								<option value="WA">Washington</option>
								<option value="WV">West Virginia</option>
								<option value="WI">Wisconsin</option>
								<option value="WY">Wyoming</option>
							</select>
						</p> 
						<p class="row">
							<label for="zip-code">Zip Code:</label>
							<input type="text" id="zip-code" name="zip-code" size="5" maxlength="5" required="required" />	
						</p>	 
					</div>
				</fieldset>
				<fieldset>
					<h2 class="hdr-contact information">Contact</h2>
			
					<div class="fields">
						<p class="row">
							<label for="phone-number">Phone Number:</label>
							<input type="text" id="phone-number" name="phone-number" size="12" maxlength="12" placeholder="000-000-0000" required="required" />
						</p>
						<p class="row">
							<label for="cell">Cell:</label>
							<input type="text" id="cell" name="cell" size="12" maxlength="12"  placeholder="000-000-0000"/>	
						</p>		
					</div>
				</fieldset>
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
		     <form>
		     <!-- facebook login and javascript begins here -->    
		     </form><fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
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
		
	</body>
</html>