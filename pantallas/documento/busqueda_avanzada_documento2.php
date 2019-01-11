<meta http-equiv="X-UA-Compatible" content="IE=9">
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
?>
<!DOCTYPE html>     
<html>
  <head>
  <?php
  echo(librerias_html5());
  echo(librerias_jquery("1.7"));
  echo(estilo_bootstrap()); 
  //echo(librerias_validar_formulario());
  ?>    
  <link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/documento/css/documento.css">
  </head>
  <body data-spy="scroll" data-target="#barra_lateral" data-offset="10">
  	<form accept-charset="UTF-8" action="<?php echo $ruta_db_superior; ?>pantallas/busquedas/procesa_filtro_busqueda.php" id="kformulario_saia" method="post" name="kformulario_saia">
  	
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">                           
      <ul class="nav pull-left">                                         
        <li>          
  	        <button type="button" class="btn btn-primary btn-mini" id="ksubmit_saia" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">
  	        	&nbsp;Buscar&nbsp;
  	        </button>
        </li>                 
        <li class="divider-vertical">
        </li>
        <li>                     
  	      <input class="btn btn-danger btn-mini reset" name="commit" type="reset" value="Cancelar">                    
        </li>
        <li class="divider-vertical">
        </li> 
      </ul>      
    </div>
  </div>
    <div class="span3 bs-docs-sidebar" id="barra_lateral">
      <ul class="nav nav-list bs-docs-sidenav affix" style="width:150px">
        <li><a href="#principal">B&uacute;squeda r&aacute;pida</a></li>
        <li><a href="#contenido">Por contenido del documento</a></li>
        <li><a href="#gestion">Por gesti&oacute;n del documento</a></li>
      </ul>
    </div>
    <div class="container master-container span9" style="left:250px;position:absolute">
        <!--div class="row">
          <div class="control-group radio_buttons span4">
            Tipo
            
            <div class="controls">
              	<select onchange="llamado_formulario(this.value,'<?php echo $ruta_db_superior; ?>','<?php echo $_REQUEST["idbusqueda_componente"]?>');">
              		<option value="-1" selected>General</option>
              		<?php
              		$formatos=busca_filtro_tabla("","formato","cod_padre is null or cod_padre=0","",$conn);
        					for($i=0;$i<$formatos["numcampos"];$i++){
        						if(in_array("1",explode(",",$formatos[$i]["mostrar"]))){
        							echo '<option value="'.$formatos[$i]["nombre"].'">'.ucfirst(strtolower($formatos[$i]["etiqueta"])).'</option>';
        						}
        					}
              		?>
              	</select>
            </div>          
          </div> 
        </div-->
		    <!--hr width="75%" color="black" style="text-align:left" /-->
        <div id="mostrar_contenido">
        	<?php include_once("busqueda_general2.php"); ?>
        </div>
                
        <div id="div_otros_campos" style="display:none">
        	
        </div>
        
        <!--input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>"-->
	    <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/documento/js/carga_formulario.js"></script>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/codificacion_funciones.js"></script>
  <script>
  $(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
        $("#ksubmit_saia").click();
    }
});
  </script>
<?php 
echo(librerias_arboles());
echo(librerias_bootstrap());
echo(librerias_datepicker_bootstrap());

?>
<script src="<?php echo $ruta_db_superior; ?>js/jquery.js"></script>
</html>