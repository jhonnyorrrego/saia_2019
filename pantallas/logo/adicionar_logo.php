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
echo(estilo_file_upload());
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
	<br/>

	<div class="container">
	    
	<form class="form-horizontal" name="formulario_formatos" id="formulario_formatos" method="post" enctype="multipart/form-data">
	<fieldset id="content_form_name">
    <legend>Cargar logo</legend>
  </fieldset>

	<div class="control-group">
		<label class="control-label " for="imagen"><b>Logo actual</b>&nbsp;</label>
		<div class="controls">
			<?php echo($imagen); ?>
		</div>
	</div>
	<br>  
	<div class="control-group">
		<label class="control-label" for="logo"><b>Ingresar logo </b><span style="font-size:7pt;"><i>(Formato .jpg, tama&ntilde;o 100px x 90px)</i></span></label>
		<div class="controls">
			<!-- input type="file" name="anexo" id="anexo" -->
		   <span class="btn btn-mini btn-default fileinput-button" ng-class="{disabled: disabled}" style="margin-left:40px;" id="contenedor_anexos">
               
                <span>Examinar</span>
                <input type="file" multiple ng-disabled="disabled" name="anexo" id="anexo">
            </span>		
			
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="logo"><b>Vista Previa</b></label>
		<div class="controls">
			<img id="imagen_previa" />
		</div>
	</div>	

		<td colspan="2">
		    <button type="submit" value="Guardar" name="enviar" class="btn btn-primary btn-mini">Guardar </button>
		</td>
		<input type="hidden" name="accion" value="guardar">
	</form>

	</div>

<style>
#imagen_previa{
    width: 15em;
    height: 10em;
    opacity: 0;
    display: block;
    transition: 2.5s;
}	
</style>

<script>
var input = document.getElementById("anexo"),
    img = document.getElementById("imagen_previa");

input.addEventListener("change", function(){
    var file = this.files[0],
        reader = new FileReader();
			    
    reader.addEventListener("load", function(e){
	    if (img.style.opacity == 0){
		    img.src = e.target.result;
			img.style.opacity = 1;
        }
		else{
		    img.style.opacity = 0;
			setTimeout(function(){
			    img.src = e.target.result;
			    img.style.opacity = 1;
            }, 1000);
        }
    }, false);
			  
	reader.readAsDataURL(file);
}, false);	
</script>	



	
	
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
		$aleatorio=rand(1,999)."_".date("Y-m-d");
		$ruta_imagen2=RUTA_LOGO_SAIA."logo_".$aleatorio.".".$extension;
		
		
		if(RUTA_LOGO_SAIA==''){
		    alerta("<span style='color:white;'>No existe configuracion para el almacenado del logo... favor verificar e intentarlo nuevamente!</span>",'error',5000);
		    return false;		    
		}
        
        if(!crear_destino($ruta_db_superior.RUTA_LOGO_SAIA)){
		    alerta("<span style='color:white;'>No Fue posible crear la ruta para almacenar el logo... favor verificar la configuracion e intentarlo nuevamente!</span>",'error',5000);
		    return false;	            
        }
        
		//cambia_tam($_FILES["anexo"]["tmp_name"],$ruta_db_superior.$ruta_imagen2,145,90,"");
		
		if( cambia_tam($_FILES["anexo"]["tmp_name"],$ruta_db_superior.$ruta_imagen2,145,90,"") ){
    		chmod($ruta_db_superior.$ruta_imagen2,PERMISOS_ARCHIVOS);
    		$sql="UPDATE configuracion SET valor='".$ruta_imagen2."' WHERE nombre='logo'";
    		phpmkr_query($sql);		    
		}else{
		    alerta("No fue posible subir el logo... favor intentarlo nuevamente!",'error',5000);
		    return false;
		}
		

	}
	else{
		alerta("El archivo anexo no es jpg... favor intentarlo con un logo correcto!",'warning');
		return false;
	}
	return true;
}

?>