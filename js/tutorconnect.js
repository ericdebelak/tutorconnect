$orange = "#DA9C3A";
$red = "#EB6245";
$yellow = "#DAC23A";
$white = "white";

$(document).ready(function()
{
	$("#mobileMenu").click(function()
	{
		$("#dropDown").slideToggle("slow");
	});
	
	$("#login").css('cursor', 'pointer');
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
	setTimeout(function()
	{
		$("#canvasLogo").hover(function() //hover on
		{
			var context = getCanvas();
			drawCanvasInstant(context, red, white, orange, orange);
		}, function()  //hover off
		{
			var context = getCanvas();
			drawCanvasInstant(context, white, red, yellow, yellow);
		});
	}, 2920);
});