<?php
    session_start();
    require_once("php/user.php");
	require_once("php/session.php");
	require_once("php/profile.php");
	require_once("php/feedback.php");
	require_once("../../tutorconnect/config.php");
	require_once("php/feedbackproc.php");
	include("php/header.php");
?>
	<div id="content">
		<?php
			$subjectId = $_GET["subjectId"];
			echo grabFeedback($subjectId);
		?>
		
	</div>
<?php
	include("php/footer.php");
?>