<?php include_once("db.php");
include_once("header.php");
?>
<script> 
   document.getElementById("ocultar").style.display="none";  
</script>
<?php
$iddoc = @$_REQUEST["iddoc"];
$seleccionado=@$_REQUEST["mostrarexp"];
if($iddoc){
  if(isset($_REQUEST["expediente"]) && $_REQUEST["expediente"]!=""){
    $cad=$_REQUEST["expediente"];
    $id_exp = explode(",",substr($cad,",,"));
    for($i=0; $i<count($id_exp); $i++){  
      if(intval($id_exp[$i]) && $id_exp[$i]!=""){
        $mirarexp=$id_exp[$i];
        $sql_insert = "INSERT INTO expediente_doc(expediente_idexpediente,documento_iddocumento,fecha) VALUES(".$id_exp[$i].",".$iddoc.",'".date('Y-m-d H:i:s')."')";
        phpmkr_query($sql_insert,$conn) or error("PROBLEMAS AL ADICIONAR" . phpmkr_error() . ' SQL:' . $sql_insert);
      }
    }
    ?>
    <script type="text/javascript">
      parent.arbol_expediente.location="arbolexpediente.php?iddoc=<?php echo($iddoc); ?>&mostrarexp=<?php echo($seleccionado);?>";
    </script>
    <?php
}
  $doc = busca_filtro_tabla("numero,descripcion","documento","iddocumento=$iddoc","",$conn); 
  //menu_ordenar($iddoc);
  ?>
  <span class="internos"><img class="imagen_internos" src="botones/comentarios/expediente.png" border="0">&nbsp;&nbsp;ADICIONAR EL DOCUMENTO A UN EXPEDIENTE</span><br><br><br>
  <table border="0">
   <tr>
     <td class="encabezado">Radicado del documento: </td>
     <td><?php echo $doc[0]["numero"]; ?> </td>
   </tr> 
    <tr>
      <td  class="encabezado">Descripci&oacute;n del documento: </td>
     <td> <?php echo $doc[0]["descripcion"]; ?>  </td>
   </tr> 
   </table>
  <br />
  <script type="text/javascript">
  function EW_checkMyForm(EW_this){ 
  var list_expedientes = tree2.getAllChecked();      
  document.expediente_llenar.expediente.value=list_expedientes; 
  if(EW_this.expediente && EW_this.expediente.value == ""){ 
    alert("Por favor ingresar como por lo menos un expediente para asignar el documento");
  	return false;
  }		  
  }
  </script>
<?php 
}// cierra primer iddoc 
?>
<table border="0"><tr><td>
	<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<span class="phpmaker"><a href='expedienteadd.php' target='expedientelist'>Adicionar&nbsp;</a><br><br></span>
<span class="phpmaker">
			      Buscar:<br><input type="text" id="stext" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,1)">
      <img src="assets/images/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,0,1)">
      <img src="assets/images/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value)">
      <img src="assets/images/siguiente.png"border="0px"></a>
<br /><br />
				<div id="treeboxbox_tree2"></div></span>
  <br><br></td>
  </tr><tr><td>
<form name="expediente_llenar" id="expediente_llenar" method="POST" onSubmit="return EW_checkMyForm(this);" action="arbolexpediente.php">
  <input type="hidden" name="iddoc" id="iddoc" value="<?php echo($iddoc);?>">
  <input type="hidden" name="expediente" id="expediente" value="">
  <input type="hidden" name="mostrarexp" id="mostrarexp" value="<?php echo($seleccionado);?>">
  <?php if($iddoc) { ?>
  <input type="submit" name="Action" value="CONTINUAR">
  <?php } ?>
</form></td></tr></table>
<?php
include_once("footer.php");
?>
	<script type="text/javascript">
  <!--		
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
      <?php if($iddoc){ ?>
      tree2.enableCheckBoxes(1);
			tree2.enableThreeStateCheckboxes(false);
			<?php } ?>
      tree2.enableSmartXMLParsing(true);			
			tree2.loadXML("test_expediente.php");
			tree2.setOnClickHandler(onNodeSelect);
			<?php 
      if($seleccionado){ ?>
      	setTimeout("tree2.selectItem(<?php echo($seleccionado);?>,1);",100);
			<?php } ?>
			function onNodeSelect(nodeId)
      {
        tree2.setCheck(nodeId,1);
        document.expediente_llenar.mostrarexp.value=nodeId;
        parent.expedientelist.location="expediente_detalles.php?key="+nodeId;
      } 
	--> 		
	</script>
