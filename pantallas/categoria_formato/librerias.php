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
global $raiz_saia;
$raiz_saia=$ruta_db_superior;
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");

if(@$_REQUEST['ejecutar_funcion']){
   $_REQUEST["ejecutar_funcion"]();

    function set_categoria(){
        global $conn;
        echo(librerias_jquery('1.7'));
        echo(librerias_notificaciones());
        
    	$tabla="categoria_formato";
    	$fieldList=array();
    	$fieldList["cod_padre"] = 2;	
    	$fieldList["nombre"] = "'".decodifica_encabezado(htmlentities($_REQUEST['nombre']))."'"; 
    	$fieldList["descripcion"] = "'".decodifica_encabezado(htmlentities($_REQUEST['descripcion']))."'";
    	$fieldList["estado"] = 1;
    	$strsql = "INSERT INTO ".$tabla." (fecha,";
    	$strsql .= implode(",", array_keys($fieldList));			
    	$strsql .= ") VALUES (".fecha_db_almacenar(date('Y-m-d'),'Y-m-d').",";			
    	$strsql .= implode(",", array_values($fieldList));			
    	$strsql .= ")";
        phpmkr_query($strsql);
        ?>
        <script>
        notificacion_saia('<b>ATENCI&Oacute;N</b><br>La categoria se ha creado con exito!','success','',4000);
        parent.$('#busqueda_pagina').val(1);
        parent.$("#fila_actual").val(0);
        parent.$("#resultado_busqueda<?php echo(@$_REQUEST['idbusqueda_componente']);?>").html('');
        parent.cargar_datos_scroll();
        </script>
        <?php
        die();    
    }
    
    
    function inactivate_categoria(){
        global $conn;
    }
}

?>