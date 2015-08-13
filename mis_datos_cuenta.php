<?php
  session_start();
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
  include_once($ruta_db_superior."header.php");
  $email = null;
  $email_pass = null;
  
  if($_POST["enviado"] == "si"){
    $id_actual = usuario_actual("idfuncionario");
    $email = trim($_POST['email']);
    $email_pass = trim($_POST['pass']);
    $dato = phpmkr_query("UPDATE funcionario SET email='".$email."', email_contrasena='".$email_pass."' WHERE idfuncionario=$id_actual");
    if($dato == 1)
      alerta('Datos actualizados');
    
  }
?>
<html>
  <head>
    <script type='text/javascript'>
  function validaform1(){
    var formulario = document.email_form;
    var capa = document.getElementById("error");
    if(formulario.email.value.length == 0 || formulario.pass.value.length == 0){
      capa.innerHTML="<font color='red'>Porfavor llenar los campos</font>";
      return false;
    }
    email_form.submit();
  }
    </script>
  </head>
  <body>
<?php
  
  
  echo "  <form method='POST' name='email_form' onsubmit='validaform1();return false;'>
          <table width='40%'>
            <tr>
              <td class='encabezado' colspan='2' width='60%' style='text-align:center'><strong>Informacion Email</strong></td>
            </tr>
            <tr>
              <td width='20%' class='encabezado'>Email</td><td><input type='text' name='email' style='width:80%'></td>
            </tr>
            <tr>
              <td width='20%' class='encabezado'>Clave del<br>Email</td><td><input type='password' name='pass' style='width:80%'></td>
            </tr>
            <tr>
              <td><input type='button' value='Guardar' onclick='validaform1();' name='envio'></td>
            </tr>
            <tr>
              <td colspan='2' style='text-align:center' id='error'></td>
            </tr>
          </table>
          <input type='hidden' name='enviado' value='si'>
          </form>
            ";
            

   include_once($ruta_db_superior."footer.php");
?>
  </body>
</html>