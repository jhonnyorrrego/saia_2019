<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
$iddoc=@$_REQUEST["iddoc"];
menu_principal_documento($iddoc,1);
$datos=busca_filtro_tabla("pdf,plantilla","documento A","A.iddocumento=".$iddoc,"",$conn);

$exportar_pdf=busca_filtro_tabla("valor","configuracion A","A.nombre='exportar_pdf'","",$conn);
$export="";
if($exportar_pdf[0]["valor"]=='html2ps'){
	$export="exportar_impresion.php?iddoc=".$iddoc."&plantilla=".strtolower($datos[0]["plantilla"]);
}
else if($exportar_pdf[0]["valor"]=='class_impresion'){
	$export="class_impresion.php?iddoc=".$iddoc;
}
else{
	$export="exportar_impresion.php?iddoc=".$iddoc."&plantilla=".strtolower($datos[0]["plantilla"]);
}

if(@$_REQUEST["actualizar_pdf"]==1){
	$sql1="UPDATE documento SET pdf=null WHERE iddocumento=".$iddoc;
	phpmkr_query($sql1);
	$datos[0]["pdf"]="";
}

$pdf=$ruta_db_superior.$export;
if(@$_REQUEST["vista"]){
	$pdf.="&vista=".$_REQUEST["vista"];
}
if($datos[0]["pdf"] && is_file($ruta_db_superior.$datos[0]["pdf"]) && !@$_REQUEST["vista"] ){
	$pdf=$ruta_db_superior.$datos[0]["pdf"];
}
?>
<script>
$(document).ready(function(){
	var alto_menu=$("#menu_principal_documento").height();
	if(parseInt(alto_menu)>=0){
		var alto=($(document).height());
		$("#detalles").height((alto-alto_menu)-20);
	}
	else{
		var alto=($(document).height());
		$("#detalles").height(alto-20);
	}
});
</script>
<iframe id="detalles" width="100%" frameborder="0" name="detalles" src="<?php echo($pdf); ?>"></iframe>