<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
require_once ($ruta_db_superior . 'StorageUtils.php');
require_once ($ruta_db_superior . 'filesystem/SaiaStorage.php');
$incluidos=array();

function imagen_firma_faltante() {
	echo PROTOCOLO_CONEXION . RUTA_PDF . "/firmas/faltante.jpg' />";
}
function crear_encabezado_pie_pagina($texto,$iddoc,$idformato,$pagina=1){
	global $conn,$ruta_db_superior;
 
 	$resultado1=preg_match_all( '({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*)+\*})' ,$texto, $regs1 );
 	$campos1=array_unique($regs1[0]);
 	$formato=busca_filtro_tabla("*","formato A","idformato=$idformato","",$conn);  
 	if($campos1){
 		for($i=0;$i<count($campos1);$i++){
 			$nombre=str_replace("*}","",str_replace("{*","",$campos1[$i]));
      $compara=busca_filtro_tabla("*","campos_formato A","A.formato_idformato=".$idformato." and nombre like '".$nombre."'","",$conn);
      if($compara["numcampos"]){
      	$texto=str_replace($campos1[$i],mostrar_valor_campo($nombre,$idformato,$_REQUEST["iddoc"],1),$texto);
      }
    }
    $funciones=busca_filtro_tabla("*","funciones_formato A","A.nombre IN('".implode("','",$campos1)."') and acciones like '%m%' and (formato like '$idformato' or formato like '%,$idformato' or  formato like '%,$idformato,%'  or  formato like '$idformato,%')","",$conn);
    $includes="";
    for($i=0;$i<$funciones["numcampos"];$i++){
    	$ruta_orig="";
      $formato_orig=explode(",",$funciones[$i]["formato"]);
      $dato_formato_orig=busca_filtro_tabla("nombre","formato","idformato=".$formato_orig[0],"",$conn);

      if(is_file($ruta_db_superior."/formatos/".$dato_formato_orig[0]["nombre"]."/".$funciones[$i]["ruta"]))
      	include_once($ruta_db_superior."/formatos/".$dato_formato_orig[0]["nombre"]."/".$funciones[$i]["ruta"]);

      if(is_file($ruta_db_superior."/formatos/".$funciones[$i]["ruta"]))
      	include_once($ruta_db_superior."/formatos/".$funciones[$i]["ruta"]);
      if(is_file($ruta_db_superior."/".$dato_formato_orig[0]["nombre"]."/".$funciones[$i]["ruta"])&&$dato_formato_orig["numcampos"])
      	include_once($ruta_db_superior."/".$dato_formato_orig[0]["nombre"]."/".$funciones[$i]["ruta"]);
			if ($funciones[$i]["parametros"] != "")
      	$parametros=explode(",",$idformato.",".$funciones[$i]["parametros"].",".$_REQUEST["iddoc"].",1");
      else
        $parametros=explode(",",$idformato.",".$_REQUEST["iddoc"].",1");  
      $_REQUEST["pagina"]=$pagina;
      
      $texto=str_replace($funciones[$i]["nombre"],call_user_func_array($funciones[$i]["nombre_funcion"], $parametros),$texto);
    }
		if ($formato[0]["librerias"] && $formato[0]["librerias"] != "") {
    	$includes.=include_once($ruta_db_superior."/".$formato[0]["nombre"]."/".$formato[0]["librerias"]);
    }
  }
  if($pagina==0){
  	$texto=str_replace("Pagina ##PAGE## de ##PAGES##","",$texto);
    $texto=str_replace("##PAGE## DE ##PAGES##","",$texto);
  }
  $fuente = busca_filtro_tabla("valor","configuracion","nombre='tipo_letra'","",$conn);
	//$texto.='<style>table,td {font-size:'.$formato[0]["font_size"].'pt; font-family:'.$fuente[0]["valor"].';}</style>';
  return(codifica_encabezado(html_entity_decode(htmlspecialchars_decode($texto))));
}

function arma_funcion($nombre,$parametros,$accion){
	if ($parametros != "" && $accion != "adicionar")
	   $parametros.=",";

	if($accion=="mostrar")
	  $texto="<?php ".$nombre."(".$parametros."$"."_REQUEST['iddoc']); ?".">";
	elseif($accion=="adicionar")
	  $texto="<?php ".$nombre."(".$parametros."); ?".">";
	elseif($accion=="editar")  
	  $texto="<?php ".$nombre."(".$parametros."$"."_REQUEST['iddoc']); ?".">";
	return($texto);
} 

function incluir($cad,$tipo,$eval=0){
global $incluidos;
  $includes="";
  //$cad=str_replace("../","",$cad);
  $lib=array();
  $lib=explode(",",$cad);
  switch($tipo){
    case "librerias":    
      $texto1='<?php include_once("';
      $texto2='"); ?'.'>';
    break;
    case "javascript":
      $texto1='<script type="text/javascript" src="';
      $texto2='"></script>';
    break;
    case "estilos":
      $texto1='<style type="text/css" media="screen" src="';
      $texto2='"></style>';    
    break;
    default:
      return(""); //retorna un vacio si no existe el tipo
    break;
  }
  for($j=0;$j<count($lib);$j++){
    $pos=array_search($texto1.$lib[$j].$texto2,$incluidos);
    if($pos===false){
      if(!is_file($lib[$j])&$eval){
        if(crear_archivo($lib[$j])){
          $includes.=$texto1.$lib[$j].$texto2;
				} else {
          alerta("Problemas al generar el Formato en ".$lib[$j]);
          return("");
        }    
			} else {
        $includes.=$texto1.$lib[$j].$texto2;
      } 
    array_push($incluidos,$texto1.$lib[$j].$texto2);
    }
  } 
return($includes);  
}

function formato_numero($idformato,$doc,$tipo=0){
global $conn;
$documento=busca_filtro_tabla("numero","documento A","A.iddocumento=".$doc,"",$conn);
$carta=busca_filtro_tabla("varios_radicados,destinos","ft_carta A","A.documento_iddocumento=".$doc,"",$conn);

	if ($carta["numcampos"] && $carta[0]["varios_radicados"]) {
		$destinos = explode(",", $carta[0]["destinos"]);
   if(!isset($_REQUEST["destino"])||$_REQUEST["destino"]=="")
     $_REQUEST["destino"]=$destinos[0]; 
   $radicado=busca_filtro_tabla("radicado","radicados_carta","destino='".$_REQUEST["destino"]."' and documento_iddocumento=$doc","",$conn);
   if($radicado["numcampos"])
     $documento[0]["numero"]= $radicado[0][0];
  }
  
if($documento["numcampos"]){
	if($tipo)
   		return ($documento[0]["numero"]);
 	else
   		echo  $documento[0]["numero"];
} else
	echo ("");
}

function formato_serie($idformato,$doc,$tipo=0){
global $conn;
$serie=busca_filtro_tabla("B.codigo as serie","serie B,documento C","C.iddocumento=".$doc." AND C.serie=B.idserie","",$conn);
if($serie["numcampos"]){
  if($tipo)
    return ($serie[0]["serie"]);
  else
    echo   $serie[0]["serie"];
} else
	return ("");
}

function dependencia_codigo($idformato, $doc, $tipo = 0) {
 if ($tipo)
  return(formato_dependencia($doc,"codigo"));
 else
  echo formato_dependencia($doc,"codigo");
}

function dependencia_nombre($idformato, $doc, $tipo = 0) {
 if ($tipo)
  return(formato_dependencia($doc,"nombre"));
 else
  echo formato_dependencia($doc,"nombre");
}

function dependencia_logo($idformato,$doc,$tipo=0){
 if($tipo)
  return(formato_dependencia($doc,"logo"));
 else
  echo formato_dependencia($doc,"logo");
}

function formato_dependencia($doc,$tipo){
global $conn;
$retorno="";
$plantilla=busca_filtro_tabla("lower(plantilla) as plantilla","documento B","iddocumento=".$doc,"",$conn);
$tabla=busca_filtro_tabla('nombre_tabla','formato',"nombre like '".strtolower($plantilla[0]["plantilla"])."'",'',$conn);
$dep=busca_filtro_tabla("A.*","dependencia A,dependencia_cargo C,".$tabla[0]["nombre_tabla"]." B","C.dependencia_iddependencia=A.iddependencia and B.dependencia=C.iddependencia_cargo and B.documento_iddocumento=$doc","",$conn);

if($dep["numcampos"]){
 if ($tipo == "logo") {
    if ($dep[0][$tipo])
      $retorno=PROTOCOLO_CONEXION.RUTA_PDF.'/formatos/librerias/mostrar_logo.php?codigo='.$dep[0]["iddependencia"].'" />';
    else
      $retorno=logo_empresa();   
 } else
   $retorno=$dep[0][$tipo];
}
return ($retorno);
}
function nombre_proceso($doc) {
 global $conn;
 $datos = array();
 $nombre=busca_filtro_tabla("nombre_proceso,codigo,fecha_proceso,version","proceso","documento_iddocumento=".$doc,"",$conn); 
	if ($nombre["numcampos"] > 0) {
		$datos["nombre_proceso"] = $nombre[0]["nombre_proceso"];
    $datos["fecha"]=$nombre[0]["fecha_proceso"];
    $datos["version"]=$nombre[0]["version"];
    $datos["codigo"]=$nombre[0]["codigo"];
    return($datos);
	} else
           return("");
}

function logo_empresa() {
 global $conn;
 $logo = busca_filtro_tabla("valor","configuracion","nombre='logo'","",$conn);
 if($logo["numcampos"]){
		// $tipo_almacenamiento = new SaiaStorage("archivos");
		$tipo_almacenamiento = new SaiaStorage("archivos");
		$ruta_imagen=json_decode($logo[0]["valor"]);
		if( is_object ($ruta_imagen) ){
			if($tipo_almacenamiento->get_filesystem()->has($ruta_imagen->ruta)){
				$ruta_imagen=json_encode($ruta_imagen);
				$archivo_binario=StorageUtils::get_binary_file($ruta_imagen);
				return ('<img src="' . $archivo_binario . '" width="109" />');
 }
		}
		//$archivo_binario = StorageUtils::get_binary_file($logo[0]["valor"]);
	} else
		return ("");
}

function logo_encabezado() {
	global $conn;
	$logo = busca_filtro_tabla("valor", "configuracion", "nombre='logo_comunicaciones'", "", $conn);
	if ($logo["numcampos"]) {
		;
		if ($_REQUEST['plantilla'] == "carta" || $_REQUEST['plantilla'] == "memorando" || $_REQUEST['plantilla'] == "circular_mf") {
			return ("<div><img style='left:-40px;top:-175px;position:fixed;' src='" . PROTOCOLO_CONEXION . RUTA_PDF . "/" . $logo[0]["valor"] . "' border='0' /></div>");
		} else {
			return ('<div><img style="left:20px;top:35px" src="' . PROTOCOLO_CONEXION . RUTA_PDF . '/' . $logo[0]["valor"] . '" border="0"></div>');
		}
	} else
		return ("");
}

function nombre_empresa() {
	global $conn;
	$logo = busca_filtro_tabla("valor", "configuracion", "nombre='nombre'", "", $conn);
	if ($logo["numcampos"]) {
		return ($logo[0]["valor"]);
	} else
		return ("");
}

function nombre_empresa2() {
	global $conn;
	$logo = busca_filtro_tabla("valor", "configuracion", "nombre='nombre'", "", $conn);
	if ($logo["numcampos"]) {
		return (mayusculas($logo[0]["valor"]));
	} else
		return ("");
}

function estilo_formato($idformato, $iddoc, $pagina) {
	global $conn;
	$fuente = busca_filtro_tabla("valor", "configuracion", "nombre='tipo_letra'", "", $conn);
	$doc = $_REQUEST["iddoc"];
	$plantilla = busca_filtro_tabla("lower(plantilla) as plantilla", "documento B", "iddocumento=" . $doc, "", $conn);
	$size = busca_filtro_tabla('font_size', 'formato', "nombre like '" . strtolower($plantilla[0]["plantilla"]) . "'", '', $conn);
	// cambio de tama�o de letra por el request
	if (isset($_REQUEST["font_size"]))
		$size[0]["font_size"] = $_REQUEST["font_size"];

	if (!$_REQUEST["pagina"])
		return "font-size:9pt; font-family:verdana;";
	elseif ($fuente["numcampos"])
		return "font-size:" . $size[0]["font_size"] . "pt; font-family:" . $fuente[0]["valor"] . ";";
}

function version_calidad() {
	global $conn;
	$formato = busca_filtro_tabla("nombre_tabla,nombre", "formato", "idformato=$idformato", "", $conn);
	$valor = busca_filtro_tabla("version_" . $formato[0]["nombre"], $formato[0]["nombre_tabla"], "documento_iddocumento=$iddoc", "", $conn);
	if ($tipo)
		return ($valor[0][0]);
	else
		echo $valor[0][0];
}

function nombre_formato($idformato, $iddoc, $tipo) {
	global $conn;
	$formato = busca_filtro_tabla("etiqueta", "formato", "idformato=$idformato", "", $conn);
	if ($tipo)
		return (((ucfirst($formato[0][0]))));
	else
		echo ucfirst($formato[0][0]);
}

function codigo_calidad($idformato, $iddoc, $tipo) {
	global $conn;
	global $conn;
	$formato = busca_filtro_tabla("nombre_tabla,nombre", "formato", "idformato=$idformato", "", $conn);
	$valor = busca_filtro_tabla("codigo_" . $formato[0]["nombre"], $formato[0]["nombre_tabla"], "documento_iddocumento=$iddoc", "", $conn);
	if ($tipo)
		return ($valor[0][0]);
	else
		echo $valor[0][0];
}

function nombre_calidad($idformato, $iddoc, $tipo) {
	global $conn;
	global $conn;
	$formato = busca_filtro_tabla("nombre_tabla,nombre", "formato", "idformato=$idformato", "", $conn);
	$valor = busca_filtro_tabla("nombre_" . $formato[0]["nombre"], $formato[0]["nombre_tabla"], "documento_iddocumento=$iddoc", "", $conn);
	if ($tipo)
		return ($valor[0][0]);
	else
		echo $valor[0][0];
}

function encabezado_ruta_n($idformato, $iddoc) {
	return ("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . PROTOCOLO_CONEXION . RUTA_PDF . "/imagenes/encabezado_ruta_n.jpg' border='0' />");
}

function footer_rutan($idformato, $iddoc) {
	return (" <img src=" . PROTOCOLO_CONEXION . RUTA_PDF . "/imagenes/footer_rutan.jpg' border='0'/>");
}

function encabezado_legalizacion($idformato, $iddoc) {
	return '<img src= ' . PROTOCOLO_CONEXION . RUTA_PDF . '/imagenes/logo_legalizacion.png"  >';
}

function encabezado_orden($idformato, $iddoc) {
	return '<img src= ' . PROTOCOLO_CONEXION . RUTA_PDF . '/imagenes/logo_demo.jpg" >';
}

function mostrar_datos_radicaion($idformato, $iddoc) {
	global $conn;
	// echo(estilo_bootstrap());
	$datos_radicacion = busca_filtro_tabla("", "documento", "iddocumento=" . $iddoc, "", $conn);
	$nombre_empresa = busca_filtro_tabla("valor", "configuracion", "LOWER(nombre) LIKE'nombre'", "", $conn);
	if ($_REQUEST['tipo'] != 5) {
		$margin = "margin-top:37px;";
	} else {
		$margin = "margin-top:-30px;";
	}
	$datos = "<div id='header_first_page' style='float:right; border-radius: 5px; " . $margin . "'>
	<div style='border: solid 1px; padding:10px; font-size: 16px; '><b style='float:right;'>" . $nombre_empresa[0]['valor'] . "</b><br />";
	$datos .= "<b>Radicado No:</b> " . formato_numero($idformato, $iddoc, 1) . '<br />';
	$date = new DateTime($datos_radicacion[0]['fecha']);
	$datos .= "<b>Fecha:</b> " . $date->format('Y-m-d H:i') . '<br />';
	$datos .= "</div></div>";
	return ($datos);
}

function pie_pagina_carta($idformato, $iddoc) {
	global $conn;
	return ('<img src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/imagenes/pie_pagina_carta.jpg" />');
}
function qr_entrega_interna($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	include_once($ruta_db_superior."pantallas/qr/librerias.php");

	$qr=mostrar_codigo_qr($idformato,$iddoc,true);
	return($qr."<br/>Planilla No. ".formato_numero($idformato,$iddoc,1));
}
function recorrido($idformato,$iddoc){
	return(mostrar_valor_campo('tipo_recorrido',$idformato,$iddoc,1));
}
function fecha_planilla($idformato,$iddoc){
	global $conn;
	$fecha_planilla=busca_filtro_tabla(fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","documento","iddocumento=".$iddoc,"",$conn);
    return($fecha_planilla[0]['fecha']);
}
function mensajero_entrega_interna($idformato,$iddoc){
	global $conn;
	$documentos2=busca_filtro_tabla("","ft_despacho_ingresados","documento_iddocumento=".$iddoc,"",$conn);
	if($documentos2[0]['tipo_mensajero']=='e'){
		$empresa_transportadora=busca_filtro_tabla("nombre","cf_empresa_trans","idcf_empresa_trans=".$documentos2[0]['mensajero'],"",$conn);
		$cadena_nombre=$empresa_transportadora[0]['nombre'];
	}else{
		$funcionario=busca_filtro_tabla("","vfuncionario_dc","estado=1 and estado_dc=1 and iddependencia_cargo=".$documentos2[0]['mensajero'],"",$conn);
		$cadena_nombre=$funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'];
	}
	return(ucwords(strtolower($cadena_nombre)));
}
?>
