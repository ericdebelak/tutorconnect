<?php
	// session start
	session_start();
	// grab config file and class files
	require_once("php/profile.php");
	require_once("/home/bradg/tutorconnect/config.php");
	include("php/header.php");
?>
<div class="page">
<link rel="stylesheet" type="text/css" href="css/stylesheetForm.css"/>
<script src="js/profile_validation.js" type="text/javascript"></script>
	<section id="content" style="margin-top: 20px; width: 40%;">
	<h1 style="margin: 5px;">Profile Page</h1>
	<form method="post" id="signupform" action="profile_proc.php">
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
				<p>
					<label for="travel">My travel range:</label>
					<input type="text" id="travel" name="travel" size="12" maxlength="4" placeholder="miles" required="required" style="margin-left: 30px;"/>
				</p>
				<p>
					<label for="rate">My Rate:</label>
					<input type="text" name="rate" size="12" maxlength="6"  placeholder="$" style="margin-left: 30px;" />	
				</p>		
			</div>
		</fieldset>
		<fieldset>
			<h2 class="hdr-interest">Interests and Hobbies</h2>
			  <div class="fields checkboxes">
				<p class="row">
					<p>My Interests:</br></p>
					<table style="box-shadow: 0px 0px 0px white; font-size: 1em;">
						<tr style="text-align: left; border: 0px;">
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Bowling"><label for="bowling">Bowling</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Blogging"><label for="blogging">Blogging</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Bungee Jumping"><label for="Bungee Jumping">Bungee Jumping</label></td>
						</tr>
						<tr style="text-align: left; border: 0px;">	
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Camping"><label for="Camping">Camping</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Cooking"><label for="Cooking">Cooking</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Creative Writing"><label for="Creative Writing">Creative Writing</label></td>
						</tr>
						<tr style="text-align: left; border: 0px;">	
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Exercising"><label for="Exercising">Exercising</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Fishing"><label for="Fishing">Fishing</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Gaming"><label for="Gaming">Gaming</label></td>
						</tr>
						<tr style="text-align: left; border: 0px;">	
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Golfing"><label for="Golfing">Golfing</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Gymnastics"><label for="Gymnastics">Gymnastics</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Hiking"><label for="Hiking">Hiking</label></td>
						</tr>
						<tr style="text-align: left; border: 0px;">	
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Hunting"><label for="Hunting">Hunting</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Ice Skating"><label for="Ice Skating">Ice Skating</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Martial Arts"><label for="Martial Arts">Martial Arts</label></td>
						</tr>
						<tr style="text-align: left; border: 0px;">	
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Meditation"><label for="Meditation">Meditation</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Painting"><label for="Painting">Painting</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Photography"><label for="Photography">Photography</label></td>
						</tr>
						<tr style="text-align: left; border: 0px;">	
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Pottery"><label for="Pottery">Pottery</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Rafting"><label for="Rafting">Rafting</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Reading"><label for="Reading">Reading</label></td>
						</tr>
						<tr style="text-align: left; border: 0px;">	
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Skateboarding"><label for="Skateboarding">Skateboarding</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Scuba diving"><label for="Scuba diving">Scuba Diving</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Social Networking"><label for="Social Networking">Social Networking</label></td>
						</tr>
						<tr style="text-align: left; border: 0px;">	
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Surfing"><label for="Surfing">Surfing</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Skiing"><label for="Skiing">Skiing</label></td>
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Trekking"><label for="Trekking">Trekking</label></td>
						</tr>
						<tr style="text-align: left; border: 0px;">	
							<td style="text-align: left; border: 0px;"><input type="checkbox" id="interest" name="interest[]" value="Traveling"><label for="Traveling">Traveling</label>
						</tr>
					</table>
				</p>
			  </div>
		</fieldset>
		<fieldset>
			<h2 class="hdr-interest">Skills you would like to teach:</h2>
			  <div class="fields checkboxes">
				<p class="row">
					<p>My Skills:</br></p>
					<table style="box-shadow: 0px 0px 0px white;">
						<tr style="text-align: left; border: 0px;">
							<td  style="text-align: left; border: 0px;"><input type="checkbox" id="skill" name="skill[]" value="Computers"><label for="Computers">Computers</label></td>
							<td  style="text-align: left; border: 0px;"><input type="checkbox" id="skill" name="skill[]" value="Mathematics"><label for="Mathematics">Mathematics</label></td>
							<td  style="text-align: left; border: 0px;"><input type="checkbox" id="skill" name="skill[]" value="Music"><label for="Music">Music</label></td>
						</tr>
						<tr style="text-align: left; border: 0px;">
							<td  style="text-align: left; border: 0px;"><input type="checkbox" id="skill" name="skill[]" value="Reading"><label for="Reading">Reading</label></td>
							<td  style="text-align: left; border: 0px;"><input type="checkbox" id="skill" name="skill[]" value="Science"><label for="Science">Science</label></td>
							<td  style="text-align: left; border: 0px;"><input type="checkbox" id="skill" name="skill[]" value="Social Studies"><label for="Social Studies">Social Studies</label></td>
						</tr style="text-align: left; border: 0px;">
						<tr>
							<td  style="text-align: left; border: 0px;"><input type="checkbox" id="skill" name="skill[]" value="Writing"><label for="Writing">Writing</label></td>
						</tr>
					</table>
				</p>
			  </div>
		</fieldset>
		<input type="submit" value="Create Account" class="btn" />
		 
	</form>
	</section>
</div>
<?php
	include("php/footer.php");
?>