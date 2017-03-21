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
require_once $ruta_db_superior . 'StorageUtils.php';
require_once $ruta_db_superior . 'filesystem/SaiaStorage.php';
echo(librerias_jquery());
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
		  <li class="active"><a href="noticia_detalles.php">Detalles</a></li>
		  <li><a href="noticia_add.php">Adicionar</a></li>
		   <li><a href="noticia_principal_add.php">Informacion Principal</a></li>
		</ul>		
		<br/>
		
  <table class="table table-striped">
    <thead>
      <tr >
      	<th style="text-align:center;"><h6>Fecha</h6></th>
      	<th style="text-align:center;"><h6>Imagen</h6></th>
      	<th style="text-align:center;"><h6>Titulo</h6></th>
      	<th style="text-align:center;"><h6>Subtitulo</h6></th>
        <th style="text-align:center;"><h6>Noticia</h6></th>
        
         <th style="text-align:center;"><h6>Mostrar</h6></th>
          <th style="text-align:center;"><h6>Eliminar</h6></th>
      </tr>
    </thead>
    <tbody>
    <?php 
    	$noticias=busca_filtro_tabla('','noticia_index','estado=1','',$conn);
		$cadena='';
		for($i=0;$i<$noticias['numcampos'];$i++){
			$archivo_binario=StorageUtils::get_binary_file($noticias[$i]['imagen']);
			$imagen='<img src="'.$archivo_binario.'"   width="200" height="200" class="img-rounded">';
			$checked='';
			if($noticias[$i]['mostrar']==1){
				$checked='checked';
			}			
			$cadena.='
				<tr>
					<td>'.$noticias[$i]['fecha'].'</td>
					<td style="width:20%;">'.$imagen.'</td>
					<td>'.$noticias[$i]['titulo'].'</td>
					<td>'.$noticias[$i]['subtitulo'].'</td>
					<td style="text-align:justify;">'.$noticias[$i]['noticia'].'</td>
        			<td><input type="checkbox" name="mostrar" elemento="'.$noticias[$i]['idnoticia_index'].'" '.$checked.'></td>
        			<td> <span class="icon icon-trash" style="cursor:pointer;" name="eliminar" valor="'.$noticias[$i]['idnoticia_index'].'" title="Eliminar"></span></td>
        		</tr>
        	';
		}
		echo $cadena;
    ?>	
    </tbody>
  </table>

</div>				
							
	</body>
	
</html>
<script>
	$(document).ready(function(){
		$('[name="eliminar"]').click(function(){
			if(confirm('Esta seguro de eliminar la noticia?')){
				var idnoticia_index=$(this).attr('valor');
				$.ajax({
			        type:"POST",
			        url: "noticia_delete.php",
			        data: {
			            idnoticia_index:idnoticia_index
			        },
			        success: function(){
			        	notificacion_saia('Noticia eliminada satisfactoriamente','success','',3000);
			        	location.reload(); 
			        }
			    });					
			}	
		});
	});
</script>
<script>
	$(document).ready(function(){
		$('[name="mostrar"]').click(function(){
				var idnoticia_index=$(this).attr('elemento');
				$.ajax({
			        type:"POST",
			        url: "noticia_procesar.php",
			       	dataType: 'json',
			        data: {
			            idnoticia_index:idnoticia_index,
			            mostrar:'mostrar'
			        },
			        success: function(datos){
			        	notificacion_saia(datos.mensaje,'success','',3000);
			        	
			        	
			        	if(datos.retorno==2){
			        		$('[elemento="'+datos.idnoticia_index+'"]').attr('checked',false);
			        	}
			        	
			        }
			    });					
			
		});
	});
</script>
