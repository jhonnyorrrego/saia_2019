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

function validar_digitalizacion_formato_pqr($idformato,$iddoc){
	global $conn,$ruta_db_superior;

  if($_REQUEST["digitalizacion"]==1){
  	if(@$_REQUEST["iddoc"]){
  		$enlace="pantallas/buscador_principal.php?idbusqueda=9";
  		//abrir_url($ruta_db_superior."colilla.php?key=".$_REQUEST["iddoc"]."&enlace=paginaadd.php?key=".$_REQUEST["iddoc"]."&enlace2=".$enlace,'_self');
  		abrir_url($ruta_db_superior."paginaadd.php?key=".$_REQUEST["iddoc"]."&enlace=".$enlace,'centro');
  	}
	else{
		$enlace="busqueda_categoria.php?idcategoria_formato=1&defecto=radicacion_entrada";
		abrir_url($ruta_db_superior."colilla.php?key=".$iddoc."&enlace=paginaadd.php?key=".$iddoc."&enlace2=".$enlace,'centro');
	}
    //redirecciona($ruta_db_superior."paginaadd.php?&key=".$iddoc."&enlace=".$enlace);
  }elseif($_REQUEST["digitalizacion"]==2 && $_REQUEST['no_sticker'] == 1){
  	abrir_url($ruta_db_superior."formatos/radicacion_entrada/mostrar_radicacion_entrada.php?iddoc=".$iddoc."&idformato=".$idformato,'_self');
  }else if($_REQUEST["digitalizacion"]==2){
  	if(@$_REQUEST["iddoc"]){
  		$iddoc=$_REQUEST["iddoc"];
  		$enlace="pantallas/buscador_principal.php?idbusqueda=9";
  	}
	else{
		$enlace="busqueda_categoria.php?idcategoria_formato=1&defecto=pqrsf";
	}
  		abrir_url($ruta_db_superior."colilla.php?key=".$iddoc."&enlace=".$enlace,'centro');
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

function generar_qr_pqrsf($idformato,$iddoc){
	global $conn,$ruta_db_superior;	
	$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"", $conn);
	if($codigo_qr['numcampos']){
	$qr='<img src="http://'.RUTA_PDF_LOCAL.'/'.$codigo_qr[0]['ruta_qr'].'" >';	
	}else{
		include_once($ruta_db_superior."pantallas/qr/librerias.php");
		generar_codigo_qr($idformato,$iddoc);
		
		$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"", $conn);	
		$qr="<img src='http://".RUTA_PDF_LOCAL."/".$codigo_qr[0]['ruta_qr']."' >";	
	}
	echo $qr;
}

function generar_codigo_qr_pqrsf($idformato,$iddoc){
  global $conn,$ruta_db_superior;
	include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
  $codigo_qr=busca_filtro_tabla("ruta_qr, iddocumento_verificacion","documento_verificacion","documento_iddocumento=".$iddoc,"", $conn);
  $datos=busca_filtro_tabla("A.fecha,A.estado, A.numero","documento A","A.iddocumento=".$iddoc,"",$conn);
	$fecha=mostrar_fecha_saia($datos[0]['fecha']);
	$datos_qr="Fecha: ".$fecha." \n";
	$datos_qr.="Radicado No: ".$datos[0]["numero"]." \n";
	$firmas=busca_filtro_tabla("CONCAT(B.nombres,CONCAT(' ',B.apellidos)) AS nombre","buzon_salida A, funcionario B","A.origen=B.funcionario_codigo AND (A.nombre LIKE 'APROBADO' OR A.nombre LIKE 'REVISADO')AND A.archivo_idarchivo=".$iddoc,"idtransferencia asc", $conn);
	$datos_qr.="Firman: \n";
	for($i=0; $i<$firmas['numcampos']; $i++){
	  $datos_qr .= $firmas[$i]['nombre']." \n";
	}
	$ruta=RUTA_QR.$datos[0]['estado'].'/'.date('Y-m-d').'/'.$iddoc.'/qr/';

	$imagen=generar_qr_pqrsf_2($ruta,$datos_qr);

	if($imagen==false){
	  alerta("Error al tratar de crear el codigo qr");
	}else{
	  $codigo_hash=obtener_codigo_hash_archivo($imagen,'crc32'); 
	  $fun_qr=usuario_actual('idfuncionario');
	  if(!$fun_qr){
	      $fun_qr=1;
	  }		  
	  
	  $sql_documento_qr="INSERT INTO documento_verificacion(documento_iddocumento,funcionario_idfuncionario,fecha,ruta_qr,verificacion,codigo_hash) VALUES (".$iddoc.",".$fun_qr.",".fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s').",'".$imagen."','vacio','".$codigo_hash."')";
	  phpmkr_query($sql_documento_qr);
	}
}
function generar_qr_pqrsf_2($filename,$datos,$matrixPointSize = 2,$errorCorrectionLevel = 'Q'){
  global $ruta_db_superior;
  include_once ($ruta_db_superior."phpqrcode/qrlib.php");

  if ($datos) {
        if (trim($datos) == ''){
            return false;
        }else{
          crear_destino($ruta_db_superior.$filename);
          $filename .= 'qr'.date('Y_m_d_H_m_s').'.jpg';

          QRcode::png($datos,$ruta_db_superior.$filename, $errorCorrectionLevel, $matrixPointSize, 0);
          return $filename;
        }
    }else{
      return false;
    }
}

function transferencia_cargo_lider_pqrsf($idformato,$iddoc){
	global $conn;
	
	$dato=busca_filtro_tabla("iddependencia_cargo","vfuncionario_dc","estado_dc=1 AND lower(cargo)='lider pqrs'","",$conn);
	transferencia_automatica($idformato,$iddoc,$dato[0]['iddependencia_cargo'],"1");
	
	
}




?>