<?php
session_start();
include_once("db.php");
include_once("workflow/libreria_paso.php");
include_once("calendario/calendario.php");

global $conn;
//$buscar=new Sql($conn->Obtener_Conexion(),$conn->Motor);
$datos=busca_filtro_tabla("","busquedas","idbusquedas=140","",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=140","orden asc",$conn);
if($funciones["numcampos"])
{for($i=0;$i<$funciones["numcampos"];$i++)
    {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
    }
 $id_func=implode(",",$id_func);
}

$funcionario = usuario_actual("funcionario_codigo");
//---------Consulta para sacar los pendientes del funcionario----------------------
$fluj = busca_filtro_tabla("distinct a.idpaso_documento AS id, d.iddiagram_instance AS No_Flujo, e.title AS flujo__nombre,b.descripcion AS descripcion_documento, a.fecha_asignacion AS fecha_inicial","paso_documento a, documento b, diagram e, diagram_instance d,paso_actividad f, asignacion g","a.documento_iddocumento=b.iddocumento AND a.diagram_iddiagram_instance=d.iddiagram_instance AND d.diagram_iddiagram=e.id AND f.paso_idpaso=a.paso_idpaso AND  a.documento_iddocumento=g.documento_iddocumento AND g.llave_entidad=".$funcionario." AND estado_diagram_instance in(4)","GROUP BY d.iddiagram_instance,a.idpaso_documento,e.title, b.descripcion, a.fecha_asignacion ORDER BY fecha_inicial DESC",$conn);

$idflujos0 = array();
$idflujos1 = array();
$idflujos2 = array();
$idflujos3 = array();
$idflujos4 = array();

for($i=0;$i<$fluj["numcampos"];$i++){
	$flujo = estado_flujo_instancia($fluj[$i]["id"]);
	$fecha_final_diagram=$flujo["fecha_final_paso"];
	$dia = busca_filtro_tabla(resta_fechas(fecha_db_almacenar($fecha_final_diagram,'Y-m-d'),fecha_db_almacenar(date('Y-m-d'),'Y-m-d'))."as dias");
  $valor[0] = $dia[0]["dias"];
  	
  	//print_r($valor[0]);
  	if($valor[0] < 0 ){
  		array_push($idflujos0,$fluj[$i]["id"]);
	} 
	else if($valor[0] == 0 || $valor[0] == 1){
	   	array_push($idflujos1,$fluj[$i]["id"]);
	} 
	else if($valor[0] >= 2 && $valor[0] < 8){
	    array_push($idflujos2,$fluj[$i]["id"]);
	}
	else if($valor[0] >= 8){
	    array_push($idflujos3,$fluj[$i]["id"]);
	} 
	/*else if($valor[0] >= 8 && $valor[0] < 31){
	    array_push($idflujos3,$fluj[$i]["id"]);
	}  
	else if($valor[0] >= 31){
	    array_push($idflujos4,$fluj[$i]["id"]);
	}*/
}

if(@$_REQUEST["tipo"] == 1){
	$datos[0]["codigo"] = str_replace("/*filtro*/"," AND a.idpaso_documento in(".implode(",",$idflujos0).")",$datos[0]["codigo"]);
}
else if(@$_REQUEST["tipo"] == 2){
	$datos[0]["codigo"] = str_replace("/*filtro*/"," AND a.idpaso_documento in(".implode(",",$idflujos1).")",$datos[0]["codigo"]);
}
else if(@$_REQUEST["tipo"] == 3){
	$datos[0]["codigo"] = str_replace("/*filtro*/"," AND a.idpaso_documento in(".implode(",",$idflujos2).")",$datos[0]["codigo"]);
}
else if(@$_REQUEST["tipo"] == 4){
	$datos[0]["codigo"] = str_replace("/*filtro*/"," AND a.idpaso_documento in(".implode(",",$idflujos3).")",$datos[0]["codigo"]);
}
else if(@$_REQUEST["tipo"] == 5){
	$datos[0]["codigo"] = str_replace("/*filtro*/"," AND a.idpaso_documento in(".implode(",",$idflujos4).")",$datos[0]["codigo"]);
}

//die();
         
if($datos["numcampos"])
  {  
?>
<form name=form1 action="buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="registros" value="6">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="ordenar" value="<?php echo $datos[0]["ordenado"]; ?>">
<input type="hidden" name="adicionales" value="no_encabezado,1">
<input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
<input type="hidden" name="tabla" value="">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="sql" value="<?php echo $datos[0]["codigo"]; ?>">
<input type="image" src="<?php echo PROTOCOLO_CONEXION.RUTA_PDF."/imagenes/cargando.gif"; ?>">
</form>

<script type="text/javascript">
form1.submit();
</script>
<?php  
  }die();
?>
