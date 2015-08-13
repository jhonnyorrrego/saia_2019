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
function vincular_paginas($iddoc,$paginas,$idfuncionario){
$mensaje=array();
  foreach($paginas AS $key=>$value){
    $paginas_origen=busca_filtro_tabla("","pagina A,documento B","A.id_documento=B.iddocumento AND A.consecutivo=".$value,"",$conn);
    $paginas_destino=busca_filtro_tabla("","pagina","id_documento=".$iddoc,"",$conn);
    $lpaginas=extrae_campo($paginas_destino,"consecutivo");
    //$paginas_vinculadas=busca_filtro_tabla("","pagina_vinculados","pagina_origen=".$value." AND pagina_destino IN(".implode(",",$lpaginas).")","",$conn);
    if($paginas_origen["numcampos"]){
      $sql2="INSERT INTO pagina(id_documento,imagen,pagina,ruta) VALUES(".$iddoc.",'".$paginas_origen[0]["imagen"]."',".($paginas_destino["numcampos"]+1).",'".$paginas_origen[0]["ruta"]."')";
      phpmkr_query($sql2);
      $idpagina=phpmkr_insert_id();
      if($idpagina){
        $sql2="INSERT INTO pagina_vinculados(pagina_origen,pagina_destino,fecha,funcionario_idfuncionario) VALUES(".$value.",".$idpagina.",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",".$idfuncionario.")";   
        phpmkr_query($sql2);
        $idenlace=phpmkr_insert_id();
        if($idenlace)
          $mensaje[]=$idpagina;
      }
    }
  }  
return($mensaje);
}
function desvincular_pagina($pagina_destino){

}
if(@$_REQUEST["funcion"]){
  $_REQUEST["funcion"]();
}
?>