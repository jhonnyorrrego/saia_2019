<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	} $ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

$retorno = array(
	"exito" => 0,
	"msn" => ""
);
if ($_REQUEST["opt"] == 1 && isset($_REQUEST["idcampo"]) && isset($_REQUEST["idnombre"])) {
	$datos = crear_campo($_REQUEST["idcampo"], $_REQUEST["idnombre"]);
	if ($datos["exito"]) {
		$retorno["exito"] = 1;
		$retorno["html_campos"] = $datos["campos"];
	} else {
		$retorno["msn"] = $datos["msn"];
	}
	if ($_REQUEST["retorno"]) {
		return (json_encode($retorno));
	} else {
		echo json_encode($retorno);
	}
}

function crear_campo($idcampo, $nombre_id = "", $ruta_db_superior = "../../") {
	$retorno = array(
		"exito" => 0,
		"msn" => ""
	);
	$value = "";
	if ($_REQUEST["seleccionado"]) {
		$value = $_REQUEST["seleccionado"];
	}
	if ($idcampo) {
		$campos = busca_filtro_tabla("cf.*", "formato f, campos_formato cf", "f.idformato=cf.formato_idformato and cf.idcampos_formato=" . $idcampo, "", $conn);
		if ($campos["numcampos"]) {
			$retorno["exito"] = 1;
			for ($h = 0; $h < $campos["numcampos"]; $h++) {
				if ($nombre_id == "" || $campos["numcampos"] > 1) {
					$nombre_id = "campo_" . $campos[$h];
				}
				$html_campo = "";

				if (strpos($campos[$h]["valor"], "*}") > 0) {
					$html_campo = '<input type="text" name="' . $nombre_id . '" id="' . $nombre_id . '" value="' . $value . '" />';
				} else {

					switch ($campos[$h]["etiqueta_html"]) {
						case "fecha" :
							if ($campos[$h]["tipo_dato"] == "DATE") {
								$html_campo = '<input type="text" name="' . $nombre_id . '" id="' . $nombre_id . '" placeholder="0000-00-00" value="' . $value . '" />';
							} else if ($campos[$h]["tipo_dato"] == "DATETIME") {
								$html_campo = '<input type="text" name="' . $nombre_id . '" id="' . $nombre_id . '" placeholder="0000-00-00 00:00:00" value="' . $value . '" />';
							} else if ($campos[$h]["tipo_dato"] == "TIME") {
								$html_campo = '<input type="text" name="' . $nombre_id . '" id="' . $nombre_id . '" placeholder="00:00:00" value="' . $value . '" />';
							}
							break;

						case "arbol" :
							/*En campos valor se deben almacenar los siguientes datos: ../../test.php;1;0;1;1;0;0
							 arreglo[0] ruta de el xml
							 arreglo[1] 1=> checkbox; 2=>radiobutton
							 arreglo[2] Modo calcular numero de nodos hijo
							 arreglo[3] Forma de carga 0=>autoloading; 1=>smartXML
							 arreglo[4] Busqueda
							 arreglo[5] Almacenar 0=>iddato 1=>valordato
							 arreglo[6] Tipo de arbol 0=>funcionarios 1=>series 2=>dependencias 3=>Otro (se debe sacar el dato) 4=>Sale de la tabla enviada a test_serie.php?tabla=nombre_tabla,5 => rol
							 */
							$arreglo = explode(";", $campos[$h]["valor"]);
							if (isset($arreglo) && $arreglo[0] != "") {
								$ruta = "\"" . $arreglo[0] . "\"";
							} else {
								$ruta = "\"../../test.php?rol=1&sin_padre=1\"";
								$arreglo[1] = 2;
								$arreglo[3] = 1;
								$arreglo[4] = 1;
								$arreglo[5] = 0;
								$arreglo[6] = 5;
							}

							if ($arreglo[4]) {
								$html_campo .= 'Buscar: <input ' . $tabindex . ' type="text" id="stext_' . $nombre_id . '" width="200px" size="25">
								<a href="javascript:void(0)" onclick="tree_' . $nombre_id . '.findItem((document.getElementById(\'stext_' . $nombre_id . '\').value),1)">
									<img src="{*ruta_db_superior*}botones/general/anterior.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_' . $nombre_id . '.findItem((document.getElementById(\'stext_' . $nombre_id . '\').value),0,1)">
									<img src="{*ruta_db_superior*}botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_' . $nombre_id . '.findItem((document.getElementById(\'stext_' . $nombre_id . '\').value))">
									<img src="{*ruta_db_superior*}botones/general/siguiente.png"border="0px">
								</a><br/>';
							}
							$html_campo .= '<input type="hidden"  name="' . $nombre_id . '" id="' . $nombre_id . '" value="' . $value . '" />';
							$html_campo .= '<div id="esperando_' . $nombre_id . '">
									<img src="{*ruta_db_superior*}imagenes/cargando.gif">
								</div>
							<div id="treeboxbox_' . $nombre_id . '" height="100%"></div>';

							$html_campo .= '<script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_' . $nombre_id . '=new dhtmlXTreeObject("treeboxbox_' . $nombre_id . '","100%","auto",0);
								tree_' . $nombre_id . '.setImagePath("{*ruta_db_superior*}imgs/");
								tree_' . $nombre_id . '.enableIEImageFix(true);';

							if ($arreglo[1] == 1) {
								$html_campo .= 'tree_' . $nombre_id . '.enableCheckBoxes(1);
								tree_' . $nombre_id . '.enableThreeStateCheckboxes(1);';
							} else if ($arreglo[1] == 2) {
								$html_campo .= 'tree_' . $nombre_id . '.enableCheckBoxes(1);
								tree_' . $nombre_id . '.enableRadioButtons(true);';
							}
							$html_campo .= 'tree_' . $nombre_id . '.setOnLoadingStart(cargando_' . $nombre_id . ');
							tree_' . $nombre_id . '.setOnLoadingEnd(fin_cargando_' . $nombre_id . ');';

							if ($arreglo[3]) {
								$html_campo .= 'tree_' . $nombre_id . '.enableSmartXMLParsing(true);';
							} else {
								$html_campo .= 'tree_' . $nombre_id . '.setXMLAutoLoading(' . $ruta . ');';
							}
							if ($accion == "editar") {
								$ruta .= ",checkear_arbol";
							}
							$html_campo .= 'tree_' . $nombre_id . '.loadXML(' . $ruta . ');';
							if ($arreglo[1] == 1) {
								$html_campo .= '
								tree_' . $nombre_id . '.setOnCheckHandler(onNodeSelect_' . $nombre_id . ');
								function onNodeSelect_' . $nombre_id . '(nodeId){
									valor_destino=document.getElementById("' . $nombre_id . '");
									destinos=tree_' . $nombre_id . '.getAllChecked();
									nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
									nuevo=nuevo.replace(/\,$/gi,"");
									vector=destinos.split(",");
									for(i=0;i<vector.length;i++){
										if(vector[i].indexOf("_")!=-1){
											vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
										}
										nuevo=vector.join(",");
										if(vector[i].indexOf("#")!=-1){
											hijos=tree_' . $nombre_id . '.getAllSubItems(vector[i]);
											hijos=hijos.replace(/\,{2,}(d)*/gi,",");
											hijos=hijos.replace(/\,$/gi,"");
											vectorh=hijos.split(",");

											for(h=0;h<vectorh.length;h++){
												if(vectorh[h].indexOf("_")!=-1)
												vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
												nuevo=eliminarItem(nuevo,vectorh[h]);
											}
										}
									}
									nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
									nuevo=nuevo.replace(/\,$/gi,"");
									valor_destino.value=nuevo;
								}
								function eliminarItem(conjunto, valor) {
									j = 0;
									vector = new Array();
									lista = conjunto.split(",");
									for ( ind = 0; ind < lista.length; ind++) {
										if (lista[ind] != valor) {
											vector[j] = lista[ind];
											j = j + 1;
										}
									}
									return (vector.join(","));
								}';
							} elseif ($arreglo[1] == 2) {
								$html_campo .= 'tree_' . $nombre_id . '.setOnCheckHandler(onNodeSelect_' . $nombre_id . ');
									function onNodeSelect_' . $nombre_id . '(nodeId) {
										valor_destino=document.getElementById("' . $nombre_id . '");
										if(tree_' . $nombre_id . '.isItemChecked(nodeId)){
											if(valor_destino.value!==""){
												tree_' . $nombre_id . '.setCheck(valor_destino.value,false);
											}
											if(nodeId.indexOf("_")!=-1){
												nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											}
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}';
							}

							$html_campo .= "function fin_cargando_" . $nombre_id . "() {
									if (browserType == \"gecko\" ) {
										document.poppedLayer = eval('document.getElementById(\"esperando_" . $nombre_id . "\")');
									} else if (browserType == \"ie\") {
										document.poppedLayer = eval('document.getElementById(\"esperando_" . $nombre_id . "\")');
									} else {
										document.poppedLayer = eval('document.layers[\"esperando_" . $nombre_id . "\"]');
									}
									document.poppedLayer.style.display = \"none\";
									var valor='".$value."';
									if(valor){
										tree_".$nombre_id.".setCheck(valor,true);
										tree_".$nombre_id.".openAllItems(0);
									}
								}
								function cargando_" . $nombre_id . "() {
									if (browserType == \"gecko\" ) {
										document.poppedLayer = eval('document.getElementById(\"esperando_" . $nombre_id . "\")');
									} else if (browserType == \"ie\") {
										document.poppedLayer = eval('document.getElementById(\"esperando_" . $nombre_id . "\")');
									} else {
										document.poppedLayer = eval('document.layers[\"esperando_" . $nombre_id . "\"]');
									}
									document.poppedLayer.style.display = \"\";
								}";

							$html_campo .= '</script>';
							break;

						case "radio" :
						case "checkbox" :
						case "select" :
						case "dependientes" :
							$html_campo = generar_campos_listado($campos[$h], $nombre_id, $value);
							break;
						case "password" :
							$html_campo = '<input type="password" name="' . $nombre_id . '" id="' . $nombre_id . '" value="' . $value . '" />';
							break;
						case "textarea" :
							$html_campo = '<textarea name="' . $nombre_id . '" id="' . $nombre_id . '" >' . $value . '</textarea>';
							break;
						default :
							$html_campo = '<input type="text" name="' . $nombre_id . '" id="' . $nombre_id . '" value="' . $value . '" />';
							break;
					}
				}
				$retorno["campos"][$nombre_id] = str_replace("{*ruta_db_superior*}", $ruta_db_superior, $html_campo);
			}
		} else {
			$retorno["msn"] = "NO se encontro informacion";
		}
	}
	return $retorno;
}

function generar_campos_listado($campo, $nombre_id, $value) {
	$idcampo = $campo["idcampos_formato"];
	$tipo = $campo["etiqueta_html"];
	$sql = trim($campo["valor"]);

	$accion = strtoupper(substr($sql, 0, strpos($sql, ' ')));
	$llenado = "";
	$listado0 = array();
	if ($accion == "SELECT") {
		$datos = ejecuta_filtro_tabla($campo["valor"], $conn);
		if ($datos["numcampos"]) {
			for ($i = 0; $i < $datos["numcampos"]; $i++) {
				array_push($listado0, html_entity_decode($datos[$i][0] . "," . $datos[$i][1]));
			}
			$llenado = implode(";", $listado0);
		}
	} else {
		$llenado = html_entity_decode($campo["valor"]);
	}

	$listado3 = array();
	if ($llenado != "") {
		$listado1 = explode(";", $llenado);
		$cont1 = count($listado1);
		for ($i = 0; $i < $cont1; $i++) {
			$listado2 = explode(",", $listado1[$i]);
			array_push($listado3, $listado2);
		}
	}
	$cont3 = count($listado3);

	$texto = "";
	switch($tipo) {
		case "radio" :
			for ($j = 0; $j < $cont3; $j++) {
				if (($listado3[$j][0]) == $value) {
					$texto .= '<input type="' . $tipo . '" name="' . $nombre_id . '" id="' . $nombre_id . $j . '" value="' . ($listado3[$j][0]) . '" class="radio_' . $nombre_id . '" checked="true" />' . codifica_encabezado($listado3[$j][1]);
				} else {
					$texto .= '<input type="' . $tipo . '" name="' . $nombre_id . '" id="' . $nombre_id . $j . '" value="' . ($listado3[$j][0]) . '" class="radio_' . $nombre_id . '" />' . codifica_encabezado($listado3[$j][1]);
				}
			}
			break;
		case "checkbox" :
			$valores = explode(",", $value);
			for ($j = 0; $j < $cont3; $j++) {
				if (in_array(($listado3[$j][0]), $valores)) {
					$texto .= '<input type="' . $tipo . '" name="' . $nombre_id . '" id="' . $nombre_id . $j . '" value="' . ($listado3[$j][0]) . '" class="checkbox_' . $nombre_id . '" checked="true" />' . codifica_encabezado(strip_tags($listado3[$j][1]));
				} else {
					$texto .= '<input type="' . $tipo . '" name="' . $nombre_id . '" id="' . $nombre_id . $j . '" value="' . ($listado3[$j][0]) . '" class="checkbox_' . $nombre_id . '" />' . codifica_encabezado(strip_tags($listado3[$j][1]));
				}
			}
			break;
		case "select" :
			$texto = '<select name="' . $nombre_id . '" id="' . $nombre_id . '" > <option value="">Por favor seleccione...</option>';
			for ($j = 0; $j < $cont3; $j++) {
				if (($listado3[$j][0]) == $value) {
					$texto .= '<option value="' . ($listado3[$j][0]) . '" selected="true">' . codifica_encabezado($listado3[$j][1]) . '</option>';
				}else{
					$texto .= '<option value="' . ($listado3[$j][0]) . '">' . codifica_encabezado($listado3[$j][1]) . '</option>';
				}				
			}
			$texto .= '</select>';
			break;
		case "dependientes" :
			$campo["valor"] = html_entity_decode($campo["valor"]);
			$parametros = explode("|", $campo["valor"]);
			$select = explode(";", $parametros[0]);
			if (count($parametros) > 2) {
				$select2 = explode(";", $parametros[1]);
			}

			$datos_padre = ejecuta_filtro_tabla($select[1], $conn);
			$texto .= "<select name='" . $select[0] . $idcampo . "' id='" . $select[0] . $idcampo . "'><option value='' selected>Seleccionar...</option>";
			for ($i = 0; $i < $datos_padre["numcampos"]; $i++) {
				$texto .= "<option value='" . $datos_padre[$i]["id"] . "'>" . $datos_padre[$i]["nombre"] . "</option>";
			}
			$texto .= "</select>";

			for ($i = 1; $i < count($parametros); $i++) {
				$select = explode(";", $parametros[$i]);
				if ($i == (count($parametros) - 1)) {
					$nombre2 = $nombre_id;
				} elseif ($i == (count($parametros) - 2)) {// si es el penultimo
					$nombre2 = $select[0] . $idcampo;
				} else {// si es un select intermedio
					$nombre2 = $select[0] . $idcampo;
					$select3 = explode(";", $parametros[$i + 1]);
				}
				$texto .= "<select name='" . $nombre2 . "' id='" . $nombre2 . "'>";
				$texto .= "<option value='' selected>Seleccionar...</option>";
				$texto .= "</select>";
			}
			break;
	}
	return ($texto);
}
