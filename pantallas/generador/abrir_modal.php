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
include_once($ruta_db_superior."assets/librerias.php");

echo jquery();
echo bootstrap();
echo theme();
echo topModal();
?>
<script type="text/javascript">
$(function(){
	var opcionesModal = {
	    url: "editar_campo_formato.php", // url to open
	    params: {}, //params for url ej: baseUrl
	    size: "", //'modal-lg', 'modal-sm'
	    title: "Configuración del campo - Texto en una línea", //title for modal
	    buttons: {
	        success: {
	            label: 'Enviar',
	            class: 'btn btn-complete'
	        },
	        cancel: {
	            label: 'Cancelar',
	            class: 'btn btn-danger'
	        }
	    },
	};
});

</script>
