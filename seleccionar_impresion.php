<?php

include_once("pantallas/lib/librerias_cripto.php");
include_once("librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());


if(@$_REQUEST["iddoc"] || @$_REQUEST["key"]){
  if(!@$_REQUEST["iddoc"])$_REQUEST["iddoc"]=@$_REQUEST["key"];
  include_once("pantallas/documento/menu_principal_documento.php");
  menu_principal_documento($_REQUEST["iddoc"]);
}
include_once("db.php");
include_once("header.php");
usuario_actual("id");
?>
<script type="text/javascript" src="anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = 'anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';

function guardar_configuracion()
{parent.document.getElementById("orientacion").value=document.getElementById("orientacion").value;
 parent.document.getElementById("margenes").value=document.getElementById("mizq").value+","+document.getElementById("mder").value+","+document.getElementById("msup").value+","+document.getElementById("minf").value;
 parent.document.getElementById("font_size").value=document.getElementById("font_size").value;
 parent.document.getElementById("papel").value=document.getElementById("papel").value;
  if(document.getElementById("ocultar_firmas2").checked)
   parent.document.getElementById("ocultar_firmas").value=1;
 else
   parent.document.getElementById("ocultar_firmas").value=0;
 window.parent.hs.close();
}
    
</script>
<?php
function combo($seleccionado)
{$combo_margenes=array('1','5','10','15','20','25','30','35','40','45','50');
 for($i=0;$i<count($combo_margenes);$i++)
   {echo "<option value='".$combo_margenes[$i]."'";
    if($combo_margenes[$i]==$seleccionado)
      echo " selected ";
    echo ">".$combo_margenes[$i]."</option>";
   }
}
if(isset($_REQUEST["configurar_impresion"]))
{
?>
<b>CONFIGURAR IMPRESI&Oacute;N</b><br><br>
<form name='configurar_impresion' id='configurar_impresion' action='' method='post'>  
  <table border=0 width=100% align=center>    
    <tr>      
      <td width=40% class=encabezado>M&Aacute;RGENES</td>      
      <td bgcolor="#F5F5F5"><table><tr><td>
      Izquierda</td><td><select id="mizq" name="mizq">
		<?php combo("15"); ?>
    </select> </td></tr><tr><td>
    Derecha</td><td> <select id="mder" name="mder">
		<?php combo("20"); ?>    </select></td></tr><tr><td>
    Superior</td><td><select id="msup" name="msup">
		<?php combo("30"); ?>    </select></td></tr><tr><td>
    Inferior</td><td> <select id="minf" name="minf">
		<?php combo("20"); ?>    </select>
    </td></tr></table>
    </td>    
    </tr>      
    <tr>        
      <td class=encabezado>ORIENTACI&Oacute;N</td>                  
      <td bgcolor="#F5F5F5">
      <select name="orientacion" id="orientacion" >
      <option value="0" selected>Vertical</option>
      <option value="1">Horizontal</option>
      </select>
      </td>      
    </tr>   
    <tr>        
      <td class=encabezado>TAMA&Ntilde;O DEL PAPEL</td>        
      <td bgcolor='#F5F5F5'>
      <select name='papel' id='papel' >
      <option value='Letter' selected>Carta</option>
      <option value='Legal'>Oficio</option>
      <option value='A4'>A4</option>
      </select>
      </td>      
    </tr>       
     <tr>        
      <td class=encabezado>OCULTAR NOMBRES Y FIRMAS DE RESPONSABLES</td>        
      <td bgcolor='#F5F5F5'>
      <input type='radio' id='ocultar_firmas2' name='ocultar_firmas'  value='1'>Si
      <input type='radio' id='ocultar_firmas1' name='ocultar_firmas' value='0'>No
      </td>      
    </tr>     
   <tr>        
      <td class=encabezado>TAMA&Ntilde;O DE LETRA</td>        
      <td bgcolor='#F5F5F5'><input type='text' id='font_size' name='font_size' value=''></td>
    </tr>     
    <tr>
    <td colspan=2 align=center>
    <input type='button' value='Aplicar' onclick='guardar_configuracion();'>
    </td>      
    </tr>      
  </table>
</form>
<script>
document.getElementById("header").style.display="none";

objeto=parent.document.configuracion;
//margenes
margenes=objeto.margenes.value.split(",");
configurar_impresion.mizq.selectedIndex =(margenes[0]/5);
configurar_impresion.mder.selectedIndex =(margenes[1]/5);
configurar_impresion.msup.selectedIndex =(margenes[2]/5);
configurar_impresion.minf.selectedIndex =(margenes[3]/5);
//orientacion
if(objeto.orientacion.value=="1")
   configurar_impresion.orientacion.selectedIndex =1;
else
   configurar_impresion.orientacion.selectedIndex =0;
//tamaño de letra
configurar_impresion.font_size.value=objeto.font_size.value;
//papel
if(objeto.papel.value=="Letter")
   configurar_impresion.papel.selectedIndex =0;
else
   configurar_impresion.papel.selectedIndex =1;

if(objeto.ocultar_firmas.value==1)
   document.getElementById("ocultar_firmas2").checked =true;
else
   document.getElementById("ocultar_firmas1").checked =true;

</script>
<?php
}
else
{//menu_ordenar($_REQUEST["doc"]);
?>
<br />
<?php
//print_r($_REQUEST);
if(@$_REQUEST["doc"]){
$iddocumento=0;
$texto='<span class="phpmaker">';
if($_REQUEST["doc"]){
$iddocumento=$_REQUEST["doc"];
  $documento=busca_filtro_tabla("","documento A","iddocumento=".$iddocumento,"",$conn);
  $formato=busca_filtro_tabla("A.numero,A.descripcion AS etiqueta,B.nombre_tabla,B.idformato,B.nombre,B.margenes,B.font_size,B.papel,B.orientacion","documento A,formato B","lower(A.plantilla)=lower(B.nombre) AND A.iddocumento=".$iddocumento,"",$conn);

  if($formato["numcampos"] && $documento["numcampos"]){
    $numero=$formato[0]["numero"];
    $texto.='<b>'.strtoupper($formato[0]["nombre"]).':</b><br>';
    $texto.="Numero Radicado: ".$formato[0]["numero"]."<br>";
    $texto.=strip_tags(codifica_encabezado(html_entity_decode("Descripci&oacute;n:".stripslashes($formato[0]["etiqueta"]))),"<b>");
    $descripcion=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"]." AND acciones LIKE '%d%'","",$conn);
    if($descripcion["numcampos"]){
      $campo_descripcion=$descripcion[0]["nombre"];
    }
    else{
      $campo_descripcion="id".$formato[0]["nombre_tabla"];
    }
  $papas=busca_filtro_tabla("id".$formato[0]["nombre_tabla"]." AS llave, ".$campo_descripcion." AS etiqueta ,'".$formato[0]["nombre_tabla"]."' AS nombre_tabla",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddocumento,"",$conn);
    if($papas["numcampos"]){
      $iddoc=$formato[0]["idformato"]."-".$papas[0]["llave"]."-id".$formato[0]["nombre_tabla"];
      $llave_formato=$formato[0]["idformato"]."-id".$formato[0]["nombre_tabla"]."-".$papas[0]["llave"];
    }
    else {
      $iddoc=0;
      $llave_formato=0;
    }
    $_SESSION["iddoc"]=$formato[0]["iddocumento"];
  }
  else if($documento["numcampos"]){
    $iddoc=0;
  }
  else {
    $iddoc=0;
  }
}
else {
  alerta("No se ha podido encontrar el Documento",'error',5000);
  volver(1);
}
$_SESSION["iddoc"]=$iddocumento;

$texto.="<div align=right><label style='cursor:pointer; color:blue'><a href=\"?configurar_impresion=1\" class=\"highslide\" onclick=\"return hs.htmlExpand(this, { objectType: 'iframe',width: 400, height:280,preserveContent:false } )\">Configurar Impresi&oacute;n</a></label>&nbsp;&nbsp;&nbsp;<label name='generar' style='cursor:pointer; color:blue' onClick='generar_seleccion();'>Imprimir</label></div>
<form name='configuracion' action='' method=post>
<input type='hidden' id='margenes' value='".$formato[0]["margenes"]."'>
<input type='hidden' id='font_size' value='".$formato[0]["font_size"]."'>
<input type='hidden' id='orientacion' value='".$formato[0]["orientacion"]."'>
<input type='hidden' id='papel' value='".$formato[0]["papel"]."'>
<input type='hidden' id='ocultar_firmas' value='0'>
</form>";
if(@$_REQUEST["llave"]){
  $nodoinicial=$_REQUEST["llave"];
}
else $nodoinicial=$iddoc;
  $texto.='<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
      	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
      	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
  <table width="100%" height="400px" border="1" style="border-collapse:collapse;" >
    <tr><td bgcolor="#F5F5F5" valign=top><span class="phpmaker">
      			<div id="esperando"><img src="imagenes/cargando.gif"></div>';?>
     Buscar:<br><input type="text" id="stext" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,1)">
      <img src="botones/general/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,0,1)">
      <img src="botones/general/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value)">
      <img src="botones/general/siguiente.png"border="0px"></a>
      <script>
      	$(document).ready(function (){
      		$("input[name=seleccionar]").click(function(){ 
      				if($(this).val()==1){
	 							var list_seleccionados = tree2.getAllUnchecked();
	 							//alert(list_seleccionados); 
	      				vector=list_seleccionados.split(",");
						    for(i=0;i<vector.length;i++){
						     		tree2.setCheck(vector[i],$(this).val());
	      				}	
      				}else{
      					var list_seleccionados = tree2.getAllChecked(); 
      					//alert(list_seleccionados);
	      				vector=list_seleccionados.split(",");
						    for(i=0;i<vector.length;i++){
						     		tree2.setCheck(vector[i],$(this).val());
	      				}	
      				}
      		});
      	});
      </script>      
      <?php           
            $texto.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="seleccionar" value="1">Todos
            <input type="radio" name="seleccionar" value="0">Ninguno
            <br />
            <br />
      				<div id="treeboxbox_tree2"></div>
      	<script type="text/javascript">
        <!--
            var nivel=0;
            var browserType;
            if (document.layers) {browserType = "nn4"}
            if (document.all) {browserType = "ie"}
            if (window.navigator.userAgent.toLowerCase().match("gecko")) {
               browserType= "gecko"
            }
            tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
       			tree2.setOnLoadingStart(cargando);
            tree2.setOnLoadingEnd(fin_cargando);
      			tree2.setImagePath("imgs/");
      			tree2.enableIEImageFix(true);
      			tree2.enableCheckBoxes(1);
      			//tree2.enableThreeStateCheckboxes(true);
            tree2.enableSmartXMLParsing(true);
      			tree2.loadXML("test_seleccionar_impresion.php?id='.$iddoc.'&paginas='.$iddocumento.'");
      			tree2.setOnClickHandler(onNodeSelect);
      			function onNodeSelect(nodeId){
              var llave=0;
              llave=tree2.getParentId(nodeId);
              tree2.closeAllItems(tree2.getParentId(nodeId))
              tree2.openItem(nodeId);
              tree2.openItem(tree2.getParentId(nodeId));
              conexion="parsear_accion_arbol_impresion.php?id="+nodeId+"&accion=mostrar&llave="+llave;
              window.open(conexion,"detalles_impresion");
            }
            function fin_cargando() {
              if (browserType == "gecko" )
                 document.poppedLayer = eval('."'".'document.getElementById("esperando")'."'".');
              else if (browserType == "ie")
                 document.poppedLayer = eval('."'".'document.getElementById("esperando")'."'".');
              else
                 document.poppedLayer = eval('."'".'document.layers["esperando"]'."'".');
              document.poppedLayer.style.visibility = "hidden";
            }

            function cargando() {
              if (browserType == "gecko" )
                 document.poppedLayer = eval('."'".'document.getElementById("esperando")'."'".');
              else if (browserType == "ie")
                 document.poppedLayer = eval('."'".'document.getElementById("esperando")'."'".');
              else
                 document.poppedLayer = eval('."'".'document.layers["esperando"]'."'".');
              document.poppedLayer.style.visibility = "visible";
            }
            function generar_seleccion(){
              var list_seleccionados = tree2.getAllChecked();              
              var list_medios= tree2.getAllPartiallyChecked();
              var selectos="";
              if(list_seleccionados == "")
                selectos=list_medios;
              else
                selectos=list_seleccionados+","+list_medios;
              if(selectos=="" || !selectos){
              	alert("Seleccione algun item del arbol para imprimir");
              	return false;
              }  
              ';
              $exportar_pdf=busca_filtro_tabla("valor","configuracion A","A.nombre='exportar_pdf'","",$conn);
							if($exportar_pdf[0]["valor"]=='html2ps'){
              	$texto.='window.open("exportar_impresion.php?seleccionados="+selectos+"&iddoc='.$iddocumento.'&margenes="+configuracion.margenes.value+"&font_size="+configuracion.font_size.value+"&orientacion="+configuracion.orientacion.value+"&papel="+configuracion.papel.value+"&ocultar_firmas="+configuracion.ocultar_firmas.value,"_blank");';
							}
							if($exportar_pdf[0]["valor"]=='class_impresion'){
              	$texto.='window.open("exportar_seleccionar_impresion.php?seleccion="+selectos+"&iddoc='.$iddocumento.'&margenes="+configuracion.margenes.value+"&font_size="+configuracion.font_size.value+"&orientacion="+configuracion.orientacion.value+"&papel="+configuracion.papel.value+"&ocultar_firmas="+configuracion.ocultar_firmas.value,"_blank");';
							}
            $texto.='}
      	-->
      	</script>
      </td>
      <td valign="top" >
        <iframe name="detalles_impresion" id="detalles_impresion" src="vacio.php" frameborder="0" width="100%" scrolling="auto" height="100%"></iframe>
      </td>
    </tr>
  </table>';
	echo($texto);
}
}
encriptar_sqli("configurar_impresion",1);
include_once("footer.php");
?>