<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>AJAX File uploader</title>
		<script type="text/javascript" src="uploader.js" ></script>
	</head>

	<body>
	
<?php
	// This is the folder where file are uploaded
	$uploadDirectory = "../temporal/";
	
	require_once("AjaxFileUploader.inc.php");
	$ajaxFileUploader = new AjaxFileuploader($uploadDirectory);
	
	echo $ajaxFileUploader->showFileUploader('id1');
	echo $ajaxFileUploader->showFileUploader('id2');
	echo $ajaxFileUploader->showFileUploader('id4');
	
?>
	
	</body>
</html>
