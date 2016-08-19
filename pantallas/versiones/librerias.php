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
$ruta_documento=$ruta_db_superior."pantallas/documento/informacion_resumen_documento.php?idformato=".$formato[0]['idformato']."&iddoc=".$iddoc;
if($documento[0]["estado"]=='ACTIVO'){
	?>
	<script>
	$(document).ready(function(){
	   notificacion_saia('El documento esta en borrador','warning','',3000);
	   window.open("<?php echo($ruta_documento); ?>","arbol_formato");
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
   window.open("<?php echo($ruta_documento); ?>","arbol_formato");
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
    generar_version_json($documento[0]["iddocumento"]);
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



function generar_version_json($iddoc){
    global $conn,$ruta_db_superior;
    
    $formato=busca_filtro_tabla('','formato a, documento b','lower(b.plantilla)=lower(a.nombre) AND iddocumento='.$iddoc,'',$conn);
    
    $json_final=array();
    $json_final[$formato[0]['nombre_tabla']]=obtener_info_version($iddoc,$formato[0]['nombre_tabla'],'documento_iddocumento'); //ft
    $json_final['documento']=obtener_info_version($iddoc,'documento','iddocumento'); //documento
    $json_final['ruta']=obtener_info_version($iddoc,'ruta','documento_iddocumento'); //ruta
    $json_final['buzon_entrada']=obtener_info_version($iddoc,'buzon_entrada','archivo_idarchivo'); //buzon_entrada
    $json_final['buzon_salida']=obtener_info_version($iddoc,'buzon_salida','archivo_idarchivo'); //buzon_salida
    $json_final['anexos']=obtener_info_version($iddoc,'anexos','documento_iddocumento'); //anexos
    $json_final['pagina']=obtener_info_version($iddoc,'pagina','id_documento'); //pagina
    $json_final['almacenamiento']=obtener_info_version($iddoc,'almacenamiento','documento_iddocumento'); //almacenamiento
    $json_final['anexos_despacho']=obtener_info_version($iddoc,'anexos_despacho','documento_iddocumento'); //anexos_despacho
    $json_final['asignacion']=obtener_info_version($iddoc,'asignacion','documento_iddocumento'); //asignacion
    $json_final['comentario_img']=obtener_info_version($iddoc,'comentario_img','documento_iddocumento'); //comentario_img
    $json_final['documento_etiqueta']=obtener_info_version($iddoc,'documento_etiqueta','documento_iddocumento'); //documento_etiqueta
    $json_final['documento_por_vincular']=obtener_info_version($iddoc,'documento_por_vincular','documento_iddocumento'); //documento_por_vincular
    $json_final['documento_verificacion']=obtener_info_version($iddoc,'documento_verificacion','documento_iddocumento'); //documento_verificacion
    $json_final['documento_version']=obtener_info_version($iddoc,'documento_version','documento_iddocumento'); //documento_version
    $json_final['expediente_doc']=obtener_info_version($iddoc,'expediente_doc','documento_iddocumento'); //expediente_doc
    $json_final['paso_documento']=obtener_info_version($iddoc,'paso_documento','documento_iddocumento'); //paso_documento
    $json_final['paso_instancia_pendiente']=obtener_info_version($iddoc,'paso_instancia_pendiente','documento_iddocumento'); //paso_instancia_pendiente
    $json_final['paso_instancia_terminada']=obtener_info_version($iddoc,'paso_instancia_terminada','documento_iddocumento'); //paso_instancia_terminada   
    $json_final['permiso_documento']=obtener_info_version($iddoc,'permiso_documento','documento_iddocumento'); //permiso_documento   
    $json_final['prioridad_documento']=obtener_info_version($iddoc,'prioridad_documento','documento_iddocumento'); //prioridad_documento   
    $json_final['reemplazo_documento']=obtener_info_version($iddoc,'reemplazo_documento','documento_iddocumento'); //reemplazo_documento   
    $json_final['salidas']=obtener_info_version($iddoc,'salidas','documento_iddocumento'); //salidas   
    $json_final['version_documento']=obtener_info_version($iddoc,'version_documento','documento_iddocumento'); //version_documento   
    $json_final['version_pagina']=obtener_info_version($iddoc,'version_pagina','documento_iddocumento'); //version_pagina
    $json_final['version_anexos']=obtener_info_version($iddoc,'version_anexos','documento_iddocumento'); //version_anexos
    
    /*
        TABLAS PENDIENTES POR PARAMETRIZAR, HABLAR CON HERNANDO
            - anexos_vinculados
            - documento_vinculados
            - pagina_vinculados
            - paso_instancia_rastro
            - permiso_anexo
            - respuesta
            - tarea
            - tareas
            
        FALTA CREAR ARCHIVO *.json Y ALMACENAR EN LA RUTA DE VERSIONES    
    */
    
    $documento=busca_filtro_tabla(fecha_db_obtener('a.fecha','Y-m-d')." as x_fecha, a.*","documento a","a.iddocumento=".$iddoc,"",$conn);
    $busqueda=busca_filtro_tabla("max(a.version) as maximo","version_documento a","a.documento_iddocumento=".$documento[0]["iddocumento"],"",$conn);
    $consecutivo=0;
    if($busqueda["numcampos"])$consecutivo=$busqueda[0]["maximo"]+1;    
	$arreglo_fecha=explode("-",$documento[0]["x_fecha"]);
    $ruta_json=RUTA_PDFS.$documento[0]["estado"]."/".$arreglo_fecha[0]."-".$arreglo_fecha[1]."/".$documento[0]["iddocumento"]."/versiones/version".$consecutivo."/";
    
    crear_destino($ruta_db_superior.$ruta_json);    
    $ruta_json.='json.json';
    $archivo_json = fopen($ruta_json, "a");
    fwrite($archivo_json, json_encode($json_final));
    fclose($archivo_json);
    
}
function obtener_info_version($iddoc,$nombre_tabla,$llave){
    global $conn;
    
    $campos_tabla=listar_campos_tabla($nombre_tabla); 
    $select=busca_filtro_tabla('',$nombre_tabla,$llave.'='.$iddoc,'',$conn);
    $json=array();
    for($i=0;$i<$select['numcampos'];$i++){
        for($j=0;$j<count($campos_tabla);$j++){
            $json[$i][$campos_tabla[$j]]=$select[$i][$campos_tabla[$j]];
        }
    }    
    return($json);
}



?>