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
    echo(librerias_jquery('1.7'));
    $idcategoria_formato=$_REQUEST['idcategoria_formato'];
    $categoria_formato=busca_filtro_tabla("","categoria_formato","idcategoria_formato=".$idcategoria_formato,"",$conn);
    $vector_estado=array(1=>'Activo',2=>'Inactivo');
    ?>
    <div class="container">
    <table class="table">
         <tr>
            <th colspan="2" class="prettyprint" style="text-align:center;">Informaci&oacute;n General</th>
            
        </tr>        
         <tr>
            <th class="prettyprint">Fecha de creaci&oacute;n:</th>
            <td><?php echo($categoria_formato[0]['fecha']); ?></td>
        </tr>         
        <tr>
            <th class="prettyprint">Nombre:</th>
            <td><?php echo($categoria_formato[0]['nombre']); ?></td>
        </tr>
         <tr>
            <th class="prettyprint">Estado:</th>
            <td><?php echo($vector_estado[$categoria_formato[0]['estado']]); ?></td>
        </tr>       
         <tr>
            <th class="prettyprint">Descripci&oacute;n:</th>
            <td><?php echo($categoria_formato[0]['descripcion']); ?></td>
        </tr>          
    </table>
    </div>

    <script>
    $(document).ready(function(){		
      $(".documento_actual",parent.document).removeClass("alert-info");
      $(".documento_actual",parent.document).removeClass("documento_actual");
      $("#resultado_pantalla_<?php echo($idexpediente);?>",parent.document).addClass("documento_actual").addClass("alert-info");    
    });
    </script>  
    
    <?php

    
  
    



    
} //FIN IF REQUEST idcategoria_formato







?>