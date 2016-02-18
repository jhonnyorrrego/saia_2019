<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
echo(estilo_bootstrap());
$paso=busca_filtro_tabla("","paso_documento A, paso B ","A.paso_idpaso=B.idpaso AND A.idpaso_documento=".$_REQUEST["idpaso_doc"],"",$conn);
?>
<legend>Cancelando paso:<br><?php echo($paso[0]["nombre_paso"]);?></legend><br>