<?php
if(@$_REQUEST["iddoc"] || @$_REQUEST["key"]){
	include_once("pantallas/documento/menu_principal_documento.php");
	echo(menu_principal_documento($_REQUEST["iddoc"],@$_REQUEST["vista"]));
}
include_once("db.php");
include_once("header.php");
$x_iddocumento=$_REQUEST["iddoc"]; 
menu_ordenar($x_iddocumento,0,1);

?> 
<script type="text/javascript">
var hs = {
    expand: function (element, params, custom) {
        top.window.focus(); // to allow keystroke listening
        return top.window.hs.expand(element, params, custom);
    },
    htmlExpand: function (element, params, custom) {
        top.window.focus(); // to allow keystroke listening
        return top.window.hs.htmlExpand(element, params, custom);
    }
}
</script>
<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<br /><br />
<b>Documentos vinculados</b><br /><br />
<style>
 
  .tabla_borde td,tr{
    border:1px solid;
  }
</style>
<?php
$texto='<table style="width:100%;border-collapse:collapse; border:1px solid;" class="tabla_borde"><tr><td colspan="6" class="encabezado_list">Documentos Vinculados</td></tr>';
$vinculados=busca_filtro_tabla("distinct iddocumento,descripcion,plantilla,nombres,apellidos,numero,funcionario_codigo,iddocumento_vinculados","documento_vinculados A,documento B,funcionario C","A.documento_destino=B.iddocumento AND A.funcionario_idfuncionario=C.idfuncionario AND A.documento_origen=".$x_iddocumento,"",$conn);
$texto.='<tr class="encabezado_list"><td>Vista Previa</td><td>N&uacute;mero</td><td>Descripci&oacute;n</td><td>Formato</td><td>Vinculado por </td></tr>';
for($i=0;$i<$vinculados["numcampos"];$i++){
  $texto.='<tr><td align="center"><a  href="ordenar.php?accion=mostrar&mostrar_formato=1&menu_previsualizar=1&key='.$vinculados[$i]["iddocumento"].'"  class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 750, height:400,preserveContent:false } )"><img src="botones/expedientes/page_white_magnify.png"></a></td><td>'.$vinculados[$i]["numero"].'</td><td>'.$vinculados[$i]["descripcion"].'</td><td>'.$vinculados[$i]["plantilla"].'</td><td>'.$vinculados[$i]["nombres"]." ".$vinculados[$i]["apellidos"];
  if(usuario_actual('funcionario_codigo')==$vinculados[$i]["funcionario_codigo"])
  $texto.='<a href="vincular_documentodelete.php?id='.$vinculados[$i]["iddocumento_vinculados"].'&iddoc='.$x_iddocumento.'">Desvincular</a>';
  $texto.='</td></tr>';
}

$texto.='</table>';
echo($texto); 

/**********VINCULADO CON**************/

/*$texto='<br /><br /><table style="width:100%;border-collapse:collapse; border:1px solid;" class="tabla_borde"><tr><td colspan="6" class="encabezado_list">Documentos Que lo vinculan</td></tr>';
$vinculados=busca_filtro_tabla("distinct iddocumento,descripcion,plantilla,nombres,apellidos,numero,funcionario_codigo,iddocumento_vinculados","documento_vinculados A,documento B,funcionario C","A.documento_origen=B.iddocumento AND A.funcionario_idfuncionario=C.idfuncionario AND A.documento_destino=".$x_iddocumento,"",$conn);
$texto.='<tr class="encabezado_list"><td>Vista Previa</td><td>N&uacute;mero</td><td>Descripci&oacute;n</td><td>Formato</td><td>Vinculado por </td></tr>';
for($i=0;$i<$vinculados["numcampos"];$i++){
  $texto.='<tr><td align="center"><a href="ordenar.php?accion=mostrar&mostrar_formato=1&menu_previsualizar=1&key='.$vinculados[$i]["iddocumento"].'"  class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 750, height:400,preserveContent:false } )" ><img src="botones/expedientes/page_white_magnify.png"></a></td><td>'.$vinculados[$i]["numero"].'</td><td>'.$vinculados[$i]["descripcion"].'</td><td>'.$vinculados[$i]["plantilla"].'</td><td>'.$vinculados[$i]["nombres"]." ".$vinculados[$i]["apellidos"];
  if(usuario_actual('funcionario_codigo')==$vinculados[$i]["funcionario_codigo"])
  $texto.='<a href="vincular_documentodelete.php?id='.$vinculados[$i]["iddocumento_vinculados"].'&iddoc='.$x_iddocumento.'">Desvincular</a>';
  $texto.='</td></tr>';
}
$texto.='</table>';
echo($texto);*/

/**********RESPUESTAS DEL DOCUMENTO**************/

$texto='<br /><br /><table style="width:100%;border-collapse:collapse; border:1px solid;" class="tabla_borde"><tr><td colspan="6" class="encabezado_list">Respuestas del documento</td></tr>';
$vinculados=busca_filtro_tabla("","respuesta A,documento B","A.destino=B.iddocumento AND A.origen=".$x_iddocumento,"",$conn);
$texto.='<tr class="encabezado_list"><td>Vista Previa</td><td>N&uacute;mero</td><td>Descripci&oacute;n</td><td>Formato</td><!--td>Vinculado por </td--></tr>';
for($i=0;$i<$vinculados["numcampos"];$i++){
  $texto.='<tr><td align="center"><a href="ordenar.php?accion=mostrar&mostrar_formato=1&menu_previsualizar=1&key='.$vinculados[$i]["iddocumento"].'"  class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 750, height:400,preserveContent:false } )"><img src="botones/expedientes/page_white_magnify.png"></a></td><td>'.$vinculados[$i]["numero"].'</td><td>'.$vinculados[$i]["descripcion"].'</td><td>'.$vinculados[$i]["plantilla"].'</td><!--td>'.$vinculados[$i]["nombres"]." ".$vinculados[$i]["apellidos"].'</td--></tr>';
}

$texto.='</table>';
echo($texto); 

/**********ES RESPUESTA DE**************/

$texto='<br /><br /><table style="width:100%;border-collapse:collapse; border:1px solid;" class="tabla_borde"><tr><td colspan="6" class="encabezado_list">Es Respuesta de Los siguientes Documentos</td></tr>';
$vinculados=busca_filtro_tabla("","respuesta A,documento B","A.origen=B.iddocumento  AND A.destino=".$x_iddocumento,"",$conn);
$texto.='<tr class="encabezado_list"><td>Vista Previa</td><td>N&uacute;mero</td><td>Descripci&oacute;n</td><td>Formato</td><!--td>Vinculado por </td--></tr>';
for($i=0;$i<$vinculados["numcampos"];$i++){
  $texto.='<tr><td align="center"><a href="ordenar.php?accion=mostrar&mostrar_formato=1&menu_previsualizar=1&key='.$vinculados[$i]["iddocumento"].'"  class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 750, height:400,preserveContent:false } )" ><img src="botones/expedientes/page_white_magnify.png"></a></td><td>'.$vinculados[$i]["numero"].'</td><td>'.$vinculados[$i]["descripcion"].'</td><td>'.$vinculados[$i]["plantilla"].'</td><!--td>'.$vinculados[$i]["nombres"]." ".$vinculados[$i]["apellidos"].'</td--></tr>';
}
$texto.='</table>';
echo($texto);
include_once("footer.php");
?>