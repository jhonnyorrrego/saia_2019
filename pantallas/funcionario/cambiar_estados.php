<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "librerias_saia.php");
$retorno=array();
$retorno["exito"]=0;  
if(@$_REQUEST["idfuncionario"]){
  switch(@$_REQUEST["accion"]){
    case "eliminar_funcionario":    
      eliminar_funcionario($_REQUEST["idfuncionario"]); 
    break;
    case "inactivar_funcionario":
      inactivar_funcionario($_REQUEST["idfuncionario"]);
    break;
    case "inactivar_temporal_funcionario":
      inactivar_temporal_funcionario($_REQUEST["idfuncionario"],@$_REQUEST["fecha_fin_inactivo"]);
    break;
    case "reemplazar_funcionario":              
      $retorno["exito"]=1;
      $retorno["mensaje"]="Por favor verifique el rol del Funcionario a reemplazar y su respectivo reemplazo";         
      $retorno["redirecciona"]="reemplazo.php?formato_adicionar=1&idfuncionario=".$_REQUEST["idfuncionario"];
    break;  
  }
}  
function eliminar_funcionario($idfuncionario){
global $retorno,$conn,$ruta_db_superior;
$eliminar=1;     
$funcionario=busca_filtro_tabla("","funcionario","idfuncionario=".$idfuncionario." AND login NOT LIKE 'cerok' AND login NOT LIKE 'radicador.salida' AND login NOT LIKE 'radicador_salida' AND login NOT LIKE'mensajero'","",$conn);
if($funcionario["numcampos"]){                        
  $documentos=busca_filtro_tabla("count(*) AS cantidad","documento","ejecutor=".$funcionario["funcionario_codigo"],"",$conn);
  if($documentos[0]["cantidad"]){
    $eliminar=0;         
  }
  else{                                
    if(!$eliminar){          
      $asignacion=busca_filtro_tabla("count(*) AS cantidad","asignacion","funcionario_codigo=".$funcionario[0]["funcionario_codigo"],"",$conn);
      if($asignacion[0]["cantidad"]){
        $eliminar=0;
      }
      if(!$eliminar){
        $buzones=busca_filtro_tabla("count(*) AS cantidad","buzon_salida","origen=".$funcionario[0]["funcionario_codigo"]." OR destino=".$funcionario[0]["funcionario_codigo"],"",$conn);
        if($buzones[0]["cantidad"]){
          $eliminar=0;
        }          
      }
    }      
  }
  if($eliminar){
    include_once($ruta_db_superior."StorageUtils.php");
    require_once $ruta_db_superior.'filesystem/SaiaStorage.php';
    
    $roles=busca_filtro_tabla("","dependencia_cargo","funcionario_idfuncionario=".$idfuncionario,"",$conn);
    $texto_sql='';
    for($i=0;$i<$roles["numcampos"];$i++){
      $texto_sql.="INSERT INTO dependencia_cargo(funcionario_idfuncionario,dependencia_iddependencia,cargo_idcargo,estado,fecha_inicial,fecha_final,fecha_ingreso,tipo) VALUES(".$roles[$i]["funcionario_idfuncionario"].",".$roles[$i]["dependencia_iddependencia"].",".$roles[$i]["cargo_idcargo"].",".$roles[$i]["estado"].",'".$roles[$i]["fecha_inicial"]."','".$roles[$i]["fecha_final"]."','".$roles[$i]["fecha_ingreso"]."',".$roles[$i]["tipo"].")\n";
    }  
    $texto_sql.="INSERT INTO funcionario(funcionario_codigo, nombres, apellidos, login,estado,fecha_ingreso,clave,nit,perfil,debe_firmar, tipo, ultimo_pwd, mensajeria, email, sistema, email_contrasenia, direccion, telefono) VALUES ('".$funcionario[0]["funcionario_codigo"]."', '".$funcionario[0]["nombres"]."', '".$funcionario[0]["apellidos"]."', '".$funcionario[0]["login"]."','".$funcionario[0]["estado"]."','".$funcionario[0]["fecha_ingreso"]."','".$funcionario[0]["clave"]."','".$funcionario[0]["nit"]."','".$funcionario[0]["perfil"]."','".$funcionario[0]["debe_firmar"]."', '".$funcionario[0]["tipo"]."', '".$funcionario[0]["ultimo_pwd"]."', '".$funcionario[0]["mensajeria"]."', '".$funcionario[0]["email"]."', '".$funcionario[0]["email"]."', '".$funcionario[0]["email_contrasenia"]."', '".$funcionario[0]["direccion"]."', '".$funcionario[0]["telefono"]."')";
    
    $almacenamiento = new SaiaStorage(RUTA_BACKUP_ELIMINADOS);
    $ruta_eliminados="funcionarios/";
    $archivo=$ruta_eliminados.$funcionario[0]["login"].".sql";  
    $almacenamiento = new SaiaStorage(RUTA_BACKUP_ELIMINADOS);
    $almacenamiento->almacenar_contenido($archivo, $texto_sql); 
     
    //file_put_contents($archivo,$texto_sql);
    $sql2="DELETE FROM funcionario WHERE idfuncionario=".$idfuncionario;
    //phpmkr_query($sql2);
    $sql2="DELETE FROM dependencia_cargo WHERE funcionario_idfuncionario=".$idfuncionario;
    //phpmkr_query($sql2);               
  }
}  
if($eliminar){
  $retorno["mensaje"]="El funcionario se ha eliminado de forma exitosa";
  $retorno["exito"]=1;
}
else{
  $retorno["mensaje"]="Existen documentos, transferencias, rutas o asignaciones vinculadas con el funcionario y no puede ser eliminado";
  $retorno["exito"]=0;
}
}
function inactivar_funcionario($idfuncionario){
global $retorno,$conn,$ruta_db_superior;     
$funcionario=busca_filtro_tabla("","funcionario","idfuncionario=".$idfuncionario." AND login NOT LIKE 'cerok' AND login NOT LIKE 'radicador.salida' AND login NOT LIKE 'radicador_salida' AND login NOT LIKE'mensajero'","",$conn);
if($funcionario["numcampos"]){
  $sql2="UPDATE funcionario SET estado=0 WHERE idfuncionario=".$idfuncionario;
  //phpmkr_query($sql2);
  $sql2="UPDATE dependencia_cargo SET estado=0 WHERE funcionario_idfuncionario=".$idfuncionario;
  //phpmkr_query($sql2);
  $retorno["mensaje"]="El funcionario se ha Inactivado con todos sus roles de forma exitosa<br />Por favor reasigne los documentos a otra persona";
  $retorno["exito"]=1;             
  $retorno["redirecciona"]="compartir_documentos.php?accion=mover_documentos_adicionar&idfun=".$idfuncionario;
}  
}
function inactivar_temporal_funcionario($idfuncionario,$fecha_fin_inactivo){
global $retorno,$conn,$ruta_db_superior;     
$funcionario=busca_filtro_tabla("","funcionario","idfuncionario=".$idfuncionario." AND login NOT LIKE 'cerok' AND login NOT LIKE 'radicador.salida' AND login NOT LIKE 'radicador_salida' AND login NOT LIKE'mensajero'","",$conn);
if($funcionario["numcampos"]){
  $adicional="";
  if($fecha_fin_inactivo)$adicional=", fecha_fin_inactivo=".fecha_db_almacenar($fecha_fin_inactivo,'Y-m-d')." ";
  $sql2="UPDATE funcionario SET estado=0".$adicional." WHERE idfuncionario=".$idfuncionario;
  phpmkr_query($sql2);  
  $retorno["mensaje"]="El funcionario se ha Inactivado y sus roles siguen activos";
  $retorno["exito"]=1;             
}  
}
echo(stripslashes(json_encode($retorno)));
?>
