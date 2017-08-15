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



$noticias=busca_filtro_tabla('','noticia_index','estado=1 and idnoticia_index='.$_REQUEST['idnoticia_index'],'',$conn);
?>


<!DOCTYPE html>
<html>
	<head>
		
	</head>
	
		
	<body>

<div class="container">
	<h4><?php echo($noticias[0]['titulo'].' - '.$noticias[0]['fecha']); ?></h4>	
  <table class="table table-striped">
    <thead>
      <tr>
      	<th colspan="2"><?php echo($noticias[0]['subtitulo']); ?></th>
      </tr>
    </thead>
    <tbody>
    	
    <?php 
		$cadena='';
		for($i=0;$i<$noticias['numcampos'];$i++){
			$archivo_binario=StorageUtils::get_binary_file($noticias[$i]['imagen']);
			$imagen='<img src="'.$archivo_binario.'" height=200  width=200 align="left" class="img-rounded">';
			//<td><span class="icon icon-edit"></span></td> //icono editar, pendiente desarrollo
			$cadena.='
				<tr>
					<td style="text-align:justify;">'.$imagen.$noticias[$i]['noticia'].'</td>
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

