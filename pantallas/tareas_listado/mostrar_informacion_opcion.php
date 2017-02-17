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
include_once ($ruta_db_superior . "pantallas/tareas_listado/librerias.php");
include_once ($ruta_db_superior . "pantallas/tareas_listado/ejecutar_acciones.php");
global $conn, $ruta_db_superior;

$info_retorno = array(); 
$info_retorno["exito"]=1; 
$info_retorno["mensaje"]="";

$datos = busca_filtro_tabla("", "tareas_listado", "idtareas_listado=" . $_REQUEST['idtareas_listado'], "", $conn);
$opcion = @$_REQUEST['opcion'];
switch ($opcion) {
	case '1' :
		$retorno = '
			<div class="layout-slider">
	        <input id="Slider3" type="slider" name="price" value="80" />
	    </div>
	    <script type="text/javascript" charset="utf-8">
	        $("#Slider3").slider({ from: 1, to: 100, step: 1, round: 1, dimension: "&nbsp;%", skin: "round", });
	    </script>';
		break;

	case '2' :
		$retorno = '
		<body>
			<div class="container">
				<div class="control-group" nombre="etiqueta">
					<legend>Listado de Tareas</legend>
				</div>
				<form id="formulario_tareas" name="formulario_tareas" class="form-horizontal" method="post">
					<div class="control-group">
						<label class="control-label" for="etiqueta">Nombre de la lista*:</label>
						<div class="controls">
							<input type="text" class="required" name="nombre_lista" id="nombre_lista" placeholder="Nombre de la Lista">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="etiqueta">Descripci&oacute;n:</label>
						<div class="controls">
							<textarea id="descripcion" name="descripcion" placeholder="Descripcion"></textarea>
						</div>
					</div>
					<div class="control-group">
		  				<label class="control-label"  for="accion">Acción</label>
		  						<select name="accion" class="form-control" id="accion"">
		  							<option value="">Por favor seleccione...</option>
		  							<option value="1">Avance</option>
		  							<option value="2">Stand by</option>
		  							<option value="3">Cancelar</option>
		  						</select>
			 			   </div>
						</br>
						</br>
					<div class="control-group">
						<div class="controls">
							<input type="hidden" name="iddoc" value="' . ($_REQUEST["iddoc"]) . '">
							<input type="hidden" name="guardar" value="1">
							<input type="hidden" name="idbusqueda_componente" value="' . ($_REQUEST["idbusqueda_componente"]) . '">
							<input type="hidden" name="div_actualiza" value="' . ($_REQUEST["div_actualiza"]) . '">
						</div>
					</div>
				</form>
			</div>
			<script type="text/javascript" src="' . ($ruta_db_superior) . 'js/jquery.validate.1.13.1.js"></script>
		</body>';
		break;

	case '3' :
		include_once ($ruta_db_superior . "pantallas/lib/librerias_fechas.php");
		$fecha_cargar=date("Y-m-d");
		$retorno .= '<table style="border:0px; width:100%" border=1>
			<tr>
				<td style="border:0px;"> Fecha*
				<br>
				<div id="datetimepicker_fecha_ini_' . $datos[0]['idtareas_listado'] . '" idtarea="' . $datos[0]['idtareas_listado'] . '" class="input-append date_fecha_planeada">
					<input data-format="yyyy-MM-dd" idtarea="' . $datos[0]['idtareas_listado'] . '" id="fecha_inicio_' . $datos[0]['idtareas_listado'] . '"  name="fecha_inicio_' . $datos[0]['idtareas_listado'] . '" type="text" value="' . $fecha_cargar . '" class="required"  style="width: 100px;">
					</input>
					<span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i> </span>
				</div>
				<script>
				    $("#datetimepicker_fecha_ini_' . $datos[0]['idtareas_listado'] . '").on("changeDate", function(e) {
				        var fecha_select=e.date.toISOString().split("T");
				        if(fecha_select>"'.date('Y-m-d').'"){
				             notificacion_saia("<span style=\"color:white;\">La fecha del avance NO puede ser superior a la fecha de hoy!</span>","error","",2500);
				            setTimeout(function(){
				              $("#fecha_inicio_' . $datos[0]['idtareas_listado'] . '").val("'.date('Y-m-d').'");
				            }, 500);  
				        }
                    });
                </script>
				</td>
				<td style="border:0px;"> Hora Inicio*
				<br>
				<div id="datetimepicker_hora_ini_' . $datos[0]['idtareas_listado'] . '" idtarea="' . $datos[0]['idtareas_listado'] . '" class="input-append">
					<input data-format="hh:mm" idtarea="' . $datos[0]['idtareas_listado'] . '" id="hora_inicio_' . $datos[0]['idtareas_listado'] . '" name="hora_inicio_' . $datos[0]['idtareas_listado'] . '" type="text" value="' . date("H:i") . '"  style="width: 50px;">
					</input>
					<span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i> </span>
				</div></td>
		
				<td style="border:0px;"> Hora Final*
				<br>
				<div id="datetimepicker_hora_fin_' . $datos[0]['idtareas_listado'] . '" idtarea="' . $datos[0]['idtareas_listado'] . '" class="input-append">
					<input data-format="hh:mm" idtarea="' . $datos[0]['idtareas_listado'] . '" id="hora_final_' . $datos[0]['idtareas_listado'] . '" name="hora_final_' . $datos[0]['idtareas_listado'] . '" type="text" style="width: 50px;">
					</input>
					<span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i> </span>
				</div></td>
			</tr>
		</table>
		<br>
		<div class="row-fluid">
			Estado Tarea*:
			<select id="estado_tarea_' . $datos[0]['idtareas_listado'] . '" style="width: 100px;">
				<option value="EJECUCION">EJECUCION</option>
				<option value="STAND BY">STAND BY</option>
				<option value="CANCELADA">CANCELADA</option>
			</select>
			<div class="pull-right" style="text-align:center;">
				<input type="text" id="minutos_tiempo_' . $datos[0]['idtareas_listado'] . '" idtarea="' . $datos[0]['idtareas_listado'] . '" name="minutos_tiempo_' . $datos[0]['idtareas_listado'] . '" maxlength="2" class="input-mini">
				<br>
				Minutos
			</div>
			<div class="pull-right"  style="width: 30px;">
				&nbsp;
			</div>
			<div class="pull-right" style="text-align:center;">
				<input type="text" id="horas_tiempo_' . $datos[0]['idtareas_listado'] . '" idtarea="' . $datos[0]['idtareas_listado'] . '" name="horas_tiempo_' . $datos[0]['idtareas_listado'] . '" maxlength="2" class="input-mini">
				<br>
				Horas
			</div>
			<div class="pull-right"  style="width: 30px;">
				&nbsp;
			</div>';
		if ($datos[0]['estado_tarea'] != "TERMINADO") {
			$retorno .= '<div class="pull-right">
					<div id="get_tiempo_crono_' . $datos[0]['idtareas_listado'] . '" class="btn btn-mini btn-primary get_tiempo_crono" idtarea="' . $datos[0]['idtareas_listado'] . '">
						Temporizador
					</div>
				</div>';
		}
		$retorno .= '</div>
		<br>
		<div class="row-fluid">
			<textarea class="input-large" id="comentario_avance_tarea_' . $datos[0]['idtareas_listado'] . '" name="comentario_avance_tarea_' . $datos[0]['idtareas_listado'] . '"></textarea>
		</div>
		<div class="row-fluid">
			<div class="btn btn-mini btn-primary guardar_avance_tarea" id="guardar_avance_tarea_'.$datos[0]['idtareas_listado'].'" idtarea="' . $datos[0]['idtareas_listado'] . '">
				Aceptar
			</div>
		</div><br/>';
		
		
		$mostrar_enlaces_acciones=1;
		if($datos[0]['estado_tarea']=='TERMINADO'){
			$retorno='';
			$mostrar_enlaces_acciones=0;
		}		
			
		
		$info_retorno["time_transcurrido"]=0;
		$avances = busca_filtro_tabla(fecha_db_obtener("t.fecha_inicio", "Y-m-d") . " as fecha," . concatenar_cadena_sql(array("f.nombres", "' '", "f.apellidos")) . " as nombre,estado_avance,comentario,tiempo_registrado,idtareas_listado_tiempo,t.funcionario_idfuncionario", "tareas_listado_tiempo t,funcionario f", "t.funcionario_idfuncionario=f.idfuncionario and t.fk_tareas_listado=" . $datos[0]['idtareas_listado'], "idtareas_listado_tiempo", $conn);
		if ($avances["numcampos"]) {
			$retorno .= '<table class="table table-bordered">';
			$retorno .= '<tr><th>Fecha</th> <th>Funcionario</th> <th>Tiempo</th> <th>Estado</th> <th>Comentarios</th><th>Acciones</th></tr>';
			for ($i = 0; $i < $avances["numcampos"]; $i++) {
					$simbolo=''; $cantidad='';
				$enlaces_acciones='';		
				if(usuario_actual('idfuncionario')==$avances[$i]["funcionario_idfuncionario"] && $mostrar_enlaces_acciones){
					$fecha_avance=$avances[$i]['fecha'];
					$hoy=date('Y-m-d');
					$date1=date_create($fecha_avance);
					$date2=date_create($hoy);
					$diff=date_diff($date1,$date2);
					$diferencia=$diff->format("%R%a");
					
					$simbolo=$diferencia[0];
					$cantidad=substr($diferencia,1,strlen($diferencia)-1);
					if($simbolo=='+' && $cantidad<=3){  //si es menor o igual a 3 dias de avance si se puede eliminar
						$enlaces_acciones='
							<a class="editar_avance_tarea" title="Editar Avance" accion="cargar_info" idtareas_listado="'.$datos[0]['idtareas_listado'].'" idtareas_listado_tiempo="'.$avances[$i]["idtareas_listado_tiempo"].'"><i class="icon-pencil"></i></a>
							&nbsp;
							<a class="eliminar_avance_tarea" title="Eliminar Avance" idtareas_listado="'.$datos[0]['idtareas_listado'].'" idtareas_listado_tiempo="'.$avances[$i]["idtareas_listado_tiempo"].'"><i class="icon-trash"></i></a>					
						';
					}	
				}	
				
				$retorno .= '<tr id="fila_avance_tarea_'.$avances[$i]["idtareas_listado_tiempo"].'"> 
								<td>' . $avances[$i]["fecha"]  . '</td> 
								<td>' . $avances[$i]["nombre"] . '</td> 
								<td>' . conversor_segundos_hm($avances[$i]["tiempo_registrado"]) . '</td> 
								<td>' . $avances[$i]["estado_avance"] . '</td> <td>' . $avances[$i]["comentario"] . '</td> 
								<td>' . $enlaces_acciones.'</td>
							</tr>';
			}
			$retorno .= "</table>";
			
		  $sql_tiempo="SELECT SUM(tiempo_registrado) AS total_tiempo FROM tareas_listado_tiempo WHERE fk_tareas_listado=". $datos[0]['idtareas_listado'];
		  $dato_tiempo=ejecuta_filtro_tabla($sql_tiempo,$conn);
			$info_retorno["time_transcurrido"]=conversor_segundos_hm(intval($dato_tiempo[0]["total_tiempo"]));
		}
		break;

	case '4' :
		if ($datos['numcampos']) {
			
			$nombre_listado='';
			$macroproceso_proceso='';
			if($datos[0]["listado_tareas_fk"]!=-1){
				$lista_editar=$datos[0]["listado_tareas_fk"];		
				$listado_tareas=busca_filtro_tabla("idlistado_tareas,nombre_lista,macro_proceso","listado_tareas","idlistado_tareas=".$lista_editar,"",$conn);	
				$nombre_listado='
					<tr>
						<td width="35%" class="prettyprint"><b>Listado:</b></td>
						<td>' . ($listado_tareas[0]["nombre_lista"]) . '</td>
					</tr>				
				';
				if(!is_null($listado_tareas[0]['macro_proceso']) && $listado_tareas[0]['macro_proceso']!=''){
					$datos_macro_proceso=busca_filtro_tabla("s.idserie as idserie_proceso,sp.idserie as idserie_macro,s.nombre,sp.nombre as nombre_padre","serie s, serie sp","s.cod_padre=sp.idserie AND s.idserie=".$listado_tareas[0]['macro_proceso']."  and sp.estado=1 and s.estado=1","sp.nombre",$conn);			
					$macroproceso_proceso='
						<tr>
							<td width="35%" class="prettyprint"><b>Macroproceso/Proceso:</b></td>
							<td>' . ($datos_macro_proceso[0]['nombre_padre'].'/'.$datos_macro_proceso[0]['nombre']) . '</td>
						</tr>		
					';					
				}
			}

			$retorno = '
			<table class="table table-bordered">
			<tbody>
			'.$macroproceso_proceso.'
			'.$nombre_listado.'
			<tr>
			<td width="35%" class="prettyprint"><b>Nombre de la tarea:</b></td>
			<td>' . ($datos[0]["nombre_tarea"]) . '</td>
			</tr>
			<tr>
			<td class="prettyprint">
			<b>Estado de la tarea:</b>
			</td>
			<td colspan="3">' . ($datos[0]["estado_tarea"]) . '</td>
			</tr>
			<tr>
			<td class="prettyprint">
			<b>Progreso:</b>
			</td>
			<td colspan="3">' . ($datos[0]["progreso"]) . '%</td>
			</tr>			
			<tr>
			<td class="prettyprint">
			<b>Fecha de creación:</b>
			</td>
			<td colspan="3">' . $datos[0]["fecha_creacion"] . '</td>
			</tr>
			<tr><td class="prettyprint"><b>Fecha inicio:</b></td>
			<td colspan="3">' . $datos[0]["fecha_inicio"] . '</td>
			</tr>
			<tr><td class="prettyprint"><b>Fecha de Vencimiento:</b></td>
			<td colspan="3">' . ($datos[0]["fecha_limite"]) . '</td>
			</tr>
			<tr><td class="prettyprint"><b>Creador Tarea:</b></td>
			<td colspan="3">' . mostrar_funcionarios($datos[0]["creador_tarea"]) . '</td>
			</tr>
			<tr><td class="prettyprint"><b>Tipo de Tarea:</b></td>
			<td colspan="3">' . mostrar_tipo_tarea($datos[0]["tipo_tarea"]) . '</td>
			</tr>
			</tr>
			<tr><td class="prettyprint"><b>Responsables de la Tarea:</b></td>
			<td colspan="3">' . mostrar_funcionarios($datos[0]["responsable_tarea"]) . '</td>
			</tr>
			</tr>
			<tr><td class="prettyprint"><b>Co-Participantes:</b></td>
			<td colspan="3">' . mostrar_funcionarios($datos[0]["co_participantes"]) . '</td>
			</tr>
			<tr><td class="prettyprint"><b>Seguidores:</b></td>
			<td colspan="3">' . mostrar_funcionarios($datos[0]["seguidores"]) . '</td>
			</tr>
			<tr><td class="prettyprint"><b>Evaluador:</b></td>
			<td colspan="3">' . mostrar_funcionarios($datos[0]["evaluador"]) . '</td>
			</tr>			
			<tr><td class="prettyprint"><b>Descripción de la tarea:</b></td>
			<td colspan="3">' . ($datos[0]["descripcion_tarea"]) . '</td>
			</tr>
			<tr><td class="prettyprint"><b>Prioridad:</b></td>
			<td colspan="3">' . mostrar_prioridad_tarea(0, $datos[0]["prioridad"], 0, 1) . '</td>
			</tr>
			</tbody>
			</table>
			';

			$info_avance = busca_filtro_tabla("t.descripcion," . fecha_db_obtener("fecha_creacion", "Y-m-d H:i:s") . " as fecha,f.nombres,f.apellidos", "tareas_listado_notas t,funcionario f", "t.funcionario_idfuncionario=f.idfuncionario and fk_tareas_listado=" .$datos[0]["idtareas_listado"], "idtareas_listado_notas desc", $conn);
			$parte = "";
			if ($info_avance["numcampos"]) {
				$parte = "<table style='width:100%' class='table table-bordered'>";
				$parte .= "<thead><tr> <th class='prettyprint' colspan='3' style='text-align:center;'>NOTAS</th></tr>";
				$parte .= "<thead><tr> <th class='prettyprint' style='width:15%'>Fecha</th> <th class='prettyprint' style='width:15%'>Funcionario</th> <th class='prettyprint' style='width:70%'>Avance</th> </tr></thead>";
				$parte .= "<tbody>";
				for ($i = 0; $i < $info_avance["numcampos"]; $i++) {
					$parte .= "<tr> <td>" . $info_avance[$i]["fecha"] . "</td> <td>" . $info_avance[$i]["nombres"] . " " . $info_avance[$i]["apellidos"] . "</td> <td>" . $info_avance[$i]["descripcion"] . "</td> </tr>";
				}
				$parte .= "</tbody>";
				$parte .= "</table>";
			}
			$retorno.=$parte;
			
			
			$datos_anexos = busca_filtro_tabla("", "tareas_listado_anexos", "fk_tareas_listado=" . $datos[0]["idtareas_listado"], "", $conn);
			
			$retorno_anexos = '';
			if ($datos_anexos['numcampos']) {
				$retorno_anexos.= '
					<table class="table table-bordered">
					<tr>
						<th class="prettyprint" colspan="3" style="text-align:center;">ANEXOS</th>
					</tr>
					<tr>
						<th class="prettyprint">Anexo</th>
						<th class="prettyprint">Funcionario</th>
						<th class="prettyprint">Fecha y hora</th>
					</tr>
						';
	
				for ($i = 0; $i < $datos_anexos['numcampos']; $i++) {
					
					$fun=busca_filtro_tabla('','funcionario','idfuncionario='.$datos_anexos[$i]['funcionario_idfuncionario'],'',$conn);
					$nombre_funcionario=$fun[0]['nombres'].' '.$fun[0]['apellidos'];
					$retorno_anexos .= '
						<tr>
						<td><a href="' . $ruta_db_superior .'pantallas/tareas_listado/ejecutar_acciones.php?ejecutar_accion_tarea=descargar_anexo_nombre_original&tipo_retorno=2&idtareas_listado_anexos='.$datos_anexos[$i]['idtareas_listado_anexos'].'" target="_blank">' . $datos_anexos[$i]['etiqueta'] . '</a></td>
						<td>'.$nombre_funcionario.'</td>
						<td>'.$datos_anexos[$i]['fecha_hora'].'</td>
						</tr>
					';
				}
				$retorno_anexos .= '</table>';
			}			
			$retorno.=$retorno_anexos;

			$avances = busca_filtro_tabla(fecha_db_obtener("t.fecha_inicio", "Y-m-d") . " as fecha," . concatenar_cadena_sql(array("f.nombres", "' '", "f.apellidos")) . " as nombre,estado_avance,comentario,tiempo_registrado,idtareas_listado_tiempo,t.funcionario_idfuncionario", "tareas_listado_tiempo t,funcionario f", "t.funcionario_idfuncionario=f.idfuncionario and t.fk_tareas_listado=" . $datos[0]['idtareas_listado'], "idtareas_listado_tiempo", $conn);
			
			$retorno_avances='';
			if ($avances["numcampos"]) {
				include_once ($ruta_db_superior . "pantallas/lib/librerias_fechas.php");
				$retorno_avances .= '
				<table class="table table-bordered">
					<tr>
						<th colspan="6" class="prettyprint" style="text-align:center;">AVANCES</th>
					</tr>';
				$retorno_avances .= '
					<tr>
						<th class="prettyprint">Fecha</th> 
						<th class="prettyprint">Funcionario</th> 
						<th class="prettyprint">Tiempo</th> 
						<th class="prettyprint">Estado</th> 
						<th class="prettyprint">Comentarios</th>
					</tr>';
				for ($i = 0; $i < $avances["numcampos"]; $i++) {
					$retorno_avances .= '
								<tr> 
									<td>' . $avances[$i]["fecha"] . '</td> 
									<td>' . $avances[$i]["nombre"] . '</td> 
									<td>' . conversor_segundos_hm($avances[$i]["tiempo_registrado"]) . '</td> 
									<td>' . $avances[$i]["estado_avance"] . '</td> 
									<td>' . $avances[$i]["comentario"] . '</td> 
								</tr>';
				}
				$retorno_avances .= "</table>";
			}
			$retorno.=$retorno_avances;
			
		} else {
			$retorno = "";
		}
		break;

	case '5' :
		$retorno = '<div class="controls">';
		$selected = ($datos[0]["prioridad"] == 0) ? 'checked="true"' : '';
		$retorno .= '<input type="radio" class="required" name="prioridad_' . $_REQUEST['idtareas_listado'] . '" id="prioridad0" value="0" ' . $selected . '>&nbsp;&nbsp;<i class="icon-flag-amarillo"></i> Baja&nbsp;&nbsp;&nbsp;&nbsp;';
		$selected = ($datos[0]["prioridad"] == 1) ? 'checked="true"' : '';
		$retorno .= '<input type="radio" name="prioridad_' . $_REQUEST['idtareas_listado'] . '" id="prioridad0" value="1" ' . $selected . '>&nbsp;&nbsp;<i class="icon-flag-naranja"></i> Media&nbsp;&nbsp;&nbsp;&nbsp;';
		$selected = ($datos[0]["prioridad"] == 2) ? 'checked="true"' : '';
		$retorno .= '<input type="radio" name="prioridad_' . $_REQUEST['idtareas_listado'] . '" id="prioridad0" value="2" ' . $selected . '>&nbsp;&nbsp;<i class="icon-flag-morado"></i> Alta&nbsp;&nbsp;&nbsp;&nbsp;';
		$selected = ($datos[0]["prioridad"] == 3) ? 'checked="true"' : '';
		$retorno .= '<input type="radio" name="prioridad_' . $_REQUEST['idtareas_listado'] . '" id="prioridad0" value="3" ' . $selected . '>&nbsp;&nbsp;<i class="icon-flag-rojo"></i> Critica&nbsp;&nbsp;&nbsp;&nbsp;
		<label class="error" for="prioridad"></label>
		</div>';
		break;

	case '7' :
		$info_avance = busca_filtro_tabla("t.descripcion," . fecha_db_obtener("fecha_creacion", "Y-m-d H:i:s") . " as fecha,f.nombres,f.apellidos", "tareas_listado_notas t,funcionario f", "t.funcionario_idfuncionario=f.idfuncionario and fk_tareas_listado=" . $_REQUEST["idtareas_listado"], "idtareas_listado_notas desc", $conn);
		$parte = "";
		if ($info_avance["numcampos"]) {
			$parte = "<table style='width:100%' class='table-hover'>";
			$parte .= "<thead><tr> <th style='width:15%'>FECHA</th> <th style='width:15%'>FUNCIONARIO</th> <th style='width:70%'>AVANCE</th> </tr></thead>";
			$parte .= "<tbody>";
			for ($i = 0; $i < $info_avance["numcampos"]; $i++) {
				$parte .= "<tr> <td>" . $info_avance[$i]["fecha"] . "</td> <td>" . $info_avance[$i]["nombres"] . " " . $info_avance[$i]["apellidos"] . "</td> <td>" . $info_avance[$i]["descripcion"] . "</td> </tr>";
			}
			$parte .= "</tbody>";
			$parte .= "</table><br/><br/>";
		}
		$retorno = '<table style="width:100%" class="table">
			<tr><td><textarea style="width:100%" class="form-control" rows="3" id="avance_notas_' . $_REQUEST["idtareas_listado"] . '"></textarea></td></tr>
			<tr><td>Enviar Email:&nbsp;&nbsp;&nbsp;<input type="radio" name="enviar_correo_' . $_REQUEST["idtareas_listado"] . '" value="1" checked>Si&nbsp;&nbsp;&nbsp;<input type="radio" name="enviar_correo_' . $_REQUEST["idtareas_listado"] . '" value="0" >NO</td></tr>
			<tr><td><button type="button" class="btn btn-primary btn-mini" id="registrar_nota_' . $_REQUEST["idtareas_listado"] . '">Registrar</button><td></tr>' . $parte;
			
		if($datos[0]['estado_tarea']=='TERMINADO'){
			$retorno=$parte;
		}		


		//incorporacion de anexos ----------
		
		
		$datos_anexos = busca_filtro_tabla("", "tareas_listado_anexos", "fk_tareas_listado=" . $_REQUEST["idtareas_listado"], "", $conn);
		
		$retorno_anexos = '';
		if ($datos_anexos['numcampos']) {
			$retorno_anexos.= '
				<table class="table table-striped" id="anexos_cargados_' . $_REQUEST["idtareas_listado"] . '">
				<tr>
					<td>Anexo</td>
					<td>Funcionario</td>
					<td>Fecha y hora</td>
				</tr>
					';

			for ($i = 0; $i < $datos_anexos['numcampos']; $i++) {
				
				$fun=busca_filtro_tabla('','funcionario','idfuncionario='.$datos_anexos[$i]['funcionario_idfuncionario'],'',$conn);
				$nombre_funcionario=$fun[0]['nombres'].' '.$fun[0]['apellidos'];
				$retorno_anexos .= '
					<tr id="contenedor_anexo_' . $datos_anexos[$i]['idtareas_listado_anexos'] . '">
					<td><a href="' . $ruta_db_superior .'pantallas/tareas_listado/ejecutar_acciones.php?ejecutar_accion_tarea=descargar_anexo_nombre_original&tipo_retorno=2&idtareas_listado_anexos='.$datos_anexos[$i]['idtareas_listado_anexos'].'" target="_blank">' . $datos_anexos[$i]['etiqueta'] . '</a></td>
					<td>'.$nombre_funcionario.'</td>
					<td>'.$datos_anexos[$i]['fecha_hora'].'</td>
				';
				
				if($datos_anexos[$i]['funcionario_idfuncionario']==usuario_actual('idfuncionario')){
					$retorno_anexos.='	
						<td style="width:5%;">
						<div style="cursor:pointer;" title="Eliminar Anexo ' . $datos_anexos[$i]['etiqueta'] . '" class="icon icon-trash  eliminar_anexo_tareas" identificador="' . $datos_anexos[$i]['idtareas_listado_anexos'] . '"></div>	
						</td>
					';
				}

				$retorno_anexos.='
					</tr>						
				';
			}
			$retorno_anexos .= '</table>';
		}

		
		if($datos[0]['estado_tarea']=='TERMINADO'){
			$info_retorno["bloquear_anexos"]=1;
		}else{
			$info_retorno["bloquear_anexos"]=0;
		}		
		
		
		$info_retorno["valor_anexos"]=$retorno_anexos;




			
		break;

	case '10' :
		/*
		$datos_anexos = busca_filtro_tabla("", "tareas_listado_anexos", "fk_tareas_listado=" . $_REQUEST["idtareas_listado"], "", $conn);
		
		$retorno = '';
		if ($datos_anexos['numcampos']) {
			$retorno = '
				<table class="table table-striped" id="anexos_cargados_' . $_REQUEST["idtareas_listado"] . '">
				<tr>
					<td>Anexo</td>
					<td>Funcionario</td>
					<td>Fecha y hora</td>
				</tr>
					';

			for ($i = 0; $i < $datos_anexos['numcampos']; $i++) {
				
				$fun=busca_filtro_tabla('','funcionario','idfuncionario='.$datos_anexos[$i]['funcionario_idfuncionario'],'',$conn);
				$nombre_funcionario=$fun[0]['nombres'].' '.$fun[0]['apellidos'];
				$retorno .= '
					<tr id="contenedor_anexo_' . $datos_anexos[$i]['idtareas_listado_anexos'] . '">
					<td><a href="' . $ruta_db_superior . $datos_anexos[$i]['ruta'] . '" target="_blank">' . $datos_anexos[$i]['etiqueta'] . '</a></td>
					<td>'.$nombre_funcionario.'</td>
					<td>'.$datos_anexos[$i]['fecha_hora'].'</td>
					
				';
				
				if($datos_anexos[$i]['funcionario_idfuncionario']==usuario_actual('idfuncionario')){
					$retorno.='	
						<td style="width:5%;">
						<div style="cursor:pointer;" title="Eliminar Anexo ' . $datos_anexos[$i]['etiqueta'] . '" class="icon icon-trash  eliminar_anexo_tareas" identificador="' . $datos_anexos[$i]['idtareas_listado_anexos'] . '"></div>	
						</td>
					';
				}

				$retorno.='
					</tr>						
				';
			}
			$retorno .= '</table>';
		}

		
		if($datos[0]['estado_tarea']=='TERMINADO'){
			$info_retorno["bloquear_anexos"]=1;
		}else{
			$info_retorno["bloquear_anexos"]=0;
		}
		
		*/
		break;
		
	case '11' :
	
		$datos_recurrencia=busca_filtro_tabla("","tareas_listado_recur a, tareas_listado b","a.fk_tareas_listado=b.idtareas_listado AND a.fk_tareas_listado=".$_REQUEST['idtareas_listado'],"",$conn);
		$retorno='';
		if($datos_recurrencia['numcampos']){
			$se_repite=array(1=>'Cada d&iacute;a',3=>'Cada semana',4=>'Cada mes',5=>'Cada año');
			$mensaje_se_repite=array(1=>'D&iacute;a(s)',3=>'Semana(s)',4=>'Mes(es)',5=>'Año(s)');	
			$retorno.='
				<table class="table table-striped" id="contenedor_resumen_recurrencia_' . $_REQUEST["idtareas_listado"] . '">
					<tr>
						<td colspan="2" style="text-align:center;"><b>Informacion de la Recurrencia</b></td>
					</tr>
					<tr>
						<td ><b>Inicia el:</b></td>
						<td >'.$datos_recurrencia[0]['fecha_inicio'].'</td>
					</tr>					
					<tr>
						<td ><b>Se repite:</b></td>
						<td >'.$se_repite[ $datos_recurrencia[0]['recurrencia'] ].'</td>
					</tr>
					<tr>
						<td ><b>Repetir Cada:</b></td>
						<td >'.$datos_recurrencia[0]['repetir_cada'].' '.$mensaje_se_repite[ $datos_recurrencia[0]['recurrencia'] ].'</td>
					</tr>			
			';
			if($datos_recurrencia[0]['recurrencia']==3){ //semana
				$dias_semana=array('Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado');
				$vector_dias_semana=explode(',',$datos_recurrencia[0]['dias_semana']);
				$dias_semana_seleccionados="";
				for($i=0;$i<count($vector_dias_semana);$i++){
					if($i+1==count($vector_dias_semana)){
						$dias_semana_seleccionados.=$dias_semana[ $vector_dias_semana[$i] ]."";
					}else{
						$dias_semana_seleccionados.=$dias_semana[ $vector_dias_semana[$i] ].", ";
					}
				}
				$retorno.='						
					<tr>
						<td ><b>Repetir el:</b></td>
						<td >'.$dias_semana_seleccionados.'</td>
					</tr>
				';					
			}
			if($datos_recurrencia[0]['recurrencia']==4){ //mes
				$cada=array(1=>'Dia del Mes',2=>'Dia de la Semana');
				$retorno.='						
					<tr>
						<td ><b>Cada:</b></td>
						<td >'.$cada[ $datos_recurrencia[0]['repetir_mes'] ].'</td>
					</tr>
				';					
			}
			$finaliza_el=array(1=>'Nunca',2=>'Al cabo de '.$datos_recurrencia[0]['finaliza_el_repeticiones'].' Repeticiones',3=>'El '.$datos_recurrencia[0]['finaliza_el_fecha']);
			$retorno.='						
				<tr>
					<td ><b>Finaliza el:</b></td>
					<td >'.$finaliza_el[ $datos_recurrencia[0]['finaliza_el'] ].'</td>
				</tr>
			';	
			
			
			if($datos_recurrencia[0]['ejecuta_proxima']=='0000-00-00'){
				if($datos_recurrencia[0]['finaliza_el']==2){
					$retorno.='<tr>
							<td><strong>Proxima ejecuci&oacute;n: &nbsp; </strong></td>
							<td>Ya se realizaron las '.$datos_recurrencia[0]['finaliza_el_repeticiones'].' repeticiones  </td>
						</tr>';	
				}				
			}else{
				$retorno.='<tr>
							<td><strong>Proxima ejecuci&oacute;n: &nbsp; </strong></td>
							<td>'.$datos_recurrencia[0]['ejecuta_proxima'].' &nbsp; <button class="btn btn-mini generar_tarea_recurrencia" idtarea="'. $_REQUEST["idtareas_listado"].'"><i class="icon-retweet"></i></button></td>
						</tr>';				
			}			
	
				
				

					
					
     		$proxima_ejecucion=calcula_ejecuta_proxima($_REQUEST["idtareas_listado"]);
    		if($proxima_ejecucion){
        		$retorno.='<tr>
           		 <td><strong>Proxima ejecuci&oacute;n 2: &nbsp; </strong></td>
            		<td>'.$proxima_ejecucion->format("Y-m-d").'</td>
            
          		</tr>';
      		}
      		else{
      			
				if($datos_recurrencia[0]['finaliza_el']==2){
					
				}else{
				
	        		$retorno.='<tr>
	       		     <td><strong>Finaliza:</strong></td>
	       		     <td>'.$datos_recurrencia[0]["finaliza_el_fecha"].'</td>
	      		    </tr>';
				
				}
				
				
    		}
			$retorno.='</table>';			
		}else{
			
			$papa_recurrencia=busca_filtro_tabla("","tareas_listado a, tareas_listado_recur b","a.fk_tarea_recurrencia=b.fk_tareas_listado AND a.idtareas_listado=".$_REQUEST['idtareas_listado'],"",$conn);
			
			$retorno='<table class="table table-striped" id="contenedor_resumen_recurrencia_' . $_REQUEST["idtareas_listado"] . '">';
			if($papa_recurrencia['numcampos']){
			


				if($papa_recurrencia[0]['ejecuta_proxima']=='0000-00-00'){
					if($papa_recurrencia[0]['finaliza_el']==2){
						$retorno.='<tr>
						<td><strong>Recurrencia principal: &nbsp; '.$papa_recurrencia[0]['fk_tarea_recurrencia'].'</strong></td>
						<td>Proxima ejecuci&oacute;n: &nbsp; Ya se realizaron las '.$papa_recurrencia[0]['finaliza_el_repeticiones'].' repeticiones </td>
								
							</tr>';	
					}else{
						$retorno.='<tr><td>Finaliz&oacute; el: '.$datos_recurrencia[0]["finaliza_el_fecha"].'</td></tr>';
					}				
				}else{
					$retorno.='
							<tr>
								<td><strong>Recurrencia principal: &nbsp; '.$papa_recurrencia[0]['fk_tarea_recurrencia'].'</strong></td>
								<td>Proxima ejecuci&oacute;n: &nbsp;'.$papa_recurrencia[0]['ejecuta_proxima'].'</td>
								<td><button class="btn btn-mini generar_tarea_recurrencia" idtarea="'.$papa_recurrencia[0]['fk_tarea_recurrencia'].'"><i class="icon-retweet"></i>&nbsp;</button> </td>
							</tr>
					';			
				}								
			}else{
				$retorno.='
						<tr>
							<td><strong>Sin recurrencia asginada </strong></td>
						</tr>
				';				
			}
			$retorno.='</table>';

		}
		break;		
		
		
		
	case '12' :
		$vector_funcionarios=array();
		if($datos[0]["seguidores"]!=''){
			$vector_funcionarios=mostrar_funcionarios($datos[0]["seguidores"],true);	
		}	
		$retorno.='<table id="mostrar_resumen_seguidores_'.$datos[0]["idtareas_listado"].'" class="table table-bordered"><tbody>';
		$retorno.='<tr><td class="prettyprint">Seguidores</td></tr>';

		if(count($vector_funcionarios)>0){
			for($i=0;$i<count($vector_funcionarios);$i++){
				$retorno.='<tr><td>'.$vector_funcionarios[$i].'</td></tr>';
			}			
		}else{
			$retorno.='<tr><td>Sin seguidores asignados</td></tr>';			
		}
		$retorno.='</tbody></table>';	
		break;				

	case '13' :
		
			$retorno.='<div id="mostrar_informacion_etiquetas_'.$datos[0]["idtareas_listado"].'"  >';
				$retorno.=' 
					<ul class="nav nav-tabs">
						<li><a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 320, height: 180,preserveContent:false} )" href="'.$ruta_db_superior.'etiqueta.php?accion=adicionar">Adicionar etiqueta</a></li>
					</ul>
				';
			
				$mis_etiquetas=busca_filtro_tabla("","etiqueta","funcionario=".usuario_actual('funcionario_codigo'),"",$conn);
				$etiquetas_tarea=busca_filtro_tabla("","tareas_listado_etiquetas a, etiqueta b","a.tareas_listado_fk=".$datos[0]["idtareas_listado"]." AND a.etiqueta_idetiqueta=b.idetiqueta AND b.funcionario=".usuario_actual('funcionario_codigo'),"",$conn);
				$vector_etiquetas_tarea=extrae_campo($etiquetas_tarea,'etiqueta_idetiqueta');
				
				
				if($mis_etiquetas['numcampos']){
					$checkbox_etiquetas='<table style="border:0px;"><tr>';
					$j=0;
					for($i=0;$i<$mis_etiquetas['numcampos'];$i++){
						$checked='';
						if(in_array($mis_etiquetas[$i]['idetiqueta'], $vector_etiquetas_tarea)){
							$checked='checked';
						}
						
						$checkbox_etiquetas.='<td><input type="checkbox" id="eti_'.$datos[0]["idtareas_listado"].'_'.$i.'" value="'.$mis_etiquetas[$i]['idetiqueta'].'" '.$checked.'> '.ucfirst(strtolower($mis_etiquetas[$i]['nombre'])).'</td>';
						$j++;
						if($j==5){
							$checkbox_etiquetas.='</tr><tr>';
							$j=0;
						}
					}
					$checkbox_etiquetas.='</tr></table>';
				
					$retorno.='
					<table class="table table-bordered"><tbody>
						<tr>
							<td style="vertical-align:middle;">Etiquetas:</td>
							<td>'.$checkbox_etiquetas.'</td>
							<td style="vertical-align:middle;">
								<input class="btn btn-mini btn-primary etiquetar_tarea" type="button" idtarea="'.$datos[0]["idtareas_listado"].'" value="Etiquetar Tarea">
								<input type="hidden" name="cantidad_etiquetas_'.$datos[0]["idtareas_listado"].'" value="'.$mis_etiquetas['numcampos'].'">
							</td>
						</tr>
					</tbody></table>';
				
				}
			$retorno.='</div>';	
			
		break;	
	case '14':
	       
	       $idtareas_listado=$datos[0]['idtareas_listado'];
	       $calificacion=$datos[0]['calificacion'];
	       $progreso=$datos[0]['progreso'];
           $retorno_calif = '
            	<input type="text" name="rating_'.$idtareas_listado.'" id="rating_'.$idtareas_listado.'" value="'.$calificacion.'"/> 
            	<ul >
            ';
            for ($j = 1; $j < 6; $j++) {
              $checked='';	
              $required = "";
              if ($j == 1) {
                $required = ' required';
              }
              $checked = "";
              if ($j <= $calificacion) {
                $checked = 'estrella_seleccionada';
              }
			  
			  $retorno_calif.='
			  <li data-toggle="tooltip" title="'.$j.'" style="cursor:pointer;" class="estrellas '.$checked.' " id="'.$idtareas_listado.'_calificacion_'.$j.'"   name="calificacion_' .$idtareas_listado. '" value="' . $j . '"  class="calificacion '.$required.' '.$checked.' " idtareas_listado="'.$idtareas_listado.'" onmouseover="highlightStar_'.$idtareas_listado.'('.$j.');" onmouseout="removeHighlight_'.$idtareas_listado.'();" onClick="addRating_'.$idtareas_listado.'('.$j.');">&#9733;</li>
			  ';
			$retorno_calif.='
				<script>
				function highlightStar_'.$idtareas_listado.'(obj) {
					var valor = obj;
					for(i=0;i<6;i++){
						if(i+1<=valor){
							$(\'#'.$idtareas_listado.'_calificacion_\'+(i+1)+\'\').addClass(\'estrella_seleccionada\');
						}else{
							$(\'#'.$idtareas_listado.'_calificacion_\'+(i+1)+\'\').removeClass(\'estrella_seleccionada\');
						}
					}						
				 }
				  function removeHighlight_'.$idtareas_listado.'() {
					
					var valor = $(\'#rating_'.$idtareas_listado.'\').val();
					for(i=0;i<6;i++){
						if(i+1<=valor){
							$(\'#'.$idtareas_listado.'_calificacion_\'+(i+1)+\'\').addClass(\'estrella_seleccionada\');
						}else{
							$(\'#'.$idtareas_listado.'_calificacion_\'+(i+1)+\'\').removeClass(\'estrella_seleccionada\');
						}
					}	
				  }
				  function addRating_'.$idtareas_listado.'(obj) {
				      $(\'#'.$idtareas_listado.'_calificacion_\'+obj+\'\').addClass(\'estrella_seleccionada\');
				      $(\'#rating_'.$idtareas_listado.'\').val( $(\'#'.$idtareas_listado.'_calificacion_\'+obj+\'\').attr(\'value\') );
					  
					  var observaciones=$(\'#observaciones_calificacion_'.$idtareas_listado.'\').val();
					  var calificacion=$(\'#'.$idtareas_listado.'_calificacion_\'+obj+\'\').attr(\'value\');
					  
						$.ajax({
	                        type:"POST",
	                        dataType: "json",
	                        url: "'.$ruta_db_superior.'pantallas/tareas_listado/ejecutar_acciones.php",
	                        data: {
	                        				tipo_retorno:2,
	                        				ejecutar_accion_tarea:"actualizar_calificacion",
	                                        idtareas_listado:'.$idtareas_listado.',
	                                        observaciones:observaciones,
	                                        calificacion:calificacion
	                        },
	                        success: function(datos){
								   
	                        		$("#progreso'.$idtareas_listado.',#prioridades'.$idtareas_listado.',#fecha'.$idtareas_listado.'").css("display", "none");
									$("#observaciones_calificacion_'.$idtareas_listado.'").val("");
									notificacion_saia("Calificacion Registrada Satisfactoriamente","success","",4000);
									
									if(datos.exito_recurrencia){
										notificacion_saia("Recurrencia Generada Satisfactoriamente","success","",4000);
									}
									
									if ( $("#historial_calificaciones_'.$idtareas_listado.'").length > 0 ) {
										var add_tabla="<tr><td></td><td>"+datos.fecha_hora+"</td><td>"+datos.calificacion_stars+"</td><td>"+observaciones+"</td></tr>";
										if($("#encabezado_historial_calificaciones_'.$idtareas_listado.'").length == 0){
											var encabezado="<tr id=\'encabezado_historial_calificaciones_'.$idtareas_listado.'\'><th>Funcionario</th><th>Fecha y Hora</th><th>Calificacion</th><th>Observaci&oacute;n</th></tr>";
											$("#historial_calificaciones_'.$idtareas_listado.'").after(encabezado);
										}
										
										$("#encabezado_historial_calificaciones_'.$idtareas_listado.'").after(add_tabla);
									}

									
	                        }
	                    }); 					   
				  }
				</script>			
			';					  

            }
            $retorno_calif.= '<script>$("#rating_'.$idtareas_listado.'").hide();</script>';
            $retorno_calif.='</ul>';
			$retorno_calif.='<textarea style="margin-left: 20px;" placeholder="Observaciones..." id="observaciones_calificacion_'.$idtareas_listado.'"></textarea>';
			
			$calificaciones_tarea=busca_filtro_tabla("","tareas_listado_evalua","fk_tareas_listado=".$idtareas_listado,"fecha_hora DESC",$conn);
			
			$stars=array(1=>'&#9733;',2=>'&#9733;&#9733;',3=>'&#9733;&#9733;&#9733;',4=>'&#9733;&#9733;&#9733;&#9733;',5=>'&#9733;&#9733;&#9733;&#9733;&#9733;');
			
			$retorno_calif.='<table class="table table-bordered" id="historial_calificaciones_'.$idtareas_listado.'">';
			if($calificaciones_tarea['numcampos']){
				$retorno_calif.='
						<tr id="encabezado_historial_calificaciones_'.$idtareas_listado.'">
							<th>Funcionario</th>
							<th>Fecha y Hora</th>
							<th>Calificacion</th>
							<th>Observaci&oacute;n</th>
							</tr>
				';				
				for($i=0;$i<$calificaciones_tarea['numcampos'];$i++){
					
					$retorno_calif.='<tr>';
					if($i==0){
						$fun_calificacion=busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$calificaciones_tarea[$i]['funcionario_idfuncionario'],"",$conn);
						
						$nombre_fun_calificacion=ucwords(strtolower($fun_calificacion[0]['nombres'].' '.$fun_calificacion[0]['apellidos']));
						$retorno_calif.='
							<td style="vertical-align:middle;" rowspan="'.($calificaciones_tarea['numcampos']).'" id="funcionario_historial_calificaciones_'.$idtareas_listado.'">
								'.$nombre_fun_calificacion.'
							</td>
						';						
					}
					$retorno_calif.='<td>'.$calificaciones_tarea[$i]['fecha_hora'].'</td>';
					$retorno_calif.='<td>'.$stars[$calificaciones_tarea[$i]['calificacion']].'</td>';
					$retorno_calif.='<td>'.utf8_encode(html_entity_decode($calificaciones_tarea[$i]['observaciones'])).'</td>';
					$retorno_calif.='</tr>';
				}
				
			}
			$retorno_calif.='</table>';
			

			if($progreso=='progreso'){
				$progreso=0;
			}
			if($progreso==100){
			    //$retorno_calif.=$ajax;
			    $retorno=$retorno_calif;	
			}else{
				$retorno=('<div class="alert alert-warning" style="text-align:center; font-size:10pt;"><b>ATENCI&Oacute;N!</b> <br/> La tarea debe tener un progreso del 100% para ser calificada, actualmente se encuentra al '.$progreso.'%</div>'.$ajax);
			}
			
	    break;
	case '15':
	        $idtareas_listado=$datos[0]['idtareas_listado'];
	        $progreso=$datos[0]['progreso'];	    
            $retorno='
                <div class="layout-slider slider_saia">
                    <input id="slider_'.$idtareas_listado.'" type="slider" name="porcentaje_'.$idtareas_listado.'" value="'.$progreso.'" class="slider_saia_value" idtarea="'.$idtareas_listado.'" />
                </div>
                <script type="text/javascript" charset="utf-8">
                    $("#slider_'.$idtareas_listado.'").slider({ from: 0, to: 100, step: 1, round: 1, dimension: "&nbsp;%", skin: "round", callback: function( value ){save_progreso_tarea('.$idtareas_listado.',value);} });
                </script>
            ';
            $progreso_100=busca_filtro_tabla("","tareas_progreso","fk_tareas_listado=".$idtareas_listado,"fecha_progreso DESC",$conn);
            if($progreso_100['numcampos']){
                $tabla_historial='
                    <table class="table table-bordered">
						<tr>
							<th>Fecha y Hora</th>
							<th>Funcionario</th>
							<th>Progreso</th>
						</tr>                        
                ';
                
                for($i=0;$i<$progreso_100['numcampos'];$i++){
                    $fun_progreso=busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$progreso_100[$i]['funcionario_idfuncionario'],"",$conn);
					$nombre_fun_progreso=ucwords(strtolower($fun_progreso[0]['nombres'].' '.$fun_progreso[0]['apellidos']));
                    $tabla_historial.='
                        <tr>
                            <td>'.$progreso_100[$i]['fecha_progreso'].'</td>
                            <td>'.$nombre_fun_progreso.'</td>
                            <td>'.$progreso_100[$i]['progreso'].'%</td>
                        </tr>
                    ';
                }
                $tabla_historial.='</table>';
                $retorno.=$tabla_historial;
            }
	    break;

			
}

$search = array("\n", "\t", "\r");
$info_retorno["valor"]=str_replace($search, "", $retorno);

echo(json_encode($info_retorno));
?>