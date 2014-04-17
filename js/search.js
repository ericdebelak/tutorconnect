/*
<section id="box" class="one">
</section>
<section id="box" class="two">
</section>
<section id="box" class="three">
</section>
*/
function searchLoad()
{
	document.getElementById("selector").style.cursor = 'pointer';
	document.getElementById("howManyResultsSelect").style.cursor = 'pointer';
	var searchButton = document.getElementById("searchButton");
	searchButton.style.cursor = 'pointer';
	searchButton.onclick = function() 
	{
		var subject = document.getElementById("selector").value;
		var inputString = document.getElementById("searchInput").value;
		var howMany = document.getElementById("howManyResultsSelect").value;
		if(subject == "" || inputString == ""){throw new Exception("Must select a subject and enter a search string");}
		else
		{
			var HTML = "";
			for(var i=0; i < howMany; i++)
			{
				var classNumber = classIdentifier();
				HTML += "<section id='box' class='" + classNumber + "'>";
				HTML += "<img src='http://placekitten.com/g/50/50' width='50px' height='50' />";
				HTML += "<h4>"+ inputString +"</h4>"
				HTML += "Specializes in:<ul><li>"+ subject +"</li><li>"+ subject +"</li><li>"+ subject +"</li><li>"+ subject +"</li></ul>"
				HTML += "</section>"
			}
			document.getElementById("boxes").innerHTML = HTML;
		}
	}
}

function classIdentifier()
{
	var random = Math.floor((Math.random()*3)+1);
	if(random === 1) {return("one");}
	else if(random === 2) {return("two");}
	else if(random === 3) {return("three");}
}