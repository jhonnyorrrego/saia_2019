<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."class_transferencia.php");
if($_REQUEST["docs"])
{$valores=substr($_REQUEST["docs"],0,-1);

 $sql="update ft_recibo_caja_menor set fecha_remision=".fecha_db_almacenar("","Y-m-d H:i:s").",usuario_remision='".usuario_actual("nombres")." ".usuario_actual("apellidos")."' where documento_iddocumento in($valores)";
 phpmkr_query($sql);
 //alerta(codifica_encabezado("Se ha registrado la causaci�n."));
 //--------------Terminar flujo------------------------
 if(strpos($_REQUEST["docs"],",")){
 	$documentos = explode(",",$_REQUEST["docs"]);
 }
 else {
     $documentos[0] = $_REQUEST["docs"];
 }
 $cantidad = count($documentos);
 
 for($i=0;$i<$cantidad;$i++){
 	if($documentos[$i] != ''){
 		$doc = busca_filtro_tabla("a.documento_iddocumento as doc","ft_solicitud_gastos_caja_menor a,ft_recibo_caja_menor b","b.documento_iddocumento=".$documentos[$i]." and ft_solicitud_gastos_caja_menor=idft_solicitud_gastos_caja_menor","",$conn);
 		$iddoc = $doc[0]["doc"];
 		
	 	$paso = busca_filtro_tabla("","paso_documento","documento_iddocumento=".$iddoc,"idpaso_documento desc",$conn);
	 	terminar_actividad_paso($iddoc,'',2,$paso[0]["idpaso_documento"],25);
		$formato = busca_filtro_tabla("","formato","nombre like '%solicitud_gastos_caja_menor%'","",$conn);
		$actividad = busca_filtro_tabla("","paso_actividad","idpaso_actividad=26","",$conn);
		$datos = buscar_entidad_asignada($actividad[0]["entidad_identidad"],$actividad[0]["llave_entidad"]);
		if(@$datos["id"] != 0){
			if($actividad[0]["entidad_identidad"] == 1){
				//print_r($formato[0]["idformato"].','.$documentos[$i].','.$actividad[0]["llave_entidad"].',3');
				transferencia_automatica($formato[0]["idformato"],$iddoc,$actividad[0]["llave_entidad"].'@',3);
				//print_r("transfirio");
			}
		}
	}
 }
 redirecciona("reciboslist.php?tipo=".$_REQUEST["tipo"]);
}
?>