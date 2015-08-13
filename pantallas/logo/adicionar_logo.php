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
echo(estilo_bootstrap());
$ruta_logo=busca_filtro_tabla("","configuracion a","a.nombre='logo'","",$conn);
$ruta_imagen=$ruta_logo[0]["valor"];
if(@$_REQUEST["accion"]=="guardar"){
	guardar_imagen();
}
else{
	formulario();
}
function formulario(){
	global $ruta_db_superior,$ruta_imagen;
	$imagen="Actualmente no existe un logo";
	if(is_file($ruta_db_superior.$ruta_imagen)){
		$imagen="<img src='".$ruta_db_superior.$ruta_imagen."' border='1px'>";
	}
	?>
	<form class="form-horizontal" name="formulario_formatos" id="formulario_formatos" method="post" enctype="multipart/form-data">
	<fieldset id="content_form_name">
    <legend>Cargar logo</legend>
  </fieldset>
	<div class="control-group">
		<label class="control-label" for="logo"><b>Ingresar logo(Formato .jpg, tama&ntilde;o 100px x 90px)</b></label>
		<div class="controls">
			<input type="file" name="anexo" id="anexo">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="imagen"><b>Logo actual</b></label>
		<div class="controls">
			<?php echo($imagen); ?>
		</div>
	</div>
		<td colspan="2"><input type="submit" value="Guardar" name="enviar" class="btn btn-primary btn-mini"></td>
		<input type="hidden" name="accion" value="guardar">
	</form>
	<?php
}
function guardar_imagen(){
	global $conn;
	if(guardar_anexo()){
		alerta("Imagen guardada");
		abrir_url("adicionar_logo.php","_self");
	}
	else{
		abrir_url("adicionar_logo.php","_self");
	}
}
function guardar_anexo(){
	global $ruta_db_superior,$ruta_imagen;
	$tipo=explode(".",$_FILES["anexo"]["name"]);
	$cant=count($tipo);
	$extension=$tipo[$cant-1];
	if($extension=="jpg"||$extension=="jpeg"){
		//rename($_FILES["file"]["tmp_name"],$ruta_db_superior."imagenes/logo_demo.jpg");
		$aleatorio=rand(5,15)."-".date("Ymd");
		$ruta_imagen=$ruta_imagen.$aleatorio.".".$extension;

		cambia_tam($_FILES["anexo"]["tmp_name"],$ruta_db_superior.$ruta_imagen,145,90,"");
		chmod($ruta_db_superior."imagenes/".$ruta_imagen,PERMISOS_ARCHIVOS);
		$sql="UPDATE configuracion SET valor='".$ruta_imagen."' WHERE nombre='logo'";

		phpmkr_query($sql);
	}
	else{
		alerta("El archivo anexo no es jpg");
		return false;
	}
	return true;
}
echo(librerias_bootstrap());
?>