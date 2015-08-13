<?php
	/**
	 * This file uploads a file in the back end, without refreshing the page
	 *  
	 */
	
	if (isset($_POST['id'])) {
		if (!copy($_FILES[$_POST['id']]['tmp_name'], 'uploaded/files/'.$_FILES[$_POST['id']]['name'])) {
			echo '<script> alert("Failed to upload file");</script>';
		}
	}
	else {
		echo "File uploaded";
	}
?>