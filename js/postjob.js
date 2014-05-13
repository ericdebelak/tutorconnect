function previewJob()
{
	var title = document.getElementById("postTitleInput").value;
	var details = document.getElementById("postDetailsInput").value;
	title = escapeHtml(title);
	details = escapeHtml(details);
	document.getElementById("postTitle").innerHTML = title;
	document.getElementById("postDetails").innerHTML = details;
}
function escapeHtml(text)
{
  return text
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
}