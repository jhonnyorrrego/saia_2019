<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
function adicionar_pantalla_campos_formato($idpantalla,$datos){
  $campo_serie=busca_filtro_tabla("","pantalla_campos","nombre='serie_idserie' AND pantalla_idpantalla=".$idpantalla,"",$conn);
  if(!$campo_serie["numcampos"]){
    $sql2="INSERT INTO pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, fila_visible,placeholder) VALUE(".$idpantalla.",'".$datos["nombre"]."','serie_idserie','Tipo de documento','int','11',0,'','a,e','Tipo de documento','','','hidden',0,1,'Tipo documental')";  
    phpmkr_query($sql2);
  }
  $campo_documento=busca_filtro_tabla("","pantalla_campos","nombre='documento_iddocumento' AND pantalla_idpantalla=".$idpantalla,"",$conn);
  if(!$campo_documento["numcampos"]){
    $sql2="INSERT INTO pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, fila_visible,placeholder) VALUE(".$idpantalla.",'".$datos["nombre"]."','documento_iddocumento','Documento asociado','int','11',0,'','a','Documento asociado','','','hidden',0,0,'Documento')";
    phpmkr_query($sql2);
  }
	$campo_dependencia=busca_filtro_tabla("","pantalla_campos","nombre='dependencia' AND pantalla_idpantalla=".$idpantalla,"",$conn);
	if(!$campo_dependencia["numcampos"]){
		$sql2="INSERT INTO pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, fila_visible,placeholder) VALUE(".$idpantalla.",'".$datos["nombre"]."','dependencia','Seleccione rol','varchar','255',1,'select iddependencia_cargo as id, concat(dependencia,concat('' - '',cargo)) as nombre from vfuncionario_dc where idfuncionario={*idfuncionario*} and estado_dc=1','a','Seleccione el rol a utilizar','','','select',0,1,'Seleccionar')";
    phpmkr_query($sql2);
	}
}	
function eliminar_pantalla_campos_formato($idpantalla){
  $campo_serie=busca_filtro_tabla("","pantalla_campos","nombre='serie_idserie' AND pantalla_idpantalla=".$idpantalla,"",$conn);
  if($idpantalla){
    if($campo_serie["numcampos"]){
      $sql2="DELETE FROM pantalla_campos WHERE idpantalla=".$idpantalla." AND nombre='serie_idserie'";
      phpmkr_query($sql2);    
    }
    $campo_documento=busca_filtro_tabla("","pantalla_campos","nombre='documento_iddocumento' AND pantalla_idpantalla=".$idpantalla,"",$conn);
    if($campo_documento["numcampos"]){ 
      $sql2="DELETE FROM pantalla_campos WHERE idpantalla=".$idpantalla." AND nombre='documento_iddocumento'";
      phpmkr_query($sql2);    
    }
  }   
}
?>