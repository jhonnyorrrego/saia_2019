<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "pantallas/generador/librerias.php");
echo (estilo_bootstrap());
echo (librerias_jquery("1.8"));
$campos = busca_filtro_tabla("", "pantalla_componente B", "idpantalla_componente=" . $_REQUEST["idpantalla_componente"], "", $conn);
for ($i = 0; $i < $campos["numcampos"]; $i++) {
    $librerias = explode(",", $campos[$i]["librerias"]);
    foreach ($librerias as $key => $libreria) {
        $pos = strpos($libreria, '@');
        if ($pos !== false) {
            $pre_libreria = explode('@', $libreria);
            $libreria = $pre_libreria[0];
        }
        $extension = explode(".", $libreria);
        $cant = count($extension);
        if ($extension[$cant - 1] !== '') {
            switch ($extension[($cant - 1)]) {
                case "php":
                    include_once ($ruta_db_superior . $libreria);
                    break;
                case "js":
                    $texto = '<script type="text/javascript" src="' . $ruta_db_superior . $libreria . '"></script>';
                    break;
                case "css":
                    $texto = '<link rel="stylesheet" type="text/css" href="' . $ruta_db_superior . $libreria . '"/>';
                    break;
                default:
                    $texto = ""; // retorna un vacio si no existe el tipo
                    break;
            }
            echo ($texto);
        }
    }
}
$accionesa = "checked";
$accionese = "checked";
$accionesb = "checked";
$acciones1 = "";
$accionesp = "";
if (@$_REQUEST["idpantalla_campos"]) {
    $pantalla_campos = get_pantalla_campos($_REQUEST["idpantalla_campos"], 0);
    $obligatoriedad_si = '';
    $obligatoriedad_no = '';
    if ($pantalla_campos[0]["obligatoriedad"]) {
        $obligatoriedad_si = ' checked="checked"';
    } else {
        $obligatoriedad_no = ' checked="checked"';
    }
    $accionesa = "";
    $accionese = "";
    $accionesb = "";
    $acciones1 = "";
    $accionesp = "";
    $acciones_guardadas = explode(",", $pantalla_campos[0]["acciones"]);
    if (in_array("a", $acciones_guardadas)) {
        $accionesa = "checked";
    }
    if (in_array("e", $acciones_guardadas)) {
        $accionese = "checked";
    }
    if (in_array("b", $acciones_guardadas)) {
        $accionesb = "checked";
    }
    if (in_array("1", $acciones_guardadas)) {
        $acciones1 = "checked";
    }
    if (in_array("p", $acciones_guardadas)) {
        $accionesp = "checked";
    }

    $opciones = json_decode($pantalla_campos[0]["valor"], true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        $opciones = array();
    }

} else {
    alerta("No es posible Editar el Campo");
}
if ($pantalla_campos[0]["nombre"] == "id" . $pantalla_campos[0]["tabla"]) {
    echo "Este campo no se puede modificar porque corresponde a la llave primaria de la pantalla.";
    die();
}
?>
<form method="POST" action="" class="form-horizontal"
	name="editar_pantalla_campo" id="editar_pantalla_campo">
	<fieldset id="content_form_name">
		<legend>Editar Campos</legend>
	</fieldset>
	<div class="control-group">
		<label class="control-label" for="nombre">Nombre *</label>
		<div class="controls">
			<input type="text" name="fs_nombre" id="nombre" placeholder="Nombre"
				value="<?php echo(@$pantalla_campos[0]["nombre"]);?>" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="etiqueta">Etiqueta *</label>
		<div class="controls">
			<input type="text" name="fs_etiqueta" id="etiqueta"
				placeholder="Etiqueta"
				value="<?php echo(@$pantalla_campos[0]["etiqueta"]);?>" required>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="etiqueta">Tipo de dato *</label>
		<div class="controls">
			<select name="fs_tipo_dato" id="tipo_dato" required>
<?php
if (MOTOR == "MySql") {
    echo "<option value='int'>Entero</option>";
    echo "<option value='varchar'>Caracter variable</option>";
    echo "<option value='date'>Fecha</option>";
    echo "<option value='datetime'>Fecha y hora</option>";
}
if (MOTOR == "Oracle") {
    echo "<option value='number'>Entero</option>";
    echo "<option value='varchar2'>Caracter variable</option>";
    echo "<option value='date'>Fecha</option>";
    echo "<option value='date'>Fecha y hora</option>";
}
?>
      </select>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="etiqueta">Longitud *</label>
		<div class="controls">
			<input type="text" name="fs_longitud" id="longitud"
				value="<?php echo (@$pantalla_campos[0]["longitud"]); ?>">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="obligatoriedad">Obligatoriedad</label>
		<div class="controls">
			<label class="control-label" for="obligatorio">
			<input type="radio" name="fs_obligatoriedad" id="obligatorio" value="1"
				<?php echo($obligatoriedad_si);?> required> Obligatorio
			</label>
			<label class="control-label" for="radios-1">
			<input type="radio" name="fs_obligatoriedad" id="opcional" value="0"
				<?php echo($obligatoriedad_no);?>> Opcional
			</label>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Formularios *</label>
		<div class="controls">
			<label class="checkbox inline" for="acciones_0">
			<input type="checkbox" name="fs_acciones[]" id="acciones_0" value="a"
				<?php echo($accionesa); ?>> Adicionar
			</label>
			<label class="checkbox inline" for="acciones_1">
			<input type="checkbox" name="fs_acciones[]" id="acciones_1" value="e"
				<?php echo($accionese); ?>> Editar
			</label>
			<label class="checkbox inline" for="acciones_2">
			<input type="checkbox" name="fs_acciones[]" id="acciones_2" value="b"
				<?php echo($accionesb); ?>> Buscar
			</label>
			<label class="checkbox inline" for="acciones_5">
			<input type="checkbox" name="fs_acciones[]" id="acciones_5" value="1"
				<?php echo($acciones1); ?>> Autoguardado
			</label>
			<label class="checkbox inline" for="acciones_6">
			<input type="checkbox" name="fs_acciones[]" id="acciones_6" value="p"
				<?php echo($accionesp); ?>> Descripci&oacute;n
			</label>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="valor">Opciones</label>
		<div class="controls controls-row">
			<input type="hidden" name="fs_valor" id="valor" value="<?php echo(@$pantalla_campos[0]["valor"]);?>"/>
			<?php
			$texto_opc = array();
			$texto_opc[] = '<label for="opciones_url">Tipo&nbsp;';
			$texto_opc[] = '<select class="opciones" name="opciones_url" id="opciones_url">';
			$valor_url = "";
			if(isset($opciones["url"])) {
			    $valor_url = $opciones["url"];
			}
			$sel_fun = $valor_url == "arboles/arbol_funcionario.php" ? "selected" : "";
			$sel_dep = $valor_url == "arboles/arbol_dependencia.php" ? "selected" : "";
			$sel_car = $valor_url == "arboles/arbol_cargo.php" ? "selected" : "";
			$sel_ser = $valor_url == "arboles/arbol_serie.php" ? "selected" : "";
			$texto_opc[] = '<option value="arboles/arbol_funcionario.php?idcampofun=1" ' . $sel_fun . '>Funcionarios</option>';
			$texto_opc[] = '<option value="arboles/arbol_dependencia.php" ' . $sel_dep . '>Dependencias</option>';
			$texto_opc[] = '<option value="arboles/arbol_cargo.php" ' . $sel_car . '>Cargos</option>';
			$texto_opc[] = '<option value="arboles/arbol_serie.php" ' . $sel_ser  . '>Series</option>';
		    $texto_opc[] = "</select></label></div>";

		    $texto_opc[] = '<div class="controls controls-row"><label class="radio inline" for="opciones_checkbox_1">';
		    $texto_opc[] = '<input type="radio" class="opciones" name="opciones_checkbox" id="opciones_checkbox_1" value="1"';
		    $valor_checkbox = '';
		    if(isset($opciones["checkbox"]) && $opciones["checkbox"] == "1") {
		        $valor_checkbox = ' checked="checked"';
		    }
		    $texto_opc[] = $valor_checkbox . ">M&uacute;ltiple</label>";
		    $texto_opc[] = '<label class="radio inline" for="opciones_checkbox_2">';
		    $texto_opc[] = '<input type="radio" class="opciones" name="opciones_checkbox" id="opciones_checkbox_2" value="radio"';
		    $valor_checkbox = '';
		    if(isset($opciones["checkbox"]) && $opciones["checkbox"] == "radio") {
		        $valor_checkbox = ' checked="checked"';
		    }
		    $texto_opc[] = $valor_checkbox . ">Simple</label></div>";

		    $texto_opc[] = '<div class="controls controls-row">Buscador&nbsp;<label class="radio inline" for="opciones_buscador_1">';
		    $texto_opc[] = '<input type="radio" class="opciones" name="opciones_buscador" id="opciones_buscador_1" value="0"';
		    $valor_buscador = '';
		    if(isset($opciones["buscador"]) && $opciones["buscador"] == "0") {
		        $valor_buscador = ' checked="checked"';
		    }
		    $texto_opc[] = $valor_buscador . ">No</label>";
		    $texto_opc[] = '<label class="radio inline" for="opciones_buscador_2">';
		    $texto_opc[] = '<input type="radio" class="opciones" name="opciones_buscador" id="opciones_buscador_2" value="1"';
		    $valor_buscador = '';
		    if(isset($opciones["buscador"]) && $opciones["buscador"] == "1") {
		        $valor_buscador = ' checked="checked"';
		    }
		    $texto_opc[] = $valor_buscador . ">Si</label></div>";

		    $texto_opc[] = '<div class="controls controls-row"><label for="opciones_funcsel">Funci&oacute;n seleccionar&nbsp;';
		    $texto_opc[] = '<input type="text" class="opciones" name="opciones_funcion_select" id="opciones_funcsel"';
		    $valor_funcsel = ' value=""';
		    if(isset($opciones["funcion_select"])) {
		        $valor_funcsel = ' value="' .  $opciones["funcion_select"] . '"';
		    }
		    $texto_opc[] = $valor_funcsel . "></label></div>";

		    $texto_opc[] = '<div class="controls controls-row"><label for="opciones_funcclick">Funci&oacute;n click&nbsp;';
		    $texto_opc[] = '<input type="text" class="opciones" name="opciones_funcion_click" id="opciones_funcclick"';
		    $valor_funcclick = ' value=""';
		    if(isset($opciones["funcion_click"])) {
		        $valor_funcclick = ' value="' .  $opciones["funcion_click"] . '"';
		    }
		    $texto_opc[] = $valor_funcclick . "></label></div>";

		    $texto_opc[] = '<div class="controls controls-row"><label for="opciones_funcdclick">Funci&oacute;n doble click&nbsp;';
		    $texto_opc[] = '<input type="text" class="opciones" name="opciones_funcion_dobleclick" id="opciones_funcdclick"';
		    $valor_funcdclick = ' value=""';
		    if(isset($opciones["funcion_dobleclick"])) {
		        $valor_funcdclick = ' value="' .  $opciones["funcion_dobleclick"] . '"';
		    }
		    $texto_opc[] = $valor_funcdclick . "></label></div>";

		    echo implode("", $texto_opc);
		    ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="predeterminado">Valor predeterminado</label>
		<div class="controls">
			<input type="text" name="fs_predeterminado" id="predeterminado"
				placeholder="Valor predeterminado"
				value="<?php echo(@$pantalla_campos[0]["predeterminado"]);?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="ayuda">Ayuda</label>
		<div class="controls">
			<textarea name="fs_ayuda" id="ayuda" placeholder="Ayuda"><?php echo(@$pantalla_campos[0]["ayuda"]);?></textarea>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="placeholder">Marcador</label>
		<div class="controls">
			<input type="text" name="fs_placeholder" id="placeholder"
				placeholder="Marcador"
				value="<?php echo(@$pantalla_campos[0]["placeholder"]);?>">
		</div>
	</div>
	<div class="form-actions">
		<input type="hidden" name="idpantalla_campos" id="idpantalla_campos"
			value="<?php echo($_REQUEST["idpantalla_campos"]); ?>">
		<button type="button" class="btn btn-primary"
			id="enviar_formulario_saia">Aceptar</button>
		<button type="button" class="btn" id="cancelar_formulario_saia">Cancelar</button>
		<div class="pull-right" id="cargando_enviar"></div>
	</div>
</form>
<?php
echo (librerias_bootstrap());
echo (librerias_validar_formulario());
echo (librerias_notificaciones());
?>
<script type="text/javascript">
$(document).ready(function() {
	var formulario = $("#editar_pantalla_campo");
	formulario.validate({
        rules: {
            "fs_acciones[]": {
            required: true,
            minlength:1
        }
    }
});

$("#enviar_formulario_saia").click(function() {
    var idpantalla_campo = $("#idpantalla_campos").val();
    if(formulario.valid()) {
    	$('#cargando_enviar').html("Procesando <i id='icon-cargando'>&nbsp;</i>");
    	$(this).attr('disabled', 'disabled');
    	var datos = formulario.serializeArray();
    	datos.push({name : "ejecutar_campos_formato", value : "set_pantalla_campos"});
    	datos.push({name : "tipo_retorno", value : "1"});
    	var js_data = {};
        $.each(datos, function() {
           if (js_data[this.name]) {
               if (!js_data[this.name].push) {
            	   js_data[this.name] = [js_data[this.name]];
               }
               js_data[this.name].push(this.value || '');
           } else {
        	   js_data[this.name] = this.value || '';
           }
        });
        var orig = $("#fs_valor").val();
        var nuevo = {};
        $("input.opciones,select.opciones").each(function() {
            var x = $(this).attr("name").replace("opciones_", "");
            nuevo[x] = $(this).val();
        });
        js_data.fs_valor = JSON.stringify(nuevo);
    	//console.log(js_data);
    	$.ajax({
            type:'POST',
            url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php",
            data: js_data,
            async: false,
            success: function(html) {
                if(html) {
                    var objeto=jQuery.parseJSON(html);
                    if(objeto.exito) {
                        $('#cargando_enviar').html("Terminado ...");
                        //$("#content").append(objeto.etiqueta_html);
                        //setTimeout(notificacion_saia("Actualizaci&oacute;n realizada con &eacute;xito.","success","",2500),5000);
                        $("#pc_"+idpantalla_campo,parent.document).find(".control-label").html(objeto.etiqueta);
                        //$("#pc_"+idpantalla_campo,parent.document).replaceWith(objeto.codigo_html);
                        //$("#pc_"+idpantalla_campo,parent.document).find(".elemento_formulario").attr("placeholder",objeto.placeholder);
                        parent.hs.close();
                    }
                }
            }
        });
    } else {
		$(".error").first().focus();
	}
});

$("#cancelar_formulario_saia").click(function() {
		parent.hs.close();
});

	<?php if(@$pantalla_campos[0]["tipo_dato"]){ ?>
	$("#tipo_dato option[value='<?php echo @$pantalla_campos[0]["tipo_dato"]; ?>']").attr("selected",true);
	<?php } ?>
});
</script>
