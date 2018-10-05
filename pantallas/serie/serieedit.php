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

$sAction = @$_POST["a_edit"];
switch ($sAction) {
    case "E":
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
        $x_estado = @$_POST["x_estado"];
        $x_categoria = @$_POST["x_categoria"];
		/*$x_tipo_entidad = $_POST["tipo_entidad"];
		$x_identidad = $_POST["identidad"];*/
		$x_dependencias = $_REQUEST["iddependencia"];

        $ok = EditData($x_idserie);
        if ($ok) {
            notificaciones('Serie editada con exito', 'success', 6000);
            if ($_REQUEST["idnode"]) {
                ?>
<script>
					//window.parent.frames['arbol'].tree2.refreshItem("0");
					window.parent.frames['arbol'].postMessage("refrescar_arbol", "*");
					/*var idnode='<?php echo $_REQUEST["idnode"];?>';
					 idnodepapa=window.parent.frames['arbol'].tree2.getParentId(idnode);
					console.log(idnodepapa);
					window.parent.frames['arbol'].tree2.refreshItem(idnodepapa);*/

				</script>
<?php
            } else {
                ?>
<script>
					window.parent.parent.location.reload()
				</script>
<?php
            }
        } else {
            notificaciones('Serie editada con exito', 'success', 6000);
            abrir_url("serieedit.php?key=" . $x_idserie);
        }
        exit();
        break;
    default:
        $sKey = $_REQUEST["x_idserie"];
        if (!$sKey) {
            notificaciones("No se encontro el identificador de la serie", "error", 5000);
        }
        $info = busca_filtro_tabla("", "serie", "idserie=" . $sKey, "", $conn);
        $x_idserie = $info[0]["idserie"];
        $x_nombre = $info[0]["nombre"];
        $x_cod_padre = $info[0]["cod_padre"];
        $x_dias_entrega = $info[0]["dias_entrega"];
        $x_codigo = $info[0]["codigo"];
        $x_retencion_gestion = $info[0]["retencion_gestion"];
        $x_retencion_central = $info[0]["retencion_central"];
        $x_conservacion = $info[0]["conservacion"];
        $x_seleccion = $info[0]["seleccion"];
        $x_otro = $info[0]["otro"];
        $x_procedimiento = $info[0]["procedimiento"];
        $x_digitalizacion = $info[0]["digitalizacion"];
        $x_copia = $info[0]["copia"];
        $x_tipo = $info[0]["tipo"];
        $x_tvd = $info[0]["tvd"];
        $x_estado = $info[0]["estado"];
        $x_categoria = $info[0]["categoria"];

        $nom_padre = "";
        if ($x_tipo == 2 || $x_tipo == 3 || $x_categoria == 3) {
            $padre = busca_filtro_tabla("nombre,codigo", "serie", "idserie=" . $x_cod_padre, "", $conn);
            if ($padre["numcampos"]) {
                $nom_padre = $padre[0]["nombre"] . " - (" . $padre[0]["codigo"] . ")";
            }
        }

        $tipo_tvd = array(
            0 => "",
            1 => ""
        );

        $categoria = array(
            2 => "",
            3 => ""
        );

        $tipo_tvd[$x_tvd] = "checked";

        //$categoria[$x_categoria] = "checked";
        $categoria=array(2=>"PRODUCCION DOCUMENTAL",3=>"OTRAS CATAGORIAS");

        $tipo_serie = array(
            1 => "",
            2 => "",
            3 => ""
        );
        $tipo_serie[$x_tipo] = "checked";

        $conservacion = array(
            "TOTAL" => "",
            "ELIMINACION" => ""
        );
        $conservacion[$x_conservacion] = "checked";

        $digitalizacion = array(
            0 => "",
            1 => ""
        );
        $digitalizacion[$x_digitalizacion] = "checked";

        $seleccion = array(
            0 => "",
            1 => ""
        );
        $seleccion[$x_seleccion] = "checked";

        $copia = array(
            0 => "",
            1 => ""
        );
        $copia[$x_copia] = "checked";

        $estado = array(
            0 => "",
            1 => ""
        );
        $estado[$x_estado] = "checked";

		//buscar la dependencia asignada
			$buscar_asignacion = busca_filtro_tabla("", "entidad_serie", "entidad_identidad=2 and estado=1 and serie_idserie=" . $x_idserie, "", $conn);
			//print_r($buscar_asignacion["sql"]);
			//print_r("<br><br>");
			$lista_dependencias=array();
			if($buscar_asignacion["numcampos"]){
				for($i=0;$i<$buscar_asignacion["numcampos"];$i++){
					$lista_dependencias[]=$buscar_asignacion[$i]["llave_entidad"];
				}
				$dependencia_seleccionada = implode(",",$lista_dependencias);
			}
			//print_r($dependencia_seleccionada);
			//buscar permisos asociados a la serie
			/*$entidades=array();
			$buscar_permisos = busca_filtro_tabla("", "permiso_serie", "estado=1 and serie_idserie=".$x_idserie, "", $conn);
			if($buscar_permisos["numcampos"]){
				for($i=0;$i<$buscar_permisos["numcampos"];$i++){
					$entidades[$buscar_permisos[$i]["entidad_identidad"]][]=$buscar_permisos[$i]["llave_entidad"];
				}
			}*/
        break;
}

function EditData($sKey) {
	$sKeyWrk = $sKey;
	$datos_ant=busca_filtro_tabla("cod_arbol,cod_padre,tvd","serie","idserie=".$sKeyWrk,"",$conn);
	if(!$datos_ant["numcampos"]){
		$EditData = false;
	}else{

		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_codigo"]) : $GLOBALS["x_codigo"];
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["codigo"] = $theValue;

		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_nombre"]) : $GLOBALS["x_nombre"];
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["nombre"] = $theValue;

		$theValue = ($GLOBALS["x_cod_padre"] != "") ? intval($GLOBALS["x_cod_padre"]) : "NULL";
		$fieldList["cod_padre"] = $theValue;

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
			$fieldList["tvd"] = intval($GLOBALS["x_tvd"]);
			$fieldList["tipo"] = intval($GLOBALS["x_tipo"]);

			$fieldList["dias_entrega"] = intval($GLOBALS["x_dias_entrega"]);
			$fieldList["retencion_gestion"] = intval($GLOBALS["x_retencion_gestion"]);
			$fieldList["retencion_central"] = intval($GLOBALS["x_retencion_central"]);

			$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_conservacion"]) : $GLOBALS["x_conservacion"];
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["conservacion"] = $theValue;

			$fieldList["seleccion"] = intval($GLOBALS["x_seleccion"]);

			$theValue = ($GLOBALS["x_digitalizacion"] != "") ? intval($GLOBALS["x_digitalizacion"]) : "NULL";
			$fieldList["digitalizacion"] = $theValue;

			$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_otro"]) : $GLOBALS["x_otro"];
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["otro"] = $theValue;

			$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_procedimiento"]) : $GLOBALS["x_procedimiento"];
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["procedimiento"] = $theValue;

			$fieldList["copia"] = intval($GLOBALS["x_copia"]);

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
		$fieldList["estado"] = intval($GLOBALS["x_estado"]);

		$sSql = "UPDATE serie SET ";
		foreach ($fieldList as $key => $temp) {
			$sSql .= $key." = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql) - 2);
		}
		$sSql .= " WHERE idserie =" . $sKeyWrk;
		phpmkr_query($sSql) or error("Error al actualizar la serie");

		if (!$fieldList["estado"]){
			$update="UPDATE serie SET estado=0 WHERE cod_arbol like '".$datos_ant[0]["cod_arbol"].".%'";
			phpmkr_query($update) or die("Error al inactivar las series hijas");
		}
		if ($fieldList["tvd"]!=$datos_ant[0]["tvd"]){
			$update="UPDATE serie SET tvd=".$fieldList["tvd"]." WHERE cod_arbol like '".$datos_ant[0]["cod_arbol"].".%'";
			phpmkr_query($update) or die("Error al cambiar el tipo de las series hijas");
		}
		// insert into permiso_serie
		/*
		if(@$fieldList_permiso["identidad"]!="" && @$fieldList_permiso["identidad"] !="NULL"){
			$entidades = explode(",",$fieldList_permiso["identidad"]);
			$buscar_existente = busca_filtro_tabla("","permiso_serie","llave_entidad not in (".$fieldList_permiso["identidad"].") and entidad_identidad = ".$fieldList_permiso["tipo_entidad"]." and serie_idserie=".$sKeyWrk,"",$conn);
			if($buscar_existente["numcampos"]){
				$update = "UPDATE permiso_serie SET estado=0 WHERE llave_entidad not in (".$fieldList_permiso["identidad"].") and entidad_identidad = ".$fieldList_permiso["tipo_entidad"]." and serie_idserie=".$sKeyWrk;
				phpmkr_query($update) or die("Error al actualizar el registro");
			}
			for($i=0;$i<count($entidades);$i++){
				$buscar_permiso = busca_filtro_tabla("","permiso_serie","llave_entidad=".$entidades[$i]." and entidad_identidad = ".$fieldList_permiso["tipo_entidad"]." and serie_idserie=".$sKeyWrk,"",$conn);
				if($buscar_permiso["numcampos"]){
					$update = "UPDATE permiso_serie SET estado=1 WHERE llave_entidad=".$entidades[$i]." and entidad_identidad = ".$fieldList_permiso["tipo_entidad"]." and serie_idserie=".$sKeyWrk;
					phpmkr_query($update) or die("Error al actualizar el registro");
				}
				else{
					$strsql = "INSERT INTO permiso_serie (entidad_identidad,serie_idserie,llave_entidad,estado) VALUES (".$fieldList_permiso["tipo_entidad"].",".$sKeyWrk.",".$entidades[$i].",1)";
					phpmkr_query($strsql) or die("Error al insertar el registro".$fieldList_permiso["identidad"]);
				}
			}
		}*/

		//insert into entidad_serie
		if(@$fieldList_asignacion["dependencias"]!="" && @$fieldList_asignacion["dependencias"] !="NULL"){
			$dependencia = explode(",",$fieldList_asignacion["dependencias"]);
			$buscar_existente = busca_filtro_tabla("","entidad_serie","entidad_identidad not in (".$fieldList_asignacion["dependencias"].") and entidad_identidad = 2 and serie_idserie=".$sKeyWrk,"",$conn);
			if($buscar_existente["numcampos"]){
				$update = "UPDATE entidad_serie SET estado=0 WHERE llave_entidad not in (".$fieldList_asignacion["dependencias"].") and entidad_identidad = 2 and serie_idserie=".$sKeyWrk;
				phpmkr_query($update) or die("Error al actualizar el registro");
			}
			for($i=0;$i<count($dependencia);$i++){
				$buscar_asignacion = busca_filtro_tabla("","entidad_serie","llave_entidad=".$dependencia[$i]." and entidad_identidad = 2 and serie_idserie=".$sKeyWrk,"",$conn);
				if($buscar_asignacion["numcampos"]){
					$update = "UPDATE entidad_serie SET estado=1 WHERE llave_entidad=".$dependencia[$i]." and entidad_identidad = 2 and serie_idserie=".$sKeyWrk;
					phpmkr_query($update) or die("Error al actualizar el registro");
				}
				else{
					$insert = "INSERT INTO entidad_serie (entidad_identidad,serie_idserie,llave_entidad,estado,fecha) VALUES (2," . $sKeyWrk . "," . $dependencia[$i] . ",1," . fecha_db_almacenar(date("Y-m-d"), "Y-m-d") . ")";
		    		phpmkr_query($insert) or die("Error al guardar la informacion");
				}
			}
		}

		actualizar_crear_cod_arboles($sKeyWrk,"serie",2,intval($datos_ant[0]["cod_padre"]),$datos_ant[0]["cod_arbol"]);
		$EditData = true;
	}
	return $EditData;
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
span.fancytree-selected,span.fancytree-title {
	font-style: normal;
}
</style>
<?php
include ($ruta_db_superior."librerias_saia.php");
echo librerias_jquery("3.3");
echo librerias_validar_formulario("11");
echo librerias_UI("1.12");
echo librerias_arboles_ft("2.24", 'filtro');
/*$option = '<option value="">Seleccione</option>
		   <option value="4">Asignado a Cargo(s)</option>
 		   <option value="2">Asignado a Dependencia(s)</option>
 		   <option value="1">Asignado a Funcionario(s)</option>';*/
?>
<form name="serieedit" id="serieedit" action="serieedit.php" method="post">
	<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
			<td class="encabezado" title="Definir el tipo de serie que se esta creando" >CATEGORIA*</td>
			<!--td bgcolor="#F5F5F5">
			<input type="radio" name="x_categoria" id="x_categoria2" value="2" <?php echo $categoria[2];?>>
			Producci&oacute;n Documental
			<input type="radio" name="x_categoria" id="x_categoria3" value="3" <?php echo $categoria[3];?>>
			Otras Categorias
			<br/>
			</td-->
			<input type="hidden" name="x_categoria" id="x_categoria" value="<?php echo $x_categoria;?>">
			<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $categoria[$info[0]["categoria"]];?></span></td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="Definir el tipo de serie que se esta creando" >TIPO*</td>
			<td bgcolor="#F5F5F5">
			<input type="radio" name="x_tvd" id="x_tvd1" value="0" <?php echo $tipo_tvd[0];?>>
			TRD
			<input type="radio" name="x_tvd" id="x_tvd2" value="1" <?php echo $tipo_tvd[1];?>>
			TVD
			<br/>
			</td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="Definir el tipo de serie que se esta creando" >TIPO SERIE*</td>
			<td bgcolor="#F5F5F5">
			<input type="radio" name="x_tipo" id="x_tipo1" value="1" <?php echo $tipo_serie[1];?>>
			Serie
			<br/>
			<input type="radio" name="x_tipo" id="x_tipo2" value="2" <?php echo $tipo_serie[2];?>>
			Subserie
			<br/>
			<input type="radio" name="x_tipo" id="x_tipo3" value="3" <?php echo $tipo_serie[3];?>>
			Tipo documental
			<br/>
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
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <div id="divserie"><?php echo $nom_padre;?><input type="text" name="x_cod_padre" id="x_cod_padre" value="<?php echo $x_cod_padre;?>" /> </div> </td>
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
				<input type="radio" id="x_digitalizacion1" name="x_digitalizacion" value="1" <?php echo $digitalizacion[1];?>>
				SI
				<input type="radio" id="x_digitalizacion0" name="x_digitalizacion" value="0" <?php echo $digitalizacion[0];?>>
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
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <textarea cols="35" rows="4" id="x_procedimiento" name="x_procedimiento"><?php echo $x_procedimiento; ?></textarea> </span></td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="Decidir si se permite copias de los documentos de este tipo serial"><span class="phpmaker" style="color: #FFFFFF;">PERMITIR COPIA *</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="radio" id="x_copia1" name="x_copia" value="1" <?php echo $copia[1];?>>
				SI
				<input type="radio" id="x_copia0" name="x_copia" value="0" <?php echo $copia[0];?>>
				NO </span></td>
		</tr>

		<tr class="ocultar">
			<td class="encabezado" title="Asociar serie/subserie a una dependencia"><span class="phpmaker" style="color: #FFFFFF;">DEPENDENCIA ASOCIADA *</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<?php
				$origen = array("url" => "arboles/arbol_dependencia.php", "ruta_db_superior" => $ruta_db_superior,
				    "params" => array(
				        "checkbox" => true,
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
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO *</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="radio" id="x_estado1" name="x_estado" value="1" <?php echo $estado[1];?>>
				ACTIVO
				<input type="radio" id="x_estado0" name="x_estado" value="0" <?php echo $estado[0];?>>
				INACTIVO </span></td>
		</tr>

		<tr>
			<td colspan="2" style="background-color: #FFFFFF;text-align: center" >
			<input type="hidden" name="x_idserie" id="x_idserie" value="<?php echo $x_idserie;?>">
			<input type="hidden" name="idnode" id="idnode" value="<?php echo $_REQUEST["idnode"];?>">
			<input type="hidden" name="a_edit" value="E">
			<input type="submit" name="Action" value="Editar">
			</td>
		</tr>
	</table>

</form>

<?php
include_once($ruta_db_superior."footer.php");
encriptar_sqli("serieedit", 1, "form_info", $ruta_db_superior, false, false);
?>

<script>
var identidad = <?php echo (empty($identidad) ? 0 : $identidad);?>;
var x_tipo = <?php echo (empty($x_tipo) ? 0 : $x_tipo);?>;
	function cargar_datos_padre(idNode) {
		$.ajax({
			type : "POST",
			dataType : "json",
			url : "buscar_datos_serie.php",
			data : {
				idserie : idNode
			},
			success : function(datos) {
				if(datos.exito){
					$('#x_dias_entrega').val(datos.dias_entrega);
					$('#x_codigo').val(datos.codigo);
					$('#x_retencion_gestion').val(datos.retencion_gestion);
					$('#x_retencion_central').val(datos.retencion_central);
					if(datos.conservacion){
						$('#x_conservacion' + datos.conservacion).attr('checked', true);
					}else{
						$("[name='x_conservacion']").attr('checked', false);
					}

					if(datos.seleccion){
						$('#x_seleccion' + datos.seleccion).attr('checked', true);
					}else{
						$("[name='x_seleccion']").attr('checked', false);
					}

					if(datos.digitalizacion){
						$('#x_digitalizacion' + datos.digitalizacion).attr('checked', true);
					}else{
						$("[name='x_digitalizacion']").attr('checked', false);
					}

					$('#x_otro').val(datos.otro);

					if(datos.procedimiento){
						$('#x_procedimiento').text(datos.procedimiento);
					}else{
						$('#x_procedimiento').text("");
					}

					if(datos.copia){
						$('#x_copia' + datos.copia).attr('checked', true);
					}else{
						$("[name='x_copia']").attr('checked', false);
					}
				}else{
					top.noty({
						text: datos.msn,
						type: 'error',
						layout: 'topCenter',
						timeout:5000
					});
				}
			},
			error: function() {
				top.noty({
					text: 'Error al consultar los datos de la serie padre',
					type: 'error',
					layout: 'topCenter',
					timeout:5000
				});
			}
		});
	}

	$(document).ready(function() {
		//$("#tipo_entidad option[value='2']").prop('selected', true)
		xml1="arboles/arbol_dependencia.php?estado=1&checkbox=true&expandir=1";
		var dependencia_seleccionada="<?php echo $dependencia_seleccionada; ?>";

		if(dependencia_seleccionada && dependencia_seleccionada != '') {
			$("#iddependencia").val(dependencia_seleccionada);
		}

		var entidades = <?php echo json_encode($entidades) ?>;

		if(x_tipo==2 || x_tipo==3){
			tipo_serie = $("[name='x_tipo']:checked").val();
			tvd = $("[name='x_tvd']:checked").val();
			cod_padre=$("#x_cod_padre").val();
			$(".ocultar_padre").show();
			mostrar_papa(tipo_serie,tvd,cod_padre);
		}

		/*if(identidad > 0) {
			$("#tipo_entidad").trigger("change");
		}*/
		$("#serieedit").validate({
			rules:{
				x_nombre:{required:true}
			},
			submitHandler : function(form) {
				var x_identidad ="";
				x_categoria = $("[name='x_categoria']:checked").val();
				if (x_categoria == 2) {
					x_identidad = $("#identidad").val();
					x_tipo = $("[name='x_tipo']:checked").val();
					x_cod_padre = $("#x_cod_padre").val();
					/*if(x_identidad == ""){
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
				if($("[name='x_tipo']:checked").val()==1){
					$(".ocultar").show();
					$(".ocultar_padre").hide();
				}
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
				cod_padre=$("#x_cod_padre").val();
				xml = "arboles/arbol_serie.php?checkbox=radio&ver_categoria2=0&ver_categoria3=1&excluidos="+$("#x_idserie").val();
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


		$("[name='x_tvd'],[name='x_tipo']").change(function (){
			tipo_serie = $("[name='x_tipo']:checked").val();
			tvd = $("[name='x_tvd']:checked").val();
			cod_padre=$("#x_cod_padre").val();
			if(tvd!=undefined && tipo_serie!=undefined){
				if(tipo_serie!=1){
					$(".ocultar_padre").show();
					mostrar_papa(tipo_serie,tvd,cod_padre);

				}else{
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
					url1="arboles/arbol_funcionario.php?idcampofun=funcionario_codigo&sin_padre=1&checkbox=true";
					url1  = url1 + '&seleccionados=' + entidades_seleccionadas;
					check=0;
					break;

					case '2'://Dependencia
						url1="arboles/arbol_dependencia.php?estado=1&checkbox=true";
						url1  = url1 + '&seleccionados=' + entidades_seleccionadas;
						check=0;
					break;

					case '4'://Cargo
						url1="arboles/arbol_cargo.php?estado=1&checkbox=true";
						url1  = url1 + '&seleccionados=' + entidades_seleccionadas;
						check=0;
					break;
				}
				$.ajax({
					url : "<?php echo $ruta_db_superior;?>arboles/crear_arbol.php",

					data:{xml:url1,campo:"identidad",selectMode:check,ruta_db_superior:"../../",seleccionar_todos:1,busqueda_item:1},
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
		$("#tipo_entidad").trigger("change");
		*/
	});

	function mostrar_papa(tipo_serie,tvd,cod_padre){
		xml = "arboles/arbol_serie.php?checkbox=radio&excluidos="+$("#x_idserie").val()+"&tipo3=0&tvd="+tvd;
		if(tipo_serie==2){
			xml+="&tipo2=0";
		}
		if(cod_padre!=undefined && cod_padre!=0){
			xml+="&seleccionados="+cod_padre;
		}
		$.ajax({
			url : "<?php echo $ruta_db_superior;?>arboles/crear_arbol_ft.php",
			data: {
				xml: xml,
				campo: "x_cod_padre",
				busqueda_item:1,
				selectMode:1,
				//onNodeSelect: "cargar_datos_padre",
				ruta_db_superior: "../../"
			},
			type : "POST",
			async:false,
			success : function(html_serie) {
				$("#divserie").empty().html(html_serie);
			},
			error: function() {
				top.noty({
					text: 'No se pudo cargar el arbol de series',
					type: 'error',
					layout: 'topCenter',
					timeout:5000
				});
			}
		});
	}
</script>
