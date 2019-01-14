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
include_once ($ruta_db_superior . "librerias_saia.php");
echo(estilo_bootstrap());

if(@$_REQUEST["iddoc"] || @$_REQUEST["key"]){
	if(!@$_REQUEST["iddoc"])$_REQUEST["iddoc"]=@$_REQUEST["key"];
	include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
	menu_principal_documento($_REQUEST["iddoc"]);
}

$documento_ruta_aprob=busca_filtro_tabla("","documento_ruta_aprob","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
if($documento_ruta_aprob["numcampos"]){
	redirecciona($ruta_db_superior."pantallas/ruta_aprobacion/mostrar_ruta_aprobacion.php?iddoc=".$_REQUEST["iddoc"]."&idruta_aprob=".$documento_ruta_aprob[0]["iddocumento_ruta_aprob"]);
	die();
}
$documento = busca_filtro_tabla("ejecutor,serie,iddocumento,fecha_creacion,descripcion", "documento", "iddocumento=" . $_REQUEST["iddoc"], "", $conn);
if ($documento["numcampos"]) {
	if (is_object($documento[0]["fecha_creacion"])) {
		$fecha_creacion = $documento[0]["fecha_creacion"] -> format("Y-m-d");
	} else {
		$fecha_creacion = $documento[0]["fecha_creacion"];
	}
	$nom_creador = "";
	$creador = busca_filtro_tabla("nombres,apellidos", "funcionario", "funcionario_codigo=" . $documento[0]["ejecutor"], "", $conn);
	if ($creador["numcampos"]) {
		$nom_creador = $creador[0]["nombres"] . " " . $creador[0]["apellidos"];
	}
	$nom_serie = "";
	$serie = busca_filtro_tabla("nombre", "serie", "idserie=" . $documento[0]["serie"], "", $conn);
	if ($serie["numcampos"]) {
		$nom_serie = codifica_encabezado(html_entity_decode($serie[0]["nombre"]));
	}
	$nom_expe = "";
	$expediente = busca_filtro_tabla("C.nombre", "expediente_doc B,expediente C", " B.expediente_idexpediente=C.idexpediente AND B.documento_iddocumento=" . $documento[0]["iddocumento"], "", $conn);
	if ($expediente["numcampos"]) {
		for ($i = 0; $i < $expediente["numcampos"]; $i++) {
			$nom_expe .= ($expediente[$i]["nombre"] . "<br/>");
		}
	}

	$tabla = '';
	$tareas_ruta = busca_filtro_tabla("v.nombres,v.apellidos,v.cargo,t.idtareas,t.accion_tareas,t.orden_tareas", "tareas t,vfuncionario_dc v", "t.responsable=v.iddependencia_cargo and t.ruta_aprob=-1 and t.documento_iddocumento=" . $documento[0]["iddocumento"], "idtareas asc", $conn);
	$resp=0;
	if ($tareas_ruta["numcampos"]) {
		$resp=1;
		$tabla .= '<table align="center" style="width: 90%;" class="table table-bordered" border=1>';
		$tabla .= '<thead>';
		$tabla .= '<tr><th style="text-align:center;">Orden</th> <th style="text-align:center;">Funcionario</th> <th style="text-align:center;">Cargo</th><th>Acciones</th><th>&nbsp;</th></tr>';
		$tabla .= '</thead><tbody>';
		$equivalencia_acciones=array(1=>"APROBAR",2=>"CON VISTO BUENO");
		for ($i = 0; $i < $tareas_ruta["numcampos"]; $i++) {
			$tabla .= '<tr id="tr_'.$tareas_ruta[$i]["idtareas"].'">';
			$tabla .= '<td>' .$tareas_ruta[$i]["orden_tareas"]. '</td> <td>' . ucwords(strtolower($tareas_ruta[$i]["nombres"] . ' ' . $tareas_ruta[$i]["apellidos"])) . '</td> <td>' . $tareas_ruta[$i]["cargo"] . '</td>';
			$tabla .= '<td>'.$equivalencia_acciones[$tareas_ruta[$i]["accion_tareas"]].'</td>';
			$tabla .= '<td style="text-align:center"><div class="btn btn-mini btn-danger" id="'.$tareas_ruta[$i]["idtareas"].'">X</div></td>';
			$tabla .= '</tr>';
		}
		$tabla .= '</tbody></table>';
	}

} else {
	die("Las rutas de aprobacion deben estar asociadas a un documento");
}
?>
<body>
<div class="container">
	<legend>Solicitud de aprobaci&oacute;n</legend>
	<br>
		<table align="center" style="width: 90%;" class="table table-bordered">
			<tr>
				<td><strong>Fecha de Creaci&oacute;n</strong></td>
				<td><?php echo($fecha_creacion); ?></td>
				<td><strong>Creado por</td>
				<td><?php echo($nom_creador); ?></td>
			</tr>
			<tr>
				<td><strong>Tipo documental</strong></td>
				<td><?php echo($nom_serie); ?></td>
				<td><strong>Expedientes</strong></td>
				<td><?php echo($nom_expe); ?></td>
			</tr>
			<tr>
				<td><strong>Estado</strong></td>
				<td colspan="3"><div class="btn btn-mini btn-danger" style="max-width:200px;">Sin ruta de aprobaci&oacute;n</div></td>
			</tr>
			<tr>
				<td><strong>Descripci&oacute;n del documento</strong></td>
				<td colspan="3"><?php echo($documento[0]["descripcion"]); ?></td>
			</tr>			
		</table>
		
    <legend>Acciones</legend>
    <br>
		<form name="formulario" id="formulario" method="POST">
			<table align="center" style="width: 90%;" class="table table-bordered">
				<tr>
					<td colspan="2">
						<strong>Responsables *:</strong>
							<a class="btn btn-mini btn-info highslide" href='<?php echo $ruta_db_superior;?>pantallas/tareas/adicionar_tareas.php?tarea_ruta_aprob=1&iddoc=<?php echo $_REQUEST["iddoc"];?>' onclick='return hs.htmlExpand(this, { objectType: "iframe",width:500, height:300,preserveContent:false } )'>Adicionar</a><br/><br/>
							<input type="hidden" name="responsables" id="responsables" value="<?php echo $resp;?>">
						<?php echo $tabla;?>
					</td>
				</tr>
				
				<tr>
					<td><strong>Aprobaci&oacute;n en: *</strong></td>
					<td>
						<div class="control-group element">
							<label class="control-label" for="aprobacion_en"></label>
							<div class="controls">
								<input type="radio" name="aprobacion_en" id="aprobacion_en1" value="1" class="required" checked="true">Aprobaci&oacute;n en serie
								<input type="radio" name="aprobacion_en" id="aprobacion_en2" value="2">Aprobaci&oacute;n en paralelo
							</div>
						</div>
					</td>
				</tr>
				
				<tr>
					<td><strong>Fecha Vencimiento *</strong></td>
					<td>
						<div class="control-group element">
							<div class="controls"> 
								<div id="fecha_vencimiento" class="input-append date">
									<input data-format="yyyy-MM-dd" type="text" name="fecha_vencimiento" readonly="true" class="required"/>
									<span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
								</div>
							</div>
						</div>
					</td>
				</tr>
				
				<tr>
					<td><strong>Asunto *</strong></td>
					<td>
						<div class="control-group element">				
							<div class="controls"> 
								<input type="text" name="asunto" id="asunto" class="required">
							</div>        
						</div>
					</td>
				</tr>
				
				<tr>
					<td><strong>Descripci&oacute;n</strong></td>
					<td>
						<div class="controls"> 
							<textarea name="descripcion" id="descripcion"></textarea>
						</div>  
					</td>
				</tr>
							
				<tr>
					<td colspan="2" style="text-align: center">
						<input type="hidden" name="ejecutar_funcion" value="insertar_ruta_aprob">
						<input type="hidden" name="iddoc" value="<?php echo $_REQUEST["iddoc"];?>">
						<button class="btn btn-primary btn-mini" id="btn_submit">Aceptar</button>
					</td>
				</tr>
			</table>
		</form>
</div>
</body>
<?php 
echo(librerias_validar_formulario('11'));
echo(librerias_datepicker_bootstrap());
echo(librerias_highslide());
echo(librerias_notificaciones());
?>
<script type='text/javascript'>
  hs.graphicsDir = '<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
  hs.outlineType = 'rounded-white';
	$(document).ready(function() {
		$(".btn-danger").click(function (){
			var idtarea=$(this).attr("id");
			if(confirm("Esta seguro de Eliminar?")===true){
				$.ajax({
					url : "librerias.php",
					data : {idtarea:idtarea,ejecutar_funcion:"eliminar_resp_tarea"},
					dataType : 'json',
					type:  'post',
					async: false,
					success : function(data) {
						if(data.exito){
							$("#tr_"+idtarea).remove();
							notificacion_saia("Responsable Eliminado","success","",2500);	
						}else{
							notificacion_saia(data.msn,"error","",2500);
						}
					},error : function() {
						notificacion_saia("Error al procesar la solicitud","error","",2500);
					}
				});
			}
		});
		
		$('#fecha_vencimiento').datetimepicker({
			language : 'es',
			pick12HourFormat : true,
			pickTime : false
		});
		$('#formulario').validate();
	});
	
  $('#formulario').validate({
    submitHandler : function(form) {
    	var responsable=$("#responsables").val();
    	if(responsable!=1){
    		notificacion_saia("Por favor ingrese los responsables","error","",2500);
    		return false;
    	}else{
    		$("#btn_submit").hide();
    		$("#btn_submit").after('<div class="btn btn-primary btn-mini" id="btn_enviando">Enviando ...</div>');
				var datos=$('#formulario').serialize();
				$.ajax({
					url : "librerias.php",
					data : datos,
					dataType : 'json',
					type:  'post',
					async: false,
					success : function(data) {
						if(data.exito){
							notificacion_saia("Datos Guardados!","success","",2500);
						}else{
							notificacion_saia(data.msn,"error","",2500);
						}
						parent.refrescar_panel_kaiten();	
						return false;
					},error : function() {
						notificacion_saia("Error al procesar la solicitud","error","",2500);
						parent.refrescar_panel_kaiten();	
						return false;
					}
				});
    	}
    	return false; 
    }
  });
</script>