<?php
@session_start();
$_SESSION["verifica"] = 1;
include_once("define_remoto.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SISTEMA DE PETICIONES</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link href="css/bootstrap_v3.1.min.css" rel="stylesheet">
	<style>
		.my-error-class {
		    color:#FF0000; 
		}
		.my-valid-class {
		    color:#000000; 
		}
		.error{
			color:red;
		}
		body{
		  font-size:8pt;
		}
	</style>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/jquery.validate.1.12.0.js"></script>
	<script src="js/jquery.MultiFile.js"></script>
</head>
<body>
	<div class="container">
	  <center><img src="../imagenes_webservice/header.jpg"></center>
		<div id="loginbox" style="">
			<div class="panel" style="width: auto; height: auto;">
				<div class="panel-heading">
				  <div class="col-sm-1"></div>
					<div class="btn-group" role="group" >
						<button type="button" iddiv="div_pqr" id="div_pqr" class="btn btn-primary" style="font-size:8pt;">PQR</button>
						<button type="button" iddiv="div_consulta" id="div_consulta" class="btn btn-primary" style="font-size:8pt;">Consulta</button>
					</div>
				</div>
				<div id="formulario_pqr">
					<form class="form-horizontal" name="formulario_formatos" id="formulario_formatos" method="post" action="radicar_plantilla_saia.php" enctype="multipart/form-data"><br/>
						<div class="form-group">
							<label for="nombre" class="col-sm-4 control-label">NOMBRE COMPLETO*</label>
							<div class="col-sm-6">
								<input tabindex="1" type="text" id="nombre" name="nombre" value="" class="form-control required">
							</div>
						</div>
						<div class="form-group">
							<label for="documento" class="col-sm-4 control-label">DOCUMENTO</label>
							<div class="col-sm-6">
								<input tabindex="2" type="text" id="documento" name="documento" value="" class="form-control col-sm-4">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-4 control-label">EMAIL*</label>
							<div class="col-sm-6">
								<input tabindex="3" type="text" id="email" name="email" value="" class="form-control col-sm-4 required">
							</div>
						</div>
						<div class="form-group">
							<label for="confirmar_email" class="col-sm-4 control-label">CONFIRMAR EMAIL</label>
							<div class="col-sm-6">
								<input tabindex="4" type="text" id="confirmar_email" name="" value="" equalTo="#email" class="form-control col-sm-4 email">
							</div>
						</div>
						<div class="form-group">
							<label for="telefono" class="col-sm-4 control-label">CELULAR</label>
							<div class="col-sm-6">
								<input tabindex="4" type="text" id="telefono" name="telefono" value="" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="rol_institucion" class="col-sm-4 control-label">ROL EN LA INSTITUCI&Oacute;N*</label>
							<div class="col-sm-6">
								<select tabindex="6"  name="rol_institucion" id="rol_institucion" class="required form-control">
										<option value="" selected="">Por favor seleccione...</option>
										<option value="1">Cliente</option>
										<option value="2">Empleado Activo</option>
										<option value="3">Ex­empleado</option>
										<option value="4">Proveedor</option>
										<option value="5">Usuario general</option>
									</select>
							</div>
						</div>
						<div class="form-group">
							<label for="tipo" class="col-sm-4 control-label">TIPO DE PQRS*</label>
							<div class="col-sm-6">
								<select tabindex="7"  name="tipo" id="tipo" class="required form-control">
										<option selected="" value="">Por favor seleccione...</option>
										<option value="1">Peticion</option>
										<option value="2">Queja</option>
										<option value="3">Reclamo</option>
										<option value="4">Sugerencias</option>
										<option value="5">Felicitaciones</option>
									</select>
							</div>
						</div>
						<div class="form-group">
							<label for="comentarios" class="col-sm-4 control-label">DESCRIPCI&Oacute;N*</label>
							<div class="col-sm-6">
								<textarea tabindex="8" name="comentarios" id="comentarios" cols="39" rows="3" class="input-xlarge required form-control"></textarea>
									<label for="resumen_hechos" class="error"></label>
							</div>
						</div>
						<!--div class="form-group">
							<label for="iniciativa_publica" class="col-sm-4 control-label">INICIATIVA PÚBLICA*</label>
							<div class="col-sm-6">
								<label for="iniciativa">Iniciativa:</label>
								<select tabindex="9" class="form-control" id="iniciativa"></select>
								<label for="iniciativa_publica">Proyecto:</label>
								<select tabindex="10" id="iniciativa_publica" name="iniciativa_publica" class="form-control"></select>
							</div>
						</div>
						<div class="form-group">
							<label for="sector_iniciativa" class="col-sm-4 control-label">SECTOR DE LA INICIATIVA*</label>
							<div class="col-sm-6">
								<select tabindex="11" name='sector_iniciativa' id='sector_iniciativa' class="form-control"></select>
							</div>
						</div>
						<div class="form-group">
							<label for="cluster" class="col-sm-4 control-label">CLUSTER*</label>
							<div class="col-sm-6">
								<label for="servicio_cluster">Servicio:</label>
								<select tabindex="12" class="form-control" id="servicio_cluster"></select>
								<label for="cluster">Cluster:</label>
								<select tabindex="13" id="cluster" name="cluster" class="form-control"></select>
							</div>
						</div>
						<div class="form-group">
							<label for="region" class="col-sm-4 control-label">REGION*</label>
							<div class="col-sm-6">
								<label for="region_region">Region:</label>
								<select tabindex="14" class="form-control" id="region_region"></select>
								<label for="region">Zona:</label>
								<select tabindex="15" id="region" name="region" class="form-control"></select>
							</div>
						</div-->
						<div class="form-group">
							<label for="anexo_digital" class="col-sm-4 control-label">ANEXOS</label>
							<div class="col-sm-6">
								<input tabindex="16" type="file" class="" name="anexo_digital[]" accept="jpg|gif|doc|ppt|xls|txt|pdf|docx|pptx|pps|xlsx|png" tabindex="16">							
								<label for="anexo_digital" class="error"></label>
							</div>
						</div>
						<div class="form-group">
							<label for="respuesta" class="col-sm-4 control-label">POR FAVOR INGRESE EL RESULTADO*</label>
							<div class="col-sm-6">
								<?php echo(generar_captcha_2()); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 col-md-offset-6">
								<button type="submit" class="btn btn-primary" tabindex="10" style="font-size:8pt;">Enviar Solicitud</button>
							</div>
						</div>
						
						<div class="form-actions">
							<input type='hidden' name='estado_reporte' value='1'>
							<input type='hidden' name='estado_verificacion' value='1'>
							<input type='hidden' name='funcionario_reporte' value='10094'>
							<input type='hidden' name='fecha_reporte' value='<?php echo(date('Y-m-d')); ?>'>
							<!--input type='hidden' name='rol_institucion' value='8'-->
							<input type='hidden' name='dependencia' value='214'>
							<input type="hidden" name="serie_idserie" value="1032">
							<input type="hidden" name="idft_pqrsf" value="">					
							<input type="hidden" name="documento_iddocumento" value="">
							<input type="hidden" name="encabezado" value="1">
							<input type="hidden" name="estado_documento" value="1">
							<input type="hidden" name="firma" value="1">
							<input type="hidden" name="campo_descripcion" value="3572">
							<input type="hidden" name="tipo_radicado" value="radicacion_entrada">
							<input type="hidden" name="funcion" value="radicar_plantilla">
							<input type="hidden" name="tabla" value="ft_pqrsf">
							<input type="hidden" name="formato" value="pqrsf">
							<input type="hidden" name="continuar" value="Solicitar Radicado" >
						</div>
					</form>
				</div>
				<div id="consulta_pqr">
					<form class="form-horizontal" name="formulario_consulta" id="formulario_consulta">
					  <div>
					    <div class="col-sm-2"></div>
					     <p style="font-size:12pt">Por favor escriba su documento de identificaci&oacute;n y el n&uacute;mero de radicado para buscar su solicitud:</p>
					     <br/>
					  </div>
						<div class="form-group">
							<label for="valor" class="col-sm-4 control-label">NUMERO DE DOCUMENTO</label>
							<div class="col-sm-6">
								<input type="text" name="valor" id="valor" value="" class="required form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="valor" class="col-sm-4 control-label">NUMERO DE RADICADO</label>
							<div class="col-sm-6">
								<input type="text" name="valor2" id="valor2" value="" class="required form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 col-md-offset-3">
								<input class="btn btn-primary" style="font-size:8pt;" type="submit" class="form-control" value="Consultar">
							</div>
						</div>
					</form>
					<br/>
					<br/>
					<div id="respuesta_solicitud"></div>
				</div>
			</div>
		</div>
		<center><img src="../imagenes_webservice/footer.jpg"></center>	
	</div>
	<script src="js/jquery-1.7.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/jasny-bootstrap.min.js"></script>
	<script src="js/jquery.validate.1.12.0.js"></script>
	<script src="js/jquery.MultiFile.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#consulta_pqr").hide();
			$.ajax({
				  url: 'carga_select.php',
				  type: 'POST',
				  dataType: 'json',
				  data: {
				  	cargar_todo:1
				  },
				  success: function(data) {
				    $("#iniciativa").append(data.iniciativa);
				    $("#sector_iniciativa").append(data.sector);
				    $("#servicio_cluster").append(data.cluster);
				    $("#region_region").append(data.region);
				    $("#numero_radicado").val(data.numero_radicado);
				  }
			});
			$("#iniciativa").change(function(){
				$.ajax({
				  url: 'carga_select.php',
				  type: 'POST',
				  dataType: 'json',
				  data: {
				  	idserie: $("#iniciativa").val()
				  },				  
				  success: function(data) {
				    $("#iniciativa_publica").html("");
				    $("#iniciativa_publica").append(data.resultado);
				  }
				});
			});
			$("#servicio_cluster").change(function(){
				$.ajax({
				  url: 'carga_select.php',
				  type: 'POST',
				  dataType: 'json',
				  data: {
				  	idserie: $("#servicio_cluster").val()
				  },				  
				  success: function(data) {
				    $("#cluster").html("");
				    $("#cluster").append(data.resultado);
				  }
				});
			});
			$("#region_region").change(function(){
				$.ajax({
				  url: 'carga_select.php',
				  type: 'POST',
				  dataType: 'json',
				  data: {
				  	idserie: $("#region_region").val()
				  },				  
				  success: function(data) {
				    $("#region").html("");
				    $("#region").append(data.resultado);
				  }
				});
			});
			$("#div_pqr").click(function(){
				$("#formulario_pqr").show();
				$("#consulta_pqr").hide();
			});
			
			$("#div_consulta").click(function(){
				$("#formulario_pqr").hide();
				$("#consulta_pqr").show();
			});
			
			$.ajax({
			  url: 'solicitud_ciudad.php',
			  type: 'POST',
			  dataType: 'json',
			  data: {
			  	tipo: 1			  	
			  },
			  success: function(data) {			    
			    $("#pais").append(data.pais);
			    $("#departamento").append(data.departamento);
			    $("#municipios").append(data.municipio);
			  }
			});
			
			$("#pais").change(function(){
				$.ajax({
				  url: 'solicitud_ciudad.php',
				  type: 'POST',
				  dataType: 'json',
				  data: {
				  	tipo: 2,
				  	pais: $(this).val()			  	
				  },				  
				  success: function(data) {
				  	$("#departamento").html("");			    
				    $("#departamento").append(data.departamento);
				    $("#municipios").html("");
				    $("#municipios").append(data.municipio);
				  }
				});
			});
			
			$("#departamento").change(function(){
				$.ajax({
				  url: 'solicitud_ciudad.php',
				  type: 'POST',
				  dataType: 'json',
				  data: {
				  	tipo: 3,
				  	departamanto: $(this).val()			  	
				  },				  
				  success: function(data) {				  					  	
				    $("#municipios").html("");
				    $("#municipios").append(data.municipio);
				  }
				});
			});
			
			$("#formulario_formatos").validate({
					debug: true,				
					rules:{
					recaptcha_response_field:{						
						required: true
										 
					},
					  email:{					
							email: true						
						},
					  confirmar_email:{						
							equalTo : "#email",
							email: true						
						}
					},
					messages: {
					  confirmar_email:{
					  	email : "Digite un direcci&oacute;n email"
					  },
					  confirmar_email:{						
							equalTo : "Debe conincidir con el campo EMAIL",
							email : "Digite un direcci&oacute;n email"						
						}
					},
					submitHandler: function(form){
						form.submit();
					}
				});
				
				$("#formulario_consulta").validate({
					debug: true,				
					rules:{
						numero_radicado:{						
							required: true,
							digits: true				 
						},
						identificacion:{
							required: true,
							//digits: true
						}				 
					},
					messages: {
						numero_radicado:{
					        required: "Campo obligatorio",
					        digits: "Ingrese solo valores numericos"
					  },
					  identificacion:{
					        required: "Campo obligatorio",
					        //digits: "Ingrese solo valores numericos"
					  },
					},
					submitHandler: function(form){
						//var x_tipo=$('input:radio[name=tipo]:checked').val();
						var x_valor=$("#valor").val();
						var x_valor2=$("#valor2").val();
						 $.ajax({
						 	url: "solicitud_remota_documentos.php",
						  method:"post",
						  dataType: 'html',
						  data:{
						  	valor  : x_valor,
						  	valor2 : x_valor2
						  },
						  success: function(html){
						      $("#respuesta_solicitud").html(html);
						  }
						 });								
				  }
				});
		});		tabindex="1" 
	</script>	
</body>
</html>
<?php
function generar_captcha_2($datos){
  $numero1=rand(1,20);
  $numero2=rand(1,20);
  $signo=array("+");//,"*","/");
  $signof=$signo[rand(0,0)];
  $resultado=$numero1.$signof.$numero2;
  switch($signof){
    case "+":
      $resultadof=$numero1+$numero2;
    break;
    case "-":
      $resultadof=$numero1-$numero2;
    break;
    case "*":
      $resultadof=$numero1*$numero2;
    break;
    case "/":
      $resultadof=$numero1/$numero2;
    break;
  }
  $texto.= strlen($resultado);
  $texto.= strlen($resultadof);
  $texto='<input type="text" name="pregunta" value="'.$resultado.'" readonly class="input-mini form-control">=<input type="hidden" id="resultado_ecuacion" readonly value="'.($resultadof).'"/><input name="respuesta" type="text" value="" equalTo="#resultado_ecuacion" class="input-mini required form-control" tabindex="17">';
  return($texto);
}  
?>