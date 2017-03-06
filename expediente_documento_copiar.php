<?php include_once("db.php");
include_once("header.php");

$iddoc = $_REQUEST["iddoc"];

include_once("formatos/librerias/header_formato.php");
?>
<br><br><br>
<span class="internos"><img class="imagen_internos" src="botones/comentarios/expediente.png" border="0">&nbsp;&nbsp;COPIAR / MOVER EL DOCUMENTO A UN EXPEDIENTE</span><br><br><br>
<a href="expediente_detalles.php?key=<?php echo $_REQUEST["key"];?>" target="_self" title="Volver al listado">Volver al listado<a/>&nbsp;&nbsp;
<?php
$doc=busca_filtro_tabla("","documento","iddocumento=$iddoc","",$conn); 
?>
<form id="form1" name="form1" method="post" action="expediente_guardar.php">
<table>
 <tr>
   <td class="encabezado">RADICADO DEL DOCUMENTO: </td>
   <td><?php echo $doc[0]["numero"]; ?> </td>
 </tr> 
  <tr>
    <td  class="encabezado">DESCRIPCI&Oacute;N DEL DOCUMENTO: </td>
   <td> <?php echo stripslashes($doc[0]["descripcion"]); ?>  </td>
 </tr> 
 <tr>
    <td  class="encabezado">EXPEDIENTES: </td>
   <td>
   <link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<span class="phpmaker">
			      Buscar:<br><input type="text" id="stext" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext').value),1)">
      <img src="botones/general/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext').value),0,1)">
      <img src="botones/general/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext').value))">
      <img src="botones/general/siguiente.png"border="0px"></a>
<br /><br />
				<div id="treeboxbox_tree2"></div></span>
				<script type="text/javascript">
  <!--		
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
      tree2.enableCheckBoxes(1);
      tree2.enableSmartXMLParsing(true);			
			tree2.loadXML("test_expediente.php?doc=<?php echo($iddoc); ?>&accion=1&permiso_editar=1"); 
			-->
      </script>
   </td>
 </tr>
 <tr>
  <td  class="encabezado">ACCI&Oacute;N A REALIZAR: </td>
   <td> <input id="accion1" type="radio" value="1" name="accion" checked>Copiar al expediente
        <input id="accion0" type="radio" value="3" name="accion">Mover al expediente
  </td>
 </tr>
 <tr>
 <td colspan="2">
 <input type="hidden" name="expedientes" id="expedientes" value="">
 <input type="hidden" name="expediente_actual" value="<?php echo $_REQUEST["key"]; ?>" >
 <input type="hidden" name="pantalla"  value="listado">
 <input type="hidden" name="iddoc" value="<?php echo $iddoc; ?>">
 <input type=submit value="Continuar">
 </td>
 </tr>
 </table>
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
       alert("Debe seleccionar al menos un expediente");
      }
    return(false);   
  });
});
 </script> 
<?php
include_once("footer.php");
?>
