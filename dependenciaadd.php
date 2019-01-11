<?php session_start(); ?>
<?php ob_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

$ewCurSec = 0; // Initialise

// Initialize common variables
$x_iddependencia = Null;
$x_codigo = Null;
$x_cod_padre = Null;
$x_nombre = Null;
$x_fecha_ingreso = Null;
$x_tipo = 1;
$x_estado = 1;
$x_extension = Null;
$x_ubicacion_dependencia = Null;
$x_logo = Null;
if (isset($_GET["padre"]) || isset($_GET["nombre"])) {
    $x_cod_padre = @$_GET["padre"];
    $x_nombre = @$_GET["nombre"];
}

include ("db.php");
include ("librerias_saia.php");
include ("phpmkrfn.php");

include_once ("pantallas/lib/librerias_cripto.php");
$validar_enteros = array(
    "x_idcargo"
);
desencriptar_sqli("form_info");
echo (librerias_jquery('1.7'));
include ("formatos/librerias/estilo_formulario.php");
include ("formatos/librerias/header_formato.php");

// Get action
$sAction = @$_POST["a_add"];
if (($sAction == "") || ((is_null($sAction)))) {
    $sKey = @$_GET["key"];
    $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
    if ($sKey != "") {
        $sAction = "C"; // Copy record
    } else {
        $sAction = "I"; // Display blank record
    }
} else {

    // Get fields from form
    $x_iddependencia = @$_POST["x_iddependencia"];
    $x_codigo = @$_POST["x_codigo"];
    $x_cod_padre = @$_POST["x_cod_padre"];
    $x_nombre = @$_POST["x_nombre"];
    $x_fecha_ingreso = @$_POST["x_fecha_ingreso"];
    $x_estado = @$_POST["x_estado"];
    $x_tipo = @$_POST["x_tipo"];
    $x_extension = @$_POST["x_extension"];
    $x_ubicacion_dependencia = @$_POST["x_ubicacion_dependencia"];
    $x_logo = @$_POST["x_logo"];
}

switch ($sAction) {
    case "C": // Get a record to display
        if (!LoadData($sKey, $conn)) { // Load Record based on key
            $_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
            ob_end_clean();
            abrir_url("dependencia.php", "centro");
            exit();
        }
        break;
    case "A": // Add
        if (AddData($conn)) { // Add New Record
            /*$_SESSION["ewmsg"] = "Adici�n exitosa del registro.";
            alerta("Adicion exitosa del registro.");
            abrir_url("dependencia.php", "centro");*/
            echo '<script>
    $id= window.parent.parent.$(".k-focus").attr("id").replace("kp","");
    $panel=window.parent.parent.$("#contenedor_busqueda").kaiten("getPanel",($id-1));
    window.parent.parent.$("#contenedor_busqueda").kaiten("reload", $panel);
    </script>';
            exit();
        }
        break;
}
?>
<?php
include ("header.php");
echo(librerias_jquery('1.7'));
echo( librerias_validar_formulario(11));
 ?>
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>

<script type="text/javascript">

$(document).ready(function() {
	$("#x_nombre").keyup(function(){
		$.ajax({
			url:"pantallas/rol/valida_repetido.php",
			type: 'POST',
			dataType: 'html',
			data: {
				cargo : 0,
				nombre :$(this).val()
			},
			success: function(data){
				if(data==1){
					top.noty({
						text: 'Dependencia repetida!',
						type: 'error',
						layout: "topCenter",
						timeout:4500
					});
					$("#guardar").attr("disabled",true);
				}else{
					$("#guardar").attr("disabled",false);
				}
			}
		});
	});
});
</script>
<p>
	<span class="internos"><img class="imagen_internos"
		src="botones/configuracion/dependencia.png" border="0">&nbsp;&nbsp;ADICIONAR
		DEPENDENCIAS<br>
	<br> </span>
</p>
<form name="dependenciaadd" id="dependenciaadd" action="dependenciaadd.php" method="post"
	 enctype="multipart/form-data">
	<p>
		<input type="hidden" name="a_add" value="A">

	<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
			<td class="encabezado" title="C&oacute;digo de la dependencia asignada por la organizaci&oacute;n.">
			<span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO DEPENDENCIA</span></td>
			<td bgcolor="#F5F5F5">
				<span class="phpmaker">
					<input type="text" name="x_codigo" id="x_codigo" size="30" maxlength="50"
					value="<?php echo htmlspecialchars(@$x_codigo) ?>">
				</span></td>
		</tr>
		<tr>
			<td class="encabezado" title="Seleccione  dependencia de la cual depende esta dependencia">
			<span class="phpmaker" style="color: #FFFFFF;">Dependencia Padre</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
            <?php

            arbol_cargos("x_cod_padre");
            ?>

			</span></td>
		</tr>
		<tr>
			<td class="encabezado" title="Nombre de la nueva dependencia.">
			<span class="phpmaker" style="color: #FFFFFF;">NOMBRE DEPENDENCIA *</span></td>
			<td bgcolor="#F5F5F5">
			<span class="phpmaker">
    			<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255"
    					value="<?php echo htmlspecialchars(@$x_nombre) ?>">
			</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
			<td bgcolor="#F5F5F5">
    			<span class="phpmaker">
        			<input type="radio" name="x_estado" id="x_estado" value="1"
        					<?php if($x_estado==1) echo "checked"; ?>>Activo
        			<input type="radio" name="x_estado" id="x_estado" value="0"
        					<?php if($x_estado==0) echo "checked"; ?>>Inactivo
    			</span>
			</td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO</span></td>
			<td bgcolor="#F5F5F5">
    			<span class="phpmaker">
        			<input type="radio" name="x_tipo" id="x_tipo" value="1"
        					<?php if($x_tipo==1) echo "checked"; ?>>Dependencia
        			<input type="radio" name="x_tipo" id="x_tipo" value="0"
        					<?php if($x_tipo==0) echo "checked"; ?>>Grupo
    			</span>
			</td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">LOGO</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="file" name="x_logo">
			</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">EXTENSI&Oacute;N DE LA DEPENDENCIA</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <input type="text"
					name="x_extension" id="x_extension" size="50" maxlength="255"
					value="<?php echo (@$x_extension) ?>"></span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">UBICACI&Oacute;N DE LA DEPENDENCIA</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> <textarea
						name="x_ubicacion_dependencia" id="x_ubicacion_dependencia"
						cols="50"><?php echo (@$x_ubicacion_dependencia) ?></textarea></span>
			</td>
		</tr>
	</table>
	<p>
		<input type="submit" name="Action" value="Adicionar">

</form>

<script>
$(document).ready(function() {
	$("#dependenciaadd").validate({
		rules : {
			x_nombre : {
				maxlength: 255,
				required: true
			}
		},
		submitHandler : function(form) {
			<?php encriptar_sqli("dependenciaadd");?>
			form.submit();
		}
	});

});

</script>

<?php
include ("footer.php");

/*
 * <Clase>
 * <Nombre>LoadData
 * <Parametros>sKey-id del cargo a buscar;conn-objeto de conexion con la base de datos
 * <Responsabilidades>Verificar si un cargo existe o no en la bd
 * <Notas>
 * <Excepciones>
 * <Salida>
 * <Pre-condiciones>
 * <Post-condiciones>
 */
function LoadData($sKey, $conn) {
    global $x_iddependencia, $x_codigo, $x_cod_padre, $x_nombre, $x_fecha_ingreso, $x_tipo, $x_estado, $x_extension, $x_ubicacion_dependencia;

    $sKeyWrk = "" . addslashes($sKey) . "";
    $sSql = "SELECT * FROM dependencia A";
    $sSql .= " WHERE A.iddependencia = " . $sKeyWrk;
    $sGroupBy = "";
    $sHaving = "";
    $sOrderBy = "";
    if ($sGroupBy != "") {
        $sSql .= " GROUP BY " . $sGroupBy;
    }
    if ($sHaving != "") {
        $sSql .= " HAVING " . $sHaving;
    }
    if ($sOrderBy != "") {
        $sSql .= " ORDER BY " . $sOrderBy;
    }
    $rs = phpmkr_query($sSql, $conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
    if (phpmkr_num_rows($rs) == 0) {
        $LoadData = false;
    } else {
        $LoadData = true;
        $row = phpmkr_fetch_array($rs);

        // Get the field contents
        $x_iddependencia = $row["iddependencia"];
        $x_codigo = $row["codigo"];
        $x_cod_padre = $row["cod_padre"];
        $x_nombre = $row["nombre"];
        $x_fecha_ingreso = $row["fecha_ingreso"];
        $x_estado = $row["estado"];
        $x_tipo = $row["tipo"];
        $x_extension = $row["extension"];
        $x_ubicacion_dependencia = $row["ubicacion_dependencia"];
    }
    phpmkr_free_result($rs);
    return $LoadData;
}
?>
<?php

/*
 * <Clase>
 * <Nombre>AddData
 * <Parametros>$conn-objeto de conexion con la base de datos
 * <Responsabilidades>insertar los datos de un cargo nuevo en la base de datos
 * <Notas>
 * <Excepciones>
 * <Salida>
 * <Pre-condiciones>
 * <Post-condiciones>
 */
function AddData($conn) {
    global $x_logo, $x_iddependencia, $x_codigo, $x_cod_padre, $x_nombre, $x_fecha_ingreso, $x_tipo, $x_estado, $x_extension, $x_ubicacion_dependencia;

    // Add New Record
    $sSql = "SELECT * FROM dependencia A";
    $sSql .= " WHERE 0 = 1";
    $sGroupBy = "";
    $sHaving = "";
    $sOrderBy = "";
    if ($sGroupBy != "") {
        $sSql .= " GROUP BY " . $sGroupBy;
    }
    if ($sHaving != "") {
        $sSql .= " HAVING " . $sHaving;
    }
    if ($sOrderBy != "") {
        $sSql .= " ORDER BY " . $sOrderBy;
    }

    // Field codigo
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_codigo) : $x_codigo;
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["codigo"] = $theValue;

    // Field cod_padre
    $theValue = ($x_cod_padre != "") ? intval($x_cod_padre) : "NULL";
    $fieldList["cod_padre"] = $theValue;

    // Field estado
    $theValue = ($x_estado != "") ? intval($x_estado) : "NULL";
    $fieldList["estado"] = $theValue;

    // Field tipo
    $theValue = ($x_tipo != "") ? intval($x_tipo) : "NULL";
    $fieldList["tipo"] = $theValue;

    // Field nombre
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre;
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["nombre"] = $theValue;

    $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_extension) : $x_extension;
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["extension"] = $theValue;

    $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_ubicacion_dependencia) : $x_ubicacion_dependencia;
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["ubicacion_dependencia"] = $theValue;

    // verifica si existe un codigo repetido en las dependencias.
    $verificar = busca_filtro_tabla("*", "dependencia A", "A.codigo=" . $fieldList["codigo"], "", $conn);
    if ($verificar["numcampos"] > 0) {
        alerta("El codigo del proceso ya se encuentra asignado");
        redirecciona("dependenciaadd.php?padre=" . $fieldList["cod_padre"] . "&nombre=" . $x_nombre);
    }

    // insert into database
    $strsql = "INSERT INTO dependencia (";
    $strsql .= implode(",", array_keys($fieldList));
    $strsql .= ") VALUES (";
    $strsql .= implode(",", array_values($fieldList));
    $strsql .= ")";
    phpmkr_query($strsql, $conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $strsql);
    $id = phpmkr_insert_id();

    // guardo codigo del arbol
    if ($id) {
        $codigo_arbol_papa = busca_filtro_tabla("codigo_arbol", "dependencia A", "A.iddependencia=" . $id, "", $conn);
        if ($codigo_arbol_papa["numcampos"] && $codigo_arbol_papa[0]["codigo_arbol"] != '') {
            $modificar = $codigo_arbol_papa[0]["codigo_arbol"] . "." . $id;
        } else {
            $modificar = $id;
        }
        $sql1 = "UPDATE dependencia SET codigo_arbol='" . $modificar . "' WHERE iddependencia=" . $id;
        phpmkr_query($sql1);
    }

    // guardo el logo

    if ($id) {
        if (is_uploaded_file($_FILES["x_logo"]["tmp_name"])) {
            $fileHandle = fopen($_FILES["x_logo"]["tmp_name"], "rb");
            $fileContent = fread($fileHandle, $_FILES["x_logo"]["size"]);
            $theValue = $fileContent; // addslashes($fileContent);
            fclose($fileHandle);
            $logo = $theValue;
            @unlink($_FILES["x_logo"]["tmp_name"]);
			}

    if(isset($logo))
      guardar_lob("logo","dependencia","iddependencia=".$id,$logo,"archivo",$conn);
   }

	return true;
}


function arbol_cargos($campo) {
    global $conn, $ruta_db_superior, $x_cod_padre;
    ?>
 Buscar:
    <input type="text" id="stext_<?php echo $campo; ?>" width="200px" size="25">
    <a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem((document.getElementById('stext_<?php echo $campo; ?>').value),1)">
	<img src="<?php echo $ruta_db_superior; ?>botones/general/anterior.png" border="0px">
    </a>
    <a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem((document.getElementById('stext_<?php echo $campo; ?>').value),0,1)">
    <img src="<?php echo $ruta_db_superior; ?>botones/general/buscar.png" border="0px">
    </a>
    <a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem((document.getElementById('stext_<?php echo $campo; ?>').value))">
    <img src="<?php echo $ruta_db_superior; ?>botones/general/siguiente.png" border="0px"></a>
    <br />
    <div id="esperando_<?php echo $campo; ?>">
    <img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif">
    </div>
    <div id="treeboxbox_<?php echo $campo; ?>"></div>
    <input type="hidden" maxlength="11" name="<?php echo $campo; ?>" id="<?php echo $campo; ?>" value="<?php echo($x_cod_padre)?>"><br>
    <script type="text/javascript">
    <!--
    var browserType;
    if (document.layers) {browserType = "nn4"}
    if (document.all) {browserType = "ie"}
    if (window.navigator.userAgent.toLowerCase().match("gecko")) {
        browserType= "gecko"
    }
    tree_<?php echo $campo; ?>=new dhtmlXTreeObject("treeboxbox_<?php echo $campo; ?>","100%","100%",0);
    tree_<?php echo $campo; ?>.setImagePath("<?php echo $ruta_db_superior; ?>imgs/");
    tree_<?php echo $campo; ?>.enableIEImageFix(true);
    tree_<?php echo $campo; ?>.enableRadioButtons(true);
    tree_<?php echo $campo; ?>.setOnLoadingStart(cargando_<?php echo $campo; ?>);
    tree_<?php echo $campo; ?>.setOnLoadingEnd(fin_cargando_<?php echo $campo; ?>);
    tree_<?php echo $campo; ?>.enableSmartXMLParsing(true);
    tree_<?php echo $campo; ?>.loadXML("<?php echo $ruta_db_superior; ?>test_serie.php?tabla=dependencia");
    tree_<?php echo $campo; ?>.setOnCheckHandler(onNodeSelect_<?php echo $campo; ?>);
    function onNodeSelect_<?php echo $campo; ?>(nodeId) {
        valor_destino=document.getElementById("<?php echo $campo; ?>");
        if(tree_<?php echo $campo; ?>.isItemChecked(nodeId)) {
            if(valor_destino.value!=="")
                tree_<?php echo $campo; ?>.setCheck(valor_destino.value,false);
                if(nodeId.indexOf("_")!=-1)
                    nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                    valor_destino.value=nodeId;
        } else {
            valor_destino.value="";
        }
    }
    function fin_cargando_<?php echo $campo; ?>() {
        if (browserType == "gecko" )
            document.poppedLayer =
            eval('document.getElementById("esperando_<?php echo $campo; ?>")');
            else if (browserType == "ie")
                document.poppedLayer =
                eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                else
                    document.poppedLayer =
                    eval('document.layers["esperando_<?php echo $campo; ?>"]');
                    document.poppedLayer.style.display = "none";
    }

    function cargando_<?php echo $campo; ?>() {
        if (browserType == "gecko" )
            document.poppedLayer =
            eval('document.getElementById("esperando_<?php echo $campo; ?>")');
            else if (browserType == "ie")
                document.poppedLayer =
                eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                else
                    document.poppedLayer =
                    eval('document.layers["esperando_<?php echo $campo; ?>"]');
                    document.poppedLayer.style.display = "";
    }
    --></script>
    <?php
}
?>
