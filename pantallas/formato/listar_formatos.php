<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
usuario_actual("login");

$adicional = "";
$request = array();
foreach (@$_REQUEST as $id => $value) {
	$request[] = $id . "=" . $value;
}
if (count($request)) {
	$adicional = "?" . implode("&", $request);
}

$acceso = new Permiso();
$idcategoria_formato = $_REQUEST['idcategoria_formato'];
if (!$idcategoria_formato) {
	$idcategoria_formato = 2;
}
$lista_formatos = busca_filtro_tabla("nombre,etiqueta,ruta_adicionar", "formato", "mostrar=1 AND (fk_categoria_formato like '" . $idcategoria_formato . "' OR   fk_categoria_formato like '%," . $idcategoria_formato . "'  OR   fk_categoria_formato like '" . $idcategoria_formato . ",%' OR   fk_categoria_formato like '%," . $idcategoria_formato . ",%') AND (fk_categoria_formato like '2' OR fk_categoria_formato like '%,2'  OR fk_categoria_formato like '2,%' OR fk_categoria_formato like '%,2,%')", "etiqueta ASC", $conn);
$proceso = busca_filtro_tabla('', 'categoria_formato', 'idcategoria_formato=' . $idcategoria_formato, '', $conn);
$nombre_proceso = codifica_encabezado(html_entity_decode($proceso[0]['nombre']));
$nombre_proceso = mb_strtoupper($nombre_proceso);
$nombre_proceso = $nombre_proceso;
$texto = '
		<style>
			body{
				overflow:scroll;
			}
		</style>
		<br/>
		<div class="container">
			<table class="table table-hover" >
			<tbody>
			<tr>
				<th style="text-align:center;"><b>' . $nombre_proceso . '</b></th>
			</tr>
	';
for ($i = 0; $i < $lista_formatos['numcampos']; $i++) {
	$ok = $acceso -> acceso_modulo_perfil('crear_' . $lista_formatos[$i]['nombre']);
	if ($ok) {
		$etiqueta = codifica_encabezado(html_entity_decode($lista_formatos[$i]['etiqueta']));
		$etiqueta = strtolower($etiqueta);
		$etiqueta = ucwords($etiqueta);

		$enlace_adicionar = FORMATOS_CLIENTE . $lista_formatos[$i]['nombre'] . '/' . $lista_formatos[$i]['ruta_adicionar'];

		$texto .= '
				<tr>
					<td>
						<div class="kenlace_saia" style="cursor:pointer" titulo="' . $etiqueta . '" title="' . $etiqueta . '" enlace="' . $enlace_adicionar . $adicional . '" conector="iframe">  ' . $etiqueta . ' </div>
					</td>
				</tr>
			';
	}
}
$texto .= '</tbody></table></div>';
echo($texto);
?>
