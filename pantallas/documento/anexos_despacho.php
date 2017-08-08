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
include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
require_once($ruta_db_superior . 'StorageUtils.php');
require_once($ruta_db_superior . 'filesystem/SaiaStorage.php');

echo (librerias_jquery("1.7"));  
echo(librerias_notificaciones());
echo(estilo_bootstrap());

function cargar_anexos_documento_despacho($datos_documento,$anexos){
	global $conn,$ruta_db_superior;
	$funcionario = busca_filtro_tabla("idfuncionario","funcionario","funcionario_codigo=".$datos_documento["funcionario_codigo"],"",$conn);
	$formato_ruta = aplicar_plantilla_ruta_documento($datos_documento["iddocumento"]);
	
  $tipo_almacenamiento = new SaiaStorage("archivos");
	foreach ($anexos as $key => $value) {
		$ruta = $formato_ruta ."/anexos";

		$extencion = pathinfo($value['filename']);
		$ruta .= "/".rand().".".$extencion["extension"];		
		$contenido = base64_decode($value['content']);
		$tipo_almacenamiento->almacenar_contenido($ruta,$contenido);
		
		if($tipo_almacenamiento->get_filesystem()->has($ruta)){
		  $ruta_alm = array('servidor' => $tipo_almacenamiento->get_ruta_servidor(), "ruta" => $ruta);
      $ruta_alm=json_encode($ruta_alm);
      
			$insert_anexo = "insert into anexos(documento_iddocumento, ruta, etiqueta, tipo, formato,fecha_anexo) VALUES (".$datos_documento["iddocumento"].",'".$ruta_alm."','".$value['filename']."','".$extencion["extension"]."',".$datos_documento["idformato"].",".fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s').")";
			phpmkr_query($insert_anexo,$conn,$datos_documento["funcionario_codigo"]);
			$idnexo = phpmkr_insert_id();
			$insert_permiso = "insert into permiso_anexo (anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_dependencia, caracteristica_cargo, caracteristica_total) VALUES (".$idnexo.",".$funcionario[0]["idfuncionario"].",'lem', '', '', 'l')";
			phpmkr_query($insert_permiso,$conn,$datos_documento["funcionario_codigo"]);
			$idnexo_permiso = phpmkr_insert_id();
			if($idnexo_permiso=='' && $idnexo==''){
				die("Error");
			}
		}
	}
}
?>

<html>
<head>
<script src="multiple-file-upload/jquery-1.2.6.js" type="text/javascript"></script>
<script type="text/javascript" src="multiple-file-upload/jquery.MultiFile_DOC.js"></script>
<script type="text/javascript" src="highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
	hs.graphicsDir = 'highslide-4.0.10/highslide/graphics/';
	hs.outlineType = 'rounded-white'; 
</script>
</head>
<body>

<?php
$config = busca_filtro_tabla("valor", "configuracion", "nombre='color_encabezado'", "", $conn);
if ($config["numcampos"]) {  $style = "
     <style type=\"text/css\">
     <!--INPUT, TEXTAREA, SELECT 
     {
        font-family: Verdana,Tahoma,arial; 
        font-size: 10px; 
        /*text-transform:Uppercase;*/
       } 
       .phpmaker 
       {
       font-family: Verdana,Tahoma,arial; 
       font-size: 9px; 
       /*text-transform:Uppercase;*/
       } 
       .encabezado 
       {
       background-color:" . $config[0]["valor"] . "; 
       color:white ; 
       padding:10px; 
       text-align: left;	
       } 
       .encabezado_list 
       { 
       background-color:" . $config[0]["valor"] . "; 
       color:white ; 
       vertical-align:middle;
       text-align: center;
       font-weight: bold;	
       }
       table thead td 
       {
		    font-weight:bold;
    		cursor:pointer;
    		background-color:" . $config[0]["valor"] . ";
    		text-align: center;
        font-family: Verdana,Tahoma,arial; 
        font-size: 9px;
        /*text-transform:Uppercase;*/
        vertical-align:middle;    
    	 }
    	 table tbody td 
       {	
    		font-family: Verdana,Tahoma,arial; 
        font-size: 9px;
    	 }
       -->
       </style>";
	echo $style;
}
if($_REQUEST['docs']){
	$documento=$_REQUEST['docs'];
}

if(isset($_REQUEST["Adicionar"])){
					
				
			
		
	
		$permisos = $_REQUEST["permisos_anexos"];
		$documento=$_REQUEST['key'];
		$iddoc=explode(",",$documento);
		$array_anexos = array();
		foreach ($_FILES["anexos"]["name"] as $key => $value) {
			if($_FILES["anexos"]["tmp_name"][$key]){
				$tmpfile  = $_FILES["anexos"]["tmp_name"][$key];   // temp filename		
				$filename = $_FILES["anexos"]["name"][$key];      // Original filename
				$handle   = fopen($tmpfile, "r");                  // Open the temp file
				$contents = fread($handle, filesize($tmpfile));  // Read the temp file
		  	fclose($handle);                                 // Close the temp file
		  	$decodeContent = base64_encode($contents);
				$array_anexos[$key] = array(
				 "filename"  => $filename,
				 "content"   => $decodeContent,
				 "extencion" => $_FILES["anexos"]["type"][$key]
			 );					
			} 	
		}
		$info_anexo['anexos'] = $array_anexos;
		$j=0;
		for($i=0;$i<count($iddoc);$i++){
			if($iddoc[$i]){
				$info_doc=busca_filtro_tabla("d.estado,".fecha_db_obtener("d.fecha","Y-m")." as fecha,d.ejecutor,d.plantilla","documento d","d.iddocumento=".$iddoc[$i],"",$conn);
				$idformato=busca_filtro_tabla("","formato","lower(nombre) like '".strtolower($info_doc[0]['plantilla'])."'","",$conn);
				if($iddoc[$i] && sizeof($info_anexo['anexos'])){
					$datos_anexo=array();
					$datos_anexo['funcionario_codigo']=usuario_actual('funcionario_codigo');
					$datos_anexo['iddocumento']=$iddoc[$i];
					$datos_anexo["fecha"]=$info_doc[0]['fecha'];
					$datos_anexo["estado"]=$info_doc[0]['estado'];
					$datos_anexo["idformato"]=$idformato[0]["idformato"];
					$info = cargar_anexos_documento_despacho($datos_anexo,$info_anexo['anexos']);
				}
				$documento_mns = busca_filtro_tabla("descripcion,plantilla,ejecutor,numero", "documento", "iddocumento=".$iddoc[$i], "", $conn);
				$datos["origen"] = usuario_actual("funcionario_codigo");
				$datos["archivo_idarchivo"] = $iddoc[$i];
				$datos["tipo_destino"] = 1;
				$datos["tipo"] = "";
				$datos["nombre"] = "DISTRIBUCION";
				$otros["notas"] = "'Soporte de entrega'";
				transferir_archivo_prueba($datos, array($documento_mns[0]["ejecutor"]), $otros);
				$j++;
			}
		}
	?>
		<script>
			window.parent.hs.close();
		</script>
	<?php
	if($j==$i){
		alerta("Soportes cargados correctamente");
	}
	abrir_url($ruta_db_superior."pantallas/buscador_principal.php?idbusqueda=34","centro");
}
$validaciones = busca_filtro_tabla("valor", "configuracion", "nombre='extensiones_upload'", "", $conn);
$adicional = "";
if ($validaciones[0]["valor"]){
	$adicional = 'accept="' . $validaciones[0]["valor"] . '"';
}


$config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn);
?>
<br>
<div >
	<div style="font-size: 12px;font-weight:bold;color:<?php echo($config[0]['valor']); ?>;">Adicionar Anexos</div>
<hr>	
<form action="anexos_despacho.php" method="POST" enctype="multipart/form-data" >
<input type="hidden" value="" id="permisos_anexos" name="permisos_anexos"/>
<input type="hidden" value="<?php echo $documento; ?>" id="key" name="key"/>
<input type="hidden" value="" id="idcampo" name="idcampo"/>
<input type="hidden" value="centro" id="frame" name="frame"/>

<table width="100%;" border='0' cellspacing=2 cellpadding=2>

	<tr>
		<td class="celda_transparente" style="vertical-align:top; color:black; ">
			<b>Anexo:</b>
		</td>
		<td class="celda_transparente" align='center' style="vertical-align:middle;">
			<input type="file" name="anexos[]" class="multi" <?php echo($adicional); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2" style='text-align:center; vertical-align:middle;'>
			<br>
			<input type="submit" value="Adicionar" name="Adicionar">
		</td>
	</tr>
</table>
</form>
</div>
</body>
</html>

<script>
	$(document).ready(function(){
		$('[name="Adicionar"]').click(function(){
			$.ajax({
                type:'POST',
                dataType: 'json',
                async:false,
                url: "<?php echo($ruta_db_superior); ?>bpmn/paso/terminar_actividad_despacho.php",
                data: {
	                iddocs:'<?php echo($documento); ?>',
	                accion:'despacho_documento'
                },
                success: function(datos){
						
            	}
        	}); 			
		});
	});
</script>
