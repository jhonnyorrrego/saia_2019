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
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap());



  		                /*
  		                var idexpediente='<?php echo($idexpediente); ?>';
                        $.ajax({
                            type:'POST',
                            dataType: 'json',
                            url: "ejecutar_acciones.php",
                            data: {
                                idexpediente:idexpediente,
                                ejecutar_expediente:'cambiar_responsable_expediente'
                            },
                            success: function(datos){

                            }
                        }); 
                        
                        */
?>


<table class="table table-bordered">
  <tr>
    <td width="40%" class="prettyprint">
      <b>Funcionario:</b>
    </td>
    <td>
       <?php echo($expediente[0]["nombre"]);?>
    </td>    
  </tr>
 </table> 