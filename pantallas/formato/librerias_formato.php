<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";

global $counter_formatos;

$counter_formatos = 1;

while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

function menu_principal_formatos($idformato)
{
	global $ruta_db_superior;
	$href = 'formatos/llamado_formatos.php?acciones_formato=formato,adicionar,buscar,editar,mostrar,tabla&accion=generar';
	$texto = '<li class="divider-vertical"></li> <li><button class="btn btn-mini btn-info kenlace_saia" titulo="Generar Formatos" conector="iframe" enlace="' . $href . '" >Publicar Todos</button></li>';
	return ($texto);
}
function mostrar_enlace_formato($idformato, $etiqueta)
{
	$enlace = "<b><a class='kenlace_saia' enlace='pantallas/generador/generador_pantalla.php?idformato=$idformato' conector='iframe' titulo='Formato $etiqueta' style='cursor:pointer'>$etiqueta</a></b>";
	return $enlace;
}
function ver_arbol($idformato)
{
	global $ruta_db_superior;
	include_once($ruta_db_superior . "db.php");
	include_once($ruta_db_superior . "formatos/librerias/funciones_generales.php");

	$enlace = '<a onclick=' . '"top.hs.htmlExpand(this, { objectType: \'iframe\',width: 300, height: 400,contentId:\'cuerpo_paso\', preserveContent:false, src:\'pantallas/formato/mostrar_arbol_proceso.php?id=$idformato\', outlineType: \'rounded-white\',wrapperClassName:\'highslide-wrapper drag-header\', objectLoadTime: \'after\'});" style="cursor:pointer;color:blue">Ver estructura del proceso</a>';

	return $enlace;
}
function barra_inferior_formato($idformato)
{
	//$clase_info = "detalle_documento_saia";
	//if ($_SESSION["tipo_dispositivo"] == "movil") {
	$clase_info = "kenlace_saia";
	//}
	return '<button type="button" class="btn btn-mini detalle_documento_saia tooltip_saia" conector="iframe" idformato="' . $idformato . '" enlace="pantallas/formato/mostrar_arbol_proceso.php?idformato=' . $idformato . '" titulo="No"><i class="icon-info-sign"></i></button>';
}
function where_formatos_padre()
{
	if (!$_REQUEST["variable_busqueda"]) {
		return "a.cod_padre=0 or a.cod_padre is null";
	} else return "";
}

function contador_formatos()
{
	global $counter_formatos;
	$response = $counter_formatos;
	$counter_formatos++;

	return $response;
}

function boton_editar_formatos($idformato, $etiqueta)
{
	$response = "<div class='kenlace_saia' enlace='pantallas/generador/generador_pantalla.php?idformato=" . $idformato . "' conector='iframe' title='" . $etiqueta . "' > <button class='btn btn-complete'> Modificar </button></div>";
	return $response;
}
