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
include_once($ruta_db_superior."pantallas/documento/librerias.php");
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
include_once($ruta_db_superior."pantallas/qr/librerias.php");

function validar_digitalizacion_formato_pqr($idformato,$iddoc){
	global $conn,$ruta_db_superior;

  if($_REQUEST["digitalizacion"]==1){
  	if(@$_REQUEST["iddoc"]){
  	    $iddoc=$_REQUEST["iddoc"];
  		$enlace="ordenar.php?key=" . $iddoc."&accion=mostrar&mostrar_formato=1";
  		abrir_url($ruta_db_superior."paginaadd.php?target=_self&key=".$iddoc."&enlace=".$enlace,'_self');
  	}
	else{
		abrir_url($ruta_db_superior."colilla.php?target=_self&key=".$iddoc."&enlace=paginaadd.php?key=".$iddoc,'_self');
	}
  }elseif($_REQUEST["digitalizacion"]==2 && $_REQUEST['no_sticker'] == 1){
  	abrir_url($ruta_db_superior."formatos/radicacion_entrada/mostrar_radicacion_entrada.php?iddoc=".$iddoc."&idformato=".$idformato,'_self');
  }else if($_REQUEST["digitalizacion"]==2){
  	if(@$_REQUEST["iddoc"]){
  		$iddoc=$_REQUEST["iddoc"];
  	}
	$enlace="ordenar.php?key=" . $iddoc."&accion=mostrar&mostrar_formato=1";
  	abrir_url($ruta_db_superior."colilla.php?target=_self&key=".$iddoc."&enlace=".$enlace,'_self');
  }
}



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
		$ruta = $anexos[$i]["ruta"];
		$ruta64 = base64_encode($ruta);
		$anexos_array[] = '<a class="previo_high" style="cursor:pointer" enlace="' . "filesystem/mostrar_binario.php?ruta=$ruta64" . '">' . $anexos[$i]["etiqueta"] . '</a>';
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

function transferencia_cargo_lider_pqrsf($idformato,$iddoc){
	global $conn;
	
	$dato=busca_filtro_tabla("iddependencia_cargo","vfuncionario_dc","estado_dc=1 AND lower(cargo)='lider pqrs'","",$conn);
	transferencia_automatica($idformato,$iddoc,$dato[0]['iddependencia_cargo'],"1");
	
	
}


function cambiar_estado_iniciado_pqrsf($idformato,$iddoc){ //posterior al aprobar
	global $conn;
	
	$datos=busca_filtro_tabla("estado_radicado","ft_pqrsf","documento_iddocumento=".$iddoc,"",$conn);
	if($datos[0]['estado_radicado']==2){ //INICIADO 
	    $up="UPDATE documento SET estado='INICIADO' WHERE iddocumento=".$iddoc;   
	    phpmkr_query($up);
	}
}
function enlace_llenar_datos_radicacion_rapida_pqrsf($idformato,$iddoc){ //mostrar
	global $conn;
	
	$doc=busca_filtro_tabla("estado","documento","iddocumento=".$iddoc,"",$conn);
	if($doc[0]['estado']=='INICIADO'){
	    $texto.='<br><br><button class="btn btn-mini btn-warning" onclick="window.location=\'editar_pqrsf.php?no_sticker=1&iddoc='.$iddoc.'&idformato='.$idformato.'\';">Llenar datos</button>';
        echo $texto;
	}
}
function cambiar_estado_aprobado_pqrsf($idformato,$iddoc){//posterior al editar
	global $conn;  
	
	$datos=busca_filtro_tabla("estado_radicado","ft_pqrsf","documento_iddocumento=".$iddoc,"",$conn);
	if($datos[0]['estado_radicado']==2){ //INICIADO 
	    $up="UPDATE documento SET estado='APROBADO' WHERE iddocumento=".$iddoc;   
	    phpmkr_query($up);
	    $up2="UPDATE ft_pqrsf SET estado_radicado='1' WHERE documento_iddocumento=".$iddoc;   
	    phpmkr_query($up2);	    
	}	
	
}

function vincular_distribucion_pqrsf($idformato,$iddoc){  //POSTERIOR AL APROBAR
	global $conn,$ruta_db_superior;  	
	
	$datos=busca_filtro_tabla("a.nombre,a.documento,a.email,a.telefono","ft_pqrsf a,documento b","lower(b.estado)='aprobado' AND a.documento_iddocumento=b.iddocumento AND a.documento_iddocumento=".$iddoc,"",$conn);  
	
	//INGRESAMOS EL ORIGEN COMO UN REMITENTE
	$ie=" INSERT INTO ejecutor (identificacion,nombre,fecha_ingreso,estado,tipo_ejecutor) VALUES
	(
		'".$datos[0]['documento']."',
		'".$datos[0]['nombre']."',
		".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",
		1,
		1
	)
	";

	phpmkr_query($ie);
	$idejecutor=phpmkr_insert_id();
	$iddatos_ejecutor=0;
	if($idejecutor){
		$ide=" INSERT INTO datos_ejecutor (ejecutor_idejecutor,email,telefono,fecha) VALUES
		 (
		 	".$idejecutor.",
		 	'".$datos[0]['email']."',
		 	'".$datos[0]['telefono']."',
		 	".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')."
		 )
		
		";
		
		phpmkr_query($ide);
		$iddatos_ejecutor=phpmkr_insert_id();
	}
	
	$upr="UPDATE ft_pqrsf SET remitente_origen=".$iddatos_ejecutor." WHERE documento_iddocumento=".$iddoc;
	phpmkr_query($upr);
	
	//DESTINO INTERNO DE LA PQRSF
	$lasignadas=busca_filtro_tabla("B.parametros","funciones_formato_accion C,accion A,funciones_formato B","C.accion_idaccion=A.idaccion AND B.idfunciones_formato=C.idfunciones_formato and B.nombre_funcion='transferencia_automatica' AND C.formato_idformato=".$idformato,"",$conn);
	$rol_destino=0;
	if($lasignadas['numcampos']){
		$vector_parametros=explode(',',$lasignadas[0]['parametros']);
		$rol_destino=$vector_parametros[0];		
	}

	if($iddatos_ejecutor && $rol_destino){
		include_once($ruta_db_superior."distribucion/funciones_distribucion.php");
		//EXT -INT
		$datos_distribucion=array();
		$datos_distribucion['origen']=$iddatos_ejecutor;
		$datos_distribucion['tipo_origen']=2;
		$datos_distribucion['destino']=$rol_destino;
		$datos_distribucion['tipo_destino']=1;
		$datos_distribucion['estado_distribucion']=1;
			
		$ingresar=ingresar_distribucion($iddoc,$datos_distribucion);		
		
	} //fin if $iddatos_ejecutor && $rol_destino
	
	
} // fin function vincular_distribucion_pqrsf
?>
