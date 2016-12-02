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
include_once($ruta_db_superior."librerias_saia.php");
echo(estilo_bootstrap()); 
?>
<html>
    <head>
        <title>Historial de Apertura y Cierre de Expedientes</title>
    </head>
    <body>
        <table class="table table-bordered">
            <tr>
                <td width="40%" class="prettyprint">
                  <b>Fecha:</b>
                </td> 
                <td>
                
                </td>
            </tr>
            <tr>
                <td width="40%" class="prettyprint">
                  <b>Acci&oacute;n:</b>
                </td> 
                <td>
                
                </td>
            </tr>        
        </table>
    </body>
</html>
