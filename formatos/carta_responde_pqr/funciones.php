<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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

function nombre_dependencia($idformato,$iddoc){
	global $conn;	
	$datos=busca_filtro_tabla("C.nombre","ft_carta_responde_pqr A, dependencia_cargo B, dependencia C","A.dependencia=B.iddependencia_cargo AND B.dependencia_iddependencia=C.iddependencia AND A.documento_iddocumento=".$iddoc,"",$conn);
	
	return $datos[0]['nombre'];
}

function codigo_dependencia($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("C.codigo","ft_carta_responde_pqr A, dependencia_cargo B, dependencia C","A.dependencia=B.iddependencia_cargo AND B.dependencia_iddependencia=C.iddependencia AND A.documento_iddocumento=".$iddoc,"",$conn);
	
	return $datos[0]['codigo'];
}

function cargar_asunto_carta($idformato,$iddoc){
	global $conn;
	
	echo(librerias_jquery("1.7"));
		
	if(strpos($_SERVER['PHP_SELF'],"editar")!==FALSE){
		$datos=busca_filtro_tabla("","ft_pqr A, ft_carta_responde_pqr B","A.idft_pqr=B.ft_pqr AND B.documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
	}else{
		$datos=busca_filtro_tabla("","ft_pqr A","A.documento_iddocumento=".$_REQUEST['anterior'],"",$conn);
	}
		
	$solicitud="";
	$tipo_solicitud="";
		
	switch ($datos[0]['solicitud']) {
		case '0':
			$solicitud="Instalaciones";
			break;
		case '1':
			$solicitud="Docentes";
			break;
		case '2':
			$solicitud="Restaurante";
			break;
		case '3':
			$solicitud="Area Administrativa";
			break;
		case '4':
			$solicitud="Otros";
			break;
	}
	
	switch ($datos[0]['tipo']) {
		case '0':	
			$tipo_solicitud="Preguntas";
			break;
		case '1':	
			$tipo_solicitud="Quejas";
			break;
		case '2':	
			$tipo_solicitud="Reclamos";
			break;
		case '3':	
			$tipo_solicitud="Solicitud";
			break;
		case '4':	
			$tipo_solicitud="Reconocimiento";
			break;
		case '5':	
			$tipo_solicitud="Sugerencias";
			break;
		case '6':	
			$tipo_solicitud="Inconvenientes pse";
			break;
	}
	 
?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#asunto").attr("readonly",true);
			$("#asunto").val("<?php echo "Respondiendo a Solicitud de ".$solicitud." (".$tipo_solicitud.")";?>");
		});
	</script>
<?php	 
}

function cargar_destino($idformato,$iddoc){
	global $conn;	
	
	if(strpos($_SERVER['PHP_SELF'],"editar")!==FALSE){
		$remitente = busca_filtro_tabla("A.nombres_apellidos","ft_pqr A, ft_carta_responde_pqr B","A.idft_pqr=B.ft_pqr AND B.documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
		
	}else{
		$remitente = busca_filtro_tabla("A.nombres_apellidos","ft_pqr A","A.documento_iddocumento=".$_REQUEST['anterior'],"",$conn);
	}
	
?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#destinos").attr("readonly",true);
			$("#destinos").val("<?php echo ($remitente[0]['nombres_apellidos']);?>")
		});
	</script>
<?php	
}	 
function mostrar_nombre_elaboro($idformato,$iddoc){
	global $conn;
		
	$codigousuario = usuario_actual("funcionario_codigo");
	$persona_elaboro = busca_filtro_tabla("A.nombres, A.apellidos","funcionario A","A.funcionario_codigo=".$codigousuario,"",$conn);//Datos a traer, tabla, condicion, limite de datos, conexion				
	//print_r($persona_elaboro);
?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#destino").attr("readonly",true);
			
			$("#persona_genera_carta").attr("readonly",true);
			$("#persona_genera_carta").val("<?php echo $persona_elaboro[0]["nombres"].' '.$persona_elaboro[0]["apellidos"];?>");
		});
	</script>
<?php	
}

function mostrar_destinos_pqr($idformato, $iddoc){
	global $conn;
	
	$remitente = busca_filtro_tabla("destino","ft_carta_respuesta_pqr","documento_iddocumento=".$iddoc,"",$conn);
		
	if($remitente['numcampos']){				
		$destinos = explode(',',$remitente[0]['destino']);
		echo("<select name='destinos'>");		
		for($i=0; $i < count($destinos); $i++){			
			$datos_destino = busca_filtro_tabla("idejecutor,nombre","ejecutor","idejecutor=".$destinos[$i],"",$conn);												
			echo("<option value='".$datos_destino[0]['idejecutor']."'>".$datos_destino[0]['nombre']."</option>");		
		}
		echo("</select>");
	}
}

function cambiar_estado_flujo_carta_pqr($idformato, $iddoc){ 
global $conn;	
	$pqr = busca_filtro_tabla("A.idft_pqr, A.documento_iddocumento, A.idflujo","ft_pqr A,ft_carta_responde_pqr B","A.idft_pqr=B.ft_pqr AND B.documento_iddocumento=".$iddoc,"",$conn);				
		
	$datos_paso = busca_filtro_tabla("paso_idpaso","paso A,paso_actividad B","A.idpaso=B.paso_idpaso AND B.descripcion LIKE 'Carta de respuesta' AND A.diagram_iddiagram=".$pqr[0]['idflujo'],"",$conn);
	
	$actividades_paso = busca_filtro_tabla("idpaso_actividad","paso_actividad","paso_idpaso=".$datos_paso[0]['paso_idpaso'],"",$conn);
				
	$paso_documento=busca_filtro_tabla("idpaso_documento","paso_documento","documento_iddocumento=".$pqr[0]["documento_iddocumento"]." AND paso_idpaso=".$datos_paso[0]['paso_idpaso'],"",$conn);	
	if($actividades_paso['numcampos'])
	for($i=0; $i < $actividades_paso['numcampos']; $i++){		
		terminar_actividad_paso($pqr[0]['documento_iddocumento'],"",2,$paso_documento[0]["idpaso_documento"],$actividades_paso[$i]['idpaso_actividad']);
	}
}

function destino_pqr($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$destinopqr=busca_filtro_tabla("","ft_pqr A,ft_carta_responde_pqr  B","B.ft_pqr=A.idft_pqr  AND  B.documento_iddocumento=".$iddoc,"",$conn);
	echo $destinopqr[0]['nombres_apellidos']."<br>";
	echo $destinopqr[0]['direccion']."<br>";
	echo $destinopqr[0]['telefono']."<br>";
	echo $destinopqr[0]['temail']."<br>";
   
}
?>