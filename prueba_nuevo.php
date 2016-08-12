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
include('db.php');



$iddoc=6;
echo(json_encode(generar_version_json($iddoc)));
function generar_version_json($iddoc){
    global $conn;
    
    $formato=busca_filtro_tabla('','formato a, documento b','lower(b.plantilla)=lower(a.nombre) AND iddocumento='.$iddoc,'',conn);
    
    $json_final=array();
    $json_final[$formato[0]['nombre_tabla']]=obtener_info_version($iddoc,$formato[0]['nombre_tabla'],'documento_iddocumento'); //ft
    $json_final['documento']=obtener_info_version($iddoc,'documento','iddocumento'); //documento
    $json_final['ruta']=obtener_info_version($iddoc,'ruta','documento_iddocumento'); //ruta
    $json_final['buzon_entrada']=obtener_info_version($iddoc,'buzon_entrada','archivo_idarchivo'); //buzon_entrada
    $json_final['anexos']=obtener_info_version($iddoc,'anexos','documento_iddocumento'); //anexos
    $json_final['pagina']=obtener_info_version($iddoc,'pagina','id_documento'); //pagina
    $json_final['almacenamiento']=obtener_info_version($iddoc,'almacenamiento','documento_iddocumento'); //almacenamiento
    $json_final['anexos_despacho']=obtener_info_version($iddoc,'anexos_despacho','documento_iddocumento'); //anexos_despacho
  //  $json_final['anexos_vinculados']=obtener_info_version($iddoc,'anexos_vinculados','documento_iddocumento'); //anexos_vinculados
    $json_final['asignacion']=obtener_info_version($iddoc,'asignacion','documento_iddocumento'); //asignacion
    $json_final['comentario_img']=obtener_info_version($iddoc,'comentario_img','documento_iddocumento'); //comentario_img
    
    
    
    return($json_final);
    
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