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

/*ADICIONAR*/
function obtener_valor_campos_estrat($idformato,$iddoc){
	
	$datos = busca_filtro_tabla("nombre,objetivo","ft_proceso","documento_iddocumento=".$_REQUEST['anterior'],"");
	?>
	<script type="text/javascript">
		$(document).ready(function(){		
			$("#proceso").val("<?php echo(codifica_encabezado(html_entity_decode($datos[0]['nombre'])));?>");		
			$("#objetivo").val('<?php echo(codifica_encabezado(html_entity_decode($datos[0]['objetivo'])));?>');				
		});
	</script>
	<?php		
}

/*MOSTRAR*/
function adiconar_factores_contexto($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$contexto_estrategico = busca_filtro_tabla("", "ft_contexto_extrategico A", "A.documento_iddocumento=" . $iddoc, "");
	$factores_contexto_estrategico = busca_filtro_tabla("", "ft_factores_contexto B", "B.ft_contexto_extrategico=" . $contexto_estrategico[0]['idft_contexto_extrategico'], "idft_factores_contexto ASC");
	for ($i = 0; $i < $factores_contexto_estrategico['numcampos']; $i++) {
		if ($factores_contexto_estrategico[$i]['factores_contexto'] == 1) {
			$internos .= '<tr>
				<td>' . html_entity_decode($factores_contexto_estrategico[$i]['descripcion']) . '</td>
				<td><a href="#" onclick="if(confirm(\'En realidad desea borrar este elemento?\')) window.location=\'' . $ruta_db_superior . 'formatos/librerias/funciones_item.php?formato=213&idpadre=' . $iddoc . '&accion=eliminar_item&tabla=ft_factores_contexto&id=' . $factores_contexto_estrategico[$i]['idft_factores_contexto'] . '\';"><img border=0 src="' . $ruta_db_superior . 'images/eliminar_pagina.png" /></a></td>			
		  </tr>';
		} else {
			$externos .= '<tr>
				<td>' . html_entity_decode($factores_contexto_estrategico[$i]['descripcion']) . '</td>							
				<td><a href="#" onclick="if(confirm(\'En realidad desea borrar este elemento?\')) window.location=\'' . $ruta_db_superior . 'formatos/librerias/funciones_item.php?formato=213&idpadre=' . $iddoc . '&accion=eliminar_item&tabla=ft_factores_contexto&id=' . $factores_contexto_estrategico[$i]['idft_factores_contexto'] . '\';"><img border=0 src="' . $ruta_db_superior . 'images/eliminar_pagina.png" /></a></td>
		  </tr>';
		}
	}

	$factores_internos = '<table border="1" style="border-collapse: collapse;width: 49%; float: left;">
	<tr>
		<td style="text-align: center;" colspan="2"><a href="' . $ruta_db_superior . 'formatos/factores_contexto/adicionar_factores_contexto.php?padre=' . $contexto_estrategico[0]['idft_contexto_extrategico'] . '&idformato=213&no_menu=1&tipo_factor=1">FACTORES INTERNOS</a></td>
	</tr>' . $internos . '
 </table>';

	$factores_externos = '<table border="1" style="border-collapse: collapse;width: 49%; float:right;">
	<tr>
		<td style="text-align: center;" colspan="2"><a href="' . $ruta_db_superior . 'formatos/factores_contexto/adicionar_factores_contexto.php?padre=' . $contexto_estrategico[0]['idft_contexto_extrategico'] . '&idformato=213&no_menu=1&tipo_factor=2">FACTORES EXTERNOS</a></td>
	</tr>' . $externos . '				
  </table>';

	echo($factores_internos);
	echo($factores_externos);
}
?>