<!DOCTYPE html>
<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo(librerias_jquery("1.8"));

if (is_file($ruta_db_superior . $_REQUEST["file"])) {
	$url_regresar = $ruta_db_superior . "visores/pdf.js-view/web/viewer2.php?tipo=" . $_REQUEST["tipo"] . "&idtipo=" . $_REQUEST["idtipo"] . "&ruta=" . $_REQUEST["ruta"];
	$ruta_pdf = $ruta_db_superior . $_REQUEST["file"];

	echo '<input type="hidden" name="ruta" id="ruta" value="' . $ruta_pdf . '" codifica="' . $_REQUEST["ruta"] . '">';
	echo '<input type="hidden" name="tipo" id="tipo" value="' . $_REQUEST["tipo"] . '">';
	echo '<input type="hidden" name="idtipo" id="idtipo" value="' . $_REQUEST["idtipo"] . '">';
	echo '<input type="hidden" name="documento_iddocumento" id="documento_iddocumento" value="' . $_REQUEST["iddoc"] . '" iddoc_padre=0>';
} else {
	notificaciones("Error al cargar el PDF", "error");
	redirecciona($ruta_db_superior . "vacio.php");
	die();
}
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>PDFJSAnnotate</title>
		<link rel="stylesheet" type="text/css" href="shared/toolbar.css"/>
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
			<button class="cursor" type="button" title="Cursor" data-tooltype="cursor">
				➚
			</button>

			<div class="spacer"></div>

			<button class="rectangle" type="button" title="Rectangle" data-tooltype="area">
				&nbsp;
			</button>
			<button class="highlight hide_btn" type="button" title="Highlight" data-tooltype="highlight">&nbsp;</button>
			<button class="strikeout hide_btn" type="button" title="Strikeout" data-tooltype="strikeout">&nbsp;	</button>
			<button class="sello btn btn-inverse hide_btn" id="opc_sello" type="button" title="Sello"  imagen="sello.jpg"  data-tooltype="sello">Sello</button>
			<div class="spacer hide_btn"></div>
			<button class="text hide_btn" type="button" title="Text Tool" data-tooltype="text"></button>
			<select class="text-size hide_btn"></select>
			<div class="text-color hide_btn"></div>
			<div class="spacer hide_btn"></div>
			<button class="pen hide_btn" type="button" title="Pen Tool" data-tooltype="draw">
				✎
			</button>
			<select class="pen-size hide_btn"></select>
			<div class="pen-color hide_btn"></div>
			<div class="spacer hide_btn"></div>
			<button class="comment hide_btn" type="button" title="Comment" data-tooltype="point">
				🗨
			</button>

			<div class="spacer"></div>

			<select class="scale">
				<option value=".5">50%</option>
				<option value="1">100%</option>
				<option value="1.33">133%</option>
				<option value="1.5">150%</option>
				<option value="2">200%</option>
			</select>

			<a href="javascript://" class="rotate-ccw hide_btn" title="Rotate Counter Clockwise">⟲</a>
			<a href="javascript://" class="rotate-cw hide_btn" title="Rotate Clockwise">⟳</a>

			<div class="spacer"></div>
			<a href="javascript://" class="clear" title="Clear">×</a>
			<button id="regresar" title="PDF original">«</button>
			<!--button id="borrar_todo" class="sello btn btn-inverse">	X	</button-->
		</div>
		<div id="content-wrapper">
			<div id="viewer" class="pdfViewer"></div>
		</div>
		<div id="comment-wrapper">
			<h4>Comentarios</h4>
			<div class="comment-list">
				<div class="comment-list-container">
					<div class="comment-list-item">
						No posee comentarios
					</div>
				</div>
				<form class="comment-list-form" style="display:none;">
					<input type="text" placeholder="Adicionar Comentario"/>
				</form>
			</div>
		</div>
		<script src="shared/pdf.js"></script>
		<script src="shared/pdf_viewer.js"></script>
		<script src="index.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			$(".hide_btn").hide();
			$("#regresar").click(function() {
				window.open("<?php echo $url_regresar;?>",'_self')
			});
		});
		

	function activar_over(ft_notas_pdf, elemento, idelemento, comentario) {
		if (elemento == 'area') {
			$('#' + ft_notas_pdf).attr('stroke', '#f00');
			$('#' + ft_notas_pdf).attr('fill', 'none');
		}
		if (elemento == 'highlight') {
			$('#' + ft_notas_pdf).attr('stroke', 'green');
			$('#' + ft_notas_pdf).attr('fill', 'green');
		}
		if (comentario == 'comentario') {
			var eliminar = document.getElementById('elimina-comentario-' + idelemento);
			eliminar.style.display = '';
		}
	}

	function desactivar_over(ft_notas_pdf, elemento, idelemento, comentario) {
		if (elemento == 'area') {
			$('#' + ft_notas_pdf).attr('stroke', 'yellow');
			$('#' + ft_notas_pdf).attr('fill', 'yellow');
			$('#' + ft_notas_pdf).attr('fill-opacity', '0.2');
		}
		if (elemento == 'highlight') {
			$('#' + ft_notas_pdf).attr('stroke', 'yellow');
			$('#' + ft_notas_pdf).attr('fill', 'yellow');
		}

		if (comentario == 'comentario') {
			var eliminar = document.getElementById('elimina-comentario-' + idelemento);
			eliminar.style.display = 'none';
		}

	}

	function ubicar_elemento(idelemento, elemento) {
alert("ubicar_elemento");
		var eliminar = document.getElementById('elimina-' + elemento + '-' + idelemento);
		eliminar.style.display = '';

	}

	function salir_elemento(idelemento, elemento) {
		alert("salir_elemento");
		var eliminar = document.getElementById('elimina-' + elemento + '-' + idelemento);
		eliminar.style.display = 'none';
	}

	function eliminar_elemento(idelemento, iddoc, elemento) {
		alert("eliminar_elemento");
		$("#div-" + elemento + "-" + idelemento).remove();
		$.ajax({
			type : 'POST',
			url : "cargar_notas_pdf.php",
			dataType : "html",
			data : {
				iddoc : iddoc,
				tipo_archivo : document.getElementById('tipo').getAttribute("value"),
				eliminar : 1,
				idft_notas_pdf : idelemento
			}
		});
	}

	function eliminar_comentario(idcomentario, iddoc, ft_notas_pdf, elemento) {
		$.ajax({
			type : 'POST',
			url : "almacenar_comentarios_pdf.php",
			dataType : "html",
			data : {
				iddoc : iddoc,
				tipo_archivo : document.getElementById('tipo').getAttribute("value"),
				eliminar : 1,
				idcomentario_pdf : idcomentario
			}
		});

		$("#div-comentario-" + idcomentario).remove();
		$('#' + ft_notas_pdf).attr('stroke', '#f00');
		$('#' + ft_notas_pdf).attr('fill', 'none');
	}
		
		</script>
	</body>
</html>