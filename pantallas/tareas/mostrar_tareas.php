<?php
$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
		//Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "class_transferencia.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
echo(librerias_jquery("1.7"));
echo(librerias_highslide());
echo(estilo_bootstrap());

$tarea = busca_filtro_tabla("tarea,fecha,responsable,prioridad,fecha_tarea,descripcion", "tareas", "idtareas=".$_REQUEST['idtareas'], "", $conn);
$responsable = busca_filtro_tabla("nombres,apellidos", "vfuncionario_dc", "iddependencia_cargo=" . $tarea[0]['responsable'], "", $conn);
switch ($tarea[0]['prioridad']) {
	case 0 :
		$prioridad = "Baja";
		break;
	case 1 :
		$prioridad = "Media";
		break;
	case 2 :
		$prioridad = "Alta";
		break;
}
$busca_avances=busca_filtro_tabla("a.fecha,a.descripcion,a.estado,b.nombres,b.apellidos","tareas_avance a, vfuncionario_dc b","a.ejecutor=b.funcionario_codigo AND a.tareas_idtareas=".$_REQUEST['idtareas'],"GROUP BY a.fecha,a.descripcion,a.estado,b.nombres,b.apellidos ORDER BY fecha DESC",$conn);


if((@$_REQUEST["iddoc"] || @$_REQUEST["key"])&& !@$_REQUEST["idpaso_documento"]){
	if(!$_REQUEST["iddoc"])$_REQUEST["iddoc"]=@$_REQUEST["key"];
	include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
	menu_principal_documento($_REQUEST["iddoc"]);
}
?>
<div class="container">
		<div class="control-group" nombre="etiqueta">
			<legend>Asignar tarea al documento</legend>
		</div>
		<div class="control-group">
			<span class="control-label"><b>Fecha:</b> <?php echo($tarea[0]['fecha']); ?></span>
		</div>
		<div class="control-group">
			<span class="control-label" for="etiqueta"><b>Responsable:</b> <?php echo($responsable[0]['nombres'] . " " . $responsable[0]['apellidos']); ?></span>
		</div>
		<div class="control-group">
			<span class="control-label" for="etiqueta"><b>Tarea a realizar:</b> <?php echo(html_entity_decode($tarea[0]['tarea'])); ?></span>
		</div>
		<div class="control-group">
			<span class="control-label" for="etiqueta"><b>Descripci&oacute;n:</b> <?php echo(html_entity_decode($tarea[0]['descripcion'])); ?></span>
		</div>
		<div class="control-group">
			<span class="control-label" for="etiqueta"><b>Prioridad:</b> <?php echo($prioridad); ?></span>
		</div>
		<div class="control-group">
			<span class="control-label" for="etiqueta"><b>Fecha tarea:</b> <?php echo($tarea[0]['fecha_tarea']); ?></span>
		</div>
		<div class="control-group">
			<a class="previo_high" enlace="pantallas/tareas/adicionar_avance_tareas.php?idtareas=<?php echo($_REQUEST['idtareas']); ?>">
				<!--img width="16px" border="0" src="<?php echo($ruta_db_superior); ?>botones/formatos/adicionar.gif"-->Adicionar Avances
			</a>
			<div class="table-responsive">
				<table class="table">
					<tbody>
						<tr>
							<th class="prettyprint">Fecha y Hora</th>
							<th class="prettyprint">Descripci&oacute;n</th>
							<th class="prettyprint">Estado</th>
							<th class="prettyprint">Funcionario</th>
						</tr>
						<?php
							for($i=0;$i<$busca_avances['numcampos'];$i++){
								switch ($busca_avances[$i]['estado']) {
									case 0 :
										$estado = "Pendiente";
										$color="orange";
										break;
									case 1 :
										$estado = "Proceso";
										$color="orange";
										break;
									case 2 :
										$estado = "Terminada";
										$color="green";
									break;
							}
								$campo.="<tr>
											<td>".$busca_avances[$i]['fecha']."</td>
											<td>".$busca_avances[$i]['descripcion']."</td>
											<td style='color:".$color."'>".$estado."</td>
											<td>".$busca_avances[$i]['nombres']." ".$busca_avances[$i]['apellidos']."</td>
										</tr>";
							}
							echo($campo);
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			
			$(".previo_high").click(function(e){
				var enlace=$(this).attr("enlace");
				top.hs.htmlExpand(this, { objectType: 'iframe',width: 350, height: 350,contentId:'cuerpo_paso', preserveContent:false, src:enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});
			});
			top.hs.Expander.prototype.onAfterClose = function() {
				window.location = "pantallas/tareas/mostrar_tareas.php?idtareas=<?php echo($_REQUEST['idtareas']); ?>";
			}
		});
	</script>