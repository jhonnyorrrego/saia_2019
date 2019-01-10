<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
include_once($ruta_db_superior."db.php");
$retorno=array("campos"=>'');
$etiquetas_validas=array('text','radio','checkbox','arbol','select','fecha','spin','valor','hidden');
if(@$_REQUEST["idpantalla"]){
  $campos=busca_filtro_tabla("","pantalla_campos","pantalla_idpantalla=".$_REQUEST["idpantalla"]." AND etiqueta_html IN('".implode("','",$etiquetas_validas)."') AND (banderas NOT LIKE 'pk' OR banderas IS NULL) AND nombre NOT IN('encabezado','documento_iddocumento','firma')","",$conn);
  $retorno["campos"]=$campos;
}
echo(json_encode($retorno));
?>
