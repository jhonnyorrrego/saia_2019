<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap-responsive.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap_reescribir.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap-datetimepicker.min.css"/>
<style>
.clase_sin_capas{
	margin-bottom: 0px;
  min-height: 0px;
  padding: 0px;
  border: 0px solid #E3E3E3;
 }
ul.fancytree-container {
    border: none;
}
span.fancytree-title 
{  
	font-family: Verdana,Tahoma,arial;
	font-size: 9px; 
}
</style>
<?php include_once($ruta_db_superior."db.php"); 
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
include_once($ruta_db_superior."librerias_saia.php");
require_once $ruta_db_superior . "arboles/crear_arbol_ft.php";
echo librerias_jquery("3.3");
$datos=busca_filtro_tabla(fecha_db_obtener('a.fecha','Y-m-d')." as x_fecha, ".fecha_db_obtener('a.fecha_extrema_i','Y-m-d')." as x_fecha_extrema_i, ".fecha_db_obtener('a.fecha_extrema_f','Y-m-d')." x_fecha_extrema_f,a.*","expediente a","a.idexpediente=".$_REQUEST["idexpediente"],"",$conn);
$dato_padre=busca_filtro_tabla("","expediente a","a.idexpediente=".$datos[0]["cod_padre"],"",$conn);
$dato_serie=busca_filtro_tabla("","serie","idserie=".$datos[0]["serie_idserie"],"",$conn);
if($dato_serie["numcampos"]){
	$tipo_tvd = $dato_serie[0]["tvd"];
}
$buscar_entidad_serie=busca_filtro_tabla("llave_entidad, serie_idserie","entidad_serie","identidad_serie=".$datos[0]["fk_entidad_serie"],"",$conn);
if($buscar_entidad_serie["numcampos"]){
	$iddependencia = $buscar_entidad_serie[0]["llave_entidad"];
	$idserie = $buscar_entidad_serie[0]["serie_idserie"];
	$buscar_dependencia=busca_filtro_tabla("codigo","dependencia","iddependencia=".$iddependencia,"",$conn);
	if($buscar_dependencia["numcampos"]){
		$codigo_dependencia = $buscar_dependencia[0]["codigo"];
	}
	$buscar_serie=busca_filtro_tabla("codigo","serie","idserie=".$idserie,"",$conn);
	if($buscar_serie["numcampos"]){
		$codigo_serie = $buscar_serie[0]["codigo"];
	}
}
?>
<form name="formulario_expediente" id="formulario_expediente" method="post">
<input type="hidden" name="idexpediente" id="idexpediente" value="<?php echo($datos[0]["idexpediente"]);?>">
<input type="hidden" name="iddocumento" id="iddocumento" value="<?php echo($_REQUEST["iddocumento"]);?>">
<input type="hidden" id="cerrar_higslide" value="<?php echo(@$_REQUEST["cerrar_higslide"]);?>">
<legend>Editar expediente</legend>
<div id="informacion_completa_expediente">
<?php
if($dato_padre["numcampos"]){
?>
<div class="control-group element">
	Este est&aacute; vinculado al expediente <b><?php echo($dato_padre[0]["nombre"]); ?></b> 
</div>
<?php } ?>
<div id="div_nombre_exp" class="control-group element">
  <label class="control-label" for="nombre">Nombre *
  </label>
  <div class="controls"> 
    <input type="text" name="nombre" id="nombre" value="<?php echo($datos[0]["nombre"]); ?>">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="fecha">Fecha de creaci&oacute;n *
  </label>
  <div class="controls"> 
		<div id="fecha" class="input-append date">
			<input data-format="yyyy-MM-dd" type="text" name="fecha" value="<?php echo($datos[0]["x_fecha"]);?>" readonly />
			<span class="add-on">
				<i data-time-icon="icon-time" data-date-icon="icon-calendar">
				</i>
			</span>
		</div>
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="nombre">Descripci&oacute;n
  </label>
  <div class="controls"> 
    <textarea name="descripcion" id="descripcion"><?php echo($datos[0]["descripcion"]); ?></textarea>
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="indice_uno">Indice uno
  </label>
  <div class="controls"> 
    <input type="text" name="indice_uno" id="indice_uno" value="<?php echo($datos[0]["indice_uno"]); ?>">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="indice_dos">Indice Dos
  </label>
  <div class="controls"> 
    <input type="text" name="indice_dos" id="indice_dos" value="<?php echo($datos[0]["indice_dos"]); ?>">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="indice_tres">Indice Tres
  </label>
  <div class="controls"> 
    <input type="text" name="indice_tres" id="indice_tres" value="<?php echo($datos[0]["indice_tres"]); ?>">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="seguridad">Caja
  </label>
  <div class="controls">
  	<select name="fk_idcaja" id="fk_idcaja">
  		<option value="">Por favor seleccione...</option>
  		<?php
  		$cajas=busca_filtro_tabla("distinct a.idcaja, a.no_consecutivo","caja a,entidad_caja e","a.idcaja=e.caja_idcaja and e.estado=1 and ((e.entidad_identidad=1 and e.llave_entidad=".usuario_actual('idfuncionario').") or a.funcionario_idfuncionario=".usuario_actual('idfuncionario').")","",$conn);
		
			for($i=0;$i<$cajas["numcampos"];$i++){
				$selected="";
				if($datos[0]["fk_idcaja"]==$cajas[$i]["idcaja"])$selected="selected";
				//echo("<option value='".$cajas[$i]["idcaja"]."' ".$selected.">".$cajas[$i]["fondo"]."(".$cajas[$i]["codigo_dependencia"]."-".$cajas[$i]["codigo_serie"]."-".$cajas[$i]["no_consecutivo"].")</option>");
				echo("<option value='".$cajas[$i]["idcaja"]."' ".$selected.">".$cajas[$i]["no_consecutivo"]."</option>");
			}
  		?>
  	</select>
  </div>
</div>

<?php
?>
<div id="div_serie_asociada">
	<div class="control-group element">
	  <label class="control-label" for="nombre">Padre *
	  </label>
	  <div class="controls">
	  	<b><?php if($datos[0]["cod_padre"]){ echo("Serie. ".mostrar_seleccionados_exp($datos[0]["cod_padre"],"nombre","expediente")." | Fondo. ".mostrar_seleccionados_exp($datos[0]["cod_padre"],"fondo","expediente")); } ?></b>
	  	<br />
	  	<div id="treeboxbox_tree2" class="arbol_saia"></div>
	   
	  </div>
	</div>
	
	<!--div class="control-group element">
	  <label class="control-label" for="serie_idserie">Serie asociada *
	  </label>
	  <div class="controls">       
	  	<?php echo("<b><span id='etiqueta_serie'>Serie.</span></b> <span id='serie_asociada'>".mostrar_seleccionados_exp($datos[0]["serie_idserie"],"nombre","serie")."</span> <b>| Fondo.</b> ".$datos[0]["fondo"]); ?>
	  	<br />
	    <span class="phpmaker">
	    	<?php
	    	$key = $datos[0]["serie_idserie"];		
			$origen = array("url" => "arboles/arbol_dependencia_serie_funcionario.php", "ruta_db_superior" => $ruta_db_superior,
			    "params" => array(		    	
			        "checkbox" => 'radio',
			        "expandir" => 1,
			        "funcionario"=>1,
			        "seleccionados" => $key
			    ));
			$opciones_arbol = array("keyboard" => true, "selectMode" => 1, "busqueda_item" => 1, "expandir" => 3, "busqueda_item" => 1, "onNodeSelect" =>'cargar_info_Node');
			$extensiones = array("filter" => array());
			$arbol = new ArbolFt("serie_idserie", $origen, $opciones_arbol, $extensiones);
			echo $arbol->generar_html();
			?>	
	     <input type="hidden" name="dependencia_iddependencia" id="dependencia_iddependencia" value="<?php echo($datos[0]["dependencia_iddependencia"]); ?>">
	  </div>
	  
	</div-->
	<div class="control-group element">
	<label class="control-label" for="dependencia">Seleccione dependencia *</label>
	<div class="controls">
		<?php echo("<b><span id='etiqueta_serie'>Serie.</span></b> <span id='serie_asociada'>".mostrar_seleccionados_exp($datos[0]["serie_idserie"],"nombre","serie")." - ".mostrar_seleccionados_exp($datos[0]["serie_idserie"],"codigo","serie")."</span> <b>| Fondo.</b> ".$datos[0]["fondo"]); ?>
	  	<br />
	  	<span class="phpmaker">
		<?php
		$origen = array("url" => "arboles/arbol_dependencia.php", "ruta_db_superior" => $ruta_db_superior,
		    "params" => array(		    	
		        "checkbox" => 'radio',		        
		        "cargar_partes"=>1
		       // "seleccionados" => $datos[0]["dependencia_iddependencia"]
		    ));
		$opciones_arbol = array("keyboard" => true, "selectMode" => 1, "busqueda_item" => 1, "expandir" => 3, "onNodeSelect" =>'seleccionar_dependencia',"lazy"=> true);
		$extensiones = array("filter" => array());
		$arbol_dependencia = new ArbolFt("iddependencia", $origen, $opciones_arbol, $extensiones);
		echo $arbol_dependencia->generar_html();
		?>
	</div>
</div>

<div id="mostrar_serie" class="control-group element">
	<label class="control-label" for="serie_idserie">Seleccione serie *</label>
	<div class="controls">
			<?php
			/*
		$origen = array("url" => "arboles/arbol_expediente_serie.php", "ruta_db_superior" => $ruta_db_superior,
		    "params" => array(		    	
		        "checkbox" => 'radio',		        
		        "cargar_partes"=>1,
		        "iddependencia"=>$datos[0]["dependencia_iddependencia"],
		        "seleccionados" => $datos[0]["dependencia_iddependencia"].'.'.$datos[0]["serie_idserie"].'.0'
		    ));
		$opciones_arbol = array("keyboard" => true, "selectMode" => 1, "onNodeSelect" =>'cargar_info_Node',"lazy"=> true);
		$extensiones = array("filter" => array());
		$arbol_serie = new ArbolFt("serie_idserie", $origen, $opciones_arbol, $extensiones);
		echo $arbol_serie->generar_html();*/
		?>
		<div id="treebox_idserie" class="arbol_saia"></div>
        <input type="hidden" class="required" name="serie_idserie" id="serie_idserie">
	</div>
</div>
</div>
<div data-toggle="collapse" data-target="#datos_adicionales">
  <i class="icon-plus-sign"></i><b>Informaci&oacute;n adicional</b>
</div>
</div>

<div id="datos_adicionales" class="datos_adicionales collapse opcion_informacion clase_sin_capas">
	<div class="control-group element">
	  <label class="control-label" for="codigo_numero">Codigo numero
	  </label>
	  <div class="controls"> 
	    <?php  
	        $vector_codigo_numero=explode('-',$datos[0]["codigo_numero"]);
	    ?>
	    <input name="codigo_numero_dependencia" id="codigo_numero_dependencia" value="<?php /*echo($vector_codigo_numero[0]);*/ echo $codigo_dependencia; ?>"  style="width:12%;" readonly> - 
	    <input name="codigo_numero_serie" id="codigo_numero_serie" value="<?php /*echo($vector_codigo_numero[1]);*/ echo $codigo_serie; ?>" style="width:12%;" readonly> - 
	    <input name="codigo_numero_consecutivo" id="codigo_numero_consecutivo" style="width:10%;" value="<?php /*echo($vector_codigo_numero[2]);*/ echo $datos[0]["codigo_numero"]; ?>">
	    <input name="codigo_numero" id="codigo_numero" type="hidden" value="<?php echo($datos[0]["codigo_numero"]); ?>">
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
	             // var cadena_parseo=codigo_numero_dependencia+'-'+codigo_numero_serie+'-'+codigo_numero_consecutivo;
	             //$('#codigo_numero').val(cadena_parseo);
	              $('#codigo_numero').val(codigo_numero_consecutivo);
	              $('#codigo_numero_consecutivo').val(codigo_numero_consecutivo);
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
			<input data-format="yyyy-MM-dd" type="text" name="fecha_extrema_i" value="<?php if(is_object($datos[0]["x_fecha_extrema_i"]))$datos[0]["x_fecha_extrema_i"]=$datos[0]["x_fecha_extrema_i"]->format('Y-m-d'); echo($datos[0]["x_fecha_extrema_i"]);?>" readonly />
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
			<input data-format="yyyy-MM-dd" type="text" name="fecha_extrema_f" value="<?php if(is_object($datos[0]["x_fecha_extrema_f"]))$datos[0]["x_fecha_extrema_f"]=$datos[0]["x_fecha_extrema_f"]->format('Y-m-d'); echo($datos[0]["x_fecha_extrema_f"]);?>" readonly />
			<span class="add-on">
				<i data-time-icon="icon-time" data-date-icon="icon-calendar">
				</i>
			</span>
		</div>
	</div>
	
	<div class="control-group element">
	  <label class="control-label" for="consecutivo_inicial">Consecutivo Inicial
	  </label>
	  <div class="controls"> 
	    <input name="consecutivo_inicial" id="consecutivo_inicial" value="<?php echo($datos[0]["consecutivo_inicial"]); ?>">
	  </div>
	</div>
	
	<div class="control-group element">
	  <label class="control-label" for="consecutivo_final">Consecutivo Final
	  </label>
	  <div class="controls"> 
	    <input name="consecutivo_final" id="consecutivo_final" value="<?php echo($datos[0]["consecutivo_final"]); ?>">
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
	
	<!--div class="control-group element">
	  <label class="control-label" for="ubicacion">Ubicaci&oacute;n
	  </label>
	  <div class="controls">
	  	<!--select name="ubicacion" id="ubicacion"-->
	  		<!--select name="estado_archivo" id="estado_archivo">
	  		<option value="">Por favor seleccione...</option>
				<!--option value="1" <?php if($datos[0]["ubicacion"]==1)echo("selected"); ?>>Central</option>
				<option value="2" <?php if($datos[0]["ubicacion"]==2)echo("selected"); ?>>Gestion</option>
				<option value="3" <?php if($datos[0]["ubicacion"]==3)echo("selected"); ?>>Historico</option-->
				<!--option value="1" <?php if($datos[0]["estado_archivo"]==1)echo("selected"); ?>>Central</option>
				<option value="2" <?php if($datos[0]["estado_archivo"]==2)echo("selected"); ?>>Gestion</option>
				<option value="3" <?php if($datos[0]["estado_archivo"]==3)echo("selected"); ?>>Historico</option>
	  	</select>
	  </div>
	</div-->
	
	<div class="control-group element">
	  <label class="control-label" for="notas_transf">Notas de Transferencia
	  </label>
	  <div class="controls"> 
	      <textarea name="notas_transf" id="notas_transf"><?php echo($datos[0]["notas_transf"]); ?></textarea>
	  </div>
	</div>	
	
	
	</div>
	</div>	
</div>
<br />
<input type="hidden" name="key_formulario_saia" value="<?php echo(generar_llave_md5_saia());?>">
<input type="hidden"  name="ejecutar_expediente" value="update_expediente"/>
<input type="hidden" name="dependencia_iddependencia" id="dependencia_iddependencia" value="<?php echo $datos[0]["dependencia_iddependencia"]; ?>">
<input type="hidden" name="cod_padre_anterior" id="cod_padre_anterior" value="<?php echo $datos[0]["cod_padre"]; ?>">

<input type="hidden" name="identidad_serie" id="identidad_serie" value="<?php echo $datos[0]["fk_entidad_serie"]; ?>">
<input type="hidden"  name="tipo_retorno" value="1"/>
<div>
<button class="btn btn-primary btn-mini" id="submit_formulario_expediente">Aceptar</button>
<button class="btn btn-mini" id="cancel_formulario_expediente">Cancelar</button>
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
  	//echo librerias_jquery("3.3");
	echo librerias_UI("1.12");
	echo librerias_arboles_ft("2.24", 'filtro');
  ?>
  <script>
  function seleccionar_dependencia(event,data){		  
	  if(data.node.selected){
	  	var iddependencia = data.node.key;
	  	 $("#iddependencia").val(iddependencia);	  	 
         $('#mostrar_serie').show();
	  	var tree = $("#treebox_idserie").fancytree('getTree');

		var newSourceOption = {
		    url: "<?php echo $ruta_db_superior;?>arboles/arbol_expediente_serie.php",
		    type: 'POST',
		    data: {
				otras_categorias: 1,
				serie_sin_asignar: 1,
				carga_partes:1,
				iddependencia:iddependencia,
				checkbox:'radio'				
		    },
		    dataType: 'json'
		};

		tree.reload(newSourceOption).done(function() {
			console.log("cargado");
		});
	  }
  }
  function cargar_info_Node(event,data){  		  
	  if(data.node.selected){
	  	$("#serie_idserie").val(data.node.data.serie_idserie);
	    $("#codigo_numero_serie").val(data.node.data.codigo);
	    $("#dependencia_iddependencia").val(data.node.data.iddependencia);
		$("#codigo_numero_dependencia").val(data.node.data.dependencia_codigo);
		$("#fondo").val(data.node.data.nombre_dependencia);
		$("#identidad_serie").val(data.node.data.identidad_serie);
	  	$("#codigo_numero_serie").trigger('keyup');
	  }else{
	  	$("#codigo_numero_serie").val("");
	  }
  }
  function select_padre(event, data){
  	console.log(data);
  	if(data.node.selected){
  		$("#cod_padre").val(data.node.key);
  	}
  	else
  	{
  		$("#cod_padre").val(0);
  	}
  }

  $(document).ready(function(){
  		$("#iddependencia").val("<?php echo($datos[0]["dependencia_iddependencia"]); ?>");
  		$('#mostrar_serie').hide();
  		var configuracion = {
		   	icon: false,
		   	lazy: true,
	        strings: {
	            loading: "Cargando...",
	            loadError: "Error en la carga!",
	            moreData: "Mas...",
	            noData: "Sin datos."
	        },
	        debugLevel: 4,
	        extensions: ["filter"],
	        //autoScroll: true,
	        quicksearch: true,
	        //keyboard: true,
	        selectMode:1,
	        clickFolderMode:2,
	        source:[{key:0,title:"Sin datos"}],
	        
	       /*source: {
                url: "../../arboles/arbol_expediente_serie.php",
                data: {
					cargar_partes: 1,
					checkbox:'radio',		        
		            iddependencia:"<?php echo $datos[0]["dependencia_iddependencia"];?>",
		        	//seleccionados:"<?php echo $datos[0]["dependencia_iddependencia"].'.'.$datos[0]["serie_idserie"].'.0'; ?>"
                }
            },*/
	        
	        filter: {
	            autoApply: true,
	            autoExpand: true,
	            counter: true,
	            fuzzy: false,
	            hideExpandedCounter: true,
	            hideExpanders: false,
	            highlight: true,
	            leavesOnly: false,
	            nodata: true,
	            mode: "hide"
	        },
	        lazyLoad: function(event, data){
			      var node = data.node;
			      data.result = $.ajax({
			        url: "../../arboles/arbol_expediente_serie.php",
			        data: {
				        cargar_partes: 0,
				        id: node.key,
				        checkbox:'radio',
				        serie_idserie:node.data.serie_idserie,
				        iddependencia:node.data.iddependencia,
				        
				    },
			        cache: true
			      });
			},
	        select: function(event, data) { // Display list of selected nodes
				var seleccionados = Array();
				var items = data.tree.getSelectedNodes();
				for(var i=0;i<items.length;i++){
					seleccionados.push(items[i].key);
				}
				var s = seleccionados.join(",");
				$("#serie_idserie").val(s);
				cargar_info_Node(event,data);
			}
		};
		$("#treebox_idserie").fancytree(configuracion);
  		$("#serie_idserie").val("<?php echo($key); ?>");
		/*url2="arboles/arbol_serie_funcionario.php?tipo1=1&tipo2=1&tipo3=0&tvd=0&checkbox=radio&seleccionados=<?php echo($datos[0]["serie_idserie"]); ?>";
		$.ajax({
			url : "<?php echo($ruta_db_superior);?>arboles/crear_arbol_ft.php",
			data:{xml:url2,campo:"serie_idserie",ruta_db_superior:"../../",busqueda_item:1,onNodeSelect:"cargar_info_Node",selectMode:1},
			type : "POST",
			async:false,
			success : function(html_serie) {
				$("#treeboxbox_tree3").empty().html(html_serie);
				$("#serie_idserie").val("<?php echo($datos[0]["serie_idserie"]); ?>");
			},error: function (){
				top.noty({text: 'No se pudo cargar el arbol de series',type: 'error',layout: 'topCenter',timeout:5000});
			}
		});*/


      
  $(".documento_actual",parent.document).removeClass("alert-info");
  $(".documento_actual",parent.document).removeClass("documento_actual");
  $("#resultado_pantalla_<?php echo(@$_REQUEST["idexpediente"]);?>",parent.document).addClass("documento_actual").addClass("alert-info");        
      
		<?php 
		if($datos[0]['agrupador']){
		?>
			$('#informacion_completa_expediente').hide();
			$('#informacion_completa_expediente').after($('#div_serie_asociada'));
			$('#informacion_completa_expediente').after($('#div_nombre_exp'));
			
		<?php
		}
		?>    
    url3="arboles/arbol_expediente.php?doc=<?php echo($iddoc); ?>&accion=1&permiso_editar=1&checkbox=radio&excluidos=<?php echo($_REQUEST["idexpediente"]); ?>&seleccionado=<?php echo($datos[0]["cod_padre"]); ?>";
		$.ajax({
			url : "<?php echo($ruta_db_superior);?>arboles/crear_arbol_ft.php",
			data:{xml:url3,campo:"cod_padre",ruta_db_superior:"../../",busqueda_item:1,onNodeSelect:"select_padre",selectMode:1},
			type : "POST",
			async:false,
			success : function(html_serie) {
				$("#treeboxbox_tree2").empty().html(html_serie);				
				$("#cod_padre").val("<?php echo($datos[0]["cod_padre"]); ?>");
			},error: function (){
				top.noty({text: 'No se pudo cargar el arbol de padres',type: 'error',layout: 'topCenter',timeout:5000});
			}
		});
  });
  
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
  }
  });
  $("#submit_formulario_expediente").click(function(){  
    if(formulario_expediente.valid()){
    	if($("#cod_padre").val()==""){
    		$("#cod_padre").val(0);
    		console.log($("#cod_padre").val());
    	}
    	var cod_padre = $("#cod_padre_anterior").val();
    	$('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
			$(this).attr('disabled', 'disabled');
			<?php encriptar_sqli("formulario_expediente",0,"form_info",$ruta_db_superior); ?>
      $.ajax({
        type:'POST',
        async:false,
        url: "<?php echo($ruta_db_superior);?>pantallas/expediente/ejecutar_acciones.php",
        data: "rand="+Math.round(Math.random()*100000)+"&"+formulario_expediente.serialize(),
        dataType: 'json',
        success: function(objeto){
            if(objeto.exito){
              $.ajax({
                type:'POST',
                async:false,
                url: "<?php echo($ruta_db_superior);?>pantallas/busquedas/servidor_busqueda.php",
                data: {
                    idbusqueda_componente: "<?php echo($_REQUEST['idbusqueda_componente']); ?>",
                    page: 1,
                    rows: 1,
                    actual_row: 0,
                    expediente_actual: objeto.idexpediente,
                    idexpediente: cod_padre
                },
                dataType: 'json',
                success: function(objeto2){
                	var elemento_padre = $("#<?php echo($_REQUEST['div_actualiza']);?>", parent.document).parent();                	
                	$("#<?php echo($_REQUEST['div_actualiza']);?>", parent.document).remove();
                	if(objeto2.exito){                		
                   		elemento_padre.prepend(objeto2.rows[0].info);
                	}                  
                },error:function (){
				     notificacion_saia("Error al procesar","error","",8500);
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
        },error:function (){
        	notificacion_saia("Error al procesar la solicitud","error","",8500);
        }
    	});
    }
    else{
      notificacion_saia("Formulario con errores","error","",8500);
    }
  });  
});
</script>
<?php
function mostrar_seleccionados_exp($id,$campo="nombre",$tabla){
	global $conn;
	$dato=busca_filtro_tabla($campo,$tabla,"id".$tabla."='".$id."'","",$conn);
	$etiquetas=extrae_campo($dato,$campo,"m");
	return(ucwords(implode(", ",$etiquetas)));
}
?>