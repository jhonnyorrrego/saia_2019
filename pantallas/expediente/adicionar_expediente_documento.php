<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
?>
<style type="text/css">
ul.fancytree-container {
    overflow: auto;
    position: relative;
    border: none;
}
span.fancytree-title 
{  
	font-family: Verdana,Tahoma,arial;
	font-size: 9px; 
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap-responsive.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap_reescribir.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap-datetimepicker.min.css"/>
<?php include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
include_once ($ruta_db_superior . "arboles/crear_arbol_ft.php");
include_once($ruta_db_superior."librerias_saia.php");
$dato_padre=busca_filtro_tabla("","expediente a","a.idexpediente=".$_REQUEST["cod_padre"],"",$conn);
?>
<form name="formulario_expediente" id="formulario_expediente" method="post">
<input type="hidden" name="iddoc" id="iddoc" value="<?php echo($_REQUEST["iddoc"]);?>">
<input type="hidden" id="cerrar_higslide" value="<?php echo(@$_REQUEST["cerrar_higslide"]);?>">
<legend>Crear expediente</legend>
<div class="control-group element">
  <label class="control-label" for="nombre">Expediente padre
  </label>
  <div class="controls"> 
    <span class="phpmaker">
<?php
echo(librerias_jquery("2.2"));
echo librerias_UI("1.12");
$origen = array("url" => "arboles/arbol_expediente.php", "ruta_db_superior" => $ruta_db_superior,
    "params" => array(
        "accion" => 1,
        "permiso_editar" => 1,
        "doc" => $_REQUEST["iddoc"],
        "checkbox"=>radio,
    ));
$opciones_arbol = array("keyboard" => true, "busqueda_item" => 1);
$extensiones = array("filter" => array());
$arbol = new ArbolFt("cod_padre", $origen, $opciones_arbol, $extensiones);
echo $arbol->generar_html();
?>
      <input type="hidden" name="ejecutar_expediente" value="set_expediente_documento">
      <input type="hidden" name="tipo_retorno" value="1">
    </span>
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="fecha">Fecha de creaci&oacute;n *
  </label>
  <div class="controls"> 
		<div id="fecha" class="input-append date">
			<input data-format="yyyy-MM-dd" type="text" name="fecha" value="<?php echo(date("Y-m-d"));?>" readonly />
			<span class="add-on">
				<i data-time-icon="icon-time" data-date-icon="icon-calendar">
				</i>
			</span>
		</div>
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="nombre">Nombre *
  </label>
  <div class="controls"> 
    <input type="text" name="nombre" id="nombre" >
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="nombre">Descripci&oacute;n
  </label>
  <div class="controls"> 
    <textarea name="descripcion" id="descripcion"></textarea>
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="nombre">Serie asociada *
  </label>
  <div class="controls"> 
    <?php
    $origen = array("url" => "arboles/arbol_serie_funcionario.php", "ruta_db_superior" => $ruta_db_superior,
    "params" => array(
   		 "tipo1" => 1,
        "tipo2" => 1,
        "tipo3" => 0,
        "tvd"=>0,
        "checkbox"=>'radio'
    ));
$opciones_arbol = array("keyboard" => true, "busqueda_item" => 1,"selectMode"=>1);
$extensiones = array("filter" => array());
$arbol = new ArbolFt("serie_idserie", $origen, $opciones_arbol, $extensiones);
echo $arbol->generar_html();
?>
  </div>
</div>
<input type="hidden" name="key_formulario_saia" value="<?php echo(generar_llave_md5_saia());?>">
<div>
<button class="btn btn-primary btn-mini" id="submit_formulario_expediente">Aceptar</button>
<button class="btn btn-mini" id="" onclick="window.open('<?php echo($ruta_db_superior); ?>expediente_llenar.php?iddoc=<?php echo(@$_REQUEST["iddoc"]); ?>','_self'); return false;">Volver</button>
<?php if(@$_REQUEST["volver"]&&@$_REQUEST["enlace"]){ ?>
	<button class="btn btn-mini" onclick="window.open('<?php echo($ruta_db_superior.$_REQUEST["enlace"]); ?>?variable_busqueda=idexpediente/**/<?php echo($_REQUEST["cod_padre"]); ?>&idbusqueda_componente=<?php echo($_REQUEST["idbusqueda_componente"]); ?>','_self');">Volver</button>
<?php } ?>
<div id="cargando_enviar" class="pull-right"></div>
</div>
</form>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap/saia/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.validate_v1.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/idiomas/jquery.validates.es.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/themes/default.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_notificaciones.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_codificacion.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap/saia/bootstrap-datetimepicker.js"></script>
<?php
  echo(librerias_arboles_ft("2.24", 'filtro'));
  ?>
<script type="text/javascript">
$(document).ready(function(){
  $('#fecha').datetimepicker({
    language: 'es',
    pick12HourFormat: true,
    pickTime: false      
  });
  var formulario_expediente=$("#formulario_expediente");
  formulario_expediente.validate({
  "rules":{"nombre":{"required":true}},
  submitHandler: function(form) {
  }
  });
  $("#submit_formulario_expediente").click(function(){  
    $('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
		$(this).attr('disabled', 'disabled');  
    if(formulario_expediente.valid()){
    	<?php if(@$_REQUEST["volver"]&&@$_REQUEST["enlace"]){ ?>
    		window.open('<?php echo($ruta_db_superior.$_REQUEST["enlace"]); ?>?variable_busqueda=idexpediente/**/<?php echo($_REQUEST["cod_padre"]); ?>&idbusqueda_componente=<?php echo($_REQUEST["idbusqueda_componente"]); ?>','_self');
    	<?php } ?>
    	<?php encriptar_sqli("formulario_expediente",0,"form_info",$ruta_db_superior); ?>
      $.ajax({
        type:'POST',
        async:false,
        url: "<?php echo($ruta_db_superior);?>pantallas/expediente/ejecutar_acciones.php",
        data: "rand="+Math.round(Math.random()*100000)+"&"+formulario_expediente.serialize(),
        success: function(html){               
          if(html){                   
            var objeto=jQuery.parseJSON(html);                  
            if(objeto.exito){
              $('#cargando_enviar').html("Terminado ...");
              notificacion_saia(objeto.mensaje,"success","",2500);
              window.open("<?php echo($ruta_db_superior); ?>expediente_llenar.php?iddoc=<?php echo(@$_REQUEST["iddoc"]); ?>","_self");
            }
            else{
              $('#cargando_enviar').html("Terminado ...");
              notificacion_saia(objeto.mensaje,"error","",8500);
            }                  
          }          
        }
    	});
    }
    else{
      notificacion_saia("Formulario con errores","error","",8500);
    }
  });  
});
</script>