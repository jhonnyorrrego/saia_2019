<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

/*ADICIONAR - EDITAR*/
function add_edit_vincu_exp() {
	global $conn;
	print_r($_REQUEST);
	if ($_REQUEST["iddoc"]) {
		$opt = 1;
	} else {
		$opt = 0;
		$ocultar = 0;
		if (isset($_REQUEST["idexpediente"])) {
			$ocultar = 1;
		}
	}
?>
<script>
	$(document).ready(function (){
		var opt=parseInt(<?php echo $opt;?>);
		if(opt==0){
			var ocultar=parseInt(<?php echo $ocultar;?>);
			if(ocultar==1){
				$("#td_fk_idexpediente").html('<input type="hidden" name="redirecciona_exp" value="1"><input type="text" id="fk_idexpediente" name="fk_idexpediente" value="<?php echo $_REQUEST["idexpediente"];?>" readonly="true">');
				$("#tr_fk_idexpediente").hide();
			}
		}
	});
</script>
<?php
}

/*MOSTRAR*/
function fecha_documento_funcion($idformato, $iddoc) {
	global $conn;
	$fecha_doc = busca_filtro_tabla(fecha_db_obtener('fecha_documento', 'Y-m-d') . " as fecha_doc", "ft_vincular_doc_expedie A", "A.documento_iddocumento=" . $iddoc, "");
	$datos = date_parse($fecha_doc[0]["fecha_doc"]);
	echo($datos["day"] . " de " . mes($datos["month"]) . " del " . $datos["year"]);
}

function ver_anexos_doc_vincu($idformato, $iddoc){
	global $conn,$ruta_db_superior;
	$anexos=busca_filtro_tabla("ruta,etiqueta,tipo,idanexos","anexos","documento_iddocumento=".$iddoc,"");
	$html="";
	if($anexos["numcampos"]){
		for ($i=0; $i <$anexos["numcampos"] ; $i++) {
			$ruta_anexo=$ruta_db_superior.'anexosdigitales/mostrar_menu_anexo.php?idanexo='.$anexos[$i]["idanexos"].'&iddoc='.$iddoc; 
			$html.='<a href="'.$ruta_anexo.'">'.$anexos[$i]["etiqueta"].'</a><br/>';
		}
	}
	echo $html;
}

/*POSTERIOR APROBAR*/
function post_aprob_vincu_exp($idformato, $iddoc) {
	global $conn;
	if($_REQUEST["redirecciona_exp"]==1){
		?>
		<script>
			parent.refrescar_panel_kaiten();
		</script>
		<?php
	}
	return;
}
function mostrar_informacion_qr($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	
	$datos_vincular_doc=busca_filtro_tabla("serie_idserie,asunto,".fecha_db_obtener('fecha_documento', 'Y-m-d') . " as fecha_doc","ft_vincular_doc_expedie","documento_iddocumento=".$iddoc,"",$conn);
    
    //$documento=busca_filtro_tabla("numero,tipo_radicado,".fecha_db_obtener("fecha","Y-m-d")." AS fecha","documento","iddocumento=".$iddoc,"",$conn);
	$tipo_documento=busca_filtro_tabla("nombre","serie","idserie=".$datos_vincular_doc[0]["serie_idserie"],"",$conn);
	
	$datos_fecha = date_parse($datos_vincular_doc[0]["fecha_doc"]);
	$fecha_doc = $datos_fecha["day"] . " de " . mes($datos_fecha["month"]) . " del " . $datos_fecha["year"];
	
	$estado_doc=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"", $conn);
	if($estado_doc[0]['estado']=='APROBADO'){
		$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"iddocumento_verificacion DESC", $conn);
		if($codigo_qr['numcampos']){
		    if(file_exists($ruta_db_superior.$codigo_qr[0]['ruta_qr'])){
			    $extension=explode(".",$codigo_qr[0]['ruta_qr']);
			    $img='<img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/'.$codigo_qr[0]['ruta_qr'].'"  />';		        
		    }else{
    			generar_codigo_qr_carta($idformato,$iddoc);
    			$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"iddocumento_verificacion DESC", $conn);
    			$extension=explode(".",$codigo_qr[0]['ruta_qr']);
    			$img='<img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/'.$codigo_qr[0]['ruta_qr'].'"   />';		        
		    }

		}else{
			generar_codigo_qr_carta($idformato,$iddoc);
			$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"iddocumento_verificacion DESC", $conn);
			$extension=explode(".",$codigo_qr[0]['ruta_qr']);
			$img='<img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/'.$codigo_qr[0]['ruta_qr'].'"   />';
		}
		//echo($img);
	}
	
    $tabla='
        <table class="table table-bordered" style="width: 100%; font-size:10px; text-align:left;" border="1">
  <tr>
    <td style="width: 23%;"><b>Fecha:</b></td>
    <td style="width: 18%;">'.$fecha_doc.'</td>
    <td style="text-align:center; width: 23%;" colspan="2" rowspan="3">'.$img.'</td>
 </tr>
 <tr>
    <td style="width: 18%;"><b>Asunto:</b></td>
    <td style="width: 18%;">'.$datos_vincular_doc[0]["asunto"].'</td>    
  </tr>
  <tr>
    <td><b>Serie:</b></td>
    <td>'.$tipo_documento[0]["nombre"].'</td> 
  </tr>
  </table>';  
    echo $tabla;
    
}
?>