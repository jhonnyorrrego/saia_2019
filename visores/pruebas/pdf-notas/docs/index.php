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

//$_REQUEST['iddocumento'] puede ser iddocumento,idanexo o  idanexos_transferencia dependiendo del tipo
//$_REQUEST["tipo"] puede ser documento ,anexo o anexos_transferencia
if(!$_REQUEST["ruta"]){
	if($_REQUEST["tipo"]=='anexo'){
		$pdf=busca_filtro_tabla("","anexos","idanexos=".$_REQUEST['iddocumento'],"",$conn);
		$ruta_pdf=$pdf[0]['ruta'];
		$tipo=$_REQUEST["tipo"];
		$idarchivo=$pdf[0]['documento_iddocumento'];
	}else if($_REQUEST["tipo"]=='anexo_trans'){
		$pdf=busca_filtro_tabla("","anexos_transferencia","idanexos_transferencia=".$_REQUEST['iddocumento'],"",$conn);
		$ruta_pdf=$pdf[0]['ruta'];
		$tipo=$_REQUEST["tipo"];
		$idarchivo=$pdf[0]['documento_iddocumento'];
	}else{
		$pdf=busca_filtro_tabla("","documento","iddocumento=".$_REQUEST['iddocumento'],"",$conn);
		$ruta_pdf=$pdf[0]['pdf'];
		$tipo='documento';
		$idarchivo=$_REQUEST['iddocumento'];
	}
	
}else{
	$ruta_pdf=$_REQUEST["ruta"];
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>PDFJSAnnotate</title>
  <script src="../../../../js/jquery-1.7.min.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="shared/toolbar.css"/>
  <link rel="stylesheet" type="text/css" href="../../../../css/bootstrap.css"/>
  <link rel="stylesheet" type="text/css" href="shared/pdf_viewer.css"/>
  <style type="text/css">
    body {
      background-color: #eee;
      font-family: sans-serif;
      margin: 0;
    }

    .pdfViewer .canvasWrapper {
      box-shadow: 0 0 3px #bbb;
    }
    .pdfViewer .page {
      margin-bottom: 10px;
    }

    .annotationLayer {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
    }

    #content-wrapper {
      position: absolute;
      top: 35px;
      left: 0;
      right: 250px;
      bottom: 0;
      overflow: auto;
    }

    #comment-wrapper {
      position: absolute;
      top: 35px;
      right: 0;
      bottom: 0;
      overflow: auto;
      width: 250px;
      background: #eaeaea;
      border-left: 1px solid #d0d0d0;
    }
    #comment-wrapper h4 {
      margin: 10px;
    }
    #comment-wrapper .comment-list {
      font-size: 12px;
      position: absolute;
      top: 38px;
      left: 0;
      right: 0;
      bottom: 0;
    }
    #comment-wrapper .comment-list-item {
      border-bottom: 1px solid #d0d0d0;
      padding: 10px;
    }
    #comment-wrapper .comment-list-container {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 47px;
      overflow: auto;
    }
    #comment-wrapper .comment-list-form {
      position: absolute;
      left: 0;
      right: 0;
      bottom: 0;
      padding: 10px;
    }
    #comment-wrapper .comment-list-form input {
      padding: 5px;
      width: 100%;
    }
    .pdfViewer .page {
      border-image: none;
    }
  </style>
</head>
<body >
  <div class="toolbar">
  	<input type="hidden" id="documento_iddocumento" value="<?php echo($_REQUEST['iddocumento']);?>" iddoc_padre="<?php echo($idarchivo);?>" ruta="<?php echo($ruta_db_superior.$pdf[0]['pdf']);?>">
  	<input type="hidden" id="ruta" value="<?php echo($ruta_db_superior.$ruta_pdf);?>" codificada="<?php echo(base64_encode($ruta_pdf));?>">
  	<input type="hidden" id="tipo" value="<?php echo($tipo);?>">
  	<div class="spacer"></div>
    <button class="cursor btn btn-inverse" type="button" title="Cursor" data-tooltype="cursor">➚</button>

    <div class="spacer"></div>
         
    <button  "background-color: #f5f900" class="rectangle btn btn-inverse" type="button" id="boton_area" title="Rectangle" data-tooltype="area">&nbsp;</button>
    <!--div class="spacer"></div-->
    <button id="opc_highlight" class="highlight" type="button" title="Highlight" data-tooltype="highlight">&nbsp;</button>
    
    <!--button class="strikeout" type="button" title="Strikeout" data-tooltype="strikeout">&nbsp;</button-->
	<button class="sello btn btn-inverse" id="opc_sello" type="button" title="Sello"  imagen="sello.jpg"  data-tooltype="sello">Sello</button>
    <!--div class="spacer"></div-->

    <button id="opc_text" class="text" type="button" title="Text Tool" data-tooltype="text"></button>
    <select id="opc_text-size" class="text-size"></select>
    <div id="opc_text-color" class="text-color"></div>

    <!--div class="spacer"></div-->

    <!--button class="pen" type="button" title="Pen Tool" data-tooltype="draw">✎</button>
    <select class="pen-size"></select>
    <div class="pen-color"></div>

    <div class="spacer"></div-->

    <button id="opc_comment" class="comment" type="button" title="Comment" data-tooltype="point">🗨</button>

    <div class="spacer"></div>

    <select class="scale" id="opc_escala">
      <option value=".5">50%</option>
      <option value="1">100%</option>
      <option value="1.33">133%</option>
      <option value="1.5">150%</option>
      <option value="2">200%</option>
    </select>

    <a href="javascript://" id="opc_derecha" class="rotate-ccw" title="Rotate Counter Clockwise">⟲</a>
    <a href="javascript://" id="opc_izquierda" class="rotate-cw" title="Rotate Clockwise">⟳</a>
    <a href="javascript://" id="cambio_visor" class="cambiar_visor" title="Cambiar visor"><button class="sello btn btn-inverse">Ir a PDF Original</button></a>
	<div class="spacer"></div>
	
    <a href="javascript://" class="clear" title="Clear"><button id="borrar_todo" class="sello btn btn-inverse">X</button></a>
  </div>
  <div id="content-wrapper">
    <div id="viewer" class="pdfViewer"></div>
  </div>
  <div id="comment-wrapper">
    <h4 id="comentario4">Comentarios</h4>
    <div class="comment-list">
      <div class="comment-list-container">
        <div class="comment-list-item">No posee comentarios</div>
      </div>
      <form class="comment-list-form" style="display:none;">
        <input type="text" placeholder="Adicionar comentario"/>
      </form>
    </div>
  </div>
  <script src="shared/pdf.js"></script>
  <script src="shared/pdf_viewer.js"></script>
  <script src="index.js"></script>
</body>
</html>
<script>
function activar_over(ft_notas_pdf,elemento,idelemento,comentario){
	
	if(elemento=='area'){
		$('#'+ft_notas_pdf).attr('stroke','#f00');
		$('#'+ft_notas_pdf).attr('fill','none');
	}
	if(elemento=='highlight'){
		$('#'+ft_notas_pdf).attr('stroke','green');
		$('#'+ft_notas_pdf).attr('fill','green');
	}
	if(comentario=='comentario'){
		var eliminar=document.getElementById('elimina-comentario-'+idelemento);
		eliminar.style.display='';
	}
}

function desactivar_over(ft_notas_pdf,elemento,idelemento,comentario){
	
	if(elemento=='area'){
		
		$('#'+ft_notas_pdf).attr('stroke','yellow');
		$('#'+ft_notas_pdf).attr('fill','yellow');
		$('#'+ft_notas_pdf).attr('fill-opacity','0.2');
	}
	if(elemento=='highlight'){
		$('#'+ft_notas_pdf).attr('stroke','yellow');
		$('#'+ft_notas_pdf).attr('fill','yellow');
	}
	
	if(comentario=='comentario'){
		var eliminar=document.getElementById('elimina-comentario-'+idelemento);
		eliminar.style.display='none';
	}
	
}

function ubicar_elemento(idelemento,elemento){

	var eliminar=document.getElementById('elimina-'+elemento+'-'+idelemento);
	eliminar.style.display=''; 

}

function salir_elemento(idelemento,elemento){
	var eliminar=document.getElementById('elimina-'+elemento+'-'+idelemento);
	eliminar.style.display='none'; 
}

function eliminar_elemento(idelemento,iddoc,elemento){
	
	$("#div-"+elemento+"-"+idelemento).remove();
	
	$.ajax({
			type:'POST',
			url: "cargar_notas_pdf.php",
			dataType: "html",
			data: {
				iddoc:iddoc,
				tipo_archivo:document.getElementById('tipo').getAttribute("value"),
				eliminar:1,
				idft_notas_pdf:idelemento				
			}
		});
}

function eliminar_comentario(idcomentario,iddoc,ft_notas_pdf,elemento){
	$.ajax({
			type:'POST',
			url: "almacenar_comentarios_pdf.php",
			dataType: "html",
			data: {
				iddoc:iddoc,
				tipo_archivo:document.getElementById('tipo').getAttribute("value"),
				eliminar:1,
				idcomentario_pdf:idcomentario				
			}
		});
		
		$("#div-comentario-"+idcomentario).remove();
		$('#'+ft_notas_pdf).attr('stroke','#f00');
		$('#'+ft_notas_pdf).attr('fill','none');
}




</script>
