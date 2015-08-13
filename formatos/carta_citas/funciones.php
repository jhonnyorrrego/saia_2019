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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

/*INGRESAR*/
function validar_ingreso_carta($idformato,$iddoc){
	global $ruta_db_superior;
	if(!isset($_REQUEST['iddoc'])){
		if(isset($_REQUEST['opt']) && $_REQUEST['idtem']==""){
			alerta("Error Con los Remitentes");
			abrir_url($ruta_db_superior."pantallas/buscador_principal.php?idbusqueda=41","centro");
			die();
		}else if(!isset($_REQUEST['idtem'])){
			alerta("Debe Remitirlos Desde el Reporte");
			abrir_url($ruta_db_superior."pantallas/buscador_principal.php?idbusqueda=41","centro");
			die();
		}
	}
}

/*ADICIONAR*/
function ingresar_remitidos($idformato,$iddoc){
	$item=$_REQUEST['idtem'];
	?>
	<script>
		$(document).ready(function(){
			$("input[name='citas_remitidas']").val('<?php echo $item; ?>');
		});
	</script>
	<?php
}


/*MOSTRAR*/
function mostrar_destino($idformato,$iddoc){
	global $conn,$datos;
	$datos=busca_filtro_tabla("","ft_carta_citas cc,ejecutor e,datos_ejecutor de","e.idejecutor=de.ejecutor_idejecutor and de.iddatos_ejecutor=cc.destino and cc.documento_iddocumento=".$iddoc,"",$conn);	
	$html="";
	if($datos[0]['nombre']!=""){
		$html.="<b>".strtoupper($datos[0]['nombre'])."</b><br/>";
	}
	if($datos[0]['empresa']!=""){
		$html.=$datos[0]['empresa']."<br/>";
	}
	if($datos[0]['direccion']!=""){
		$html.=$datos[0]['direccion']."<br/>";
	}
	if($datos[0]['telefono']!=""){
		$html.=$datos[0]['telefono']."<br/>";
	}
	echo $html;
}

function mostrar_remitidos($idformato,$iddoc){
	global $conn,$datos;
	$temp=busca_filtro_tabla("","temp_citas_ejecutadas","idtemp_citas_ejecutadas in (".$datos[0]['citas_remitidas'].")","",$conn);
	
	$html="<table style='width: 100%; font-size: 10pt; border-collapse: collapse; font-family: arial;' border='1'>";
	$html.="<tr style='font-weight:bold'> <td>Fecha</td> <td>Eps</td> <td>Cedula</td> <td>Nombre Paciente</td> <td>Apellido Paciente</td> <td>Doctor</td> <td>Formulacion Medica</td> <td>Tipo Servicio</td> </tr>";
	for($i=0;$i<$temp['numcampos'];$i++){
		$html.="<tr> <td>".$temp[$i]['fecha']."</td> <td>".$temp[$i]['eps']."</td> <td>".$temp[$i]['cedula']."</td> <td>".$temp[$i]['nombres']."</td> <td>".$temp[$i]['apellidos']."</td> <td>".$temp[$i]['doctor']."</td> <td>".$temp[$i]['formulacion_medica']."</td> <td>".$temp[$i]['tipo_servicio']."</td> </tr>";
	}
	$html.="</table>";
	
	if($temp['numcampos']){
		echo $html;
	}
}

function modificar_temp($idformato,$iddoc){
	$usuario_actual=usuario_actual("idfuncionario");
	$fecha_actual=date("Y-m-d H:i:s");
	$update="UPDATE temp_citas_ejecutadas SET fecha_remicion='".$fecha_actual."',funcionario_remitio=".$usuario_actual." WHERE idtemp_citas_ejecutadas IN (".$_REQUEST['citas_remitidas'].")";
	phpmkr_query($update);
	abrir_url($ruta_db_superior."pantallas/buscador_principal.php?idbusqueda=41","centro");
}




?>