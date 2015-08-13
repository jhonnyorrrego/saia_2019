<?php
include_once("../../db.php");
include_once("../../header.php");
$archivo="test_calidad.php";
$cadena="";
if(@$_REQUEST["idsecretaria"]){
  $idsecretaria=$_REQUEST["idsecretaria"];
  $archivo="test_calidad_secretaria.php?idsecretaria=".$idsecretaria;
}

$dependencia=busca_filtro_tabla("","dependencia","tipo=1 AND estado=1 AND cod_padre=1","",$conn);
for($i=0;$i<$dependencia["numcampos"];$i++){
  $cadena.='<option value="'.$dependencia[$i]["iddependencia"].'"';
  if($dependencia[$i]["iddependencia"]==$idsecretaria){
    $cadena.=" selected ";
    //echo($dependencia[$i]["nombre"]);
  }
  $cadena.='>'.delimita($dependencia[$i]["nombre"],40).'</option>';
}
?>
<script>
document.getElementById("ocultar").style.display="none";
</script>
<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css">
<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
<table width=100% border="0">
  <tr>
    <td>
        <?php
        agrega_boton("texto","","../proceso/previo_mostrar_proceso.php?editar=1","detalles","Editar Mapa","","editar_calidad");
        //agrega_boton("texto","","test_calidad.php","detalles","Actualizar Arbol","","actualizar_calidad");
        ?>
        <div id="div_secretarias">
        <!--Filtro de procesos Por secretaria
          <select name="secretarias" onchange="redireccionar(this.value)">
          <option vaalue="0">TODOS LOS PROCESOS</option-->
            <?php
              //echo($cadena);
            ?>
          <!--/select-->
        </div>
    	<div id="esperando"><img src="../../imagenes/cargando.gif"></div>
    	Buscar: <input type="text" id="stext" width="200px" size="25"><br>
          <a href="javascript:void(0)" onclick="tree_calidad.findItem(document.getElementById('stext').value,0,1)"> Buscar</a>  |
            <a href="javascript:void(0)" onclick="tree_calidad.findItem(document.getElementById('stext').value)"> Siguiente</a>  |
            <a href="javascript:void(0)" onclick="tree_calidad.findItem(document.getElementById('stext').value,1)"> Anterior</a><br /><br />
    	<div id="treeboxbox_tree_calidad"></div>
    	<script type="text/javascript">
      <!--
      function redireccionar(secretaria){
        window.open("arbolcalidad.php?idsecretaria="+secretaria,"_self");
      }
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree_calidad=new dhtmlXTreeObject("treeboxbox_tree_calidad","100%","100%",0);
			tree_calidad.setImagePath("../../botones/formatos/");
			tree_calidad.enableIEImageFix(true);
			tree_calidad.setImageArrays("plus","plus.gif","plus.gif","plus.gif","plus.gif","plus.gif");
			tree_calidad.setImageArrays("minus","minus.gif","minus.gif","minus.gif","minus.gif","minus.gif");
      tree_calidad.setOnLoadingStart(cargando);
      tree_calidad.setOnLoadingEnd(fin_cargando);
      tree_calidad.enableSmartXMLParsing(true);
			tree_calidad.setOnClickHandler(onNodeSelect);
			tree_calidad.enableAutoTooltips(true);
			tree_calidad.loadXML("<?php echo($archivo); ?>");
    	function onNodeSelect(nodeId){
        var accion=0;
        var llave=0;
        llave=tree_calidad.getParentId(nodeId);
        tree_calidad.closeAllItems(tree_calidad.getParentId(nodeId))
        tree_calidad.openItem(nodeId);
        tree_calidad.openItem(tree_calidad.getParentId(nodeId));
        //tree2.refreshItem(nodeId);
        accion="mostrar";
        conexion="parsear_accion_arbol.php?id="+nodeId+"&accion="+accion+"&llave="+llave;
        window.parent.open(conexion,"detalles");
      }
      function fin_cargando() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando")');
        else
           document.poppedLayer =
              eval('document.layers["esperando"]');
        document.poppedLayer.style.visibility = "hidden";
      }
      function cargando() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando")');
        else
           document.poppedLayer =
               eval('document.layers["esperando"]');
        document.poppedLayer.style.visibility = "visible";
      }
    	-->
    	</script>
    </td>
  </tr>
</table>
<?php
include_once("../../footer.php");
?>

