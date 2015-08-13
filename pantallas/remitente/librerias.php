<?php
function mostrar_nombre($nombre,$idejecutor){
	global $conn;
	$texto="<span class='link kenlace_saia' conector='iframe' enlace='pantallas/remitente/mostrar_datos_ejecutor.php?idejecutor=".$idejecutor."' titulo='".$nombre."'><b>Nombre:</b> ".$nombre."</span>";
	return($texto);
}
?>