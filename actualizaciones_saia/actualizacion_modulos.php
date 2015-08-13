<?php
include_once("../db.php");
$modulo=busca_filtro_tabla("","modulo","nombre<>'expediente' and enlace not like 'pantallas%' ","cod_padre ASC",$conn);
for($i=0;$i<$modulo["numcampos"];$i++){
	echo "UPDATE modulo SET enlace='".$modulo[$i]["enlace"]."', imagen='".$modulo[$i]["imagen"]."', cod_padre=".$modulo[$i]["cod_padre"]." WHERE nombre='".$modulo[$i]["nombre"]."';<br>";
}
echo($i);
?>