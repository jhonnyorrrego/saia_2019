<?php
include_once("../../db.php");
function nombre_usuario($idformato,$idcampo,$iddoc=NULL)
{global $conn;
 echo "<td><input readonly=true name='remitente_mensaje' type=text value='".usuario_actual("nombres")." ".usuario_actual("apellidos")." ".usuario_actual("email")."'>";
}
?>
