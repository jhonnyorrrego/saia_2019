<?php
$fecha = date("Y-m-d",($_REQUEST['fecha']));
;

echo'
<div id="addevent">
	<form action="" method="post">
		<input type="date"/> 
		<textarea name="Name" rows="8" cols="40"></textarea>		
		<br />			
	  	<input type="submit" value="Adicionar"/>
	</form>  
</div>
';
?>