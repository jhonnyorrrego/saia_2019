<?php
/*
 * Genera un arbol con css/dhtmlXTree.css, para ello utiliza un archivo XMl con los datos 
 * en forma jerarquica.
 * llama al archivo de generacion generaxml.php y le pasa el parametro del tipo de arbol a generar
 * 
 * Recibe :  una variable tipo post o get llamada $tipo
 * $tipo :   1 Dependencias
 *     	     2 Dependencias - Cargos  (las dependencias van se�anadas con un simbolo # en el id)
 * TODO : 	Implementar los tipos de arboles  faltantes ... roles rutas cargos hijos etc 
 * TODO :   Impleentar la carga incremental 
 *  Los anteriores TODO involucran a generaxml.php - arbol.php
 * 
 */

if(isset($_REQUEST['tipo']))
{    
	$tipo_arbol=$_REQUEST['tipo'];
}
else $tipo_arbol=1; //Dependencias Valor por defecto 
?>
<script type="text/javascript">
var tipo_arbol=<?php echo $tipo_arbol;//paso la variable par el procesamiento ?>
</script>
<table>
<tr><td class="encabezado" title="Seleccione a quien va a asignar la tarea . Puede seleccionar toda la C&aacute;mara de Comercio, toda una dependencia o los funcionarios destino"><span class="phpmaker" style="color: #FFFFFF;">ASIGNAR A</span></br></br>
<td>
<form name="actualiza_arbol" action="arbol.php" method="POST">
<select name="tipo" onchange="document.actualiza_arbol.submit();">
<option value='1'<?php if($tipo_arbol==1) echo "selected"; ?>>Dependencias</option>
<option value='2'<?php if($tipo_arbol==2) echo "selected"; ?>>Funcionarios</option>
</select>
</form>
</td></tr></table>
<head>
<meta name="KEYWORDS" content="dhtmlxtree, dhtml tree, javascript tree, javascript, DHTML, tree, tree menu, checkbox tree, checkboxes, dynamical loading, xml, AJAX, API, cross-browser, checkbox, XHTML, compatible, treeview, navigation, menu, tree control, script, javascript navigation, web-site, dynamic, javascript tree menu, dhtml tree menu, dynamic tree, folder tree, item, node, asp, .net, jsp, cold fusion, custom tag, loading, widget, checkbox, drag, drop, drag and drop, component, html, scand">
<meta name="DESCRIPTION" content="Cross-browser DHTML tree menu with XML support and powerful API. This JavaScript Tree Menu has built-in checkboxes and allows you to create advanced checkbox tree.">
</head>
	<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="../js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="../js/dhtmlXTree.js"></script>
		
<div id="treeboxbox_tree2">Seleccione Responsable(s)</div>
	<script type="text/javascript">
                
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
			tree2.setImagePath("../imgs/");
			tree2.enableIEImageFix(true);
			tree2.enableCheckBoxes(1);
			tree2.enableThreeStateCheckboxes(true);
  		    tree2.setXMLAutoLoading("generaxml.php?tipo=<?php echo($tipo_arbol);?>");
			tree2.loadXML("generaxml.php?tipo=<?php echo($tipo_arbol);?>");
			
					
	</script>
