<?php
include_once("../librerias/funciones_generales.php");
include_once("../librerias/estilo_formulario.php");
/*campos:arreglo con datos a mostrar
tabla: Tabla a mostrar
campo: campo que sirve de enlace entre padre e hijo
llave: llave que sirve de enlace id del padre
orden: campo por el que se debe ordenar
*/
$campos=array("fecha","logro","probabilidad","impacto","minimiza","aplican","documentados");
$tabla="ft_seguimiento_riesgo";
$campo_enlace="ft_riesgos_proceso";
$llave=$_REQUEST["idriesgo"];
$orden="";
$riesgo=busca_filtro_tabla("","ft_riesgos_proceso","idft_riesgos_proceso=".$_REQUEST["idriesgo"],"",$conn);
//print_r($riesgo);
echo("<div align='center'><span class='phpmaker'><b>LISTADO DE SEGUIMIENTOS AL RIESGO<br />".strip_tags($riesgo[0]["nombre"])."</b></span><br /><br />");
echo(listar_formato_hijo($campos,$tabla,$campo_enlace,$llave,$orden)."</div>");
?>
