<?php
/*
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1*/
/*if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") )
{
  header("Content-type: application/xhtml+xml");
}
else
{
  header("Content-type: text/xml");
}*/
$imagenes="";
$texto="<?xml version=\"1.0\" encoding=\"UTF-8\"?".">";
include_once("../librerias/funciones_generales.php");
$formatos_calidad=array('ft_proceso','ft_manual_calidad','ft_procedimiento','ft_instructivo','ft_politica_proceso','ft_modelo_proceso','ft_levantamiento_procesos','ft_caracterizacion','ft_registro','ft_m_documentos','ft_m_registros','ft_m_externos','ft_m_controles');

$id = @$_GET["id"];
//print_r($id);
$texto.="<tree id=\"0\">\n";
llenar_formatos();
$texto.="</tree>\n";
//die($texto);
crear_archivo("test_cambio_calidad.xml",$texto);
alerta("Actualizacion finalizada !!");
abrir_url("arbolcalidad.php", "izquierda");

?>
<?php
//iddoc=idformato-nombre-nombre_tabla
function llenar_formatos(){
global $texto;
  crear_dato_formato('ft_mision_calidad');
  crear_dato_formato('ft_vision_calidad');
  crear_dato_formato('ft_politica_calidad');
  crear_dato_formato('ft_objetivos_calidad');
  crear_dato_formato('ft_manual_calidad');
  crear_dato_formato('ft_proceso');
}
function crear_dato_formato($nombre){
global $texto,$conn,$imagenes,$formatos_calidad;
$formato=busca_filtro_tabla("A.idformato,A.nombre,A.nombre_tabla,A.etiqueta","formato A","A.nombre_tabla LIKE '".$nombre."'","nombre DESC",$conn);
  if($formato["numcampos"]){
    $imagenes=' im0="'.strtolower($formato[0]["nombre"]).'.gif" im1="'.strtolower($formato[0]["nombre"]).'.gif" im2="'.strtolower($formato[0]["nombre"]).'.gif" ';
    $iddoc=$formato[0]["idformato"]."-".$formato[0]["nombre"]."-".$formato[0]["nombre_tabla"];
    $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
    $texto.=strip_tags('text="'.decodifica($formato[0]["etiqueta"]).'" id="'.$formato[0]["idformato"].'">'."\n");
    llenar_documentos($iddoc);
    $texto.="</item>\n";
  }
}
function llenar_documentos($iddoc){
global $conn,$texto;
  $arreglo=explode("-",$iddoc);
  $formato=busca_filtro_tabla("A.numero,A.descripcion ,A.iddocumento","documento A","lower(A.plantilla)='".strtolower($arreglo[1])."' AND A.estado <>'ELIMINADO'","",$conn);

  /*echo("<HR/>");*/
  for($i=0;$i<$formato["numcampos"];$i++){
      $papas=busca_filtro_tabla("id".$arreglo[2]." AS llave,'".$arreglo[2]."' AS nombre_tabla",$arreglo[2],"documento_iddocumento=".$formato[$i]["iddocumento"],"",$conn);
    //print_r($papas);
    if($papas["numcampos"])
      $iddoc=$arreglo[0]."-".$papas[0]["llave"]."-id".$arreglo[2];
    else $iddoc=0;
    llena_datos_formato($iddoc,0);
  }
}
?>
<?php
function llena_datos_formato($formato,$estado=0){
global $conn,$texto,$imagenes,$formatos_calidad;
$arreglo=explode("-",$formato);
$formato=busca_filtro_tabla("","formato","idformato='".$arreglo[0]."'","",$conn);
//print_r($formato);
if($formato["numcampos"]){
  $descripcion=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"]." AND acciones LIKE '%d%' AND tipo_dato!='TEXT'","",$conn);
  if($descripcion["numcampos"]){
    $campo_descripcion=$descripcion[0]["nombre"];
  }
  else{
    $campo_descripcion="id".$formato[0]["nombre_tabla"];
  }
  $idformato=$formato[0]["idformato"]."-".$arreglo[1]."-".$arreglo[2]."-".$arreglo[0];
  //echo($idformato."<br />");
  $imagenes='im0="'.strtolower($formato[0]["nombre"]).'.gif" im1="'.strtolower($formato[0]["nombre"]).'.gif" im2="'.strtolower($formato[0]["nombre"]).'.gif" ';
  if($estado){
    $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
    $texto.=strip_tags('text="'.decodifica(($formato[0]["etiqueta"])).'" id="'.$formato[0]["idformato"]."-".$arreglo[2]."-r".rand().'">'."\n");
  }
  llena_datos($idformato,$formato[0]["nombre_tabla"],$campo_descripcion);
  if($estado)
    $texto.="</item>\n";
  /*Aqui se deben adicionar los formatos o consideraciones adicionales para el arbol de calidad. Especificamente la parte de Planes de Mejoramiento para los procesos*/

}
return;
}
function decodifica($cadena){
return(str_replace('"','',codifica_encabezado(html_entity_decode($cadena))));
}
function llena_datos($idformato,$tabla,$campo){
global $conn,$texto,$imagenes;
$arreglo=explode("-",$idformato);
//echo("<br />".$idformato."<br />");
$dato=busca_filtro_tabla($campo.",id".$tabla,$tabla,$arreglo[2]."=".$arreglo[1]." AND estado<>'INACTIVO'","",$conn);
//print_r($dato);
for($i=0;$i<$dato["numcampos"];$i++){
  $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
  $llave=$arreglo[0]."-".$arreglo[2]."-".$dato[$i]["id".$tabla];
  $texto.=strip_tags('text="'.decodifica($dato[$i][$campo]).'" id="'.$llave.'">');
  llena_hijos($arreglo[0],$dato[$i]["id".$tabla],$tabla);
  $texto.="</item>\n";
}
return($texto);
}
function llena_hijos($idformato,$iddato,$tabla){
global $conn,$texto,$formatos_calidad;
$formato=busca_filtro_tabla("","formato","cod_padre=".$idformato." AND nombre_tabla IN('".implode("','",$formatos_calidad)."')","",$conn);
for($i=0;$i<$formato["numcampos"];$i++){
  $campo_formato=busca_filtro_tabla("","campos_formato","nombre LIKE '".$tabla."' AND formato_idformato=".$formato[$i]["idformato"],"",$conn);
  $llave=$formato[$i]["idformato"]."-".$iddato;
  if($campo_formato["numcampos"]){
    $llave.="-".$campo_formato[0]["nombre"]."-".$iddato;
  }
  else $llave.="-"."id".$formato[$i]["nombre_tabla"]."-".$iddato;
  llena_datos_formato($llave,1);
}
return;
}
function planes_mejoramiento_funcional(){
global $conn,$texto;
$formato_pm=busca_filtro_tabla("","formato","nombre_tabla LIKE 'ft_plan_mejoramiento'","",$conn);
$condicion_pm=" A.tipo_plan LIKE '%2%'";

$campo_descripcion=array();
if($formato_pm){
  $descripcion=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato_pm[0]["idformato"]." AND acciones LIKE '%d%'","orden ASC",$conn);
  if($descripcion["numcampos"]){
    for($i=0,$num_campo=0;$i<$descripcion["numcampos"];$i++,$num_campo++){
      if($descripcion[$i]["tipo_dato"]=="TEXT" && $descripcion[$i]["longitud"]>=4000 && MOTOR=="Oracle")
        array_push($campo_descripcion,array("nombre"=>"to_char(".$descripcion[$i]["nombre"].")","etiqueta"=>$descripcion[$i]["etiqueta"]));
      else
        array_push($campo_descripcion,array("nombre"=>$descripcion[$i]["nombre"],"etiqueta"=>$descripcion[$i]["etiqueta"]));
    }
  }
  else{
    array_push($campo_descripcion,array("nombre"=>"id".$formato[0]["nombre_tabla"],"etiqueta"=>"ID"));
  }
  $num_campo=count($campo_descripcion);
  for($i=0;$i<$num_campo;$i++){
    if($i==0)
      $cad_tips=$campo_descripcion[$i]["nombre"];
    else $cad_tips.=",".$campo_descripcion[$i]["nombre"];
  }
  $texto.='<item style="font-family:verdana; font-size:7pt;" ';
  $texto.=strip_tags(('text="Planes de mejoramiento Funcional" id="'.$formato_pm[0]["idformato"]."-id_".$formato_pm[0]["nombre_tabla"]."-r".rand().'" >'."\n"));
  $plan_mejoramiento=busca_filtro_tabla("DISTINCT ".$cad_tips.",A.documento_iddocumento,"."id".$formato_pm[0]["nombre_tabla"],$formato_pm[0]["nombre_tabla"]." A,ft_hallazgo B"," A.idft_plan_mejoramiento=B.ft_plan_mejoramiento AND A.estado<>'INACTIVO' AND B.estado<>'INACTIVO' AND ".$condicion_pm,"",$conn);
// print_r($plan_mejoramiento);die();
  for($i=0;$i<$plan_mejoramiento["numcampos"];$i++){
    $tips="";
    for($j=0;$j<$num_campo;$j++){
      $tips.=strip_tags($campo_descripcion[$j]["etiqueta"].": ".decodifica(mostrar_valor_campo($campo_descripcion[$j]["nombre"],$formato_pm[0]["idformato"],$plan_mejoramiento[$i]["documento_iddocumento"],1)))."\n";
    }
    $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
    $llave=$formato_pm[0]["idformato"]."-id".$formato_pm[0]["nombre_tabla"]."-".$plan_mejoramiento[$i]["id".$formato_pm[0]["nombre_tabla"]]."-r".rand();
    $cad=mostrar_valor_campo($campo_descripcion[0]["nombre"],$formato_pm[0]["idformato"],$plan_mejoramiento[$i]["documento_iddocumento"],1);
    //echo($cad.$campo[0]["nombre"].$idformato.$arreglo[1]);
    $texto.=strip_tags(('text="'.decodifica($cad).'" id="'.$llave.'" tooltip="'.decodifica($tips).'">'));
    $texto.="\n</item>\n";
  }
  $texto.="</item>\n";
}
/*global $texto,$conn;
$texto.='<item style="font-family:verdana; font-size:7pt;" ';
$texto.=strip_tags(decodifica('text="Planes de mejoramiento Funcionales" id="pm-funcional">'."\n"));
$listado="";
$lprocesos_vinculados=busca_filtro_tabla("A.procesos_vinculados","ft_hallazgo A","A.tipo_plan LIKE '%2%' AND A.estado<> 'INACTIVO'","",$conn);
//print_r($lprocesos_vinculados);
if($lprocesos_vinculados["numcampos"]){
  $listado=implode(",",extrae_campo($lprocesos_vinculados,"procesos_vinculados","U"));
}
$lprocesos=busca_filtro_tabla("codigo,nombre AS etiqueta,idft_proceso","ft_proceso","estado<>'INACTIVO' AND idft_proceso IN(".$listado.")","",$conn);
//print_r($lprocesos);
for($i=0;$i<$lprocesos["numcampos"];$i++){
  $imagenes=' im0="proceso.gif" im1="proceso.gif" im2="proceso.gif" ';
  //$iddoc=$lprocesos[$i]["idformato"]."-".$lprocesos[$i]["nombre"]."-".$lprocesos[$i]["nombre_tabla"];
  $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
  $texto.=strip_tags(decodifica('text="'.$lprocesos[$i]["etiqueta"].'" id="pm-f-'.$lprocesos[$i]["idft_proceso"].'-mejoramiento">'."\n"));

  $texto.="</item>\n";
}
$texto.="</item>\n";*/
}
function planes_mejoramiento_individual(){
global $texto;
$texto.='<item style="font-family:verdana; font-size:7pt;" ';
$texto.=strip_tags(('text="Planes de mejoramiento Individual" id="pm-individual" >'."\n"));
$texto.='<item style="font-family:verdana; font-size:7pt;" ';
$texto.=strip_tags(('text="Pendiente" id="pm-i-pendientes-mejoramiento" >'."\n"));
$texto.="</item>\n";
$texto.='<item style="font-family:verdana; font-size:7pt;" ';
$texto.=strip_tags(('text="Terminado" id="pm-i-terminados-mejoramiento">'."\n"));
$texto.="</item>\n";
$texto.="</item>\n";
}
function planes_mejoramiento_institucional(){
global $conn,$texto;
$formato_pm=busca_filtro_tabla("","formato","nombre_tabla LIKE 'ft_plan_mejoramiento'","",$conn);
$condicion_pm=" A.tipo_plan LIKE '%1%' ";

$campo_descripcion=array();
if($formato_pm){
  $descripcion=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato_pm[0]["idformato"]." AND acciones LIKE '%d%'","orden ASC",$conn);
  if($descripcion["numcampos"]){
    for($i=0,$num_campo=0;$i<$descripcion["numcampos"];$i++,$num_campo++){
      if($descripcion[$i]["tipo_dato"]=="TEXT" && $descripcion[$i]["longitud"]>=4000 && MOTOR=="Oracle")
        array_push($campo_descripcion,array("nombre"=>"to_char(".$descripcion[$i]["nombre"].")","etiqueta"=>$descripcion[$i]["etiqueta"]));
      else
        array_push($campo_descripcion,array("nombre"=>$descripcion[$i]["nombre"],"etiqueta"=>$descripcion[$i]["etiqueta"]));
    }
  }
  else{
    array_push($campo_descripcion,array("nombre"=>"id".$formato[0]["nombre_tabla"],"etiqueta"=>"ID"));
  }
  $num_campo=count($campo_descripcion);
  for($i=0;$i<$num_campo;$i++){
    if($i==0)
      $cad_tips=$campo_descripcion[$i]["nombre"];
    else $cad_tips.=",".$campo_descripcion[$i]["nombre"];
  }
  $texto.='<item style="font-family:verdana; font-size:7pt;" ';
  $texto.=strip_tags(('text="Planes de mejoramiento Institucional" id="'.$formato_pm[0]["idformato"]."-id_".$formato_pm[0]["nombre_tabla"]."-r".rand().'" >'."\n"));
  $plan_mejoramiento=busca_filtro_tabla("DISTINCT ".$cad_tips.",A.documento_iddocumento,"."id".$formato_pm[0]["nombre_tabla"],$formato_pm[0]["nombre_tabla"]." A,ft_hallazgo B"," A.idft_plan_mejoramiento=B.ft_plan_mejoramiento AND A.estado<>'INACTIVO' AND B.estado<>'INACTIVO' AND ".$condicion_pm,"",$conn);
//print_r($plan_mejoramiento);  die();
  for($i=0;$i<$plan_mejoramiento["numcampos"];$i++){
    $tips="";
    for($j=0;$j<$num_campo;$j++){
      $tips.=strip_tags($campo_descripcion[$j]["etiqueta"].": ".mostrar_valor_campo($campo_descripcion[0]["nombre"],$formato_pm[0]["idformato"],$plan_mejoramiento[$i]["documento_iddocumento"],1))."\n";
    }
    $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
    $llave=$formato_pm[0]["idformato"]."-id".$formato_pm[0]["nombre_tabla"]."-".$plan_mejoramiento[$i]["id".$formato_pm[0]["nombre_tabla"]]."-r".rand();
    $cad=mostrar_valor_campo($campo_descripcion[0]["nombre"],$formato_pm[0]["idformato"],$plan_mejoramiento[$i]["documento_iddocumento"],1);
    //echo($cad.$campo[0]["nombre"].$idformato.$arreglo[1]);
    $texto.=('text="'.strip_tags(decodifica($cad)).'" id="'.$llave.'" tooltip="'.decodifica($tips).'" >');
    $texto.="\n</item>\n";
  }
  $texto.="</item>\n";
}

}
?>
