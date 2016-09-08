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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."pantallas/documento/librerias.php");
//MOSTRAR
function mostrar_datos_solicita_afiliacion($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.datos_solicitante","ft_solicitud_afiliacion A","A.documento_iddocumento=".$iddoc,"",$conn);
	$solicitante=busca_filtro_tabla("A.direccion, A.telefono, B.nombre, B.identificacion","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$datos[0]['datos_solicitante'],"",$conn);
	
	$tabla_info='<b>Nombre:</b> '.$solicitante[0]['nombre'].'<br/>';
	$tabla_info.='<b>Identificación:</b> '.$solicitante[0]['identificacion'].'<br/>';
	$tabla_info.='<b>Dirección:</b> '.$solicitante[0]['direccion'].'<br/>';
	$tabla_info.='<b>Teléfono:</b> '.$solicitante[0]['telefono'].'<br/>';
	//print_r($solicitante);
	echo($tabla_info);
}
function  generar_codigo_qr_afiliacion($idformato,$iddoc){
  global $conn,$ruta_db_superior;
	include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
  $codigo_qr = busca_filtro_tabla("ruta_qr, iddocumento_verificacion","documento_verificacion","documento_iddocumento=".$iddoc,"", $conn);	
  $datos = busca_filtro_tabla("A.fecha,A.estado,A.numero","documento A","A.iddocumento=".$iddoc,"",$conn);  
  
	$documento=busca_filtro_tabla("","ft_solicitud_afiliacion A","A.documento_iddocumento=".$iddoc,"",$conn);
	
	$fecha=date_parse($datos[0]['fecha']);
	$datos_qr="";
	$datos_qr.=$documento[0]["idft_solicitud_afiliacion"];
	$ruta=RUTA_QR.$datos[0]['estado'].'/'.date('Y-m').'/'.$iddoc.'/qr/';
	$imagen=generar_qr_afiliacion($ruta,$datos_qr);

	if($imagen == false){
	  alerta("Error al tratar de crear el codigo qr");
	}
	else{
	  $codigo_hash=obtener_codigo_hash_archivo($imagen,'crc32'); 
	  $sql_documento_qr="INSERT INTO documento_verificacion(documento_iddocumento,funcionario_idfuncionario,fecha,ruta_qr,verificacion,codigo_hash) VALUES (".$iddoc.",".usuario_actual('idfuncionario').",".fecha_db_almacenar(date("Y-m-d H:m:s"),'Y-m-d H:i:S').",'".$imagen."','vacio','".$codigo_hash."')";	  	  
	  phpmkr_query($sql_documento_qr);	  	 
	}
}

function generar_qr_afiliacion($filename,$datos,$matrixPointSize = 2,$errorCorrectionLevel = 'Q'){      
	global $ruta_db_superior;
	include_once ($ruta_db_superior."phpqrcode/qrlib.php");
	if ($datos){        
		if(trim($datos) == ''){          
			return false;
		}
		else{                              
			crear_destino($ruta_db_superior.$filename);
			$filename .= 'qr'.date('Y_m_d_H_m_s').'.png'; 
			if(file_exists($ruta_db_superior.$filename)){
			}
			QRcode::png($datos,$ruta_db_superior.$filename, $errorCorrectionLevel, $matrixPointSize, 0);      
			return $filename;
		}  
	}
	else{          
		return false;
	}     
}
function imagenes_digitalizadas_funcion_afiliacion($idformato,$iddoc){
	global $conn, $ruta_db_superior;
	$paginas=busca_filtro_tabla("","pagina a","id_documento=".$iddoc,"consecutivo asc",$conn);
	if($paginas["numcampos"]){
		$tabla='';
		?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
  <link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
  <script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><?php
		$tabla.='<table>';
		$tabla.='<tr>';
		for($i=0;$i<$paginas["numcampos"];$i++){
			$tabla.='<td><a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 500, height: 500,preserveContent:false} )" href="'.$ruta_db_superior.$paginas[$i]["ruta"].'"><img border="1px" style="border-collapse:collapse" src="'.$ruta_db_superior.$paginas[$i]["imagen"].'"></a></td>';
			if(($i%4)==0&&$i<>0)$tabla.='</tr><tr>';
		}
		$tabla.='</tr>';
		$tabla.='</table>';
		echo $tabla;
	}
	$anexos=busca_filtro_tabla("","anexos a","documento_iddocumento=".$iddoc." AND tipo in('jpg','png','gif')","",$conn);
	if($anexos["numcampos"]){
		$tabla='';
		?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
  <link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
  <script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><?php
		
		$tabla.='<table>';
		$tabla.='<tr>';
		for($i=0;$i<$anexos["numcampos"];$i++){
			if($_REQUEST['carga_highslide']){				
			}else{
				$tabla.='<td><a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 500, height: 500,preserveContent:false} )" href="'.$ruta_db_superior.$anexos[$i]["ruta"].'"><img border="1px" style="border-collapse:collapse;width:90px;height:80px" src="'.$ruta_db_superior.$anexos[$i]["ruta"].'"></a></td>';
			if(($i%4)==0&&$i<>0)$tabla.='</tr><tr>';
			}
			
		}
		$tabla.='</tr>';
		$tabla.='</table>';
		echo $tabla;
	}
}
?>