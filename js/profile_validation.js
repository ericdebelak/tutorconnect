$(document).ready(function()
{
	$("#signupform").validate(
	{

		rules:
		{
			firstname:
			{
				required: true,
				pattern: /^[A-Za-z\'\s\-]+$/,
			},
			
			lastname:
			{
				required: true,
				pattern: /^[A-Za-z\'\s\-]+$/,
			},
			
			travel:
			{
				number: true,
			},
                        
                        rate:
                        {
                                number: true,
                        }
			
		},
		

		messages:
		{
			firstname:
			{
				pattern: " Please enter a first name using only letters, spaces, hypens and apostrophes",
				required: " This field is required.",
			},
			lastname:
			{
				pattern: " Please enter a first name using only letters, spaces, hypens and apostrophes",
				required: " This field is required.",
			},
			travel: " Please enter a number",
                        rate: " Please enter a number"
		}
	});
});