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
include_once $ruta_db_superior . "pantallas/lib/encabezado_componente.php";

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
		$conector = 'iframe';
		$idcategoria_formato = 1;
		
		$query =Model::getQueryBuilder();
		
		$cuantos_formatos = $query
        ->select(["nombre", "ruta_adicionar", "etiqueta"])
        ->from("formato")
        ->where(
			$query->expr()->andX(
				$query->expr()->orX(
					$query->expr()->isNull('cod_padre'),
					$query->expr()->eq('cod_padre', '0')
				),
				$query->expr()->like("concat(',',concat(fk_categoria_formato,','))", ':string')
			)
		)
		->setParameter(':string', "%," . $idcategoria_formato . ",%")
		->orderBy("etiqueta","asc")
		->execute()->fetchAll();
		
		for ($i = 0; $i < count($cuantos_formatos); $i++) {
			$url = $ruta_db_superior . 'formatos/' . $cuantos_formatos[$i]['nombre'] . '/' . $cuantos_formatos[$i]['ruta_adicionar'] . "?1=1";
			$proceso = '';

			if (PermisoController::moduleAccess("crear_" . $cuantos_formatos[$i]['nombre'])) {
				$etiqueta_formato = ucfirst(strtolower($cuantos_formatos[$i]["etiqueta"]));

				$texto .= '<div title="' . $etiqueta_formato . '" data-load=\'{"kConnector":"' . $conector . '", "url":"' . $url . $adicional . '", "kTitle":"' . $proceso . ' ' . $etiqueta_formato . '"}\' class="items navigable">';
				$texto .= '<div class="head"></div>';
				$texto .= '<div class="label">' . $etiqueta_formato . '</div>';
				$texto .= '<div class="info"></div>';
				$texto .= '<div class="tail"></div>';
				$texto .= '</div>';
			}
		}

		echo ($texto);
		?>
    </div>
</div> 