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
include_once($ruta_db_superior."pantallas/lib/buscar_patron_archivo.php");
$_REQUEST["ruta"]=str_replace("../","",@$_REQUEST["ruta"]);
if(@$_REQUEST["pantalla_idpantalla"] && @$_REQUEST["ruta"]){  
  $campos=array();
  $lcampos=busca_filtro_tabla("","pantalla_campos","pantalla_idpantalla=".$_REQUEST["pantalla_idpantalla"],"",$conn);
  $listado_campos_formulario='<select name="lparametros" class="lparametros">';      
  if($lcampos["numcampos"]){              
    for($i=0;$i<$lcampos["numcampos"];$i++){
      $listado_campos_formulario.='<option value="'.$lcampos[$i]["idpantalla_campos"].'">'.$lcampos[$i]["etiqueta"].'</option>';
      array_push($campos,$lcampos[$i]["nombre"]);
    }
  }               
  $listado_campos_formulario.='</select>';
  $listado_funciones=buscar_patron_archivo($_REQUEST["ruta"],"function",0);         
}
else{
  alerta("No es posible vincular la libreria");
  die();  
}
if($listado_funciones["exito"]){
  $funciones=array();
  echo('<select name="funcion" class="seleccionar_pantalla_funcion" id="funcion">');
  echo('<option value="">Por favor seleccione</option>');
  foreach($listado_funciones["resultado"] AS $key=>$valor){
    $pos1=strpos($valor,"(");
    $pos2=strpos($valor,")");
    $nombre=trim(substr($valor,8,($pos1-8)));        
    $dato=trim(substr($valor,8));
    if($nombre=='')continue;
    echo('<option value="'.$dato.'" nombre="'.$nombre.'" funcion="'.$dato.'">'.$dato.'</option>'); 
  }
  echo('</select>');
}
else{
  echo($listado_funciones["resultado"]);
}
?>