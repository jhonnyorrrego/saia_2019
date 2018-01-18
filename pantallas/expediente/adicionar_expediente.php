<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-responsive.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap_reescribir.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-iconos-segundarios.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-datetimepicker.min.css"/>
<style>
.clase_sin_capas{
	margin-bottom: 0px;
  min-height: 0px;
  padding: 0px;
  border: 0px solid #E3E3E3;
}
</style>
<?php include_once($ruta_db_superior."db.php"); ?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery-1.7.min.js"></script>
<?php include_once($ruta_db_superior."librerias_saia.php");
$dato_padre=busca_filtro_tabla("","expediente a","a.idexpediente=".$_REQUEST["cod_padre"],"",$conn);
?>
<form name="formulario_expediente" id="formulario_expediente">
<input type="hidden" name="estado_cierre" id="estado_cierre" value="1">
<?php if($dato_padre["numcampos"]){ ?>
	<input type="hidden" name="estado_archivo" id="estado_archivo" value="<?php echo($dato_padre[0]["estado_archivo"]);?>">
<?php }else{ ?>
	<input type="hidden" name="estado_archivo" id="estado_archivo" value="<?php echo($_REQUEST["estado_archivo"]);?>">
<?php } ?>
<input type="hidden" name="cod_padre" id="cod_padre" value="<?php echo($_REQUEST["cod_padre"]);?>">
<input type="hidden" name="iddocumento" id="iddocumento" value="<?php echo($_REQUEST["iddocumento"]);?>">
<input type="hidden" id="cerrar_higslide" value="<?php echo(@$_REQUEST["cerrar_higslide"]);?>">
<legend>Crear expediente</legend>


<div class="control-group element">
  <label class="control-label" for="agrupador">Agrupador
  </label>
  <div class="controls"> 
		<input type="radio" name="agrupador" id="agrupado0"  value="0" checked>No
		<input type="radio" name="agrupador" id="agrupado1" value="1">Si
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="nombre">Nombre *
  </label>
  <div class="controls"> 
    <input type="text" name="nombre" id="nombre" >
  </div>
</div>
<script>
    $(document).ready(function(){
        $('[name="agrupador"]').click(function(){
            var valor=$(this).val();
            
            if(parseInt(valor)){ //agrupador = 1
                $('#informacion_completa_expediente').hide();
                $('#serie_idserie').val(-1);
            }else{ // no es agrupador = 0
                $('#informacion_completa_expediente').show();
                $('#serie_idserie').val('');
            }
           
        });
    });
</script>

<?php 
 if($dato_padre['numcampos']){
?>
<div class="control-group element">
	Este quedar&aacute; vinculado al expediente <b><?php echo($dato_padre[0]["nombre"]); ?></b> 
</div>

<?php
 }
?>


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
<div id="informacion_completa_expediente">
    
<div class="control-group element">
  <label class="control-label" for="nombre">Descripci&oacute;n
  </label>
  <div class="controls"> 
    <textarea name="descripcion" id="descripcion"></textarea>
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="indice_uno">Indice uno
  </label>
  <div class="controls"> 
    <input type="text" name="indice_uno" id="indice_uno">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="indice_dos">Indice Dos
  </label>
  <div class="controls"> 
    <input type="text" name="indice_dos" id="indice_dos">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="indice_tres">Indice Tres
  </label>
  <div class="controls"> 
    <input type="text" name="indice_tres" id="indice_tres">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="seguridad">Caja
  </label>
  <div class="controls">
  	<select name="fk_idcaja" id="fk_idcaja">
  		<option value="">Por favor seleccione...</option>
  		<?php
  		$cajas=busca_filtro_tabla("","caja A","","",$conn);
			for($i=0;$i<$cajas["numcampos"];$i++){
				$selected="";
				
				if(@$_REQUEST["fk_idcaja"]==$cajas[$i]["idcaja"]){
					$selected="selected";
				}
				if($datos[0]["fk_idcaja"]==$cajas[$i]["idcaja"]){
					$selected="selected";
				}
				echo("<option value='".$cajas[$i]["idcaja"]."' ".$selected.">".$cajas[$i]["fondo"]."(".$cajas[$i]["codigo_dependencia"]."-".$cajas[$i]["codigo_serie"]."-".$cajas[$i]["consecutivo"].")</option>");
			}
  		?>
  	</select>
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="serie_idserie">Serie asociada *
  </label>
  <div class="controls">
        <span class="phpmaker">
    			<input type="text" id="stext_serie" width="200px" size="20">          
          <a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById('stext_serie').value),1)">
          <img src="<?php echo $ruta_db_superior; ?>botones/general/anterior.png"border="0px"></a>
          <a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById('stext_serie').value),0,1)">
          <img src="<?php echo $ruta_db_superior; ?>botones/general/buscar.png"border="0px"></a>
          <a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById('stext_serie').value))">
          <img src="<?php echo $ruta_db_superior; ?>botones/general/siguiente.png"border="0px"></a>      
          <div id="esperando_serie"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
    			<div id="treeboxbox_tree3" class="arbol_saia"></div>
         
        </span>
         <input type="hidden" name="serie_idserie" id="serie_idserie">
         <input type="hidden" name="dependencia_iddependencia" id="dependencia_iddependencia">
  </div>
</div>

<div data-toggle="collapse" data-target="#datos_adicionales">
  <i class="icon-plus-sign"></i><b>Informaci&oacute;n adicional</b>
</div>
<div id="datos_adicionales" class="datos_adicionales collapse opcion_informacion clase_sin_capas">
	
	<div class="control-group element">
	  <label class="control-label" for="codigo_numero">Codigo numero
	  </label>
	  <div class="controls">
	      
	    <?php  
	        $dep_fun=busca_filtro_tabla("a.codigo","dependencia a,vfuncionario_dc b","a.estado=1 AND b.iddependencia=a.iddependencia AND b.estado_dc=1 AND b.estado_dep=1 AND b.login='".usuario_actual('login')."'","",$conn); 
	    ?>
	    <input name="codigo_numero_dependencia" id="codigo_numero_dependencia"  style="width:12%;" readonly> - 
	    <input name="codigo_numero_serie" id="codigo_numero_serie" style="width:12%;" readonly> - 
	    <input name="codigo_numero_consecutivo" id="codigo_numero_consecutivo" style="width:10%;">
	    <input name="codigo_numero" id="codigo_numero" type="hidden">
	  </div>
	  
	  <script>
	      $(document).ready(function(){
	          $('#codigo_numero_dependencia,#codigo_numero_serie,#codigo_numero_consecutivo').keyup(function(){
	              var codigo_numero_dependencia=$('#codigo_numero_dependencia').val();
	              if(codigo_numero_dependencia==''){
	                  codigo_numero_dependencia=0;
	              }
	              var codigo_numero_serie=$('#codigo_numero_serie').val();
	              if(codigo_numero_serie==''){
	                  codigo_numero_serie=0;
	              }	              
	              var codigo_numero_consecutivo=$('#codigo_numero_consecutivo').val();
	              if(codigo_numero_consecutivo==''){
	                  codigo_numero_consecutivo=0;
	              }	  
	              var cadena_parseo=codigo_numero_dependencia+'-'+codigo_numero_serie+'-'+codigo_numero_consecutivo;
	              $('#codigo_numero').val(cadena_parseo);
	             
	          });
	      });
	  </script>
	  
	</div>
	
	<div class="control-group element">
	  <label class="control-label" for="fondo">Fondo
	  </label>
	  <div class="controls"> 
	    <input name="fondo" id="fondo" value="<?php echo($datos[0]["fondo"]); ?>" readonly="readonly">
	  </div>
	</div>
	
	<div class="control-group element">
	  <label class="control-label" for="proceso">Proceso
	  </label>
	  <div class="controls"> 
	    <input name="proceso" id="proceso" value="<?php echo($datos[0]["proceso"]); ?>">
	  </div>
	</div>
	
	<div class="control-group element">
	  <label class="control-label" for="fecha_extrema_i">Fecha extrema inicial
	  </label>
	  <div id="fecha_extrema_i" class="input-append date">
			<input data-format="yyyy-MM-dd" type="text" name="fecha_extrema_i" value="<?php echo($datos[0]["fecha_extrema_i"]);?>" readonly />
			<span class="add-on">
				<i data-time-icon="icon-time" data-date-icon="icon-calendar">
				</i>
			</span>
		</div>
	</div>
	
	<div class="control-group element">
	  <label class="control-label" for="fecha_extrema_f">Fecha extrema final
	  </label>	  
	  <div id="fecha_extrema_f" class="input-append date">
			<input data-format="yyyy-MM-dd" type="text" name="fecha_extrema_f" value="<?php echo($datos[0]["fecha_extrema_f"]);?>" readonly />
			<span class="add-on">
				<i data-time-icon="icon-time" data-date-icon="icon-calendar">
				</i>
			</span>
		</div>
	</div>
	
	<div class="control-group element">
	  <label class="control-label" for="no_unidad_conservacion">Unidad de conservaci&oacute;n
	  </label>
	  <div class="controls"> 
	    <input name="no_unidad_conservacion" id="no_unidad_conservacion" value="<?php echo($datos[0]["no_unidad_conservacion"]); ?>">
	  </div>
	</div>
	
	<div class="control-group element">
	  <label class="control-label" for="no_folios">No folios
	  </label>
	  <div class="controls"> 
	    <input name="no_folios" id="no_folios" value="<?php echo($datos[0]["no_folios"]); ?>">
	  </div>
	</div>
	
	<div class="control-group element">
	  <label class="control-label" for="no_carpeta">No carpeta
	  </label>
	  <div class="controls"> 
	    <input name="no_carpeta" id="no_carpeta" value="<?php echo($datos[0]["no_carpeta"]); ?>">
	  </div>
	</div>
	
	<div class="control-group element">
	  <label class="control-label" for="soporte">Soporte
	  </label>
	  <div class="controls">
	  	<select name="soporte" id="soporte">
	  		<option value="">Por favor seleccione...</option>
				<option value="1" <?php if($datos[0]["soporte"]==1)echo("selected"); ?>>CD-ROM</option>
				<option value="2" <?php if($datos[0]["soporte"]==2)echo("selected"); ?>>DISKETE</option>
				<option value="3" <?php if($datos[0]["soporte"]==3)echo("selected"); ?>>DVD</option>
				<option value="4" <?php if($datos[0]["soporte"]==4)echo("selected"); ?>>DOCUMENTO</option>
				<option value="5" <?php if($datos[0]["soporte"]==5)echo("selected"); ?>>FAX</option>
				<option value="6" <?php if($datos[0]["soporte"]==6)echo("selected"); ?>>REVISTA O LIBRO</option>
				<option value="7" <?php if($datos[0]["soporte"]==7)echo("selected"); ?>>VIDEO</option>
				<option value="8" <?php if($datos[0]["soporte"]==8)echo("selected"); ?>>OTROS ANEXOS</option>
	  	</select>
	  </div>
	</div>
	
	<div class="control-group element">
	  <label class="control-label" for="frecuencia_consulta">Frecuencia
	  </label>
	  <div class="controls">
	  	<select name="frecuencia_consulta" id="frecuencia_consulta">
	  		<option value="">Por favor seleccione...</option>
				<option value="1" <?php if($datos[0]["frecuencia_consulta"]==1)echo("selected"); ?>>Alta</option>
				<option value="2" <?php if($datos[0]["frecuencia_consulta"]==2)echo("selected"); ?>>Media</option>
				<option value="3" <?php if($datos[0]["frecuencia_consulta"]==3)echo("selected"); ?>>Baja</option>
	  	</select>
	  </div>
	</div>
	
	<div class="control-group element">
	  <label class="control-label" for="ubicacion">Ubicaci&oacute;n
	  </label>
	  <div class="controls">
	  	<select name="ubicacion" id="ubicacion">
	  		<option value="">Por favor seleccione...</option>
				<option value="1" <?php if($datos[0]["ubicacion"]==1)echo("selected"); ?>>Central</option>
				<option value="2" <?php if($datos[0]["ubicacion"]==2)echo("selected"); ?>>Gestion</option>
				<option value="3" <?php if($datos[0]["ubicacion"]==3)echo("selected"); ?>>Historico</option>
	  	</select>
	  </div>
	</div>
	
	<div class="control-group element">
	  <label class="control-label" for="notas_transf">Notas de Transferencia
	  </label>
	  <div class="controls"> 
	      <textarea name="notas_transf" id="notas_transf"><?php echo($datos[0]["notas_transf"]); ?></textarea>
	  </div>
	</div>
	
</div>	
	
</div>
<br />
<input type="hidden" name="estado_archivo" value="1">
<input type="hidden" name="key_formulario_saia" value="<?php echo(generar_llave_md5_saia());?>">
<div>
<button class="btn btn-primary btn-mini" id="submit_formulario_expediente">Aceptar</button>
<button class="btn btn-mini" id="cancel_formulario_expediente">Cancelar</button>
<?php if(@$_REQUEST["volver"]&&@$_REQUEST["enlace"]){ ?>
	<button class="btn btn-mini" onclick="window.open('<?php echo($ruta_db_superior.$_REQUEST["enlace"]); ?>?variable_busqueda=idexpediente/**/<?php echo($_REQUEST["cod_padre"]); ?>&idbusqueda_componente=<?php echo($_REQUEST["idbusqueda_componente"]); ?>','_self');">Volver</button>
<?php } ?>
<div id="cargando_enviar" class="pull-right"></div>
</div>
</form>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.validate_v1.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/idiomas/jquery.validates.es.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/themes/default.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_notificaciones.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_codificacion.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap-datetimepicker.js"></script>
<?php
  echo(librerias_arboles());
  ?>
  <script type="text/javascript">
  $(document).ready(function(){
            
    var browserType;
    if (document.layers) {browserType = "nn4"}
    if (document.all) {browserType = "ie"}
    if (window.navigator.userAgent.toLowerCase().match("gecko")) {
       browserType= "gecko"
    }    
    tree3=new dhtmlXTreeObject("treeboxbox_tree3","","",0);
  	tree3.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
  	tree3.enableIEImageFix(true);
    tree3.enableCheckBoxes(1);
    tree3.enableRadioButtons(true);
    tree3.setOnLoadingStart(cargando_serie);
    tree3.setOnLoadingEnd(fin_cargando_serie);
    tree3.enableSmartXMLParsing(true);
    //tree3.setXMLAutoLoading("<?php echo($ruta_db_superior);?>test_serie_funcionario.php?con_padres=1&pantalla=expediente");	
  	//tree3.loadXML("<?php echo($ruta_db_superior);?>test_serie_funcionario.php?con_padres=1&pantalla=expediente");
  	tree3.setXMLAutoLoading("../../test_dependencia_serie.php?tabla=dependencia&admin=1&mostrar_nodos=dsa&sin_padre_dependencia=1&cargar_series=1&funcionario=1&carga_partes_dependencia=1&carga_partes_series=1&no_grupos=1&no_tipos=1");	
  	tree3.loadXML("../../test_dependencia_serie.php?tabla=dependencia&admin=1&mostrar_nodos=dsa&sin_padre_dependencia=1&cargar_series=1&funcionario=1&carga_partes_dependencia=1&carga_partes_series=1&no_grupos=1&no_tipos=1");
    tree3.setOnCheckHandler(onNodeSelect_serie);
      
  	function onNodeSelect_serie(nodeId){
  	  if(tree3.isItemChecked(nodeId)){
  		var item_select=tree3.getAllChecked();
  		console.log(nodeId+" -- "+item_select);
  		if(item_select!=="undefined" && item_select!=nodeId){
  	  		lista_items=item_select.split(",");
  	  		for(i=0;i<lista_items.length;i++){
  	  			tree3.setCheck(lista_items[i],0);
  	  	  	}
  	  	}
  		tree3.setCheck(nodeId,1);
        $("#serie_idserie").val(tree3.getUserData(nodeId,"idserie"));
        $("#dependencia_iddependencia").val(tree3.getUserData(nodeId,"iddependencia"));
        $("#codigo_numero_serie").val(tree3.getUserData(nodeId,"serie_codigo"));
    	$("#codigo_numero_dependencia").val(tree3.getUserData(nodeId,"dependencia_codigo"));
    	$("#fondo").val(tree3.getUserData(nodeId,"dependencia_nombre"));
    	$("#codigo_numero_serie").trigger('keyup');
      }
      else{
    	$("#serie_idserie").val("");
    	$("#dependencia_iddependencia").val("");
    	$("#codigo_numero_serie").val('');
  	  	$("#codigo_numero_dependencia").val('');
  	    $("#fondo").val('');
  	    $("#codigo_numero_serie").trigger('keyup');
      }
    }
    function fin_cargando_serie() {
      if (browserType == "gecko" )
        document.poppedLayer = eval('document.getElementById("esperando_serie")');
      else if (browserType == "ie")
        document.poppedLayer = eval('document.getElementById("esperando_serie")');
      else
        document.poppedLayer = eval('document.layers["esperando_serie"]');
      document.poppedLayer.style.display = "none";
    }
    function cargando_serie() {
      if (browserType == "gecko" )
        document.poppedLayer = eval('document.getElementById("esperando_serie")');
      else if (browserType == "ie")
        document.poppedLayer = eval('document.getElementById("esperando_serie")');
      else
        document.poppedLayer = eval('document.layers["esperando_serie"]');
      document.poppedLayer.style.display = "";
    }   
    
    
    $(".opcion_informacion").on("hide",function(){
		  $(this).prev().children("i").removeClass();
		  $(this).prev().children("i").addClass("icon-plus-sign");
		  $(this).removeClass('clase_capas');
		  $(this).addClass('clase_sin_capas');
		});
		$(".opcion_informacion").on("show",function(){
		  $(this).prev().children("i").removeClass();
		  $(this).prev().children("i").addClass("icon-minus-sign");
		  $(this).removeClass('clase_sin_capas');
		  $(this).addClass('clase_capas');
		});
  });
  </script>
<script type="text/javascript">
$(document).ready(function(){
  $('#fecha').datetimepicker({
    language: 'es',
    pick12HourFormat: true,
    pickTime: false      
  });
  $('#fecha_extrema_i').datetimepicker({
    language: 'es',
    pick12HourFormat: true,
    pickTime: false      
  });
  $('#fecha_extrema_f').datetimepicker({
    language: 'es',
    pick12HourFormat: true,
    pickTime: false      
  });
  var formulario_expediente=$("#formulario_expediente");
  formulario_expediente.validate({
    ignore: [],  
  "rules":{
      "nombre":{"required":true},
      "serie_idserie":{"required":true}
      
  },
  submitHandler: function(form) {
  }
  });
  $("#submit_formulario_expediente").click(function(){  
    if(formulario_expediente.valid()){
    	$('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
			$(this).attr('disabled', 'disabled');
    	<?php if(@$_REQUEST["volver"]&&@$_REQUEST["enlace"]){ ?>
    		window.open('<?php echo($ruta_db_superior.$_REQUEST["enlace"]); ?>?variable_busqueda=idexpediente/**/<?php echo($_REQUEST["cod_padre"]); ?>&idbusqueda_componente=<?php echo($_REQUEST["idbusqueda_componente"]); ?>','_self');
    	<?php }  ?>
      $.ajax({
        type:'GET',
        async:false,
        url: "<?php echo($ruta_db_superior);?>pantallas/expediente/ejecutar_acciones.php",
        data: "ejecutar_expediente=set_expediente&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+formulario_expediente.serialize(),
        success: function(html){               
          if(html){    
            var objeto=jQuery.parseJSON(html);                  
            if(objeto.exito){
              $.ajax({
                type:'POST',
                async:false,
                url: "<?php echo($ruta_db_superior);?>pantallas/busquedas/servidor_busqueda.php",
                data: "idbusqueda_componente=<?php echo($_REQUEST['idbusqueda_componente']); ?>&page=1&rows=1&actual_row=0&expediente_actual="+objeto.idexpediente+"&idexpediente=<?php echo(@$_REQUEST['cod_padre']);?>&variable_busqueda=<?php echo(@$_REQUEST["estado_archivo"]); ?>",
                success: function(html2){              
                  if(html2){      
                    var objeto2=jQuery.parseJSON(html2);
                    if(objeto2.exito!==0){
                      $("#<?php echo($_REQUEST['div_actualiza']);?>", parent.document).prepend(objeto2.rows[0].info);
                    }  
                  }
                }
              });   
              $('#cargando_enviar').html("Terminado ...");  
              if($("#cerrar_higslide").val()){            
                $("#arbol_padre_actualizado", parent.document).val($("#cod_padre").val());
                parent.window.hs.getExpander().close();                  
              }                                        
              if($("#iddocumento").val()==''){
                notificacion_saia(objeto.mensaje,"success","",2500);                                                                                            
                window.open("detalles_expediente.php?idexpediente="+objeto.idexpediente+"&idbusqueda_componente=<?php echo($_REQUEST['idbusqueda_componente']);?>&rand="+Math.round(Math.random()*100000),"_self");
              }
              else{
                window.open("vincular_documento.php?idexpediente="+objeto.idexpediente+"&iddocumento="+$("#iddocumento").val()+"&rand="+Math.round(Math.random()*100000),"_self");
              }                                           	
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