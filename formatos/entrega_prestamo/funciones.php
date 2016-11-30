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
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");


/*MOSTRAR*/
function solicitante_funcion($idformato, $iddoc) {
	global $conn;
	$nombre_padre = busca_filtro_tabla("d.nombres, d.apellidos", "ft_entrega_prestamo a, ft_solicitud_prestamo b, documento c, funcionario d", "a.ft_solicitud_prestamo=b.idft_solicitud_prestamo and b.documento_iddocumento=c.iddocumento and c.ejecutor=d.funcionario_codigo and a.documento_iddocumento=" . $iddoc, "", $conn);
	if ($nombre_padre["numcampos"]) {
		echo "<b>" . $nombre_padre[0]["nombres"] . " " . $nombre_padre[0]["apellidos"] . "</b>";
	}
}

function documento_funcion($idformato, $iddoc) {
	global $conn;
	$documento = busca_filtro_tabla("documento_solicita", "ft_entrega_prestamo a, ft_solicitud_prestamo b", "a.ft_solicitud_prestamo=b.idft_solicitud_prestamo and a.documento_iddocumento=" . $iddoc, "", $conn);
	if ($documento["numcampos"]) {
		echo "<b>" . strip_tags($documento[0]["documento_solicita"]) . "</b>";
	}
}

function devolucion_docu($idformato, $iddoc) {
	global $conn;
	$estado_boton = busca_filtro_tabla("usuario_devolucion, " . fecha_db_obtener("fecha_devolucion", 'Y-m-d H:i:s') . " as fecha, estado_devolucion, b.estado, a.observaciones_devolu", "ft_entrega_prestamo a, documento b", "a.documento_iddocumento=b.iddocumento and a.documento_iddocumento=" . $iddoc, "", $conn);

	if ($estado_boton[0]["estado_devolucion"] == 1) {
		$funcionario = busca_filtro_tabla("nombres, apellidos", "funcionario a", "a.idfuncionario=" . $estado_boton[0]["usuario_devolucion"], "", $conn);
		$boton = "<b>Usuario que realiza la devolucion:</b> " . ucwords(strtolower($funcionario[0]['nombres'] . " " . $funcionario[0]['apellidos'])) . "<br><b>Observaciones:</b> " . $estado_boton[0]["observaciones_devolu"] . "<br><b>Fecha devoluci&oacute;n:</b> " . $estado_boton[0]["fecha"];
	} else if (!$estado_boton[0]["estado_devolucion"] && $estado_boton[0]["estado"] != 'ACTIVO' && @$_REQUEST['tipo'] != 5) {
		/*$padre = busca_filtro_tabla("B.documento_archivo", "ft_entrega_prestamo A, ft_solicitud_prestamo B", "A.ft_solicitud_prestamo=B.idft_solicitud_prestamo AND A.documento_iddocumento=" . $iddoc, "", $conn);
		if ($padre[0]["documento_archivo"] == 1) {
			$archivo = busca_filtro_tabla("A.funcionario_codigo", "vfuncionario_dc A", "lower(cargo) like 'coordinador(a) archivo' and funcionario_codigo=".usuario_actual('funcionario_codigo'), "", $conn);
			if ($archivo["numcampos"] && $estado_boton[0]['prestamo_expediente']==1) {
				$boton = "<button id='devolucion_prestamo'>Devolucion</button><span id='mensaje_devolucion'></span>";
			}
		} else if ($padre[0]["documento_archivo"] == 2) {
			$autorizador = busca_filtro_tabla("idfuncionario", "ft_entrega_prestamo ep,ft_solicitud_prestamo sp,vfuncionario_dc v", "sp.idft_solicitud_prestamo=ep.ft_solicitud_prestamo and v.iddependencia_cargo=persona_autoriza and ep.documento_iddocumento=" . $iddoc, "", $conn);
			if ($autorizador[0][0] == usuario_actual("idfuncionario") && $estado_boton[0]['prestamo_expediente']==1) {
				$boton = "<button id='devolucion_prestamo'>Devolucion</button><span id='mensaje_devolucion'></span>";
			}
		}*/
		$boton = "<button id='devolucion_prestamo' class='btn btn-danger'>Devoluci&oacute;n</button><span id='mensaje_devolucion'></span>";
	}
	echo($boton);
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#devolucion_prestamo").click(function(){
			var observaciones=prompt("Observaciones:");
			if(observaciones!=null){
				$.ajax({
				  url: 'cambiar_estado_prestamo.php',
				  type: 'POST',
				 	data:"iddocumento=<?php echo $iddoc; ?>&observacion="+observaciones,
				 	success:function(mensaje){
				 		$("#devolucion_prestamo").hide();
						$("#mensaje_devolucion").html(mensaje);
					}
				});
			}
		});
	});
</script>
<?php	
}

function transferir_documento_padre($idformato, $iddoc) {
	global $conn,$ruta_db_superior;
	$datos_padre = busca_filtro_tabla("C.iddocumento,D.idformato,C.ejecutor", "ft_entrega_prestamo A, ft_solicitud_prestamo B, documento C, formato D", "A.ft_solicitud_prestamo=B.idft_solicitud_prestamo AND B.documento_iddocumento=C.iddocumento AND lower(C.plantilla)=lower(D.nombre) AND A.documento_iddocumento=" . $iddoc, "", $conn);
	if ($datos_padre["numcampos"]) {
		$idformato2 = $datos_padre[0]["idformato"];
		$iddoc2 = $datos_padre[0]["iddocumento"];
		transferencia_automatica($idformato2, $iddoc2, $datos_padre[0]["ejecutor"], 3);
	}
}



function mostrar_responsable_solicitud($idformato,$iddoc) {
	global $conn,$ruta_db_superior;
//echo(5555);
$datos_solicitud = busca_filtro_tabla("a.documento_iddocumento AS iddoc","ft_solicitud_prestamo a, ft_entrega_prestamo b","a.idft_solicitud_prestamo=b.ft_solicitud_prestamo AND b.documento_iddocumento=".$iddoc,"",$conn);
//return($datos_solicitud);

 $solicitante=busca_filtro_tabla("e.archivo_idarchivo,e.nombre,e.destino,e.origen","buzon_entrada e","e.archivo_idarchivo=".$datos_solicitud[0]['iddoc']." AND e.nombre='APROBADO'","e.fecha DESC",$conn);
	 
	 //return($solicitante['sql']);
	 $nombre_solicitante=busca_filtro_tabla("nombres,apellidos","vfuncionario_dc","funcionario_codigo=".$solicitante[0]['destino'],"",$conn);

	$nombre=$nombre_solicitante[0]['nombres']." ".$nombre_solicitante[0]['apellidos'];
	
	if($nombre != ""){
		echo ("Responsable de la solicitud: ".$nombre."<br />");
	}

}




?>