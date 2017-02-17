<?php
set_time_limit(0);
include_once("db.php");
include_once("librerias_saia.php");
include_once("header.php");
echo(estilo_bootstrap());
?>
<script>
document.getElementById("ocultar").style.display="none";
</script>
<?php
$transferencias=busca_filtro_tabla("nombres,apellidos,".fecha_db_obtener("fecha","Y-m-d H:i:s")." AS fecha","buzon_salida,funcionario","destino=funcionario_codigo and archivo_idarchivo=".$_REQUEST["iddoc"]." and nombre='LEIDO'","fecha desc,nombres asc,apellidos asc",$conn);
$creacion=busca_filtro_tabla("nombres,apellidos,".fecha_db_obtener("fecha","Y-m-d H:i:s")." AS fecha","digitalizacion,funcionario","funcionario=funcionario_codigo and documento_iddocumento=".$_REQUEST["iddoc"]." and accion='CREACION DOCUMENTO'","",$conn);
echo '<br /><br /><div class="container"><table class="table table-bordered"><tr class="encabezado_list"><td>Funcionario</td><td>fecha de lectura</td></tr>';

for($i=0;$i<$transferencias["numcampos"];$i++)
  echo '<tr><td>'.$transferencias[$i]["nombres"].' '.$transferencias[$i]["apellidos"].'</td><td>'.$transferencias[$i]["fecha"].'</td></tr>';
for($i=0;$i<$creacion["numcampos"];$i++)
  echo '<tr><td>'.$creacion[0]["nombres"].' '.$creacion[0]["apellidos"].'</td><td>'.$creacion[0]["fecha"].'</td></tr>';  
echo '</table></div>';
include_once("footer.php");
?>