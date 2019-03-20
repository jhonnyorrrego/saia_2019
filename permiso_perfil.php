<?php 
include ("db.php");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
include ("header.php");
?>
<script type="text/javascript" src="js/jquery.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
<link rel="stylesheet" type="text/css" href="css/dhtmlXTree.css">
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<?php include_once("formatos/librerias/header_formato.php"); ?>
<script type="text/javascript">
<!--	
$().ready(function() {
 $("#x_perfil_idperfil").change(function() {
    if($('#x_perfil_idperfil :selected').val()!="")
      {tree3.deleteChildItems(0);
       tree3.loadXML('test_permiso_modulo.php?filtro_perfil=1&entidad=perfil&llave_entidad='+$('#x_perfil_idperfil :selected').val());
      }
 });
});
//-->
</script>
<p><span class="internos">LISTADO DE PERMISOS POR PERFIL<br><br>
<a href="perfiladd.php">Adicionar Perfil</a>&nbsp;&nbsp;
<a href='permiso_perfiladd.php?pantalla=listado' id='editar_permisos'>Asignar / Quitar Permisos a varios perfiles</a>
</span></p>
<form name="permiso_perfiladd" id="permiso_perfiladd" action="permiso_perfiladd.php" method="post">
<?php
if(isset($_REQUEST["pantalla"]))
  echo '<input type="hidden" name="pantalla" value="'.$_REQUEST["pantalla"].'">';
?>
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PERFIL</span></td>

<td bgcolor="#F5F5F5"><span class="phpmaker">		
<?php
 echo "<input type=hidden name='perfil_seleccionado' id='perfil_seleccionado' value='".@$sKey."'>";
?>
<?php
$x_perfil_idperfilList = "<select id='x_perfil_idperfil'><option value=\"\">Seleccionar...</option>";
$sSqlWrk = "SELECT DISTINCT A.idperfil, A.nombre FROM perfil A" . " ORDER BY A.nombre Asc";
$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_perfil_idperfilList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\">" . $datawrk["nombre"]."</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
echo $x_perfil_idperfilList."</select>";
?>
</span></td></tr><tr> 
<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">MODULOS</span></td>		
		<td bgcolor="#F5F5F5">
        <table>
        <tr><td colspan=2><b>Click en el modulo para Asignar/Quitar</b>
        </td></tr>
        <tr><td><img src='js/imgs/green.gif' /></td>
        <td>Modulo asignado / Padre con todos los hijos asignados</td></tr>
        <tr><td><img src='js/imgs/red.gif'></td>
        <td>Modulo no asignado / Padre sin hijos asignados</td></tr>
        <tr><td><img src='js/imgs/blue.gif'></td>
        <td>Modulo padre con algunos hijos asignados
        </td></tr></table>
          Buscar:<br><input type="text" id="stext_3" width="200px" size="20">
          <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,1)">
          <img src="assets/images/anterior.png" border="0px" alt="Anterior"></a>
          <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,0,1)">
          <img src="assets/images/buscar.png" border="0px" alt="Buscar"></a>
          <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value)">
          <img src="assets/images/siguiente.png" border="0px" alt="Siguiente"></a>
        <div id="esperando_modulo">
        <img src="imagenes/cargando.gif"></div>
        <div id="treeboxbox_tree3"></div>
    	<script type="text/javascript">
      <!--
          var browserType;
          if (document.layers) {browserType = "nn4"}
          if (document.all) {browserType = "ie"}
          if (window.navigator.userAgent.toLowerCase().match("gecko")) {
             browserType= "gecko"
          }
    			tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","100%",0);
    			tree3.setImagePath("imgs/");
    			tree3.enableIEImageFix(true);
    			tree3.enableAutoTooltips(1);
    			tree3.setOnLoadingStart(cargando_serie);
          tree3.setOnLoadingEnd(fin_cargando_serie);
          tree3.loadXMLString("<"+"?xml version=\"1.0\" encoding=\"UTF-8\"?"+"><tree id=\"0\"></tree>");
          tree3.setOnClickHandler(onNodeSelect);
          function editar_permiso(idmodulo,imagen,nombre)
            {
            }
          function onNodeSelect(nodeId)
            {nombre=tree3.getItemText(nodeId);
             imagen=tree3.getItemImage(nodeId,0);
             if(imagen=="green.gif")
               {texto="Desea QUITAR el permiso para el modulo "+nombre+" y todos sus hijos?";
                accion=0;
                respuesta="Permiso Eliminado.";
               }
             else 
               {texto="Desea ADICIONAR el permiso para el modulo "+nombre+" y todos sus hijos?";
                accion=1;
                respuesta="Permiso Adicionado.";
               } 
            if(confirm(texto))
              {hijos=tree3.getAllSubItems(nodeId);
               if(hijos!='')
                 nodos=hijos+','+nodeId;
               else 
                 nodos=nodeId;  
               $.ajax({
                  type: "POST",
                  url: 'permiso_perfiladd.php',
                  data:'a_add=A&x_modulo_idmodulo='+nodos+'&x_perfil_idperfil='+$('#x_perfil_idperfil :selected').val()+"&x_accion="+accion,
                  success: function(msg) {
                    alert(respuesta);
                    tree3.deleteChildItems(0);
                    tree3.loadXML('test_permiso_modulo.php?filtro_perfil=1&entidad=perfil&llave_entidad='+$('#x_perfil_idperfil :selected').val());
                  }
                });
              }
            }
          function fin_cargando_serie() {
            if (browserType == "gecko" )
               document.poppedLayer =
                   eval('document.getElementById("esperando_modulo")');
            else if (browserType == "ie")
               document.poppedLayer =
                  eval('document.getElementById("esperando_modulo")');
            else
               document.poppedLayer =
                  eval('document.layers["esperando_modulo"]');
            document.poppedLayer.style.visibility = "hidden";
          }
          function cargando_serie() {
            if (browserType == "gecko" )
               document.poppedLayer =
                   eval('document.getElementById("esperando_modulo")');
            else if (browserType == "ie")
               document.poppedLayer =
                  eval('document.getElementById("esperando_modulo")');
            else
               document.poppedLayer =
                   eval('document.layers["esperando_modulo"]');
            document.poppedLayer.style.visibility = "visible";
          }
    	-->
    	</script>
  </td>
	</tr>
</table>
<p>
</form>
<?php include ("footer.php") ?>
