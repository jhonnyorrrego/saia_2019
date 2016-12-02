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
<!DOCTYPE html>
<html>
    <head>
        <title>Historial de Apertura y Cierre de Expedientes</title>
    </head>
    <body>
        <table class="table table-bordered">
            <tr>
                <th class="prettyprint">
                  <b>Fecha</b>
                </th> 
                <th class="prettyprint">
                  <b>Acci&oacute;n</b>
                </th>
                <th class="prettyprint">
                  <b>Usuario</b>
                </th> 
                <th class="prettyprint">
                  <b>Observaci&oacute;n</b>
                </th>
            </tr>
            <?php 
            $idexpediente=@$_REQUEST['idexpediente'];
            $historial=busca_filtro_tabla("","expediente_abce","expediente_idexpediente=".$idexpediente,"idexpediente_abce DESC",$conn);
            
            $vector_acciones=array(1=>'Abierto',2=>'Cerrado');
            for($i=0;$i<$historial['numcampos'];$i++){
                $fun=busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$historial[$i]['funcionario_cierre'],"",$conn);
                $nombre_funcionario=ucwords($fun[0]['nombres'].' '.$fun[0]['apellidos']);
                $cadena='
                    <tr>
                        <td>
                            '.$historial[$i]['fecha_cierre'].'
                        </td> 
                        <td>
                            '.$vector_acciones[intval($historial[$i]['estado_cierre'])].'
                        </td>
                        <td>
                            '.$nombre_funcionario.'
                        </td> 
                        <td>
                            '.$historial[$i]['observaciones'].'
                        </td>
                    </tr>       
                ';
                echo($cadena);
            }
            ?>  
        </table>
    </body>
</html>
