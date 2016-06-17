<?php 


include_once('db.php');


$nombre="ft_proceso";
$formato=busca_filtro_tabla("A.idformato,A.nombre,A.nombre_tabla,A.etiqueta","formato A","A.nombre_tabla LIKE '".$nombre."'","idformato DESC",$conn);



 $imagenes=' im0="'.strtolower($formato[0]["nombre"]).'.gif" im1="'.strtolower($formato[0]["nombre"]).'.gif" im2="'.strtolower($formato[0]["nombre"]).'.gif" ';
 $iddoc=$formato[0]["idformato"]."-".$formato[0]["nombre"]."-".$formato[0]["nombre_tabla"];
 
 $arreglo=explode("-",$iddoc);  
 $campo_ordenar=busca_filtro_tabla("c.nombre,nombre_tabla","campos_formato c,formato f","formato_idformato=idformato and (c.banderas like 'oc' or c.banderas like '%,oc' or c.banderas like 'oc,%' or c.banderas like '%,oc,%') and f.nombre='".strtolower($arreglo[1])."'","",$conn);
 
  if($campo_ordenar["numcampos"])
   { $orden="b.".$campo_ordenar[0]["nombre"]." asc";
   }
 else
   $orden="iddocumento asc"; 
  $imagen_nota="";
  $validacion_macroproceso='';  
  if(@$arreglo[3] && $arreglo[1]=="proceso"){
    $validacion_macroproceso=" AND documento_iddocumento=".$arreglo[3];
  }
 
 
  if($campo_ordenar["numcampos"]){ 
    $formato=busca_filtro_tabla("A.numero,A.descripcion ,A.iddocumento","documento A,".$campo_ordenar[0]["nombre_tabla"]." b","documento_iddocumento=iddocumento AND A.estado<>'ELIMINADO'".$validacion_macroproceso,$orden,$conn);
  }  
  
  for($i=0;$i<$formato["numcampos"];$i++){
      $papas=busca_filtro_tabla("id".$arreglo[2]." AS llave,'".$arreglo[2]."' AS nombre_tabla",$arreglo[2],"documento_iddocumento=".$formato[$i]["iddocumento"],"",$conn);
    if($papas["numcampos"])
      $iddoc=$arreglo[0]."-".$papas[0]["llave"]."-id".$arreglo[2];
    else $iddoc=0;
   // llena_datos_formato($iddoc,0);
   
   echo($iddoc.'<br><br>');
  }  
  
 print_r($formato);
 
?>

