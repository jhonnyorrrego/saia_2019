<?php
include_once("db.php");
include_once("header.php");
$radicador = new PERMISO();
$permiso = false;
$permiso=$radicador->acceso_modulo_perfil("permiso_busqueda_general");
?>
<br><b>LISTADO PQR</b><br><br>
<table>
<tr>
<td><a href="pqr_pendientes.php?tipo=pendientes" target="listado">PENDIENTES</a></td>
<td><a href="pqr_pendientes.php?tipo=todos_usuario" target="listado">TODOS USUARIO</a></td>
<?php if($permiso) {?>
<td><a href="pqr_pendientes.php?tipo=todos" target="listado">TODOS GENERAL</a></td>
<?php } ?>
</tr>
</table><br><br>
<iframe id="listado" name="listado" frameborder="0" style="width:100%;height:300px;">
</iframe>
<?php
include_once("footer.php");
?>