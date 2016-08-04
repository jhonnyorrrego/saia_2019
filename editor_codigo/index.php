<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
?>
<meta http-equiv="X-UA-Compatible" content="IE=9">
<?php 
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."cargando.php");
if(!isset($_SESSION["LOGIN".LLAVE_SAIA_EDITOR])){
  @session_name();
  @session_start();
  @ob_start();
} 
else{
  session_unset();
}  
date_default_timezone_set ("America/Bogota");
echo(estilo_bootstrap());
$logo=busca_filtro_tabla("valor","configuracion","nombre='logo'","",$conn);
$ruta_logo=$ruta_db_superior.$logo[0]["valor"];
if($logo["numcampos"] && is_file($logo[0]["valor"])){
  $ruta_logo=$logo[0]["valor"];
}
?>
<html>
<head>
<title>SAIA</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
include_once($ruta_db_superior."css/index_estilos.php");
echo index_estilos('temas_main');
echo index_estilos('temas_index');
?>

</head>
<?php
$mayor_informacion=busca_filtro_tabla("valor","configuracion","nombre='mayor_informacion'","",$conn);
?>
<body>
<div class="footer_login">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr class="footer_login_text">
      <td width="1%" height="25">&nbsp;</td>
      <td>©<?php echo date(Y);?> CEROK</td>
      <!--<td><a href="">Términos de uso y servicio - SAIA</a><sup>®</sup></td>-->
      <td>Para mayor información: <?php echo($mayor_informacion[0]["valor"]); ?></td>
      <td></td>
      <td width="30%" align="right">Todos los derechos reservados CERO K&nbsp;&nbsp;&nbsp;</td>
    </tr>
  </table>
</div>
<table width="100%" height="100%" border="0"  cellpadding="0" cellspacing="0" id="tabla_principal"  align="bottom" >  
  <tr align="center">
    <td colspan="3" align="center" valign="middle" id="LoginBkg"> 
      <div id="loginForm">
        <form method="post" name="loguin" id="formulario_login">
        <table width="700" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="30" colspan="6" style="text-align: center; font-size: 14; font-weight: bold;">&nbsp; &nbsp; Editor de c&oacute;digo </td>
          </tr>
          <tr>
            <td width="62" rowspan="2">&nbsp;</td>
            <td width="125" rowspan="2" align="left" valign="top">
              <div id="CustomerLogoContainer" align="center"><img src="<?php echo($ruta_logo);?>"></div>
            </td>
            <td width="18" rowspan="2" align="left" valign="top">&nbsp;</td>
            <td width="102" height="50" nowrap class="blueTexts">Nombre de usuario:</td>
            <td width="225">
              <input type="text" name="userid" id="userid">
            </td>
            <td width="168" rowspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td height="50" nowrap class="blueTexts">Clave de Acceso:</td>
            <td height="50">
              <input type="password" name="passwd" id="passwd">
            </td>
          </tr>
          <tr>
            <td height="50" colspan="5" align="right" valign="bottom">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <!--td width="60%" align="right" valign="middle" nowrap>Recordar Usuario</td>
                  <td width="4%" align="right" valign="middle" nowrap>
                    <input name="rememberme" type="checkbox" id="rememberme" value="1" align="absmiddle">
                  </td>
                  <td width="14%" align="right" valign="middle" nowrap>&nbsp;&nbsp;Recordar Clave</td>
                  <td width="4%" align="right" valign="middle" nowrap>
                    <input name="rememberme_pwd" type="checkbox" id="rememberme_pwd" value="1" align="absmiddle">
                  </td-->
                  <td width="18%" colspan="6" align="right" valign="top" nowrap>
                    <br />
                    <p>
                    <input type="hidden" name="boton_ui" value="Acceder">
                    <button name="boton_ui" type="button" class="btn btn-primary" id="ingresar">Iniciar sesi&oacute;n</button>
                    </p>
                    <!--p>
                    <input type="hidden" name="boton_ui" value="Acceder">
                    <a href="recordar_contrasena.php" style="cursor:pointer" class="highslide" onclick="return hs.htmlExpand(this,{objectType:'iframe',width: 550, height: 300, preserveContent:false})">¿No puedes acceder a tu cuenta?</a>
                    </p-->
                  </td>
                </tr>
              </table>
            </td>
            <td>&nbsp;</td>
          </tr>        
        </table>
        <br>
        </form>
      </div>
    </td>
  </tr>
</table>
</body>
</html>
<?php include_once($ruta_db_superior."fin_cargando.php");
  echo(librerias_jquery("1.7"));
  echo(librerias_highslide());
  echo(librerias_bootstrap());
  echo(librerias_notificaciones());
?>
<script>
var mensaje="El nombre de usuario o contrase&ntilde;a introducidos no son correctos";
var tiempo=3500;
$("#tabla_principal").height($(window).height()-56);
$("#ingresar").click(function(){  
  if($("#userid").val() && $("#passwd").val()){
    //$("#formulario_login").submit();
    $.ajax({
      type:'POST',
      url: "<?php echo($ruta_db_superior);?>editor_codigo/verificar_login_editor.php",
      data: "userid="+$("#userid").val()+"&passwd="+$("#passwd").val(),
      success: function(html){   
        if(html){
          var objeto=jQuery.parseJSON(html);
          mensaje=objeto.mensaje;          
          if(objeto.ingresar==1){
            noty({text: mensaje,type: 'success',layout: "topCenter",timeout:tiempo});
            setTimeout(function(){window.location=objeto.ruta},(tiempo+100));
          }  
          else{
            noty({text: mensaje,type: 'error',layout: "topCenter",timeout:tiempo});
          }                         
        }
      },
      error:function(){
        alert("ERROR");
      }
    });
  }
  else{                         
    noty({text: "Por favor ingrese un usuario y una clave v&aacute;lidos <br />intente de nuevo",type: 'error',layout: "topCenter",timeout:tiempo});
  }  
});
$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
        $("#ingresar").click();
    }
});
hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
hs.outlineType = 'rounded-white';
</script>
