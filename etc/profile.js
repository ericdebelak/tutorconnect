$(document).ready(function()
{
	
	$("li").on('click',function () 
	{
		$(this).parent().find('ul').toggle(1000);
	});
  
  
   //validates form profile
  $("#profile").validate(
	{
		//debug option in JQuery's validator
		debug:true,
		//rules dictate what is (in)validate
		rules:
		{
			description:
			{ 
				required:true,
				minlength:50
			},
			password: //is ID of password
			{
				required:true //makes entry required
			},
			confirmPassword:
			{
				required: true,
				equalTo:"#password" //check to make sure it is equal to password by ID
			}//no comma needed since it is last on the list
		},
		//messages are what are displayed to the user
		messages:
		{
			description:
			{
				requrd:"please enter some information about yourself",
				minlength:"Please enter a minimum of 50 characters"
			},
			password:"Please enter a password",
			confirmPassword:
			{//using brackets because there are two options
				
				//confirm password was empty
				required:"Please confirm the password",
				
				//passwords did not match
				equalTo: "Password do not match"
			}
		}
	});
  
  
});