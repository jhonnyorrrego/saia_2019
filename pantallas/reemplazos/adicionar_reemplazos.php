<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
echo (librerias_bootstrap());
echo (librerias_datepicker_bootstrap());

if(@$_REQUEST["adicionar"]==1){
  $idreemplazo=adicionar_reemplazo();
  if($idreemplazo){
    redirecciona($ruta_db_superior."pantallas/busquedas/consulta_busqueda.php?idbusqueda_componente=".$_REQUEST["idbusqueda_componente"]);
  }else{
    alerta("<b>ATENCI&Oacute;N</b><br>Error al insertar el reemplazo");
  }
}
?>
<style>
.standartTreeImage + td{width:0px;}
</style>
<center><b>REEMPLAZO DE FUNCIONARIOS</b></center><br>
<form name="formulario_reemplazo" id="formulario_reemplazo" method="post" action="#">
    <table class="table table-bordered" style="width:80%;" align="center">
        <tr>
            <td class="encabezado">Tipo de reemplazo*</td>
            <td>
              <div class="controls">
                <label class="radio inline" for="tipo_reemplazo_0">
                  <input type="radio" name="tipo_reemplazo" id="tipo_reemplazo_0" value="1" checked>Temporal</label><label class="radio inline" for="tipo_reemplazo_1">
                  <input type="radio" name="tipo_reemplazo" id="tipo_reemplazo_1" value="2">Definitivo</label>
              </div>
            </td>
        </tr>
        <tr >
            <td class="encabezado">Funcionario actual*</td>
            <td>
                Buscar:
                <input type="text" id="stext_antiguo">
                <a href="javascript:void(0)" onclick="tree_antiguo.openAllItems(0);find_item_tree((document.getElementById('stext_antiguo').value),'antiguo');">
                    <img src="<?php echo($ruta_db_superior);?>botones/general/buscar.png"></a><br />
                <div id="esperando_antiguo">
                    <img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif">
                </div>
                <div id="treeboxbox_antiguo" class="arbol_saia"> </div>
                <input type="hidden" maxlenght="11"  class="required"  name="antiguo" id="antiguo"   value="" >
                <label style="display:none" class="error" for="antiguo">Campo obligatorio.</label>
            </td>
        </tr>
        <tr>
            <td class="encabezado">Funcionario de reemplazo*</td>
            <td>
               Buscar:
                <input type="text" id="stext_nuevo">
                <a href="javascript:void(0)" onclick="tree_nuevo.openAllItems(0);find_item_tree((document.getElementById('stext_nuevo').value),'nuevo');">
                    <img src="<?php echo($ruta_db_superior);?>botones/general/buscar.png"></a>
                <div id="esperando_nuevo">
                    <img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif">
                </div>
                <div id="treeboxbox_nuevo" class="arbol_saia"> </div>
                <input type="hidden" maxlenght="11"  class="required"  name="nuevo" id="nuevo"   value="" >
                <label style="display:none" class="error" for="nuevo">Campo obligatorio.</label>
            </td>
        </tr>
        <tr>
            <td class="encabezado">Fecha de inicio del reemplazo*</td>
            <td>
              <div id="fecha_inicio_label" class="input-append date">
          			<input data-format="yyyy-MM-dd" type="text" id="fecha_inicio" name="fecha_inicio" readonly="true" class="required" value="<?php echo(date('Y-m-d'));?>">
          			<span class="add-on">
          				<i data-time-icon="icon-time" data-date-icon="icon-calendar">
          				</i>
          			</span>
          		</div>
            </td>
        </tr>
        <tr id="fila_fecha_fin">
            <td class="encabezado">Fecha de fin del reemplazo*</td>
            <td>
              <div id="fecha_fin_label" class="input-append date">
          			<input data-format="yyyy-MM-dd" type="text"  id="fecha_fin" name="fecha_fin" readonly="true" class="required">
          			<span class="add-on">
          				<i data-time-icon="icon-time" data-date-icon="icon-calendar">
          				</i>
          			</span>
          		</div>
            </td>
        </tr>
        <tr>
            <td class="encabezado">Observaciones del reemplazo*</td>
            <td>
              <textarea name="observaciones" id="observaciones" class="required"></textarea>
            </td>
        </tr>
        <tr >
        	<td colspan="2" align="center" >
        		<input type="hidden" name="adicionar" value="1">
    				<input type="hidden" name="idbusqueda_componente" value="<?php echo $_REQUEST['idbusqueda_componente']; ?>">
        		<input type="submit" name="submit_formulario_reemplazo" id="submit_formulario_reemplazo" value="Continuar" >
        	</td>
        </tr>
    </table>
</form>
<script type="text/javascript">
$(document).ready(function(){
 $('#fecha_fin_label').datetimepicker({
      language: 'es',
      pick12HourFormat: true,
      pickTime: false
  });
  $('#fecha_inicio_label').datetimepicker({
      language: 'es',
      pick12HourFormat: true,
      pickTime: false
  });
  var browserType;
  if (document.layers) {
      browserType = "nn4"
  }
  if (document.all) {
      browserType = "ie"
  }
  if (window.navigator.userAgent.toLowerCase().match("gecko")) {
      browserType = "gecko"
  }
  tree_antiguo = new dhtmlXTreeObject("treeboxbox_antiguo", "100%", "100%", 0);
  tree_antiguo.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
  tree_antiguo.enableIEImageFix(true);
  tree_antiguo.enableCheckBoxes(1);
  tree_antiguo.enableRadioButtons(true);
  tree_antiguo.setOnLoadingStart(cargando_antiguo);
  tree_antiguo.setOnLoadingEnd(fin_cargando_antiguo);
  tree_antiguo.enableSmartXMLParsing(true);
  tree_antiguo.loadXML("<?php echo($ruta_db_superior);?>test.php?sin_padre=1");
  tree_antiguo.setOnCheckHandler(onNodeSelect_antiguo);
  function onNodeSelect_antiguo(nodeId)
  {
      valor_destino = document.getElementById("antiguo");

      if (tree_antiguo.isItemChecked(nodeId))
      {
          if (valor_destino.value !== "")
              tree_antiguo.setCheck(valor_destino.value, false);
          if (nodeId.indexOf("_") != -1)
              nodeId = nodeId.substr(0, nodeId.indexOf("_"));
          valor_destino.value = nodeId;
      }
      else
      {
          valor_destino.value = "";
      }
  }
  function fin_cargando_antiguo() {
      if (browserType == "gecko")
          document.poppedLayer =
                  eval('document.getElementById("esperando_antiguo")');
      else if (browserType == "ie")
          document.poppedLayer =
                  eval('document.getElementById("esperando_antiguo")');
      else
          document.poppedLayer =
                  eval('document.layers["esperando_antiguo"]');
      document.poppedLayer.style.display = "none";
  }

  function cargando_antiguo() {
      if (browserType == "gecko")
          document.poppedLayer =
                  eval('document.getElementById("esperando_antiguo")');
      else if (browserType == "ie")
          document.poppedLayer =
                  eval('document.getElementById("esperando_antiguo")');
      else
          document.poppedLayer =
                  eval('document.layers["esperando_antiguo"]');
      document.poppedLayer.style.display = "";
  }
  var browserType;
  if (document.layers) {
      browserType = "nn4"
  }
  if (document.all) {
      browserType = "ie"
  }
  if (window.navigator.userAgent.toLowerCase().match("gecko")) {
      browserType = "gecko"
  }
  tree_nuevo = new dhtmlXTreeObject("treeboxbox_nuevo", "100%", "100%", 0);
  tree_nuevo.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
  tree_nuevo.enableIEImageFix(true);
  tree_nuevo.enableCheckBoxes(1);
  tree_nuevo.enableRadioButtons(true);
  tree_nuevo.setOnLoadingStart(cargando_nuevo);
  tree_nuevo.setOnLoadingEnd(fin_cargando_nuevo);
  tree_nuevo.enableSmartXMLParsing(true);
  tree_nuevo.loadXML("<?php echo($ruta_db_superior);?>test.php?sin_padre=1");
  tree_nuevo.setOnCheckHandler(onNodeSelect_nuevo);
  function onNodeSelect_nuevo(nodeId)
  {
      valor_destino = document.getElementById("nuevo");

      if (tree_nuevo.isItemChecked(nodeId))
      {
          if (valor_destino.value !== "")
              tree_nuevo.setCheck(valor_destino.value, false);
          if (nodeId.indexOf("_") != -1)
              nodeId = nodeId.substr(0, nodeId.indexOf("_"));
          valor_destino.value = nodeId;
      }
      else
      {
          valor_destino.value = "";
      }
  }
  function fin_cargando_nuevo() {
      if (browserType == "gecko")
          document.poppedLayer =
                  eval('document.getElementById("esperando_nuevo")');
      else if (browserType == "ie")
          document.poppedLayer =
                  eval('document.getElementById("esperando_nuevo")');
      else
          document.poppedLayer =
                  eval('document.layers["esperando_nuevo"]');
      document.poppedLayer.style.display = "none";
  }

  function cargando_nuevo() {
      if (browserType == "gecko")
          document.poppedLayer =
                  eval('document.getElementById("esperando_nuevo")');
      else if (browserType == "ie")
          document.poppedLayer =
                  eval('document.getElementById("esperando_nuevo")');
      else
          document.poppedLayer =
                  eval('document.layers["esperando_nuevo"]');
      document.poppedLayer.style.display = "";
  }
  var formulario_reemplazo=$("#formulario_reemplazo");
  formulario_reemplazo.validate();
  $("#submit_formulario_reemplazo").click(function(){
  	if($("#antiguo").val()=="" || $("#nuevo").val()==""){
      alert("Por Favor Ingrese los Funcionarios");
      return(false);
    }

    if($("#antiguo").val()==$("#nuevo").val()){
      alert("El usuario no puede reemplazarse a si mismo");
      return(false);
    }
    if($("input[name='tipo_reemplazo']").val()==1){
      var inDate = new Date($("#fecha_inicio").val()),
      eDate = new Date($("#fecha_fin").val());
      if($("#fecha_inicio").val() == $("#fecha_fin").val()) {
        alert("Las fechas no pueden ser iguales");
        return(false);
      }
      else if(inDate>eDate){
        alert("La fecha final no pueden ser anterior a la fecha final");
        return(false);
      }
    }else{
      $("#fecha_fin").removeClass("required");
      $("#fecha_fin").val("0000-00-00");
    }
    if(formulario_reemplazo.valid()){
     $(this).attr('disabled', 'disabled');
     formulario_reemplazo.submit();
     return(true);
    }
   });
   $("input[name='tipo_reemplazo']").change(function(){
      $("#fila_fecha_fin").toggle();
   });
});
</script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.validate_reemplazos.js"></script>
<style>label.valid {width: 24px; height: 24px; background: url(<?php echo($ruta_db_superior);?>asset/img/layout/valid.png) center center no-repeat; display: inline-block;text-indent: -9999px;}label.error {font-weight: bold;color: red;padding: 2px 8px;margin-top: 2px;}</style>
<?php
echo(librerias_arboles());
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_codificacion.js"></script>
<?php
function adicionar_reemplazo(){
$fecha_fin="NULL";
if(@$_REQUEST["antiguo"]==@$_REQUEST["nuevo"]){
  alerta("<b>ATENCI&Oacute;N</b><br>El usuario no puede reemplazarse a si mismo");
  return(0);
}
if(@$_REQUEST["fecha_fin"]){
  $fecha_fin=fecha_db_almacenar(@$_REQUEST["fecha_fin"],"Y-m-d");
}
$sql2="INSERT INTO reemplazo_saia(antiguo,nuevo,fecha_inicio,fecha_fin,observaciones,tipo_reemplazo) VALUES('".@$_REQUEST["antiguo"]."','".@$_REQUEST["nuevo"]."',".fecha_db_almacenar(@$_REQUEST["fecha_inicio"],"Y-m-d").",".$fecha_fin.",'".@$_REQUEST["observaciones"]."','".$_REQUEST['tipo_reemplazo']."')";
phpmkr_query($sql2);
$idreemplazo_saia=phpmkr_insert_id();
return($idreemplazo_saia);
}
?>