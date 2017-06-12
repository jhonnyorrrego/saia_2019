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
	</style>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/jquery.validate.1.12.0.js"></script>
	<script src="js/jquery.MultiFile.js"></script>
</head>
<body>
	<div class="container">	
		<div id="loginbox" style="margin-top:50px;">
			<div class="panel panel-primary" style="width: 1142px; height: auto;">
				<div class="panel-heading">
					<div class="btn-group" role="group" >
						<button type="button" iddiv="div_pqr" id="div_pqr" class="btn btn-primary" >PQR</button>
						<button type="button" iddiv="div_consulta" id="div_consulta" class="btn btn-primary">Consulta</button>
					</div>
				</div>
				<div id="formulario_pqr" class="form-inline">
					<form class="form-horizontal" name="formulario_formatos" id="formulario_formatos" method="post" action="radicar_plantilla_saia.php" enctype="multipart/form-data">
						<table width="100%" class='table-responsive' style="padding: 10px;margin-left: 10px;">
							<tr><td colspan="2">&nbsp;</td></tr>
						
							<tr>
								<td style="width:30%">
									<label><b>N&Uacute;MERO RADICADO</b>*</label>
								</td>
								<td style="width:70%">
									<input tabindex="1" type="text" id="numero_radicado" readonly name="numero_radicado" value="" class="required" size="40">
								</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td style="width:30%">
									<label><b>FECHA</b>*</label>
								</td>
								<td style="width:70%">
									<input tabindex="1" type="text" id="fecha" readonly name="fecha" value="<?php echo(date("Y-m-d H:i:s")); ?>" class="required" size="40">
								</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td style="width:30%">
									<label><b>NOMBRE COMPLETO</b>*</label>
								</td>
								<td style="width:70%">
									<input tabindex="1" type="text" id="nombre" name="nombre" value="" class="required" size="40">
								</td>
							</tr>
							
							<tr><td colspan="2">&nbsp;</td></tr>
						
							<tr>
								<td>
									<label><b>DOCUMENTO</b></label>
								</td>
								<td>
									<input tabindex="2" type="text" id="documento" name="documento" class=""  value="" size="40">
								</td>
							</tr>
							
							<tr><td colspan="2">&nbsp;</td></tr>
						
							<tr>
								<td>
									<label><b>EMAIL*</b></label>
								</td>
								<td>
									<input maxlength="255" tabindex="3" type="text" id="email" name="email" class="email required" size="40">
								</td>
							</tr>
							
							<tr><td colspan="2">&nbsp;</td></tr>
						
							<tr>
								<td>
									<label><b>CONFIRMAR EMAIL</b></label>
								</td>
								<td>
									<input maxlength="255" tabindex="4" type="text" id="confirmar_email" name="" class="email" equalTo="#email" size="40">
								</td>
							</tr>
							
							<tr><td colspan="2">&nbsp;</td></tr>
						
							<tr>
								<td>
									<label><b>CELULAR</b></label>
								</td>
								<td>
									<input maxlength="255" tabindex="5" type="text" id="telefono" name="telefono" size="40">
								</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>
									<label><b>ROL EN LA INSTITUCI&Oacute;N*</b></label>
								</td>
								<td>
									<select tabindex="6"  name="rol_institucion" id="rol_institucion" class="required">
										<option value="" selected="">Por favor seleccione...</option>
										<option value="1">Estudiante</option>
										<option value="2">Docente</option>
										<option value="3">Administrativo</option>
										<option value="4">Egresado</option>
										<option value="5">Aspirante</option>
										<option value="6">Directivo</option>
										<option value="7">Padre Familia-Representante-Acudiente</option>
										<option value="8">Usuarios de Servicio</option>
									</select>
								</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
						
							<tr>
								<td>
									<label><b>TIPO DE PQRS*</b></label>
								</td>
								<td>
									<select name='tipo' id='tipo' class="required" tabindex="7">
										<option selected="" value="">Por favor seleccione...</option>
										<option value="1">Peticion</option>
										<option value="2">Queja</option>
										<option value="3">Reclamo</option>
										<option value="4">Sugerencias</option>
										<option value="5">Felicitaciones</option>
									</select>
								</td>
							</tr>
						
							<tr><td colspan="2">&nbsp;</td></tr>
							
							<tr>
								<td>
									<label><b>DESCRIPCI&Oacute;N*</b></label>
								</td>
								<td>
									<textarea tabindex="8" name="comentarios" id="comentarios" cols="39" rows="3" class="input-xlarge required"></textarea>
										<label for="resumen_hechos" class="error"></label>
								</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>
									<label><b>INICIATIVA PÚBLICA*</b></label>
								</td>
								<td>
									<table>
										<tr>
											<td>Iniciativa:</td>
											<td><select tabindex="9" id="iniciativa"></select></td>
										</tr>
										<tr>
											<td>Proyecto:</td>
											<td><select tabindex="10" id="iniciativa_publica" name="iniciativa_publica" class="required"></select></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
						
							<tr>
								<td>
									<label><b>SECTOR DE LA INICIATIVA*</b></label>
								</td>
								<td>
									<select name='sector_iniciativa' id='sector_iniciativa' class="required">
									</select>
								</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>
									<label><b>CLUSTER*</b></label>
								</td>
								<td>
									<table>
										<tr>
											<td>Servicio:</td>
											<td><select tabindex="11" id="servicio_cluster"></select></td>
										</tr>
										<tr>
											<td>Cluster:</td>
											<td><select tabindex="12" id="cluster" name="cluster" class="required"></select></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>
									<label><b>REGION</b></label>
								</td>
								<td>
									<table>
										<tr>
											<td>Region:</td>
											<td><select tabindex="13" id="region_region"></select></td>
										</tr>
										<tr>
											<td>Zona:</td>
											<td><select tabindex="14" id="region" name="region"></select></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>
									<label><b>ANEXOS</b></label>
								</td>
								<td>
									<input type="file" class="multi" name="anexo_digital[]" accept="jpg|gif|doc|ppt|xls|txt|pdf|docx|pptx|pps|xlsx|png" tabindex="15">							
										<label for="anexo_digital" class="error"></label>
								</td>
							</tr>
						
							<tr><td colspan="2">&nbsp;</td></tr>
							
							<tr>
								<td>
									<label><b>POR FAVOR INGRESE EL RESULTADO*</b></label>
								</td>
								<td>
									<?php echo(generar_captcha_2()); ?>
								</td>
							</tr>
						
							<tr><td colspan="2">&nbsp;</td></tr>
						
							<tr>
								<td colspan="2"><button type="submit" class="btn btn-primary" tabindex="10">Enviar Solicitud</button></td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
						</table>
							
							<div class="form-actions">
								<input type='hidden' name='estado_reporte' value='1'>
								<input type='hidden' name='estado_verificacion' value='1'>
								<input type='hidden' name='funcionario_reporte' value='10094'>
								<input type='hidden' name='fecha_reporte' value='<?php echo(date('Y-m-d')); ?>'>
								<input type='hidden' name='rol_institucion' value='8'>
								
								<input type='hidden' name='dependencia' value='214'>
								<input type="hidden" name="serie_idserie" value="1032">
								<input type="hidden" name="idft_pqrsf" value="">					
								<input type="hidden" name="documento_iddocumento" value="">
								<input type="hidden" name="encabezado" value="1">
								<input type="hidden" name="firma" value="1">
								<input type="hidden" name="campo_descripcion" value="3572">
								<input type="hidden" name="tipo_radicado" value="pqrsf">
								<input type="hidden" name="funcion" value="radicar_plantilla">
					      <input type="hidden" name="tabla" value="ft_pqrsf">                                      
					      <input type="hidden" name="formato" value="pqrsf">
			          <input type="hidden" name="continuar" value="Solicitar Radicado" >
							</div>
					</form>
				</div>
				<div id="consulta_pqr" class="form-inline">
					<form class="form-horizontal" name="formulario_consulta" id="formulario_consulta">
						<table width="100%" style="padding: 10px;margin-left: 10px;">
							<tr>
								<td style="width:30%"><b>B&Uacute;SQUEDA</b></td>
								<td style="width:70%">
									<input type="radio" name="tipo" value="1" checked="">Documento<br/>
									<input type="radio" name="tipo" value="2">Radicado
								</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td><b>VALOR</b></td>
								<td><input type="text" name="valor" id="valor" value="" size="40" class="required"></td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td colspan="2">
									<input class="btn btn-primary" type="submit" value="Consultar">
								</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
						</table>
					</form>
					<br/>
					<br/>
					<div id="respuesta_solicitud"></div>
				</div>
			</div>
		</div>		
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
						var x_tipo=$('input:radio[name=tipo]:checked').val();
						var x_valor=$("#valor").val();
						 $.ajax({
						 	url: "solicitud_remota_documentos.php",
						  method:"post",
						  dataType: 'html',
						  data:{
						  	tipo  : x_tipo,
						  	valor : x_valor
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
  $texto='<input type="text" name="pregunta" value="'.$resultado.'" readonly class="input-mini">=<input type="hidden" id="resultado_ecuacion" readonly value="'.($resultadof).'"/><input name="respuesta" type="text" value="" equalTo="#resultado_ecuacion" class="input-mini required" tabindex="15">';
  return($texto);
}  
?>