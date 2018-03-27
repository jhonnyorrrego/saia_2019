<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."calendario/calendario.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."class_transferencia.php");

require ($ruta_db_superior.'vendor/autoload.php');
require_once $ruta_db_superior.'filesystem/SaiaStorage.php';
include_once $ruta_db_superior."StorageUtils.php";

echo (estilo_bootstrap());
echo (librerias_jquery("1.7"));
$campo_destino=array("CARTA"=>array("ft_carta","destinos"),"COMUNICACION_EXTERNA"=>array("ft_comunicacion_externa","destinos"),"RADICACION_SALIDA"=>array("ft_radicacion_salida","persona_natural"));

function formulario(){
global $conn,$campo_destino;
	if (isset($_REQUEST["docs"])){
		$ucoma = strrpos($_REQUEST["docs"], ",");
	}else{
		alerta("No selecciono Documentos por favor seleccione alguno y vuelva a intentar");
		abrir_url($ruta_db_superior."pantallas/buscador_principal.php?idbusqueda=13","centro");
	}
	if ($ucoma == (strlen($_REQUEST["docs"]) - 1)){
		$docs = substr($_REQUEST["docs"], 0, -1);
	}
	$nombres = busca_filtro_tabla("iddocumento,numero,descripcion,plantilla", "documento", "iddocumento IN(" . $docs . ")", "", $conn);
	$parte_html="";

	for($i=0;$i<$nombres["numcampos"];$i++){
		$consulta_destinatario=busca_filtro_tabla($campo_destino[$nombres[$i]["plantilla"]][1],$campo_destino[$nombres[$i]["plantilla"]][0],"documento_iddocumento=".$nombres[$i]["iddocumento"],"",$conn);
		if($consulta_destinatario["numcampos"]){
			$info_ejecutor=busca_filtro_tabla("distinct idejecutor,nombre","vejecutor","iddatos_ejecutor in (".$consulta_destinatario[0][0].")","",$conn);
			for($j=0;$j<$info_ejecutor["numcampos"];$j++){
				$id=$nombres[$i]["iddocumento"]."_".$info_ejecutor[$j]["idejecutor"];
				$parte_html.="
				<tr>
					<td>
						<input type='checkbox' class='check' id='destino_".$id."' name='destino_".$id."' value='".$id."' checked='true' >
					</td>
					<td>" . $nombres[$i]["numero"] . "-" . delimita($nombres[$i]["descripcion"], 100) . "	</td>
					<td>
						<input name='responsable_".$id."' id='responsable_".$id."' type='hidden' value='".$info_ejecutor[$j]["idejecutor"]."' >
						<input type='text' value='".$info_ejecutor[$j]["nombre"]."' style='width:150px' name='x_responsable0_".$id."'  iddoc='".$id."' class='auto1' id='auto1_".$id."' >
					</td>
					<td><input type='text' style='width:100px' readonly='true' class='required dateISO' value='".date("Y-m-d")."' name='fecha_despacho_".$id."'>".selector_fecha("fecha_despacho_".$id,"form1","Y-m-d",date("m"),date("Y"),"default.css","","","","","","","","",1)."</td>
					<td>
						<input name='empresa_".$id."' id='empresa_".$id."' type='hidden' >
						<input type='text' style='width:150px' name='x_empresa0_".$id."' iddoc='".$id."' class='auto0' id='auto0_".$id."' >
					</td>
					<td>
						<input type='text' style='width:100px' name='guia_" . $id . "' id='guia_" . $id . "'>
					</td>
					<td>
						<input type='radio' name='estado_despacho_" . $id . "' id='estado_despacho_" . $id . "' value='1' checked='true'>Entregado <br/>
						<input type='radio' name='estado_despacho_" . $id . "' id='estado_despacho_" . $id . "' value='0'>Devolución
					</td>
					<td>
						<textarea name='observaciones_" . $id . "'   id='observaciones_" . $id . "'></textarea>
					</td>
					<td>
						<input type='file' name='anexos_" . $id . "' id='anexos_" . $id .  "'>
					</td>
				</tr>";
			}
		}else{
			$id=$nombres[$i]["iddocumento"]."_0";
				$parte_html.="
				<tr>
					<td>
						<input type='checkbox' class='check' id='destino_".$id."' name='destino_".$id."' values='".$id."' checked='true' >
					</td>
					<td>" . $nombres[$i]["numero"] . "-" . delimita($nombres[$i]["descripcion"], 100) . "	</td>
					<td>
						<input name='responsable_".$id."' id='responsable_".$id."' type='hidden' >
						<input type='text' style='width:150px' name='x_responsable0_".$id."'  iddoc='".$id."' class='auto1' id='auto1_".$id."' >
					</td>
					<td><input type='text' style='width:100px' readonly='true' class='required dateISO' value='".date("Y-m-d")."' name='fecha_despacho_".$id."'>".selector_fecha("fecha_despacho_".$id,"form1","Y-m-d",date("m"),date("Y"),"default.css","","","","","","","","",1)."</td>
					<td>
						<input name='empresa_".$id."' id='empresa_".$id."' type='hidden' >
						<input type='text' style='width:150px' name='x_empresa0_".$id."' iddoc='".$id."' class='auto0' id='auto0_".$id."' >
					</td>
					<td>
						<input type='text' style='width:100px' name='guia_" . $id . "' id='guia_" . $id . "'>
					</td>
					<td>
						<input type='radio' name='estado_despacho_" . $id . "' id='estado_despacho_" . $id . "' value='1' checked='true'>Entregado <br/>
						<input type='radio' name='estado_despacho_" . $id . "' id='estado_despacho_" . $id . "' value='0'>Devolución
					</td>
					<td>
						<textarea name='observaciones_" . $id . "'   id='observaciones_" . $id . "'></textarea>
					</td>
					<td>
						<input type='file' name='anexos_" . $id . "' id='anexos_" . $id .  "'>
					</td>
				</tr>";
		}
	}
	?>
	<style>
		#thead th {
			text-align:center;
		}
	</style>
	<form name='form1' id='form1' method='post' action='despachar.php' enctype='multipart/form-data'>
		<table align='center' class="table">
			<tr id="thead">
			<th>&nbsp</th>
			<th>DOCUMENTO</th>
			<th>DESTINATARIO</th>
			<th>FECHA DESPACHO</th>
			<th>EMPRESA MENSAJERIA</th>
			<th>N&Uacute;MERO DE GUIA</th>
			<th>ESTADO</th>
			<th>OBSERVACIONES</th>
			<th>ANEXOS</th>
			</tr>
			<?php echo $parte_html;	?>
			<tr>
				<td colspan='9' align='center'>
					<input type='hidden' name='transferir' value='1'>
					<input type='hidden' id="lista_despachos" name='lista_despachos' value=''>
					<input type='button' class="btn btn-mini" id="despachar_documentos" value='Despachar'>
					<input type='button' class="btn btn-mini"  onclick='window.open("<?php echo $ruta_db_superior;?>pantallas/buscador_principal.php?idbusqueda=13","centro")' value='Cancelar'>
				</td>
			</tr>
		</table>
	</form>
<?php
}

function transferir(){
global $conn,$campo_destino;

	$destinos = explode(",", $_REQUEST["lista_despachos"]);
	foreach ($destinos as $key) {
		$responsable=$_REQUEST["x_responsable0_".$key];
		$lresponsable = busca_filtro_tabla("A.*", "ejecutor A", "A.idejecutor = '" . $_REQUEST["responsable_".$key] . "'", "", $conn);


		if ($lresponsable["numcampos"]) {
			$idresponsable = $lresponsable[0]["idejecutor"];
		} else if ($responsable <> "") {
			$responsable = (htmlspecialchars_decode(html_entity_decode((trim($_REQUEST["x_responsable0_".$key])))));
			$sql = "INSERT INTO ejecutor(nombre) VALUES('" . $responsable . "')";
			phpmkr_query($sql, $conn);
			$idresponsable = phpmkr_insert_id();
		}
		$idempresa="NULL";	$empresa=$_REQUEST["x_empresa0_".$key];
		$lempresa = busca_filtro_tabla("A.*", "ejecutor A", "A.idejecutor = '" . $_REQUEST["empresa_".$key] . "'", "", $conn);
		if ($lempresa["numcampos"]) {
			$idempresa = $lempresa[0]["idejecutor"];
		} else if ($empresa <> "") {
			$sql = "INSERT INTO ejecutor(nombre) VALUES('" . $_REQUEST["x_empresa0_".$key] . "')";
			phpmkr_query($sql);
			$idempresa = phpmkr_insert_id();
		}

		if ($idresponsable <> "") {
			$iddoc_ideje=explode("_", $key);
			$documento_mns = busca_filtro_tabla("descripcion,plantilla,ejecutor,numero", "documento", "iddocumento=" . $iddoc_ideje[0], "", $conn);
			$datos["origen"] = usuario_actual("funcionario_codigo");
			$enviado = usuario_actual("login");
			$guia = $_REQUEST["guia_".$key];
			$observaciones=$_REQUEST["observaciones_".$key];
			$estado_despacho=$_REQUEST["estado_despacho_".$key];
			//$estado_despacho=1;

			$valores = "'" . $guia . "','" . $iddoc_ideje[0] . "',".$idempresa.",'".$idresponsable."'," . fecha_db_almacenar($_REQUEST["fecha_despacho"."_".$key], "Y-m-d H:i:s").",'1','" . $observaciones . "', '" . $estado_despacho . "'";

			$sql_salida = "INSERT INTO salidas(numero_guia,documento_iddocumento,empresa,responsable,fecha_despacho,tipo_despacho,notas,estado) VALUES (" . $valores . ")";
			phpmkr_query($sql_salida);
			$idsalidas = phpmkr_insert_id();

			$idanexos_despacho = cargar_anexos_despacho($iddoc_ideje[0], $idsalidas,$_REQUEST["responsable_".$key]);
			$sql = "update documento set estado='GESTION',tipo_despacho='1' where iddocumento=" . $iddoc_ideje[0];
			phpmkr_query($sql, $conn);

			$datos["archivo_idarchivo"] = $iddoc_ideje[0];
			$datos["tipo_destino"] = 1;
			$datos["tipo"] = "";
			$datos["nombre"] = "DISTRIBUCION";
			$otros["notas"] = "'Documento despachado en $empresa ($responsable) con Guia: $guia Por $enviado'";
			transferir_archivo_prueba($datos, array($documento_mns[0]["ejecutor"]), $otros);

			$notificacion = false;
			$envio = busca_filtro_tabla("valor", "configuracion", "nombre='correo_despacho'", "", $conn);
			if ($envio["numcampos"] > 0 && $envio[0]["valor"] == 1){
				$notificacion = true;
			}
			if ($notificacion) {
				$mensaje = "Tiene un nuevo documento para su revision: Tipo: " . ucfirst($documento_mns[0]["plantilla"]) . " - Descripcion: " . $documento_mns[0]["descripcion"];
				enviar_mensaje("",$tipo_usuario='codigo',array($documento_mns[0]["ejecutor"]),"Despacho ".ucfirst($documento_mns[0]["plantilla"])." No ".$documento_mns[0]["numero"],$mensaje,"e-interno");
			}
		} else {
			alerta("No se puede realizar el despacho para ".$responsable);
		}
	}
	abrir_url($ruta_db_superior."pantallas/buscador_principal.php?idbusqueda=13","centro");
}

function cargar_anexos_despacho($iddoc, $idsalida, $responsable) {
global $conn, $ruta_db_superior;
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");

	if ($_FILES["anexos_" . $iddoc."_".$responsable]) {
		$formato_ruta = aplicar_plantilla_ruta_documento($iddoc);
		$alm_archivos = new SaiaStorage("archivos");
		
		$datos_documento = busca_filtro_tabla(fecha_db_obtener('A.fecha', 'Y-m-d') . " as fecha, A.*", "documento A", "A.iddocumento=" . $iddoc, "", $conn);
		
		$datos_anexo = explode(".", $_FILES["anexos_" . $iddoc]["name"]);
		$cant = count($datos_anexo);
		$nombre = $_FILES["anexos_" . $iddoc."_".$responsable]["name"];

		$extension = end(explode(".", $_FILES["anexos_" . $iddoc."_".$responsable]["name"]));
		//$archivo_destino = RUTA_ARCHIVOS . $datos_documento[0]["estado"] . "/" . $datos_documento[0]["fecha"] . "/" . $datos_documento[0]["iddocumento"] . "/anexos_despacho/";
		$archivo_destino = $formato_ruta . "/anexos_despacho/";
		
		/*if (!is_dir($archivo_destino)) {
			crear_destino($archivo_destino);
		}*/
		$nuevo_nombre = rand(0, 999999999);
		$nuevo_destino = $archivo_destino . $nuevo_nombre . "." . $extension;
		$alm_archivos->copiar_contenido_externo($_FILES["anexos_" . $iddoc."_".$responsable]["tmp_name"], $nuevo_destino);
		if ($alm_archivos->get_filesystem()->has($nuevo_destino)) {
				$sql1 = "INSERT INTO anexos_despacho(documento_iddocumento, ruta, tipo, etiqueta, fk_idsalidas) VALUES ('" . $iddoc . "', '" . $nuevo_destino . "', '".$extension."', '" . $nombre . "', '" . $idsalida . "')";
				phpmkr_query($sql1);
				$idanexos_despacho = phpmkr_insert_id();
			$ruta_arch = array("servidor" => $alm_archivos->get_ruta_servidor(), "ruta" => $nuevo_destino);
				$idfuncionario = usuario_actual("idfuncionario");
				$idformato=busca_filtro_tabla("", "formato", "lower(nombre) like '".strtolower($datos_documento[0]['plantilla'])."'", "", $conn);
			$insert_anexo = "insert into anexos(documento_iddocumento, ruta, etiqueta, tipo, formato,fecha_anexo) VALUES (".$iddoc.",'". json_encode($ruta_arch) . "','".$nombre."','".$extension."',".$idformato[0]["idformato"].",".fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s').")";
				phpmkr_query($insert_anexo);
				$idnexo = phpmkr_insert_id();

				$insert_permiso = "insert into permiso_anexo (anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_dependencia, caracteristica_cargo, caracteristica_total) VALUES (".$idnexo.",".$idfuncionario.",'lem', '', '', 'l')";
				phpmkr_query($insert_permiso);
				$idnexo_permiso = phpmkr_insert_id();

				$datos["origen"] = usuario_actual("funcionario_codigo");
				$datos["archivo_idarchivo"] = $iddoc;
				$datos["tipo_destino"] = 1;
				$datos["tipo"] = "";
				$datos["nombre"] = "DISTRIBUCION";
				$otros["notas"] = "'Anexos despacho por guia'";
				transferir_archivo_prueba($datos, array($datos_documento[0]["ejecutor"]), $otros);
			}

	}
}

if (isset($_REQUEST["transferir"]) && $_REQUEST["transferir"] == 1) {
	transferir();
} else {
	formulario();
}
?>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<script language="javascript" type="text/javascript">
$().ready(function() {
		$(".auto0, .auto1").on( "keydown", function( event ) {
			if(event.which==8){
				var iddoc=$(this).attr("iddoc");
				var campo=$(this).attr("class");
				if(campo.indexOf("auto0")>=0){
					$("#empresa_"+iddoc).val("");
				}else{
					$("#responsable_"+iddoc).val("");
				}
			}
		});

		function formatItem(row) {
			return row[1] + " (<strong>Documento: " + row[2] + "</strong>)";
		}
		function formatResult(row) {
			return row[1].replace(/(<.+?>)/gi, '');
		}
		$(".auto0").autocomplete('formatos/librerias/seleccionar_ejecutor.php?tipo=nombre', {
			width : 500,
			max : 10,
			scroll : true,
			scrollHeight : 150,
			matchContains : true,
			minChars : 4,
			formatItem : formatItem,
			formatResult : function(row) {
				return row[4];
			}
		});
		$(".auto0").result(function(event, data, formatted) {
			var iddoc=$(this).attr("iddoc");
			if (data) {
				$("#empresa_"+iddoc).val(data[0]);
			}
		});

		$(".auto1").autocomplete('formatos/librerias/seleccionar_ejecutor.php?tipo=nombre', {
			width : 500,
			max : 10,
			scroll : true,
			scrollHeight : 150,
			matchContains : true,
			minChars : 4,
			formatItem : formatItem,
			formatResult : function(row) {
				return row[4];
			}
		});
		$(".auto1").result(function(event, data, formatted) {
			var iddoc=$(this).attr("iddoc");
			if (data) {
				$("#responsable_"+iddoc).val(data[0]);
			}
		});


	$("#despachar_documentos").click(function(event){
	  event.preventDefault();
	  var exito=1; var cant=0;  var seleccionados=new Array();
	  $(".check").each(function (){
	  	var checkbox=$(this); 	var iddoc=checkbox.val();
	  	if(checkbox.is(':checked')===true){
	  		seleccionados[cant]=iddoc;
	  		cant++;
	  		var destinatario=$("#auto1_"+iddoc).val();
	  		if(destinatario=="" || destinatario==undefined){
	  			alert("El destinatario es obligatorio");
	  			exito=0;
	  			return false;
	  		}
	  	}
	  });

  	if(exito){
  		$("#lista_despachos").val(seleccionados.join(","));
  		$("#form1").submit();
  	}else if(cant==0){
  		alert("Seleccione por lo menos un destino o haga click en cancelar.");
  		return false;
  	}else{
  		return false;
  	}
	});

});
</script>
