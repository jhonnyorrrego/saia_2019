<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	} $ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once($ruta_db_superior.'librerias_saia.php');
	global $raiz_saia;
	$raiz_saia=$ruta_db_superior;



function mostrar_nombre($nombre, $idejecutor) {
	global $conn;
	$texto = "<span class='link kenlace_saia' conector='iframe' enlace='pantallas/remitente/mostrar_datos_ejecutor.php?idejecutor=" . $idejecutor . "' titulo='" . $nombre . "'><b>Empresa:</b> " . $nombre . "</span>";
	return ($texto);
}
function barra_inferior_remitente($idejecutor){
	$texto='<br/><div class="btn-group pull"><button type="button" class="btn btn-mini tooltip_saia adicionar_seleccionados" title="Seleccionar" idregistro="'.$idejecutor.'"><i class="icon-uncheck"></i></button></div>';
	return($texto);
}

function activar_remitentes(){
	global $ruta_db_superior;
  $texto=librerias_notificaciones().'<li><a href="#" id="activar_remitente">Activar Remitente</a></li>';
	$texto.='<script>
	$("#activar_remitente").click(function(){
		var seleccionados=$("#seleccionados").val();
		if(seleccionados!=""){
			$.ajax({
				type : "POST",
				async : false,
				dataType: "json",
				url: "'.$ruta_db_superior.'pantallas/remitente/ejecutar_acciones.php",
				data : "ejecutar_remitente=actualizar_estado_remitente&tipo_retorno=1&rand=" + Math.round(Math.random() * 100000) + "&" + "estado=1&idejecutores="+seleccionados,
				success : function(objeto) {
					if (objeto.exito) {
						notificacion_saia(objeto.mensaje, "success", "", 2500);
						window.open("'.$ruta_db_superior.'pantallas/buscador_principal.php?idbusqueda=50","_parent");
					}else{
						notificacion_saia(objeto.mensaje, "error", "", 2500);
						return false;
					}
				}
			});
		}else{
			alert("Seleccione los remitentes");
		}
	});
	</script>';
  return $texto;
} 

function inactivar_remitentes(){
	global $ruta_db_superior;
  $texto=librerias_notificaciones().'<li><a href="#" id="inactivar_remitente">Inactivar Remitente</a></li>';
	$texto.='<script>
	$("#inactivar_remitente").click(function(){
		var seleccionados=$("#seleccionados").val();
		if(seleccionados!=""){
			$.ajax({
				type : "POST",
				async : false,
				dataType: "json",
				url: "'.$ruta_db_superior.'pantallas/remitente/ejecutar_acciones.php",
				data : "ejecutar_remitente=actualizar_estado_remitente&tipo_retorno=1&rand=" + Math.round(Math.random() * 100000) + "&" + "estado=0&idejecutores="+seleccionados,
				success : function(objeto) {
					if (objeto.exito) {
						notificacion_saia(objeto.mensaje, "success", "", 2500);
						window.open("'.$ruta_db_superior.'pantallas/buscador_principal.php?idbusqueda=50","_parent");
					}else{
						notificacion_saia(objeto.mensaje, "error", "", 2500);
						return false;
					}
				}
			});
		}else{
			alert("Seleccione los remitentes");
		}
	});
	</script>';
  return $texto;
} 
?>
