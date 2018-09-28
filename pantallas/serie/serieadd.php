<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior."header.php");
include_once ($ruta_db_superior."pantallas/lib/librerias_cripto.php");

require_once $ruta_db_superior . "arboles/crear_arbol_ft.php";

$validar_enteros = array("x_idserie");
desencriptar_sqli('form_info');

$categoria_txt = [
    2 => "Producci&oacute;n Documental",
    3 => "Otras Categorias"
];

$tipo_tvd_txt = array(
    0 => "TRD",
    1 => "TVD"
);

$tipo_serie = array(
    1 => "Serie",
    2 => "Subserie",
    3 => "Tipo documental"
);

$sAction = @$_POST["a_add"];
switch ($sAction) {
    case "A":
        $x_idserie = @$_POST["x_idserie"];
        $x_nombre = @$_POST["x_nombre"];
        $x_cod_padre = @$_POST["x_cod_padre"];
        $x_dias_entrega = @$_POST["x_dias_entrega"];
        $x_codigo = @$_POST["x_codigo"];
        $x_retencion_gestion = @$_POST["x_retencion_gestion"];
        $x_retencion_central = @$_POST["x_retencion_central"];
        $x_conservacion = @$_POST["x_conservacion"];
        $x_seleccion = @$_POST["x_seleccion"];
        $x_otro = @$_POST["x_otro"];
        $x_procedimiento = @$_POST["x_procedimiento"];
        $x_digitalizacion = @$_POST["x_digitalizacion"];
        $x_copia = @$_POST["x_copia"];
        $x_tipo = @$_POST["x_tipo"];
        $x_tvd = @$_POST["x_tvd"];
        $x_categoria = @$_POST["x_categoria"];
		/*$x_tipo_entidad = $_POST["tipo_entidad"];
		$x_identidad = $_POST["identidad"];*/
		$x_dependencias = $_REQUEST["iddependencia"];

        $ok = AddData($conn);
        if ($ok) {
            notificaciones('Serie adicionada con exito', 'success', 6000);
            if ($x_categoria != 3) {
                $openNode = "0.0.0";
            } else {
                $openNode = "0.0.-1";
            }
            ?>
<script>
			//window.parent.frames['arbol'].tree2.refreshItem("0");
			window.parent.frames['arbol'].postMessage("refrescar_arbol", "*");
			/*window.parent.frames['arbol'].tree2.setOnLoadingEnd(abrir_arbol);
			function abrir_arbol() {
			window.parent.frames['arbol'].tree2.openAllItems("<?php echo $openNode;?>");
			}*/
			</script>
<?php
            exit();
        }
        break;
    default:
        $sKey = $_REQUEST["x_idserie"];
        $x_idserie = Null;
        $x_nombre = Null;
        $x_cod_padre = Null;
        $x_dias_entrega = 8;
        $x_codigo = Null;
        $x_retencion_gestion = 3;
        $x_retencion_central = 5;
        $x_conservacion = Null;
        $x_seleccion = Null;
        $x_otro = Null;
        $x_procedimiento = Null;
        $x_digitalizacion = Null;
        $x_copia = Null;
        $x_categoria = Null;
        $x_tvd = Null;

        $disabled="";

        $info_padre = busca_filtro_tabla("", "serie", "idserie=" . $sKey, "", $conn);

        $nom_padre = "";
        $x_tipo = Null;
        if ($info_padre["numcampos"]) {
            //var_dump($info_padre);die();
            $x_cod_padre = $sKey;
            $nom_padre = $info_padre[0]["nombre"] . " - (" . $info_padre[0]["codigo"] . ")";
            $x_categoria = $info_padre[0]["categoria"];
            $x_tipo = $info_padre[0]["tipo"];
            $x_tvd = $info_padre[0]["tvd"];
            $x_codigo = $info_padre[0]["codigo"];
			$x_conservacion = $info_padre[0]["conservacion"];
			$x_seleccion = $info_padre[0]["seleccion"];
			$x_procedimiento = $info_padre[0]["procedimiento"];
            if($x_tipo == 1 || $x_tipo == 2) {
                $x_tipo++;
                unset($tipo_serie[1]);
            }
			 $conservacion = array(
           		 "TOTAL" => "",
            	"ELIMINACION" => ""
        	);
       		 $conservacion[$x_conservacion] = "checked";
			  $seleccion = array(
	            0 => "",
	            1 => ""
	        );
	        $seleccion[$x_seleccion] = "checked";
			//buscar la dependencia asignada
			$buscar_asignacion = busca_filtro_tabla("", "entidad_serie", "entidad_identidad=2 and estado=1 and serie_idserie=" . $sKey, "", $conn);
			$lista_dependencias=array();
			if($buscar_asignacion["numcampos"]){
				for($i=0;$i<$buscar_asignacion["numcampos"];$i++){
					$lista_dependencias[]=$buscar_asignacion[$i]["llave_entidad"];
				}
				$dependencia_seleccionada = implode(",",$lista_dependencias);
			}

			//buscar permisos asociados a la serie
			$entidades=array();
			$buscar_permisos = busca_filtro_tabla("", "permiso_serie", "estado=1 and serie_idserie=".$sKey, "", $conn);
			if($buscar_permisos["numcampos"]){
				for($i=0;$i<$buscar_permisos["numcampos"];$i++){
					$entidades[$buscar_permisos[$i]["entidad_identidad"]][]=$buscar_permisos[$i]["llave_entidad"];
				}
			}
        }
        break;
}

function AddData($conn) {
	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_nombre"]) : $GLOBALS["x_nombre"];
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombre"] = $theValue;

	// Field cod_padre
	$theValue = ($GLOBALS["x_cod_padre"] != "") ? intval($GLOBALS["x_cod_padre"]) : "NULL";
	$fieldList["cod_padre"] = $theValue;

	// Field codigo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_codigo"]) : $GLOBALS["x_codigo"];
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["codigo"] = $theValue;

	$fieldList["categoria"] = $GLOBALS["x_categoria"];
	if ($fieldList["categoria"] == 3) {
		$fieldList["dias_entrega"] = 0;
		$fieldList["retencion_gestion"] = 0;
		$fieldList["retencion_central"] = 0;
		$fieldList["conservacion"] = "NULL";
		$fieldList["seleccion"] = "NULL";
		$fieldList["otro"] = "NULL";
		$fieldList["procedimiento"] = "NULL";
		$fieldList["digitalizacion"] = "NULL";
		$fieldList["copia"] = -1;
		$fieldList["tipo"] = -1;
		$fieldList["tvd"]=-1;
	} else {
		// Field dias_entrega
		$theValue = ($GLOBALS["x_dias_entrega"] != "") ? intval($GLOBALS["x_dias_entrega"]) : "NULL";
		$fieldList["dias_entrega"] = $theValue;

		// Field retencion_gestion
		$theValue = ($GLOBALS["x_retencion_gestion"] != "") ? intval($GLOBALS["x_retencion_gestion"]) : "NULL";
		$fieldList["retencion_gestion"] = $theValue;

		// Field retencion_central
		$theValue = ($GLOBALS["x_retencion_central"] != "") ? intval($GLOBALS["x_retencion_central"]) : "NULL";
		$fieldList["retencion_central"] = $theValue;

		// Field conservacion
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_conservacion"]) : $GLOBALS["x_conservacion"];
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["conservacion"] = $theValue;

		// Field seleccion
		$theValue = ($GLOBALS["x_seleccion"] != "") ? intval($GLOBALS["x_seleccion"]) : "NULL";
		$fieldList["seleccion"] = $theValue;

		// Field otro
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_otro"]) : $GLOBALS["x_otro"];
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["otro"] = $theValue;

		// Field procedimiento
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_procedimiento"]) : $GLOBALS["x_procedimiento"];
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["procedimiento"] = $theValue;

		// Field digitalizacion
		$theValue = ($GLOBALS["x_digitalizacion"] != "") ? intval($GLOBALS["x_digitalizacion"]) : "NULL";
		$fieldList["digitalizacion"] = $theValue;

		// Field digitalizacion
		$theValue = ($GLOBALS["x_copia"] != "") ? intval($GLOBALS["x_copia"]) : "NULL";
		$fieldList["copia"] = $theValue;

		// tipo
		$fieldList["tipo"] = "'" . $GLOBALS["x_tipo"] . "'";
		$fieldList["tvd"] = "'" . $GLOBALS["x_tvd"] . "'";

		/*$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_tipo_entidad"]) : $GLOBALS["x_tipo_entidad"];
		$theValue = ($theValue != "") ? "" . $theValue . "" : "NULL";
		$fieldList_permiso["tipo_entidad"] = $theValue;

		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_identidad"]) : $GLOBALS["x_identidad"];
		$theValue = ($theValue != "") ? "" . $theValue . "" : "NULL";
		$fieldList_permiso["identidad"] = $theValue;*/

		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_dependencias"]) : $GLOBALS["x_dependencias"];
		$theValue = ($theValue != "") ? "" . $theValue . "" : "NULL";
		$fieldList_asignacion["dependencias"] = $theValue;
	}

	// insert into database
	$strsql = "INSERT INTO serie (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	phpmkr_query($strsql) or die("Error al insertar el registro " . $strsql);
	$id = phpmkr_insert_id();

	// insert into permiso_serie
	/*$entidades = explode(",",$fieldList_permiso["identidad"]);
	for($i=0;$i<count($entidades);$i++){
		$strsql = "INSERT INTO permiso_serie (entidad_identidad,serie_idserie,llave_entidad,estado) VALUES (".$fieldList_permiso["tipo_entidad"].",".$id.",".$entidades[$i].",1)";
		phpmkr_query($strsql) or die("Error al insertar el registro " . $fieldList_permiso["identidad"]);
	}*/

	//insert into entidad_serie
	$dependencia = explode(",",$fieldList_asignacion["dependencias"]);
	for($i=0;$i<count($dependencia);$i++){
		$insert = "INSERT INTO entidad_serie (entidad_identidad,serie_idserie,llave_entidad,estado,fecha) VALUES (2," . $id . "," . $dependencia[$i] . ",1," . fecha_db_almacenar(date("Y-m-d"), "Y-m-d") . ")";
    	phpmkr_query($insert) or die("Error al guardar la informacion".$insert);
	}
	actualizar_crear_cod_arboles($id, "serie", 1);
	return $id;
}
?>
<style type="text/css">
ul.fancytree-container {
    border: none;
    background-color:#F5F5F5;
}
span.fancytree-title
{
	font-family: Verdana,Tahoma,arial;
	font-size: 9px;
}

</style>
<?php
include ($ruta_db_superior."librerias_saia.php");
echo librerias_jquery("3.3");
echo librerias_validar_formulario("11");
echo librerias_UI("1.12");
echo librerias_arboles_ft("2.24", 'filtro');


/*$tipo_entidad = null;
if ($_REQUEST["tipo_entidad"]) {
    $tipo_entidad = $_REQUEST["tipo_entidad"];
}*/

/*$entidad = busca_filtro_tabla("identidad, nombre", "entidad", "identidad in (1,2,4)", "nombre asc", $conn);
$option = '<option value="">Seleccione</option>';
if ($entidad["numcampos"]) {
    for ($i = 0; $i < $entidad["numcampos"]; $i++) {
        $option .= '<option value="' . $entidad[$i]["identidad"] . '"';
        if (!empty($tipo_entidad) && $tipo_entidad == $entidad[$i]["identidad"]) {
            $option .= ' selected="selected"';
        }
        $option .= '>' . $entidad[$i]["nombre"];
        $option .= '</option>';
    }
}*/
/*$option = '<option value="">Seleccione</option>
		   <option value="4">Asignado a Cargo(s)</option>
 		   <option value="2">Asignado a Dependencia(s)</option>
 		   <option value="1">Asignado a Funcionario(s)</option>';*/

?>
<form name="serieadd" id="serieadd" action="serieadd.php" method="post">
	<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
			<td class="encabezado" title="Definir el tipo de serie que se esta creando" >CATEGORIA*</td>
			<td bgcolor="#F5F5F5">
			<?php
			if(!empty($x_cod_padre)) {
			    $id_cat = 'x_categoria' . $x_categoria;
			    echo '<input type="hidden" name="x_categoria" id="' . $id_cat . '" value="' . $x_categoria  . '">';
			    echo '<label for="' . $id_cat . '">' .  $categoria_txt[$x_categoria] . '</label>';
			} else {
			    foreach ($categoria_txt as $key => $value) {
			        $id_cat = 'x_categoria' . $key;
			        echo '<input type="radio" name="x_categoria" id="' . $id_cat . '" value="' . $key . '">';
			        echo '<label for="' . $id_cat .  '">' . $value . '</label>';
			    }
			}
			?>
			</td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="Definir el tipo de serie que se esta creando" >TIPO*</td>
			<td bgcolor="#F5F5F5">
			<?php
			if(!empty($x_cod_padre)) {
			    $id_tvd = "x_tvd" . $x_tvd;
			    echo '<input type="hidden" name="x_tvd" id="' . $id_tvd . '" value="' . $x_tvd  . '">';
			    echo '<label for="' . $id_tvd . '">' .  $tipo_tvd_txt[$x_tvd] . '</label>';
			} else {
			    foreach ($tipo_tvd_txt as $key => $value) {
			        $id_tvd = "x_tvd" . $key;
			        echo '<input type="radio" name="x_tvd" id="' . $id_tvd . '" value="' . $key . '">';
			        echo '<label for="' . $id_tvd .  '">' . $value . '</label>';
			    }
			}
			?>
			</td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="Definir el tipo de serie que se esta creando" >TIPO SERIE*</td>
			<td bgcolor="#F5F5F5">

			<?php
			if(!empty($x_cod_padre) && $x_tipo == "3") {
			    $id_tipo = "x_tipo" . $x_tipo;
			    echo '<input type="hidden" name="x_tipo" id="' . $id_tipo . '" value="' . $x_tipo  . '">';
			    echo '<label for="' . $id_tipo . '">' .  $tipo_serie[$x_tipo] . '</label>';
			} else {
			    foreach ($tipo_serie as $key => $value) {
			        $id_tipo = "x_tipo" . $key;
			        echo '<input type="radio" name="x_tipo" id="' . $id_tipo . '" value="' . $key . '">';
			        echo '<label for="' . $id_tipo .  '">' . $value . '</label><br>';
			    }
			}
			?>
			</td>
		</tr>

		<tr>
			<td class="encabezado" title="C&oacute;digo de la serie o subserie"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="text" name="x_codigo" id="x_codigo" size="30" maxlength="20" value="<?php echo $x_codigo; ?>">
			</span></td>
		</tr>

		<tr>
			<td class="encabezado" title="Nombre de la serie o subserie"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE *</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="text" name="x_nombre" id="x_nombre" value="<?php echo $x_nombre; ?>">
			</span></td>
		</tr>

		<tr class="ocultar_padre">
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE PADRE </span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <div id="divserie"><?php
			if(!empty($x_cod_padre)) {
			    echo $nom_padre;
			    echo '<input type="hidden" name="x_cod_padre" id="x_cod_padre" value="' . $x_cod_padre . '" />';
			}
			?></div> </td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="Cantidad de d&iacute;as para dar tr&aacute;mite y respuesta al documento"><span class="phpmaker" style="color: #FFFFFF;">TIEMPO DE RESPUESTA (D&Iacute;AS) *</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="text" name="x_dias_entrega" id="x_dias_entrega" size="30" value="<?php echo $x_dias_entrega; ?>">
			</span></td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="Cantidad de a&ntilde;os que permanece la subserie en el archivo de gesti&oacute;n"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO GESTI&Oacute;N *</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="text" name="x_retencion_gestion" id="x_retencion_gestion" size="30" value="<?php echo $x_retencion_gestion; ?>">
			</span></td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="Cantidad de a&ntilde;os que permanece la subserie en el archivo central"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO CENTRAL *</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="text" name="x_retencion_central" id="x_retencion_central" size="30" value="<?php echo $x_retencion_central; ?>">
			</span></td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="El documento al pasarse al archivo central ser&aacute; conservado o eliminado?"><span class="phpmaker" style="color: #FFFFFF;">CONSERVACI&Oacute;N / ELIMINACI&Oacute;N *</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">

				<input type="radio" id="x_conservacionTOTAL" name="x_conservacion" value="TOTAL" <?php echo $conservacion["TOTAL"];?>>
				Conservacion Total
				<input type="radio" id="x_conservacionELIMINACION" name="x_conservacion" value="ELIMINACION" <?php echo $conservacion["ELIMINACION"];?>>
				Eliminacion </span></td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="El documento al pasarse al archivo central se le har&aacute; una selecci&oacute;n?"><span class="phpmaker" style="color: #FFFFFF;">SELECCI&Oacute;N *</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="radio" id="x_seleccion1" name="x_seleccion" value="1" <?php echo $seleccion[1];?>>
				SI
				<input type="radio" id="x_seleccion0" name="x_seleccion" value="0" <?php echo $seleccion[0];?>>
				NO </span></td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="El documento al pasarse al archivo central ser&aacute digitalizado?"><span class="phpmaker" style="color: #FFFFFF;">DIGITALIZACI&Oacute;N</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="radio" id="x_digitalizacion1" name="x_digitalizacion" value="1">
				SI
				<input type="radio" id="x_digitalizacion0" name="x_digitalizacion" value="0">
				NO </span></td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado"  title="Si va a hacerse algo diferente a Conservar, Eliminar o Seleccionar el documento"><span class="phpmaker" style="color: #FFFFFF;">OTRO</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="text" name="x_otro" id="x_otro" size="30" maxlength="255" value="<?php echo $x_otro; ?>">
			</span></td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="Describir el procedimiento de conservaci&oacute;n"><span class="phpmaker" style="color: #FFFFFF;">PROCEDIMIENTO CONSERVACI&Oacute;N</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> 				<textarea cols="35" rows="4" id="x_procedimiento" name="x_procedimiento"><?php echo $x_procedimiento; ?></textarea> </span></td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="Decidir si se permite copias de los documentos de este tipo serial"><span class="phpmaker" style="color: #FFFFFF;">PERMITIR COPIA *</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="radio" id="x_copia1" name="x_copia" value="1">
				SI
				<input type="radio" id="x_copia0" name="x_copia" value="0" checked="checked">
				NO </span></td>
		</tr>
		<tr class="ocultar">
			<td class="encabezado" title="Asociar serie/subserie a una dependencia"><span class="phpmaker" style="color: #FFFFFF;">DEPENDENCIA ASOCIADA *</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<?php
				$origen = array("url" => "arboles/arbol_dependencia.php", "ruta_db_superior" => $ruta_db_superior,
				    "params" => array(
				        "checkbox" => 1,
				        "seleccionados" => $dependencia_seleccionada
				    ));
				$opciones_arbol = array("keyboard" => true, "selectMode" => 2, "busqueda_item" => 1, "expandir" => 3, "busqueda_item" => 1);
				$extensiones = array("filter" => array());
				$arbol = new ArbolFt("iddependencia", $origen, $opciones_arbol, $extensiones);
				echo $arbol->generar_html();

				?>
			</span></td>
		</tr>
		<!--tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO DE PERMISO</span></td>
			<td bgcolor="#F5F5F5"><select id="tipo_entidad" name="tipo_entidad"><?php echo $option;?></select></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ASIGNAR PERMISO</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <div id="sub_entidad"></div> </td>
		</tr-->

		<tr>
			<td colspan="2" style="background-color: #FFFFFF;text-align: center" >
			<input type="hidden" name="a_add" value="A">
			<input type="submit" name="Action" value="Adicionar">
			</td>
		</tr>
	</table>

</form>

<?php
include_once($ruta_db_superior."footer.php");
encriptar_sqli("serieadd", 1, "form_info", $ruta_db_superior, false, false);
?>

<script>
var identidad = <?php echo (empty($identidad) ? 0 : $identidad);?>;
	function cargar_datos_padre(event,data) {
		$("#x_cod_padre").val(data.node.key);
		$.ajax({
			type : "POST",
			dataType : "json",
			url : "buscar_datos_serie.php",
			data : {
				idserie : data.node.key
			},
			success : function(datos) {
				if (datos.exito) {
					$('#x_dias_entrega').val(datos.dias_entrega);
					$('#x_codigo').val(datos.codigo);
					$('#x_retencion_gestion').val(datos.retencion_gestion);
					$('#x_retencion_central').val(datos.retencion_central);
					if (datos.conservacion) {
						$('#x_conservacion' + datos.conservacion).attr('checked', true);
					} else {
						$("[name='x_conservacion']").attr('checked', false);
					}

					if (datos.seleccion) {
						$('#x_seleccion' + datos.seleccion).attr('checked', true);
					} else {
						$("[name='x_seleccion']").attr('checked', false);
					}

					if (datos.digitalizacion) {
						$('#x_digitalizacion' + datos.digitalizacion).attr('checked', true);
					} else {
						$("[name='x_digitalizacion']").attr('checked', false);
					}

					$('#x_otro').val(datos.otro);

					if (datos.procedimiento) {
						$('#x_procedimiento').text(datos.procedimiento);
					} else {
						$('#x_procedimiento').text("");
					}

					if (datos.copia) {
						$('#x_copia' + datos.copia).attr('checked', true);
					} else {
						$("[name='x_copia']").attr('checked', false);
					}
				} else {
					top.noty({
						text : datos.msn,
						type : 'error',
						layout : 'topCenter',
						timeout : 5000
					});
				}
			},
			error : function() {
				top.noty({
					text : 'Error al consultar los datos de la serie padre',
					type : 'error',
					layout : 'topCenter',
					timeout : 5000
				});
			}
		});
	}

	$(document).ready(function() {
		xml1="arboles/arbol_dependencia.php?checkbox=true&expandir=1";
		var dependencia_seleccionada="<?php echo $dependencia_seleccionada; ?>";

		if(dependencia_seleccionada && dependencia_seleccionada != '') {
			$("#iddependencia").val(dependencia_seleccionada);
		}

		var entidades = <?php echo json_encode($entidades) ?>;
		var dependencia_seleccionadas=0;

		$("#serieadd").validate({
			rules:{
				x_nombre:{required:true},
				x_tipo: {
					required : true
				},
				x_tvd: {
					required : true
				},
				x_categoria: {
					required : true
				},
				x_dias_entrega: {
					required : true
				},
				x_retencion_gestion: {
					required : true
				},
				x_retencion_central: {
					required : true
				},
				x_conservacion: {
					required : true
				},
				x_seleccion: {
					required : true
				}
			},
			submitHandler : function(form) {
				var x_identidad ="";
				x_categoria = $("[name='x_categoria']:checked").val();
				if (x_categoria == 2) {
					x_identidad = $("#identidad").val();
					x_iddependencia = $("#iddependencia").val();
					x_tipo = $("[name='x_tipo']:checked").val();
					x_cod_padre = $("#x_cod_padre").val();
					if(x_iddependencia == ""){
						top.noty({
							text : 'Por favor seleccione a quien le va a asignar la serie',
							type : 'error',
							layout : 'topCenter',
							timeout : 5000
						});
						return false;
					}/*
					if(x_identidad == ""){
						top.noty({
							text : 'Por favor seleccione a quien le va a asignar permiso',
							type : 'error',
							layout : 'topCenter',
							timeout : 5000
						});
						return false;
					}*/
					if (x_tipo != 1 && (x_cod_padre == "" || x_cod_padre == 0)) {
						top.noty({
							text : 'Por favor seleccione el Padre',
							type : 'error',
							layout : 'topCenter',
							timeout : 5000
						});
						return false;
					} else {
						form.submit();
					}
				}else{
					form.submit();
				}
			}
		});

		$("[name='x_categoria']").change(function() {
			$("#divserie").empty();
			if ($(this).val() == 2) {
				$("[name='x_tvd']").rules("add", {
					required : true
				});
				$("[name='x_tipo']").rules("add", {
					required : true
				});
				$("#x_dias_entrega").rules("add", {
					required : true,
					number : true
				});
				$("#x_retencion_gestion").rules("add", {
					required : true,
					number : true
				});
				$("#x_retencion_central").rules("add", {
					required : true,
					number : true
				});
				$("[name='x_seleccion']").rules("add", {
					required : true
				});
				$("[name='x_conservacion']").rules("add", {
					required : true
				});
				$("[name='x_copia']").rules("add", {
					required : true
				});

				$(".ocultar").show();
				$(".ocultar_padre").hide();
				$("[name='x_tipo']:checked").trigger("change");
			} else {
				$("[name='x_tvd']").rules("remove");
				$("[name='x_tipo']").rules("remove");
				$("#x_dias_entrega").rules("remove");
				$("#x_retencion_gestion").rules("remove");
				$("#x_retencion_central").rules("remove");
				$("[name='x_seleccion']").rules("remove");
				$("[name='x_conservacion']").rules("remove");
				$("[name='x_copia']").rules("remove");

				$(".ocultar").hide();
				$(".ocultar_padre").show();

				xml = "arboles/arbol_serie.php?ver_categoria2=0&ver_categoria3=1&checkbox=radio";
				$.ajax({
					url : "<?php echo $ruta_db_superior;?>arboles/crear_arbol_ft.php",
					data : {
						xml : xml,
						campo : "x_cod_padre",
						busqueda_item:1,
						selectMode:1,
						ruta_db_superior: "../../"
					},
					type : "POST",
					async : false,
					success : function(html_serie) {
						$("#divserie").empty().html(html_serie);
					},
					error : function() {
						top.noty({
							text : 'No se pudo cargar el arbol de series',
							type : 'error',
							layout : 'topCenter',
							timeout : 5000
						});
					}
				});

			}
		});

		$("[name='x_categoria']:checked").trigger("change");

		var cod_padre = $("#x_cod_padre").val();
		if(cod_padre) {
			$(".ocultar_padre").show();
		} else {
			$(".ocultar_padre").hide();
		}
		$("[name='x_tvd'],[name='x_tipo']").change(function() {
			tipo_serie = $("[name='x_tipo']:checked").val();
			var tvd = $("[name='x_tvd']:checked").val();
			var cod_padre = $("#x_cod_padre").val();
			if(tvd == undefined) {
				tvd = $("[name='x_tvd']").val();
			}
			if (tvd != undefined && tipo_serie != undefined) {
				if (tipo_serie != 1 && !cod_padre) {
					$(".ocultar_padre").show();
					xml = "arboles/arbol_serie.php?checkbox=radio&tipo3=0&tvd=" + tvd;
					if (tipo_serie == 2) {
						xml += "&tipo2=0";
					}
					if(cod_padre!=undefined && cod_padre!=0){
						xml+="&seleccionados="+cod_padre;
					}
					$.ajax({
						url : "<?php echo $ruta_db_superior;?>arboles/crear_arbol_ft.php",
						data : {
							xml : xml,
							campo : "x_cod_padre",
							busqueda_item:1,
							selectMode:1,
							onNodeSelect : "cargar_datos_padre",
							ruta_db_superior: "../../"
						},
						type : "POST",
						async : false,
						success : function(html_serie) {
							$("#divserie").empty().html(html_serie);
						},
						error : function() {
							top.noty({
								text : 'No se pudo cargar el arbol de series',
								type : 'error',
								layout : 'topCenter',
								timeout : 5000
							});
						}
					});
				} else if(!cod_padre) {
					$(".ocultar_padre").hide();
				}
			}
		});
		/*$("#tipo_entidad").change(function () {
			option=$(this).val();
			var entidades_seleccionadas='';
			if(option != "") {
				if(!$.isEmptyObject(entidades)){
					if(entidades[option]){
						entidades_seleccionadas=entidades[option].join(',');
					}
				}
				if(identidad && identidad > 0) {
					if(entidades_seleccionadas==''){
						entidades_seleccionadas=identidad;
					}
					else{
						entidades_seleccionadas = entidades_seleccionadas + ',' + identidad;
					}
				}
				url1="";
				switch(option) {
					case '1'://Funcionario
					url1="arboles/arbol_funcionario.php?idcampofun=funcionario_codigo&checkbox=true&sin_padre=1";
					//url1="test.php?rol=1";
						url1  = url1 + '&seleccionados=' + entidades_seleccionadas;
					//}
					check=1;
					break;

					case '2'://Dependencia
						url1="arboles/arbol_dependencia.php?estado=1&checkbox=true";
						//if(identidad > 0) {
							url1  = url1 + '&seleccionados=' + entidades_seleccionadas;
						//}
						check=0;
					break;

					case '4'://Cargo
						url1="arboles/arbol_cargo.php?estado=1&checkbox=true";
						//if(identidad > 0) {
							url1  = url1 + '&seleccionados=' + entidades_seleccionadas;
						//}
						check=0;
					break;
				}
				$.ajax({
					url : "<?php echo $ruta_db_superior;?>arboles/crear_arbol.php",

					data:{xml:url1,campo:"identidad",radio:0,selectMode:check,ruta_db_superior:"../../",seleccionar_todos:1,busqueda_item:1},
					type : "POST",
					async:false,
					success : function(html) {
						$("#sub_entidad").empty().html(html);
					},error: function () {
						top.noty({text: 'No se pudo cargar la informacion',type: 'error',layout: 'topCenter',timeout:5000});
					}
				});
			}else{
				$("#sub_entidad").empty();
			}
		});
		$("#tipo_entidad").trigger("change");*/
	});
</script>
