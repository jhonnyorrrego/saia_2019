<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "assets/librerias.php");
echo (bootstrap());
echo (librerias_arboles());
echo (jquery());

if (isset($_REQUEST['aprobar'])) {
	if ($_REQUEST['accion'] == 'contabilidad') {
		if (($_REQUEST['clasificacion'] == 1 || $_REQUEST['clasificacion'] == 2 || $_REQUEST['clasificacion'] == 4)) {
			$cargo = 'Aprobador Contabilidad';
		} else if (($_REQUEST['clasificacion'] == 3)) {
			$cargo = "Aprobador Contabilidad Servicios p%blicos - Administraci%n";
		}
	} else if ($_REQUEST['accion'] == 'presupuesto') {
		$cargo = 'Aprobador Presupuesto';
	} else if ($_REQUEST['accion'] == 'tesoreria') {
		$cargo = 'Aprobador Tesoreria';
	} else if ($_REQUEST['accion'] == 'juridica') {
		$cargo = 'Aprobador Juridica';
	} else if ($_REQUEST['accion'] == 'devolucion_it') {
		$devolver_doc = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "iddependencia_cargo=" . $_REQUEST['arbol_devuelto'], "");
		transferencia_automatica($_REQUEST['idformato'], $_REQUEST['iddoc'], $devolver_doc[0]['funcionario_codigo'], 3);
	} else if ($_REQUEST['accion'] == 'aprobacion_compras') {
		$cargo = "Clasificador factura";
	}
	if (isset($cargo)) {
		$funcionario = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "estado=1 and estado_dc=1 and tipo_cargo=2 and cargo like '" . $cargo . "'", "");
		transferencia_automatica($_REQUEST['idformato'], $_REQUEST['iddoc'], implode("@", extrae_campo($funcionario, "funcionario_codigo")), 3);
	}
	if ($funcionario['numcampos'] > 1) {
		$funcionario[0]['funcionario_codigo'] = implode(",", extrae_campo($funcionario, "funcionario_codigo"));
	}
	$insert = "insert into ft_item_aprobaciones (ft_radicacion_facturas,fecha_aprobacion,dependencia,accion,observaciones,transferido_a,arbol_devuelto) values (" . $_REQUEST['idft'] . "," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . "," . $_REQUEST['dependencia'] . ",'" . $_REQUEST['accion'] . "','" . $_REQUEST['observaciones'] . "','" . $funcionario[0]['funcionario_codigo'] . "','" . $_REQUEST['arbol_devuelto'] . "')";
	phpmkr_query($insert);

	if ($_REQUEST['accion'] == 'anulada') {
		$temp = 4;
	} else if ($_REQUEST['accion'] == 'devolucion_it') {
		$temp = 2;
	} else if ($_REQUEST['accion'] == 'pagada') {
		$temp = 5;
	} else {
		$temp = 3;
	}

	if (isset($temp)) {
		$update = "update ft_radicacion_facturas set estado='" . $temp . "' where idft_radicacion_facturas=" . $_REQUEST['idft'];
		phpmkr_query($update);
	}

	echo "<script>
	        window.parent.hs.close();
	        window.parent.location.reload();
		</script>";
}
?>
<br />
<form role="form">
	<div>
		<?php
		buscar_dependencia();
		?>
	</div><br>
	<div>
		<input type="text" name="fecha" id="fecha" readonly="readonly">
	</div><br>
	<div class="form-group">
		<label for="ejemplo_email_3" class="col-lg-2 control-label">Acciones:</label>
		<div class="col-lg-10">
			<select name="accion" id="accion" required="true">
				<option value="">Seleccione...</option>
				<?php
				$datos_padre = busca_filtro_tabla("b.funcionario_codigo,clasificacion_fact", "ft_item_facturas a,vfuncionario_dc b", "a.responsable=b.iddependencia_cargo and a.ft_radicacion_facturas=" . $_REQUEST['idft'] . " and b.funcionario_codigo=" . usuario_actual('funcionario_codigo'), "");

				$datos_clasificacion = busca_filtro_tabla("clasificacion_fact", "ft_item_facturas a", "ft_radicacion_facturas=" . $_REQUEST['idft'], "");

				if ($datos_padre['numcampos']) {
					if ($datos_clasificacion[0]['clasificacion_fact'] == 1) { //Cuando es clasificada como orden de compra
						echo '<option value="contabilidad">Para aprobacion de contabilidad</option>';
					} else if ($datos_clasificacion[0]['clasificacion_fact'] == 2) { //Cuando es clasificada como contrato
						echo '<option value="juridica">Para aprobación de jurídica</option>';
					} else {
						echo '<option value="contabilidad">Para aprobacion de contabilidad</option>
				<option value="juridica">Para aprobación de jurídica</option>';
					}
				}
				$dato_recibido = busca_filtro_tabla("tipo_recibido", "ft_item_recibidos", "ft_radicacion_facturas=" . $_REQUEST['idft'], "idft_item_recibidos desc");

				$cargo_contabilidad = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "estado=1 and estado_dc=1 and cargo like 'Aprobador Contabilidad' and funcionario_codigo=" . usuario_actual('funcionario_codigo'), "");
				if ($cargo_contabilidad['numcampos']) {
					echo '<option value="presupuesto">Para aprobacion de presupuesto</option>
	 	<option value="tesoreria">Para aprobacion de tesoreria</option>';
				}

				$cargo_presupuesto = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "estado=1 and estado_dc=1 and cargo like 'Aprobador Presupuesto' and funcionario_codigo=" . usuario_actual('funcionario_codigo'), "");

				if ($cargo_presupuesto['numcampos']) {
					echo '<option value="contabilidad">Para aprobacion de contabilidad</option>';
				}

				$cargo_tesoreria = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "estado=1 and estado_dc=1 and cargo like 'Aprobador Tesoreria' and funcionario_codigo=" . usuario_actual('funcionario_codigo'), "");

				if ($cargo_tesoreria['numcampos']) {
					echo '<option value="pagada">Pagada</option>';
				}

				$cargo_juridica = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "estado=1 and estado_dc=1 and cargo like 'Aprobador Juridica' and funcionario_codigo=" . usuario_actual('funcionario_codigo'), "");

				if ($cargo_juridica['numcampos']) {
					echo '<option value="contabilidad">Para aprobacion de contabilidad</option>';
				}

				$cargo_clasificador = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "estado=1 and estado_dc=1 and lower(cargo) like 'clasificador factura' and funcionario_codigo=" . usuario_actual('funcionario_codigo'), "");
				if ($cargo_clasificador['numcampos']) {
					echo '<option value="contabilidad">Para aprobacion de contabilidad</option>';
				}

				$cargo_aprobacion_compras = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "estado=1 and estado_dc=1 and cargo like 'Aprobador presupuesto' and funcionario_codigo=" . usuario_actual('funcionario_codigo'), "");
				if ($cargo_aprobacion_compras['numcampos']) { //Nuevo cargo Clasificador factura
					echo '<option value="aprobacion_compras">Para aprobación de Compras</option>';
				}
				?>

			</select>
			<input type="hidden" name="clasificacion" id="clasificacion" value="<?php echo $datos_clasificacion[0]['clasificacion_fact']; ?>">
		</div><br />
		<div>
			<label for="ejemplo_email_3">Observaciones:</label>
			<table id="opciones_accion" border="0" style="font-size:11px;">

			</table>
			<textarea rows="3" id="observaciones" name="observaciones"></textarea>
		</div>
		<div class="control-group" id="arbol_devolver">
			<strong>Devolver a</strong>
			<label class="string required control-label" for="afavor_de">
				<input type="hidden" name="bksaiacondicion_afavor_de" id="bksaiacondicion_afavor_de" value="=">
			</label>
			<div class="controls">
				<?php
				echo arbol("arbol_devuelto", "tree_arbol_devuelto", "test.php?rol=1&sin_padre=1", 0, 1, 1, 0, 'radio');
				?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
				<button type="submit" id="aprobar" name="aprobar" class="btn btn-primary">APROBAR</button>
				<input type="hidden" name="idft" value="<?php echo $_REQUEST['idft']; ?>">
				<input type="hidden" name="idformato" value="<?php echo $_REQUEST['idformato']; ?>">
				<input type="hidden" name="iddoc" value="<?php echo $_REQUEST['iddoc']; ?>">
			</div>
		</div>
	</div>
</form>
<script>
	$(document).ready(function() {
		$("#arbol_devolver").hide();
		$("#fecha").val('<?php echo date("Y-m-d H:i:s");  ?>');
		$("#accion").change(function() {
			var opcion = $(this).val();
			$("#observaciones").val('');
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: "opciones_acciones.php",
				data: {
					opcion: opcion
				},
				success: function(datos) {

					if (datos) {
						$("#opciones_accion").html(datos);
						seleccionados();
					} else {
						$("#opciones_accion").empty();
						$("#observaciones").val();
					}
				}
			});
		});
		$("#accion").click(function() {
			if ($(this).val() == 'devolucion_it') {
				$("#arbol_devolver").show();
				if ($("#tree_arbol_devuelto").val() == '') {
					$("#stexttree_arbol_devuelto").attr("required", "true");
				}
			} else {
				$("#arbol_devolver").hide();
				$("#stexttree_arbol_devuelto").removeAttr("required");
			}
		});

	});

	function seleccionados() {
		$(".seleccion").change(function() {
			$("#observaciones").val($(this).val());
		});
	}
</script>
<?php
function arbol($campo, $nombre_arbol, $url, $cargar_todos = 0, $padresehijos = false, $quitar_padres = false, $adicionales = false, $tipo_etiqueta = 'check', $agreg_depen = false, $tipo_funcionario = 'rol')
{
	global $ruta_db_superior;
	$entidad = $nombre_arbol;
	?>
	<div><?php //echo $seleccionados; 
				?></div>
	<input type="text" id="stext<?php echo $entidad; ?>" width="200px" size="25" placeholder="Buscar">
	<a href="javascript:void(0)" onclick="stext<?php echo $entidad; ?>.findItem(document.getElementById('stext<?php echo $entidad; ?>').value,1)">
		<img src="<?php echo $ruta_db_superior; ?>assets/images/anterior.png" alt="Buscar Anterior" border="0px"></a>
	<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem(document.getElementById('stext<?php echo $entidad; ?>').value,0,1)">
		<img src="<?php echo $ruta_db_superior; ?>assets/images/buscar.png" alt="Buscar" border="0px"></a>
	<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem(document.getElementById('stext<?php echo $entidad; ?>').value)">
		<img src="<?php echo $ruta_db_superior; ?>assets/images/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
	</span>

	<!--a href="javascript:seleccionar_todos<?php echo $entidad; ?>(1)"><img src="<?php echo $ruta_db_superior; ?>imgs/iconCheckAll.gif" alt="Seleccionar todos" title="Seleccionar todos"></a>
	<a href="javascript:seleccionar_todos<?php echo $entidad; ?>(0)"><img src="<?php echo $ruta_db_superior; ?>imgs/iconUncheckAll.gif" alt="Quitar todos" title="Quitar todos"></a><br-->
	<div id="esperando<?php echo $entidad; ?>"><img src="<?php echo $ruta_db_superior; ?>assets/images/cargando.gif"></div>
	<div id="treeboxbox<?php echo $entidad; ?>"></div>
	<input type="hidden" class="required" name="<?php echo $campo; ?>" id="<?php echo $entidad; ?>">
	<script type="text/javascript">
		$("document").ready(function() {
			var browserType;
			if (document.layers) {
				browserType = "nn4"
			}
			if (document.all) {
				browserType = "ie"
			}
			if (window.navigator.userAgent.toLowerCase().match("gecko")) {
				browserType = "gecko"
			}
			tree<?php echo $entidad; ?> = new dhtmlXTreeObject("treeboxbox<?php echo $entidad; ?>", "", "", 0);
			tree<?php echo $entidad; ?>.setImagePath("<?php echo $ruta_db_superior; ?>imgs/");
			tree<?php echo $entidad; ?>.enableIEImageFix(true);
			tree<?php echo $entidad; ?>.setOnLoadingStart(cargando<?php echo $entidad; ?>);
			tree<?php echo $entidad; ?>.setOnLoadingEnd(fin_cargando<?php echo $entidad; ?>);
			<?php if ($tipo_etiqueta == 'check') { ?>
				tree<?php echo $entidad; ?>.enableCheckBoxes(1);
			<?php } else if ($tipo_etiqueta == 'radio') { ?>
				tree<?php echo $entidad; ?>.enableRadioButtons(true);
				tree<?php echo $entidad; ?>.enableCheckBoxes(1);
			<?php } ?>
			<?php if ($entidad != 'plantilla' && $entidad != 'serie') { ?>
				tree<?php echo $entidad; ?>.enableSmartXMLParsing(true);
			<?php } ?>
			<?php
				if ($padresehijos) { ?>
				tree<?php echo $entidad; ?>.enableThreeStateCheckboxes(true);
			<?php } ?>

			tree<?php echo $entidad; ?>.loadXML("<?php echo $ruta_db_superior . $url; ?>");
			tree<?php echo $entidad; ?>.setXMLAutoLoading("<?php echo $ruta_db_superior . $url; ?>");
			tree<?php echo $entidad; ?>.setOnCheckHandler(onNodeSelect<?php echo $entidad; ?>);

			function onNodeSelect<?php echo $entidad; ?>(nodeId) {
				$("#stexttree_arbol_devuelto").removeAttr("required");
				var adicional_dep = "";
				var valores = tree<?php echo $entidad; ?>.getAllChecked();
				<?php if ($quitar_padres) { ?>
					var nuevos_valores = valores.split(",");
					var cantidad = nuevos_valores.length;
					var funcionarios = new Array();
					var indice = 0;
					for (var i = 0; i < cantidad; i++) {
						if (nuevos_valores[i].indexOf("#") == '-1') {
							if (nuevos_valores[i] != "") {
								funcionarios[indice] = nuevos_valores[i];
								indice++;
							}
						}
					}
					var valores = funcionarios.join(",");
				<?php }
					if (is_array($adicionales)) { ?>
					if (valores != '') {
						if ($("#bksaiacondicion_<?php echo $adicionales[0]; ?>").val() == "" && $("#bqsaia_<?php echo $adicionales[0]; ?>").val() == "") {
							$("#bksaiacondicion_<?php echo $adicionales[0]; ?>").val("<?php echo $adicionales[1]; ?>");
							$("#bqsaia_<?php echo $adicionales[0]; ?>").val("<?php echo $adicionales[2]; ?>");
						}
					} else {
						$("#bksaiacondicion_<?php echo $adicionales[0]; ?>").val("");
						$("#bqsaia_<?php echo $adicionales[0]; ?>").val("");
					}
				<?php } ?>

				<?php if ($tipo_etiqueta == 'radio') { ?>
					valor_destino = document.getElementById("<?php echo $entidad; ?>");
					if (tree<?php echo $entidad; ?>.isItemChecked(nodeId)) {
						if (valor_destino.value !== "")
							tree<?php echo $entidad; ?>.setCheck(valor_destino.value, false);
						if (nodeId.indexOf("_") != -1)
							nodeId = nodeId.substr(0, nodeId.length);
						valor_destino.value = nodeId;
					} else {
						valor_destino.value = "";
					}
					var nuevo_valor = valor_destino.value.replace("'", "");
					nuevo_valor = nuevo_valor.replace("'", "");
					var formato = nuevo_valor.toLowerCase();
					var ruta_sup = "<?php echo $ruta_db_superior; ?>";
					var comp = null;
					if (formato != '') {
						//$("#gestion_mostrar").hide();
						<?php
								$cantidad = count($nombre_arbol);
								for ($i = 0; $i < $cantidad; $i++) {
									//echo 'seleccionar_todos'.$nombre_arbol[$i]."(0); ";
								}
								?>
						$("#filtro_adicional").remove();
					} else {
						//$("#gestion_mostrar").show();
						$("#filtro_adicional").val("buzon_salida z@ AND iddocumento=z.archivo_idarchivo");
					}
					llamado_formulario(formato, ruta_sup, comp);
					return;
				<?php }
					if ($agreg_depen) {
						?>

					$.ajax({
						type: 'POST',
						url: "dependencias_padres.php",
						async: false,
						data: {
							funcionario: valores,
							tipo_funcionario: '<?php echo $tipo_funcionario; ?>'
						},
						success: function(retorno) {
							if (retorno != "") {
								adicional_dep = "," + retorno;
							}
						}
					});
				<?php
					}
					?>
				document.getElementById("<?php echo $entidad; ?>").value = valores + adicional_dep;
			}

			function fin_cargando<?php echo $entidad; ?>() {
				if (browserType == "gecko")
					document.poppedLayer =
					eval('document.getElementById("esperando<?php echo $entidad; ?>")');
				else if (browserType == "ie")
					document.poppedLayer =
					eval('document.getElementById("esperando<?php echo $entidad; ?>")');
				else
					document.poppedLayer =
					eval('document.layers["esperando<?php echo $entidad; ?>"]');
				document.poppedLayer.style.display = "none";
				document.getElementById('<?php echo $entidad; ?>').value = tree<?php echo $entidad; ?>.getAllChecked();
				<?php
					if ($cargar_todos == 1) {
						echo "seleccionar_todos" . $entidad . "(1);";
					}
					?>
			}

			function cargando<?php echo $entidad; ?>() {
				if (browserType == "gecko")
					document.poppedLayer =
					eval('document.getElementById("esperando<?php echo $entidad; ?>")');
				else if (browserType == "ie")
					document.poppedLayer =
					eval('document.getElementById("esperando<?php echo $entidad; ?>")');
				else
					document.poppedLayer =
					eval('document.layers["esperando<?php echo $entidad; ?>"]');
				document.poppedLayer.style.display = "";
			}

		});

		function seleccionar_todos<?php echo $entidad; ?>(tipo) {
			lista = tree<?php echo $entidad; ?>.getAllChildless();
			vector = lista.split(",");
			for (i = 0; i < vector.length; i++) {
				tree<?php echo $entidad; ?>.setCheck(vector[i], tipo);
			}
			document.getElementById("<?php echo $entidad; ?>").value = tree<?php echo $entidad; ?>.getAllChecked();
		}
		-- >
	</script>
<?php
}
?>