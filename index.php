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
<?php 
    echo(estilo_bootstrap());
?>
</head>
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