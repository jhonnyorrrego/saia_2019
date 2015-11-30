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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery("1.7"));
echo(librerias_notificaciones());

$iddoc=@$_REQUEST["iddoc"];
$documento=busca_filtro_tabla(fecha_db_obtener('a.fecha','Y-m-d')." as x_fecha, a.*","documento a","a.iddocumento=".$iddoc,"",$conn);
$formato=busca_filtro_tabla("","formato a","lower(a.nombre)='".strtolower($documento[0]["plantilla"])."'","",$conn);
if($formato[0]["mostrar_pdf"]==1){
	$ruta_documento=$ruta_db_superior."pantallas/documento/visor_documento.php?iddoc=".$iddoc;
}
else{
	$ruta_documento=$ruta_db_superior."formatos/".$formato[0]["nombre"]."/".$formato[0]["ruta_mostrar"]."?iddoc=".$iddoc."&idformato=".$formato[0]["idformato"];
}
if($documento[0]["estado"]=='ACTIVO'){
	?>
	<script>
	$(document).ready(function(){
	   notificacion_saia('El documento esta en borrador','warning','',3000);
	   window.open("<?php echo($ruta_documento); ?>","_self");
	});
	</script>
	<?php
	die();
}

$version=version_documento($documento);
version_vista($documento,$version);
version_anexos($documento,$version);
version_pagina($documento,$version);
actualizar_documento($documento,$version);

?>
<script>
$(document).ready(function(){
   notificacion_saia('Version creada con exito','success','',3000);
   window.open("<?php echo($ruta_documento); ?>","_self");
});
</script>
<?php

function version_documento($documento){
    global $conn, $ruta_db_superior;
    $ruta=generar_pdf($documento);
    $busqueda=busca_filtro_tabla("max(a.version) as maximo","version_documento a","a.documento_iddocumento=".$documento[0]["iddocumento"],"",$conn);
    $consecutivo=0;
    if($busqueda["numcampos"])$consecutivo=$busqueda[0]["maximo"]+1;
    
		$arreglo_fecha=explode("-",$documento[0]["x_fecha"]);
    $origen=$ruta;
    $destino=RUTA_PDFS.$documento[0]["estado"]."/".$arreglo_fecha[0]."-".$arreglo_fecha[1]."/".$documento[0]["iddocumento"]."/versiones/version".$consecutivo."/pdf/";
    crear_destino($ruta_db_superior.$destino);
    $nombre_archivo=basename($origen);
    copy($ruta_db_superior.$origen,$ruta_db_superior.$destino.$nombre_archivo);
    
    $sql1="insert into version_documento(documento_iddocumento,fecha,funcionario_idfuncionario,version,pdf)values('".$documento[0]["iddocumento"]."', ".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').", '".usuario_actual('idfuncionario')."', '".$consecutivo."', '".$destino.$nombre_archivo."')";
    phpmkr_query($sql1);
    $id=phpmkr_insert_id();
    return($id);
}
function version_vista($documento,$id){
    global $conn, $ruta_db_superior, $formato;
		
    $busqueda=busca_filtro_tabla("max(a.version) as maximo","version_documento a","a.documento_iddocumento=".$documento[0]["iddocumento"],"",$conn);
		
		$arreglo_fecha=explode("-",$documento[0]["x_fecha"]);
    $consecutivo=$busqueda[0]["maximo"];
		
    $destino=RUTA_PDFS.$documento[0]["estado"]."/".$arreglo_fecha[0]."-".$arreglo_fecha[1]."/".$documento[0]["iddocumento"]."/versiones/version".$consecutivo."/vistas/";
    
    $vistas=busca_filtro_tabla("","vista_formato a","a.formato_padre=".$formato[0]["idformato"],"",$conn);
		if($vistas["numcampos"]){
			crear_destino($ruta_db_superior.$destino);
		}
		
    for($i=0;$i<$vistas["numcampos"];$i++){
    	$ruta=generar_pdf_vista($documento,$vistas[$i]["idvista_formato"]);
			$origen=$ruta;
			
      $nombre_archivo=basename($origen);
      copy($ruta_db_superior.$origen,$ruta_db_superior.$destino.$nombre_archivo);
			
      $sql1="insert into version_vista(documento_iddocumento,pdf,fk_idversion_documento)values('".$documento[0]["iddocumento"]."', '".$destino.$nombre_archivo."', '".$id."')";
      phpmkr_query($sql1);
    }
}
function version_anexos($documento,$id){
    global $conn, $ruta_db_superior;
    $busqueda=busca_filtro_tabla("max(a.version) as maximo","version_documento a","a.documento_iddocumento=".$documento[0]["iddocumento"],"",$conn);
		
		$arreglo_fecha=explode("-",$documento[0]["x_fecha"]);
    $consecutivo=$busqueda[0]["maximo"];
    $destino=RUTA_PDFS.$documento[0]["estado"]."/".$arreglo_fecha[0]."-".$arreglo_fecha[1]."/".$documento[0]["iddocumento"]."/versiones/version".$consecutivo."/anexos/";
    
    $anexos=busca_filtro_tabla("","anexos a","a.documento_iddocumento=".$documento[0]["iddocumento"],"",$conn);
		if($anexos["numcampos"]){
			crear_destino($ruta_db_superior.$destino);
		}
		
    for($i=0;$i<$anexos["numcampos"];$i++){
        $origen=$anexos[$i]["ruta"];
        $nombre_archivo=basename($anexos[$i]["ruta"]);
        copy($ruta_db_superior.$origen,$ruta_db_superior.$destino.$nombre_archivo);
        
        $sql1="insert into version_anexos(documento_iddocumento,ruta,fk_idversion_documento,anexos_idanexos)values('".$documento[0]["iddocumento"]."', '".$destino.$nombre_archivo."', '".$id."', '".$anexos[$i]["idanexos"]."')";
        phpmkr_query($sql1);
    }
}
function version_pagina($documento,$id){
    global $conn, $ruta_db_superior;
    $busqueda=busca_filtro_tabla("max(a.version) as maximo","version_documento a","a.documento_iddocumento=".$documento[0]["iddocumento"],"",$conn);
		
		$arreglo_fecha=explode("-",$documento[0]["x_fecha"]);
    $consecutivo=$busqueda[0]["maximo"];
    $destino1=RUTA_PDFS.$documento[0]["estado"]."/".$arreglo_fecha[0]."-".$arreglo_fecha[1]."/".$documento[0]["iddocumento"]."/versiones/version".$consecutivo."/documentos/";
    $destino2=RUTA_PDFS.$documento[0]["estado"]."/".$arreglo_fecha[0]."-".$arreglo_fecha[1]."/".$documento[0]["iddocumento"]."/versiones/version".$consecutivo."/miniaturas/";
    
    $pagina=busca_filtro_tabla("","pagina a","a.id_documento=".$documento[0]["iddocumento"],"",$conn);
    if($pagina["numcampos"]){
    	crear_destino($ruta_db_superior.$destino1);
			crear_destino($ruta_db_superior.$destino2);
    }
    
    for($i=0;$i<$pagina["numcampos"];$i++){
        $origen=$pagina[$i]["ruta"];
        $origen2=$pagina[$i]["imagen"];
        $nombre_archivo=basename($pagina[$i]["ruta"]);
        $miniatura=basename($pagina[$i]["imagen"]);
        copy($ruta_db_superior.$origen,$ruta_db_superior.$destino1.$nombre_archivo);
        copy($ruta_db_superior.$origen2,$ruta_db_superior.$destino2.$miniatura);
        
        $sql1="insert into version_pagina(documento_iddocumento,ruta,ruta_miniatura,fk_idversion_documento, pagina_idpagina)values('".$documento[0]["iddocumento"]."', '".$destino1.$nombre_archivo."', '".$destino2.$miniatura."','".$id."', '".$pagina[$i]["consecutivo"]."')";
        phpmkr_query($sql1);
    }
}
function actualizar_documento($documento,$id){
    global $conn;
    $sql1="update documento set fk_idversion_documento='".$id."' where iddocumento=".$documento[0]["iddocumento"];
    phpmkr_query($sql1);
}
function generar_pdf($documento){
	$iddoc=$documento[0]["iddocumento"];
    
  $exportar_pdf=busca_filtro_tabla("valor","configuracion A","A.nombre='exportar_pdf'","",$conn);
  if($exportar_pdf[0]["valor"]=='html2ps'){
	  $export="exportar_impresion.php?iddoc=".$iddoc."&plantilla=".strtolower($documento[0]["plantilla"]);
  }
  else if($exportar_pdf[0]["valor"]=='class_impresion'){
  	$export="class_impresion.php?iddoc=".$iddoc;
  }
  else{
  	$export="exportar_impresion.php?iddoc=".$iddoc."&plantilla=".strtolower($documento[0]["plantilla"]);
  }
  $sql1="update documento set pdf=null where iddocumento=".$iddoc;
	phpmkr_query($sql1);
  
  $ch = curl_init();
	//$fila = "http://".RUTA_PDF_LOCAL."/html2ps/public_html/demo/html2ps.php?plantilla=".strtolower($datos_formato[0]["nombre_formato"])."&iddoc=".$iddoc."&conexion_remota=1";
	$fila = "http://".RUTA_PDF_LOCAL."/".$export."&LOGIN=".$_SESSION["LOGIN".LLAVE_SAIA]."&usuario_actual=".$_SESSION["usuario_actual"]."&LLAVE_SAIA=".LLAVE_SAIA;
	
	curl_setopt($ch, CURLOPT_URL,$fila); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	
	curl_setopt($ch, CURLOPT_VERBOSE, true); 
	curl_setopt($ch, CURLOPT_STDERR, $abrir);
	
	$contenido=curl_exec($ch);
	
	curl_close ($ch);
	
	$datos_documento=busca_filtro_tabla(fecha_db_obtener('A.fecha','Y-m-d')." as x_fecha, A.*","documento A","A.iddocumento=".$iddoc,"",$conn);
	
	$fecha=explode("-", $datos_documento[0]["x_fecha"]);
	$ruta=RUTA_PDFS.$datos_documento[0]["estado"]."/".$fecha[0]."-".$fecha[1]."/".$datos_documento[0]["iddocumento"]."/pdf/";
	$ruta.=($datos_documento[0]["plantilla"])."_".$datos_documento[0]["numero"]."_".str_replace("-","_",$datos_documento[0]["x_fecha"]).".pdf";
	return($ruta);
}
function generar_pdf_vista($documento,$vista){
	$iddoc=$documento[0]["iddocumento"];
    
  $exportar_pdf=busca_filtro_tabla("valor","configuracion A","A.nombre='exportar_pdf'","",$conn);
  if($exportar_pdf[0]["valor"]=='html2ps'){
	  $export="exportar_impresion.php?iddoc=".$iddoc."&plantilla=".strtolower($documento[0]["plantilla"]);
  }
  else if($exportar_pdf[0]["valor"]=='class_impresion'){
  	$export="class_impresion.php?iddoc=".$iddoc;
  }
  else{
  	$export="exportar_impresion.php?iddoc=".$iddoc."&plantilla=".strtolower($documento[0]["plantilla"]);
  }
    
  $ch = curl_init();
	$fila = "http://".RUTA_PDF_LOCAL."/".$export."&LOGIN=".$_SESSION["LOGIN".LLAVE_SAIA]."&usuario_actual=".$_SESSION["usuario_actual"]."&LLAVE_SAIA=".LLAVE_SAIA."&vista=".$vista;
	
	curl_setopt($ch, CURLOPT_URL,$fila); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	
	curl_setopt($ch, CURLOPT_VERBOSE, true); 
	curl_setopt($ch, CURLOPT_STDERR, $abrir);
	
	$contenido=curl_exec($ch);
	
	curl_close ($ch);
	
	$datos_documento=busca_filtro_tabla(fecha_db_obtener('A.fecha','Y-m-d')." as x_fecha, A.*","documento A","A.iddocumento=".$iddoc,"",$conn);
	
	$fecha=explode("-", $datos_documento[0]["x_fecha"]);
	$ruta=RUTA_PDFS.$datos_documento[0]["estado"]."/".$fecha[0]."-".$fecha[1]."/".$datos_documento[0]["iddocumento"]."/pdf/";
	$ruta.=($datos_documento[0]["plantilla"])."_".$datos_documento[0]["numero"]."_".str_replace("-","_",$datos_documento[0]["x_fecha"])."_vista".$vista.".pdf";
	return($ruta);
}
?>