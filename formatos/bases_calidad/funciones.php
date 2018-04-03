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
include_once ($ruta_db_superior . "librerias_saia.php");

/*ADICIONAR - EDITAR*/
function add_edit_bases_calidad($idformato, $iddoc) {
	global $conn,$ruta_db_superior;
	if($_REQUEST["iddoc"]){
		$opt=1;
		$datos = busca_filtro_tabla("tipo_base_calidad", "ft_bases_calidad a, documento b", "b.iddocumento=a.documento_iddocumento AND b.estado not in ('ELIMINADO','ANULADO','ACTIVO') and b.iddocumento<>".$_REQUEST["iddoc"], "", $conn);
	}else{
		$opt=0;
		$datos = busca_filtro_tabla("tipo_base_calidad", "ft_bases_calidad a, documento b", "b.iddocumento=a.documento_iddocumento AND b.estado not in ('ELIMINADO','ANULADO','ACTIVO')", "", $conn);
	}
	if($datos["numcampos"]){
		$tipos_existentes = implode(',', (extrae_campo($datos, 'tipo_base_calidad')));
	}
	$idserie_mapa=busca_filtro_tabla("idserie","serie","lower(nombre) LIKE 'mapa%procesos'","",$conn);
	?>
	<script>
	$(document).ready(function(){
		var idmapa_proc=parseInt(<?php echo $idserie_mapa[0]["idserie"]; ?>);
		var registros='<?php echo($tipos_existentes); ?>';
		var vector_registros=registros.split(',');
		var cantidad=parseInt(<?php echo($datos["numcampos"]); ?>);
		for(i=0;i<cantidad;i++){
			$('[name="tipo_base_calidad"][value="'+vector_registros[i]+'"]').parent().parent().css('pointer-events','none').css('color','green');
		}
		
		$("#tr_anexo_soporte").hide();
		$("[name='tipo_base_calidad']").change(function (){
			if($(this).val()==idmapa_proc){
				$("#tr_anexo_soporte").show();
			}else{
				$("#tr_anexo_soporte").hide();
			}
		});
		$("[name='tipo_base_calidad']:checked").trigger("change");		
	});
	</script>
	<?php  
}


/*MOSTRAR*/
function ver_anexo_mapa($idformato, $iddoc) {
	global $conn;
	$html = "";
	$datos=busca_filtro_tabla("s.nombre","ft_bases_calidad ft,serie s","ft.tipo_base_calidad=s.idserie and ft.documento_iddocumento=".$iddoc,"",$conn);
	if (trim(strtolower($datos[0]['nombre'])) == 'mapa de procesos') {
		$html="</td></tr> <tr><td>Mapa del Proceso</td> <td>".mostrar_valor_campo('anexo_soporte', $idformato, $iddoc, 1);
	}
	echo $html;
}
?>