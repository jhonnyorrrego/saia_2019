<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_notificaciones.php");

echo(estilo_bootstrap());

if(array_key_exists('iddocumento_version',$_REQUEST)){		
	$versiones = busca_filtro_tabla("b.idanexos_version, b.ruta,b.etiqueta,b.tipo,b.version_numero","documento_version a, anexos_version b, version_pivote_anexo c","a.iddocumento_version=c.iddocumento_version and b.idanexos_version=c.idanexos_version and a.iddocumento_version=".$_REQUEST["iddocumento_version"],"a.numero_version DESC",$conn);	
}else{
	$versiones = busca_filtro_tabla("b.idanexos_version, b.ruta,b.etiqueta,b.tipo,b.version_numero","documento_version a, anexos_version b, version_pivote_anexo c","a.iddocumento_version=c.iddocumento_version and b.idanexos_version=c.idanexos_version and a.documento_iddocumento=".$_REQUEST["iddocumento"],"a.numero_version DESC",$conn);
}




if($_REQUEST["carga_inicial"]==1){
	$versiones = busca_filtro_tabla("","documento_version a, anexos b","a.documento_iddocumento=b.documento_iddocumento and carga_inicial=1 and a.documento_iddocumento=".$_REQUEST["iddocumento"],"",$conn);
	
	//if(usuario_actual("login")=="0k")
	//print_r($versiones);
	
	$pdf_version=busca_filtro_tabla("","documento_version a, documento b","a.documento_iddocumento=b.iddocumento and a.documento_iddocumento=".$_REQUEST["iddocumento"],"",$conn);
	$tabla = 	"<table class='table table-bordered table-striped'>
					<thead>
					<tr>                  
						<th>Versi&oacute;n</th>
						<th>Documento</th>
						<th>Tipo documento</th>
						<th>Ver</th>
					</tr>
					</thead>
					<tbody>";							
													
					for($i=0; $i < $versiones["numcampos"]; $i++){
						$tabla .= "<tr>";		
						$tabla .= "<td>".$versiones[$i]["numero_version"]."</td>"; 
						$tabla .= "<td>".$versiones[$i]["etiqueta"]."</td>"; 
						$tabla .= "<td>".strtoupper($versiones[$i]["tipo"])."</td>"; 
						$tabla .= '<td>'.obtener_funciones_anexo($versiones[$i]["idanexos"],$versiones[$i]["tipo"],$versiones[$i]["ruta"],$versiones[$i]["etiqueta"]).'</td>';									
						$tabla .= "</tr>";
						}
					if($pdf_version[0]["pdf"]!=""){
						$tabla .= "<tr>";		
						$tabla .= "<td>".$pdf_version[0]["numero_version"]."</td>"; 
						$tabla .= "<td>PDF</td>"; 
						$tabla .= "<td>".strtoupper("pdf")."</td>"; 
						$tabla .= '<td>'.obtener_funciones_anexo($pdf_version[0]["idanexos"],"pdf",$pdf_version[0]["pdf"],"etiqueta_pdf").'</td>';									
						$tabla .= "</tr>";
					}
					
					$tabla .="</tbody>
					</table>";
	
}else{
	if($versiones["numcampos"]){
	
		$tabla = 	"<table class='table table-bordered table-striped'>
					<thead>
					<tr>                  
						<th>Versi&oacute;n</th>
						<th>Documento</th>
						<th>Tipo documento</th>
						<th>Ver</th>
					</tr>
					</thead>
					<tbody>";							
													
					for($i=0; $i < $versiones["numcampos"]; $i++){
						$tabla .= "<tr>";		
						$tabla .= "<td>".$versiones[$i]["version_numero"]."</td>"; 
						$tabla .= "<td>".$versiones[$i]["etiqueta"]."</td>"; 
						$tabla .= "<td>".strtoupper($versiones[$i]["tipo"])."</td>"; 
						$tabla .= '<td>'.obtener_funciones_anexo($versiones[$i]["idanexos_version"],$versiones[$i]["tipo"],$versiones[$i]["ruta"],$versiones[$i]["etiqueta"]).'</td>';									
						$tabla .= "</tr>";
						//<div class="link btn btn-large btn-mini btn-primary kenlace_saia" enlace="'.$versiones[$i]["ruta"].'" conector="iframe" titulo="'.$versiones[$i]["etiqueta"].'">Ver</div>	
						}
					$tabla .="</tbody>
					</table>";
						
						
	}else{
		notificaciones("<b>El documento no posee versiones.</b>","warning",11500);
		//volver(1);
	}
}
echo($tabla);
echo(librerias_jquery("1.7"));
echo(librerias_acciones_kaiten());
echo(librerias_highslide());
?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".abrir_highslide").click(function(){
			var ruta = $(this).attr("ruta");
			
			hs.graphicsDir = '<?php echo($ruta_db_superior); ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
			hs.outlineType = 'rounded-white';
	
			top.hs.htmlExpand( this, {
						src: ruta,					
						objectType: 'iframe', 
						outlineType: 'rounded-white', 
						wrapperClassName: 'highslide-wrapper drag-header', 
						preserveContent: false,
						align: 'center',						
						width: 935,						
						height: $(this).attr("alto")								 
			});    					
		});			
	});
</script>