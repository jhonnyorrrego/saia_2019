<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."header.php");
include_once($ruta_db_superior."pantallas/lib/librerias_archivo.php");

$configuracion_temporal = busca_filtro_tabla("valor", "configuracion", "nombre='ruta_temporal' AND tipo='ruta'", "", $conn);
if($configuracion_temporal["numcampos"]){
	$ruta_temp=$configuracion_temporal[0]["valor"];
}

?>
<script> 
/*
<Clase>
<Nombre>validar_campos</Nombre> 
<Parametros>f: objeto formulario</Parametros>
<Responsabilidades>Valida los campos obligatorios para el asunto y es destino<Responsabilidades>
<Notas></Notas>
<Excepciones>Estos campos no pueden estar vacios</Excpciones>
<Salida></Salida><Pre-condiciones><Pre-condiciones><Post-condiciones><Post-condiciones>
</Clase>
*/
 function validar_campos(f)
 {
  if(f.para.value=="")
  { alert("Debe escribir un destino para el e-mail");
    return false;
  }
  if(f.asunto.value=="")
  {  alert("Debe escribir el asunto del e-mail");
     return false;
  }   
  return true; 
 }
</script>
<?php


/*
<Clase>
<Nombre>formato_email</Nombre> 
<Parametros></Parametros>
<Responsabilidades>Crea el formulario para el envio de correo electronico, el origen es el login del funcionario de la sesion y los adjuntos son los anexos o imagenes del documento y el pdf relacionado.<Responsabilidades>
<Notas>El iddocumento se pasa por la variable $_REQUEST["iddoc"]; Si el funcionario no tiene correo se coloca uno por defecto que es info@cerok.com</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones>El documento debe estar aprobado, debe terner numero de radicado<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function formato_email(){
 global $conn,$ruta_db_superior,$ruta_temp;
   $datos=busca_filtro_tabla("numero,pdf,plantilla,ejecutor,descripcion,tipo_radicado,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","documento","iddocumento=".$_REQUEST["iddoc"],"",$conn);
   //si es un radicado de entrada
   $contenido="Documento Número: ".$datos[0]["numero"]."\nFecha: ".$datos[0]["fecha"]."\nDescripción: ".strip_tags(str_replace("<br />"," ",$datos[0]["descripcion"]));
   if($datos[0]["tipo_radicado"]==1)
     {$ejecutor=busca_filtro_tabla("nombre,cargo,empresa","ejecutor,datos_ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor=".$datos[0]["ejecutor"],"",$conn);
      $contenido.="\nRemitente: ".$ejecutor[0]["nombre"];
      if($ejecutor[0]["cargo"]<>"")
        $contenido.=", Cargo: ".$ejecutor[0]["cargo"];
      if($ejecutor[0]["empresa"]<>"")  
        $contenido.=", Empresa: ".$ejecutor[0]["empresa"];
     }
   elseif($datos[0]["plantilla"]<>"")
     {$ejecutor=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$datos[0]["ejecutor"],"",$conn);
      $contenido.="\nCreador: ".$ejecutor[0]["nombres"]." ".$ejecutor[0]["apellidos"];
     }  
 if(!$datos["numcampos"]||!$datos[0]["numero"]){
    if(!$datos["numcampos"]){
      alerta("Su documento no puede ser enviado por correo ya que no se encuentra en el sistema por favor comuniquese con su administrador con el siguiente numero: ".$_REQUEST["iddoc"]);
    }
    else if(!$datos[0]["numero"]){
      alerta("Su documento no puede ser enviado por correo ya que no posee número de radicado.");
    }
    volver(1);
 }
 menu_ordenar($_REQUEST["iddoc"]);
   $anexos=busca_filtro_tabla("ruta,etiqueta,idanexos","anexos","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
   $direcciones=busca_filtro_tabla("email","funcionario","funcionario_codigo=".$_SESSION["usuario_actual"]." AND email IS NOT NULL and email<>''","",$conn);
 //print_r($direcciones);
 $login=busca_filtro_tabla("login","funcionario","funcionario_codigo=".$_SESSION["usuario_actual"],"",$conn);
 if(!is_dir("../".$ruta_temp."_".$login[0]["login"]))
    {mkdir("../".$ruta_temp."_".$login[0]["login"],PERMISOS_CARPETAS);
     chmod("../".$ruta_temp."_".$login[0]["login"],PERMISOS_CARPETAS);
    }
    
   if($direcciones["numcampos"])
      $ldirecciones=explode(",",$direcciones[0]["email"]);
   else
      $ldirecciones[0]= "info@cerok.com";

 echo "<form  name='email' action='email_doc.php' method='post' onsubmit='return validar_campos(this)'>
       <table border=0 width=80%>
       <tr>
       <td class='encabezado_list' colspan=2 height='20px' >ENVIAR DOCUMENTO POR E-MAIL</td></tr>
       <tr><td class='encabezado'>DE</td>
       <td width=80% bgcolor='#F5F5F5'><select name='de'>";
   foreach($ldirecciones as $fila)     
      echo "<option value='".$fila."'>".$fila."</option>";
 echo "</select></td></tr>
       <tr><td class='encabezado'>PARA*</td>
       <td bgcolor='#F5F5F5'><input name='para' value='' type='text' size='100'></td></tr>
         <tr><td class='encabezado'>CON COPIA</td>
         <td bgcolor='#F5F5F5'><input name='para_cc' value='' type='text' size='100'></td></tr>
         <tr><td class='encabezado'>CON COPIA OCULTA</td>
         <td bgcolor='#F5F5F5'><input name='para_cco' value='' type='text' size='100'></td></tr>
       <tr><td class='encabezado'>ASUNTO*</td>
       <td bgcolor='#F5F5F5'>
       <input name='asunto' value='Env&iacute;o de documento ".$datos[0]["numero"]."' type='text' size='100'></td></tr>
       <tr><td class='encabezado'>CONTENIDO</td>
       <td bgcolor='#F5F5F5'><textarea name='contenido' cols='100' rows='20'>$contenido</textarea></td></tr>";
 //pongo los anexos del documento en la lista de anexos del email
 $rutas=array();
 $nombres=array();
 $texto_anexo='';  
 $texto_pagina='';
 if($anexos["numcampos"])
    {
     for($i=0;$i<$anexos["numcampos"];$i++)
         $texto_anexo.='<input name="anexos[]" value="'.$anexos[$i]['idanexos'].'" type="checkbox" checked><a href="'.$ruta_db_superior.'../'.$anexos[$i]['ruta'].'" target="_blank">'.$anexos[$i]["etiqueta"].'</a><br />';
    }      
 
//creo un pdf con las paginas del documento
$paginas=busca_filtro_tabla("ruta","pagina","id_documento=".$_REQUEST["iddoc"],"",$conn);
if($paginas["numcampos"])
  {$ruta=substr($paginas[0]["ruta"],0,strrpos($paginas[0]["ruta"],"/")+1);    
   $pdf=dirToPdf("../".$ruta_temp."_".$login[0]["login"]."/paginas_documento".$datos[0]["numero"].".pdf", "../".$ruta);
   if($pdf!==false)
       $texto_pagina.='<input name="paginas" value="'."../".$ruta_temp."_".$login[0]["login"]."/paginas_documento".$datos[0]["numero"].".pdf".'" type="checkbox" checked><a href="'.$ruta_db_superior."../".$ruta_temp."_".$login[0]["login"]."/paginas_documento".$datos[0]["numero"].".pdf".'" target="_blank">'."paginas_documento".$datos[0]["numero"].".pdf".'</a><input type="hidden" name="nombre_paginas" value="'."paginas_documento".$datos[0]["numero"].".pdf".'"><br />';
  }    
 //si el documento es un formato se envio el pdf como adjunto
 if(strtolower($datos[0]["plantilla"])<>"" && $datos[0]["numero"]<>'0')
    {
     if($datos[0]["pdf"]=="" || !is_file($ruta_db_superior.$datos[0]["pdf"]))
     {  //se llama el pdf para crearlo y colocarlo como adjunto
        ?>
        <script type="text/javascript" src="../js/jquery.js"> </script>
        <script>
        $.ajax({
           type: "POST",
           url:"../class_impresion.php",
           data:'iddoc=<?php echo $_REQUEST["iddoc"]; ?>&rand=<?php echo(rand(1,999)); ?>',
           async: false
         });    
        </script>
      <?php 
      $datos_documento = busca_filtro_tabla(fecha_db_obtener('A.fecha', 'Y-m-d') . " as x_fecha, A.*", "documento A", "A.iddocumento=" . $_REQUEST["iddoc"], "", $conn);
      $ruta_pdfs = ruta_almacenamiento("pdf");
      $formato_ruta = aplicar_plantilla_ruta_documento($_REQUEST["iddoc"]);
      $ruta = $ruta_pdfs . $formato_ruta . "/pdf/";
      $ruta .= ($datos_documento[0]["plantilla"]) . "_" . $datos_documento[0]["numero"] . "_" . str_replace("-", "_", $datos_documento[0]["x_fecha"]) .".pdf";
      
      $texto_pdf.='<input name="pdf" value="'.$ruta.'" type="checkbox" checked><a href="'.$ruta.'" target="_blank">'."documento_".$datos[0]['numero'].".pdf".'</a><input type="hidden" name="nombre_pdf" value="'."documento_".$datos[0]['numero'].".pdf".'"><br />';
     }
     else{
       $texto_pdf.='<input name="pdf" value="'.$ruta_db_superior.$datos[0]['pdf'].'" type="checkbox" checked><a href="'.$ruta_db_superior.$datos[0]['pdf'].'" target="_blank">'."documento_".$datos[0]['numero'].".pdf".'</a><input type="hidden" name="nombre_pdf" value="'."documento_".$datos[0]['numero'].".pdf".'"><br />';
     }        
    }   
   echo "<tr><td class='encabezado'>ARCHIVOS ADJUNTOS</td><td bgcolor='#F5F5F5'><br />".$texto_anexo.$texto_pagina.$texto_pdf; 
   echo "<input type='hidden' name='archivo_idarchivo' value='".$_REQUEST["iddoc"]."' >";
 echo "<tr>
       <td colspan=2 align=center><input type=submit value='Enviar'>
       </td></tr></table>
       <input name='enviar' value='1' type='hidden'>
       </form>";
  include_once($ruta_db_superior."footer.php");        
}
/*
<Clase>
<Nombre>pc_html2ascii</Nombre> 
<Parametros>$s</Parametros>
<Responsabilidades>Convierte codigo HTML a codigo ASCII<Responsabilidades>
<Notas>Se utiliza para el contenido del email</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function pc_html2ascii($s) {
// convert links
$s = preg_replace('/<a\s+.*?href="?([^\" >]*)"?[^>]*>(.*?)<\/a>/i',
'$2 ($1)', $s);

// convert <br>, <hr>, <p>, <div> to line breaks
$s = preg_replace('@<(b|h)r[^>]*>@i',"\n",$s);
$s = preg_replace('@<p[^>]*>@i',"\n\n",$s);
$s = preg_replace('@<div[^>]*>(.*)</div>@i',"\n".'$1'."\n",$s);

// convert bold and italic
$s = preg_replace('@<b[^>]*>(.*?)</b>@i','*$1*',$s);
$s = preg_replace('@<i[^>]*>(.*?)</i>@i','/$1/',$s);

// decode named entities
$s = strtr($s,array_flip(get_html_translation_table(HTML_ENTITIES)));

// decode numbered entities
$s = preg_replace('//e','chr(\\1)',$s);

// remove any remaining tags
$s = strip_tags($s);

return $s;
}   
  
/*
<Clase>
<Nombre>enviar_email</Nombre> 
<Parametros>$doc:identificador del documento</Parametros>
<Responsabilidades>recibe los datos y envia el mensaje por correo electronico. Despues de enviar el mensaje realiza transferencia al radicador de salida y en notas queda el registro de a quien se envio el documento (destino,copia y copia oculta)<Responsabilidades>
<Notas>cuando $doc tiene un valor se trata del formato mensaje por lo tanto se busca los datos en la tabla ft_mensaje, cuando no hay $doc se trata  del formulario y se reciben los datos en el $_REQUEST</Notas>
<Excepciones>No hace el envio de correo si no esta configurado el servidor de correo; Muestra mensaje sino fue exitoso el envio; Si no se hace la transferencia muestra notificacion</Excpciones>
<Salida></Salida>
<Pre-condiciones>En la tabla configuracion debe de estar creado el campo servidor_correo y radicador_salida<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/  
function enviar_email($doc = 0) {
	global $conn;
	$vector_destinos = array();
	$copia = array();
	$email = busca_filtro_tabla("valor", "configuracion", "nombre='servidor_correo'", "", $conn);
	$puerto = busca_filtro_tabla("valor", "configuracion", "nombre='puerto_servidor_correo'", "", $conn);
	$vector_anexos = array();

	if ($email["numcampos"]) {
		if ($doc <> 0) {$datos = busca_filtro_tabla("*", "ft_mensaje", "documento_iddocumento=$doc", "", $conn);

			if ($datos["numcampos"] > 0) {
				$asunto = html_entity_decode($datos[0]["asunto"]);
				$destinos = $datos[0]["destinatario"];
				$contenido = pc_html2ascii($datos[0]["contenido"]);
				$from = $datos[0]["remitente_mensaje"];
				if ($datos[0]["copia"] != "")
					$copia = explode(",", $datos[0]["copia"]);

				$archivo = busca_filtro_tabla("*", "anexos", "documento_iddocumento=" . $doc, "", $conn);
				if ($archivo["numcampos"] > 0) {
					for ($i = 0; $i < $archivo["numcampos"]; $i++) {
						$vector_anexos[] = $archivo[$i]["ruta"];
					}

				}

				$pdf_documento = busca_filtro_tabla("pdf,numero", "documento", "iddocumento=" . $doc, "", $conn);
				if ($pdf_documento['numcampos']) {
					$vector_anexos[] = $pdf_documento[0]["pdf"];
				}

			}
			$enlace = "../documentoview.php?key=$doc";
		} else {
			if (isset($_REQUEST["de"]))
				$from = $_REQUEST["de"];
			if (isset($_REQUEST["asunto"]))
				$asunto = html_entity_decode($_REQUEST["asunto"]);
			if (isset($_REQUEST["para"]))
				$destinos = $_REQUEST["para"];
			if (isset($_REQUEST["contenido"]))
				$contenido = ($_REQUEST["contenido"]);
			$enlace = "../documentoview.php?key=$doc";
		}
		$copia_asunto = utf8_decode($asunto);

		$nombre = busca_filtro_tabla("nombres,apellidos", "funcionario", "funcionario_codigo=" . $_SESSION["usuario_actual"], "", $conn);
		$vector_destinos["para"] = explode(",", $destinos);

		if ($_REQUEST["para_cc"] <> "") {
			$vector_destinos_copia = explode(",", $_REQUEST["para_cc"]);
			$vector_destinos['copia'] = $vector_destinos_copia;
		}

		if ($_REQUEST["para_cco"] <> "") {
			$vector_destinos_copia_oculta = explode(",", $_REQUEST["para_cco"]);
			$vector_destinos['copia_oculta'] = $vector_destinos_copia_oculta;
		}

		$config = busca_filtro_tabla("valor", "configuracion", "nombre='color_encabezado'", "", $conn);
		$admin_saia = busca_filtro_tabla("valor", "configuracion", "nombre='login_administrador'", "", $conn);
		$correo_admin = busca_filtro_tabla("email", "funcionario", "login='" . $admin_saia[0]['valor'] . "'", "", $conn);

		$anexo = @$_REQUEST["anexos"];
		if ($anexo != "") {
			$anexos = busca_filtro_tabla("ruta,etiqueta,idanexos", "anexos", "idanexos IN(" . implode(",", $anexo) . ")", "", $conn);
			if ($anexos["numcampos"]) {
				for ($i = 0; $i < $anexos["numcampos"]; $i++) {
					$vector_anexos[] = $anexos[$i]["ruta"];
				}
			}
		}

		if (@$_REQUEST["paginas"] != "" && @$_REQUEST["nombre_paginas"]) {
			$vector_anexos[] = $_REQUEST["paginas"];

		}
		if (@$_REQUEST["pdf"] != "" && @$_REQUEST["nombre_pdf"]) {
			$vector_anexos[] = $_REQUEST["pdf"];
		}
		$tipo_usuario = array("para" => "email", "copia" => "email", "copia_oculta" => "email");
		$resultado_envio = enviar_mensaje("personal", $tipo_usuario, $vector_destinos, $copia_asunto, $contenido, $vector_anexos, $_REQUEST["archivo_idarchivo"]);
		if ($resultado_envio === true) {
			alerta("Mensaje enviado");
		} else {
			alerta("Por favor confirme el envio de correo y las transferencias, es posible que existan problemas");
			volver(2);
			die();
		}
		abrir_url("email_doc.php?formato_enviar=true&no_menu=1&iddoc=" . $_REQUEST["archivo_idarchivo"], "_self");
	} else {
		alerta("No se ha definido un servidor de Correo en la configuracion del sistema, por favor comuniquese con su administrador");
		abrir_url("email_doc.php?formato_enviar=true&no_menu=1&iddoc=" . $_REQUEST["archivo_idarchivo"], "_self");
	}
}

if(isset($_REQUEST["formato_enviar"]))
  formato_email();
elseif(isset($_REQUEST["enviar"]))
  enviar_email();
  

?>

<!--head>
<script language="javascript" type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<!--script language="javascript" type="text/javascript">
tinyMCE.init({
mode : "textareas",
theme : "advanced",
plugins : "table,advhr,advimage,advlink,insertdatetime,searchreplace,contextmenu,paste,directionality,noneditable,xhtmlxtras",
theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,|,forecolor,backcolor",
theme_advanced_buttons2 : "cut,copy,paste,pastetext,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,insertdate,inserttime",
theme_advanced_buttons3 : "tablecontrols,|,removeformat,visualaid,|,sub,sup,|,charmap,advhr,|",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
height:"350px",
width:"600px"
});
	
</script-->	
<!--/head-->
