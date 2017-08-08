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
include_once($ruta_db_superior."librerias_saia.php"); 
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
echo(librerias_jquery('1.7'));
echo(estilo_bootstrap());
echo(librerias_notificaciones());

?>

<!DOCTYPE html>
<html>
	<head>
		
	</head>	
	<body>

<div class="container">
		<h5>Configuración de Noticias y contenido relacionado</h5>
		<br/>
		
		<ul class="nav nav-tabs">
		  <li ><a href="noticia_detalles.php">Detalles</a></li>
		    <li ><a href="noticia_add.php">Adicionar</a></li>
		     <li class="active"><a href="noticia_principal_add.php">Informacion Principal</a></li>
		</ul>		
		<br/>
		
		<fieldset>
		
		<!-- Form Name -->
		<legend>Informacion Actual</legend>
		
		
		 <table class="table table-striped">
		    <thead>
		      <tr >
		      	<th style="text-align:center;"><h6>Titulo</h6></th>
		      	<th style="text-align:center;"><h6>Subtitulo</h6></th>
		      </tr>
		    </thead>
		    <tbody>		
		      <tr >
		      	<td style="text-align:center;" id="titulo_mostrar">
		      		<?php
		      			$titulo_mostrar=busca_filtro_tabla('','configuracion','nombre="titulo_index"','',$conn);
						echo($titulo_mostrar[0]['valor']);  
		      		?>		      		
		      	</td>
		      	<td style="text-align:center;" id="subtitulo_mostrar">
		      		<?php
		      			$subtitulo_mostrar=busca_filtro_tabla('','configuracion','nombre="subtitulo_index"','',$conn);
						echo($subtitulo_mostrar[0]['valor']);  
		      		?>		      		
		      	</td>
		      </tr>		    	
		    </tbody>
		  </table>
		    	
		
		
		</fieldset>

		<fieldset>
		
		<!-- Form Name -->
		<legend>Configurar Titulo & Subtitulo Principal</legend>
	
		 <table class="table table-striped">
		    <tbody>		
		      <tr >
		      	<td style="text-align:center;" id="titulo_mostrar">
					<!-- Text input-->
					<form name="form_actualizar_titulo" id="form_actualizar_titulo" method="post">
					    <input id="titulo" name="titulo" type="text" placeholder="Titulo" class="input-xlarge">	
					    <br/>    
					    <input type="hidden" name="actualizar_titulo" value="actualizar_titulo">
					    <input type="button" id="actualizar_titulo" name="actualizar_titulo" class="btn btn-primary" value="Actualizar" />  
					</form>		
		      	</td>
		      	<td style="text-align:center;" id="subtitulo_mostrar">
					<!-- Text input-->
					<form name="form_actualizar_subtitulo" id="form_actualizar_subtitulo" method="post">
					    <input id="subtitulo" name="subtitulo" type="text" placeholder="Subtitulo" class="input-xlarge">
					    <input type="hidden" name="actualizar_subtitulo" value="actualizar_subtitulo" />
					    <br/>    
					    <input type="button" id="actualizar_subtitulo" name="actualizar_subtitulo" class="btn btn-primary" value="Actualizar" />  
					</form>						    
		      	</td>
		      </tr>		    	
		    </tbody>
		  </table>	
		
		</fieldset>

</div>				
							
	</body>
	
</html>
<script>
	$(document).ready(function(){
		
		$('#actualizar_titulo').click(function(){
			if( $('#titulo').val()==''){
				notificacion_saia('<b>Atenci&oacute;n</b><br>Debe ingresar un titulo valido','error','',3000);
			}else{
				
				
				if(confirm('Esta seguro de actualizar el titulo')){
					<?php encriptar_sqli("form_actualizar_titulo",0,"form_info",$ruta_db_superior); ?>
					
					$.ajax({
				        type:"POST",
				        url: "noticia_procesar.php",	
						dataType: "html",
						 data: $("#form_actualizar_titulo").serialize(),    
				        success: function(datos){
				        	$('#titulo_mostrar').html('');       	
				        	$('#titulo_mostrar').html(datos);  
				        	$('#titulo').val('');
				        	notificacion_saia('<b>Atenci&oacute;n</b><br> Titulo actualizado satisfactoriamente','success','',3000);
				        	
				        }
				    });	
				    
				 }  
			 }   
    					
		});
		
		
		$('#actualizar_subtitulo').click(function(){
			if( $('#subtitulo').val()==''){
				notificacion_saia('<b>Atenci&oacute;n</b><br>Debe ingresar un subtitulo valido','error','',3000);
			}else{
				
				if(confirm('Esta seguro de actualizar el subtitulo')){				
				<?php encriptar_sqli("form_actualizar_subtitulo",0,"form_info",$ruta_db_superior); ?>
					$.ajax({
				        type:"POST",
				        url: "noticia_procesar.php",	
						dataType: "html",
						 data: $("#form_actualizar_subtitulo").serialize(), 
				        success: function(datos){
				        	$('#subtitulo_mostrar').html('');       	
				        	$('#subtitulo_mostrar').html(datos);  
				        	$('#subtitulo').val('');
				        	notificacion_saia('<b>Atenci&oacute;n</b><br> Subtitulo actualizado satisfactoriamente','success','',3000);
				        	
				        }
				    });	
				    
				}
				   
			 }   
    					
		});		
	
	});
</script>  	