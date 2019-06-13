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

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . "assets/librerias.php";

echo jquery();
echo bootstrap();

$consulta = busca_filtro_tabla('idcategoria_formato,nombre', 'categoria_formato', 'cod_padre=2 and estado=1', 'nombre ASC', $conn);
$adicional = "";
$request = array();
foreach (@$_REQUEST as $id => $value) {
	$request[] = $id . "=" . $value;
}
if (count($request)) {
	$adicional = "&" . implode("&", $request);
}
?>
<div class="panel-body">
	<div class="block-nav">
		<?php
		$texto = '';

		for ($i = 0; $i < $consulta["numcampos"]; $i++) {
			$idcategoria_formato = $consulta[$i]['idcategoria_formato'];
			$mostrar = 0;
			$cuantos_formatos = busca_filtro_tabla("nombre,ruta_adicionar", "formato", "mostrar=1 AND (fk_categoria_formato like'" . $idcategoria_formato . "' OR   fk_categoria_formato like'%," . $idcategoria_formato . "'  OR   fk_categoria_formato like'" . $idcategoria_formato . ",%' OR   fk_categoria_formato like'%," . $idcategoria_formato . ",%') AND (fk_categoria_formato like'2' OR   fk_categoria_formato like '%,2'  OR   fk_categoria_formato like'2,%' OR   fk_categoria_formato like'%,2,%') ", "etiqueta ASC", $conn);

			if ($cuantos_formatos['numcampos'] == 1) {
				$url = $ruta_db_superior . FORMATOS_CLIENTE . $cuantos_formatos[0]['nombre'] . '/' . $cuantos_formatos[0]['ruta_adicionar'] . "?1=1";
				$ok = PermisoController::moduleAccess("crear_" . $cuantos_formatos[0]['nombre']);
				
				if ($ok) {
					$mostrar = 1;
				}
			} elseif ($cuantos_formatos['numcampos']) {
				for ($j = 0; $j < $cuantos_formatos['numcampos']; $j++) {
					$ok = PermisoController::moduleAccess("crear_" . $cuantos_formatos[$j]['nombre']);
					
					if ($ok) {
						$url = $ruta_db_superior . 'pantallas/formato/listar_formatos.php?idcategoria_formato=' . $consulta[$i]["idcategoria_formato"];
						$mostrar = 1;
					}
				}
			}

			if ($mostrar) {
				$etiqueta_formato = ucfirst(codifica_encabezado(html_entity_decode(strtolower($consulta[$i]["nombre"]))));
				$texto .= '<div title="' . $etiqueta_formato . '" data-load=\'{"kConnector":"iframe", "url":"' . $url . $adicional . '", "kTitle":"' . $etiqueta_formato . '"}\' class="items navigable">';
				$texto .= '<div class="head"></div>';
				$texto .= '<div class="label">' . $etiqueta_formato . '</div>';
				$texto .= '<div class="info"></div>';
				$texto .= '<div class="tail"></div>';
				$texto .= '</div>';
			}
		}
		echo $texto;
		?>
	</div>
</div>
