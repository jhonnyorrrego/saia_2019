<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."sql.php");
include_once($ruta_db_superior."asignacion.php");
include_once($ruta_db_superior."formatos/librerias/funciones_acciones.php");

$info_vehiculo=busca_filtro_tabla("","ft_datos_vehiculo","idft_datos_vehiculo=".$_REQUEST["id"],"",$conn);
$datos_accesorios=busca_filtro_tabla("C.nombre AS accesorio, B.valor_accesorio, B.idft_accesorios_vehiculo","ft_datos_vehiculo A, ft_accesorios_vehiculo B, serie C","A.idft_datos_vehiculo=B.ft_datos_vehiculo AND B.accesorio_vehiculo=C.idserie AND A.idft_datos_vehiculo=".$_REQUEST['id'],"",$conn);

//Enlace Informacion Vehiculo
$texto.='<a href="http://'.RUTA_PDF.'/formatos/datos_vehiculo/mostrar_datos_vehiculo.php?iddoc='.$info_vehiculo[0]["documento_iddocumento"].'&idformato=258&no_menu=1&ventana=1" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width:600, height:400,preserveContent:false } )"style="text-decoration: underline; cursor:pointer;" target="_blank">Información Vehículo</a>';

//Chechbox Accesorios
$checkbox="";

if($datos_accesorios['numcampos']){
	$checkbox.="<td bgcolor='#F5F5F5'>";
	$checkbox.="<table border='0'>";
	$checkbox.="<tbody>";
	$checkbox.="<tr>";	
	$checkbox.="<td>";
	for($i=0;$i<$datos_accesorios['numcampos'];$i++){
		$checkbox.="<label for='accesorios_vehiculo".$i."'>";
		$checkbox.="<input type='checkbox' value='".$datos_accesorios[$i]['idft_accesorios_vehiculo']."' id='accesorios_vehiculo".$datos_accesorios[$i]['idft_accesorios_vehiculo']."' name='accesorios_vehiculo[]'>";
		$checkbox.=$datos_accesorios[$i]['accesorio']." ($".number_format($datos_accesorios[$i]['valor_accesorio'],0,"",".").")";
		$checkbox.="</label><br/>";		
	}
	$checkbox.="</td>";
	$checkbox.="</tr>";
	$checkbox.="<tr>";
	$checkbox.="<td colspan='3'>";
	$checkbox.="<label class='error' for='accesorios_vehiculo[]' style='display:none'>Campo obligatorio</label>";
	$checkbox.="</td>";
	$checkbox.="</tr>";
	$checkbox.="</tbody>";
	$checkbox.="</table>";
	$checkbox.="</td>";
}

$datos = 	array(
						"enlace"     => $texto,
						"accesorios" => $checkbox			
					);

echo(json_encode($datos));       
?>