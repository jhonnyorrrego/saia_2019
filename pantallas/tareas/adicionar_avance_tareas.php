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
include_once ($ruta_db_superior . "class_transferencia.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_notificaciones.php");

echo(librerias_jquery("1.7"));
echo(librerias_arboles());
echo(estilo_bootstrap());
echo(librerias_bootstrap());

function cambiar_estado_documento_ruta_aprob($datos_tareas_ruta_aprob) {
	global $equivalencia_estados;
	$aprobadas=0;
	$visto_bueno=0;
	$aprobadas_avance=0;
	$visto_bueno_avance=0;
	if (@$_REQUEST["estado"] == 5 && $datos_tareas_ruta_aprob[0]["accion_tareas"]==1) {
		//Se actualiza el estado a rechazado de la ruta aprobacion
		//TODO: se debe validar que se hace con las demas tarea REspuesta no se hace nada 
		
		$sql1 = "UPDATE documento_ruta_aprob SET estado_ruta_aprob=3 WHERE iddocumento_ruta_aprob=" . $datos_tareas_ruta_aprob[0]["iddocumento_ruta_aprob"];
		phpmkr_query($sql1);
	}
	$datos_tareas_ruta_aprob_rechazados = busca_filtro_tabla("", "tareas A, documento_ruta_aprob B", "A.ruta_aprob=B.iddocumento_ruta_aprob AND iddocumento_ruta_aprob=" . $datos_tareas_ruta_aprob[0]["iddocumento_ruta_aprob"] . " AND B.estado_ruta_aprob=3", "", $conn);
	if (!$datos_tareas_ruta_aprob_rechazados["numcampos"]) {
		$datos_tareas_ruta_aprob_total = busca_filtro_tabla("", "tareas A, documento_ruta_aprob B", "A.ruta_aprob=B.iddocumento_ruta_aprob AND iddocumento_ruta_aprob=" . $datos_tareas_ruta_aprob[0]["iddocumento_ruta_aprob"], "orden_tareas", $conn);		
		//se verifica que no existan mas tareas, si existen se envia a la siguiente tarea
		for ($i = 0; $i < $datos_tareas_ruta_aprob_total["numcampos"]; $i++) {
			//Se encuentra la tarea a la que se esta dando el avance
			if ($datos_tareas_ruta_aprob_total[$i]["idtareas"] == $datos_tareas_ruta_aprob[0]["idtareas"]) {
				//Se verifica que la tarea siguiente existe
				if (isset($datos_tareas_ruta_aprob_total[($i + 1)])) {
					//Se hace la transferencia a la tarea siguiente
					$formato = busca_filtro_tabla("", "documento A,formato B", "lower(A.plantilla)=lower(B.nombre) AND A.iddocumento=" . $datos_tareas_ruta_aprob[$i]["documento_iddocumento"], "", $conn);
					//si el estado es aprobado o visto bueno
					if ($_REQUEST["estado"] == 3 || $_REQUEST["estado"] == 4) {
						//Se validan las tareas seriales
						if ($datos_tareas_ruta_aprob[0]["aprobacion_en"] == 1) {
							transferencia_automatica($formato[0]["idformato"], $datos_tareas_ruta_aprob_total[$i]["documento_iddocumento"], $datos_tareas_ruta_aprob_total[($i+1)]["responsable"], 1);
						//TODO: Verificar que pasa con el stand by de las tareas si se debe actualizar algun estado a pendiente, esto es para validar el listado de las tareas y que no le aparezcan al usuario hasta que no le toca su momento de aprobacion de igual forma se debe validar si se debe actualizar la fecha en que se asigna la tarea ya que para todos aplica la misma fecha y es la fecha de vencimiento de la tareay el usuario solo la recibe en este momento
						}
					}
				} /*else {
					//Es la ultima tarea y Se verifica si se debe cerrar la ruta de aprobacion con el estado aprobado
					//Aqui ya se garantiza que no existen rechazados
					if (@$_REQUEST["estado"] == 3) {
						$sql1 = "UPDATE documento_ruta_aprob SET estado_ruta_aprob=1 WHERE iddocumento_ruta_aprob=" . $datos_tareas_ruta_aprob[0]["iddocumento_ruta_aprob"];
						phpmkr_query($sql1);
					}
				}*/

			}
			$avance=busca_filtro_tabla("","tareas_avance","tareas_idtareas=".$datos_tareas_ruta_aprob_total[$i]["idtareas"],"fecha DESC",$conn);
			if($avance["numcampos"]){
				//validamos si el estado del avance de cada tarea es 3=aprobado para que de sumas iguales con el total de tareas por aprobar
				if($avance[0]["estado"]==3){
					$aprobadas_avance++;
				}
				else if($avance[0]["estado"]==4){
					$visto_bueno_avance++;
				}
			}
			
			///Estados 1=aprobar,2=visto_bueno
			if($datos_tareas_ruta_aprob_total[$i]["accion_tareas"]==1){
				$aprobadas++;
			}
			else if($datos_tareas_ruta_aprob_total[$i]["accion_tareas"]==2){
				$visto_bueno++;
			}
		}
		if($aprobadas && $aprobadas==$aprobadas_avance){
			$sql1 = "UPDATE documento_ruta_aprob SET estado_ruta_aprob=1 WHERE iddocumento_ruta_aprob=" . $datos_tareas_ruta_aprob[0]["iddocumento_ruta_aprob"];
			phpmkr_query($sql1);
		}
		elseif($visto_bueno && $visto_bueno==$visto_bueno_avance){
			$sql1 = "UPDATE documento_ruta_aprob SET estado_ruta_aprob=6 WHERE iddocumento_ruta_aprob=" . $datos_tareas_ruta_aprob[0]["iddocumento_ruta_aprob"];
			phpmkr_query($sql1);
		}
	}
}

if ($_REQUEST['guardar'] == 1) {
	///Toda esta parte de logica se debe pasar a las librerias
	//Equivalencia de los estados entre la tareas_avance y ruta aprobacion
	//tareas_avance 0=pendiente,2=terminada,3=aprobada,4=visto bueno,5=rechazado
	//ruta_aprobacion 0=pendiente,1=aprobada,3=rechazada,4=Cerrada
	$equivalencia_estados = array(0 => 0, 2 => 4, 3 => 1, 5 => 3);
	$tarea = $_REQUEST['idtareas'];
	$sql = "INSERT INTO tareas_avance (tareas_idtareas,fecha,descripcion,estado,ejecutor) VALUES(" . $tarea . "," . fecha_db_almacenar($_REQUEST['fecha'], "Y-m-d H:i:s") . ",'" . ($_REQUEST['descripcion']) . "'," . $_REQUEST['estado'] . "," . usuario_actual("funcionario_codigo") . ")";
	phpmkr_query($sql);
	/**Aqui se debe validar para cambiar el estado del ruta_aprob*/
	$sql = "UPDATE tareas SET estado_tarea=" . $_REQUEST["estado"] . " WHERE idtareas=" . $tarea;
	phpmkr_query($sql);
	
	$ruta_aprob=0;
	$datos_tareas_ruta_aprob = busca_filtro_tabla("", "tareas A, documento_ruta_aprob B", "A.ruta_aprob=B.iddocumento_ruta_aprob AND A.idtareas=" . $tarea, "", $conn);
	if ($datos_tareas_ruta_aprob["numcampos"]) {
		$ruta_aprob=1;
		cambiar_estado_documento_ruta_aprob($datos_tareas_ruta_aprob);
	}
	notificaciones("Avance asignado!", "success", 4500);
	unset($_REQUEST);
	?>
	<script type="text/javascript">
		var ruta_aprob=parseInt(<?php echo $ruta_aprob;?>);
		window.parent.hs.close();
		if(ruta_aprob==1){
			window.parent.location.reload();
		}
	</script>
	<?php
	die();
}
$datos_tareas=busca_filtro_tabla("","tareas","idtareas=".$_REQUEST['idtareas'],"",$conn);
?>
<style>
	label.error {
		font-weight: bold;
		color: red;
	}
</style>
<div class="container">
	<div class="control-group" nombre="etiqueta">
		<legend>
			Asignar avance a la tarea
		</legend>
	</div>
	<form id="formulario_tareas" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="etiqueta">Fecha*:</label>
			<div class="controls">
				<input type="text" name="fecha" id="fecha" class="required" readonly="" value="<?php echo(date("Y-m-d H:i:s")); ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="etiqueta">Descripci&oacute;n*:</label>
			<div class="controls">
				<textarea id="descripcion" class="required" name="descripcion" placeholder="Descripcion"></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="etiqueta">Estado*:</label>
			<div class="controls">
				<?php
				$check=' checked="checked" ';
				if($datos_tareas[0]["ruta_aprob"]){
					//Si en la tarea dice aprobar aqui deberia solo sale el aprobar=1, lo mismo para el visto bueno=2
					if($datos_tareas[0]["accion_tareas"]==1){
					?>
					<input type="radio" class="required" name="estado" id="estado3" value="3" <?php echo($check);?>>
					Aprobar
					<?php
					$check='';
					}
					else if($datos_tareas[0]["accion_tareas"]==2){
					?>
					<input type="radio" class="required" name="estado" id="estado4" value="4" <?php echo($check);?>>
					Con Visto Bueno
					<?php 
					$check='';
					}
					?>
					<input type="radio" class="required" name="estado" id="estado5" value="5" <?php echo($check);?>>
					Rechazar
					<?php
					$check='';
				}
				?>
				<input type="radio" class="required" name="estado" id="estado0" value="0" <?php echo($check);?>>
				Pendiente
				<input type="radio" class="required" name="estado" id="estado2" value="2">
				Terminada/Cerrada <label class="error" for="estado"></label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<input type='submit' class="btn btn-primary btn-mini" name="submit" id="submit" value="continuar">
				<input type="hidden" name="idtareas" value="<?php echo($_REQUEST['idtareas'])?>">
				<input type="hidden" name="guardar" value="1">
			</div>
		</div>
	</form>
</div>
<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>js/jquery.validate.1.13.1.js"></script>
<script>
	$(document).ready(function() {
		$("#formulario_tareas").validate();
	}); 
</script>