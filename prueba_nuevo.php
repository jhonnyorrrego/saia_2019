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
    global $conn,$ruta_db_superior;
    
    $formato=busca_filtro_tabla('','formato a, documento b','lower(b.plantilla)=lower(a.nombre) AND iddocumento='.$iddoc,'',conn);
    
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
    crear_destino($ruta_db_superior.$destino);    
    $ruta_json.='json.json';
    $archivo_json = fopen($ruta_json, "a");
    fwrite($archivo_json, json_encode($json_final));
    fclose($archivo_json);
    
    
    
    //return($json_final);
    
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