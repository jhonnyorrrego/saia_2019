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
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "workflow/libreria_paso.php");

$idpaso_condicional = $_REQUEST["idpaso_condicional"];
$sAction = @$_POST["a_add"];
switch ($sAction) {
	case 'E' :
		$idpaso_condicional_admin = $_POST["idpaso_condicional_admin"];
		$fk_paso_condicional = $_POST["fk_paso_condicional"];
		$fk_campos_formato = $_POST["fk_campos_formato"];
		$comparacion = $_POST["comparacion"];
		$valor = $_POST["valor"];
		$estado = $_POST["estado"];
		$habilitar_pasos_si = $_POST["habilitar_pasos_si"];
		$habilitar_pasos_no = $_POST["habilitar_pasos_no"];
		$x_orden = $_POST["orden"];
		if (EditData()) {// Add New Record
			redirecciona($ruta_db_superior . "bpmn/condicional/condicionales_admin.php?idpaso_condicional=" . $fk_paso_condicional);
			exit();
		}
		break;
	default :
		if (!LoadData(@$_REQUEST["idpaso_condicional_admin"])) {
			redirecciona($ruta_db_superior . "bpmn/condicional/condicionales_admin.php?idpaso_condicional=" . $idpaso_condicional);
			exit();
		}
		break;
}

$condicional = busca_filtro_tabla("", "paso_condicional", "idpaso_condicional=" . $_REQUEST["idpaso_condicional"], "", $conn);
$paso_anterior = busca_filtro_tabla("", "paso_enlace", "destino=" . $idpaso_condicional . " AND tipo_destino='bpmn_condicional'", "", $conn);

$pasos_anteriores = array();
$filtrar = '-1';
$error = '';
for ($i = 0; $i < $paso_anterior["numcampos"]; $i++) {
	//solo se filtra a un nivel, es decir en el condicional no se valida un condicional anterior.
	//TODO: Adicionar al validador de flujos
	if ($paso_anterior[$i]["tipo_origen"] == "bpmn_tarea") {
		$pasos_temp = listado_pasos_anteriores_admin($paso_anterior[$i]["origen"]);
		array_push($pasos_anteriores, $paso_anterior[$i]["origen"]);
		array_merge($pasos_anteriores, $pasos_temp);
	}
}
if (count($pasos_anteriores)) {
	$formatos_anteriores = busca_filtro_tabla("", "paso_actividad A", "A.estado=1 AND A.paso_idpaso IN(" . implode(",", $pasos_anteriores) . ") AND A.formato_idformato IS NOT NULL AND A.formato_idformato<>''", "", $conn);
	if ($formatos_anteriores["numcampos"]) {
		$campos = extrae_campo($formatos_anteriores, "formato_idformato");
		$filtrar = implode(",", $campos);
	} else {
		$error = "No se encuentran formatos vinculados para realizar validaciones";
	}
}
//No se consideran condicionales anidadas (es decir condicional seguida de otra condicional)
//TODO: Adicionar al validador de flujos
$paso_siguiente = busca_filtro_tabla("", "paso_enlace", "origen=" . $idpaso_condicional . " AND tipo_origen='bpmn_condicional' AND tipo_destino='bpmn_tarea'", "", $conn);
$pasos_siguientes = array();
for ($i = 0; $i < $paso_siguiente["numcampos"]; $i++) {
	array_push($pasos_siguientes, $paso_siguiente[$i]["destino"]);
}

function LoadData($sKey) {
	global $idpaso_condicional_admin, $fk_paso_condicional, $fk_campos_formato, $comparacion, $valor, $habilitar_pasos_si, $habilitar_pasos_no, $estado, $x_orden, $conn;
	$datos = busca_filtro_tabla("", "paso_condicional_admin", "idpaso_condicional_admin=" . $sKey, "", $conn);
	if ($datos["numcampos"]) {
		$LoadData = true;
		$fk_paso_condicional = $datos[0]["fk_paso_condicional"];
		$fk_campos_formato = $datos[0]["fk_campos_formato"];
		$comparacion = $datos[0]["comparacion"];
		$valor = $datos[0]["valor"];
		$habilitar_pasos_si = $datos[0]["habilitar_pasos_si"];
		$habilitar_pasos_no = $datos[0]["habilitar_pasos_no"];
		$estado = $datos[0]["estado"];
		$x_orden = $datos[0]["orden"];
	} else {
		$LoadData = false;
	}
	return $LoadData;
}

function EditData() {
	global $idpaso_condicional_admin, $fk_paso_condicional, $fk_campos_formato, $comparacion, $valor, $habilitar_pasos_si, $habilitar_pasos_no, $estado, $x_orden, $conn;
	$fieldList["fk_paso_condicional"] = "'" . $fk_paso_condicional . "'";
	$fieldList["fk_campos_formato"] = "'" . $fk_campos_formato . "'";
	$fieldList["comparacion"] = "'" . $comparacion . "'";
	$fieldList["valor"] = "'" . $valor . "'";
	$fieldList["estado"] = "'" . $estado . "'";
	$fieldList["habilitar_pasos_si"] = "'" . $habilitar_pasos_si . "'";
	$fieldList["habilitar_pasos_no"] = "'" . $habilitar_pasos_no . "'";
	$fieldList["orden"] = "'" . $x_orden . "'";

	$strsql = 'UPDATE paso_condicional_admin SET ';
	$arreglo = array();
	foreach ($fieldList as $key => $value) {
		array_push($arreglo, $key . "=" . $value);
	}
	$strsql .= implode(",", $arreglo);
	$strsql .= ' WHERE idpaso_condicional_admin=' . $idpaso_condicional_admin;
	phpmkr_query($strsql) or die("Error al actualizar");
	return true;
}

include_once ($ruta_db_superior . "librerias_saia.php");
echo(estilo_bootstrap());
echo librerias_jquery("1.7");
echo librerias_validar_formulario("11");
echo(librerias_arboles());
?>

<p><i class="icon-share-alt"></i><a href="<?php echo($ruta_db_superior);?>bpmn/condicional/condicionales_admin.php?idpaso_condicional=<?php echo($fk_paso_condicional);?>">Regresar</a></p>
<?php
if($error!=''){
  die('<div class="alert alert-error">'.$error.'</div>');
}   
?>
<div class="container">
    <div class="control-group" nombre="etiqueta">
      <legend>Editar Condicional: <?php echo($condicional[0]["etiqueta"]); ?></legend>
    </div>
    <form name="editar_condicional" id="editar_condicional" action="editar_condicional.php" method="post" class="form-horizontal">
      <div class="control-group">
        <label class="control-label" for="fk_campos_formato">Campo de validacion*:</label>
        <div class="controls">
        	<input type="hidden" id="formato_campo" name="formato_campo">
          <div id="esperando_serie">
            <img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif">
          </div>
          <div id="treeboxbox_tree3" style="height:auto;"></div><br/>
          <div id="listado_campos_formato"></div>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="comparacion">Comparaci&oacute;n*:</label>
        <div class="controls"> 
          <select name="comparacion" id="comparacion">
            <option value="==" <?php if($comparacion=="==")echo("selected");?>>Igual a</option>
            <option value="<" <?php if($comparacion=="<")echo("selected");?>>Menor que</option>
            <option value=">" <?php if($comparacion==">")echo("selected");?>>Mayor que</option>
            <option value="<=" <?php if($comparacion=="<=")echo("selected");?>>Menor o igual que</option>
            <option value=">=" <?php if($comparacion==">=")echo("selected");?>>Mayor o igual que</option>
            <option value="<>" <?php if($comparacion=="<>")echo("selected");?>>Diferente a</option>
          </select>   
        </div>
      </div>
			<div class="control-group">
				<label class="control-label" for="valor">Valor*:</label>
				<div class="controls">
					<input type="hidden" name="valor" id="valor" value="<?php echo $valor; ?>">
					<div id="div_genera_campo"></div>
					<br/>
				</div>
			</div>
		
      <div class="control-group">
        <label class="control-label" for="paso_siguiente">habilitar pasos*:</label>
        <div class="controls" id="paso_siguiente">
          <input type="hidden" id="habilitar_si" name="habilitar_pasos_si" value="<?php echo($habilitar_pasos_si); ?>">
          <input type="hidden" id="habilitar_no" name="habilitar_pasos_no" value="<?php echo($habilitar_pasos_no); ?>">
          <?php
          $datos_siguientes=busca_filtro_tabla("","paso","idpaso IN(".implode(",",$pasos_siguientes).")","",$conn); 
          if($datos_siguientes["numcampos"]){
            echo('<table class="table">');
            echo('<tr><th>Habilitar paso</th><th>Cumple</th></tr>');
            for($i=0;$i<$datos_siguientes["numcampos"];$i++){
              echo('<tr><td>'.$datos_siguientes[$i]["nombre_paso"].'</td><td><div class="btn btn-mini habilitar_si habilitar_paso" idpaso="'.$datos_siguientes[$i]["idpaso"].'">Si</div>&nbsp;&nbsp;<div class="btn btn-mini habilitar_no habilitar_paso" idpaso="'.$datos_siguientes[$i]["idpaso"].'">No</div></td></tr>');
            }
            echo('</table>');
          }   
          ?>   
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="estado">Estado*:</label>
        <div class="controls">
          Activo <input type="radio" name="estado" id="estado" value="1" <?php if($estado==1)echo("checked"); ?>>
          Inactivo <input type="radio" name="estado" id="estado" value="0" <?php if($estado==0)echo("checked"); ?>>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="orden">Orden*:</label>
        <div class="controls">
					<?php
					$orden = busca_filtro_tabla("A.*,B.etiqueta", "paso_condicional_admin A, campos_formato B, formato C", "A.fk_campos_formato=B.idcampos_formato AND A.fk_paso_condicional=" . $_REQUEST["idpaso_condicional"] . " AND A.estado=1 AND B.formato_idformato=C.idformato AND idpaso_condicional_admin not in(" . @$_REQUEST["idpaso_condicional_admin"] . ")", "A.orden", $conn);
					?>
					<select name="orden" id="orden">
					<option value='0'>Primero en la lista de acciones</option>
					<?php
					for ($i = 0; $i < $orden["numcampos"]; $i++) {
						if ($x_orden == $orden[$i]["orden"]) {
							echo "<option value='" . $orden[$i]["orden"] . "' selected>Posterior a " . $orden[$i]["etiqueta"] . $orden[$i]["comparacion"] . $orden[$i]["valor"] . "</option>";
						}else{
							echo "<option value='" . $orden[$i]["orden"] . "'>Posterior a " . $orden[$i]["etiqueta"] . $orden[$i]["comparacion"] . $orden[$i]["valor"] . "</option>";
						}
					}
					?>
          </select>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <input type="hidden" name="idpaso_condicional_admin" value="<?php echo(@$_REQUEST["idpaso_condicional_admin"]); ?>">
          <input type="hidden" name="a_add" value="E">
          <input type="hidden" name="fk_paso_condicional" id="fk_paso_condicional" value="<?php echo(@$_REQUEST["idpaso_condicional"]);?>">
          <input type='submit' class="btn btn-primary btn-mini" name="submit" id="submit" value="continuar">   
        </div>
      </div>
    </form>
  </div>

<script type="text/javascript">
	$(document).ready(function() {

		$("#fk_campos_formato").live("change", function() {
			if ($(this).val() != "") {
				$.ajax({
					type : 'POST',
					url : "generar_campo.php",
					data : {
						idcampo : $(this).val(),
						idnombre : "valor_temp",
						seleccionado:$("#valor").val(),
						opt : 1
					},
					dataType : 'json',
					success : function(datos) {
						if (datos.exito) {
							$("#div_genera_campo").empty().html(datos.html_campos["valor_temp"]);
						} else {
							top.noty({
								text : datos.msn,
								type : 'error',
								layout : "topCenter",
								timeout : 300
							});
						}
					},
					error : function() {
						top.noty({
							text : 'Error al procesar la solicitud',
							type : 'error',
							layout : "topCenter",
							timeout : 300
						});
					}
				});
			} else {
				$("#valor").val("");
				$("#div_genera_campo").empty();
			}
		});

		var habilitar_si="<?php echo($habilitar_pasos_si); ?>".split(",");
		var habilitar_no="<?php echo($habilitar_pasos_no); ?>".split(",");
		$(".habilitar_si").each(function() {
			var idpaso = $(this).attr("idpaso");
			var resultado = jQuery.inArray(idpaso, habilitar_si);
			if (resultado != -1) {
				$(this).addClass("btn-primary");
			}
		});
		$(".habilitar_no").each(function() {
			var idpaso = $(this).attr("idpaso");
			var resultado = jQuery.inArray(idpaso, habilitar_no);
			if (resultado != -1) {
				$(this).addClass("btn-primary");
			}
		});

		habilitar_si = Array();
		habilitar_no = Array();
		$(".habilitar_paso").live("click", function() {
			var paso = $(this).attr("idpaso");
			var aux_no = habilitar_no.indexOf(paso);
			var aux_si = habilitar_si.indexOf(paso);
			if ($(this).hasClass("habilitar_si")) {
				if (aux_si === -1) {
					habilitar_si.push(paso);
					$(this).addClass("btn-primary");
				} else {
					habilitar_si.splice(aux_si, 1);
					$(this).removeClass("btn-primary");
				}
				if (aux_no !== -1) {
					habilitar_no.splice(aux_no, 1);
					$(this).next(".habilitar_no").removeClass("btn-primary");
				}
			}
			if ($(this).hasClass("habilitar_no")) {
				if (aux_no === -1) {
					habilitar_no.push(paso);
					$(this).addClass("btn-primary");
				} else {
					habilitar_no.splice(aux_no, 1);
					$(this).removeClass("btn-primary");
				}
				if (aux_si !== -1) {
					habilitar_si.splice(aux_si, 1);
					$(this).prev(".habilitar_si").removeClass("btn-primary");
				}
			}
			$("#habilitar_si").val(habilitar_si.toString());
			$("#habilitar_no").val(habilitar_no.toString());
		});
		$(".habilitar_paso").trigger("click");

		$("#editar_condicional").validate({
			rules : {
				fk_campos_formato : {
					required : true
				},
				valor_temp : {
					required : true
				}
			},
			submitHandler : function(form) {
				if (!$("#formato_campo").val()) {
					top.noty({
						text : 'Por favor seleccione el campo de validacion',
						type : 'error',
						layout : "topCenter",
						timeout : 3000
					});
					return false;
				} else {
					etiqueta_html = $("#fk_campos_formato option:selected").attr('data-type');
					if (etiqueta_html == "checkbox") {
						check = new Array();
						j = 0;
						$(".checkbox_valor_temp").each(function() {
							if ($(this).is(':checked') === true) {
								check[j] = $(this).val();
								j++;
							}
						});
						valor_temp = check.join(",");
					} else {
						valor_temp = $("[name='valor_temp']").val();
					}
					if (!valor_temp) {
						top.noty({
							text : 'Por favor ingrese el valor',
							type : 'error',
							layout : "topCenter",
							timeout : 3000
						});
						return false;
					} else {
						$("#valor").val(valor_temp);
						form.submit();
					}
				}
			}
		});
	});

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
	//TODO: Verificar el dato de los arboles para el radio
	tree3 = new dhtmlXTreeObject("treeboxbox_tree3", "100%", "auto", 0);
	tree3.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
	tree3.enableIEImageFix(true);
	tree3.enableTreeImages(false);
	tree3.enableRadioButtons(true);
	tree3.setOnLoadingStart(cargando_serie);
	tree3.setOnLoadingEnd(fin_cargando_serie);
	tree3.loadXML("<?php echo($ruta_db_superior);?>test_formatos.php?filtrar=<?php echo($filtrar);?>");
	tree3.setOnCheckHandler(onNodeSelect_llave_entidad);

	function onNodeSelect_llave_entidad(nodeId) {
		var valor_llave = $("#formato_campo");
		valor_llave.val(nodeId);
		if (tree3.isItemChecked(nodeId)) {
			if (valor_llave.val() !== "") {
				tree3.setCheck(valor_llave.val(), false);
			}
			var nodo = nodeId.split("#");
			$.ajax({
				type : 'POST',
				url : "campos_formato_condicional.php",
				data : {
					"idformato" : nodo[0]
				},
				dataType : 'json',
				success : function(objeto) {
					if (objeto.campos !== '') {
						$("#listado_campos_formato").html(objeto.campos);
						<?php if($fk_campos_formato){ ?>
						$('#fk_campos_formato > option[value="<?php echo($fk_campos_formato); ?>"]').attr('selected', 'selected');
						$("#fk_campos_formato").change();
						<?php } ?>
					} else {
						noty({
							text : 'No es posible encontrar campos para el formato seleccionado',
							type : 'error',
							layout : "topCenter",
							timeout : 300
						});
					}
				},
				error : function() {
					noty({
						text : 'Error al procesar la solicitud',
						type : 'error',
						layout : "topCenter",
						timeout : 300
					});
				}
			});
		} else {
			valor_llave.val("");
			$("#listado_campos_formato").html('');
			//Forma mas rapida de vaciar un arreglo en javascript
			while (habilitar_si.length > 0) {
				habilitar_si.pop();
			}
			while (habilitar_no.length > 0) {
				habilitar_no.pop();
			}
			$("#habilitar_si").val("");
			$(".habilitar_no").val("");
			$(".habilitar_si").removeClass("btn-primary");
			$(".habilitar_no").removeClass("btn-primary");
		}
	}

	function fin_cargando_serie() {
		if (browserType == "gecko")
			document.poppedLayer = eval('document.getElementById("esperando_serie")');
		else if (browserType == "ie")
			document.poppedLayer = eval('document.getElementById("esperando_serie")');
		else
			document.poppedLayer = eval('document.layers["esperando_serie"]');
		document.poppedLayer.style.visibility = "hidden";
		<?php if($fk_campos_formato){
		$formato=busca_filtro_tabla("b.idformato,b.nombre","campos_formato a, formato b","a.idcampos_formato=".$fk_campos_formato." and a.formato_idformato=b.idformato","",$conn);
		$cadena=$formato[0]["idformato"]."#2#".$formato[0]["nombre"];
		?>
		  tree3.setCheck("<?php echo($cadena); ?>",true);
		  tree3.openAllItems(0);
		  onNodeSelect_llave_entidad("<?php echo($cadena); ?>");
		<?php } ?>
	}

	function cargando_serie() {
		if (browserType == "gecko")
			document.poppedLayer = eval('document.getElementById("esperando_serie")');
		else if (browserType == "ie")
			document.poppedLayer = eval('document.getElementById("esperando_serie")');
		else
			document.poppedLayer = eval('document.layers["esperando_serie"]');
		document.poppedLayer.style.visibility = "visible";
	}
</script>    

