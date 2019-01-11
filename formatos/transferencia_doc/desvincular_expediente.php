<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_notificaciones());

$idexpediente=@$_REQUEST["idexpediente"];
$iddoc=@$_REQUEST["iddoc"];
$idformato=@$_REQUEST["idformato"];

$datos=busca_filtro_tabla("expediente_vinculado","ft_transferencia_doc a","a.documento_iddocumento=".$iddoc,"",$conn);

$mystring = $datos[0]["expediente_vinculado"];
$findme   = 'cajas_';
$pos = strpos($mystring, $findme);
    
if ($pos !== false) {  //son cajas //fue encontrada
    $ids_caja = trim($datos[0]["expediente_vinculado"], "cajas_");
    $datos[0]["expediente_vinculado"]=$ids_caja;
}    


$expedientes=explode(",",$datos[0]["expediente_vinculado"]);
$cant=count($expedientes);

$nuevos=array();
for($i=0;$i<$cant;$i++){
	if($expedientes[$i]!=$idexpediente && $expedientes[$i]){
		$nuevos[]=$expedientes[$i];
	}
}
$sql1="update ft_transferencia_doc set expediente_vinculado='".implode(",",$nuevos)."' where documento_iddocumento=".$iddoc;
phpmkr_query($sql1);

?>
<script>
notificacion_saia('Desvinculacion realizada','success','',4000);
</script>
<?php

abrir_url("mostrar_transferencia_doc.php?iddoc=".$iddoc."&idformato=".$idformato,"_self");
?>