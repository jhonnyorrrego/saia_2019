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

//function guardar_anexos($idformato, $iddoc){
		
	$iddoc=$_REQUEST['iddoc'];
	$idformato=$_REQUEST['idformato'];
	  
    require_once($ruta_db_superior."anexosdigitales/funciones_archivo.php");    
    //require_once($ruta_db_superior."pantallas/lib/librerias_adicionales.php");
    //require_once($ruta_db_superior."pantallas/ocr/librerias.php");
    
    $datos=busca_filtro_tabla('','ft_correo_saia','documento_iddocumento='.$iddoc,'',$conn);
    //$vector=explode(',',$datos[0]['anexos']);
    $vector=explode(',','saia_release1/saia/index.jpeg,saia_release1/saia/hombre.jpg');
	print_r($vector."</br>");
    
    for($i=0;$i<count($vector);$i++){
        $dir_anexos=selecciona_ruta_anexos("",$iddoc,'archivo');
		print_r($dir_anexos."-----");
        
        $ruta_real=array('');
        //$ruta_real[1]=$vector[$i];
     
        $ruta_real[1]='index.jpeg';
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
                  
        rename($ruta_db_superior.$ruta_real[1],$ruta_db_superior.$dir_anexos.$nombre_temporal);
		
		print_r($ruta_real[1]."-------");
		
		print_r($dir_anexos);
        
 $sql="INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta,fecha_anexo,formato,campos_formato) values(".$iddoc.",'".$dir_anexos.$nombre_temporal."','".$extencion."','".$archivo_actual."'".",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'".$idformato."','7358')";        
         phpmkr_query($sql,$conn);
        $idanexo=phpmkr_insert_id();
        
        $sql1="insert into permiso_anexo(anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_total)values('".$idanexo."', '".usuario_actual('idfuncionario')."', 'lem', 'l')";
        phpmkr_query($sql1);
          /*  DESARROLLO NUEVA TABLA anexos_adicionales  */

    }
    //cargar_archivo_digitalizacion($vector,$iddoc,'PERMISOS|ELIMINAR|DESCARGAR|ICONO|PROPIETARIO|EDITAR');
	
//}
?>