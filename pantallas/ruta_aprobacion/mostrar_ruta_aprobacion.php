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

if(@$_REQUEST["iddoc"] || @$_REQUEST["key"]){
	if(!@$_REQUEST["iddoc"])$_REQUEST["iddoc"]=@$_REQUEST["key"];
	include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
	menu_principal_documento($_REQUEST["iddoc"]);
	echo "<br/><br/><br/><br/>";
}

if (isset($_REQUEST["idruta_aprob"]) && $_REQUEST["idruta_aprob"]) {
	$ruta_aprob = busca_filtro_tabla("", "documento_ruta_aprob", "iddocumento_ruta_aprob=" . $_REQUEST["idruta_aprob"], "iddocumento_ruta_aprob desc", $conn);
	if ($ruta_aprob["numcampos"]) {
			$aprobacion_en = ($ruta_aprob[0]["aprobacion_en"]==1) ? "Aprobaci&oacute;n en serie" : "Aprobaci&oacute;n en paralelo" ;
			if (is_object($ruta_aprob[0]["fecha_creacion"])) {
				$fecha_creacion_ruta = $ruta_aprob[0]["fecha_creacion"] -> format("Y-m-d");
			} else {
				$fecha_creacion_ruta = $ruta_aprob[0]["fecha_creacion"];
			}
			$nom_creador_ruta = "";
			$creador_ruta = busca_filtro_tabla("nombres,apellidos", "funcionario", "idfuncionario=" . $ruta_aprob[0]["idfunc_creador"], "", $conn);
			if ($creador_ruta["numcampos"]) {
				$nom_creador_ruta = $creador_ruta[0]["nombres"] . " " . $creador_ruta[0]["apellidos"];
			}
			if (is_object($ruta_aprob[0]["fecha_vencimiento"])) {
				$fecha_venc_ruta = $ruta_aprob[0]["fecha_vencimiento"] -> format("Y-m-d");
			} else {
				$fecha_venc_ruta = $ruta_aprob[0]["fecha_vencimiento"];
			}
		
		
		$documento = busca_filtro_tabla("ejecutor,serie,iddocumento,fecha_creacion,descripcion", "documento", "iddocumento=" . $ruta_aprob[0]["documento_iddocumento"], "", $conn);
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
			$tareas_ruta = busca_filtro_tabla("v.nombres,v.apellidos,v.cargo,t.idtareas,t.accion_tareas,t.orden_tareas", "tareas t,vfuncionario_dc v", "t.responsable=v.iddependencia_cargo and t.ruta_aprob=".$_REQUEST["idruta_aprob"]." and t.documento_iddocumento=" . $documento[0]["iddocumento"], "idtareas asc", $conn);
			if ($tareas_ruta["numcampos"]) {
				$tabla .= '<table align="center" style="width: 90%;" class="table table-bordered">';
				$tabla .= '<thead>';
				$tabla .= '<tr><th style="text-align:center;">Funcionario</th> <th style="text-align:center;">Cargo</th> <th style="text-align:center;">Acciones</th></tr>';
				$tabla .= '</thead><tbody>';
				$equivalencia_acciones=array(1=>"APROBADO",2=>"VISTO BUENO");
				for ($i = 0; $i < $tareas_ruta["numcampos"]; $i++) {
					$tabla .= '<tr>';
					$tabla .= '<td>' . ucwords(strtolower($tareas_ruta[$i]["nombres"] . ' ' . $tareas_ruta[$i]["apellidos"])) . '</td> <td>' . $tareas_ruta[$i]["cargo"] . '</td>';
					$tabla .= '<td style="text-align:center"><a class="btn btn-mini btn-info highslide" href="'.$ruta_db_superior.'pantallas/tareas/adicionar_avance_tareas.php?idtareas='.$tareas_ruta[$i]["idtareas"].'" onclick=\'return hs.htmlExpand(this, { objectType: "iframe",width:500, height:500,preserveContent:false } )\'>'.$equivalencia_acciones[$tareas_ruta[$i]["accion_tareas"]].'</a></td>';
					$tabla .= '</tr>';
				}
				$tabla .= '</tbody></table>';
			}
		}else{
		echo "NO se encuentra informacion del Documento";
		die();
		}
	}else{
		echo "NO se encuentra informacion de las Aprobaciones";
		die();
	}
} else {
	die();
}

echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
echo(librerias_validar_formulario('11'));
echo(librerias_datepicker_bootstrap());
echo(librerias_highslide());
echo(librerias_notificaciones());
?>
<div class="container">
	<legend>Informaci&oacute;n del documento</legend>
	<br>
		<table align="center" style="width: 90%;" class="table table-bordered">
			<tr>
				<td><strong>Fecha de creaci&oacute;n</strong></td>
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
				<td colspan="3"><div class="label label-important" style="max-width:100px;">Pendiente</div></td>
			</tr>
			<tr>
				<td><strong>Descripci&oacute;n del documento</strong></td>
				<td colspan="3"><?php echo($documento[0]["descripcion"]); ?></td>
			</tr>			
		</table>
		
	<legend>Ruta de aprobaci&oacute;n</legend>
	<br>
		<table align="center" style="width: 90%;" class="table table-bordered">
			<tr>
				<td><strong>Fecha de creaci&oacute;n</strong></td>
				<td><?php echo($fecha_creacion_ruta); ?></td>
				<td><strong>Creado por</td>
				<td><?php echo($nom_creador_ruta); ?></td>
			</tr>
			
			<tr>
				<td><strong>Aprobaci&oacute;n en</strong></td>
				<td><?php echo $aprobacion_en;?></td>
				<td><strong>Fecha vencimiento</strong></td>
				<td><?php echo $fecha_venc_ruta;?></td>
			</tr>
			
			<tr>
				<td><strong>Asunto</strong></td>
				<td colspan="3"><?php echo $ruta_aprob[0]["asunto"];?></td>
			</tr>
			
			<tr>
				<td><strong>Descripci&oacute;n</strong></td>
				<td colspan="3"><?php echo $ruta_aprob[0]["descripcion"];?></td>
			</tr>			
		</table>	
		<?php echo $tabla;?>
</div>
<script type='text/javascript'>
  hs.graphicsDir = '<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
  hs.outlineType = 'rounded-white';
</script>