<?php

include_once("db.php");







	$micadena='2222.222.55506660.9999';
    $codigo=str_replace('.','',$micadena);
    $codigo=implode('',explode('.',$micadena));
	echo($codigo);
	
	
?>