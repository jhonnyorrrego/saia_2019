<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_formatos_generales.php");

function cargar_dato_adicionar_sp($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	if(!$_REQUEST['anterior'] && !$_REQUEST['iddoc']){
		include_once ($ruta_db_superior . "formatos/hoja_vida/funciones.php");
		padre_vacio_adicionar();
	}
	$usuario_actual=busca_filtro_tabla("","vfuncionario_dc","estado=1 and estado_dc=1 and funcionario_codigo=".usuario_actual("funcionario_codigo"),"",$conn);
	$nombre=ucwords(strtolower(codifica_encabezado(html_entity_decode($usuario_actual[0]['nombres']." ".$usuario_actual[0]['apellidos']))));
	$cargo=ucwords(strtolower(codifica_encabezado(html_entity_decode($usuario_actual[0]['cargo']))));
	?>
	<script>
		$(document).ready(function(){
			var nombre='<?php echo $nombre; ?>';
			var cargo='<?php echo $cargo; ?>';
			$("#funcionario").val(nombre);
			$("#cargo").val(cargo);
			$("#funcionario").attr("readonly",true);
			$("#cargo").attr("readonly",true);
			$("#tiempo_requerido").attr("readonly",true);
			if($("#tiempo_compensado1").is(":checked")){					
				$("#tr_acuerdo").hide();
			}else{
				$("#tr_acuerdo").show();
			}
			$("input[name=tiempo_compensado]").change(function(){
				var valor=$(this).val();
				if(valor==1){
					$("#tr_acuerdo").show();
				}else{
          tinyMCE.get('acuerdo').setContent("");
					$("#tr_acuerdo").hide();					
				}
			});
			
			$("#tiempo_requerido").after("<input type='button' id='calculo' name='calculo' value='Calcular'>");
			$("#calculo").click(function(){
				var fecha1=$("#fecha_hora_salida").val();
				var fecha2=$("#fecha_hora_llegada").val();
				var fechaInicio = new Date(fecha1).getTime();
				var fechaFin    = new Date(fecha2).getTime();
				var diff = fechaFin - fechaInicio;
				if(fecha1=='0000-00-00 00:00' || fecha2=='0000-00-00 00:00'){
					alert("Por favor registre las fechas");
				}else{
					$("#tiempo_requerido").val(parseInt(diff/(1000*60))+" Minutos");
					var tiempo_requerido = $("#tiempo_requerido").val();
					$("#formulario_formatos").append("<input type='hidden' name='tiempo_real' id='tiempo_real' value='"+tiempo_requerido+"'>");
				}
				
			});
			
		});
	</script>
	<?php
}


function highslide_solicitud_permisos($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	if($_REQUEST['tipo']!=5){
		$buscar_funcionario = busca_filtro_tabla("","vfuncionario_dc","estado=1 and estado_dc=1 and lower(cargo) like 'aprobador compensacion'","",$conn);
		if($buscar_funcionario["numcampos"] && ($_REQUEST['tipo']!=5)){
 			if($buscar_funcionario[0]["funcionario_codigo"]==usuario_actual("funcionario_codigo") && ($_REQUEST['tipo']!=5)){
				echo "<a onclick=\"return top.hs.htmlExpand(this, { objectType: 'iframe',width: 500, height:400,preserveContent:false } )\" target='_blank' href='../hoja_vida/aceptar_rechazar_compensacion.php?iddoc=".$iddoc."'>Aprobar/rechazar compensación</a>";
			}
		}
	}
}

function mostrar_fecha_permiso($idformato, $iddoc) {
	global $conn, $datos;
	
	echo date("d/m/Y", strtotime($datos[0]['fecha']));
}

function mostrar_hora_salida($idformato, $iddoc) {
	global $conn, $datos;
	echo date("H:i", strtotime($datos[0]['fecha']));
}

function mostrar_hora_llegada($idformato, $iddoc) {
	global $conn, $datos;
	echo $datos[0]['fecha_llegada'];
}

function mostrar_funcionario_permiso($idformato, $iddoc) {
	global $conn, $datos;
	$datos = busca_filtro_tabla(fecha_db_obtener("fecha_hora_salida", "Y-m-d H:i") . " as fecha," . fecha_db_obtener("fecha_hora_llegada", "H:i") . " as fecha_llegada,funcionario", "ft_solicitud_permisos", "documento_iddocumento=" . $iddoc, "", $conn);
	echo(codifica_encabezado(html_entity_decode($datos[0]['funcionario'])));
}

function ruta_solicitud_permiso($idformato, $iddoc) {
	global $conn;
	if($_REQUEST["persona_autoriza"]!=""){
		$ruta = array();
		array_push($ruta, array("funcionario" => $_REQUEST["persona_autoriza"], "tipo_firma" => 1, "tipo" => 5));
		if (count($ruta)) {
			insertar_ruta($ruta, $iddoc, 1);
		}
	}
	return;
}

function trans_sol_recurso_humanos($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$solicitud = busca_filtro_tabla("", "ft_solicitud_permisos,documento", "documento_iddocumento=iddocumento and documento_iddocumento=" . $iddoc, "", $conn);
	$datos = busca_filtro_tabla("", "vfuncionario_dc", "estado=1 and estado_dc=1 and lower(cargo) like 'director% de talento humano%'", "", $conn);
	if ($datos['numcampos']) {
		transferencia_automatica($idformato, $iddoc, $datos[0]['funcionario_codigo'], 3, "Transferencia de Solicitud de Permiso");
	}
	transferencia_automatica($idformato, $iddoc, $solicitud[0]['ejecutor'], 3, "Transferencia de Solicitud de Permiso");
	
}

function mostrar_fecha_solicitud($idformato, $iddoc) {
	global $conn;
	$datos_tabla_permisos = busca_filtro_tabla("fecha_solicitud", "ft_solicitud_permisos", "documento_iddocumento=" . $iddoc, "", $conn);
	$fecha_solicitud = explode("-", $datos_tabla_permisos[0]['fecha_solicitud']);
	echo $fecha_solicitud[2] . '/' . $fecha_solicitud[1] . '/' . $fecha_solicitud[0];
}

function mostrar_compensacion($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$datos_tabla_permisos = busca_filtro_tabla(fecha_db_obtener("fecha_compensacion", "Y-m-d") . " as fecha_compensacion,sp.*", "ft_solicitud_permisos sp", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($datos_tabla_permisos["numcampos"]) {
		$fecha = $datos_tabla_permisos[0]['fecha_compensacion'];
		//$accion = $datos_tabla_permisos[0]['accion_compen'];
		$accion = mostrar_valor_campo("accion_compen", $idformato, $iddoc, 1);

		$obs = $datos_tabla_permisos[0]['obs_compensa'];

		if ($fecha != '' && $accion != '' && $obs != '') {
			//print_r($datos_tabla_permisos);
			$buscar_funcionario = busca_filtro_tabla("", "vfuncionario_dc", "estado=1 and estado_dc=1 and lower(cargo) like 'aprobador compensacion'", "", $conn);
			$nom_funcionario = $buscar_funcionario[0]["nombres"] . " " . $buscar_funcionario[0]["apellidos"];
			$html = '';
			$html = '<table class="table table-bordered" style="border-collapse: collapse; width: 100%;" border="0">
			<tbody>
			<tr>
			<td colspan="2"><center><strong>Aprobaci&oacute;n o rechazo de compensaci&oacute;n</strong></center></td>
			</tr>
			<tr>
			<td><strong>Fecha:</strong></td>
			<td>' . $fecha . '</td>
			</tr>
			<tr>
			<td><strong>Acci&oacute;n:</strong></td>
			<td>' . $accion . '</td>
			</tr>
			<tr>
			<td><strong>Observaciones:</strong></td>
			<td>' . $obs . '</td>
			</tr>
			<tr>
			<td><strong>Funcionario que realizó la acción:</strong></td>
			<td>' . $nom_funcionario . '</td>
			</tr>
			</tbody>
			</table>';
			echo $html;
		}
	}
}

function mostrar_tiempo_compensado($idformato, $iddoc) {
	global $conn;
	$datos = busca_filtro_tabla("", "ft_solicitud_permisos", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($datos["numcampos"]) {
		$tiempo_compensado = $datos[0]["tiempo_compensado"];
		$marcar1 = '&nbsp;';
		$marcar2 = '&nbsp;';
		switch($tiempo_compensado) {
			case '1' :
				$marcar1 = "x";
				break;
			case '2' :
				$marcar2 = "x";
				break;
		}
		$html = "<table width='100%'>
		<tr>
			<td style='width: 10%;'>NO</td>
			<td style='width: 40%;'>
				<div style='width:20px;height:20px;border:1px solid black;'><center>&nbsp;" . $marcar2 . "&nbsp;</center></div>
			</td>
			<td style='width: 10%;'>SI</td>
			<td style='width: 40%;'>
				<div style='width:20px;height:20px;border:1px solid black;'><center>&nbsp;" . $marcar1 . "&nbsp;</center></div>
			</td>
			</tr></table>";
		echo $html;
	}
}
?>