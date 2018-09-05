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
			window.parent.frames['arbol'].tree2.refreshItem("0");
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
            if($x_tipo == 1 || $x_tipo == 2) {
                $x_tipo++;
                unset($tipo_serie[1]);
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
	}

	// insert into database
	$strsql = "INSERT INTO serie (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	phpmkr_query($strsql) or die("Error al insertar el registro " . $strsql);
	$id = phpmkr_insert_id();

	actualizar_crear_cod_arboles($id, "serie", 1);
	return $id;
}

include ($ruta_db_superior."librerias_saia.php");
echo librerias_jquery("1.8");
echo librerias_validar_formulario("11");
echo librerias_arboles();
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
				<input type="radio" id="x_conservacionTOTAL" name="x_conservacion" value="TOTAL">
				Conservacion Total
				<input type="radio" id="x_conservacionELIMINACION" name="x_conservacion" value="ELIMINACION">
				Eliminacion </span></td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="El documento al pasarse al archivo central se le har&aacute; una selecci&oacute;n?"><span class="phpmaker" style="color: #FFFFFF;">SELECCI&Oacute;N *</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="radio" id="x_seleccion1" name="x_seleccion" value="1">
				SI
				<input type="radio" id="x_seleccion0" name="x_seleccion" value="0">
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
				<input type="radio" id="x_copia0" name="x_copia" value="0">
				NO </span></td>
		</tr>

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
	function cargar_datos_padre(idNode) {
		$.ajax({
			type : "POST",
			dataType : "json",
			url : "buscar_datos_serie.php",
			data : {
				idserie : idNode
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
		$("#serieadd").validate({
			rules:{
				x_nombre:{required:true}
			},
			submitHandler : function(form) {
				x_categoria = $("[name='x_categoria']:checked").val();
				if (x_categoria == 2) {
					x_tipo = $("[name='x_tipo']:checked").val();
					x_cod_padre = $("#x_cod_padre").val();
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

				//var cod_padre = $("#x_cod_padre").val();
				xml = "test/test_serie.php?ver_categoria2=0&ver_categoria3=1";
				/*if(cod_padre != undefined && cod_padre != 0){
					xml+="&seleccionados="+cod_padre;
				}*/
				$.ajax({
					url : "<?php echo $ruta_db_superior;?>test/crear_arbol.php",
					data : {
						xml : xml,
						campo : "x_cod_padre",
						radio : 1,
						abrir_cargar : 1,
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

		$(".ocultar_padre").hide();
		$("[name='x_tvd'],[name='x_tipo']").change(function() {
			tipo_serie = $("[name='x_tipo']:checked").val();
			tvd = $("[name='x_tvd']:checked").val();
			//cod_padre=$("#x_cod_padre").val();
			if (tvd != undefined && tipo_serie != undefined) {
				if (tipo_serie != 1) {
					$(".ocultar_padre").show();
					xml = "test/test_serie.php?tipo3=0&tvd=" + tvd;
					if (tipo_serie == 2) {
						xml += "&tipo2=0";
					}
					/*if(cod_padre!=undefined && cod_padre!=0){
						xml+="&seleccionados="+cod_padre;
					}*/
					$.ajax({
						url : "<?php echo $ruta_db_superior;?>test/crear_arbol.php",
						data : {
							xml : xml,
							campo : "x_cod_padre",
							radio : 1,
							abrir_cargar : 1,
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
				} else {
					$(".ocultar_padre").hide();
				}
			}
		});

	});
</script>
