<?
include_once("db.php");
?>
<form name="email" action="roundcubemail/index.php" method="POST">
<input type="hidden" value="<?php echo(usuario_actual("login")."@cerok.com"); ?>" name ="_user">
<input type="hidden" value="<?php echo(usuario_actual("clave")); ?>" name ="_pass">
<input type="hidden" value="<?php echo(usuario_actual("funcionario_codigo")); ?>" name ="codigo">
<input type="hidden" value="<?php echo("login"); ?>" name ="_action">
<input type="hidden" value="<?php echo("mail"); ?>" name ="_task">
</form>
<script> email.submit();</script>
