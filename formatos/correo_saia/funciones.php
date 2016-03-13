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


function recibir_datos($idformato, $iddoc){
	global $ruta_db_superior, $conn;
	$datos_correo = json_decode($_REQUEST['datos_correo']);
	$asunto = $datos_correo->asunto;
	$contenido = $datos_correo->contenido;
	$de = $datos_correo->from;
	$para = $datos_correo->to;
  $fecha= $datos_correo->fecha_oficio_entrada;
	$anexos = $datos_correo->anexos;
  $cadena_anexos='';
  if($anexos){
    $cadena_anexos='<tr><td class="encabezado">Anexos</td><td>';
    $cadena_anexos.="<ul><li>".implode("</li><li>",explode(",",$anexos))."</li>";
    $cadena_anexos.="</td></tr>";
  }
?>
<script type="text/javascript">
	$(document).ready(function(){
			$('#asunto').val('<?php echo($asunto);?>');
			$('#de').val('<?php echo($de);?>');
			$('#para').val('<?php echo($para);?>');
			$('input[name=anexos]').val('<?php echo($anexos);?>');
			$('#fecha_oficio_entrada').val('<?php echo($fecha);?>');
			$("#formulario_formatos").find("tr:last").prev().prev().after('<?php echo($cadena_anexos);?>');
	});
</script>
<?php
}
function guardar_anexos($idformato, $iddoc){
	  
	  require_once($ruta_db_superior."anexosdigitales/funciones_archivo.php");    
    //require_once($ruta_db_superior."pantallas/lib/librerias_adicionales.php");
    //require_once($ruta_db_superior."pantallas/ocr/librerias.php");
    
    $datos=busca_filtro_tabla('','ft_correo_saia','documento_iddocumento='.$iddoc,'',$conn);
    $vector=explode(',',$datos[0]['anexos']);
    //$vector=$datos[0]['anexos'];
	//print_r($vector);
    
    for($i=0;$i<count($vector);$i++){
        $dir_anexos=selecciona_ruta_anexos("",$iddoc,'archivo');
		//print_r($dir_anexos."-----");
        
        $ruta_real=array('');
        $ruta_real[1]=$vector[$i];
     
        //$ruta_real[1]='index.jpeg';
        $archivo_actual = basename($ruta_db_superior.$ruta_real[1]);    
        $vec_ext=explode('.',$archivo_actual);
        $extencion=$vec_ext[1];
        $nombre_temporal=time().".".$extencion;
        mkdir($ruta_db_superior.$dir_anexos,0777);
        
          $tmpVar = 1;
            while(file_exists($ruta_db_superior.$dir_anexos. $tmpVar . '_' . $nombre_temporal)){
                $tmpVar++;
            }
          $nombre_temporal=$tmpVar . '_' . $nombre_temporal;    
                  
        //copy($ruta_db_superior.$ruta_real[1],$ruta_db_superior.$dir_anexos.$nombre_temporal);
		rename($ruta_db_superior.$ruta_real[1], $ruta_db_superior.$dir_anexos.$nombre_temporal);
		// print_r($ruta_real[1]."-------");
// 		
		// print_r($dir_anexos);
        
 $sql="INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta,fecha_anexo,formato,campos_formato) values(".$iddoc.",'".$dir_anexos.$nombre_temporal."','".$extencion."','".$archivo_actual."'".",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'".$idformato."','7358')";        
         phpmkr_query($sql,$conn);
        $idanexo=phpmkr_insert_id();
        
        $sql1="insert into permiso_anexo(anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_total)values('".$idanexo."', '".usuario_actual('idfuncionario')."', 'lem', 'l')";
        phpmkr_query($sql1);
          /*  DESARROLLO NUEVA TABLA anexos_adicionales  */

    }
}
?>