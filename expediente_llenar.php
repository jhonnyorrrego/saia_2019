<?php

$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }

include_once("db.php");
include_once("pantallas/expediente/librerias.php");

$iddoc = $_REQUEST["iddoc"];
$expedientes_asignados=arreglo_expedientes_asignados();
$documento=busca_filtro_tabla("","expediente_doc","documento_iddocumento in(".$iddoc.") and expediente_idexpediente in(".implode(",",$expedientes_asignados).")","",$conn);
$exp_doc=extrae_campo($documento,"expediente_idexpediente","U");

$nombres_expedientes=busca_filtro_tabla("nombre","expediente a","idexpediente in(".implode(",",$exp_doc).")","",$conn);

$nombres_exp=array_unique(extrae_campo($nombres_expedientes,"nombre"));

?>
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">

<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-responsive.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap_reescribir.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-iconos-segundarios.css"/>

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
			<div id="treeboxbox_tree2"></div>
	</div>
</div>
				<script type="text/javascript">
  <!--		
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","",0);
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
      tree2.enableCheckBoxes(1);
      tree2.enableSmartXMLParsing(true);			
			tree2.loadXML("test_expediente.php?doc=<?php echo($iddoc); ?>&accion=1&permiso_editar=1"); 
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
<div class="control-group element">
	<label class="control-label" for="nombre"><?php echo("El documento se encuentra almacenado en:<br> <b>".ucwords(strtolower(implode("</b><br><b>",$nombres_exp)))); ?></b>
  </label>
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