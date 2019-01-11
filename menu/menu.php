<?php if(!isset($_SESSION))
  session_start();
include_once("../db.php");
?>
<link href="../css/menu.css" rel="stylesheet" type="text/css" />
<!--
  jQuery library
-->
<script type="text/javascript" src="../js/jquery.js"></script>
<!--
  jCarousel library
-->
<script type="text/javascript" src="../js/jquery.jcarousel.js"></script>
<!--
  jCarousel core stylesheet
-->
<link rel="stylesheet" type="text/css" href="../css/jquery.jcarousel.css" />
<!--
  jCarousel skin stylesheet
-->
<link rel="stylesheet" type="text/css" href="../css/skin_menu.css" />
<style type="text/css">
<!--
/**
 * Overwrite for having a carousel with dynamic width.
 */
.jcarousel-skin-tango .jcarousel-container-horizontal {
    width: 400px;
    height:35px;
}

.jcarousel-skin-tango .jcarousel-clip-horizontal {
    width: 400px;
    height:40px;
}
-->
</style>
<script type="text/javascript">
<!--
jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
        scroll: 16,
        initCallback: mycarousel_initCallback,
        visible: 16
    });
});
function mostrar_titulo(texto,item){
    jQuery('#actual').empty();
    jQuery('#actual').append(texto);
}
function ocultar_titulo(texto){
    jQuery('#actual').empty();
    jQuery('#actual').append("&nbsp;");
}
function mycarousel_initCallback(carousel) {
    jQuery('.jcarousel-control span').bind('click', function() {
        carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
        return false;
    });

    jQuery('.jcarousel-scroll select').bind('change', function() {
        carousel.options.scroll = jQuery.jcarousel.intval(this.options[this.selectedIndex].value);
        return false;
    });

    jQuery('#mycarousel-next').bind('click', function() {
        carousel.next();
        return false;
    });

    jQuery('#mycarousel-prev').bind('click', function() {
        carousel.prev();
        return false;
    });
};
-->
</script>
<?php
$iddoc=0;
if(@$_SESSION["LOGIN".LLAVE_SAIA]){
include_once("../db.php");
$usuario_actual=usuario_actual("idfuncionario");
$modulo["numcampos"]=0;
if(isset($_GET["modulo"])&&$_GET["modulo"]){
  $modulo=busca_filtro_tabla("*","modulo A","A.nombre in('acciones_menu_intermedio','informacion_menu_intermedio','otros_menu_intermedio','menu_ordenar')","",$conn);
	$modulos_array=extrae_campo($modulo,"idmodulo");
  if($modulo["numcampos"]){
    $condicion="A.modulo_idmodulo=B.idmodulo AND B.cod_padre in (".implode(",",$modulos_array).") AND A.funcionario_idfuncionario=".$usuario_actual;
    $adicionados=busca_filtro_tabla("B.idmodulo","permiso A, modulo B",$condicion." AND A.accion=1","",$conn);
    $suprimidos= busca_filtro_tabla("B.idmodulo","permiso A, modulo B",$condicion." AND (A.accion=0 OR A.accion IS NULL)","",$conn);
	$perfiles=busca_filtro_tabla("perfil","funcionario","idfuncionario=".$usuario_actual,"",$conn);
    $permisos_perfil=busca_filtro_tabla("C.idmodulo","permiso_perfil A,funcionario B,modulo C","A.perfil_idperfil in (".$perfiles[0]["perfil"].") AND A.modulo_idmodulo=C.idmodulo AND C.cod_padre in (".implode(",",$modulos_array).") AND B.idfuncionario=".$usuario_actual,"",$conn);

    $adicionales=extrae_campo($adicionados,"idmodulo","U");
    $suprimir=extrae_campo($suprimidos,"idmodulo","U");
    $permisos=extrae_campo($permisos_perfil,"idmodulo","U");
    $finales=array_diff(array_merge((array)$permisos,(array)$adicionales),$suprimir);

    if(count($finales))
     $tablas=busca_filtro_tabla("modulo.nombre,modulo.etiqueta,modulo.imagen,modulo.enlace,modulo.destino,modulo.ayuda,modulo.parametros","modulo","idmodulo IN(".implode(",",$finales).")","modulo.orden ASC",$conn);
    else
      $tablas["numcampos"]=0;
  
  }
}
if($tablas["numcampos"]){
$datos_doc=busca_filtro_tabla("","documento","iddocumento=".@$_REQUEST["key"],"",$conn);
$datos_pag=busca_filtro_tabla("","pagina","id_documento=".@$_REQUEST["key"],"",$conn);
$text='<div id="wrap" align="center"><div id="actual">&nbsp;</div>';
$text2='';
$text3='';
for($j=0;$j<$tablas["numcampos"];$j++){
  $ayuda_submenu=$tablas[$j]["ayuda"];
  $arreglo=explode(",",$tablas[$j]["parametros"]);
  for($h=0;$h<count($arreglo)-1;$h++){
    if(array_search($arreglo[$h],$_REQUEST)!==FALSE && $_REQUEST[$arreglo[$h]]){
      if(!strpos($tablas[$j]["enlace"],"?"))
       $tablas[$j]["enlace"].="?".$arreglo[$h]."=".$_REQUEST[$arreglo[$h]];
      else  $tablas[$j]["enlace"].="&".$arreglo[$h]."=".$_REQUEST[$arreglo[$h]];
    }
  }
  if(isset($_REQUEST["key"]) && $_REQUEST["key"]<>"")
      {$tablas[$j]["enlace"]=str_replace("@key@",$_REQUEST["key"],$tablas[$j]["enlace"]);
      }
    $text2.=valida_item_menu($iddoc);
}
  $text.='
  <ul id="mycarousel" class="jcarousel-skin-tango">';
  $text2.='</ul>
  <!--div class="jcarousel-control"><span>Opcion:</span>';
  $text3.='</div--></div>';
echo($text.$text2.$text3);
}
}
function valida_item_menu(){
global $tablas,$j,$datos_doc,$doc_pag,$datos_pag;
$imprimir=false;
$lista_aprobados=array("almacenamiento","despacho","enviar_documento_correo","responder");
$lista_no_aprobados=array("eliminar_borrador");
$lista_todos=array("adicionar_comentario","administrar_comentario","adicionar_pag","anexos_documento","clasificar","detalles","devolucion","expediente","graficos_reportes","imagenes_pdf","imprimir_radicado","mostrar_documentos","seguimiento","tareas","terminar_documento","transferir","adicionar_etiqueta","verificar_flujo_documento");
$lista_activos=array("editar","responder");
$lista_paginas=array("ordenar_pag","adicionar_comentario","enviar_documento_correo","administrar_comentario","eliminar_paginas");
//print_r($datos_doc);
if($tablas[$j]["nombre"]=="solicitar_anulacion" && $datos_doc[0]["estado"]=="APROBADO" && $datos_doc[0]["responsable"]==usuario_actual("funcionario_codigo"))
{$imprimir=true;
}
if(!$imprimir && in_array(strtolower($tablas[$j]["nombre"]),$lista_todos)){
  $imprimir=true;
}
if($datos_pag["numcampos"] && in_array(strtolower($tablas[$j]["nombre"]),$lista_paginas)){
  $imprimir=true;
}
if(!$imprimir && $datos_doc[0]["estado"]<>"INICIADO" && $datos_doc[0]["estado"]<>"ACTIVO" && $datos_doc[0]["numero"] && in_array(strtolower($tablas[$j]["nombre"]),$lista_aprobados)){

  $imprimir=true;
}
if(!$imprimir && $datos_doc[0]["plantilla"]=="" && in_array(strtolower($tablas[$j]["nombre"]),$lista_activos)){
  $imprimir=true;
}
if(!$imprimir && !$datos_doc[0]["numero"] && in_array(strtolower($tablas[$j]["nombre"]),$lista_no_aprobados)){
  $imprimir=true;
}

if(!$imprimir && $datos_doc[0]["pdf"]!="" && $datos_doc[0]["numero"] && !in_array($tablas[$j]["nombre"],$lista_no_aprobados)){
  $imprimir=true;
}

if($imprimir){
$exp="";
if(isset($_REQUEST["exp"]))
  $exp="&mostrar_menu=1";
  $texto='<li><a href="#" onclick="parent.location=\'../'.$tablas[$j]["enlace"].$exp.'\';" ><img title="'.$tablas[$j]["etiqueta"].'" alt="'.$tablas[$j]["etiqueta"].'" src="../'.$tablas[$j]["imagen"].'" width="16px" height="16px" onmousemove="mostrar_titulo('."'".$tablas[$j]["etiqueta"]."',this".'); return false" onmouseout="ocultar_titulo(this)"/></a></li>';
return($texto);
}
}
?>