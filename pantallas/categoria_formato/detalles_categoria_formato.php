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


if(@$_REQUEST['idcategoria_formato']){

    include_once($ruta_db_superior."db.php");
    include_once($ruta_db_superior."librerias_saia.php");
    echo(estilo_bootstrap()); 
    $idcategoria_formato=$_REQUEST['idcategoria_formato'];
    $categoria_formato=busca_filtro_tabla("","categoria_formato","idcategoria_formato=".$idcategoria_formato,"",$conn);
    $vector_estado=array(1=>'Activo',2=>'Inactivo');
    ?>
    <table class="table">
         <tr>
            <td class="prettyprint">Fecha de creaci&oacute;n</td>
            <td><?php echo($categoria_formato[0]['fecha']); ?></td>
        </tr>         
        <tr>
            <td class="prettyprint">Nombre</td>
            <td><?php echo($categoria_formato[0]['nombre']); ?></td>
        </tr>
         <tr>
            <td class="prettyprint">Estado</td>
            <td><?php echo($vector_estado[$categoria_formato[0]['estado']]); ?></td>
        </tr>       
         <tr>
            <td class="prettyprint">Descripci&oacute;n</td>
            <td><?php echo($categoria_formato[0]['descripcion']); ?></td>
        </tr>          
    </table>
    
    
    <?php

    
    
    



    
} //FIN IF REQUEST idcategoria_formato







?>