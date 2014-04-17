var orange = "#DA9C3A";
var red = "#EB6245";
var yellow = "#DAC23A";
var white = "white";

function getCanvas()
{
	var canvas = document.getElementById("canvasLogo");
	var context = canvas.getContext("2d");
	return context;
}

function canvasLogo()
{
	var context = getCanvas();
	
	// clear the canvas
	context.clearRect(0, 0, 240, 91);
	
	// draw something to initialize the font
	context.font = ".1em tahomabd";
	context.fillStyle = "transparent";
	context.fillText(".",0,0);
	
	// draw tutor
	setTimeout(function()
	{
		drawTutor(context, red);
	}, 400);
	
	// wait a moment, then draw connect
	setTimeout(function()
	{
		drawConnect(context, white);
	}, 1000);
	
	// wait a moment, then animate plug
	setTimeout(function()
	{
		drawPlug(context, orange);
	}, 1500);
	
	// upon connection, change colors
	setTimeout(function()
	{
		drawCanvasInstant(context, white, red, yellow, yellow)
	}, 2910);
}

function drawCanvasInstant(context, tutorColor, connectColor, plugColor, dotComColor)
{
	context.clearRect(0, 0, 240, 91);
	drawTutor(context, tutorColor);
	drawConnect(context, connectColor);
	drawPlugInstant(context, plugColor);
	drawDotCom(context, dotComColor);
}

function drawTutor(context, color)
{
	context.font = "2em tahomabd";
	context.fillStyle = color;
	context.fillText("Tutor",10,40);
}

function drawConnect(context, color)
{
	context.font = "2em tahomabd";
	context.fillStyle = color;
	context.fillText("Connect", 56,91);
}

function drawDotCom(context, color)
{
	context.font = "1.5em sans-serif";
	context.fillStyle = color;
	context.fillText(".com", 188,90);
}

function drawPlug(context, color)
{
	// set parameters of the lines
	context.strokeStyle = color;
	context.lineWidth = 2;
	
	// move the imaginary pen and begin (not sure what happens without these)
	context.moveTo(178, 70);
	context.beginPath();
	
	// draw first arc from top of connec't' up and left arc
	setTimeout(function()
	{
		context.arc(164, 68, 14, 0.0, 1.75*Math.PI, true); context.stroke();
	}, 100);
	setTimeout(function()
	{
		context.arc(164, 68, 14, 1.75*Math.PI, 1.5*Math.PI, true); context.stroke();
	}, 200);
	
	// draw line across the canvas
	setTimeout(function()
	{
		context.lineTo(150, 54); context.stroke();
	}, 300);	
	setTimeout(function()
	{
		context.lineTo(137, 54); context.stroke();
	}, 400);
	setTimeout(function()
	{
		context.lineTo(124, 54); context.stroke();
	}, 500);
	setTimeout(function()
	{
		context.lineTo(111, 54); context.stroke();
	}, 600);
	setTimeout(function()
	{
		context.lineTo(98, 54); context.stroke();
	}, 700);
	setTimeout(function()
	{
		context.lineTo(85, 54); context.stroke();
	}, 800);
	setTimeout(function()
	{
		context.lineTo(72, 54); context.stroke();
	}, 900);
	setTimeout(function()
	{
		context.lineTo(59, 54); context.stroke();
	}, 1000);
	setTimeout(function()
	{
		context.lineTo(46, 54); context.stroke();
	}, 1100);
	setTimeout(function()
	{
		context.lineTo(33.5, 54); context.stroke();
	}, 1200);
	
	// draw second arc to bottom of 'T'utor left and up.
	setTimeout(function()
	{
		context.arc(33.5, 40, 14, 0.5*Math.PI, 0.75*Math.PI); context.stroke();
	}, 1300);
	setTimeout(function()
	{
		context.arc(33.5, 40, 14, 0.75*Math.PI, 1.0*Math.PI); context.stroke();
	}, 1400);
}

function drawPlugInstant(context, color)
{
	context.strokeStyle = color; 
	context.lineWidth = 2;
	context.moveTo(178, 70);
	context.beginPath();
	context.arc(164, 68, 14, 0.0, 1.5*Math.PI, true);
	context.lineTo(33.5, 54); 
	context.arc(33.5, 40, 14, 0.5*Math.PI, 1.0*Math.PI); 
	context.stroke();
}