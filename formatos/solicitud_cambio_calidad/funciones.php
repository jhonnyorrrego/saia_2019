<?php
include_once('../../db.php');
//$funcionario_sgc;
//$funcionario_sgc=1449;
function firma_coordinador_calidad($idformato,$iddoc){
global $conn;

//$funcionario_sgc='37211'; // Catalina Machado
//$funcionario_sgc='1088244055'; // Alejandra Ramirez
$funcionario_sgc='25166163'; //Lina Alzate
$documento=busca_filtro_tabla(fecha_db_obtener("fecha_vigencia").' AS fecha_vigencia, firma_sgc',"ft_solicitud_cambio_calidad A","A.documento_iddocumento=".$iddoc,"",$conn);
//print_r($documento);  
          
$usuario_actual=usuario_actual("funcionario_codigo");
if($documento["numcampos"]){
  if($documento[0]["firma_sgc"]!='' /*&& $usuario_actual==$funcionario_sgc*/){
    $ancho_firma=busca_filtro_tabla("valor",DB.".configuracion A","A.nombre='ancho_firma'","",$conn);
    if(!$ancho_firma["numcampos"])
      $ancho_firma[0]["valor"]=200;
    $alto_firma=busca_filtro_tabla("valor",DB.".configuracion A","A.nombre='alto_firma'","",$conn);
    if(!$alto_firma["numcampos"])
      $alto_firma[0]["valor"]=100;
    echo '<img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/formatos/librerias/mostrar_foto.php?codigo='.$documento[0]["firma_sgc"];
    echo '" width="'.$ancho_firma[0]["valor"].'" height="'.$alto_firma[0]["valor"].'"/><br /><br /><span class="phpmaker">FECHA DE TR&Aacute;MITE Y VIGENCIA DEL DOCUMENTO :'.$documento[0]["fecha_vigencia"].'</span>';    
  }
  else if($usuario_actual==$funcionario_sgc){
    echo('<a href="funciones_autorizacion.php?idformato='.$idformato.'&iddoc='.$iddoc.'&funcionario='.$usuario_actual.'">Aprobar</a>'); 
  }
  else {
    echo("PENDIENTE POR SER APROBADA POR EL COORDINADOR");
  }
}
}

function mostrar_fecha_vigencia($idformato,$iddoc){

}
function transferencia_coordinador_sgc($idformato,$iddoc){
global $conn;
  //include_once("../../class_transferencia.php");
  $datos["archivo_idarchivo"]=$iddoc;
  $datos["nombre"]="TRANSFERIDO";
  $datos["tipo_destino"]=1;
  $datos["tipo"]="";
  //$destino_tramite=array('37211'); // Catalina Machado
  //$destino_tramite=array('1088244055'); //Alejandra Ramirez
  $destino_tramite=array('25166163'); //Lina Alzate
  transferir_archivo_prueba($datos,$destino_tramite,"");
}

function numero_solictud_cambio($idformato,$iddoc){
global $conn;
 
$consulta=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
echo($consulta[0]["numero"]);  
}

function letrero_aprobacion($idformato,$iddoc){
global $conn;
$consulta=busca_filtro_tabla("","ft_solicitud_cambio_calidad","documento_iddocumento=".$iddoc,"",$conn);

if($consulta[0]["firma_sgc"]!=""){

echo("<font size=2><b>Solicitud procesada satisfactoriamente, favor socializar con los involucrados en el proceso</b></font>");

}
}
function listar_procesos_macros($idformato,$iddoc){
	global $conn;
	$procesos=busca_filtro_tabla("","ft_proceso a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ACTIVO', 'ANULADO') and a.estado<>'INACTIVO'","",$conn);
	$macros=busca_filtro_tabla("","ft_macroproceso_calidad a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in ('ELIMINADO', 'ANULADO', 'ACTIVO')","",$conn);
	$texto='';
	$texto.='<select name="listado_procesos" id="listado_procesos" class="required"><option value="">Por favor seleccione...</option>';
	for($i=0;$i<$procesos["numcampos"];$i++){
		$texto.='<option value="'.$procesos[$i]["idft_proceso"].'" tipo="1">'.$procesos[$i]["nombre"].' (Proceso)</option>';
	}
	for($i=0;$i<$macros["numcampos"];$i++){
		$texto.='<option value="'.$macros[$i]["idft_macroproceso_calidad"].'" tipo="2">'.$macros[$i]["nombre"].' (Macroproceso)</option>';
	}
	$texto.='</select>';
	echo '<td>'.$texto.'</td>';
	?>
	<script>
	$("#listado_procesos").change(function(){
		var valor = $("#listado_procesos option:selected").attr("tipo");
		$('input[name$="proceso_macroproceso"]').val(valor);
	});
	</script>
	<?php
}
function mostrar_procesos_macros($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("","ft_solicitud_cambio_calidad a","a.documento_iddocumento=".$iddoc,"",$conn);
	if($datos[0]["proceso_macroproceso"]==1){
		$proceso=busca_filtro_tabla("","ft_proceso a","a.idft_proceso=".$datos[0]["listado_procesos"],"",$conn);
		$texto=$proceso[0]["nombre"];
	}
	else if($datos[0]["proceso_macroproceso"]==2){
		$macroproceso=busca_filtro_tabla("","ft_macroproceso_calidad a","a.idft_macroproceso_calidad=".$datos[0]["listado_procesos"],"",$conn);
		$texto=$macroproceso[0]["nombre"];
	}
	else{
		$proceso=busca_filtro_tabla("","ft_proceso a","a.idft_proceso=".$datos[0]["listado_procesos"],"",$conn);
		$texto=$proceso[0]["nombre"];
	}
	echo $texto;
}
?>