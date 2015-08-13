<?php
include_once("db.php");

function documento_usuarios($iddocumento,$campos=NULL)
 {global $conn;
  $enviados=extrae_campo(ejecuta_filtro_tabla("select distinct origen from buzon_salida where archivo_idarchivo=$iddocumento",$conn),"origen");
  $recibidos=extrae_campo(ejecuta_filtro_tabla("select distinct destino from buzon_salida where archivo_idarchivo=$iddocumento",$conn),"destino");
  $todos=implode(",",array_unique(array_merge($enviados,$recibidos)));
  $datos=busca_filtro_tabla($campos,"funcionario","funcionario_codigo in($todos)",$campos,$conn);
  return($datos);
 }
?>
