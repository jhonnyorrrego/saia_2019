<?php

$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }

include_once("db.php");
include_once("pantallas/expediente/librerias.php");
include_once($ruta_db_superior."calendario/calendario.php");
$iddoc = $_REQUEST["iddoc"];
$doc_menu=@$_REQUEST["iddoc"];
include_once("pantallas/documento/menu_principal_documento.php");

$cadena.="";
$cadena.=expedientes_asignados();
$cadena.=" AND a.idexpediente=b.expediente_idexpediente AND b.documento_iddocumento in(".$iddoc.")";

$expedientes_documento=busca_filtro_tabla("","vexpediente_serie a, expediente_doc b",$cadena,"",$conn);
$nombres_exp=array_unique(extrae_campo($expedientes_documento,"nombre"));

?>
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">

<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-responsive.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap_reescribir.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-iconos-segundarios.css"/>
<?php echo(menu_principal_documento($doc_menu,1)); ?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<legend>Adicionar a un expediente ya existente</legend>
<?php
$doc=busca_filtro_tabla("","documento","iddocumento in($iddoc)","",$conn);
?>
<form id="form1" name="form1" method="post" action="expediente_guardar.php">
<div class="control-group element">
	<label class="control-label" for="nombre">Expediente
  </label>
  <div class="controls">
			<input type="text" id="stext" width="200px" size="20">
      <a href="javascript:void(0)" onclick="tree2.findItem(htmlentities(document.getElementById('stext').value),1)">
      <img src="botones/general/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(htmlentities(document.getElementById('stext').value),0,1)">
      <img src="botones/general/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(htmlentities(document.getElementById('stext').value))">
      <img src="botones/general/siguiente.png"border="0px"></a>
      <div id="esperando_expediente"><img src="imagenes/cargando.gif"></div>
			<div id="treeboxbox_tree2"></div>
	</div>
</div>
				<script type="text/javascript">
  <!--
  		var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
  		
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","",0);
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
      tree2.enableCheckBoxes(1);
      //tree2.enableSmartXMLParsing(true);
      tree2.setOnLoadingStart(cargando_expediente);
      tree2.setOnLoadingEnd(fin_cargando_expediente);
      
			tree2.setXMLAutoLoading("test_expediente.php?doc=<?php echo($iddoc); ?>&accion=1&permiso_editar=1&estado_cierre=1&estado_archivo=1");
			tree2.loadXML("test_expediente.php?doc=<?php echo($iddoc); ?>&accion=1&permiso_editar=1&estado_cierre=1&estado_archivo=1");
			
			function fin_cargando_expediente() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_expediente")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_expediente")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_expediente"]');
        document.poppedLayer.style.display = "none";
      }

      function cargando_expediente() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_expediente")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_expediente")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_expediente"]');
        document.poppedLayer.style.display = "";
      }
			-->
      </script>
<?php if($doc["numcampos"]>1){ ?>
 <!--tr>
  <td  class="encabezado">ACCI&Oacute;N A REALIZAR: </td>
   <td> <input id="accion1" type="radio" value="1" name="accion" checked>Adicionar al expediente
        <input id="accion0" type="radio" value="0" name="accion">Sacar del expediente
  </td>
 </tr-->
 <input type="hidden" name="accion" id="accion1" value="1">
<?php }
else{ ?>
	<input type="hidden" name="accion" id="accion4" value="4">
<?php } ?>


<?php 
if(count($nombres_exp)){
?>
<div class="control-group element">
	<label class="control-label" for="nombre"><?php echo("El documento se encuentra almacenado en:<br> <b>".ucwords(strtolower(implode("</b><br><b>",$nombres_exp)))); ?></b>
  </label>
</div>
<?php    
}
?>


<div class="control-group element">
    <label class="control-label" for="fecha_limite"> Fecha Limite de Respuesta
  </label>
  <div class="controls">
      <?php 
          $fecha_limite='0000-00-00';
          if($doc[0]['fecha_limite']){
            $fecha_limite=$doc[0]['fecha_limite'];
          }
      ?>
      
      <input class="btn btn-mini" type="button" onclick="document.getElementById('fecha_limite').value='<?php echo($fecha_limite); ?>'" value="L" />
      <input id="fecha_limite" name="fecha_limite" style="width:100px" type="text" value="<?php echo($fecha_limite); ?>" readonly />
      <?php selector_fecha("fecha_limite","form1","Y-m-d",date("m"),date("Y"),"default.css","",""); ?>
  </div>
</div>
<div>
 <input type="hidden" name="expedientes" id="expedientes" value="">
 <input type="hidden" name="iddoc" value="<?php echo $iddoc; ?>">
 <input type="submit" value="Continuar" class="btn btn-primary btn-mini">
 <button class="btn btn-mini" id="" onclick="window.open('<?php echo($ruta_db_superior); ?>pantallas/expediente/adicionar_expediente_documento.php?iddoc=<?php echo(@$_REQUEST["iddoc"]); ?>','_self'); return false;">Adicionar a un nuevo expediente</button>
</div>
 </form>
 <script>
 $().ready(function() {
	$('#form1').submit(function(){
    seleccionados=tree2.getAllChecked();
    if(seleccionados!="")
      {$('#expedientes').val(seleccionados);
       return(true);
      }
    else
      {$('#expedientes').val('');
       //alert("Debe seleccionar al menos un expediente");
       return(true);
      }
    return(false);
  });
  $('#accion1').click(function(){
    tree2.deleteChildItems(0);
    tree2.loadXML("test_expediente.php?doc=<?php echo($iddoc); ?>&accion=1&permiso_editar=1");
  });
  $('#accion0').click(function(){
    tree2.deleteChildItems(0);
    tree2.loadXML("test_expediente.php?doc=<?php echo($iddoc); ?>&accion=0&permiso_editar=1");
  });
});
</script>
