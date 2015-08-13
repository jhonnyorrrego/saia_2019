<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
	while($max_salida>0){
	  if(is_file($ruta."db.php")){
	    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	  }
	  $ruta.="../";
	  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

function cargar_item_evolucion($idformato,$iddoc){
	global $conn,$ruta_db_superior;

$idft=busca_filtro_tabla("idft_diagnostico_tratamiento","ft_diagnostico_tratamiento","documento_iddocumento=".$iddoc,"",$conn);

if($_REQUEST["tipo"]!=5){
	$agregaritem='<a href="../evolucion_tratamiento/adicionar_evolucion_tratamiento.php?pantalla=padre&idpadre='.$iddoc.'&idformato='.$idformato.'&padre='.$idft[0]['idft_diagnostico_tratamiento'].'">
	<img width="16px" border="0" src="../../botones/formatos/adicionar.gif">Adicionar Evolucion de tratamiento</a><br /><p> </p>';
	
	echo($agregaritem);
}

$datos_item=busca_filtro_tabla("b.*","ft_diagnostico_tratamiento a, ft_evolucion_tratamiento b","a.idft_diagnostico_tratamiento=b.ft_diagnostico_tratamiento and a.documento_iddocumento=".$iddoc,"",$conn);

	for($i=0;$i<$datos_item['numcampos'];$i++){
		
		if($_REQUEST["tipo"]!=5){
		$item_evolucion.='<a href="'.$ruta_db_superior.'formatos/evolucion_tratamiento/editar_evolucion_tratamiento.php?idformato='.$idformato.'&item='.$datos_item[$i]['idft_evolucion_tratamiento'].'">
						<img border=0 src="'.$ruta_db_superior.'botones/intermedio/editar_documento.png" /></a>
						<img class="eliminar_compromiso"  idft_item="'.$datos_item[$i]['idft_evolucion_tratamiento'].'" border="0" src="'.$ruta_db_superior.'images/eliminar_pagina.png">';
		}
		
		$item_evolucion.=('<br>
		<table style="border-collapse: collapse; width: 100%;" border="1">
		<tbody>
		<tr>
		<td style="width: 20%; text-align: center;">Fecha/Hora</td>
		<td style="width: 20%; text-align: center;">&nbsp;Procedimiento realizado</td>
		<td style="width: 20%; text-align: center;">&nbsp;Firma paciente</td>
		<td style="width: 20%; text-align: center;">&nbsp;Firma profesional</td>
		<td style="width: 20%; text-align: center;">&nbsp;Abonos / Saldo</td>
		</tr>
		<tr>
		<td>'.$datos_item[$i]["fecha_evolucion"].'</td>
		<td>'.html_entity_decode($datos_item[$i]["procedimiento_evolucion"]).'</td>
		<td>'.$datos_item[$i]["firma_paciente"].'</td>
		<td>'.$datos_item[$i]["firma_profesional"].'</td>
		<td>'.$datos_item[$i]["abono_evoluciones"].'</td>
		</tr>
		</tbody>
		</table>	
		<br>
		<p> </p>	
		');
	}
	echo($item_evolucion);

	
	
?>
<script type="text/javascript">
	$(document).ready(function(){
					
					$(".eliminar_compromiso").click(function(){						
						var id_item_compromiso=$(this).attr("idft_item"); 
						if(confirm("En realilidad desea eliminar este elemento?")){
																	
							window.location="../librerias/funciones_item.php?formato=<?php echo($idformato); ?>&idpadre=<?php echo($iddoc); ?>+&accion=eliminar_item&tabla=ft_evolucion_tratamiento&id="+id_item_compromiso;							
						}
					});
				});
	
	
	
</script>
<?php
}

function cargar_diagnosticado($idformato,$iddoc){
	global $conn;
	
	if($_REQUEST["anterior"]){
		$nombre_paciente=busca_filtro_tabla("a.nombre_paciente","ft_solicitud_cita a","a.documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
		$nombre_paciente=utf8_encode(html_entity_decode($nombre_paciente[0]["nombre_paciente"]));
	}

	if($_REQUEST["iddoc"]){
		$nombre_paciente=busca_filtro_tabla("a.nombre_diagnosticado","ft_diagnostico_tratamiento a","a.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
		$nombre_paciente=utf8_encode(html_entity_decode($nombre_paciente[0]["nombre_diagnosticado"]));
	}
	
	//print_r(busca_filtro_tabla("a.nombre_diagnosticado","ft_diagnostico_tratamiento a","a.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn));
	
	
	
?>
<script type="text/javascript">
	$(document).ready(function(){
		
		var nombre="<?php echo($nombre_paciente);?>";
		
		$("#nombre_diagnosticado").attr("value",nombre);
		$("#nombre_diagnosticado").attr("readonly",true);
		
	});

</script>
<?php
}

?>