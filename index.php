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
if ( $detect->isMobile() ) {
    $_SESSION["tipo_dispositivo"]="movil";
}
date_default_timezone_set ("America/Bogota");
if(isset($_REQUEST['sesion']))
  $_SESSION["LOGIN".LLAVE_SAIA]=$_REQUEST['sesion']; 
echo(estilo_bootstrap());
if(@$_SESSION["LOGIN".LLAVE_SAIA]){
    $fondo=busca_filtro_tabla("A.valor","configuracion A","A.tipo='empresa' AND A.nombre='fondo'","A.fecha,A.valor DESC",$conn);
    almacenar_sesion(1,"");
    redirecciona("index_".$_SESSION["INDEX"].".php");
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
    echo(estilo_bootstrap());

?>
</head>
<?php
$mayor_informacion=busca_filtro_tabla("valor","configuracion","nombre='mayor_informacion'","",$conn);
?>
<body>

<div class="container">
        <form method="post" name="loguin" action="login.php" class="form-horizontal">
        <?php if($_SESSION["tipo_dispositivo"]=="movil"){ ?>    
            <div class="control-group">
                <label class="control-label blueTexts" for="input_userid">Nombre de usuario:</label>
                <div class="controls">
                  <input type="text" name="userid" id="userid">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label blueTexts" for="input_password">Clave de Acceso:</label>
                <div class="controls">
                  <input type="password" name="passwd" id="passwd">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input type="hidden" name="boton_ui" value="Acceder">
                    <button name="boton_ui" type="button" class="btn btn-primary" id="ingresar">Iniciar sesi&oacute;n</button>
                  	<input type="hidden" name="boton_ui" value="Acceder">
                  	<a href="recordar_contrasena.php" style="cursor:pointer" class="highslide" onclick="return hs.htmlExpand(this,{objectType:'iframe',width: 550, height: 300, preserveContent:false})">¿No puedes acceder a tu cuenta?</a>
                </div>
            </div>
        </form>
</div>



  	


</body>
</html>
<?php 

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