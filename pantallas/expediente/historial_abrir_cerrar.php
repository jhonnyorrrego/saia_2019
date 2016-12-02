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
                <th width="40%" class="prettyprint">
                  <b>Fecha</b>
                </th> 
                <th width="40%" class="prettyprint">
                  <b>Acci&oacute;n</b>
                </th>
                <th width="40%" class="prettyprint">
                  <b>Uusario</b>
                </th> 
                <th width="40%" class="prettyprint">
                  <b>Observacion</b>
                </th>
            </tr>
            
        </table>
        <style>
            tr th{
                text-align:center;
            }
        </style>
    </body>
</html>
