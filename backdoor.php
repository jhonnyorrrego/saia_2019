<?php
session_start(); 
include_once("db.php");
if(usuario_actual("login")=="cerok")
{
?>
<form action="index.php" method="POST">
<input type="text" name="sesion">
<input type="submit" >
</form>
<?php
}
?>