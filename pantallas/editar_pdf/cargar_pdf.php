<?php
$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
        //Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "librerias_saia.php");

echo(librerias_bootstrap());
echo(estilo_bootstrap());
echo(librerias_jquery());
echo(librerias_notificaciones());
if ($_REQUEST["cargado"]) {
    if ($_FILES["file"]["tmp_name"]) {

        $tmpfile = $_FILES["file"]["tmp_name"];
        $filename = $_FILES["file"]["name"];
        $handle = fopen($tmpfile, "r");
        $contents = fread($handle, filesize($tmpfile));
        fclose($handle);
        $decodeContent = base64_encode($contents);
        $array_anexos = array("filename" => $filename, "content" => $decodeContent, "extencion" => $_FILES["file"]["type"]);
        $info_anexos = array();
        $info_anexos["tipo_anexo"] = $array_anexos;
        $ruta_envio = envio_archivo($array_anexos);
    } else {
        echo("<script>
                notificacion_saia('No se ha Cargado Ningun Archivo ','warning','',4000);
            </script>");
    }
}

function envio_archivo($datos) {
    $ruta = cargar_anexos_documento_web_2(array(0 => $datos));

    echo("<script>
                notificacion_saia('Carga completada exitosamente ','success','',4000);
        </script>");
}

function cargar_anexos_documento_web_2($anexos) {
    global $conn, $ruta_db_superior;

    foreach ($anexos as $key => $value) {

        $datos_documento["fecha"] = date("Y-m-d");
        $datos_documento["iddocumento"] = "0";
        $ruta = RUTA_ARCHIVOS . "planos/" . $datos_documento["fecha"] . "/" . $datos_documento["iddocumento"] . "/anexos";
        crear_destino($ruta_db_superior . $ruta);
        $extencion = pathinfo($value['filename']);
        $nombre_archivo = rand()."v1";
        $ruta .= "/" . $nombre_archivo . "." . $extencion["extension"];
        $archivo = fopen($ruta_db_superior . $ruta, "w+");
        fclose($archivo);
        $contenido = base64_decode($value['content']);
        file_put_contents($ruta_db_superior . $ruta, $contenido);
        if (file_exists($ruta_db_superior . $ruta)) {
            $insert_anexo = "insert into anexos(documento_iddocumento, ruta, etiqueta, tipo, formato,fecha_anexo) VALUES (" . $datos_documento["iddocumento"] . ",'" . $ruta . "','" . $nombre_archivo . "','" . $extencion["extension"] . "',1,".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').")";
            
            phpmkr_query($insert_anexo, $conn, $datos_documento["funcionario_codigo"]);
            $idnexo = phpmkr_insert_id();
            $insert_permiso = "insert into permiso_anexo (anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_dependencia, caracteristica_cargo, caracteristica_total) VALUES (" . $idnexo . "," . $funcionario[0]["idfuncionario"] . ",'lem', '', '', 'l')";
            phpmkr_query($insert_permiso);
			
        }
    }
	$_REQUEST['ruta']=$ruta;
	$url=$ruta_db_superior."class_impresion_pdfi.php?param=".urlencode(json_encode($_REQUEST));
	redirecciona($url);
    return ($ruta_db_superior . $ruta);
}

?>
<form action="cargar_pdf.php" method="post" enctype="multipart/form-data">
	<table width="80%" cellspacing="1" cellpadding="4" class="table">
		<tr>
			<td colspan="2" class="encabezado_list">
			<center>
				Cargar PDF
			</center></td>
		</tr>
		<tr>
			<td class="encabezado" width="20%" title="">PAGINA A EDITAR*</td>
			<td>
			<input type='number' name="pagina" id="pagina" required="true" min="0" style="width: 5%"/>
			</td>
		</tr>
		<tr>
			<td class="encabezado" width="20%" title="">TAMA&Ntilde;O DE LETRA*</td>
			<td>
			<input type='number' name="tamano" id="tamano" required="true" min="0" style="width: 5%"/>
			</td>
		</tr>
		<tr>
			<td class="encabezado" width="20%" title="">CONTENIDO PARA AGREGAR*</td>
			<td>
			<textarea class="tiny_avanzado2" id="contenido" name="contenido"></textarea>
			</td>
		</tr>
		<tr>
			<td class="encabezado" width="20%" title="">Posicion del contenido*</td>
			<td>
			X <input type='number' name="posicionx" id="posicionx" required="true" min="0" style="width: 5%" required="true"/>
			Y <input type='number' name="posiciony" id="posiciony" required="true" min="0" style="width: 5%" required="true"/>
			</td>
		</tr>
		<!-- tr>
			<td class="encabezado" width="20%" title="">Margenes(Izq,
				Der, Sup, Inf</td>
			<td bgcolor="#F5F5F5">
			    Izquierda
				<select name="margen_izquierda" style="width: 5%">
					<?php
                     $opciones="";
                     for ($i=0; $i <= 50; $i++) {
                         $selected="";
                         if($i==15){
                             $selected="selected";
                         } 
                         echo "<option value='".$i."' ".$selected.">".$i."</option>";
                     }
                ?>
				</select>
				Derecha
				<select name="margen_derecha" style="width: 5%">
					<?php
                     $opciones="";
                     for ($i=0; $i <= 50; $i++) {
                         $selected="";
                         if($i==15){
                             $selected="selected";
                         } 
                         echo "<option value='".$i."' ".$selected.">".$i."</option>";
                     }
                ?>
				</select>
				 Superior
				<select name="margen_superior" style="width: 5%">
					<?php
                     $opciones="";
                     for ($i=0; $i <= 50; $i++) {
                         $selected="";
                         if($i==20){
                             $selected="selected";
                         } 
                         echo "<option value='".$i."' ".$selected.">".$i."</option>";
                     }
                ?>
				</select>
				Inferior
				<select name="margen_inferior" style="width: 5%">
				    <?php
                     $opciones="";
                     for ($i=0; $i <= 30; $i++) {
                         $selected="";
                         if($i==15){
                             $selected="selected";
                         } 
                         echo "<option value='".$i."' ".$selected.">".$i."</option>";
                     }
                ?>
				</select>
			</td>
			<tr>
                <td class="encabezado" width="20%" title="">ORIENTACI&Oacute;N*</td>
                <td>
                    <input type="radio" name="orientacion" id="orientacion" value="P" checked="true" required="true">Vertical
                    <input type="radio" name="orientacion" id="orientacion" value="L">Horizontal
                </td>
            </tr>
		</tr-->
		<tr>
			<td class="encabezado" width="20%" title="">ANEXO*</td>
			<td width="80%">
			<input type="file" id="file" name="file" accept="application/pdf" required="true">
			<input type="hidden" id="cargado" name="cargado" value="1">
			<input type="hidden" id="versionamiento" name="versionamiento" value="1">
			</td>
		</tr>
		<tr>
			<td>
			<input class="btn btn-success" type="submit" value="Cargar">
			</td>
		</tr>
	</table>
</form>
<script language="javascript" type="text/javascript" src="<?php echo $ruta_db_superior; ?>tinymce34/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	language : "es",
	editor_selector: "tiny_avanzado2",
	plugins : "formatos,spellchecker,pagebreak,style,table,save,advhr,advlink,iespell,inlinepopups,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
	theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,cleanup,code,|,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat",
	spellchecker_languages : "+Espa=es,Ingles=en",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,tab_focus : ':prev,:next',
	external_image_list_url : "librerias/image_list.js",
	content_css : "librerias/estilo.css",
	height:"300px",
	width:"350px",
	fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt 80pt'
  });
opciones =
[   ['Cut','Copy','Paste','PasteText','PasteFromWord'],
    ['Find','Replace','-','SelectAll','RemoveFormat'],
    ['Image','Flash','Table','HorizontalRule'],
    ['Link','Unlink'],['TextColor','BGColor'],['Source'] ,
    '/',
    ['Font','FontSize'],['Bold','Italic','Underline','Strike'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote']        
];
</script>