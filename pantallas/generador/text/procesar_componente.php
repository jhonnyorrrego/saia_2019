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
include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php");
function procesar_texto($idcampo='',$seleccionado='',$accion='',$campo=''){  
  global $conn;
  $campo='';
  if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
  if($campo==''){
    $dato=busca_filtro_tabla("A.*","campos_formato A","A.idcampos_formato=".$idcampo,"",$conn);
    $campo=$dato[0];
  }	
  if($seleccionado!=''){
    $texto=$seleccionado;
  }
  else{
    $texto=$campo["predeterminado"];
  }
  return($texto);
}
function procesar_opcion_buscar($idcampo='',$seleccionado='',$accion='',$campo=''){
  global $conn;
  $campo='';
  if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
  if($campo==''){
    $dato=busca_filtro_tabla("A.*","campos_formato A","A.idcampos_formato=".$idcampo,"",$conn);
    $campo=$dato[0];
  }	
  if($accion =="eliminar"){
  	return ($seleccionado);
  }
  if($accion=="buscar"){
    return(' <select style="width:90px;height:27px" name="bqsaiacondicion_'.$campo["nombre"].'" id="bqsaiacondicion_'.$campo["nombre"].'">
    <option value="=">=</option>
    <option value="in">in</option>
    <option value="like">like</option>
    <option value="like_total">like total</option>
    </select>
    <input type="hidden" name="bqsaiaenlace_'.$campo["nombre"].'" id="bqsaiaenlace_'.$campo["nombre"].'" value="+"/>
    ');
  }
  //print_r($idcampo);
  //print_r($seleccionado);
  //print_r($accion);
  //print_r($campo);  
}
?>