<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
$idaccion = $_REQUEST["idaccion"];
accion_responder();
/*
 * Funcion que muestra el arbol de formatos sobre el adicionar y editar de una actividad.
 * El arbol sale cuando se selecciona sobre el campo "ACCION INTERNA DEL SISTEMA" alguna de las acciones que estan registradas en funciones_paso_accion,funciones_paso en este caso, sobre las acciones adicionar y responder.
 */
function accion_responder(){
  global $ruta_db_superior,$formatos;
  $entidad = $_REQUEST["accion"];
  $campo = $_REQUEST["campo"];
	
	$paso_anterior=False;
	if(isset($_REQUEST["idpaso_actividad"])){
		$actividad_info=busca_filtro_tabla("paso_anterior","paso_actividad a","a.estado=1 AND a.idpaso_actividad=".$_REQUEST["idpaso_actividad"],"",$conn);
		$paso_anterior=$actividad_info[0]["paso_anterior"];
	}
	
  $dato_accion=busca_filtro_tabla("","accion","nombre ='adicionar' AND idaccion=".$_REQUEST["idaccion"],"",$conn);
  if($dato_accion["numcampos"]){
    if(isset($_REQUEST["idpaso_actividad"])){
      $seleccionados = seleccionados($_REQUEST["idpaso_actividad"],$_REQUEST["idaccion"]);
		}
    ?>
    <div ><?php echo $seleccionados; ?></div>
    <br>
    Buscar: <input type="text" id="stext<?php echo $entidad; ?>" width="200px" size="25">
  <a href="javascript:void(0)" onclick="stext<?php echo $entidad; ?>.findItem((document.getElementById('stext<?php echo $entidad; ?>').value),1)"> 
  <img src="<?php echo($ruta_db_superior);?>botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a>
  <a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem((document.getElementById('stext<?php echo $entidad; ?>').value),0,1)">
  <img src="<?php echo($ruta_db_superior);?>botones/general/buscar.png" alt="Buscar" border="0px"></a>
  <a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem((document.getElementById('stext<?php echo $entidad; ?>').value))">
  <img src="<?php echo($ruta_db_superior);?>botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
  
  <div id="esperando<?php echo $entidad; ?>"><img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif"></div>
  <div id="treeboxbox<?php echo $entidad; ?>" width="100px" height="100px"></div>
  <input type="hidden" class="required" name="<?php echo $campo; ?>" id="<?php echo $campo; ?>">
  <script type="text/javascript">
        var browserType;
        if (document.layers) {browserType = "nn4"}
        if (document.all) {browserType = "ie"}
        if (window.navigator.userAgent.toLowerCase().match("gecko")) {
           browserType= "gecko"
        }
        tree<?php echo $entidad; ?>=new dhtmlXTreeObject("treeboxbox<?php echo $entidad; ?>","100%","auto",0);
        tree<?php echo $entidad; ?>.enableTreeImages(false);;
        tree<?php echo $entidad; ?>.setImagePath("<?php echo($ruta_db_superior); ?>imgs/");
        tree<?php echo $entidad; ?>.enableIEImageFix(true);
        tree<?php echo $entidad; ?>.setOnLoadingStart(cargando<?php echo $entidad; ?>);
        tree<?php echo $entidad; ?>.setOnLoadingEnd(fin_cargando<?php echo $entidad; ?>);
        tree<?php echo $entidad; ?>.enableCheckBoxes(1);
        tree<?php echo $entidad; ?>.enableRadioButtons(true);
        <?php if($entidad==1 || $entidad==2){?>
        tree<?php echo $entidad; ?>.enableThreeStateCheckboxes(true);
        <?php }?>
        tree<?php echo $entidad; ?>.loadXML(ruta_xmlx);
        tree<?php echo $entidad; ?>.setOnCheckHandler(onNodeSelect<?php echo $entidad; ?>);
        function onNodeSelect<?php echo $entidad; ?>(nodeId){
          var valores=tree<?php echo $entidad; ?>.getAllChecked();
          valor_destino=document.getElementById("<?php echo $campo; ?>");
          if(tree<?php echo $entidad; ?>.isItemChecked(nodeId)){
            if(valor_destino.value!=="")
              tree<?php echo $entidad; ?>.setCheck(valor_destino.value,false);
            if(nodeId.indexOf("_")!=-1)
              nodeId=nodeId.substr(0,nodeId.length);
            valor_destino.value=nodeId;
          }
          else{
            valor_destino.value="";
          }
          document.getElementById("<?php echo $campo; ?>").value=tree<?php echo $entidad; ?>.getAllChecked();
        }
        function fin_cargando<?php echo $entidad; ?>() {
        if (browserType == "gecko" )
           document.poppedLayer =
           eval('document.getElementById("esperando<?php echo $entidad; ?>")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando<?php echo $entidad; ?>")');
        else
           document.poppedLayer =
              eval('document.layers["esperando<?php echo $entidad; ?>"]');
        document.poppedLayer.style.display = "none";
        document.getElementById('<?php echo $campo; ?>').value=tree<?php echo $entidad; ?>.getAllChecked();
      }
      function cargando<?php echo $entidad; ?>() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando<?php echo $entidad; ?>")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando<?php echo $entidad; ?>")');
        else
           document.poppedLayer =
               eval('document.layers["esperando<?php echo $entidad; ?>"]');
        document.poppedLayer.style.display = "";
      }
                      
        --></script>
          <?php 
          }
            //las acciones 1-adicionar, 3-aprobar y 7- confirmar 
            $accion_paso_anterior=array(1,3,7);
						if(in_array(@$_REQUEST["idaccion"],$accion_paso_anterior)){
	            echo("<br/><div id=\"vinculado_paso_anterior\">Vinculado con paso anterior*:<br>");
	            $paso=busca_filtro_tabla("","paso_actividad","estado=1 AND idpaso_actividad=".$_REQUEST["idpaso_actividad"],"",$conn);
	            if(!$paso["numcampos"]){
	              $paso=busca_filtro_tabla("","paso","idpaso=".$_REQUEST["idpaso"],"",$conn);
	              if($paso["numcampos"]){
	                $paso[0]["paso_idpaso"]=$paso[0]["idpaso"];
	              }
	            }
	            $pasos_ant=listado_pasos_anteriores_admin($paso[0]["paso_idpaso"]);
	            $texto='<select name="x_paso_anterior" id="x_paso_anterior" class="required">';
	            $texto.='<option value="0">Ninguno</option>';
	            $pasos_anteriores=busca_filtro_tabla("","paso A","idpaso IN(".implode(",",$pasos_ant).")","",$conn);
	            for($i=0;$i<$pasos_anteriores["numcampos"];$i++){
	              $texto.='<option value="'.$pasos_anteriores[$i]["idpaso"].'"';
	              if($pasos_anteriores[$i]["idpaso"]==$pasos_ant[0] && !$paso_anterior){
	                $texto.=' selected';  
	              }
								else if($pasos_anteriores[$i]["idpaso"]==$paso_anterior){
	              	$texto.=' selected';
	              }
	              $texto.='>'.$pasos_anteriores[$i]["nombre_paso"].'</option>';
	            }
	            $texto.='</select></div>';
	            echo($texto);
            }
          ?>
  <?php
  
}
/*
 * Encargado de parsear una cadena con los formatos ya seleccionados. Para que en el arbol ya salgan chequeados.
 */
function seleccionados($idpaso_actividad,$accion){
  $sel = busca_filtro_tabla("","paso_actividad","estado=1 AND idpaso_actividad=".$idpaso_actividad." and accion_idaccion=".$accion,"",$conn);
  
  $seleccionado = explode(",",$sel[0]["formato_idformato"]);
  $cantidad = count($seleccionado);
  
  $retorno = '';
  for($i=0;$i<$cantidad;$i++){
    $formato = busca_filtro_tabla("","formato","idformato=".$seleccionado[$i],"",$conn);
    $retorno .= $formato[0]["etiqueta"];
    if(($cantidad-1) > $i)
      $retorno .= ', ';
    
    $retorno .= '<br>';
  }
  return $retorno;
}
?>