<?php
// Initialize common variables
$x_idactividad_paso = Null;
$x_descripcion = Null;
$x_accion_idaccion = Null;
$x_paso_idpaso= Null;
$x_paso_anterior=Null;
$x_restrictivo = Null;
$x_estado= Null;
$x_orden = Null;
$x_tipo = Null;
$x_tipo_entidad = Null;
$x_llave_entidad = Null;
$x_plazo = 24;
$x_tipo_plazo= Null;
$x_modulo = Null;
$x_llave_accion = Null;
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include ($ruta_db_superior."workflow/libreria_paso.php");
include ($ruta_db_superior."formatos/librerias/estilo_formulario.php");
echo(estilo_bootstrap());
// Get action
$sAction = @$_POST["a_add"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey <> "") {
		$sAction = "C"; // Copy record
	}
	else{
		$sAction = "I"; // Display blank record
	}
}
else{
	// Get fields from form
  $x_idactividad_paso = @$_POST["x_idactividad_paso"];
  $x_descripcion = @$_POST["x_descripcion"];
  $x_paso_idpaso = @$_POST["paso_idpaso"];
  $x_paso_anterior = @$_POST["paso_anterior"];
  $x_accion_idaccion = @$_POST["x_accion_idaccion"];
  $x_restrictivo = @$_POST["x_restrictivo"];
  $x_estado= @$_POST["x_estado"];
  $x_orden = @$_POST["x_orden"];
  $x_tipo = @$_POST["x_tipo"];
  $x_tipo_entidad = @$_POST["x_tipo_entidad"];
  $x_llave_entidad = @$_POST["x_llave_entidad"];
  $x_plazo = @$_POST["x_plazo"];
  $x_tipo_plazo = @$_POST["x_tipo_plazo"];
  $x_modulo = @$_POST["x_modulo"];
  $x_llave_accion = @$_POST["x_llave_accion"];
  $x_paso_anterior = @$_POST["x_paso_anterior"];
}
switch ($sAction){
	case "A": // Add
		if (AddData($conn)) { // Add New Record
      calcular_plazo_paso($x_paso_idpaso);
      reasignar_orden_actividades_paso($x_paso_idpaso);
			redirecciona($ruta_db_superior."bpmn/paso/actividades_paso_admin.php?idpaso=".$x_paso_idpaso);
			exit();
		}
		break;
}
echo(librerias_jquery("1.7"));
echo(librerias_validar_formulario(11));
echo(librerias_arboles());
echo(librerias_notificaciones());
$paso=busca_filtro_tabla("","paso","idpaso=".$_REQUEST["idpaso"],"",$conn);
?>
<p><i class="icon-share-alt"></i><a href="<?php echo($ruta_db_superior);?>bpmn/paso/actividades_paso_admin.php?idpaso=<?php echo($_REQUEST["idpaso"]);?>">Regresar</a></p>
<div class="container">
		<div class="control-group" nombre="etiqueta">
			<legend>Adicionar actividad paso: <?php echo($paso[0]["nombre_paso"]); ?></legend>
		</div>
		<form name="adicionar_actividad_paso" id="adicionar_actividad_paso" action="adicionar_actividades_paso.php" method="post" class="form-horizontal">
			<div class="control-group">
				<label class="control-label" for="descripcion">Descripci&oacute;n*:</label>
				<div class="controls">
					<input type="text" class="required" name="x_descripcion" id="x_descripcion" placeholder="Descripci&oacute;n de la actividad">
				</div>
			</div>
      <div class="control-group">
				<label class="control-label" for="x_restrictivo">Obligatoria*:</label>
				<div class="controls">
				  SI <input type="radio" name="x_restrictivo" id="x_restrictivo" value="1" checked="true">
          NO <input type="radio" name="x_restrictivo" id="x_restrictivo" value="0">
				</div>
			</div>
      <div class="control-group">
				<label class="control-label" for="x_tipo">Tipo de actividad*:</label>
				<div class="controls">
				  Sistema<i class="icon-cog"></i> <input type="radio" name="x_tipo" class="x_tipo" id="x_sistema" value="1">
          Manual<i class="icon-user"></i><input type="radio" name="x_tipo" class="x_tipo" id="x_manual" value="0" checked="true">
					<label class="error" for="x_tipo"></label>
					<div id="select_accion" style="display: none;">
            <select name="x_accion_idaccion" id="x_accion_idaccion">
              <option value='0'>Seleccionar...</option>
              <?php
              $bloquear_acciones='11,13,4,10,5'; //ACCIONES QUE ESTAN PRESENTANDO FALLAS  
              
              $hidden_adicionar='';
              $accion=busca_filtro_tabla("idaccion,etiqueta,nombre","accion","etiqueta<>'' AND idaccion NOT IN(".$bloquear_acciones.")","lower(etiqueta)",$conn);
              for($i=0;$i<$accion["numcampos"];$i++){
              		 echo "<option value='".$accion[$i]["idaccion"]."' >".$accion[$i]["etiqueta"]."</option>";
                if($accion[$i]["nombre"]=="adicionar"){
                  //$hidden_adicionar='<input type="hidden" name="accion_adicionar" value="'.$accion[$i]["idaccion"].'">';
                }
              }  
              ?>
            </select>
            <?php echo($hidden_adicionar);?>
          </div>
					<div id="arbol_accion" style="display:none;"></div>
				</div>
			</div>
			<div class="control-group">
        <label class="control-label" for="x_llave_entidad">Responsable*:</label>
        <div class="controls">
          <!--Entidad 4 es la entidad del cargo-->
          <input type="hidden" name="x_tipo_entidad" id="x_tipo_entidad" value="4" class="required">
          <input type="hidden" name="x_llave_entidad" id="x_llave_entidad" class="required" >
            Buscar:<br><input type="text" id="stext_3" width="200px" size="20">     
            <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,1)">
            <img src="<?php echo($ruta_db_superior);?>botones/general/anterior.png" border="0px" alt="Anterior"></a>
            <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,0,1)">
            <img src="<?php echo($ruta_db_superior);?>botones/general/buscar.png" border="0px" alt="Buscar"></a>
            <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value)">
            <img src="<?php echo($ruta_db_superior);?>botones/general/siguiente.png" border="0px" alt="Siguiente"></a> 
            <br /><div id="esperando_serie">
            <img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif"></div>
            <div id="treeboxbox_tree3" style="height:auto;"></div>
        </div>
      </div>
      <div class="control-group">
				<label class="control-label" for="x_orden">Orden*:</label>
				<div class="controls">
          <select name="x_orden" id="x_orden">
            <option value='0'>Primero en la lista de acciones</option>
            <?php
              $orden=busca_filtro_tabla("descripcion,orden","paso_actividad","estado=1 AND paso_idpaso=".$_REQUEST["idpaso"],"orden",$conn);
            for($i=0;$i<$orden["numcampos"];$i++){
              echo "<option value='".$orden[$i]["orden"]."' ";
              if($i==($orden["numcampos"]-1)){
                echo(" selected ");
              }
              echo(">Posterior a ".delimita($orden[$i]["descripcion"],50)."</option>");
            }  
            ?>
          </select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="x_orden">Tiempo de actividad*:</label>
				<div class="controls">
          <input type="text" name="x_plazo" id="x_plazo" size="10" maxlength="255" value="<?php echo htmlspecialchars(@$x_plazo) ?>" style="width:25;"> 
          <select name="x_tipo_plazo" id="x_tipo_plazo">
            <!--option name="minuto" value="minute">Minuto(s)</option-->
            <option value="hour" selected>Hora(s)</option>
            <option value="day">D&iacute;a(s)</option>
            <option value="month">Mes(es)</option>
            <option value="year">A&ntilde;o(s)</option>
          </select>   
      	</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<input type='submit' class="btn btn-primary btn-mini" name="submit" id="submit" value="continuar">
          <input type="hidden" name="a_add" value="A">    
          <input type="hidden" name="paso_idpaso" id="paso_idpaso" value="<?php echo(@$_REQUEST["idpaso"]);?>">   
				</div>
			</div>
		</form>
	</div>
	<script>
		$(document).ready(function(){
			
			$('#submit').click(function(){
				
				var tipo=$('[name="x_tipo"]').val();
				var accion=$('[name="x_accion_idaccion"]').val();
				var user=$('[name="x_llave_entidad"]').val();
				
				if(tipo==1){
					if(accion==7 || accion==3){
						if(user==-1){
							notificacion_saia('<b>ATENCI&Oacute;N!</b><br>Debe seleccionar un responsable fijo','error','',4000);
							return false;
						}
					}
				}
				if(accion==3 || accion==5 || accion==7){
					return validar_adicionar_actividades_anteriores();
				}
				
			}); 
			
			function validar_adicionar_actividades_anteriores(){
				var accion=$('[name="x_accion_idaccion"]').val();
				var retornar=true;
				if(accion==3 || accion==5 || accion==7){ //confirmar - editar - aprobar
					$.ajax({
		            	type:'POST',
		                dataType: 'json',
		                url: "<?php echo($ruta_db_superior); ?>bpmn/paso/ejecutar_acciones.php",
		                async:false,
		                data: {
		                	idpaso:'<?php echo(@$_REQUEST['idpaso']); ?>',
		                	ejecutar_accion:3
		                },
		                success: function(datos){
		                	if(datos.exito==0){
		                		notificacion_saia('<span style="color:white;"><b>ATENCI&Oacute;N!</b><br>Debe existir el adicionar de un formato antes de realizar esta actividad</span>','error','',4000);
		                		retornar=false;
		                	}
		                	
		                }
		        	}); 
	        	}					
				return retornar;
			}				
			
		});
		
	</script>
<script type="text/javascript">
  $(document).ready(function(){
  	
  	
  	$("#adicionar_actividad_paso").validate();
	
  	

  	
    $(".x_tipo").change(function(){
      var tipo=$(this).val();
      if(tipo==="1"){
        $("#select_accion").css("display","block");
        $("#arbol_accion").css("display","block");
      }
      else{
        $("#select_accion").css("display","none");
        $("#arbol_accion").css("display","none");
        $("#x_accion_idaccion").val("0");
      }
    });
    $("#x_accion_idaccion").change(function(){
      var accion = $("#x_accion_idaccion").val();
      crear_arbol(accion);
    });
    function crear_arbol(accion){
      $.post('<?php echo($ruta_db_superior);?>bpmn/paso/arboles_accion_paso.php',{idaccion : accion,accion : 'radicar',campo : 'x_llave_accion', 'idpaso':<?php echo($_REQUEST["idpaso"]); ?>},function(data){
        ruta_xmlx = '<?php echo($ruta_db_superior); ?>test_formatos.php';
        $("#arbol_accion").html('');
        $("#arbol_accion").html(data);
        $("#arbol_accion").show();
      });
    }  
    
  });
  var browserType;
  if (document.layers) {browserType = "nn4"}
  if (document.all) {browserType = "ie"}
  if (window.navigator.userAgent.toLowerCase().match("gecko")) {
     browserType= "gecko"
  }
  tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","auto",0);
  tree3.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
  tree3.enableIEImageFix(true);
  //tree3.enableCheckBoxes(1);
  tree3.enableTreeImages(false);
  tree3.enableRadioButtons(true);
  tree3.setOnLoadingStart(cargando_serie);
  tree3.setOnLoadingEnd(fin_cargando_serie);
  tree3.loadXML("<?php echo($ruta_db_superior);?>pantallas/cargo/arbol_cargos.php");
  tree3.setOnCheckHandler(onNodeSelect_llave_entidad);
  function onNodeSelect_llave_entidad(nodeId){
    var valor_llave=document.getElementById("x_llave_entidad");
    if(tree3.isItemChecked(nodeId)){
        if(valor_llave.value!=="")
            tree3.setCheck(valor_llave.value,false);
        if(nodeId.indexOf("_")!=-1)
            nodeId=nodeId.substr(0,nodeId.indexOf("_"));
        valor_llave.value=nodeId;
    }
    else{
        valor_llave.value="";
    }
  }
  function fin_cargando_serie() {
    if (browserType == "gecko" )
       document.poppedLayer =eval('document.getElementById("esperando_serie")');
    else if (browserType == "ie")
       document.poppedLayer =eval('document.getElementById("esperando_serie")');
    else
       document.poppedLayer =eval('document.layers["esperando_serie"]');
    document.poppedLayer.style.visibility = "hidden";
  }
  function cargando_serie() {
    if (browserType == "gecko" )
       document.poppedLayer =eval('document.getElementById("esperando_serie")');
    else if (browserType == "ie")
       document.poppedLayer =eval('document.getElementById("esperando_serie")');
    else
       document.poppedLayer =eval('document.layers["esperando_serie"]');
    document.poppedLayer.style.visibility = "visible";
  }
</script>
<?php
/*
<Clase>
<Nombre>LoadData
<Parametros>sKey-id del cargo a buscar;conn-objeto de conexion con la base de datos
<Responsabilidades>Verificar si un cargo existe o no en la bd
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function LoadData($sKey,$conn){
global $x_idactividad_paso,$x_descripcion, $x_accion_idaccion, $x_paso_idpaso, $x_restrictivo, 
$x_estado ,$x_orden , $x_tipo, $x_tipo_entidad, $x_llave_entidad, $x_palzo, $x_tipo_plazo,$x_modulo,$x_llave_accion, $x_paso_anterior; 
$datos=busca_filtro_tabla("","paso_actividad","idpaso_actividad=".$sKey,"",$conn);
if($datos["numcampos"]){
  $LoadData=true;
  $x_idactividad_paso = $datos[0]["idpaso_actividad"];
  $x_descripcion = $datos[0]["descripcion"];
  $x_accion_idaccion = $datos[0]["accion_idaccion"];
  $x_paso_idpaso= $datos[0]["paso_idpaso"];
  $x_restrictivo = $datos[0]["restrictivo"];
  $x_estado= $datos[0]["estado"];
  $x_orden = $datos[0]["orden"];
  $x_tipo = $datos[0]["tipo"];
  $x_tipo_entidad = $datos[0]["entidad_identidad"];
  $x_llave_entidad = $datos[0]["llave_entidad"];
  $x_plazo = $datos[0]["plazo"];
  $x_tipo_plazo = $datos[0]["tipo_plazo"];
  $x_llave_accion = $datos[0]["x_llave_accion"];
  $x_paso_anterior = $datos[0]["paso_anterior"];
  //$x_modulo =$datos[0]["modulo_idmodulo"]; 
}
else{
  $LoadData=false;
}
	return $LoadData;
}
?>
<?php

/*

<Clase>
<Nombre>AddData
<Parametros>$conn-objeto de conexion con la base de datos
<Responsabilidades>insertar los datos de un cargo nuevo en la base de datos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function AddData($conn){
global $x_idactividad_paso,$x_descripcion, $x_accion_idaccion, $x_paso_idpaso, $x_restrictivo, 
$x_estado ,$x_orden , $x_tipo, $x_tipo_entidad, $x_llave_entidad, $x_plazo, $x_tipo_plazo, $x_modulo,$x_llave_accion, $x_paso_anterior; 

	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_descripcion) : $x_descripcion; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["descripcion"] = $theValue;
	// Field paso
	$theValue = ($x_paso_idpaso != "") ? $x_paso_idpaso : "NULL";
	$fieldList["paso_idpaso"] = $theValue;
  $theValue = ($x_paso_anterior != "") ? $x_paso_anterior : "NULL";
  $fieldList["paso_anterior"] = $theValue;
	// Field nombre
	$theValue = ($x_accion_idaccion!= "") ? $x_accion_idaccion : "NULL";
	$fieldList["accion_idaccion"] = $theValue;
	// Field llave accion
  if(@$x_tipo==1 && @$x_llave_accion && strpos($x_llave_accion,"#")!==false){
    $llave_temp=explode("#",$x_llave_accion);
    $x_llave_accion=$llave_temp[0];
    $fieldList["formato_idformato"]="'".$x_llave_accion."'";
  }
	// Field nombre
	$theValue = ($x_restrictivo != "") ? $x_restrictivo : 1;
	$fieldList["restrictivo"] = $theValue;
	// Field nombre
	$theValue = ($x_estado != "") ? $x_estado : 1;
	$fieldList["estado"] = $theValue;	// Field nombre
	// Field nombre
	$theValue = ($x_orden!= "") ? $x_orden : 0;
	$fieldList["orden"] = $theValue;
	// Field nombre
	$theValue = ($x_tipo!= "") ? $x_tipo : 1;
	$fieldList["tipo"] = $theValue;
	// Field nombre
	$theValue = ($x_tipo_entidad!= "") ? $x_tipo_entidad : 4;
	$fieldList["entidad_identidad"] = $theValue;
	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_llave_entidad) : $x_llave_entidad; 
	$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
	$fieldList["llave_entidad"] = $theValue;
    // Field nombre
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_plazo) : $x_plazo; 
    $fieldList["plazo"] = $theValue;
    // Field nombre
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_tipo_plazo) : $x_tipo_plazo; 
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["tipo_plazo"] = $theValue;
  //TODO: Accion de adicionar se debe realizar la busqueda en la base de datos y verificar que el orden este bien
  if($fieldList["accion_idaccion"]==1){
    $fieldList["orden"]=0;
  }  
	// insert into database
	$strsql = "INSERT INTO paso_actividad(";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	phpmkr_query($strsql, $conn) or die("Fall&oacute; la b&uacute;squeda" . phpmkr_error() . ' SQL:' . $strsql);
	return true;
}
?>