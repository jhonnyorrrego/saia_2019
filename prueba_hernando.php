<?php
include_once("db.php");
$datos=busca_filtro_tabla("","ft_resumen_presupuestal a","cod_padre=0 or cod_padre is null","",$conn);
for($i=0;$i<$datos["numcampos"];$i++){
	$sql1="update ft_resumen_presupuestal set tipo=2 where cod_padre=".$datos[$i]["idft_resumen_presupuestal"];
	phpmkr_query($sql1);
}
?>