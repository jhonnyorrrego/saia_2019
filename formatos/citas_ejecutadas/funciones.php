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

/*POSTERIOR ADICIONAR*/
function validar_adjunto_csv($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$anexo=busca_filtro_tabla("ruta","anexos","documento_iddocumento=".$iddoc,"",$conn);
	
	$ruta_csv = fopen($ruta_db_superior.$anexo[0][0], "r");
	if ($ruta_csv !== FALSE) {
		$i=1;
		while (($datos = fgetcsv($ruta_csv, 10000)) !== FALSE) {
			$registro=explode(";", $datos[0]);
			if(count($registro)==8){
				$sql[]="INSERT INTO temp_citas_ejecutadas (documento_iddocumento,estado,fecha,eps,cedula,nombres,apellidos,doctor,formulacion_medica,tipo_servicio)	VALUES (".$iddoc.", 1, '".$registro[0]."', '".$registro[1]."', '".$registro[2]."', '".$registro[3]."', '".$registro[4]."', '".$registro[5]."', '".$registro[6]."', '".$registro[7]."')";
			}else{
				$error[]=$i;
			}
			$i++;
		}
	}
	fclose ($ruta_csv);
	if(count($error)>0){
		alerta("Por Favor Revisar los registros");
	}else{
		for($i=0;$i<count($sql);$i++){
			phpmkr_query($sql[$i]);
		}	
	}

}

/*MOSTRAR*/
function mostrar_datos_anexo($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("","temp_citas_ejecutadas","estado=1 and documento_iddocumento=".$iddoc,"",$conn);
	
	$html="<table style='width: 100%; font-size: 10pt; border-collapse: collapse; font-family: arial;' border='1'>";
		$html.="<tr style='font-weight:bold'> <td>Fecha</td> <td>Eps</td> <td>Cedula</td> <td>Nombre Paciente</td> <td>Apellido Paciente</td> <td>Doctor</td> <td>Formulacion Medica</td> <td>Tipo Servicio</td> </tr>";
		for($i=0;$i<$datos['numcampos'];$i++){
			$html.="<tr> <td>".$datos[$i]['fecha']."</td> <td>".$datos[$i]['eps']."</td> <td>".$datos[$i]['cedula']."</td> <td>".$datos[$i]['nombres']."</td> <td>".$datos[$i]['apellidos']."</td> <td>".$datos[$i]['doctor']."</td> <td>".$datos[$i]['formulacion_medica']."</td> <td>".$datos[$i]['tipo_servicio']."</td> </tr>";
		}
	$html.="</table>";
	
	if($datos['numcampos']){
		echo $html;
	}
	
}



?>