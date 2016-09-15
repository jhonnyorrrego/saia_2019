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
function datos_flujo($iddoc){
global $conn;
$datos=busca_filtro_tabla("","flujo A, paso_documento B","A.idflujo=B.flujo_idflujo AND B.documento_iddocumento=".$iddoc,"",$conn);
$texto='';
if($datos["numcampos"])
  $texto=$datos[0]["nombre"];
return($texto);
}
function informacion_flujo($iddoc){
global $conn;
$idpaso_documento=busca_filtro_tabla("","paso_documento","documento_iddocumento=".$iddoc,"idpaso_documento desc",$conn);
if(!$idpaso_documento["numcampos"]){
  return('');
}
include_once($ruta_db_superior."workflow/libreria_paso.php");
$flujo=estado_flujo_instancia($idpaso_documento[0]["idpaso_documento"]);
$pasoo = busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$flujo[0]["iddiagram_instance"]." and paso_idpaso=".$flujo[0]["paso_idpaso"],"idpaso_documento desc",$conn);

$restringido = false;

$terminados = 0;
$actividades = busca_filtro_tabla("","paso_actividad","estado=1 AND paso_idpaso=".$pasoo[0]["paso_idpaso"],"",$conn);
for($i=0;$i<$actividades["numcampos"];$i++){
	$terminada = busca_filtro_tabla("","paso_instancia_terminada","actividad_idpaso_actividad=".$actividades[$i]["idpaso_actividad"]." and documento_iddocumento=".$pasoo[0]["documento_iddocumento"],"",$conn);
	if($terminada["numcampos"] > 0){
		$terminados++;
	}
}
$porcentaje = round((($terminados*100)/$actividades["numcampos"]),2);
$pocentaje_tarea = '('.$terminados.'/'.$actividades["numcampos"].'):'.$porcentaje.'%';

$tareas = busca_filtro_tabla("","paso_actividad","estado=1 AND paso_idpaso=".$flujo[0]["paso_idpaso"],"idpaso_actividad asc",$conn);

for($i=0;$i<$tareas["numcampos"];$i++){
	$tarea .= ($i+1).". ".$tareas[$i]["descripcion"]."<br>";
}
$dia = busca_filtro_tabla(resta_fechas(fecha_db_almacenar($flujo["fecha_final_paso"],'Y-m-d'),fecha_db_almacenar(date('Y-m-d'),'Y-m-d'))."as dias");
  $dias = $dia[0]["dias"]; 

if($dias < 0){
	$color = 'btn-danger';//rojo
}
else if($dias >= 0 && $dias <=1){
	$color = 'btn-warning';//amarillo
}
else if($dias > 1){
	$color = 'btn-success';//verde
}
//print_r($d);
$fecha_final_paso=date_parse($flujo["fecha_final_paso"]);
$anioinicial=$fecha_final_paso["year"];
$mesinicial=$fecha_final_paso["month"];
$diainicial=$fecha_final_paso["day"];
if($mesinicial < 10)
	$mesinicial = '0'.$mesinicial;
if($diainicial < 10)
	$diainicial = '0'.$diainicial;
$flujo["fecha_final_paso"] = $diainicial.'-'.$mesinicial.'-'.substr($anioinicial,2);

$texto = '';
$texto .= '
Terminados: '.$pocentaje_tarea.'<br />
Fecha l&iacute;mite: '.$flujo["fecha_final_paso"].'<br />
Tareas: <br />'.$tarea;

$flujo_general=flujo_general($flujo,$idpaso_documento[0]["idpaso_documento"]);

return (array($color,$texto,'','',$flujo_general[0],$flujo_general[1]));
}
function flujo_general($flujo,$idpaso_documento){
  $porcentaje=$flujo["porcentaje"];
  $fecha_final_diagram=$flujo["fecha_final_diagrama"];
  $fecha_inicio = busca_filtro_tabla(fecha_db_obtener('b.fecha','d-m-y H:i:s')." as fecha_inicio","paso_documento a, diagram_instance b","idpaso_documento=".$idpaso_documento." and diagram_iddiagram_instance=iddiagram_instance","",$conn);
  $dia = busca_filtro_tabla(resta_fechas(fecha_db_almacenar($fecha_final_diagram,'Y-m-d'),fecha_db_almacenar(date('Y-m-d'),'Y-m-d'))."as dias");
  $dias = $dia[0]["dias"];
   if($flujo["devueltos"]){
     $flujo[0]["estado_diagram_instance"]=7;
   }
   	if($dias < 0){
   		$color = 'btn-danger';
   	}
	else if($dias >= 0 && $dias <=1){
		$color = 'btn-warning';
	}
	else if($dias > 1){
		$color = 'btn-success';
	}
   	
	$fecha_final_paso=date_parse($fecha_final_diagram);
$anioinicial=$fecha_final_paso["year"];
$mesinicial=$fecha_final_paso["month"];
$diainicial=$fecha_final_paso["day"];
if($mesinicial < 10)
	$mesinicial = '0'.$mesinicial;
if($diainicial < 10)
	$diainicial = '0'.$diainicial;
	$fecha_final_diagram = $diainicial.'-'.$mesinicial.'-'.substr($anioinicial,2);
   
  $texto='<div class="texto_paso">Paso Actual: '.$flujo[0]["nombre_paso"]."<br />".$estadod." <br />
  Inicio: ".$fecha_inicio[0]["fecha_inicio"]."
  </br>Terminados: (".(($flujo["numcampos"]))."/".$flujo["pasos_flujo"]."):".$porcentaje."%<br />
  Fecha limite: ".$fecha_final_diagram."<br />
  Estado: Vence en ".$dias." dia(s)<br />
  Prioridad: Normal</div>";
  return array($color,$texto);
}
?>
