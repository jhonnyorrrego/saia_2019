<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if(is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
global $raiz_saia;
$raiz_saia = $ruta_db_superior;
echo (librerias_jquery('1.7'));
echo (librerias_notificaciones());

// FUNCIONES WORD
function mostrar_enlace_plantilla($idformato, $iddoc) { // ADICIONAR
	global $ruta_db_superior, $conn;
	
	$configuracion = busca_filtro_tabla("valor", "configuracion", "nombre='ruta_plantilla_word'", "", $conn);
	$ruta_plantilla = $ruta_db_superior . $configuracion[0]['valor'];
	
	?>
<script>
		$(document).ready(function(){
			$html='<div style="text-align:center; font-size:11pt;">';
			$html+='<b>ATENCION!</b> <BR>Por favor descargue ';
			$html+=' <a href="<?php echo($ruta_plantilla); ?>plantilla_nuevo_oficio.docx" target="_blank">ESTA PLANTILLA</a> ';
			$html+=' para crear un nuevo oficio, &oacute; hacer caso omiso si ya dispone de ella. ';
			$html+='<br>Si desea ';
			$html+='<a href="<?php echo($ruta_plantilla); ?>plantilla_nuevo_oficio_combinar.docx" target="_blank">COMBINAR</a>';
			$html+=' correspondencia descargue la siguiente plantilla</div>';
			$('#enlace_plantilla').html($html);
		});
	</script>
<?php
}

function generar_exportar_word($idformato, $iddoc) { // POSTERIOR AL ADICIONAR Y EDITAR
	global $ruta_db_superior, $conn;
	
	if(@$_REQUEST['firmado'] == 'una') {
		include_once ($ruta_db_superior . 'pantallas/lib/PhpWord/exportar_word.php');
	}
	if(!@$_REQUEST['firmado']) {
		include_once ($ruta_db_superior . 'pantallas/lib/PhpWord/exportar_word.php');
	}
}

function generar_firma_word($idformato, $iddoc) { // POSTERIOR AL CONFIRMAR
	global $ruta_db_superior, $conn;
	
	include_once ($ruta_db_superior . 'pantallas/lib/PhpWord/firmar_word.php');
}

function generar_radicado_word($idformato, $iddoc) { // POSTERIOR AL APROBAR
	global $ruta_db_superior, $conn;
	
	$busca_masivo=busca_filtro_tabla("","anexos a, campos_formato b","b.nombre='anexo_csv' AND a.campos_formato=b.idcampos_formato AND a.documento_iddocumento=".$iddoc,"",$conn);
	
	if($busca_masivo['numcampos']){
	    include_once ($ruta_db_superior . 'pantallas/lib/PhpWord/funciones_radicacion_word.php');
    	$radicar_word = new RadicadoWord($iddoc);
    	$radicar_word->asignar_radicado();	    
	}else{
	    include_once($ruta_db_superior.'pantallas/lib/PhpWord/numero_radicado_word.php');
	}
}

function mostrar_mensaje_error_pdf($idformato, $iddoc) { // mostrar
	global $conn, $ruta_db_superior;
	
	$html = '';
	if(@$_REQUEST['tipo'] != 5) {
		?>
<script type="text/javascript"
	src="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css"
	href="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
       	hs.graphicsDir = '<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
        hs.outlineType = 'rounded-white';
    </script>
<?php
		$html = '<a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 320, height: 140,preserveContent:false} )" href="' . $ruta_db_superior . 'pantallas/lib/PhpWord/cargar_word.php?iddoc=' . $iddoc . '&idformato=' . $idformato . '">Anexar Docx</a>';
	}
	echo (estilo_bootstrap());
	$anexos_documento_word = busca_filtro_tabla("d.ruta", "documento a, formato b, campos_formato c, anexos d", "lower(a.plantilla)=b.nombre AND b.idformato=c.formato_idformato AND c.nombre='anexo_word' AND c.idcampos_formato=d.campos_formato AND a.iddocumento=" . $iddoc . " AND d.documento_iddocumento=" . $iddoc, "", $conn);
	
	$ruta_almacenar = explode('anexos', $anexos_documento_word[0]["ruta"]);
	$pdf = $ruta_db_superior . $ruta_almacenar[0] . 'docx/documento_word.pdf';
	if(!file_exists($pdf)) {
		
		$cadena = '
        	<div class="well alert-danger">
            	No Fue posible generar el PDF, por favor intente subir nuevamente el archivo .docx
            	<br>
                ' . $html . '
            </div>
        ';
		echo ($cadena);
	}
}

// --------------------------Posterior aprobar------------------------------//
function enviar_correo_pqr_oficio($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$respuesta = 0;
	$datos = busca_filtro_tabla("", "ft_oficio_word c,respuesta r,ft_pqrsd p", "origen=p.documento_iddocumento and destino=c.documento_iddocumento and c.documento_iddocumento=" . $iddoc, "r.fecha desc", $conn);
	if(!$datos['numcampos']) {
		$datos = busca_filtro_tabla("", "documento d, ft_clasificacion_pqr c, respuesta r", "origen=c.documento_iddocumento and destino=iddocumento and iddocumento=" . $iddoc, "d.fecha desc", $conn);
		$papa = busca_filtro_tabla("", "ft_pqrsd p ", "idft_pqrsd=" . $datos[0]['ft_pqrsd'], "", $conn);
		$datos[0]['datos_solicitante'] = $papa[0]['datos_solicitante'];
		$respuesta = 1;
	}
	if(!$datos['numcampos']) {
		$datos = busca_filtro_tabla("c.*,r.*,d.*", "documento d, ft_respuesta_borrador c, respuesta r", "origen=p.documento_iddocumento and destino=iddocumento and iddocumento=" . $iddoc, "d.fecha desc", $conn);
		$papa = busca_filtro_tabla("", "ft_pqrsd p ", "idft_pqrsd=" . $datos[0]['ft_pqrsd'], "", $conn);
		$datos[0]['datos_solicitante'] = $papa[0]['datos_solicitante'];
		$respuesta = 2;
	}
	
	if($datos['numcampos']) {
		$documento = busca_filtro_tabla("", "documento", "iddocumento=" . $datos[0]['origen'], "", $conn);
		$ch = curl_init();
		$fila = "http://" . RUTA_PDF_LOCAL . "/class_impresion.php?iddoc=" . $iddoc . "&conexion_usuario=" . $_SESSION["LOGIN" . LLAVE_SAIA] . "&conexion_actual=" . $_SESSION["usuario_actual"] . "&conexion_remota=1&llave_saia=" . LLAVE_SAIA . "&LOGIN=" . $_SESSION["LOGIN" . LLAVE_SAIA];
		curl_setopt($ch, CURLOPT_URL, $fila);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$contenido = curl_exec($ch);
		curl_close($ch);
		if($respuesta == 0) {
			$info = busca_filtro_tabla("", "ft_oficio_word,documento", "documento_iddocumento=iddocumento and documento_iddocumento=" . $iddoc, "", $conn);
		} else if($respuesta == 1) {
			$info = busca_filtro_tabla("", "ft_clasificacion_pqr,documento", "documento_iddocumento=iddocumento and documento_iddocumento=" . $iddoc, "", $conn);
		} else if($respuesta == 2) {
			$info = busca_filtro_tabla("", "ft_respuesta_borrador,documento", "documento_iddocumento=iddocumento and documento_iddocumento=" . $iddoc, "", $conn);
		}
		
		$anexo_pdf = array();
		if($info[0]['pdf'] != "") {
			$anexo_pdf['pdf'] = $ruta_db_superior . $info[0]['pdf'];
		}
		
		$email = busca_filtro_tabla("", "datos_ejecutor,ejecutor", "idejecutor=ejecutor_idejecutor and iddatos_ejecutor=" . $datos[0]['datos_solicitante'], "", $conn);
		$mensaje = "Cordial Saludo,<br/>
			Se adjunta copia de la respuesta a la PQR.<br/><br/>
			Antes de imprimir este mensaje, asegurese que es necesario. Proteger el medio ambiente tambien esta en nuestras manos.<br/>
  		ESTE ES UN MENSAJE AUTOMATICO, FAVOR NO RESPONDER";
		enviar_mensaje("", "email", array(
				$email[0]['email']
		), "Notificacion respuesta solicitud PQRSD No. " . $documento[0]['numero'], $mensaje, $anexo_pdf);
		$correo_copia = busca_filtro_tabla("", "funcionario", "login like 'rvarela' and estado=1", "", $conn);
		if($correo_copia['numcampos'] && $correo_copia[0]['email'] != '') {
			enviar_mensaje("", "email", array(
					$correo_copia[0]['email']
			), "Copia Notificacion respuesta solicitud PQRSD No. " . $documento[0]['numero'], $mensaje, $anexo_pdf, 1);
		}
	}
}

?>
