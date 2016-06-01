<?php
$usuario=""; $info="";$iddoc="";
if(@$_REQUEST['info']!=""){
	$datos=base64_decode($_REQUEST['info']);
	$info=explode(",",$datos);
	foreach($info as $data){
		$parametros=explode("-", $data);
		$_REQUEST[$parametros[0]]=$parametros[1];
	}
	$usuario=$_REQUEST['usuario'];
	$info=$_REQUEST['info'];
	$iddoc=$_REQUEST['iddoc'];
}
if($usuario=="" || $iddoc=="" || $info==""){
	?>
	<script>
	alert("Por favor ingrese desde el link enviado");
	</script>
	<?php
	die();
}


require_once("define_remoto.php");
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="es" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="es" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="es" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="es"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Gestion comunicaciones externas</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>

<div class="container-fluid">
	<br>
	<div class="encabezado">
		APROBACIONES - SAIA
	</div>		
	<section id="content">
		<form id="formulario" id="formulario" method="POST" action="validar_ingreso.php">
			<!--img src="imagenes/logo_demo628-20160329.jpg" class="img-responsive"></img--><br/><br/>
			<div>
				<input type="text" placeholder="Login"  id="login" name="login" />
			</div>
			<div>
				<input type="password" placeholder="Password" id="password" name="password" />
			</div>
			<div>
			<input type="hidden" id="iddoc" name="iddoc"  value="<?php echo $iddoc; ?>"/>
			<input type="hidden" id="info" name="info" value="<?php echo $info; ?>"/>
			<input type="hidden" id="ingreso" name="ingreso" value="1"/>
			<input type="radio" name='accion' value='1' checked="true">Aprobar
			<input type="radio" name='accion' value='2'>Devolucion<br/><br/>
			<div id='div_notas'>OBSERVACIONES DE LA DEVOLUCIÓN
				<textarea name='notas' id='notas' rows="4" cols="30"></textarea>
			</div>
			<input type="submit" value="Enviar" />
			</div>
		</form>
	</section>
	<div class="pie">

  	<table style='border:none; font-size:11px;font-family:Roboto,Arial,Helvetica,sans-serif;color:#646464; vertical-align:middle;'>
		<tr>
			<td style="vertical-align:middle;">
				SAIA (Sistema de Administración Integral de Documentos y Procesos). 
			</td>
			<td style='text-align:right;'>
				<img src='<?php echo(PROTOCOLO_CONEXION.RUTA_PDF_LOCAL); ?>/imagenes/saia_gray.png'>				
			</td>
		</tr>
	</table>
		
	</div>	
</div>

<script src="js/jquery-1.7.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jasny-bootstrap.min.js"></script>
<script src="js/jquery.validate.1.12.0.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#div_notas').hide();
		$("input[name='accion']").click(function(){
			var valor=$(this).val();
			if(valor==2){
				$('#div_notas').show();
			}else{
				$('#div_notas').hide();
				$('#notas').val("");
			}
		});
		$("#formulario").validate({
			debug: true,				
			rules:{
				login:{						
					required: true
				},password:{					
					required: true					
				}
			},
			messages: {
				login :{
					required: "Ingrese el Login"
			  },password:{
				 required: "Ingrese la Clave"
			  }
			},
			submitHandler: function(form){					
				form.submit();
			}
		});
	});		
</script>
</body>
</html>