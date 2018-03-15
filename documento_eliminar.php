<?php
include_once("db.php"); 
include_once("class_transferencia.php");
//datos_documento($iddocumento);
function datos_documento($doc,$etiqueta="",$ruta_backup){
    global $conn;
  $ruta_destino=$ruta_backup."/eliminados/".date("Y-m-d")."/".$etiqueta.$doc;

  crear_destino($ruta_destino);
  $sql_doc = crear_insert("documento","iddocumento",$doc,$ruta_destino);
  $sql_doc .= crear_insert("buzon_entrada","archivo_idarchivo",$doc,$ruta_destino);
  $sql_doc .= crear_insert("buzon_salida","archivo_idarchivo",$doc,$ruta_destino);
  $sql_doc .= crear_insert("pagina","id_documento",$doc,$ruta_destino);
  $sql_doc .= crear_insert("comentario_img","documento_iddocumento",$doc,$ruta_destino);
  $sql_doc .= crear_insert("anexos","documento_iddocumento",$doc,$ruta_destino);

  $sql_doc .= crear_insert("salidas","documento_iddocumento",$doc,$ruta_destino);
  $sql_doc .= crear_insert("respuesta","destino",$doc,$ruta_destino);
  $sql_doc .= crear_insert("respuesta","origen",$doc,$ruta_destino);
  $sql_doc .= crear_insert("almacenamiento","documento_iddocumento",$doc,$ruta_destino);
  $sql_doc .= crear_insert("asignacion","documento_iddocumento",$doc,$ruta_destino);    
  $sql_doc .= crear_insert("control","documento_iddocumento",$doc,$ruta_destino);
  $sql_doc .= crear_insert("expediente_doc","documento_iddocumento",$doc,$ruta_destino);
  $sql_doc .= crear_insert("reserva","documento_iddocumento",$doc,$ruta_destino);
  $sql_doc .= crear_insert("ruta","documento_iddocumento",$doc,$ruta_destino);
  $sql_doc .= crear_insert("solicitud","documento_iddocumento",$doc,$ruta_destino);
  
  $archivo = '/documento_'.$doc.'_'.date("Y-m-d").'.txt';    
  $fp = fopen($ruta_destino.$archivo, "w+");
  if(fwrite($fp, $sql_doc) === FALSE)
   echo ("No fue posible escribir los sql al archivo ".$archivo);
   comprimir($doc,$ruta_destino);   
  fclose($fp);
  
 return true;  
}

function crear_insert($ntabla,$idcampo,$doc,$ruta_destino){
    if(MOTOR=='MySql')
    $texto=crear_insert_mysql($ntabla,$idcampo,$doc,$ruta_destino);
    elseif(MOTOR=='Oracle')
    $texto=crear_insert_oracle($ntabla,$idcampo,$doc,$ruta_destino);
  elseif(MOTOR=='SqlServer')
    $texto=crear_insert_sqlserver($ntabla,$idcampo,$doc,$ruta_destino);
  elseif(MOTOR=='MSSql')
    $texto=crear_insert_sqlserver($ntabla,$idcampo,$doc,$ruta_destino);
    return $texto;
}

function crear_insert_oracle($ntabla,$idcampo,$doc,$ruta_destino){
    global $conn;
    $texto1 =""; 
    $datos = busca_filtro_tabla("*","".$ntabla,"$idcampo='$doc'","",$conn);
    if($datos["numcampos"]>0){
    if($ntabla=='documento' && $datos[0]["plantilla"]!=""){
        $tabla_formato = busca_filtro_tabla("nombre_tabla","formato","nombre like '".strtolower($datos[0]["plantilla"])."'","",$conn);        
        $texto1 = crear_insert($tabla_formato[0]["nombre_tabla"],"documento_iddocumento",$doc,$ruta_destino);
        if($datos[0]["pdf"]!="")
        copiar_archivo($datos[0]["pdf"],'',$ruta_destino);
    }
    $tabla = busca_filtro_tabla("column_name,table_name,data_type","user_tab_columns","table_name = '".strtoupper($ntabla)."'","",$conn); 
    for($j=0; $j<$datos["numcampos"]; $j++){
        if($ntabla=='anexos')   
            copiar_archivo($datos[$j]["ruta"],$datos[$j]["etiqueta"],$ruta_destino);  
        if($ntabla=='pagina'){
            copiar_archivo($datos[$j]["ruta"],"",$ruta_destino);
            copiar_archivo($datos[$j]["imagen"],"",$ruta_destino);
        }   
        $texto1 .= "\n\rINSERT INTO ".$ntabla." (";
        $texto = ""; 
        $campos ="";
        for($i=0; $i<$tabla["numcampos"]; $i++){
            $campos .= ",".strtolower($tabla[$i]["column_name"]);
            switch ($tabla[$i]["data_type"]){
            case "VARCHAR2":
                if($datos[$j][strtolower($tabla[$i]["column_name"])]!="")
                    $texto .= "'".$datos[$j][strtolower($tabla[$i]["column_name"])]."',";
                else
                    $texto .="NULL,"; 
            break;
            case "NUMBER":
                if($datos[$j][strtolower($tabla[$i]["column_name"])]!="")
                    $texto .= $datos[$j][strtolower($tabla[$i]["column_name"])].",";
                else
                    $texto .="NULL,";  
            break;
            case "DATE":      
                if($datos[$j][strtolower($tabla[$i]["column_name"])]!=""){
                    $fecha = busca_filtro_tabla(fecha_db_obtener($tabla[$i]["column_name"],'Y-m-d H:i:s')." as fecha",$ntabla,"$idcampo=$doc","",$conn);
                    $texto .= fecha_db_almacenar($fecha[0]["fecha"],'Y-m-d H:i:s').",";
                }
                else
                    $texto .="NULL,"; 
            break;
            case "CLOB":
                $texto .="'".$datos[$j][strtolower($tabla[$i]["column_name"])]."',";
            break;       
            }      
        }
        $texto1 .= substr($campos, 1).") VALUES (".substr($texto, 0, strlen($texto)-1).");";
    }
    $eliminar = "DELETE FROM ".$ntabla." WHERE ".$idcampo." = ".$doc;
    phpmkr_query($eliminar,$conn);
    }
    return $texto1; 
}

function crear_insert_mysql($ntabla,$idcampo,$doc,$ruta_destino){
    global $conn;
    $texto1 =""; 
    $datos = busca_filtro_tabla("*","".$ntabla,"$idcampo='$doc'","",$conn); 

    if($datos["numcampos"]>0){
        if($ntabla=='documento' && $datos[0]["plantilla"]!=""){
            $tabla_formato = busca_filtro_tabla("nombre_tabla","formato","nombre like '".strtolower($datos[0]["plantilla"])."'","",$conn);
        $texto1 = crear_insert($tabla_formato[0]["nombre_tabla"],"documento_iddocumento",$doc,$ruta_destino);
        if($datos[0]["pdf"]!="")
        copiar_archivo($datos[0]["pdf"],'',$ruta_destino);
    }
    $tabla = ejecuta_filtro_tabla("SHOW COLUMNS FROM ".strtolower($ntabla),$conn);
    for($j=0; $j<$datos["numcampos"]; $j++){
        if($ntabla=='anexos')   
            copiar_archivo($datos[$j]["ruta"],$datos[$j]["etiqueta"],$ruta_destino);  
        if($ntabla=='pagina'){
            copiar_archivo($datos[$j]["ruta"],"",$ruta_destino);
            copiar_archivo($datos[$j]["imagen"],"",$ruta_destino);
        }   
        $texto1 .= "\n\rINSERT INTO ".$ntabla." (";
        $texto = ""; 
        $campos ="";
        for($i=0; $i<$tabla["numcampos"]; $i++){
            $campos .= ",".strtolower($tabla[$i]["Field"]);
            $type=eregi_replace('[[:digit:]/.]', '', $tabla[$i]["Type"]);    
            $type=str_replace("()","",$type);
            switch ($type){
            case "varchar":
                if($datos[$j][strtolower($tabla[$i]["Field"])]!="")
                    $texto .= "'".$datos[$j][strtolower($tabla[$i]["Field"])]."',";
            else
                $texto .="NULL,"; 
            break;
            case "int":
                if($datos[$j][strtolower($tabla[$i]["Field"])]!="")
                    $texto .= $datos[$j][strtolower($tabla[$i]["Field"])].",";
                else
                    $texto .="NULL,";  
            break;
            case "date":      
                if($datos[$j][strtolower($tabla[$i]["Field"])]!=""){
                    $fecha = busca_filtro_tabla(fecha_db_obtener($tabla[$i]["Field"],'Y-m-d H:i:s')." as fecha",$ntabla,"$idcampo=$doc","",$conn);
                    $texto .= fecha_db_almacenar($fecha[0]["fecha"],'Y-m-d H:i:s').",";
                }
            else
                $texto .="NULL,"; 
            break;
            case "text":
                $texto .="'".$datos[$j][strtolower($tabla[$i]["Field"])]."',";
            break;
            default:
                $texto .="'".$datos[$j][strtolower($tabla[$i]["Field"])]."',";
            break;       
            }      
        }
        $texto1 .= substr($campos, 1).") VALUES (".substr($texto, 0, strlen($texto)-1).");";
    }
    $eliminar = "DELETE FROM ".$ntabla." WHERE ".$idcampo." = ".$doc;
    phpmkr_query($eliminar,$conn);
    }  
    return $texto1; 
}

function crear_insert_sqlserver($ntabla,$idcampo,$doc,$ruta_destino){
    global $conn;
    $texto1 =""; 
    $datos = busca_filtro_tabla("*","".$ntabla,"$idcampo='$doc'","",$conn);

    if($datos["numcampos"]>0){
        if($ntabla=='documento' && $datos[0]["plantilla"]!=""){
            $tabla_formato = busca_filtro_tabla("nombre_tabla","formato","nombre like '".strtolower($datos[0]["plantilla"])."'","",$conn);
        $texto1 = crear_insert($tabla_formato[0]["nombre_tabla"],"documento_iddocumento",$doc,$ruta_destino);
        if($datos[0]["pdf"]!="")
        copiar_archivo($datos[0]["pdf"],'',$ruta_destino);
    }
    $tabla=ejecuta_filtro_tabla("select COLUMN_NAME as Field, DATA_TYPE as Type from Information_Schema.Columns where TABLE_NAME='".strtolower($ntabla)."'",$conn);
    for($j=0; $j<$datos["numcampos"]; $j++){
        if($ntabla=='anexos')
            copiar_archivo($datos[$j]["ruta"],$datos[$j]["etiqueta"],$ruta_destino);  
        if($ntabla=='pagina'){
            copiar_archivo($datos[$j]["ruta"],"",$ruta_destino);
            copiar_archivo($datos[$j]["imagen"],"",$ruta_destino);
        }   
        $texto1 .= "\n\rINSERT INTO ".$ntabla." (";
        $texto = ""; 
        $campos ="";
        for($i=0; $i<$tabla["numcampos"]; $i++){
            $campos .= ",".strtolower($tabla[$i]["Field"]);
            $type=eregi_replace('[[:digit:]/.]', '', $tabla[$i]["Type"]);    
            $type=str_replace("()","",$type);
            //echo $type;
            switch ($type){
            case "nvarchar":
                if($datos[$j][strtolower($tabla[$i]["Field"])]!="")
                    $texto .= "'".$datos[$j][strtolower($tabla[$i]["Field"])]."',";
            else
                $texto .="NULL,"; 
            break;
            case "int":
                if($datos[$j][strtolower($tabla[$i]["Field"])]!="")
                    $texto .= $datos[$j][strtolower($tabla[$i]["Field"])].",";
                else
                    $texto .="NULL,";  
            break;
                    case "bigint":
                if($datos[$j][strtolower($tabla[$i]["Field"])]!="")
                    $texto .= $datos[$j][strtolower($tabla[$i]["Field"])].",";
                else
                    $texto .="NULL,";  
            break;
            case "date":      
                if($datos[$j][strtolower($tabla[$i]["Field"])]!=""){
                    $fecha = busca_filtro_tabla(fecha_db_obtener($tabla[$i]["Field"],'Y-m-d')." as fecha",$ntabla,"$idcampo=$doc","",$conn);
                    $texto .= fecha_db_almacenar($fecha[0]["fecha"],'Y-m-d').",";
                }
            else
                $texto .="NULL,"; 
            break;
            case "datetime":      
                if($datos[$j][strtolower($tabla[$i]["Field"])]!=""){
                    $fecha = busca_filtro_tabla(fecha_db_obtener($tabla[$i]["Field"],'Y-m-d H:i:s')." as fecha",$ntabla,"$idcampo=$doc","",$conn);
                    $texto .= fecha_db_almacenar($fecha[0]["fecha"],'Y-m-d H:i:s').",";
                }
            else
                $texto .="NULL,";
            break;
            case "text":
                $texto .="'".$datos[$j][strtolower($tabla[$i]["Field"])]."',";
            break;
            default:
                $texto .="'".$datos[$j][strtolower($tabla[$i]["Field"])]."',";
            break;       
            }      
        }
        $texto1 .= substr($campos, 1).") VALUES (".substr($texto, 0, strlen($texto)-1).");";
    }
    $eliminar = "DELETE FROM ".$ntabla." WHERE ".$idcampo." = ".$doc;
    phpmkr_query($eliminar,$conn);
    }  
    return $texto1; 
}
function copiar_archivo($origen,$nombre,$ruta_destino){
  $nombre=strrchr($origen,'/');
  if(is_file($origen) && is_dir($ruta_destino))
    $resultado = copy($origen,$ruta_destino.$nombre);
  else
    echo ("Problemas con rutas de archivos para hacer el backup. Ruta origen $origen - Ruta destino $ruta_destino");
    return(true);      
}

function comprimir($doc,$ruta_destino){
    require_once("libreria_zipfile.php");
    if($dh = @opendir("$ruta_destino")){
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
    return true;
}
?>
