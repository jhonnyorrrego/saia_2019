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


function obtener_valor_campos($idformato,$iddoc){
	global $conn;
	
	$datos = busca_filtro_tabla("nombre,objetivo","ft_proceso","documento_iddocumento=".$_REQUEST['anterior'],"",$conn);
?>
<script type="text/javascript">
	$(document).ready(function(){		
		$("#proceso").val("<?php echo(codifica_encabezado(html_entity_decode($datos[0]['nombre'])));?>");		
		$("#objetivo").val('<?php echo(codifica_encabezado(html_entity_decode($datos[0]['objetivo'])));?>');				
	});
</script>
<?php		
}


function mostrar_objetivo_contexto_estrategico($idformato,$iddoc){
    global $conn,$ruta_db_superior;
    
    $objetivo=busca_filtro_tabla("objetivo","ft_contexto_extrategico","documento_iddocumento=".$iddoc,"",$conn);
    
    $cadena=strip_tags(codifica_encabezado(html_entity_decode($objetivo[0]['objetivo'])));
    
    echo($cadena);
}

function adiconar_factores_contexto($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	
	$contexto_estrategico = busca_filtro_tabla("","ft_contexto_extrategico A","A.documento_iddocumento=".$iddoc,"",$conn);
	
	$factores_contexto_estrategico = busca_filtro_tabla("","ft_factores_contexto B","B.ft_contexto_extrategico=".$contexto_estrategico[0]['idft_contexto_extrategico'],"idft_factores_contexto ASC",$conn);		
	
	$idformato_item_factores_contexto=busca_filtro_tabla("idformato","formato","lower(nombre)='factores_contexto'","",$conn);
	for($i=0; $i<$factores_contexto_estrategico['numcampos']; $i++){
		
		$imagen_eliminar='';
		if($_REQUEST['tipo']!=5){
		    $imagen_eliminar='<img border=0 src="'.$ruta_db_superior.'images/eliminar_pagina.png" />';
		}
		 
		if($factores_contexto_estrategico[$i]['factores_contexto'] == 1){
			$internos .= '<tr>
							<td style="width:94%;">'.html_entity_decode($factores_contexto_estrategico[$i]['descripcion']).'</td>
							<td style="width:6%;"><a href="#" onclick="if(confirm(\'En realidad desea borrar este elemento?\')) window.location=\''.$ruta_db_superior.'formatos/librerias/funciones_item.php?formato='.$idformato_item_factores_contexto[0]['idformato'].'&idpadre='.$iddoc.'&accion=eliminar_item&tabla=ft_factores_contexto&id='.$factores_contexto_estrategico[$i]['idft_factores_contexto'].'\';">'.$imagen_eliminar.'</a></td>			
						  </tr>
						';
		}else{
			$externos .= '<tr>
							<td style="width:94%;">'.html_entity_decode($factores_contexto_estrategico[$i]['descripcion']).'</td>							
							<td style="width:6%;"><a href="#" onclick="if(confirm(\'En realidad desea borrar este elemento?\')) window.location=\''.$ruta_db_superior.'formatos/librerias/funciones_item.php?formato='.$idformato_item_factores_contexto[0]['idformato'].'&idpadre='.$iddoc.'&accion=eliminar_item&tabla=ft_factores_contexto&id='.$factores_contexto_estrategico[$i]['idft_factores_contexto'].'\';">'.$imagen_eliminar.'</a></td>
						  </tr>					  
						';
		}
	}
	
	$factores_internos = '<table border="1" style="border-collapse: collapse;width: 100%; float: left;">
				<tr>
					<td style="text-align: center;" colspan="2"><a href="'.$ruta_db_superior.'formatos/factores_contexto/adicionar_factores_contexto.php?padre='.$contexto_estrategico[0]['idft_contexto_extrategico'].'&idformato='.$idformato_item_factores_contexto[0]['idformato'].'&no_menu=1&tipo_factor=1">FACTORES INTERNOS</a></td>
				</tr>'.$internos.'
			 </table>
			';
			 
	$factores_externos = '<table border="1" style="border-collapse: collapse;width: 100%; float:right;">
				<tr>
					<td style="text-align: center;" colspan="2"><a href="'.$ruta_db_superior.'formatos/factores_contexto/adicionar_factores_contexto.php?padre='.$contexto_estrategico[0]['idft_contexto_extrategico'].'&idformato='.$idformato_item_factores_contexto[0]['idformato'].'&no_menu=1&tipo_factor=2">FACTORES EXTERNOS</a></td>
				</tr>'.$externos.'				
			  </table>
			 ';
			 
			 $tabla_factores_ini='<table border="0" style="border-collapse: collapse;width: 100%; float: left; vertical-align:top;"><tr><td style="width:50%;vertical-align:top;">'.$factores_internos.'</td><td style="width:50%;vertical-align:top;">'.$factores_externos.'</td></tr></table>';
			 
			 
			 echo($tabla_factores_ini);
			 
	        //echo($factores_internos);
	        //echo($factores_externos);
}

?>