<?php
@set_time_limit(0);
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."formatos/librerias/encabezado_pie_pagina.php");
global $conn;
$marca="";

if($_REQUEST["iddoc"]&&$_REQUEST["plantilla"]){
	if(isset($_REQUEST["destinos"]))
		$_REQUEST["destino"]=$_REQUEST["destinos"];
	$header=encabezado_pie_pagina($_REQUEST["plantilla"],$_REQUEST["iddoc"]);
}

if(isset($_REQUEST["margenes"])&&$_REQUEST["margenes"]){
	$margenes=explode(",",$_REQUEST["margenes"]);
	$header[0]["margen_izquierda"]=$margenes[0];
	$header[0]["margen_derecha"]=$margenes[1];
	$header[0]["margen_inferior"]=$margenes[3];
	$header[0]["margen_superior"]=$margenes[2];
}

if(!isset($_REQUEST["process_mode"])){
	$_REQUEST["process_mode"] = "single";
}
$_REQUEST["toc-location"] = "before";


if(!isset($_REQUEST["URL"])){

	$_REQUEST["URL"]=PROTOCOLO_CONEXION.RUTA_PDF.FORMATOS_CLIENTE.$_REQUEST["plantilla"]."/mostrar_".$_REQUEST["plantilla"].".php?tipo=5&iddoc=".$_REQUEST["iddoc"]."&output=2&idfunc=".usuario_actual("funcionario_codigo");
	if(isset($_REQUEST["font_size"])){
		$_REQUEST["URL"].="&font_size=".$_REQUEST["font_size"];
	}

	if(isset($_REQUEST["tipo_impresion"])){
		$_REQUEST["URL"].="&tipo_impresion=".$_REQUEST["tipo_impresion"];
	}

	if(isset($_REQUEST["destinos"])){
		$_REQUEST["URL"].="&destino=".$_REQUEST["destinos"];
		if(isset($_REQUEST["ocultar_firmas"])){
			$_REQUEST["URL"].="&ocultar_firmas=".$_REQUEST["ocultar_firmas"];
		}
		$_REQUEST["process_mode"]="single";
	}

	if(isset($_REQUEST["plantilla"])&&!isset($_REQUEST["seleccion"])){
		if(isset($_REQUEST["iddoc"])){

			$borrador=busca_filtro_tabla("pdf,iddocumento,estado,plantilla,".fecha_db_obtener('fecha','Y-m-d')." as fecha,".fecha_db_obtener('fecha','Y-m')." as fecha2,numero ","documento","iddocumento=".$_REQUEST["iddoc"],"",$conn);
			if($borrador[0]["estado"]=="ANULADO"){
				$marca="ANULADO";
			}
			else{
				$anulado=busca_filtro_tabla("","documento_anulacion a","a.documento_iddocumento=".$_REQUEST["iddoc"]." and estado='ANULADO'","",$conn);
				if($anulado["numcampos"]){
					$marca="ANULADO";
				}
			}

			if($borrador["numcampos"] && isset($borrador[0]["estado"]) && ($borrador[0]["estado"]=='ACTIVO' || $borrador[0]["estado"]=='TRAMITE' || $borrador[0]["estado"]=='BORRADOR')){
				$marca="BORRADOR";
				$borrador[0]["nombre"]=$borrador[0]["iddocumento"]."_BORRADOR_";
				if($borrador[0]["plantilla"]!="")
					$borrador[0]["nombre"].=$borrador[0]["plantilla"]."_";
				$borrador[0]["nombre"].=str_replace("-","_",$borrador[0]["fecha"]);
				$filename=$borrador[0]["nombre"];
			}else if($borrador["numcampos"] && isset($borrador[0]["estado"]) && ($borrador[0]["estado"]=='APROBADO' || $borrador[0]["estado"]=='GESTION' || $borrador[0]["estado"]=='CENTRAL' || $borrador[0]["estado"]=='HISTORICO'|| $borrador[0]["estado"]=='ANULADO')){
				$borrador[0]["nombre"]="";
				if($borrador[0]["plantilla"]!="")
					$borrador[0]["nombre"]=$borrador[0]["plantilla"]."_";
				$borrador[0]["nombre"].=$borrador[0]["numero"]."_".str_replace("-","_",$borrador[0]["fecha"]);
				$filename=$borrador[0]["nombre"];

				 //******nueva ruta *******
				$ruta_almacenamiento=ruta_almacenamiento("pdf",0);
				$ruta_almacenamiento2=ruta_almacenamiento("pdf");
				$fecha_array=explode("-",$borrador[0]["fecha"]);

				$ruta_nueva =$ruta_almacenamiento2.$borrador[0]["estado"]."/".$fecha_array[0]."-".$fecha_array[1]."/".$borrador[0]["numero"]."/pdf/";
				crear_destino($ruta_nueva);
				$nomarch=$ruta_almacenamiento.$borrador[0]["estado"]."/".$fecha_array[0]."-".$fecha_array[1]."/".$borrador[0]["iddocumento"]."/pdf/".$filename.".pdf";
				//********fin nueva ruta **********

				$formato=busca_filtro_tabla("","formato","lower(nombre)='".strtolower($_REQUEST["plantilla"])."'","",$conn);
				if($borrador[0]["pdf"]<>"" && is_file($ruta_almacenamiento2.$borrador[0]["pdf"])){
					//redirecciona($ruta_almacenamiento2.$borrador[0]["pdf"]);
					//die();
				}else{
					$sql="UPDATE documento SET pdf='".$nomarch."' WHERE iddocumento=".$_REQUEST["iddoc"];
					phpmkr_query($sql,$conn);
				}
			}
		}
	}
}

$_REQUEST["output"]="2";
$_REQUEST["renderimages"]="1" ;
$_REQUEST["renderfields"]="1" ;

//papel
if(isset($_REQUEST["papel"])&&$_REQUEST["papel"])
  $_REQUEST["media"]=$_REQUEST["papel"];
else
  $_REQUEST["media"]="Letter" ;
//orientacion
if(isset($_REQUEST["orientacion"])&&$_REQUEST["orientacion"]=="1")
  $_REQUEST["landscape"]=1;

$_REQUEST["cssmedia"]="screen" ;

if(isset($header)){
  $_REQUEST["leftmargin"]=$header[0]["margen_izquierda"] ;
  $_REQUEST["rightmargin"]=$header[0]["margen_derecha"];
  $_REQUEST["topmargin"]=$header[0]["margen_superior"] ;
  $_REQUEST["bottommargin"]=$header[0]["margen_inferior"] ;
  $_REQUEST["headerhtml"]=$header[0]["encabezado"];
  $_REQUEST["footerhtml"]=$header[0]["pie_pagina"];

}

$_REQUEST["encoding"]="" ;
$_REQUEST["watermarkhtml"]=$marca;
$_REQUEST["method"]="fpdf" ;
$_REQUEST["pdfversion"]="1.3" ;
$_REQUEST["pslevel"]="3";

function encabezado_pie_pagina($plantilla,$doc,$vista=0){
global $conn;
$header=array();
if($vista)
  $header=busca_filtro_tabla("v.encabezado,v.pie_pagina,v.margenes,nombre_tabla,idformato,v.orientacion,v.papel","formato,vista_formato v","idvista_formato='".$_REQUEST["vista"]."' and idformato=formato_padre","",$conn);
else
  $header=busca_filtro_tabla("encabezado,pie_pagina,margenes,nombre_tabla,idformato,orientacion,papel","formato","nombre='".$plantilla."'","",$conn);
$mostrar=busca_filtro_tabla("encabezado",$header[0]['nombre_tabla'],"documento_iddocumento=$doc","",$conn);

$encabezado=busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato=".$header[0]["encabezado"],"",$conn);
$pie=busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato=".$header[0]["pie_pagina"],"",$conn);

if(!$header["numcampos"]){
  $header[0]["encabezado"]="";
  $header[0]["pie_pagina"]="";
  $header[0]["margen_izquierda"]=35;
  $header[0]["margen_inferior"]=30;
  $header[0]["margen_derecha"]=26;
  $header[0]["margen_superior"]=20;
}
else {
  $margenes=explode(",",$header[0]["margenes"]);
  $header[0]["margen_izquierda"]=$margenes[0];
  $header[0]["margen_derecha"]=$margenes[1];
  $header[0]["margen_inferior"]=$margenes[3];
  $header[0]["margen_superior"]=$margenes[2];
  if($header[0]["orientacion"])
    $_REQUEST["orientacion"]=1;
  $_REQUEST["papel"]=$header[0]["papel"];

  if($header[0]["encabezado"]=="" || $header[0]["encabezado"]==Null){
    $header[0]["encabezado"]="";
  }
  if($header[0]["pie_pagina"]=="" || $header[0]["pie_pagina"]==Null){
    $header[0]["pie_pagina"]="";
  }
  if($header[0]["margen_izquierda"]=="" || $header[0]["margen_izquierda"]==Null){
    $header[0]["margen_izquierda"]=35;
  }
  if($header[0]["margen_derecha"]=="" || $header[0]["margen_derecha"]==Null){
    $header[0]["margen_derecha"]=26;
  }
  if($header[0]["margen_inferior"]=="" || $header[0]["margen_inferior"]==Null){
    $header[0]["margen_inferior"]=30;
  }
  if($header[0]["margen_superior"]=="" || $header[0]["margen_superior"]==Null){
    $header[0]["margen_superior"]=20;
  }
}
if($encabezado["numcampos"])
  $header[0]["encabezado"]=crear_encabezado_pie_pagina(stripslashes($encabezado[0][0]),$doc,$header[0]["idformato"]);

if($pie["numcampos"])
  $header[0]["pie_pagina"]=crear_encabezado_pie_pagina(stripslashes($pie[0][0]),$doc,$header[0]["idformato"]);
if(!$mostrar[0][0])
   {$header[0]["encabezado"]="";
    $header[0]["pie_pagina"]="";
   }

return($header);
}
?>
