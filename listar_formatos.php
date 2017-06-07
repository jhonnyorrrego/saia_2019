<?php

$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");

echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap());

$proceso=busca_filtro_tabla('','categoria_formato','idcategoria_formato='.@$_REQUEST["idcategoria_formato"],'',$conn);

$formatos=busca_filtro_tabla('','formato','cod_padre=0 AND (fk_categoria_formato like "'.@$_REQUEST["idcategoria_formato"].'"  or fk_categoria_formato like "%,'.@$_REQUEST["idcategoria_formato"].'"   or fk_categoria_formato like "'.@$_REQUEST["idcategoria_formato"].',%"  or fk_categoria_formato like "%,'.@$_REQUEST["idcategoria_formato"].',%")    ','',$conn);

$etiqueta_proceso=$proceso[0]['nombre'];
$etiqueta_proceso=strtolower($etiqueta_proceso);
$etiqueta_proceso=strtoupper($etiqueta_proceso);

$cadena='
<br/>
<br/>
<div class="container">
		<table  style="width:100%;" border=0 cellspacing=2>
			<tr>
				<td style="text-align:center;" class="encabezado_list">
				&nbsp;<br/>
					'.$etiqueta_proceso.'
				<br/>	&nbsp;
				</td>
			<tr>
';

for($i=0;$i<$formatos['numcampos'];$i++){

	$etiqueta=$formatos[$i]['etiqueta'];
	$etiqueta=strtolower($etiqueta);
	$etiqueta=ucwords($etiqueta);

	$cadena.='
			<tr bgcolor="#CCCCCC">
				<td style="text-align:center;">
					<a href="'.$ruta_db_superior.FORMATOS_CLIENTE.$formatos[$i]['nombre'].'/'.$formatos[$i]['ruta_adicionar'].'">'.$etiqueta.'</a>
				</td>
			<tr>
	';
}
$cadena.='</table></div>';

echo($cadena);

?>