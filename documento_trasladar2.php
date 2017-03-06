<?php
include_once("header.php");
include_once("formatos/librerias/header_formato.php");

if(@$_REQUEST["accion"]=="trasladar"){
	$documentos=explode(",",$_REQUEST["documento_calidad"]);
  foreach($documentos as $fila){
 		if($fila<>""){
 			$dato=explode("-",$fila);
 			if($_REQUEST["proceso"][0]!='m'){
   			$sql1="update ".DB.".".$dato[0]." set ft_proceso='".$_REQUEST["proceso"]."' where id".$dato[0]."='".$dato[1]."'";	     
     		phpmkr_query($sql1,$conn);
     		$destino=busca_filtro_tabla("documento_iddocumento",$dato[0],"id".$dato[0]."='".$dato[1]."'");
     		$origen=busca_filtro_tabla("documento_iddocumento","ft_proceso","idft_proceso='".$_REQUEST["proceso"]."'");
		    $sql2="update ".DB.".respuesta set origen='".$origen[0][0]."' where destino='".$destino[0][0]."'";
		    phpmkr_query($sql2,$conn);
			}else{
				if($dato[0]=='ft_gestion_educativo'){
					$_REQUEST["proceso"]=str_replace("m","",$_REQUEST["proceso"]);
					$sql1="update ".$dato[0]." set ft_macroproceso_calidad='".$_REQUEST["proceso"]."', ft_proceso=null where id".$dato[0]."='".$dato[1]."'";
					phpmkr_query($sql1,$conn);
				$destino=busca_filtro_tabla("documento_iddocumento",$dato[0],"id".$dato[0]."='".$dato[1]."'");
				$origen=busca_filtro_tabla("documento_iddocumento","ft_macroproceso_calidad","idft_macroproceso_calidad='".$_REQUEST["proceso"]."'");
				$sql2="update ".DB.".respuesta set origen='".$origen[0][0]."' where destino='".$destino[0][0]."'";
		     	phpmkr_query($sql2,$conn);
			}
			else{
				alerta("El macroproceso destino no tiene este formato");
			}
		}
    }
  }
 alerta("Los documentos han sido trasladados de proceso.");
 redirecciona("documento_trasladar2.php"); 
}
else
{
$procesos=ejecuta_filtro_tabla("select valor,nombre from (select a.idft_proceso as valor, nombre from ft_proceso a, documento b where a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO','ANULADO') UNION ALL select concat('m',idft_macroproceso_calidad) as valor, nombre from ft_macroproceso_calidad a, documento b where a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO','ANULADO')) as consulta order by nombre",$conn);

?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
<script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	$('#header').hide();
});

</script>
<br><B>TRASLADAR DOCUMENTO DE CALIDAD</B>
<br>
<br>
<form name="formulario_formatos" id="formulario_formatos">
  <table border="1" style="border-collapse:collapse">
    <tr>
      <td class="encabezado">DOCUMENTOS QUE DESEA TRASLADAR</td><td>
        <div id="seleccionados">              
        </div>                          <br />  Buscar:  
        <input type="text" id="stext_documento_calidad" width="200px" size="25">
        <a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value),1)">    
          <img src="botones/general/anterior.png"border="0px"></a>                    
        <a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value),0,1)">  
          <img src="botones/general/buscar.png"border="0px"></a>                                               
        <a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value))">  
          <img src="botones/general/siguiente.png"border="0px"></a>                            
          <br />
        <div id="esperando_documento_calidad">  
          <img src="imagenes/cargando.gif">
        </div>
        <div id="treeboxbox_documento_calidad" height="90%">
        </div>
        <input type="hidden" maxlenght="255"  name="documento_calidad" id="documento_calidad"   value="" class="required">
        <label style="display:none" class="error" for="documento_calidad">Campo obligatorio. 
        </label>
<script type="text/javascript">
      <!--
          var browserType;
          if (document.layers) {browserType = "nn4"}
          if (document.all) {browserType = "ie"}
          if (window.navigator.userAgent.toLowerCase().match("gecko")) {
             browserType= "gecko"
          }
    			tree_documento_calidad=new dhtmlXTreeObject("treeboxbox_documento_calidad","100%","100%",0);
    			tree_documento_calidad.setImagePath("imgs/");                      
    			tree_documento_calidad.enableIEImageFix(true);
          tree_documento_calidad.enableCheckBoxes(true);
          tree_documento_calidad.enableSingleRadioMode(true, "");
          tree_documento_calidad.setOnLoadingStart(cargando_documento_calidad);
          tree_documento_calidad.setOnLoadingEnd(fin_cargando_documento_calidad);
          tree_documento_calidad.enableSmartXMLParsing(true);
          tree_documento_calidad.loadXML("formatos/arboles/test_procesos_calidad_macro.php");
    	    tree_documento_calidad.setOnCheckHandler(onNodeSelect_documento_calidad);
          function onNodeSelect_documento_calidad(nodeId)
          {valor_destino=document.getElementById("documento_calidad");
           valor_destino.value=tree_documento_calidad.getAllChecked();
          }
          function fin_cargando_documento_calidad() {
            if (browserType == "gecko" )
               document.poppedLayer =
                   eval('document.getElementById("esperando_documento_calidad")');
            else if (browserType == "ie")
               document.poppedLayer =
                  eval('document.getElementById("esperando_documento_calidad")');
            else
               document.poppedLayer =
                  eval('document.layers["esperando_documento_calidad"]');
            document.poppedLayer.style.display = "none";
          }
          function cargando_documento_calidad() {
            if (browserType == "gecko" )
               document.poppedLayer =
                   eval('document.getElementById("esperando_documento_calidad")');
            else if (browserType == "ie")
               document.poppedLayer =
                  eval('document.getElementById("esperando_documento_calidad")');
            else
               document.poppedLayer =
                   eval('document.layers["esperando_documento_calidad"]');
            document.poppedLayer.style.display = "";
          }
    	--></script>      </td>
    </tr>
    <tr>
      <td class="encabezado">PROCESO DESTINO</td><td>
        <select name="proceso" id="proceso" class="required">
        <option value='' selected >Seleccionar...</option>
<?php
for($i=0;$i<$procesos["numcampos"];$i++)
  echo "<option value='".$procesos[$i]["valor"]."'>".$procesos[$i]["nombre"]."</option>";
          ?>
        </select></td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="submit" value="Continuar">
        <input type="hidden" name="accion" value="trasladar">
     </td>
    </tr>
  </table>
</form>
<?php
}
include_once("footer.php");
?>