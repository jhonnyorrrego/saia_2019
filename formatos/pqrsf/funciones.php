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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php"); 
include_once("../clasificacion_pqrsf/funciones.php");

/*ADICIONAR-EDITAR*/
function ver_mensajes (){
global $ruta_db_superior;
$enlaces='<a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 500, height:250,preserveContent:false } )" href="mensaje.php">Ayuda</a>';
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>

<script>
$("#tipo0").parent().parent().parent().parent().parent().parent().append('<a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 500, height:400,preserveContent:false } )" href="mensaje.php">Ayuda</a> ');
</script>
<?php	
}

function validar_email(){
?>
<script>
	$("#email").addClass("required email");
</script>
<?php	
}

/*MOSTRAR*/
function ver_fecha_reporte($idformato,$iddoc){
	global $conn;
	$fecha=busca_filtro_tabla(fecha_db_obtener("Y-m-d","fecha_reporte"),"ft_pqrsf","documento_iddocumento=".$iddoc,"",$conn);
	echo($fecha[0]['fecha_reporte']);
}

function mostrar_datos_hijos($idformato,$iddoc){
global $conn;	
$ft_papa=busca_filtro_tabla("idft_pqrsf","ft_pqrsf","documento_iddocumento=".$iddoc,"",$conn);
$clasificacion=busca_filtro_tabla("","ft_clasificacion_pqrsf","ft_pqrsf=".$ft_papa[0]['idft_pqrsf'],"",$conn);

for($i=0;$i<$clasificacion['numcampos'];$i++){

	$html.='<table style="border-collapse: collapse; font-size: 12px; width: 100%;" border="1">
	<tr>
	<td style="text-align: left;"><strong>&nbsp;Clasificacion del Reclamo</strong></td>
	<td>&nbsp;'.mostrar_valor_campo('serie',306,$clasificacion[$i]['documento_iddocumento'],1).'</td>
	</tr>
	<tr>
	<td style="text-align: left;"><strong>&nbsp;Resonsable:&nbsp;</strong></td>
	<td style="text-align: left;">&nbsp;'.ver_responsable(306,$clasificacion[$i]['documento_iddocumento'],1).'</td>
	</tr>
	<tr>
	<td style="text-align: left;" colspan="2"><strong>&nbsp;Observaciones:</strong></td>
	</tr>
	<tr>
	<td colspan="2">&nbsp;'.mostrar_valor_campo('observaciones',306,$clasificacion[$i]['documento_iddocumento'],1).'</td>
	</tr>
	</table><br/>';
	
	$analisis=busca_filtro_tabla("","ft_analisis_pqrsf","ft_clasificacion_pqrsf=".$clasificacion[$i]['idft_clasificacion_pqrsf'],"",$conn);
	
	for($j=0;$j<$analisis['numcampos'];$j++){
		$html.='<table style="border-collapse: collapse; font-size: 12px; width: 100%;" border="1">
		<tbody>
		<tr>
		<td style="text-align: left;"><strong>&nbsp;Analisis de Causas</strong></td>
		<td>&nbsp;'.mostrar_valor_campo('analisis_causas',221,$analisis[$j]['documento_iddocumento'],1).'</td>
		</tr>
		</tbody>
		</table>';

		$html.=mostrar_items(221,$analisis[$j]['documento_iddocumento']);
	}
}
	echo $html;
}

function mostrar_items($idformato,$iddoc){
global $conn;
$idft=busca_filtro_tabla("idft_analisis_pqrsf,estado","ft_analisis_pqrsf,documento","iddocumento=documento_iddocumento and documento_iddocumento=".$iddoc,"",$conn);

$item=busca_filtro_tabla("I.accion_causa,nombres, apellidos,".fecha_db_obtener('I.fecha_limite','Y-m-d')." as fecha_limite,idft_item_causas_pqrsf","ft_item_causas_pqrsf I,dependencia_cargo D, funcionario F","F.idfuncionario=D.funcionario_idfuncionario AND D.iddependencia_cargo=I.responsable AND I.ft_analisis_pqrsf=".$idft[0][0],"",$conn);

$html='<table  style="border-collapse: collapse; font-size: 12px; width: 100%;" border="1">';
$html.="<tr align='center'><th>Accion</th> <th>Responsable</th> <th>Fecha Limite</th>";

$html.="</tr>";
for($i=0;$i<$item['numcampos'];$i++){
	$html.='<tr> <td>'.$item[$i]['accion_causa'].'</td> <td>'.ucwords(strtolower($item[$i]['nombres'].' '.$item[$i]['apellidos'])).'</td> <td>'.$item[$i]['fecha_limite'].'</td>';
	$html.='</tr>';
}	
$html.="</table><br/>";

if($item['numcampos']>0){
	return  $html;
}
}
function mostrar_anexos_pqrsf($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$anexos=busca_filtro_tabla("","anexos a","a.documento_iddocumento=".$iddoc,"",$conn);
	$anexos_array=array();
	for($i=0;$i<$anexos["numcampos"];$i++){
		$anexos_array[]='<a class="previo_high" style="cursor:pointer" enlace="'.$anexos[$i]["ruta"].'">'.$anexos[$i]["etiqueta"].'</a>';
	}
	echo(implode(", ",$anexos_array));
	if($_REQUEST["tipo"]!=5){
		?>
		<script>
		$(document).ready(function(){
			$(".previo_high").click(function(e){
				var enlace=$(this).attr("enlace");
				top.hs.htmlExpand(this, { objectType: 'iframe',width: 1000, height: 600,contentId:'cuerpo_paso', preserveContent:false, src:enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});
				
			});
		});
		</script>
		<?php
	}
}
/*ADICIONAR*/
function mostrar_radicado_pqrsf($idformato,$iddoc){
	global $conn;
	$contador=busca_filtro_tabla("b.consecutivo","formato a, contador b","a.contador_idcontador=b.idcontador AND a.idformato=".$idformato,"",$conn);
	echo("<td><input type='text' readonly id='numero_radicado' name='numero_radicado' value='".$contador[0]['consecutivo']."'></td>");
}
?>