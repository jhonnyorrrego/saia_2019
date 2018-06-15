<?php
include_once ("db.php");
include_once ("header.php");
include_once ("librerias_saia.php");
include_once("pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');
echo(librerias_jquery("1.7"));
echo librerias_validar_formulario();

$configuracion = busca_filtro_tabla("A.valor", "configuracion A", "A.tipo='usuario' AND A.nombre='login_administrador'", "", $conn);
$admin = 0;
if ($configuracion["numcampos"] && trim($configuracion[0]["valor"]) == trim($_SESSION["LOGIN" . LLAVE_SAIA])) {
	$admin = 1;
}
if (isset($_REQUEST["key"])) {
	$_REQUEST["idmodulo"] = $_REQUEST["key"];
}

if (isset($_REQUEST["accion"])) {
	switch (trim($_REQUEST["accion"])) {
		case 'guardar_adicionar' :
			if ($admin == 0) {
				$_REQUEST["permiso_admin"] = 0;
			}
			$enlace_pantalla = 0;
			if (@$_REQUEST['enlace_pantalla']) {
				$enlace_pantalla = 1;
			}
			$sql = "INSERT INTO modulo(nombre,tipo,imagen,etiqueta,enlace,destino,cod_padre,orden,parametros,busqueda_idbusqueda,ayuda,permiso_admin,busqueda,enlace_pantalla) VALUES('" . $_REQUEST["nombre"] . "','" . $_REQUEST["tipo"] . "','" . $_REQUEST["imagen"] . "','" . $_REQUEST["etiqueta"] . "','" . $_REQUEST["enlace"] . "','" . $_REQUEST["destino"] . "','" . $_REQUEST["cod_padre"] . "','" . $_REQUEST["orden"] . "','" . $_REQUEST["parametros"] . "','" . $_REQUEST["busqueda_idbusqueda"] . "','" . $_REQUEST["ayuda"] . "'," . $_REQUEST["permiso_admin"] . ",'" . $_REQUEST["busqueda"] . "'," . $enlace_pantalla . ")";
			$insertado = ejecuta_sql($sql);
			
			if ($insertado) {
				alerta("Modulo creado.", 'success', 4000);
			} else {
				alerta("No se pudo crear el modulo.", 'error', 4000);
			}
			abrir_url("moduloadd.php?accion=listar", "_self");
			break;
		case 'guardar_editar' :
			$enlace_pantalla = 0;
			if (@$_REQUEST['enlace_pantalla']) {
				$enlace_pantalla = 1;
			}
			$sql = "UPDATE modulo SET nombre='" . $_REQUEST["nombre"] . "',tipo='" . $_REQUEST["tipo"] . "',imagen='" . $_REQUEST["imagen"] . "',etiqueta='" . $_REQUEST["etiqueta"] . "',enlace='" . $_REQUEST["enlace"] . "',destino='" . $_REQUEST["destino"] . "',cod_padre='" . $_REQUEST["cod_padre"] . "',orden='" . $_REQUEST["orden"] . "',parametros='" . $_REQUEST["parametros"] . "',busqueda_idbusqueda='" . $_REQUEST["busqueda_idbusqueda"] . "',ayuda='" . $_REQUEST["ayuda"] . "',permiso_admin=" . $_REQUEST["permiso_admin"] . ", busqueda='" . $_REQUEST["busqueda"] . "', enlace_pantalla=" . $enlace_pantalla . " WHERE idmodulo='" . $_REQUEST["idmodulo"] . "'";
			$insertado = ejecuta_sql($sql);
			if ($insertado) {
				alerta("Modulo actualizado.", 'success', 4000);
			} else {
				alerta("No se pudo actualizar el modulo.", 'error', 4000);
			}
			abrir_url("moduloadd.php?key=" . $_REQUEST["idmodulo"] . "&accion=editar", "_self");
			break;
		case 'guardar_eliminar' :
			$sql = "DELETE FROM modulo WHERE idmodulo='" . $_REQUEST["idmodulo"] . "'";
			ejecuta_sql($sql);
			alerta("Modulo Eliminado.", 'success', 4000);
			abrir_url("moduloadd.php?accion=listar", "_self");
			break;
		case 'adicionar' :
			formato_adicionar();
			break;
		case 'editar' :
			formato_adicionar($_REQUEST["idmodulo"]);
			break;
		case 'ver' :
			formato_adicionar($_REQUEST["idmodulo"], 1);
			break;
		case 'eliminar' :
			formato_adicionar($_REQUEST["idmodulo"], 2);
			break;
		case 'listar' :
			$modulo = busca_filtro_tabla("", "modulo", "nombre='modulos'", "", $conn);
			abrir_url($ruta_db_superior . $modulo[0]["enlace"], "centro");
			break;
	}
}

function select_modulos($valor = 0) {
	global $conn, $admin;
	$parte = "";
	if ($admin == 0) {
		$parte = "permiso_admin=0";
	}
	$modulos = busca_filtro_tabla("idmodulo,etiqueta,nombre", "modulo", $parte, "lower(etiqueta) asc", $conn);
	$select_mod = "<select name='cod_padre' id='cod_padre'><option value='0' selected>Ninguno</option>";
	for ($i = 0; $i < $modulos["numcampos"]; $i++) {
		$select_mod .= "<option value='" . $modulos[$i]["idmodulo"] . "'";
		if ($valor == $modulos[$i]["idmodulo"])
			$select_mod .= " selected ";
		$select_mod .= " >" . $modulos[$i]["etiqueta"] . " (" . $modulos[$i]["nombre"] . ")</option>";
	}
	$select_mod .= "</select>";
	return ($select_mod);
}

function formato_adicionar($idmodulo=NULL,$ver=0){
    global $conn,$admin;
	if ($idmodulo <> NULL) {
		$modulo = busca_filtro_tabla("", "modulo", "idmodulo=".$idmodulo, "", $conn);
		if (!$modulo["numcampos"]) {
			alerta('Modulo no encontrado.', 'error', 4000);
		}
	} else {
		$modulo[0]["imagen"] = "botones/principal/defaut.png";
		$modulo[0]["tipo"] = "secundario";
		$modulo[0]["destino"] = "_self";
	}
?>
<script type='text/javascript'>
$(document).ready(function() {
	$('#form1').validate({
		submitHandler: function(form) {
				<?php encriptar_sqli("form1");?>
			    form.submit();
		}
	});
	var ver=parseInt(<?php echo $ver; ?>);
	if (ver == 1) {
		$("input").attr("readonly", "true");
		$("select").attr("disabled", "disabled");
		$("#div_submit").html("");
	} else if (ver == 2) {
		$("input").attr("readonly", "true");
		$("select").attr("disabled", "disabled");
		$("#accion").val("guardar_eliminar");
		$("#guardar_modulo").val("Eliminar");
	}
});
</script>
<form action="" method="post" id="form1" name="form1">
	<table width="100%">
		<tr>
			<td class="encabezado" width="20%">NOMBRE*</td>
			<td>
			<input size="60" type="text" class="required" name="nombre" id="nombre" value="<?php echo @$modulo[0]["nombre"]; ?>">
			</td>
		</tr>
		<tr>
			<td class="encabezado" >ETIQUETA*</td>
			<td>
			<input size="60" type="text" class="required" name="etiqueta" id="etiqueta" value="<?php echo @$modulo[0]["etiqueta"]; ?>">
			</td>
		</tr>
		<tr>
			<td class="encabezado" >IMAGEN*</td>
			<td>
			<input size="60" type="text" class="required" name="imagen"  id="imagen" value="<?php echo @$modulo[0]["imagen"]; ?>">
			</td>
		</tr>
		<tr>
			<td class="encabezado" >TIPO*</td>
			<td>
			<input size="60" type="text" class="required" name="tipo"  id="tipo" value="<?php echo @$modulo[0]["tipo"]; ?>">
			</td>
		</tr>
		<tr>
			<td class="encabezado" >ENLACE*</td>
			<td>
			<input size="60" type="text" class="required" name="enlace" id="enlace" value="<?php echo @$modulo[0]["enlace"]; ?>">
			<input type="checkbox" name="enlace_pantalla" id="enlace_pantalla" value="1" title="¿Requiere barra de navegacion?" <?php	if (@$modulo[0]["enlace_pantalla"]) { echo('checked');}	?> >
			</td>
		</tr>
		<tr>
			<td class="encabezado" >DESTINO*</td>
			<td>
			<input size="60" type="text" class="required" name="destino"  id="destino"value="<?php echo @$modulo[0]["destino"]; ?>">
			</td>
		</tr>
		<tr>
			<td class="encabezado" >PADRE</td>
			<td> <?php echo select_modulos(@$modulo[0]["cod_padre"]); ?> </td>
		</tr>
		<tr>
			<td class="encabezado" >ORDEN*</td>
			<td>
			<input size="60" type="text" class="required" name="orden"  id="orden" value="<?php echo @$modulo[0]["orden"]; ?>">
			</td>
		</tr>
		<tr>
			<td class="encabezado" >PARAMETROS</td>
			<td>
			<input size="60" type="text" name="parametros" id="parametros" value="<?php echo @$modulo[0]["parametros"]; ?>">
			</td>
		</tr>
		<tr>
			<td class="encabezado" >BUSQUEDA</td>
			<td>
			<input size="60" type="text" name="busqueda_idbusqueda" id="busqueda_idbusqueda" value="<?php echo @$modulo[0]["busqueda_idbusqueda"]; ?>">
			</td>
		</tr>
		<tr>
			<td class="encabezado" >AYUDA</td>
			<td><textarea cols="55" rows="5" id="ayuda" name="ayuda"><?php echo @$modulo[0]["ayuda"]; ?></textarea>
			<input type="hidden" name="accion" id="accion" value="<?php echo "guardar_" . $_REQUEST["accion"]; ?>">
			<input type="hidden" name="idmodulo" value="<?php echo $_REQUEST["idmodulo"]; ?>">
			</td>
		</tr>
		<?php if($admin){?>
		<tr>
			<td class="encabezado">PERMISO MODULO</td>
			<td>
			<input type="radio" name="permiso_admin" value="0" <?php  if ($modulo[0]["permiso_admin"] == 0)	echo "checked";	?>>
			Permiso General &nbsp;&nbsp;&nbsp;
			<input type="radio" name="permiso_admin" value="1" <?php  if ($modulo[0]["permiso_admin"] == 1)	echo "checked";	?>>
			Permiso Administrador &nbsp;&nbsp;&nbsp;</td>
		</tr>
		
		<tr>
			<td class="encabezado">MOSTRAR EN B&Uacute;SQUEDA</td>
			<td>
			<input type="radio" name="busqueda" value="1" <?php	if ($modulo[0]["busqueda"] == 1)	echo "checked";	?>>
			Si
			<input type="radio" name="busqueda" value="2" <?php	if ($modulo[0]["busqueda"] == 2)	echo "checked"; ?>>
			No</td>
		</tr>
		<?php } ?>
		<tr>
			<td id="div_submit" >
			<input type="submit" class="submit" value="Guardar"  name="guardar_modulo" id="guardar_modulo">
			</td>
		</tr>
	</table>
</form>
<?php
}
?>