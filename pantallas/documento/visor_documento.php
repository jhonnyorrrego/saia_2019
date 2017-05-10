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
$datos=busca_filtro_tabla("A.pdf,A.plantilla,B.mostrar_pdf","documento A,formato B","lower(A.plantilla)=B.nombre AND A.iddocumento=".$iddoc,"",$conn);

if($iddoc && !@$_REQUEST['pdf_word'] && $datos[0]['mostrar_pdf']!=2){
$exportar_pdf=busca_filtro_tabla("valor","configuracion A","A.nombre='exportar_pdf'","",$conn);
$export="";
$ruta_visor="visores/pdf/web/viewer2.php?iddocumento=".$iddoc;
if($exportar_pdf[0]["valor"]=='html2ps'){
	$export="exportar_impresion.php?iddoc=".$iddoc."&plantilla=".strtolower($datos[0]["plantilla"])."&rand=".rand(1,100000);
}
else if($exportar_pdf[0]["valor"]=='class_impresion'){
	$export="class_impresion.php?iddoc=".$iddoc."&rand=".rand(1,100000);
}
else{
	$export="exportar_impresion.php?iddoc=".$iddoc."&plantilla=".strtolower($datos[0]["plantilla"])."&rand=".rand(1,100000);
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
	//$pdf=$ruta_db_superior.$datos[0]["pdf"];
	$pdf=$ruta_db_superior.$ruta_visor;
}
} else {
	  $anexos_documento_word=busca_filtro_tabla("d.ruta","documento a, formato b, campos_formato c, anexos d","lower(a.plantilla)=b.nombre AND b.idformato=c.formato_idformato AND c.nombre='anexo_word' AND c.idcampos_formato=d.campos_formato AND a.iddocumento=".$iddoc." AND d.documento_iddocumento=".$iddoc,"",$conn) ;
	  
	  
	  if($anexos_documento_word['numcampos']){
	    $ruta_almacenar=explode('anexos',$anexos_documento_word[0]["ruta"]);
	    $pdf=$ruta_db_superior.$ruta_almacenar[0].'docx/documento_word.pdf';	  	
	  }

	
	if(!file_exists($pdf)){
		$documento=busca_filtro_tabla("","documento a, formato b","lower(a.plantilla)=b.nombre AND a.iddocumento=".$iddoc,"",$conn);
		$ruta_mostrar=$ruta_db_superior.'formatos/'.$documento[0]['nombre'].'/'.$documento[0]['ruta_mostrar'].'?idformato='.$documento[0]['idformato'].'&iddoc='.$iddoc;
		include_once($ruta_db_superior."db.php");
		abrir_url($ruta_mostrar,'_self');
		die();
	}
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
