$(document).ready(function()
{
	$("#mobileMenu").click(function()
	{
		$("#dropDown").slideToggle("slow");
	});
	
	$("#login").css('cursor', 'pointer');
	//.hover( handlerIn(eventObject), handlerOut(eventObject) )
	//$("#login").hover( handlerIn($("#login").css('padding', '25px')), handlerOut($("#login").css('padding', '15px')) );
	$("#login").hover(function() //hover on
	{
		$(this).css('background', 'linear-gradient(#DA563A, #ED6F55)');
	}, function()  //hover off
	{
		$(this).css('background', 'linear-gradient(#ED6F55, #DA563A)');
	});
	
	$("#login").click(function()
	{
		// make the login window appear, turn on ajax controls
	});
	
});