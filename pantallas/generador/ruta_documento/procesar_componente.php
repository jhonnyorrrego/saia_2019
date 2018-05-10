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
include_once($ruta_db_superior."pantallas/ruta_temporal/funciones.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
function procesar_ruta_documento($idcampo='',$seleccionado='',$accion='',$campo=''){
global $conn,$ruta_db_superior;
$texto='';
if($idcampo==''){
  return("<div class='alert alert-error'>No existe campo para procesar</div>");
}
if($campo==''){
	$dato=busca_filtro_tabla("","pantalla_campos","idpantalla_campos=".$idcampo,"",$conn);
	$campo=$dato[0];
}	
$valor=explode(";",$campo["valor"]);
if($acccion!="mostrar"){
  //Valor[0]->Etiqueta que debe ir en el enlace si aplica; valor[1]=ruta  pantalla de adicion de ruta;valor[2]=parametros del highslide separado por comas (ancho,alto);valor[3]=parametros del request que deben enviarse en el enlace
  //TODO:Pasar todas las cadenas de los componentes a json
  if(!@$valor[0]){
    $valor[0]=$campo["etiqueta"];
  }
  $ancho=300;
  $alto=100;
  if(!strpos($valor[1],"?")){
    $valor[1].="?";
  }
  $texto.='<div id="'.$campo["nombre"].'" class="highslide" style="cursor:pointer;" name="'.$campo["nombre"].'">'.$valor[0].'
    </div>';
  $lancho=explode(",",$valor[2]);
  if(@$lancho[0]){
    $ancho=$lancho[0];
  }
  if(@$lancho[1]){
    $alto=$lancho[1];
  }
  $lparams=explode(",",$valor[3]);
  $cant_params=count($lparams);
  $parametros='';
  $llave_ruta=cadena_aleatoria(15);
  if($cant_params){
    $params=array();
    for($i=0;$i<$cant_params;$i++){
      if(@$_REQUEST[$lparams[$i]]){
        array_push($params,$lparams[$i]."=".$_REQUEST[$lparams[$i]]);
      }  
    }
    if(!strpos($valor[1],"?")){
      $parametros="?";
    }
    else{
      $parametros="&";
    }
    $parametros.=implode("&",$params);
  }
  if(!strpos($valor[1],"?")){
      $parametros="?llave_ruta_temporal=".$llave_ruta;
    }
    else{
      $parametros="&llave_ruta_temporal=".$llave_ruta;
    }
  if($accion!=''){
    $texto.='<script type="text/javascript">
    $(document).ready(function(){
      hs.graphicsDir = "'.$ruta_db_superior.'highslide/graphics/";
      hs.outlineType = "rounded-white";
      $("#'.$campo["nombre"].'").live("click",function(e){
        e.preventDefault();
        ';
    $texto.=' hs.htmlExpand(this, {objectType: "iframe", width:"'.$ancho.'", height:"'.$alto.'", preserveContent:false ,src: "'.$ruta_db_superior.$valor[1].$parametros.'"});';	    
    $texto.='
      });
    });    
    </script>';
    $texto.='<input type="hidden" value="'.$llave_ruta.'" name="llave_ruta_temporal">';
  }  
}  
//$texto.=informacion_ruta(1); 
return($texto);
} 
?>