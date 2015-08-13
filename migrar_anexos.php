<?php
include_once("db.php");
$anexos=busca_filtro_tabla("idanexos","anexos,documento","documento_iddocumento=iddocumento","",$conn);
for($i=0;$i<$anexos["numcampos"];$i++)
  {$sql= "Insert into PERMISO_ANEXO
   (ANEXOS_IDANEXOS, IDPROPIETARIO, CARACTERISTICA_PROPIO, CARACTERISTICA_DEPENDENCIA,
    CARACTERISTICA_CARGO, CARACTERISTICA_TOTAL)
 Values
   (".$anexos[$i]["idanexos"].", NULL, 'le', NULL,
    NULL, 'le')";
   $conn->Ejecutar_Sql($sql,$conn);
  }

?>
