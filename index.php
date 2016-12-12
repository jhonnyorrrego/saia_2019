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
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php 
include_once("db.php");
include_once("librerias_saia.php");
include_once("cargando.php");


if(@$_REQUEST['texto_salir']){
	

	echo(librerias_jquery("1.7"));
	echo(librerias_notificaciones());
	
	
	?>
		<script>
			var texto_salir='<?php echo(@$_REQUEST['texto_salir']); ?>';
			texto_salir='<b>ATENCION!</b><br>'+texto_salir;
			notificacion_saia(texto_salir,'success','',4000);
		</script>
	<?php	
	
}


if(!isset($_SESSION["LOGIN".LLAVE_SAIA])){
  @session_name();
  @session_start();
  @ob_start();
} 
include_once($ruta_db_superior."pantallas/lib/mobile_detect.php");
$detect = new Mobile_Detect;
if(@$_REQUEST["INDEX"]!=''){
  $_SESSION["INDEX"]=$_REQUEST["INDEX"];
}
/*else if ( $detect->isMobile() ) {
    $_SESSION["tipo_dispositivo"]="movil";
	$_REQUEST["INDEX"]="mobile";
	$_SESSION["INDEX"]="mobile";
}*/
else{
  $_REQUEST["INDEX"]="actualizacion"; 
  $_SESSION["INDEX"]="actualizacion";
} 


$parametro_tarea='';
if(@$_SERVER['QUERY_STRING']){
	$parametro=$_SERVER['QUERY_STRING'];
	$parametro_uncrypt=base64_decode($parametro);
	$vector_parametro=explode('=',$parametro_uncrypt);
			
	if(strtolower(@$vector_parametro[0])=='idtareas_listado_unico' && is_numeric(@$vector_parametro[1])){
		$parametro_tarea='?'.$parametro;
	}
}


if ( $detect->isMobile() ) {
    $_SESSION["tipo_dispositivo"]="movil";
}
date_default_timezone_set ("America/Bogota");
if(isset($_REQUEST['sesion']))
  $_SESSION["LOGIN".LLAVE_SAIA]=$_REQUEST['sesion']; 
if(@$_SESSION["LOGIN".LLAVE_SAIA]){
    $fondo=busca_filtro_tabla("A.valor","configuracion A","A.tipo='empresa' AND A.nombre='fondo'","A.fecha,A.valor DESC",$conn);
    almacenar_sesion(1,"");
    redirecciona("index_".$_SESSION["INDEX"].".php".$parametro_tarea);
}
$logo=busca_filtro_tabla("valor","configuracion","nombre='logo'","",$conn);
$ruta_logo="imagenes/".$logo[0]["valor"];
if($logo["numcampos"] && is_file($logo[0]["valor"])){
  $ruta_logo=$logo[0]["valor"];
}
?>
<html>
<head>
<title>SAIA</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!-- PERMITE QUE LAS NOTICIAS FLOTEN EN LA PARTE INFERIOR IZQUIERDA DE LA PANTALLA-->
<style type="text/css">

#div_noticias{
position: absolute;
bottom: 0px;
left: 0px;
margin-bottom: 40px;
margin-left: 40px;
background-color: transparent;
vertical-align: sub;
width:400px;
<?php
if($_SESSION["tipo_dispositivo"]=="movil"){
    echo("display:none;");
}
?>
}
</style>
<?php 
include_once("css/index_estilos.php");
echo(estilo_bootstrap());
if(@$_SESSION["tipo_dispositivo"]=="movil"){ 
    echo(index_estilos('temas_movil'));
    echo(index_estilos('temas_bootstrap'));
}
else{
    echo(index_estilos('temas_index'));    
    echo(index_estilos('temas_main'));
}
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
      <td>
      </td>
      <?php
        if(@$_SESSION["tipo_dispositivo"]!="movil"){
            echo('<td align="right">Todos los derechos reservados CERO K&nbsp;&nbsp;&nbsp;</td>');
        }
        ?>
    </tr>
  </table>
</div>
<table width="100%" border="0"  cellpadding="0" cellspacing="0" id="tabla_principal"  align="middle" >
    <?php
        if(@$_SESSION["tipo_dispositivo"]=="movil"){
          echo('<tr><td valign="bottom" align="center"><img src="'.$ruta_db_superior.'asset/img/layout/logosaia.png"><br></td></tr>');
        }
    ?>
  <tr align="center">
    <td colspan="3" align="center" valign="middle" id="LoginBkg"> 
      <div id="loginForm">
        <form method="post" name="loguin" id="formulario_login" action="login.php" class="form-horizontal">
        <?php if($_SESSION["tipo_dispositivo"]=="movil"){ ?>    
            <div class="control-group">
                <label class="control-label blueTexts" for="inputEmail">Nombre de usuario:</label>
                <div class="controls">
                  <input type="text" name="userid" id="userid">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label blueTexts" for="inputPassword">Clave de Acceso:</label>
                <div class="controls">
                  <input type="password" name="passwd" id="passwd">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <br />
                  	<p>
                  	<input type="hidden" name="boton_ui" value="Acceder">
                    <button name="boton_ui" type="button" class="btn btn-primary" id="ingresar">Iniciar sesi&oacute;n</button>
                    </p>
                  	<p id="contenedor_recordar_contrasena">
                  	
                  	<a href="recordar_contrasena.php" style="cursor:pointer"  class="highslide" onclick="return hs.htmlExpand(this,{objectType:'iframe',width: 550, height: 300, preserveContent:false})">¿No puedes acceder a tu cuenta?</a>
                  	</p>
                </div>
            </div>
        <?php }
        else{
          ?>
        <table width="700" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="30" colspan="6">&nbsp;</td>
          </tr>
          <tr>
            <td width="62" rowspan="2">&nbsp;</td>
            <td width="125" rowspan="2" align="left" valign="top">
              <div id="CustomerLogoContainer" align="center"><img src="<?php echo($ruta_logo);?>"></div>
            </td>
            <td width="18" rowspan="2" align="left" valign="top">&nbsp;</td>
            <td width="102" height="50" nowrap class="blueTexts">Nombre de usuario:</td>
            <td width="225">
              <input type="text" name="userid" id="userid" style="width:200px; height:40px;">
            </td>
            <td width="168" rowspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td height="50" nowrap class="blueTexts">Clave de Acceso:</td>
            <td height="50">
              <input type="password" name="passwd" id="passwd" style="width:200px; height:40px;">
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
                  	<p id="contenedor_recordar_contrasena">
                  	
                  	<a href="recordar_contrasena.php" style="cursor:pointer" class="highslide"   onclick="return hs.htmlExpand(this,{objectType:'iframe',width: 550, height: 300, preserveContent:false})">¿No puedes acceder a tu cuenta?</a>
                  	</p>
                  	
                  	
                  </td>
                </tr>
                <tr>
				<td align="left">
					<br/>
					<br/>
				</td>
                </tr>
              </table>
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
          
          <?php
        }
        ?>
        <br>
        </form>
      </div>
    </td>
  </tr>
	
</table>




  		<div id="div_noticias">
			<?php
		      	$titulo_mostrar=busca_filtro_tabla('','configuracion','nombre="titulo_index"','',$conn);
				$subtitulo_mostrar=busca_filtro_tabla('','configuracion','nombre="subtitulo_index"','',$conn);
				
				$texto_tabla="<p style='font-weight:bold;color: #4099D2;text-align:left;font-size:16px;'>".$titulo_mostrar[0]['valor']."<p>";
				$texto_tabla.="<hr>";
				$texto_tabla.="<p style='color:#4099D2;text-align:left;font-size:15px'>".$subtitulo_mostrar[0]['valor']."</p><br />";
				global $conn;
				$dato=busca_filtro_tabla("","noticia_index","estado=1 AND mostrar=1","",$conn);
				//print_r($dato);die();
				if ($dato["numcampos"]){
					$texto_tabla.="<table align='bottom' style='text-align:justify;'>";
					for ($i=0;$i<$dato["numcampos"];$i++){
						$texto_tabla.="<tr><td>";
						$texto_tabla.="<p id='texto_pequenio'>";
						$texto_tabla.=$dato[$i]["previo"].'...';
						$texto_tabla .='<a href="noticia_index/mostrar_noticia.php?idnoticia_index='.$dato[$i]["idnoticia_index"].'" class="highslide" onclick="return         hs.htmlExpand(this, { objectType: \'iframe\',width:450, height:550,preserveContent:false } )"style="text-decoration: underline; cursor:pointer;"> Ver m&aacute;s</a><br>';
						$texto_tabla.="</p>";
						$texto_tabla.="</td></tr>";
					}
					$texto_tabla.="</table>";
					$texto_tabla.="<br/>";
					echo $texto_tabla;
				}
			?>
		</div>	





</body>
</html>
<?php include_once("fin_cargando.php");
  echo(librerias_jquery("1.7"));
  echo(librerias_highslide());
  echo(librerias_bootstrap());
  echo(librerias_notificaciones());
?>
<script>
var mensaje="<b>El nombre de usuario o contrase&ntilde;a introducidos no son correctos! </b> <br> intente de nuevo";
var tiempo=3500;
$("#tabla_principal").height($(window).height()-56);
$("#ingresar").click(function(){	
  if($("#userid").val() && $("#passwd").val()){
      $('#contenedor_recordar_contrasena').css('pointer-events','none');  
  	//$("#formulario_login").submit();
    $.ajax({
      type:'POST',
      url: "verificar_login.php",
      data: "userid="+$("#userid").val()+"&passwd="+$("#passwd").val()+"&INDEX=<?php echo(@$_REQUEST['INDEX']);?>",
      success: function(html){   
        if(html){
          var objeto=jQuery.parseJSON(html);
          mensaje=objeto.mensaje;          
          if(objeto.ingresar==1){
            noty({text: mensaje,type: 'success',layout: "topCenter",timeout:tiempo});
             var ruta=objeto.ruta+'<?php  echo($parametro_tarea);?>';
            setTimeout(function(){window.location=ruta},(tiempo+100));
          }  
          else{
            $('#contenedor_recordar_contrasena').css('pointer-events','auto'); 
            mensaje='<span style="color:white;">'+mensaje+'</span>';
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
    noty({text: "<b>Por favor ingrese un usuario y una clave v&aacute;lidos!</b> <br> intente de nuevo",type: 'error',layout: "topCenter",timeout:tiempo});
  }  
});
$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
        $("#ingresar").click();
    }
});
hs.graphicsDir = 'anexosdigitales/highslide-4.0.10/highslide/graphics/';
hs.outlineType = 'rounded-white';

</script>