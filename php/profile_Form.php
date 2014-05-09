<!DOCTYPE html>
 <html>
	<head>
		<title>New Account</title>
		<link rel="stylesheet" type="text/css" href="../css/stylesheetForm.css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/additional-methods.min.js"></script>
		<script src="../js/jquery_formvalidation.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="page">
		 
			<h1>Profile Page</h1>
			<form method="post" enctype="multipart/form-data" id="signupform" action="show-data.php">
				<fieldset>
				  <h2 class="hdr-account">Name</h2>
					<div class="fields">
						<p class="row">
							<label for="firstname">First Name:</label>
							<input type="text" id="firstname" name="firstname" class="field-large" required="required"/>
						</p>
						<p class="row">
							<label for="lastname">Last Name:</label>
							<input type="text" id="lastname" name="lastname" class="field-large" required="required"/>
						</p> 
					 </div>
				</fieldset>
				<fieldset>
					<h2 class="hdr-birthdate">Birthdate and Photo</h2>
			
					<div class="fields">
						<p class="row">
							<label for="birthday">My Birthday:</label>
							<input type="date" id="birthday" name="birthday"  required="required" /><br /><br />
						</p>
						<p class="row">
							<label for="picture">My Photo:</label>
							<input type="file" id="picture" name="picture"/>
							<p class="instructions">Maximum size 250kb, PNG.</p>
						</p>	 
					</div>
				</fieldset>
				<fieldset>
					<h2 class="hdr-contact information">Travel and Rate</h2>
			
					<div class="fields">
						<p class="row">
							<label for="travel">My travel range:</label>
							<input type="text" id="travel" name="travel" size="12" maxlength="4" placeholder="miles" required="required" />
						</p>
						<p class="row">
							<label for="rate">My Rate:</label>
							<input type="text" id="rate" name="rate" size="12" maxlength="6"  placeholder="$"/>	
						</p>		
					</div>
				</fieldset>
				<fieldset>
					<h2 class="hdr-interest">Interest</h2>
					  <div class="fields checkboxes">
						<p class="row">
							<p>My Interest:</br></p>
							<label for="bowling">Bowling</label><input type="checkbox" id="interest" name="interest" value="Bowling">
							<label for="blogging">Blogging</label><input type="checkbox" id="interest" name="interest" value="Blogging">
							<label for="Bungee Jumping">Bungee Jumping</label><input type="checkbox" id="interest" name="interest" value="Bungee Jumping">
							<label for="Camping">Camping</label><input type="checkbox" id="interest" name="interest" value="Camping">
							<label for="Cooking">Cooking</label><input type="checkbox" id="interest" name="interest" value="Cooking">
							<label for="Creative Writing">Creative Writing</label><input type="checkbox" id="interest" name="interest" value="Creative Writing">
							<label for="Exercising">Exercising</label><input type="checkbox" id="interest" name="interest" value="Exercising">
							<label for="Fishing">Fishing</label><input type="checkbox" id="interest" name="interest" value="Fishing">
							<label for="Gaming">Gaming</label><input type="checkbox" id="interest" name="interest" value="Gaming">
							<label for="Golfing">Golfing</label><input type="checkbox" id="interest" name="interest" value="Golfing">
							<label for="Gymnastics">Gymnastics</label><input type="checkbox" id="interest" name="interest" value="Gymnastics">
							<label for="Hiking">Hiking</label><input type="checkbox" id="interest" name="interest" value="Hiking">
							<label for="Hunting">Hunting</label><input type="checkbox" id="interest" name="interest" value="Hunting">
							<label for="Ice Skating">Ice Skating</label><input type="checkbox" id="interest" name="interest" value="Ice Skating">
							<label for="Martial Arts">Martial Arts</label><input type="checkbox" id="interest" name="interest" value="Martial Arts">
							<label for="Meditation">Meditation</label><input type="checkbox" id="interest" name="interest" value="Meditation">
							<label for="Painting">Painting</label><input type="checkbox" id="interest" name="interest" value="Painting">
							<label for="Photography">Photography</label><input type="checkbox" id="interest" name="interest" value="Photography">
							<label for="Pottery">Pottery</label><input type="checkbox" id="interest" name="interest" value="Pottery ">
							<label for="Rafting">Rafting</label><input type="checkbox" id="interest" name="interest" value="Rafting">
							<label for="Reading">Reading</label><input type="checkbox" id="interest" name="interest" value="Reading">
							<label for="Skateboarding">Skateboarding</label><input type="checkbox" id="interest" name="interest" value="Skateboarding">
							<label for="Scuba diving">Scuba Diving</label><input type="checkbox" id="interest" name="interest" value="Scuba diving">
							<label for="Social Networking">Social Networking</label><input type="checkbox" id="interest" name="interest" value="Social Networking">
							<label for="Surfing">Surfing</label><input type="checkbox" id="interest" name="interest" value="Surfing">
							<label for="Skiing">Skiing</label><input type="checkbox" id="interest" name="interest" value="Skiing">
							<label for="Trekking">Trekking</label><input type="checkbox" id="interest" name="interest" value="Trekking">
							<label for="Traveling">Traveling</label><input type="checkbox" id="interest" name="interest" value="Traveling">
							
						</p>
					  </div>
				</fieldset>
					 <input type="submit" value="Create Account" class="btn" />
				 
			</form>	
		</div>
	</body>
</html>