<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."formatos/librerias_funciones_generales.php");
include_once($ruta_db_superior."librerias_saia.php");



function validar_asignacion_ruta_dependencia($idformato,$iddoc){
		global $conn, $ruta_db_superior;
		$fecha=date('Y-m-d');
		$datos=busca_filtro_tabla('','ft_dependencias_ruta','ft_ruta_distribucion='.$_REQUEST['padre'],'',conn);
		$orden=$datos['numcampos']+1;
    ?>
        <script>
            $(document).ready(function(){
                
               $('#fecha_item_dependenc').attr('readonly', true);
	           $('#fecha_item_dependenc').val('<?php echo $fecha;?>');
	           $('[name="orden_dependencia"]').val('<?php echo $orden;?>'); 
               tree_dependencia_asignada.setOnCheckHandler(onNodeSelect);
               
               function onNodeSelect(nodeId){
                   $.ajax({
                        async:false,
                        type:'POST',
                        dataType: 'json',
                        url: "validar_dependencia.php",
                        data: {
                                        iddependencia:nodeId
                        },
                        success: function(datos){
                            if(datos==1){
                                alert('Esta dependencia ya ha sido asignada');
                                tree_dependencia_asignada.setCheck(nodeId,0 );
                                $('#dependencia_asignada').val('');
                            }
                        }
                    });   
	           }
            });
        </script>
    <?php
}

