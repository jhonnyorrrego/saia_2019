<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "librerias_saia.php");
actualizar_menu_principal_documento();
function actualizar_menu_principal_documento(){
    $modulo=  busca_filtro_tabla("", "modulo", "nombre='menu_ordenar'", "", $conn);    
    /*TODO: se debe hacer algo que se utilice en la actualización para que pase toda la información de la antigua estructura a la nueva 
    * Una de las cosas que se debeb hacer es buscar la etiqueta Ordenar y cambiarlo por Menú documentos
    * adicionar los 3 módulos principales que son acciones_documento,informacion_documento,accesos_rapidos_documento,otros,documento
    */
    if($modulo["numcampos"]){
        $arreglo_acciones=array('devolucion','transferir','responder','tareas','enviar_documento_correo','terminar_documento','solicitar_anulacion','adicionar_pag','ordenar_pag');
        $arreglo_informacion=array('detalles','seguimiento','verificar_flujo_documento','anexos_documento','vincular_documento','administrar_comentario','mostrar_versiones');
        $arreglo_otros=array('adicionar_etiqueta','clasificar','imagenes_pdf','imprimir_radicado','expediente','permisos_documento','regenerar_pdf','almacenamiento','despachar');
        $arreglo_rapidos=array('devolucion','transferir','responder','tareas','seguimiento','verificar_flujo_documento');
        $sql2="UPDATE modulo SET etiqueta='Men&uacute; Documentos' WHERE idmodulo=".$modulo[0]["idmodulo"];
        phpmkr_query($sql2);              
        actualizar_modulo_principal_documento($modulo[0]["idmodulo"],$arreglo_acciones,array("acciones_menu_intermedio","Acciones (Men&uacute; Intermedio)"));
        actualizar_modulo_principal_documento($modulo[0]["idmodulo"],$arreglo_informacion,array("informacion_menu_intermedio","Seguimiento (Men&uacute; Intermedio)"));
        actualizar_modulo_principal_documento($modulo[0]["idmodulo"],$arreglo_otros,array("otros_menu_intermedio","Otros (Men&uacute; Intermedio)"));                
        //actualizar_modulo_principal_documento($modulo[0]["idmodulo"],$arreglo_rapidos,array("rapidos_menu_intermedio","Accesos R&aacute;pidos (Men&uacute; Intermedio)"));                
    } 
    else {        
        echo("Error no se encontr&oacute; EL m&oacute;dulo del menu intermedio menu_ordenar");
    }
}
function actualizar_modulo_principal_documento($idmodulo,$arreglo_acciones,$modulo){
    $modulo_acciones=  busca_filtro_tabla("","modulo", "nombre='".$modulo[0]."'", "", $conn);      
    if(!$modulo_acciones["numcampos"]){
        $sql2="INSERT INTO modulo(nombre,etiqueta,cod_padre,enlace) VALUES('".$modulo[0]."','".$modulo[1]."',".$idmodulo.",'#')";
        //echo($sql2."<br>");
        phpmkr_query($sql2);
        $mod_acciones[0]["idmodulo"]=  phpmkr_insert_id();
    }    
    else{
        $mod_acciones= $modulo_acciones[0]["idmodulo"];
    }
    /*for($i=0;$i<$cant_acciones;$i++){
        
    }*/
    $sql2="UPDATE modulo SET cod_padre=".$mod_acciones." WHERE nombre IN('".implode("','",$arreglo_acciones)."')";   
    //echo("<br><br>".$sql2);
    phpmkr_query($sql2);      
}
?>