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
function vincular_anexos($iddoc,$anexos,$idfuncionario){
$mensaje=array();
  foreach($anexos AS $key=>$value){
    $anexos_origen=busca_filtro_tabla("","anexos A,documento B","A.documento_iddocumento=B.iddocumento AND A.idanexos=".$value,"",$conn);
    $anexos_destino=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc,"",$conn);
    $lanexos=extrae_campo($anexos_destino,"idanexos");
    //$anexos_vinculadas=busca_filtro_tabla("","anexo_vinculados","anexo_origen=".$value." AND anexo_destino IN(".implode(",",$lanexos).")","",$conn);
    if($anexos_origen["numcampos"]){
      $sql2="INSERT INTO anexos(documento_iddocumento,etiqueta,tipo,ruta) VALUES(".$iddoc.",'".$anexos_origen[0]["etiqueta"]."','".$anexos_origen[0]["tipo"]."','".$anexos_origen[0]["ruta"]."')";     
      phpmkr_query($sql2);
      $idanexo=phpmkr_insert_id();
      if($idanexo){
        $permisos_anexo=busca_filtro_tabla("","permiso_anexo","anexos_idanexos=".$value,"",$conn);
        if($permisos_anexo["numcampos"]){
          for($j=0;$j<$permisos_anexo["numcampos"];$j++){
            $sql2="INSERT INTO permiso_anexo(anexos_idanexos,idpropietario,caracteristica_propio,caracteristica_dependencia,caracteristica_cargo,caracteristica_total) VALUES(".$idanexo.",".$idfuncionario.",'".$permisos_anexo[$j]["caracteristica_propio"]."','".$permisos_anexo[$j]["caracteristica_dependencia"]."','".$permisos_anexo[$j]["caracteristica_cargo"]."','".$permisos_anexo[$j]["caracteristica_total"]."')";
            phpmkr_query($sql2);
          }
        }
        $sql2="INSERT INTO anexos_vinculados(anexos_origen,anexos_destino,fecha,funcionario_idfuncionario) VALUES(".$value.",".$idanexo.",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",".$idfuncionario.")"; 
        phpmkr_query($sql2);
        $idenlace=phpmkr_insert_id();
        if($idenlace)
          $mensaje[]=$idanexo;
      }
    }
  }  
return($mensaje);
}
function desvincular_anexo($anexo_destino){

}
if(@$_REQUEST["funcion"]){
  $_REQUEST["funcion"]();
}
?>