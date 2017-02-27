<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
	   $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");  
include_once("pantallas/lib/librerias_cripto.php");
include_once("librerias_saia.php");
print_r($_REQUEST);
echo("<hr>");
print_r($_SESSION);
desencriptar_sqli('form_info');
echo(librerias_jquery());
  
  include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
  $material = NULL;
  $padre = NULL;
  
  if(@$_POST["send"]==1){
    $categoria = $_POST["categoria"];
    $padre = $_POST["padre"];
    $estado=$_POST["estado"];
	$accion = $_POST["accion"];
	if($accion == 1)
    	$sql="insert into categoria_formato(cod_padre,nombre,estado) values('".$padre."','".$categoria."','".$estado."')";
	else if($accion == 2){
		if($categoria!=''){
			$adicional= ", nombre='".$categoria."'";
		}
		$sql="update categoria_formato set estado='".$estado."' ".$adicional." where idcategoria_formato=".$padre;
	}
	else if($accion == 3)
		$sql= "delete from categoria_formato where idcategoria_formato=".$padre;

    phpmkr_query($sql); 
  }
?>
<html>
  <head>
    <title>Adicionar materiales</title>
    <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/jquery.js"></script>
    <script type="text/javascript">
  function validar_formu1()
  {
  	
    var campo = document.formu1;
    campo.send.value=1;
    <?php encriptar_sqli("formu1");?>
    campo.submit();
  }
  
    </script>
  </head>
  <body>

<?php
  echo '<form method="post" action="categoria_formatoadd.php" name="formu1" id="formu1">
  <table width="100%" cellspacing="1" cellpadding="2" border="0">
  <tr>
    <td class="encabezado" colspan="2" style="text-align:center"><strong>Adicionar</strong></td>
  </tr>
  
  <tr>
    <td class="encabezado" style="text-align:left;width:20%">Categoria</td>
  <td class="celda_transparente"><input type="text" name="categoria" style="text-align:left"></td></tr>
  <tr>
    <td class="encabezado" style="text-align:left">Padre</td>
    <td class="celda_transparente" style="text-align:left">';
?>	
        <input type='hidden' name='x_serie' id='x_serie'/>
        <meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
	<link rel="STYLESHEET" type="text/css" href="<?php echo $ruta_db_superior; ?>css/dhtmlXTree.css">
	<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/dhtmlXTree.js"></script>			
	<div id="seleccionados"></div>
                          <div id='categoria'></div>                        
                          <br />  Buscar: <input  tabindex='5'  type="text" id="stext_padre" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_padre.findItem(htmlentities(document.getElementById('stext_padre').value),1)"> <img src="botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_padre.findItem(htmlentities(document.getElementById('stext_padre').value),0,1)"><img src="botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_padre.findItem(htmlentities(document.getElementById('stext_padre').value))"><img src="botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_padre"><img src="imagenes/cargando.gif"></div><div id="treeboxbox_padre" height="90%"></div><input type="hidden"  class="required" name="padre" id="padre"  value="" ><label style="display:none" class="error" for="padre">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      //alert("<?=$valor ?>");
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_padre=new dhtmlXTreeObject("treeboxbox_padre","100%","100%",0);
                			tree_padre.setImagePath("imgs/");
                			tree_padre.enableIEImageFix(true);
                			tree_padre.enableCheckBoxes(1);
                    tree_padre.enableRadioButtons(true);
                    tree_padre.setOnLoadingStart(cargando_padre);
                      tree_padre.setOnLoadingEnd(fin_cargando_padre);
                      tree_padre.enableSmartXMLParsing(true);
                      tree_padre.loadXML('<?php echo $ruta_db_superior; ?>test_categoria.php?tipo=1');
                	        tree_padre.setOnCheckHandler(onNodeSelect_padre);
                      function onNodeSelect_padre(nodeId)
                      {valor_destino=document.getElementById("padre");

                       if(tree_padre.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_padre.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_padre() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_padre")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_padre")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_padre"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_padre() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_padre")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_padre")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_padre"]');
                        document.poppedLayer.style.display = "";
                      }
                    
                    
                    --></script>
                          
                	           
    </td>
  </tr>
  
   <tr>
    <td class="encabezado" style="text-align:left;width:20%">Estado</td>
  <td class="celda_transparente">
  	<input type="radio" value="1" name="estado" style="text-align:left" checked="yes">Activo<br>
    <input type="radio" value="2" name="estado" style="text-align:left">Inactivo</td>
  </tr>
  
  <tr>
  	<td class="encabezado">Accion</td>
  	<td><input type="radio" value="1" name="accion" checked>Adicionar nuevo registro<br>
  		<input type="radio" value="2" name="accion">Actualizar registro<br>
  		<input type="radio" value="3" name="accion">Eliminar registro
  	</td>
  </tr>
  <tr>
    <input type="hidden" name="send">
    <td colspan="2"><input type="button" value="Enviar" onclick="validar_formu1()" name="enviado">
    </td>
  </tr>
</table>
  </body>
</html>
