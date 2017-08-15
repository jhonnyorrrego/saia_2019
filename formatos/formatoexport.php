<?php
include_once("../db.php");
include_once("../header.php");
if(@$_REQUEST["key"] && is_int($_REQUEST["key"])){
  $idformato=$_REQUEST["key"];
  $formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
  $campos="";
  $funciones="";
  $datos=""; 
  //print_r($formato);
  echo("<span class='phpmaker'><br /><br />Listado de Archivos que se deben descargar para exportar/importar el formato <b>".$formato[0]["etiqueta"]."</b>:<br /><br />");
  if($formato["numcampos"]){
    $texto="<?xml version=\"1.0\" encoding=\"UTF-8\"?".">";
    $campos=exportar_tabla("formato_idformato=".$idformato,"formato_idformato","campos_formato",array("idcampos_formato","formato_idformato"));

    if(crear_archivo("importar/".$formato[0]["nombre"]."_campos_formato.sql",$campos)!==false){
      echo('<a href="'.PROTOCOLO_CONEXION.RUTA_PDF.'/formatos/importar/'.$formato[0]["nombre"]."_campos_formato.sql".'">Campos del Formato</a><br />');
    }
    $funciones=exportar_tabla("formato LIKE '".$idformato."' OR formato LIKE '%,".$idformato.",%' OR formato LIKE '%,".$idformato."' OR formato LIKE '".$idformato.",%'","formato","funciones_formato",array("idfunciones_formato","formato"),"nombre");
    $listado_funciones=busca_filtro_tabla("nombre","funciones_formato","formato LIKE '".$idformato."' OR formato LIKE '%,".$idformato.",%' OR formato LIKE '%,".$idformato."' OR formato LIKE '".$idformato.",%'","",$conn);
    $lfunciones=extrae_campo($listado_funciones,"nombre","U,m");
    $funciones.="\n/*inicio_datos--".implode(",",$lfunciones)."--fin_datos*/";
    if(crear_archivo("importar/".$formato[0]["nombre"]."_funciones_formato.sql",$funciones)!==false)
      echo('<a href="'.PROTOCOLO_CONEXION.RUTA_PDF.'/formatos/importar/'.$formato[0]["nombre"]."_funciones_formato.sql".'">Funciones del Formato</a><br />');
    $datos=exportar_tabla("idformato=".$idformato,"","formato",array("idformato"));
    //die($datos);
    if(crear_archivo("importar/".$formato[0]["nombre"]."_datos_exportar.sql",$datos)!==false)
      echo('<a href="'.PROTOCOLO_CONEXION.RUTA_PDF.'/formatos/importar/'.$formato[0]["nombre"]."_datos_exportar.sql".'">Datos del Formato</a><br />');
    if($formato[0]["cod_padre"]){
      $padre=busca_filtro_tabla("","formato","idformato=".$formato[0]["cod_padre"],"",$conn);
      if($padre["numcampos"]){
        echo('<br />Este formato hace parte del formato '.$padre[0]["etiqueta"]."<br /><br />");
        echo('<a href="'.PROTOCOLO_CONEXION.RUTA_PDF.'/formatos/formatoexport.php?key='.$padre[0]["idformato"].'" target="_self">'.$padre[0]["etiqueta"].'</a>');
      }
    }    
    $hijos=busca_filtro_tabla("","formato","cod_padre=".$formato[0]["idformato"],"",$conn);
    if($hijos["numcampos"]){
      echo("<br /><br />Listado de Hijos del Formato <b>".$formato[0]["etiqueta"]."</b><br />(Estos formatos hacen parte del formato principal en un primer nivel)<br /><br />");
      for($i=0;$i<$hijos["numcampos"];$i++){
        echo('Formato Hijo: <a href="'.PROTOCOLO_CONEXION.RUTA_PDF.'/formatos/formatoexport.php?key='.$hijos[$i]["idformato"].'" target="hijos_formatos">'.$hijos[$i]["etiqueta"].'</a><br />');
      }
    }
  }
  echo('</span>');
  include_once("../footer.php");
//volver(1);
}else if( !is_int($_REQUEST["key"]) ){
	die("Se encuentra una posible infecci&oacute;n en su c&oacute;digo, en: la llave key por favor contacte a su administrador");
}
else alerta("Debe seleccionar un Formato para Exportar");

function exportar_tabla($where,$nombre_llave,$tabla,$excluidos,$listado=""){
global $conn;
$valores=array();
$lista_campos=array();

$campo_tabla=array();
array_push($excluidos,$nombre_llave);
if(MOTOR=="MySql"){
  $buscar = ejecuta_filtro_tabla("DESCRIBE ".$tabla,$conn);
}
else if(MOTOR=="Oracle"){
  $buscar = ejecuta_filtro_tabla("SELECT column_name AS field, CONCAT(data_type,CONCAT(CONCAT('(',data_length),')')) as type,data_type, nullable AS null_, data_default AS default_ FROM user_tab_columns WHERE table_name='".strtoupper($tabla)."' ORDER BY column_name ASC",$conn);
}

for($i=0;$i<$buscar["numcampos"];$i++){
	if($buscar[$i]["Type"]=='timestamp')continue;
  $buscar[$i]=array_change_key_case($buscar[$i], CASE_LOWER);
  $nombre_campo=$buscar[$i]["field"];
  array_push($lista_campos,strtolower($nombre_campo));
}
$lista_campos=array_unique($lista_campos);
$campos=busca_filtro_tabla(implode(",",$lista_campos),$tabla,$where,"",$conn);

for($j=0;$j<$campos["numcampos"];$j++){
  $valores=array();
  $campos_finales=array();
  if(strtolower($campos[$j]["tipo_dato"])=='date'||strtolower($campos[$j]["tipo_dato"])=='datetime')continue;
  for($i=0;$i<count($lista_campos);$i++){
 	
    if($lista_campos[$i]=="cod_padre" && $campos[$j][$lista_campos[$i]]){
      $padre=busca_filtro_tabla("etiqueta","formato","idformato=".$campos[$j][$lista_campos[$i]]);
      alerta(codifica_encabezado("Este formato es hijo del formato ".$padre[0][0].". Recuerde exportarlo individualmente y configurar de nuevo el padre a este formato cuando termine la importaci�n."));
      array_push($campos_finales,$lista_campos[$i]);
      array_push($valores,0);
    }
    else if(in_array(strtolower($lista_campos[$i]),$excluidos)==false){
      array_push($campos_finales,$lista_campos[$i]);
      $valor=$campos[$j][$lista_campos[$i]];
      array_push($valores,$valor);
    }
  }
  if($nombre_llave<>""){
    array_push($campos_finales,$nombre_llave);
    array_push($valores,"|-".$nombre_llave."-|");
  }

$texto.="INSERT INTO ".$tabla."(".implode(",",$campos_finales).") VALUES('".implode("','",$valores)."')||\n";
  unset($valores);  
}
//echo($texto.$datos);
return($texto.$datos);
}


function llena_xml_formato($id){
global $conn,$sql,$texto;
if($id=="NULL")
  $papas=busca_filtro_tabla("*","formato","cod_padre=0","etiqueta ASC",$conn);
else
  $papas=busca_filtro_tabla("*","formato","cod_padre=".$id,"etiqueta ASC",$conn);
if($papas["numcampos"])
{ 
  $texto="";
  for($i=0; $i<$papas["numcampos"]; $i++)
  {
    $hijos = busca_filtro_tabla("count(*)","formato","cod_padre=".$papas[$i]["idformato"],"",$conn);
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    echo("text=\"".htmlspecialchars($papas[$i]["etiqueta"])." \" id=\"".$papas[$i]["idformato"]);
    if($hijos[0][0]){
      echo("#2#".$papas[$i]["nombre"]."\" child=\"1\">\n");
      llena_formato($papas[$i]["idformato"]);  
    }  
    else
      echo("#2#".$papas[$i]["nombre"]."\" child=\"0\">\n");
    //llena_serie($papas[$i]["id$tabla"]);
    echo("</item>\n");
  }     
}
return;
}
?>