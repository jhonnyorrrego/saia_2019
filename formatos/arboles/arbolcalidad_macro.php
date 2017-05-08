<?php
include_once("../../db.php");
include_once("../../librerias_saia.php");
include_once("../../header.php");
$archivo="test_calidad_prueba2.php";
$cadena="";
if(@$_REQUEST["idsecretaria"]){
  $idsecretaria=$_REQUEST["idsecretaria"];
  $archivo="test_calidad_secretaria_macro.php?idsecretaria=".$idsecretaria;
}
$dependencia=busca_filtro_tabla("","dependencia","tipo=1 AND estado=1 AND cod_padre=1","",$conn);
for($i=0;$i<$dependencia["numcampos"];$i++){
  $cadena.='<option value="'.$dependencia[$i]["iddependencia"].'d"';
  if($dependencia[$i]["iddependencia"]."d"==$idsecretaria){
    $cadena.=" selected ";
    //echo($dependencia[$i]["nombre"]);
  }
  $cadena.='>'.delimita($dependencia[$i]["nombre"],40).'</option>';
}
?>
<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css">
<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
<style type="text/css" media="screen">
#div_contenido {
   overflow: hidden;
}
	</style>
<table  border="0" >
  <tr>
    <td>
        <?php
        //agrega_boton("texto","","../proceso/previo_mostrar_proceso.php?editar=1","detalles","Editar Mapa","","administracion_calidad");
        //agrega_boton("texto","","../../documento_trasladar2.php","detalles","Trasladar Documentos","","administracion_calidad");
       // agrega_boton("texto","","test_calidad_prueba.php","detalles","Actualizar Arbol","","actualizar_calidad");
        echo(librerias_jquery('1.7'));
		global $raiz_saia;
		$raiz_saia="../../";
		echo(librerias_notificaciones());
        ?>
        <!--
        <a title="" id="actualizar_arbol" style="color: -webkit-link; text-decoration: underline; cursor: pointer;"><span class="phpmaker">ACTUALIZAR ARBOL</span></a >
        <script>
        	$('#actualizar_arbol').click(function(){
				$.ajax({
                    dataType: 'html',
                    url: "test_calidad_prueba2.php",

                    success: function(datos){
                    	notificacion_saia("Arbol Actualizado Satisfactoriamente","success",'',3000);
                	}
            	});
        	});
        </script>

        -->
        <!--div id="div_secretarias">
        Filtro de procesos Por secretaria
          <select name="secretarias" onchange="redireccionar(this.value)">
          <option vaalue="0">TODOS LOS PROCESOS</option>
            <?php
              echo($cadena);
            ?>
          </select>
        </div-->
    	<div id="esperando"><img src="../../imagenes/cargando.gif"></div>
    	<!-- Buscar: <input type="text" id="stext" width="200px" size="25"><br>
          <a href="javascript:void(0)" onclick="tree_calidad.findItem(document.getElementById('stext').value,0,1)"> Buscar</a>  |
            <a href="javascript:void(0)" onclick="tree_calidad.findItem(document.getElementById('stext').value)"> Siguiente</a>  |
            <a href="javascript:void(0)" onclick="tree_calidad.findItem(document.getElementById('stext').value,1)"> Anterior</a><br /><br / >
        -->
         <hr/>
    	<div id="treeboxbox_tree_calidad"></div>
    	<script type="text/javascript">
      <!--
      function redireccionar(secretaria){
        window.open("arbolcalidad_macro.php?idsecretaria="+secretaria,"_self");
      }
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree_calidad=new dhtmlXTreeObject("treeboxbox_tree_calidad","340px",$(document).height(),0);
			tree_calidad.setImagePath("../../botones/formatos/");
			tree_calidad.enableIEImageFix(true);
			tree_calidad.setXMLAutoLoadingBehaviour("id");
			tree_calidad.setImageArrays("plus","plus.gif","plus.gif","plus.gif","plus.gif","plus.gif");
			tree_calidad.setImageArrays("minus","minus.gif","minus.gif","minus.gif","minus.gif","minus.gif");
      		tree_calidad.setOnLoadingStart(cargando);
      		tree_calidad.setOnLoadingEnd(fin_cargando);
			tree_calidad.setOnClickHandler(onNodeSelect);
			tree_calidad.enableAutoTooltips(true);
			tree_calidad.setXMLAutoLoading("<?php echo($archivo); ?>");
			tree_calidad.enableSmartXMLParsing(true);
			tree_calidad.loadXML("<?php echo($archivo); ?>");
    	function onNodeSelect(nodeId){
        var accion=0;
        var llave=0;
        llave=tree_calidad.getParentId(nodeId);
        tree_calidad.closeAllItems(tree_calidad.getParentId(nodeId))
        tree_calidad.openItem(nodeId);
        tree_calidad.openItem(tree_calidad.getParentId(nodeId));

        var bases_calidad = nodeId.split('|');

        if(bases_calidad[0]=='bcp'){ //PADRE: BASES DE CALIDAD
            conexion="../bases_calidad/previo_mostrar_bases_calidad.php?iddoc=todos";
        }else if(bases_calidad[0]=='bc'){ //HIJOS DE BASES DE CALIDAD
            conexion="../bases_calidad/previo_mostrar_bases_calidad.php?iddoc="+bases_calidad[1];
        }else{ //MACROPROCESO-PROCESO,
            accion="mostrar";
            conexion="parsear_accion_arbol.php?riesgos=2&id="+nodeId+"&accion="+accion+"&llave="+llave+"&pantalla=calidad";

        }

        window.parent.open(conexion,"detalles");
        //tree2.refreshItem(nodeId);

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
        <?php if(@$_REQUEST["item"]){ ?>
      	var item="<?php echo $_REQUEST["item"]; ?>";
      	tree_calidad.selectItem(item,true,false);
      <?php } ?>

         <?php
         $iddoc_mapa_proceso=busca_filtro_tabla("idformato","formato","lower(nombre)='proceso'","",$conn);
         ?>
         if( parseInt($('#ejecutar_evento_mapa_proceso').val())==1 ){
             tree_calidad.selectItem(parseInt('<?php echo($iddoc_mapa_proceso[0]['idformato']); ?>'),true,false); /*por defecto Mapa de proceso*/
            $('#ejecutar_evento_mapa_proceso').val(0);
         }
      }



    	</script>
    </td>
  </tr>
</table>
<input type="hidden" id="ejecutar_evento_mapa_proceso" value="1">
<?php
include_once("../../footer.php");
?>