function searchLoad()
{
	var selector = document.getElementById("selector").style.cursor = 'pointer';
	var howMany = document.getElementById("howManyResultsSelect").style.cursor = 'pointer';
	var searchButton = document.getElementById("searchButton");
	searchButton.style.cursor = 'pointer';
}

$(document).ready(function()
{
	var options =
	{	
		type: "POST",
		target: "#boxes",
		url: "php/searchproc.php",
		success: showResults,
	};
	$("#searchInputForm").submit(function()
	{
		$(this).ajaxSubmit(options);
		return false;
	});	
	function showResults(responseText, statusText, xhr, $form)
	{
	
	};
});
