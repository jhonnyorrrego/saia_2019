<?php
// Initialize common variables
$x_idactividad_paso = Null;
$x_descripcion = Null;
$x_accion_idaccion = Null;
$x_paso_idpaso= Null;
$x_paso_anterior =Null;
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
$x_formato_anterior=Null;
$x_fk_campos_formato=Null;


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

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("x_idactividad_paso","paso_idpaso","x_accion_idaccion","x_llave_entidad","fk_campos_formato");
desencriptar_sqli('form_info');

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
  $x_paso_anterior = @$_POST["x_paso_anterior"];
  $x_accion_idaccion = @$_POST["x_accion_idaccion"];
  $x_restrictivo = @$_POST["x_restrictivo"];
  $x_estado= @$_POST["x_estado"];
  $x_orden = @$_POST["x_orden"];
  $x_tipo = @$_POST["x_tipo"];
  $x_tipo_entidad = @$_POST["x_tipo_entidad"];
  $x_llave_entidad = @$_POST["x_llave_entidad"];
  $x_plazo = @$_POST["x_plazo"];
  $x_tipo_plazo = @$_POST["x_tipo_plazo"];
  $x_formato_anterior= @$_POST["formato_anterior"];
  $x_fk_campos_formato=@$_POST["fk_campos_formato"];
  
}
LoadData($_REQUEST["idpaso_actividad"], $conn);
switch ($sAction){
  case "E": // Editar
    if (EditData($conn)) { // Add New Record
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
$paso=busca_filtro_tabla("","paso","idpaso=".$x_paso_idpaso,"",$conn);
?>
<p><i class="icon-share-alt"></i><a href="<?php echo($ruta_db_superior);?>bpmn/paso/actividades_paso_admin.php?idpaso=<?php echo($x_paso_idpaso);?>">Regresar</a></p>
<div class="container">
    <div class="control-group" nombre="etiqueta">
      <legend>Editar actividad paso: <?php echo($paso[0]["nombre_paso"]); ?></legend>
    </div>
    <form name="editar_actividad_paso" id="editar_actividad_paso" action="editar_actividades_paso.php" method="post" class="form-horizontal">
      <div class="control-group">
        <label class="control-label" for="descripcion">Descripci&oacute;n*:</label>
        <div class="controls">
          <input type="text" class="required" name="x_descripcion" id="x_descripcion" placeholder="Descripci&oacute;n de la actividad" value="<?php echo($x_descripcion);?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="x_restrictivo">Obligatoria*:</label>
        <div class="controls">
          SI <input type="radio" name="x_restrictivo" id="x_restrictivo" value="1" <?php if($x_restrictivo==1)echo('checked="true"');?> >
          NO <input type="radio" name="x_restrictivo" id="x_restrictivo" value="0" <?php if($x_restrictivo==0)echo('checked="true"');?> >
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="x_tipo">Tipo de actividad*:</label>
        <div class="controls">
          Sistema<i class="icon-cog"></i> <input type="radio" name="x_tipo" class="x_tipo" id="x_sistema" value="1"  <?php if($x_tipo==1)echo('checked="true"');?> >
          Manual<i class="icon-user"></i><input type="radio" name="x_tipo" class="x_tipo" id="x_manual" value="0"  <?php if($x_tipo==0)echo('checked="true"');?> >
          <label class="error" for="x_tipo"></label>
          <?php
          $display_accion='';
          if($x_tipo==0){
            $display_accion=' style="display: none;"';
          }
          ?>
          <div id="select_accion" <?php echo($display_accion);?>>
            <select name="x_accion_idaccion" id="x_accion_idaccion">
              <option value='0'>Seleccionar...</option>
              <?php
              $bloquear_acciones='11,13,4,10,5'; //ACCIONES QUE ESTAN PRESENTANDO FALLAS
              $hidden_adicionar='';
              $accion=busca_filtro_tabla("idaccion,etiqueta,nombre","accion","etiqueta<>'' AND idaccion NOT IN(".$bloquear_acciones.")","lower(etiqueta)",$conn);
              for($i=0;$i<$accion["numcampos"];$i++){
                if($accion[$i]["nombre"]=="adicionar"){
                  //$hidden_adicionar='<input type="hidden" name="accion_adicionar" value="'.$accion[$i]["idaccion"].'">';
                }
                echo "<option value='".$accion[$i]["idaccion"]."' ";
                if($x_accion_idaccion==$accion[$i]["idaccion"]){
                  echo(" selected ");
                }
                echo ">".$accion[$i]["etiqueta"]."</option>";
              }
              ?>
            </select>
             <?php echo($hidden_adicionar);?>
          </div>
          <div id="arbol_accion" <?php echo($display_accion);?>></div>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="x_llave_entidad">Responsable*:</label>
        <div class="controls">
          <!--Entidad 4 es la entidad del cargo-->
          <input type="hidden" name="x_tipo_entidad" id="x_tipo_entidad" value="4" class="required">
          <input type="hidden" name="x_llave_entidad" id="x_llave_entidad" value="<?php echo htmlspecialchars(@$x_llave_entidad) ?>">
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
      
        <div class="control-group" id="contenedor_formatos_anteriores" style="display:none;">
             <label class="control-label" for="x_llave_entidad">Formatos Asociados*:</label>
             <div class="controls">
                <input type="hidden" id="formato_anterior" name="formato_anterior" value="<?php echo($x_formato_anterior); ?>"> 
              <div id="treeboxbox_tree_formatos_anteriores" style="height:auto;"></div><br/>
              
              <div id="listado_campos_formato_anterior"></div>
            <?php
            
                $pasos_anteriores=listado_pasos_anteriores_admin($x_paso_idpaso);
                
                $error="No se encuentran formatos vinculados para realizar validaciones";
                if(count($pasos_anteriores)){
                  
                  $formatos_anteriores=busca_filtro_tabla("","paso_actividad A","A.paso_idpaso IN(".implode(",",$pasos_anteriores).") AND A.formato_idformato IS NOT NULL AND A.formato_idformato<>'' AND A.estado=1","",$conn);
                  if($formatos_anteriores["numcampos"]){
                      
                    $idformato_idpaso_actividad=array();
                    for($i=0;$i<$formatos_anteriores["numcampos"];$i++){
                        $idformato_idpaso_actividad[$formatos_anteriores[$i]['formato_idformato']]=$formatos_anteriores[$i]['idpaso_actividad'];   
                    }                        
                    $campos=extrae_campo($formatos_anteriores,"formato_idformato");
                    $filtrar=implode(",",$campos);
                     $error=0;
                  }
                  else{
                   $error="No se encuentran formatos vinculados para realizar validaciones";
                  } 
                }
               
                if($error){
                    echo('<div class="alert alert-error">'.$error.'</div>');
                }else{
                    ?>
                    <script>
                        $(document).ready(function(){
                            
                            <?php 
                            
                                if($x_formato_anterior && $x_fk_campos_formato && $x_llave_entidad==-2){
                                    ?>
                                     
                                     
                                      
                                      $.ajax({
                                        type:'POST',
                                        url: "../condicional/campos_formato_condicional.php",
                                        data: "idformato=<?php echo($x_formato_anterior); ?>",
                                        success: function(html){   
                                          if(html){
                                            var objeto=jQuery.parseJSON(html);
                                            if(objeto.campos!==''){
                                              $("#listado_campos_formato_anterior").html(objeto.campos);            
                                            }  
                                            else{
                                              noty({text: 'No es posible encontrar campos para el formato seleccionado',type: 'error',layout: "topCenter",timeout:300});
                                            }                         
                                          }
                                          
                                          $('[name="fk_campos_formato"] option[value="<?php echo($x_fk_campos_formato); ?>"]').attr('selected','selected');
                                          $('#contenedor_formatos_anteriores').show();
                                        }
                                      });                                    
                                        
                                    <?php
                                }
                            
                            ?>
                            
                            
                          var browserType;
                          if (document.layers) {browserType = "nn4"}
                          if (document.all) {browserType = "ie"}
                          if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                             browserType= "gecko"
                          }
                          //TODO: Verificar el dato de los arboles para el radio 
                          tree4=new dhtmlXTreeObject("treeboxbox_tree_formatos_anteriores","100%","auto",0);
                          tree4.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
                          tree4.enableIEImageFix(true);
                          //tree3.enableCheckBoxes(1);
                          tree4.enableTreeImages(false);
                          tree4.enableRadioButtons(true);
                          tree4.loadXML("<?php echo($ruta_db_superior);?>test_formatos.php?filtrar=<?php echo($filtrar);?>");
                          tree4.setOnCheckHandler(onNodeSelect_llave_entidad_anteriores);
                          tree4.setOnLoadingEnd(fin_cargando_serie_anteriores);
                          function onNodeSelect_llave_entidad_anteriores(nodeId){
                              
                            if(tree4.isItemChecked(nodeId)){
                              var nodo=nodeId.split("#");
                              var idformato_idpaso_actividad=<?php echo($idformato_idpaso_actividad); ?>;
                              var value_formato_anterior=nodo[0]+'|'+idformato_idpaso_actividad[nodo[0]];
                              $('#formato_anterior').val(value_formato_anterior);
                              
                              
                              $.ajax({
                                type:'POST',
                                url: "../condicional/campos_formato_condicional.php",
                                data: "idformato="+nodo[0],
                                success: function(html){   
                                  if(html){
                                    var objeto=jQuery.parseJSON(html);
                                    if(objeto.campos!==''){
                                      $("#listado_campos_formato_anterior").html(objeto.campos);            
                                    }  
                                    else{
                                      noty({text: 'No es posible encontrar campos para el formato seleccionado',type: 'error',layout: "topCenter",timeout:300});
                                    }                         
                                  }
                                }
                              });
                            }
                            else{
                              $("#listado_campos_formato_anterior").html('');
                              $('#formato_anterior').val('');
                            }
                          }    
                          function fin_cargando_serie_anteriores(){
                              <?php
                                if($x_llave_entidad==-2){
                                    
                                    $formato=busca_filtro_tabla("nombre","formato","idformato=".$x_formato_anterior,"",$conn);
                                    $cadena_seleccionar='';
                                    if($formato['numcampos']){
                                        $cadena_seleccionar=$x_formato_anterior.'#2#'.$formato[0]['nombre'];
                                    }
                                    ?>
                                    tree4.openItem( '<?php echo($cadena_seleccionar); ?>' ); //ARBOL: expande nodo hasta el item indicado
		                            tree4.setCheck( '<?php echo($cadena_seleccionar); ?>',1 ); //ARBOL: check item indicado
                                    <?php
                                }
                              ?>
                          }

                        });
                    </script>
                    <?php
                }
                
            ?>
            </div>
            <br>
           
        </div>
           
      
      
      
      <div class="control-group">
        <label class="control-label" for="x_orden">Orden*:</label>
        <div class="controls">
          <?php
          $orden=busca_filtro_tabla("descripcion,orden","paso_actividad","estado=1 AND paso_idpaso=".$x_paso_idpaso." AND idpaso_actividad<>".$x_idactividad_paso,"orden",$conn);
          ?>
          <select name="x_orden" id="x_orden">
            <option value='0'>Primero en la lista de acciones</option>
            <?php
            for($i=0;$i<$orden["numcampos"];$i++){
              echo "<option value='".$orden[$i]["orden"]."' ";
              if($i==($x_orden-2)){
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
            <option value="hour" <?php if($x_tipo_plazo=='hour') echo('selected');?>>Hora(s)</option>
            <option value="day" <?php if($x_tipo_plazo=='day') echo('selected');?>>D&iacute;a(s)</option>
            <option value="month" <?php if($x_tipo_plazo=='month') echo('selected');?>>Mes(es)</option>
            <option value="year" <?php if($x_tipo_plazo=='year') echo('selected');?>>A&ntilde;o(s)</option>
          </select>   
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <input type='submit' class="btn btn-primary btn-mini" name="submit" id="submit" value="continuar">
          <input type="hidden" name="a_add" value="E">    
          <input type="hidden" name="paso_idpaso" id="paso_idpaso" value="<?php echo(@$x_paso_idpaso);?>">
          <input type="hidden" name="x_idactividad_paso" id="x_idactividad_paso" value="<?php echo(@$x_idactividad_paso);?>">   
        </div>
      </div>
    </form>
  </div>
<script type="text/javascript">
  $(document).ready(function(){
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
        $("#x_llave_accion").val("0");
      }
    });
    $("#x_accion_idaccion").change(function(){
      var accion = $("#x_accion_idaccion").val();
      crear_arbol(accion);
    });
    <?php
      if($x_tipo!=0){
        echo('var accion = $("#x_accion_idaccion").val();
      crear_arbol(accion);');
      }
    ?>
    function crear_arbol(accion){
      $.post('<?php echo($ruta_db_superior);?>bpmn/paso/arboles_accion_paso.php',{idaccion : accion, idpaso_actividad:<?php echo($_REQUEST['idpaso_actividad']);?>, accion : 'radicar',campo : 'x_llave_accion'},function(data){
        ruta_xmlx = '<?php echo($ruta_db_superior); ?>test_formatos.php<?php if($x_tipo)echo("?seleccionados=".$x_llave_accion);?>';
        $("#arbol_accion").html('');
        $("#arbol_accion").html(data);
        $("#arbol_accion").show();
      });
    }  
    $("#editar_actividad_paso").validate({
    	submitHandler: function(form) {
				<?php encriptar_sqli("editar_actividad_paso",0,"form_info",$ruta_db_superior);?>
			    form.submit();
			    
			  }
    });
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
  tree3.loadXML("<?php echo($ruta_db_superior);?>pantallas/cargo/arbol_cargos.php?seleccionado=<?php echo($x_llave_entidad);?>");
  tree3.setOnCheckHandler(onNodeSelect_llave_entidad);
  function onNodeSelect_llave_entidad(nodeId){
    var valor_llave=document.getElementById("x_llave_entidad");
    
    var tipo_actividad=$('[name="x_tipo"]').val();
    var tipo_accion=$('[name="x_accion_idaccion"]').val();
    
    if(tipo_actividad==1 && ( tipo_accion==3 || tipo_accion==7 ) && nodeId==-2){
        $('#contenedor_formatos_anteriores').show();
    }else{
        $('#contenedor_formatos_anteriores').hide();
        $("#listado_campos_formato_anterior").html('');
        $('#formato_anterior').val('');        
    }    
    
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
    
    
    <?php 
        if($x_llave_entidad==-1){
            ?>
            tree3.openItem( <?php echo($x_llave_entidad); ?> ); //ARBOL: expande nodo hasta el item indicado
		    tree3.setCheck( <?php echo($x_llave_entidad); ?>,1 ); //ARBOL: check item indicado
            <?php
        } 
        if($x_llave_entidad==-2){
            ?>
            tree3.openItem( <?php echo($x_llave_entidad); ?> ); //ARBOL: expande nodo hasta el item indicado
		    tree3.setCheck( <?php echo($x_llave_entidad); ?>,1 ); //ARBOL: check item indicado
            <?php            
        }        
    
    
    ?>
    
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
$x_estado ,$x_orden , $x_tipo, $x_tipo_entidad, $x_llave_entidad, $x_plazo, $x_tipo_plazo,$x_modulo,$x_llave_accion, $x_paso_anterior,$x_formato_anterior,$x_fk_campos_formato; 
$datos=busca_filtro_tabla("","paso_actividad","estado=1 AND idpaso_actividad=".$sKey,"",$conn);
if($datos["numcampos"]){
  $LoadData=true;
  $x_idactividad_paso = $datos[0]["idpaso_actividad"];
  $x_descripcion = $datos[0]["descripcion"];
  $x_accion_idaccion = $datos[0]["accion_idaccion"];
  $x_paso_idpaso= $datos[0]["paso_idpaso"];
  $x_paso_anterior= $datos[0]["paso_anterior"];
  $x_restrictivo = $datos[0]["restrictivo"];
  $x_estado= $datos[0]["estado"];
  $x_orden = $datos[0]["orden"];
  $x_tipo = $datos[0]["tipo"];
  $x_tipo_entidad = $datos[0]["entidad_identidad"];
  $x_llave_entidad = $datos[0]["llave_entidad"];
  $x_plazo = $datos[0]["plazo"];
  $x_tipo_plazo = $datos[0]["tipo_plazo"];
  $x_llave_accion = $datos[0]["formato_idformato"];
  $x_formato_anterior=$datos[0]["formato_anterior"];
  $x_fk_campos_formato=$datos[0]["fk_campos_formato"];
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
function EditData($conn){
global $x_idactividad_paso,$x_descripcion, $x_accion_idaccion, $x_paso_idpaso, $x_restrictivo, 
$x_estado ,$x_orden , $x_tipo, $x_tipo_entidad, $x_llave_entidad, $x_plazo, $x_tipo_plazo, $x_modulo,$x_llave_accion,$x_paso_anterior,$x_formato_anterior,$x_fk_campos_formato; 

  $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_descripcion) : $x_descripcion; 
  $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
  $fieldList["descripcion"] = $theValue;
  
  // Field paso
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
  else {
    $fielList["formato_idformato"]="";
  }
  // Field nombre
  $theValue = ($x_restrictivo != "") ? $x_restrictivo : 1;
  $fieldList["restrictivo"] = $theValue;
  // Field nombre
  $theValue = ($x_estado != "") ? $x_estado : 1;
  $fieldList["estado"] = $theValue; // Field nombre
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
  // insert into database
  //TODO: Accion de adicionar se debe realizar la busqueda en la base de datos y verificar que el orden este bien
  if($fieldList["accion_idaccion"]==1){
    $fieldList["orden"]=0;
  }
 
  $theValue = ($x_formato_anterior!= "") ? $x_formato_anterior : 0;
  $fieldList["formato_anterior"]="'".$theValue."'";
  $theValue = ($x_fk_campos_formato!= "") ? $x_fk_campos_formato : 0;
  $fieldList["fk_campos_formato"]=$theValue;  
  
  $strsql='UPDATE paso_actividad SET ';
  $arreglo=array();
  foreach ($fieldList as $key => $value) {
    array_push($arreglo,$key."=".$value);
  }
  $strsql.=implode(",",$arreglo);
  $strsql.=' WHERE idpaso_actividad='.$x_idactividad_paso;
  
  
  phpmkr_query($strsql, $conn) or die("Fall&oacute; la b&uacute;squeda" . phpmkr_error() . ' SQL:' . $strsql);
  return true;
}
?>