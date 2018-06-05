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
$campos = busca_filtro_tabla("", "pantalla_componente B", "idpantalla_componente=" . $_REQUEST["idpantalla_componente"], "", $conn);
for ($i = 0; $i < $campos["numcampos"]; $i++) {
    $librerias = explode(",", $campos[$i]["librerias"]);
    foreach ($librerias as $key => $libreria) {
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

    // Parsear el valor tipo1|tipo2|tipo3@multiple
    $tipo_carga = "unico";
    $extensiones = "";
    $valor = trim($pantalla_campos[0]["valor"]);
    if(!empty($valor)) {
        $findme = '@';
        $pos = strpos($valor, $findme);
        if ($pos !== false) { // fue encontrada
            $vector_extensiones_tipo = explode($findme, $pantalla_campos[0]["valor"]);
            $tipo_carga = $vector_extensiones_tipo[1];
            $extensiones_fijas = $vector_extensiones_tipo[0];
        } else {
            $extensiones_fijas = $valor;
        }

        if (!empty($extensiones_fijas)) {
            $new_ext = array_map('trim', explode('|', $extensiones_fijas));
            $extensiones_fijas = implode('|', $new_ext);
            $extensiones = $extensiones_fijas;
        }

        $tipo_unico = ($tipo_carga == "unico" ? ' checked="checked"' : "");
        $tipo_multiple = ($tipo_carga == "multiple" ? ' checked="checked"' : "");
    }

} else {
    alerta("No es posible Editar el Campo");
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
		<label class="control-label" for="obligatoriedad">Obligatoriedad</label>
		<div class="controls">
			<label class="control-label" for="obligatorio">
			<input type="radio" name="fs_obligatoriedad" id="obligatorio" value="1"
				<?php echo($obligatoriedad_si);?> required> Obligatorio
			</label>
			<label class="control-label" for="radios-1"> <input
				type="radio" name="fs_obligatoriedad" id="opcional" value="0"
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
			<label class="checkbox inline" for="acciones_6">
			<input type="checkbox" name="fs_acciones[]" id="acciones_6" value="p"
				<?php echo($accionesp); ?>> Descripci&oacute;n
			</label>
		</div>
	</div>
	<div class="control-group">
    <label class="control-label" for="valor">Extensiones aceptadas</label>
    <div class="controls">
      <textarea name="fs_valor" id="valor" placeholder="Extensiones"><?php echo $extensiones;?></textarea>
    </div>
  </div>
	<div class="control-group">
		<label class="control-label" for="uno_solo">Tipo</label>
		<div class="controls">
			<label class="control-label" for="uno_solo1">
			<input type="radio" name="uno_solo" id="uno_solo1" value="unico"
			<?php echo $tipo_unico;?>> Unico
			</label>
			<label class="control-label" for="uno_solo2">
			<input type="radio" name="uno_solo" id="uno_solo2" value="multiple"
				<?php echo $tipo_multiple;?>> M&uacute;ltiple
			</label>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="ayuda">Ayuda *</label>
		<div class="controls">
			<textarea name="fs_ayuda" id="ayuda" placeholder="Ayuda" required><?php echo(@$pantalla_campos[0]["ayuda"]);?></textarea>
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
		<button type="button" class="btn" id="cancelar_formulario_saia">Cancel</button>
		<div class="pull-right" id="cargando_enviar"></div>
	</div>
</form>
<?php
echo (librerias_jquery("1.7"));
echo (librerias_bootstrap());
echo (librerias_validar_formulario());
echo (librerias_notificaciones());
?>
<script type="text/javascript">
$(document).ready(function(){
	var formulario = $("#editar_pantalla_campo");
	formulario.validate({
    rules: {
      "fs_acciones[]": {
        required: true,
        minlength:1
      }
    }
  });
	$("#enviar_formulario_saia").click(function(){
    var idpantalla_campo=$("#idpantalla_campos").val();
		if(formulario.valid()){
			$('#cargando_enviar').html("Procesando <i id='icon-cargando'>&nbsp;</i>");

			var tipo = $('input[name="uno_solo"]:checked').val();
			var valor = $('#valor').val();
			//console.log(valor);
			valor = valor + "@" + tipo;

			$("#valor").val(valor);

			var datos = formulario.serialize();
			$(this).attr('disabled', 'disabled');
			$.ajax({
                type:'POST',
                url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php",
                data: "ejecutar_campos_formato=set_pantalla_campos&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+datos,
                success: function(html){
                  if(html){
                    var objeto=jQuery.parseJSON(html);
                    if(objeto.exito){
                      $('#cargando_enviar').html("Terminado ...");
                      //$("#content").append(objeto.etiqueta_html);
                      //setTimeout(notificacion_saia("Actualizaci&oacute;n realizada con &eacute;xito.","success","",2500),5000);
                      //$("#pc_"+idpantalla_campo,parent.document).find(".control-label").html(objeto.etiqueta);
                      $("#pc_"+idpantalla_campo,parent.document).replaceWith(objeto.codigo_html);
                      //$("#pc_"+idpantalla_campo,parent.document).find(".elemento_formulario").attr("placeholder",objeto.placeholder);
                      parent.hs.close();
                    }
                	}
                }
            });
		}
		else{
			$(".error").first().focus();
		}
	});
	$("#cancelar_formulario_saia").click(function(){
		parent.hs.close();
	});
});
</script>