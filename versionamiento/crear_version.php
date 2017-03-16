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
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery("1.7"));
/*<Clase>
<Nombre></Nombre>
<Parametros>$_REQUEST["key"]: id del documento</Parametros>
<Responsabilidades>Calcula el numero de versi�n que sigue y llama la funcion que crea el pdf del documento<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */

if(isset($_REQUEST["key"])&&$_REQUEST["key"]){
	
	$doc=busca_filtro_tabla("lower(plantilla) as plantilla","documento","iddocumento=".$_REQUEST["key"],"",$conn);	
	
	$formato=busca_filtro_tabla("nombre_tabla,nombre","formato","lower(nombre)='".strtolower($doc[0][0])."'","",$conn);	
 
	//busca un campo llamado "version_".$formato[0]["nombre"] para tomar de ahi la version
	
	$version_actual=busca_filtro_tabla("version_".$formato[0]["nombre"],$formato[0]["nombre_tabla"],"documento_iddocumento=".$_REQUEST["key"],"",$conn);	
	
	
	//print_r($version_actual);
	//die();
	
	$version=1;
	
	if($version_actual["numcampos"]){
		if($version_actual[0][0]==""){
			$version=1;
		}else{
			$version=intval($version_actual[0][0])+1; 
		}
		
		$sql="update ".$formato[0]["nombre_tabla"]." set "."version_".$formato[0]["nombre"]."='$version' where documento_iddocumento=".$_REQUEST["key"];
		
		phpmkr_query($sql,$conn);
	}else{ //si el campo version... no existe mira que versiones hay creadas y contin�a con la que sigue
		while(is_file($ruta_db_superior."../versiones/".$_REQUEST["key"]."/archivos_version".$version.".zip")){
			$version ++;      
		}
	}  
	
	if($_SESSION["LOGIN".LLAVE_SAIA] == '0k'){
		//print_r($version);
		//die();
	}
?>
<script type='text/javascript'>
$(document).ready(function(){	
	$.ajax({
		type: "POST",
		url: "http://".RUTA_PDF."/saia/html2ps/public_html/demo/html2ps.php",
		dataType: 'json',
		data: {
			plantilla: "<?php echo($doc[0]["plantilla"]); ?>",
			iddoc : "<?php echo($_REQUEST["key"]); ?>",
			versionamiento: "<?php echo($version); ?>",
			no_redirecciona: "<?php echo($_REQUEST['no_redirecciona']); ?>"			
		},
		async: false ,
		success: function(msg){	
			window.location="<?php echo(PROTOCOLO_CONEXION.RUTA_PDF); ?>/versionamiento/crear_version.php?doc="+msg['iddoc']+"&pdf="+msg['pdf']+"&version="+msg['versionamiento']+"&no_redirecciona="+msg['no_redirecciona']+"&eliminar_anexo=<?php echo($_REQUEST['eliminar_anexo'])?>";
		}
	});
});
</script>
<?php
}elseif(isset($_REQUEST["pdf"])&&$_REQUEST["pdf"]){

/*<Clase>
<Nombre></Nombre>
<Parametros>$_REQUEST["pdf"]: ruta del pdf del documento</Parametros>
<Responsabilidades>copia las paginas, los anexos y el pdf del documento en una carpeta, hace el llamado a la funcion comprimir<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida>redirecciona a la pagina que muestra la lista de las versiones disponibles</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
 
	$archivo=str_replace("../","",$_REQUEST["pdf"]);
	$archivo=$ruta_db_superior."../".$archivo;

	if(is_file($archivo) && filesize($archivo)){
		if(!is_dir($ruta_db_superior."../versiones")){
			//mkdir($ruta_db_superior."../versiones",PERMISOS_CARPETAS);
			crear_destino($ruta_db_superior."../versiones");
		}
		
		//chmod($ruta_db_superior."../versiones",PERMISOS_CARPETAS);
		
		if(!is_dir($ruta_db_superior."../versiones/".$_REQUEST["doc"])){
			//mkdir($ruta_db_superior."../versiones/".$_REQUEST["doc"],PERMISOS_CARPETAS);
			crear_destino($ruta_db_superior."../versiones/".$_REQUEST["doc"]);
			chmod($ruta_db_superior."../versiones/".$_REQUEST["doc"],PERMISOS_CARPETAS);
		}
		
		$ruta=$ruta_db_superior."../versiones/".$_REQUEST["doc"]."/".$_REQUEST["version"];	
		
		if(!is_dir($ruta)){
			//mkdir($ruta,PERMISOS_CARPETAS);
			crear_destino($ruta);
			chmod($ruta,PERMISOS_CARPETAS);
		}
    
		if(is_dir($ruta)){// echo $archivo;
      
			if(copy($archivo,$ruta."/doc".$_REQUEST["doc"].".pdf")){
				
				$anexos=busca_filtro_tabla("","anexos","documento_iddocumento=".$_REQUEST["doc"],"",$conn);
				
				for($i=0;$i<$anexos["numcampos"];$i++){					
					if(!copy($ruta_db_superior.$anexos[$i]["ruta"],$ruta."/anexos_".$anexos[$i]["etiqueta"])){
						echo "Error al copiar el anexo ".$anexos[$i]["etiqueta"];
					}
				}
				
				$paginas=busca_filtro_tabla("","pagina","id_documento=".$_REQUEST["doc"],"",$conn);      
				//print_r($paginas);
				
				
				for($i=0;$i<$paginas["numcampos"];$i++){
					copy($ruta_db_superior.$paginas[$i]["ruta"],$ruta."/pagina_".basename($paginas[$i]["ruta"]).".jpg");
					
					copy($ruta_db_superior.$paginas[$i]["imagen"],$ruta."/miniatura_".basename($paginas[$i]["imagen"]).".jpg");
					
				}  

				$sql="insert into documento_version(documento_iddocumento,funcionario,numero_version,fecha) values('".$_REQUEST["doc"]."',".usuario_actual("funcionario_codigo").",'".$_REQUEST["version"]."',".fecha_db_almacenar("","Y-m-d H:i:s").")";	
				
				phpmkr_query($sql,$conn);
				
				
				
				comprimir("version".$_REQUEST["version"],$ruta);
				
				alerta(codifica_encabezado("Creada versi&oacute;n ".$_REQUEST["version"]));				
				
				
				
				$delete_anexo = "DELETE FROM anexos WHERE idanexos=".$_REQUEST['eliminar_anexo'];
				phpmkr_query($delete_anexo);			
				
				//if($_REQUEST['no_redirecciona'] != 1){
					//redirecciona("listar_versiones.php?key=".$_REQUEST["doc"]);
				//}	

				
				
			}      
		}else{
			echo "Problema al crear las carpetas.";  
		}
	}else{
		echo "Problemas al crear el pdf.";  
	}
}
/*<Clase>
<Nombre>comprimir</Nombre>
<Parametros>$doc:numero de version;$ruta_destino: ruta de la carpeta a comprimir</Parametros>
<Responsabilidades>comprime los archivos de una carpeta en un archivo de extension zip y luego borra la carpeta de donde tom� los archivos<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones>debe estar habilitada la libreria de php que permite comprimir en formato zip<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */

function comprimir($doc,$ruta_destino){
	global $ruta_db_superior; 
	require_once($ruta_db_superior."libreria_zipfile.php");
	
	if($dh = @opendir($ruta_destino)){
		$zipTest = new zipfile();	
		
		while (false !== ($obj = readdir($dh))){ 
			
			if($obj == '.' || $obj == '..'){
				continue; 
			} 
     
			if(is_file($ruta_destino . '/' . $obj)){
				$i=0; 
				$zipTest->add_file($ruta_destino."/".$obj,$obj);
			}  
		} 
		closedir($dh); 
	}  
	
	$filename = "archivos_$doc.zip";
	
	$fd = fopen ($ruta_destino."/../".$filename, "wb"); 
	
	$out = fwrite ($fd, $zipTest -> file()); 
	
	fclose ($fd); 
	
	include_once($ruta_db_superior."tarea_limpiar_carpeta.php");
	
	borrar_archivos_carpeta($ruta_destino,1) ; 
	
	return true;
} 
?>
<script type='text/javascript'>
 /*<Clase>
<Nombre>crear_pdf</Nombre>
<Parametros>doc:id del documento;plantilla:nombre del formato;version:version que se est� creando</Parametros>
<Responsabilidades>crea el pdf del documento y luego llama de nuevo esta pantalla con el nombre del pdf como parametro<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
/*$(document).ready(function(){
	function crear_pdf(doc,plantilla,version){
		$.ajax({
			type: "POST",
			url: "../html2ps/public_html/demo/html2ps.php",
			data: {
				plantilla: plantilla,
				iddoc : doc,
				versionamiento: version
			},
			async: false ,
			success: function(msg){
				console.log(msg);
				info=msg.split("||");
				window.location="crear_version.php?doc="+doc+"&pdf="+info[1]+"&version="+version;
			}
		});  
	}
});*/
</script>