<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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
usuario_actual("login");
echo(estilo_bootstrap());
if(is_dir("roundcubemail")){
    
    if(!is_dir($ruta_db_superior."roundcubemail/temp")){
        mkdir($ruta_db_superior."roundcubemail/temp/",0777);
    }
    
  $funcionario=busca_filtro_tabla("","funcionario","funcionario_codigo=".$_SESSION["usuario_actual"],"",$conn);
  if(!$funcionario["numcampos"]){
  ?>
  <div class="alert alert-error">El usuario  con la cuenta de correo no existe en su sistema o no esta configurado por favor comuniquese con su administrador</div>
  <?php  
  }else if($funcionario[0]["email_contrasena"]=='' or is_null($funcionario[0]["email_contrasena"])){
  		alerta('Debe Tener una contraseña configurada');
 		redirecciona($ruta_db_superior.'pantallas/mi_cuenta/cambio_clave_correo.php?from_correo=1');
  }
?>
<!--
Se debe verificar la existencia de la carpeta roundcubemail
Se debe sacar del funcionario el usuario y clave del correo deben estar encriptadas en blowfish: 
  
-->
<form name="form_roundcube" action="roundcubemail/index.php" method="post">
  <input type="hidden" name="_task" value="login">
  <input type="hidden" name="_action" value="login">
  <input type="hidden" name="_timezone" id="rcmlogintz" value="_default_">
  <input type="hidden" name="_url" id="rcmloginurl">
  <input type="hidden" name="_user" id="rcmloginuser" value="<?php echo($funcionario[0]["email"]);?>">
  <input type="hidden" name="_pass" id="rcmloginpwd" value="<?php echo($funcionario[0]["email_contrasena"]);?>">
  <!--input type="submit" class="button mainaction" value="Enter" /></p-->
</form>
<script type="text/javascript">
  top.collapser_mainui.click();
  document.form_roundcube.submit();
</script>
<?php
}
else{
?>
  <div class="alert alert-error">La carpeta con el cliente de correo no existe en su sistema o no esta configurado por favor comuniquese con su administrador</div>
<?php
}
?>