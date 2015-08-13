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

function carga_nombre_responsable($idformato,$iddoc){

}

function muestra_campo_anexos($idformato,$iddoc){
	global $conn;

	$datos=busca_filtro_tabla("A.nombres, A.apellidos","funcionario A","A.funcionario_codigo=".usuario_actual("funcionario_codigo"),"",$conn);
	

	$funcionario=utf8_encode(html_entity_decode($datos[0]['nombres']." ".$datos[0]['apellidos']));
?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#nombre_responsable").val("<?php echo(utf8_encode(html_entity_decode($datos[0]['nombres']." ".$datos[0]['apellidos'])));?>");
	
		 	$("#MultiFile1").parent().parent().parent().hide();
			$("#nombre_responsable").parent().parent().hide();
			$("#anexos_solucion").parent().parent().hide();
			
			$("#soportes_anexos0").click(function(){
				$("#nexos_solucion0").parent().parent().parent().show();
				
			});
			
			$("#snexos_solucion1").click(function(){
				$("#MultiFile1").parent().parent().parent().hide();
				
			});
			$("#anexos_solucion0").click(function(){
				$("#MultiFile1").parent().parent().parent().show();
				console.log("ddd");
			});
			$("#anexos_solucion1").click(function(){
				$("#MultiFile1").parent().parent().parent().hide();
				console.log("ccc");
			});
			
		});
	</script>
<?php
}


 global $aprobacion;
global $implementado; 
 
function ruta_firma($idformato,$iddoc){
		
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

$datos_solucion=busca_filtro_tabla("implementado_por,aprobacion_logistica","ft_solucion_mantenimiento" ,"documento_iddocumento=".$iddoc,"",$conn);

$aprobacion=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia_cargo=".$datos_solucion[0]['aprobacion_logistica'],"",$conn);
$implementado=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia_cargo=".$datos_solucion[0]['implementado_por'],"",$conn);

$datos_papa=busca_filtro_tabla("c.ejecutor","ft_mantenimiento_locativo a, ft_solucion_mantenimiento b, documento c","b.ft_mantenimiento_locativo=a.idft_mantenimiento_locativo and a.documento_iddocumento=c.iddocumento and b.documento_iddocumento=".$iddoc,"",$conn);


$ruta=array();
array_push($ruta,array("funcionario"=>usuario_actual('funcionario_codigo'),"tipo_firma"=>0));
array_push($ruta,array("funcionario"=>$implementado[0]['funcionario_codigo'],"tipo_firma"=>1));
array_push($ruta,array("funcionario"=>$aprobacion[0]['funcionario_codigo'],"tipo_firma"=>1));
array_push($ruta,array("funcionario"=>$datos_papa[0]['ejecutor'],"tipo_firma"=>1));


	if(count($ruta)>0){
			
	$radicador_salida=busca_filtro_tabla("origen","buzon_entrada","archivo_idarchivo=".$iddoc,"idtransferencia 	desc",$conn);
		
		
array_push($ruta,array("funcionario"=>$radicador_salida[0][0],"tipo_firma"=>0)); 
phpmkr_query("update buzon_entrada set activo=0 where archivo_idarchivo=".$iddoc." and nombre='POR_APROBAR'");

insertar_ruta_aprobacion_documento($ruta,$iddoc);  
}
	
}

function transferencia_hijo($idformato,$iddoc){
	global $conn;

$destino=busca_filtro_tabla("c.ejecutor","ft_mantenimiento_locativo a, ft_solucion_mantenimiento b, documento c","b.ft_mantenimiento_locativo=a.idft_mantenimiento_locativo and a.documento_iddocumento=c.iddocumento and b.documento_iddocumento=".$iddoc,"",$conn);

//	transferencia_automatica($idformato,$iddoc,$destino[0]['ejecutor'],3,"Se ha aprobado el Documento");	
}

function fecha_firma_usuarios($idformato,$iddoc){
	global $conn;
$fecha_firma=busca_filtro_tabla("fecha","buzon_salida","nombre='revisado' and archivo_idarchivo='".$iddoc."'","",$conn);

	echo($fecha_firma[1]['fecha']."&nbsp;&nbsp;&nbsp;".$fecha_firma[2]['fecha']);
	
}

	
function fecha_firma_solicitante($idformato,$iddoc){
	global $conn;
$fecha_firma=busca_filtro_tabla("fecha","buzon_salida","nombre='aprobado' and archivo_idarchivo='".$iddoc."'","",$conn);
	echo($fecha_firma[0]["fecha"]);
	
}	
?>