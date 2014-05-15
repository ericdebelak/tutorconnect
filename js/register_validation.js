$(document).ready(function()
{
	$("#register").validate(
	{

		rules:
		{
			email:
			{
				required: true,
				email: true,
			},
			
			confirmPassword:
			{
				equalTo:"#password",
			}
			
		},
		

		messages:
		{
			email: " Please enter a valid email",
			confirmPassword: " Passwords do not match"
		}
	});
});