<?php
include_once(dirname(__FILE__)."/../../db.php");
include_once(dirname(__FILE__)."/../../anexosdigitales/funciones_archivo.php");

require_once dirname(__FILE__) . '/../../StorageUtils.php';
require_once dirname(__FILE__) . '/../../filesystem/SaiaStorage.php';

function documento_seleccionado(){
        return($_REQUEST["documento_seleccionado"]);
}

function vista_previa_anexo($idanexo,$tipo){
    switch ($tipo){        
        case "pdf":
            $imagen="";
            $ruta="".$idanexo;
        break;
        case "jpg":
        break;
    }
    return($ruta.$imagen);
}

function descargar_anexo($idanexo,$tipo_al=NULL){   
//Recibe el id del anexo y opcinalmente el id del binario para descargar archivos o desde la bd respectivamente
  global $conn;
   if(!$tipo_al){
   	 // Si no se solicita directamente el origen (BD O ARCHIVO ) se busca en configuracion cual se va a descargar     
     	$config = busca_filtro_tabla("valor","configuracion","nombre='tipo_almacenamiento'","",$conn);
		if ($config["numcampos"]) {
         $tipo_al=$config[0]['valor'];
		} else {
         $tipo_al="archivo"; // Si no encuentra el registro en configuracion almacena en archivo
		}
  }
  if($tipo_al=="archivo"){   	
    $datos=busca_filtro_tabla("","anexos","idanexos=".$idanexo,"",$conn);
		if (! $datos["numcampos"]) {
       alerta('problema con el archivo anexo');
		}
     
		$arr_alm = StorageUtils::resolver_ruta($datos[0]["ruta"]);
		$almacenamiento = $arr_alm["clase"];
		$file_name = $arr_alm["ruta"];
		if (!$almacenamiento->get_filesystem()->has($file_name)) {
			return;
        }
		$file = $almacenamiento->get_filesystem()->get($file_name);
  	header("Content-Type: application/octet-stream");
		header("Content-Size: " . $file->getSize());
  	header("Content-Disposition: attachment; filename=\"".html_entity_decode($datos[0]["etiqueta"])."\"");
		header("Content-Length: " . $file->getSize());
  	header("Content-transfer-encoding: binary");
		echo $file->getContent();
		exit();
	} elseif ($tipo_al == "db") {
   	// almacenamiento binario
   	$anexo=busca_filtro_tabla("ruta","anexos","idanexos='$id'","",$conn);
    $archivo=busca_filtro_tabla("nombre_original,datos","binario","idbinario=".$anexo[0]["ruta"],"",$conn);
		$nomb_limpio = ereg_replace("[^A-Za-z0-9._]", "",$archivo[0]['nombre_original']);
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment; filename=".$nomb_limpio); 	
		echo $archivo[0]['datos'];
		exit();
   }
}

function mostrar_datos_anexos($iddoc){
$anexos=datos_anexos($iddoc);
if($anexos["numcampos"]){
  $idfunc=$_SESSION["usuario_actual"];
  $texto='<table class="table table-bordered">';
  for($i=0;$i<$anexos["numcampos"];$i++){
    $permisos=func_permiso_anexo($idfunc,$anexos[$i]["idanexos"]);        
    $texto.='<tr><td>';
    $texto.=$anexos[$i]["etiqueta"].'</td><td>';    
    if(strpos($permisos,"l")!==false){
				$mostrar = dirname(__FILE__) . '/../../filesystem/mostrar_binario.php?ruta=';
				$ruta64 = base64_encode($anexos[$i]["ruta"]);
				$texto .= '<a href="' . $mostrar . $ruta64 . '"><i class="icon-download" target="_blank"></i></a>';
    }
    if(strpos($permisos,"e")!==false){
				//TODO: En cuales casos se usa? como?
      $texto.='<div enlace="'.PROTOCOLO_CONEXION.RUTA_PDF."/".$anexos[$i]["ruta"].'"><i class="icon-minus-sign"></i></div>';
    }
    $texto.='</td>';    
    $texto.='</tr>';
  }
  $texto.='</table>';
}
return($texto);
}

function datos_anexos($iddoc){
global $conn;
$datos=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc,"",$conn);
return($datos);
}

function eliminar_anexos($idanexo,$tipo_retorno=1){
	global $conn,$ruta_db_superior;
  $retorno=array("exito"=>0);
  $config = busca_filtro_tabla("valor","configuracion","nombre='tipo_almacenamiento'","",$conn);
  
  $anexo=busca_filtro_tabla("","anexos","idanexos=".$idanexo,"",$conn);  
  if($anexo["numcampos"]>0)
   if($anexo[0]['idbinario']!=''&&$anexo[0]['idbinario']!=NULL) // Evita errores si el binario no fue bien almacenado y no se asocio
     {
       $sql1="DELETE FROM binario WHERE idbinario=".$anexo[0]['idbinario'];
        phpmkr_query($sql1,$conn); 
     }  
   $file=$ruta_db_superior.$anexo[0]["ruta"];
   $info=busca_filtro_tabla("","anexos","idanexos=".$idanexo,"",$conn);
   $carpeta_eliminados=RUTA_BACKUP_ELIMINADOS.$info[0]["documento_iddocumento"];
   crear_destino($ruta_db_superior.$carpeta_eliminados);
   $nombre=$carpeta_eliminados."/".date("Y-m-d_H_i_s")."_".$info[0]["etiqueta"];
   
    if(is_file($file))  
     rename($file,$ruta_db_superior.$nombre);
    
    $sql2="DELETE FROM anexos WHERE idanexos=".$idanexo; 
    phpmkr_query($sql2,$conn); 
    $x_detalle= "Identificador: ".$info[0]["idanexos"]." ,Nombre: ".$info[0]["etiqueta"];
		if($justificacion!=''){
    	$x_detalle.=" , Justificacion: ".$justificacion;
    }		
    else if(@$_REQUEST["justificacion"]){
      $x_detalle.=" , Justificacion: ".$_REQUEST["justificacion"];
    }
    $idregistro=registrar_accion_digitalizacion($info[0]["documento_iddocumento"],'ELIMINACION ANEXO',$x_detalle);
    if($idregistro){
      $retorno["exito"]=1;      
    }
  if($tipo_retorno==1)
  	echo(json_encode($retorno));
  else{
  	return($retorno);
  }    
}
function mostrar_anexo($idanexo){
	$file='';
	$datos=busca_filtro_tabla("","anexos","idanexos=".$idanexo,"",$conn);
  if(!$datos["numcampos"])
    $file='<span class="label label-important">problema con el archivo anexo</span>';
  else 
  	$file='<a href="'.PROTOCOLO_CONEXION.RUTA_PDF.'/pantallas/anexos/librerias.php?ejecutar_anexos=descargar_anexo&idanexo='.$datos[0]["idanexos"].'" target="_blank">'.$datos[0]["etiqueta"].'</a>'; 	
	return($file);	
}
if(@$_REQUEST["ejecutar_anexos"]){
  $_REQUEST["ejecutar_anexos"]($_REQUEST["idanexo"],@$_REQUEST["tipo_retorno"]);
}
?>
