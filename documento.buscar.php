<html>
  <body>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
<?php
include_once("db.php");
include_once("header.php");
include_once("calendario/calendario.php");
include_once("formatos/librerias/funciones_generales.php");
$config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn);
$_SESSION["punto_retorno"]="documento.buscar.php";
//revisar compatibilidad de estilos
      ?>
      <link rel="stylesheet" type="text/css" href="css/style_fcbkcomplete.css"/>
      <link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
      <link rel="stylesheet" type="text/css" href="dropdownlist/ui.dropdownchecklist.css" />
<script type="text/javascript" src="dropdownlist/jquery.js"></script>
<script type="text/javascript" src="js/interface.js"></script>
<script type="text/javascript" src="js/jquery.fcbkcomplete.js"></script>
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<script type="text/javascript" src="dropdownlist/ui.core.js"></script>
<script type="text/javascript" src="dropdownlist/ui.dropdownchecklist.js"></script>
<script language="javascript" type="text/javascript">
function EW_checkMyForm(f)
{
if(typeof(tree3) != undefined){
  document.getElementById('x_serie').value= codificar_repetidos(tree3.getAllChecked());
 }
if(typeof(tree_st) != undefined){
  document.getElementById('x_serie_total').value= codificar_repetidos(tree_st.getAllChecked());
 }
 if(typeof(tree_trans) != 'undefined'){
  document.getElementById('x_transferido').value=codificar_repetidos(tree_trans.getAllChecked());
 }
 if(typeof(tree_trans2) != 'undefined'){
  document.getElementById('x_transferido2').value=codificar_repetidos(tree_trans2.getAllChecked());
 }
 if(typeof(tree_aprobado) != 'undefined'){
  document.getElementById('x_aprobado').value= codificar_repetidos(tree_aprobado.getAllChecked());
 }
 if(typeof(tree_ejecutor) != 'undefined'){
  document.getElementById('x_ejecutor1').value= codificar_repetidos(tree_ejecutor.getAllChecked());
 }
return(true);
}
function codificar_repetidos(lista)
{vector=lista.split(",");
 for(i=0;i<vector.length;i++)
    {if(vector[i].indexOf("_")!=-1)
       {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
       }
    }
 return(vector.join(','));
}
</script>
      <style type="text/css" media="all">  * { margin: 0; 	padding: 0; }    body { background: #ffffff; 	height: 100%; 	font-family: Arial, Helvetica, sans-serif; 	font-size: 12px; }    #myAccordion{ 	width: 95%; 	border: 1px solid #F5F5F5; 	position: absolute; 	left: 10px; 	background-color:#ffffff; }    #myAccordion dt{ 	line-height: 20px; 	background-color:
        <?php echo($config[0]["valor"]); ?>  ; 	border-top: 2px solid #ffffff; 	border-bottom: 2px solid #000000; 	padding: 0 10px; 	font-weight: bold; 	color: #ffffff; }    #myAccordion dd{ 	overflow: auto; }    #myAccordion p{ 	margin: 16px 10px; }    #myAccordion dt.myAccordionHover { 	background-color: #000077; }    #myAccordion dt.myAccordionActive { 	background-color:
        <?php echo($config[0]["valor"]); ?>  ; 	border-top: 2px solid #ffffff; 	border-bottom: 2px solid #000000; }
      </style>
    </head>
    <body>
      <br><b>BUSQUEDA DE DOCUMENTOS</b>
      <br>
      <br>
      <form method="POST" name="fomulario_busqueda" id="fomulario_busqueda" action="documento.busqueda.php" onSubmit="return EW_checkMyForm(this);"><br />
        <div style="clear:both;">
          <input type="submit" id="accion" value="Buscar documento"> de
          <input type='radio' id='x_tipo_documento1' name='x_tipo_documento' value='1'>Radicaci&oacute;n Entrada
          <input type='radio' id='x_tipo_documento3' name='x_tipo_documento' value='3'>Radicaci&oacute;n Salida
          <input type='radio' id='x_tipo_documento2' name='x_tipo_documento' value='2'>Formato Interno
<?php
        if(@$_REQUEST["pagina_exp"])
          echo '<input type="hidden" name="pagina_exp" value="'.$_REQUEST["pagina_exp"].'">' ;
        if(@$_REQUEST["vincular_documento"])
          echo '<input type="hidden" name="vincular_documento" value="'.$_REQUEST["vincular_documento"].'">' ;
        $busquedas=busca_filtro_tabla("","busqueda_usuario","funcionario='".usuario_actual("funcionario_codigo")."'","lower(etiqueta)",$conn);
        $radicador = new PERMISO();
        $permiso = false;
        $permiso=$radicador->acceso_modulo_perfil("permiso_busqueda_general");
        if($permiso)
          echo "<b>Perteneciente a </b><input type='radio' name='x_busqueda_general' value='1' checked>Busqueda general&nbsp;&nbsp;<input type='radio' name='x_busqueda_general' value='0'>Documentos Usuario";
        else
          echo "<input type='hidden' name='x_busqueda_general' value='0'> ";
        echo  "<br><br><table border=1 width='90%' style='border-collapse:collapse'>
                <tr class='encabezado_list'><td>Guardar busqueda como</td>
                <td>Busquedas Guardadas</td>
                </tr>
                <tr align='center'><td><input type='text' name='etiqueta_busqueda' id='etiqueta_busqueda'></td>
                <td><select id='busqueda_usuario' >
                <option value=''>Seleccionar...</option>";
         for($i=0;$i<$busquedas["numcampos"];$i++)
            {echo "<option value='".$busquedas[$i]["idbusqueda_usuario"]."'>".$busquedas[$i]["etiqueta"]."</option>";
            }
         echo "</select><img src='botones/comentarios/eliminar.png' onclick='eliminar_busqueda()'></td></tr></table>";
         ?>
         <script>
         function limpiar_formulario()
         {$("#fomulario_busqueda")[0].reset();
          tree_ejecutor.setSubChecked(0, 0);
          tree3.setSubChecked(0, 0);
          tree_trans.setSubChecked(0, 0);
          tree_aprobado.setSubChecked(0, 0);
          $("#x_asunto").empty();
          $("#x_numero").empty();
          $("#x_oficio").empty();
          $("#x_nombre_remitente").empty();
          $("#x_anexo").empty();
          $("#ejecutor2").empty();
          $(".bit-box").remove();
         }
         $("#etiqueta_busqueda").blur(function(){
          $.ajax({
              url: 'documento.busqueda_guardada.php?etiqueta='+$("#etiqueta_busqueda").val(),
              success: function(data) {
               if(data==-1)
                 {alert('<?php echo codifica_encabezado("El m�ximo de busquedas guardadas es 15, por favor borre alguna si desea crear una nueva."); ?>');
                  $("#etiqueta_busqueda").val("");
                 }
               else if(data>0)
                 {pregunta=confirm("Ya existe una busqueda guardada con ese nombre, desea reemplazarla?");
                  if(!pregunta)
                    $("#etiqueta_busqueda").val("");
                 }
              }
            });
         });

         function eliminar_busqueda()
         {busqueda=$("#busqueda_usuario option:selected").val();
          if(busqueda!="")
            {$.ajax({
              url: 'documento.busqueda_guardada.php?borrar_busqueda='+busqueda,
              success: function(data) {
               if(data==0)
                {alert("Busqueda Eliminada.");
                 $("#busqueda_usuario option[value="+busqueda+"]").remove();
                }
               else
                 alert("Problemas al eliminar la busqueda.");
              }
            });
            }
          else
            alert("Por favor seleccione una busqueda guardada previamente.");
         }

         $().ready(function() {
          $("#busqueda_usuario").change(
         function(){
         busqueda=$("#busqueda_usuario option:selected").val();
        if(busqueda!="")
          {$.ajax({
              url: 'documento.busqueda_guardada.php?idbusqueda='+busqueda,
              success: function(data) {
              limpiar_formulario();
               $("#busqueda_usuario option[value="+busqueda+"]").attr("selected","selected");
                vector=data.split("||");
                for(i=0;i<(vector.length-1);i++)
                  {fila=vector[i].split("|");
                   if(fila[0]=="x_tipo_documento")
                     $("#"+fila[0]+fila[1]).click();
                   else if(fila[0]=="x_busqueda_general")
                     {if($("#"+fila[0]+fila[1]).attr("type")=="radio")
                        $("#"+fila[0]+fila[1]).attr("checked","checked");
                     }
                   else if(fila[0]=="plantilla")
                     $("#"+fila[0]+" option[value="+fila[1]+"]").attr("selected","selected");
                   else if(fila[0]=="x_ejecutor1")
                     {fila[1]=fila[1].replace(/\,{2,}(d)*/gi,",");
                      fila[1]=fila[1].replace(/\,$/gi,"");
                      tree_ejecutor.setCheck(fila[1],true);
                     }
                  else if(fila[0]=="x_aprobado")
                     {fila[1]=fila[1].replace(/\,{2,}(d)*/gi,",");
                      fila[1]=fila[1].replace(/\,$/gi,"");
                      tree_aprobado.setCheck(fila[1],true);
                     }
                 else if(fila[0]=="x_transferido")
                     {fila[1]=fila[1].replace(/\,{2,}(d)*/gi,",");
                      fila[1]=fila[1].replace(/\,$/gi,"");
                      tree_trans.setCheck(fila[1],true);
                     }
                   else if(fila[0]=="x_serie")
                     {fila[1]=fila[1].replace(/\,{2,}(d)*/gi,",");
                      fila[1]=fila[1].replace(/\,$/gi,"");
                      tree3.setCheck(fila[1],true);
                     }
                   else if(fila[0]=="x_serie_total")
                     {fila[1]=fila[1].replace(/\,{2,}(d)*/gi,",");
                      fila[1]=fila[1].replace(/\,$/gi,"");
                      tree3.setCheck(fila[1],true);
                     }
                   else if(fila[0]=="x_fecha_aprobacion1" || fila[0]=="x_fecha_aprobacion2" || fila[0]=="x_fecha_borrador1" || fila[0]=="x_fecha_borrador2" || fila[0]=="x_fecha_transferencia1" || fila[0]=="x_fecha_transferencia2"|| fila[0]=="campos_formato")
                     {
                      $("#"+fila[0]).val(fila[1]);
                     }
                   else if(fila[0]=="x_asunto" || fila[0]=="x_numero" || fila[0]=="x_nombre_remitente" || fila[0]=="x_anexo" || fila[0]=="ejecutor2")
                     {valores=fila[1].split("@@");
                      for(j=0;j<valores.length;j++)
                        $("#"+fila[0]).trigger("addItem",[{"title": valores[j], "value": valores[j]}]);
                     }
                  }
              }
            });
          }
         })
});
         </script>
        <br />
        </div>
        <br />
        <div >
          <dl id="myAccordion">
            <dt>Datos B&aacute;sicos
            </dt>
            <dd>
              <div id="div1">    <br />
                <table border="1px" width="100%">
                  <tr>
                    <td width="50%" class="encabezado">N&uacute;mero</td>        <td>
                      <select name="x_numero" id="x_numero" >
                      </select>                             </td>
                  </tr>
                  <tr id="oficio_entrante">
                    <td width="50%" class="encabezado">N&uacute;mero de oficio entrante</td>        <td>
                      <select name="x_oficio" id="x_oficio" >
                      </select>                             </td>
                  </tr>
                  <tr id="tr_ciudad_origen">
                    <td width="50%" class="encabezado">Ciudad de origen</td>        <td>
                      <select name="x_municipio" id="x_municipio" >
                      <option value="">Seleccionar...</option>
                      <?php
                      $municipios=busca_filtro_tabla("distinct idmunicipio,municipio.nombre,departamento.nombre as nomdep","municipio,documento,departamento","tipo_radicado=1 and departamento_iddepartamento=iddepartamento and municipio_idmunicipio=idmunicipio","lower(municipio.nombre) asc",$conn);
                      for($i=0;$i<$municipios["numcampos"];$i++)
                        echo "<option value='".$municipios[$i]["idmunicipio"]."'>".$municipios[$i]["nombre"]." (".$municipios[$i]["nomdep"].")</option>"
                      ?>
                      </select>
                    </td>
                  </tr>
                  <tr id="fecha_borrador">
                    <td class="encabezado">Fecha del Borrador</td>        <td>Entre
                      <input type="text" name="x_fecha_borrador1" id="x_fecha_borrador1" value="" size="22">
                      <?php selector_fecha("x_fecha_borrador1","0","Y-m-d H:i:s",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,7,00,"AM"); ?>         Y
                      <input type="text" name="x_fecha_borrador2" id="x_fecha_borrador2" value="" size="22">
                      <?php selector_fecha("x_fecha_borrador2","0","Y-m-d H:i:s",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,7,00,"AM");?>         </td>
                  </tr>
                  <tr>
                    <td class="encabezado">Fecha del documento
                      <br>(Entrada/Aprobaci&oacute;n)</td>        <td>Entre
                      <input type="text" name="x_fecha_aprobacion1" id="x_fecha_aprobacion1" value="" size="22">
                      <?php selector_fecha("x_fecha_aprobacion1","0","Y-m-d H:i:s",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,7,00,"AM");?>         Y
                      <input type="text" name="x_fecha_aprobacion2" id="x_fecha_aprobacion2" value="" size="22">
                      <?php selector_fecha("x_fecha_aprobacion2","0","Y-m-d H:i:s",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,7,00,"AM");?>         </td>
                  </tr>
                  <tr id="creador">
                    <td class="encabezado">Creador del documento</td><td>
                      <input type='hidden' name='x_ejecutor1' id='x_ejecutor1'/>  			  Buscar:
                      <br>
                      <input type="text" id="stext2" width="200px" size="20">
                      <a href="javascript:void(0)" onclick="tree_ejecutor.findItem(document.getElementById('stext2').value,1)">
                        <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
                      <a href="javascript:void(0)" onclick="tree_ejecutor.findItem(document.getElementById('stext2').value,0,1)">
                        <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
                      <a href="javascript:void(0)" onclick="tree_ejecutor.findItem(document.getElementById('stext2').value)">
                        <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a><br />          <br />
                      <div id="esperando_func2">
                        <img src="imagenes/cargando.gif">
                      </div>
                      <div id="treeboxbox_tree_ejecutor">
                      </div>
<script type="text/javascript">
                      <!--
                    		var browserType;
                        if (document.layers) {browserType = "nn4"}
                        if (document.all) {browserType = "ie"}
                        if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                           browserType= "gecko"
                        }
                  			tree_ejecutor=new dhtmlXTreeObject("treeboxbox_tree_ejecutor","100%","100%",0);
                  			tree_ejecutor.setImagePath("imgs/");
                  			tree_ejecutor.enableIEImageFix(true);
                  			tree_ejecutor.enableCheckBoxes(1);
                  			tree_ejecutor.setOnLoadingStart(cargando_func);
                        tree_ejecutor.setOnLoadingEnd(fin_cargando_func);
                  			tree_ejecutor.enableThreeStateCheckboxes(true);
                        tree_ejecutor.enableSmartXMLParsing(true);
                  			tree_ejecutor.loadXML("test.php?inactivos=1");
                  			function fin_cargando_func() {
                          if (browserType == "gecko" )
                             document.poppedLayer =
                                 eval('document.getElementById("esperando_func2")');
                          else if (browserType == "ie")
                             document.poppedLayer =
                                eval('document.getElementById("esperando_func2")');
                          else
                             document.poppedLayer =
                                eval('document.layers["esperando_func2"]');
                          document.poppedLayer.style.display = "none";
                        }
                        function cargando_func() {
                          if (browserType == "gecko" )
                             document.poppedLayer =
                                 eval('document.getElementById("esperando_func2")');
                          else if (browserType == "ie")
                             document.poppedLayer =
                                eval('document.getElementById("esperando_func2")');
                          else
                             document.poppedLayer =
                                 eval('document.layers["esperando_func2"]');
                          document.poppedLayer.style.display = "";
                        }
                  	  -->
              	      </script>                              </td>
                  </tr>
                  <tr id="remitente">
                    <td class="encabezado">Remitente Externo</td>                    <td>                      Nombre del Remitento Externo
                      <select name="x_ejecutor2" id="ejecutor2">
                      </select>                    </td>
                  </tr>
                  <tr id="plantillas">
                    <td class="encabezado">Plantilla</td>                  <td>
<?php
$plantillas = busca_filtro_tabla("nombre,etiqueta,nombre_tabla", "formato", "mostrar=1", "etiqueta", $conn);
if ($plantillas["numcampos"] > 0) {
	echo "<select name='plantilla' id='plantilla' ><option value='' >Seleccionar...</option>";
	for($i = 0; $i < $plantillas["numcampos"]; $i++)
		echo "<option value='" . $plantillas[$i]["nombre_tabla"] . "' title=\"" . $plantillas[$i]["nombre"] . "\">" . $plantillas[$i]["etiqueta"] . "</option>";
	echo "</select>";
}

?>
                      <div id="busqueda_interna">
                      </div>
<script type="text/javascript" src="anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
                      <link rel="stylesheet" type="text/css" href="anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = 'anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<script>
	$().ready(function() {
		$("#link_buscador").click(function() {
			formato=$("#plantilla option:selected").attr('title');
			if(formato!="") {
				$("#link_buscador").attr("href","<?php echo FORMATOS_CLIENTE ;?>"+formato+"/buscar_"+formato+".php?campo__retorno=campos_formato");
				return hs.htmlExpand(this, { objectType: 'iframe',width: 700, height:500,preserveContent:false} );
			} else {
				alert("Por favor seleccione una plantilla");
			}
		});
	});

                   </script>
                      <a class="highslide" name="link_buscador" id="link_buscador" >Campos dentro de la plantilla</a>
                      <input type="hidden" id="campos_formato" name="campos_formato" value="">                          </td>
                  </td>
                  </tr>
                  <tr>
                    <td class="encabezado" title="Buscar documentos seg&uacute;n la clasificaci&oacute;n (Serie Documental)">Clasificaci&oacute;n</td>                             <td>
                      <input type='hidden' name='x_serie' id='x_serie'/>  			  Buscar:
                      <br>
                      <input type="text" id="stext" width="200px" size="20">
                      <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext').value,1)">
                        <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
                      <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext').value,0,1)">
                        <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
                      <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext').value)">
                        <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a><br />          <br />
                      <div id="esperando_func">
                        <img src="imagenes/cargando.gif">
                      </div>
                      <div id="treeboxbox_tree3">
                      </div>
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
                  			tree3.enableCheckBoxes(1);
                  			tree3.enableRadioButtons(true);
                  			tree3.setOnLoadingStart(cargando_func);
                        tree3.setOnLoadingEnd(fin_cargando_func);
                        tree3.enableSmartXMLParsing(true);
                  			tree3.loadXML("test_serie.php?tabla=serie");
                  			tree3.setOnCheckHandler(onNodeSelect_tree3);
                  			function onNodeSelect_tree3(nodeId){
                          valor_destino=document.getElementById("x_serie");
                          if(tree3.isItemChecked(nodeId)){
                            if(valor_destino.value!=="")
                              tree3.setCheck(valor_destino.value,false);
                              if(nodeId.indexOf("_")!=-1)
                                nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                              valor_destino.value=nodeId;
                          }
                          else{
                            valor_destino.value="";
                          }
                        }
                  			function fin_cargando_func() {
                          if (browserType == "gecko" )
                             document.poppedLayer =
                                 eval('document.getElementById("esperando_func")');
                          else if (browserType == "ie")
                             document.poppedLayer =
                                eval('document.getElementById("esperando_func")');
                          else
                             document.poppedLayer =
                                eval('document.layers["esperando_func"]');
                          document.poppedLayer.style.display = "none";
                        }
                        function cargando_func() {
                          if (browserType == "gecko" )
                             document.poppedLayer =
                                 eval('document.getElementById("esperando_func")');
                          else if (browserType == "ie")
                             document.poppedLayer =
                                eval('document.getElementById("esperando_func")');
                          else
                             document.poppedLayer =
                                 eval('document.layers["esperando_func"]');
                          document.poppedLayer.style.display = "";
                        }
                  	  -->
              	      </script>                              </td>
                  </tr>
                  <?php
                    $ok=new PERMISO();
                    $permiso = false;
                    $permiso=$ok->acceso_modulo_perfil("busqueda_total_series");
                    if($permiso==1){
                  ?>
                  <tr>
                    <td class="encabezado" title="Buscar documentos seg&uacute;n la clasificaci&oacute;n (En todos los documentos seg&uacute;n la serie)">Clasificaci&oacute;n General</td>
                    <td>
                      <a href="Javascript:seleccionar_todos(1)">Seleccionar Todos</a>
                      <a href="Javascript:seleccionar_todos(0)">Quitar Todos</a> <br />
                      <input type='hidden' name='x_serie_total' id='x_serie_total'/>  			  Buscar:
                      <br>
                      <input type="text" id="stext_total" width="200px" size="20">
                      <a href="javascript:void(0)" onclick="tree_St.findItem(document.getElementById('stext_total').value,1)">
                        <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
                      <a href="javascript:void(0)" onclick="tree_st.findItem(document.getElementById('stext_total').value,0,1)">
                        <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
                      <a href="javascript:void(0)" onclick="tree_st.findItem(document.getElementById('stext_total').value)">
                        <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a><br />          <br />
                      <div id="esperando_func_st">
                        <img src="imagenes/cargando.gif">
                      </div>
                      <div id="treeboxbox_tree_serie_total">
                      </div>
                      <script type="text/javascript">
                      <!--
                    		var browserType;
                        if (document.layers) {browserType = "nn4"}
                        if (document.all) {browserType = "ie"}
                        if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                           browserType= "gecko"
                        }
                  			tree_st=new dhtmlXTreeObject("treeboxbox_tree_serie_total","100%","100%",0);
                  			tree_st.setImagePath("imgs/");
                  			tree_st.enableIEImageFix(true);
                  			tree_st.enableCheckBoxes(1);
                  			//tree_st.enableRadioButtons(true);
                  			tree_st.setOnLoadingStart(cargando_func);
                        tree_st.setOnLoadingEnd(fin_cargando_func);
                        tree_st.enableSmartXMLParsing(true);
                  			tree_st.loadXML("test_serie_funcionario.php");
                  			tree_st.setOnCheckHandler(onNodeSelect_tree_st);
                  			function onNodeSelect_tree_st(nodeId)
                      {valor_destino=document.getElementById("x_serie_total");
                       destinos=tree_st.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_st.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");

                               for(h=0;h<vectorh.length;h++)
                                  {if(vectorh[h].indexOf("_")!=-1)
                                      vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
                                   nuevo=eliminarItem(nuevo,vectorh[h]);
                                  }
                              }
                          }
                       nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       valor_destino.value=nuevo;
                      }
                      function seleccionar_todos(tipo)
                        {lista=tree_st.getAllChildless();
                         vector=lista.split(",");
                         for(i=0;i<vector.length;i++)
                          {tree_st.setCheck(vector[i],tipo);
                          }
                         document.getElementById("x_serie_total").value=tree_st.getAllChecked();
                        }
                  			/*function onNodeSelect_tree3(nodeId){
                          valor_destino=document.getElementById("x_serie_total");
                          if(tree_st.isItemChecked(nodeId)){
                            if(valor_destino.value!=="")
                              tree_st.setCheck(valor_destino.value,false);
                              if(nodeId.indexOf("_")!=-1)
                                nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                              valor_destino.value=nodeId;
                          }
                          else{
                            valor_destino.value="";
                          }
                        }*/
                  			function fin_cargando_func() {
                          if (browserType == "gecko" )
                             document.poppedLayer =
                                 eval('document.getElementById("esperando_func_st")');
                          else if (browserType == "ie")
                             document.poppedLayer =
                                eval('document.getElementById("esperando_func_st")');
                          else
                             document.poppedLayer =
                                eval('document.layers["esperando_func_st"]');
                          document.poppedLayer.style.display = "none";
                          seleccionar_todos(1);
                        }
                        function cargando_func() {
                          if (browserType == "gecko" )
                             document.poppedLayer =
                                 eval('document.getElementById("esperando_func_st")');
                          else if (browserType == "ie")
                             document.poppedLayer =
                                eval('document.getElementById("esperando_func_st")');
                          else
                             document.poppedLayer =
                                 eval('document.layers["esperando_func_st"]');
                          document.poppedLayer.style.display = "";
                        }
                  	  -->
              	      </script>
                    </td>
                  </tr>
                  <?php }?>
                  <tr>
                    <td class="encabezado">Descripci&oacute;n o Asunto</td>        <td>
                      <select name="x_asunto" id="x_asunto" name="x_asunto">
                      </select>        </td>
                  </tr>
                  <tr>
                    <td class="encabezado">Etiqueta</td> <td>
                      <select name="x_etiqueta[]" id="x_etiqueta" multiple='multiple'>
<?php
                        $listado_etiquetas=busca_filtro_tabla("","etiqueta","funcionario=".usuario_actual("funcionario_codigo"),"",$conn);
                        for($i=0;$i<$listado_etiquetas["numcampos"];$i++){
                          echo('<option value="'.$listado_etiquetas[$i]["idetiqueta"].'">'.$listado_etiquetas[$i]["nombre"].'</option>');
                        }
                                              ?>
                      </select></td>
                  </tr>
                  <tr>
                    <td class="encabezado">Anexos</td>        <td>
                      <select name="x_anexo" id="x_anexo" name="x_anexo">
                      </select>        </td>
                  </tr>
                </table>
              </div>
            </dd>
            <dt >Transferidos y/o pertenecientes a Rutas
            </dt>
            <dd>
              <div id="div3">
                <br>
                <br>
                <table border="1px" width="100%">
                  <tr>
                    <td width="50%" class="encabezado">Tranferido a</td>
                    <td >
                      <input type='hidden' name='x_transferido' id='x_transferido'/>  			  Buscar:
                      <br>
                      <input type="text" id="stexttrans" width="200px" size="20">
                      <a href="javascript:void(0)" onclick="tree_trans.findItem(document.getElementById('stexttrans').value,1)">
                        <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
                      <a href="javascript:void(0)" onclick="tree_trans.findItem(document.getElementById('stexttrans').value,0,1)">
                        <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
                      <a href="javascript:void(0)" onclick="tree_trans.findItem(document.getElementById('stexttrans').value)">
                        <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a><br />          <br />
                      <div id="esperando_trans">
                        <img src="imagenes/cargando.gif">
                      </div>
                      <div id="treeboxbox_tree_trans">
                      </div>
<script type="text/javascript">
                      <!--
                    		var browserType;
                        if (document.layers) {browserType = "nn4"}
                        if (document.all) {browserType = "ie"}
                        if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                           browserType= "gecko"
                        }
                  			tree_trans=new dhtmlXTreeObject("treeboxbox_tree_trans","100%","100%",0);
                  			tree_trans.setImagePath("imgs/");
                  			tree_trans.enableIEImageFix(true);
                  			tree_trans.enableCheckBoxes(1);
                  			tree_trans.setOnLoadingStart(cargando_func2);
                        tree_trans.setOnLoadingEnd(fin_cargando_func2);
                  			tree_trans.enableThreeStateCheckboxes(true);
                        tree_trans.enableSmartXMLParsing(true);
                  			tree_trans.loadXML("test.php?inactivos=1");
                  			function fin_cargando_func2() {
                          if (browserType == "gecko" )
                             document.poppedLayer =
                                 eval('document.getElementById("esperando_trans")');
                          else if (browserType == "ie")
                             document.poppedLayer =
                                eval('document.getElementById("esperando_trans")');
                          else
                             document.poppedLayer =
                                eval('document.layers["esperando_trans"]');
                          document.poppedLayer.style.display = "none";
                        }
                        function cargando_func2() {
                          if (browserType == "gecko" )
                             document.poppedLayer =
                                 eval('document.getElementById("esperando_trans")');
                          else if (browserType == "ie")
                             document.poppedLayer =
                                eval('document.getElementById("esperando_trans")');
                          else
                             document.poppedLayer =
                                 eval('document.layers["esperando_trans"]');
                          document.poppedLayer.style.display = "";
                        }
                  	  -->
              	      </script>                              </td>
                  </tr>
                                     <tr>
                    <td width="50%" class="encabezado">Tranferido por</td>
                    <td >
                      <input type='hidden' name='x_transferido2' id='x_transferido2'/>  			  Buscar:
                      <br>
                      <input type="text" id="stexttrans2" width="200px" size="20">
                      <a href="javascript:void(0)" onclick="tree_trans2.findItem(document.getElementById('stexttrans2').value,1)">
                        <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
                      <a href="javascript:void(0)" onclick="tree_trans2.findItem(document.getElementById('stexttrans2').value,0,1)">
                        <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
                      <a href="javascript:void(0)" onclick="tree_trans2.findItem(document.getElementById('stexttrans2').value)">
                        <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a><br />          <br />
                      <div id="esperando_trans2">
                        <img src="imagenes/cargando.gif">
                      </div>
                      <div id="treeboxbox_tree_trans2">
                      </div>
                      <script type="text/javascript">
                      <!--
                    		var browserType;
                        if (document.layers) {browserType = "nn4"}
                        if (document.all) {browserType = "ie"}
                        if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                           browserType= "gecko"
                        }
                  			tree_trans2=new dhtmlXTreeObject("treeboxbox_tree_trans2","100%","100%",0);
                  			tree_trans2.setImagePath("imgs/");
                  			tree_trans2.enableIEImageFix(true);
                  			tree_trans2.enableCheckBoxes(1);
                  			tree_trans2.setOnLoadingStart(cargando_func22);
                        tree_trans2.setOnLoadingEnd(fin_cargando_func22);
                  			tree_trans2.enableThreeStateCheckboxes(true);
                        tree_trans2.enableSmartXMLParsing(true);
                  			tree_trans2.loadXML("test.php?inactivos=1");
                  			function fin_cargando_func22() {
                          if (browserType == "gecko" )
                             document.poppedLayer =
                                 eval('document.getElementById("esperando_trans2")');
                          else if (browserType == "ie")
                             document.poppedLayer =
                                eval('document.getElementById("esperando_trans2")');
                          else
                             document.poppedLayer =
                                eval('document.layers["esperando_trans2"]');
                          document.poppedLayer.style.display = "none";
                        }
                        function cargando_func22() {
                          if (browserType == "gecko" )
                             document.poppedLayer =
                                 eval('document.getElementById("esperando_trans2")');
                          else if (browserType == "ie")
                             document.poppedLayer =
                                eval('document.getElementById("esperando_trans2")');
                          else
                             document.poppedLayer =
                                 eval('document.layers["esperando_trans2"]');
                          document.poppedLayer.style.display = "";
                        }
                  	  -->
              	      </script>
                    </td>
                  </tr>
                  <tr>
                    <td class="encabezado">Fecha de Transferencia</td>        <td>Entre
                      <input type="text" name="x_fecha_transferencia1" id="x_fecha_transferencia1" value="" size="22">
                      <?php selector_fecha("x_fecha_transferencia1","0","Y-m-d H:i:s",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,7,00,"AM");?>         Y
                      <input type="text" name="x_fecha_transferencia2" id="x_fecha_transferencia2" value="" size="22">
                      <?php selector_fecha("x_fecha_transferencia2","0","Y-m-d H:i:s",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,7,00,"AM");?>         </td>
                  </tr>
                  <tr id="aprobacion">
                    <td width="50%" class="encabezado">Aprobado/Revisado por</td>
                    <td >
                      <input type='hidden' name='x_aprobado' id='x_aprobado'/>  			  Buscar:
                      <br>
                      <input type="text" id="stext3" width="200px" size="20">
                      <a href="javascript:void(0)" onclick="tree_aprobado.findItem(document.getElementById('stext3').value,1)">
                        <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
                      <a href="javascript:void(0)" onclick="tree_aprobado.findItem(document.getElementById('stext3').value,0,1)">
                        <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
                      <a href="javascript:void(0)" onclick="tree_aprobado.findItem(document.getElementById('stext3').value)">
                        <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a><br />          <br />
                      <div id="esperando_func3">
                        <img src="imagenes/cargando.gif">
                      </div>
                      <div id="treeboxbox_tree_aprobado">
                      </div>
<script type="text/javascript">
                      <!--
                    		var browserType;
                        if (document.layers) {browserType = "nn4"}
                        if (document.all) {browserType = "ie"}
                        if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                           browserType= "gecko"
                        }
                  			tree_aprobado=new dhtmlXTreeObject("treeboxbox_tree_aprobado","100%","100%",0);
                  			tree_aprobado.setImagePath("imgs/");
                  			tree_aprobado.enableIEImageFix(true);
                  			tree_aprobado.enableCheckBoxes(1);
                  			tree_aprobado.setOnLoadingStart(cargando_func3);
                        tree_aprobado.setOnLoadingEnd(fin_cargando_func3);
                  			tree_aprobado.enableThreeStateCheckboxes(true);
                        tree_aprobado.enableSmartXMLParsing(true);
                  			tree_aprobado.loadXML("test.php?inactivos=1");
                  			function fin_cargando_func3() {
                          if (browserType == "gecko" )
                             document.poppedLayer =
                                 eval('document.getElementById("esperando_func3")');
                          else if (browserType == "ie")
                             document.poppedLayer =
                                eval('document.getElementById("esperando_func3")');
                          else
                             document.poppedLayer =
                                eval('document.layers["esperando_func3"]');
                          document.poppedLayer.style.display = "none";
                        }
                        function cargando_func3() {
                          if (browserType == "gecko" )
                             document.poppedLayer =
                                 eval('document.getElementById("esperando_func3")');
                          else if (browserType == "ie")
                             document.poppedLayer =
                                eval('document.getElementById("esperando_func3")');
                          else
                             document.poppedLayer =
                                 eval('document.layers["esperando_func3"]');
                          document.poppedLayer.style.display = "";
                        }
                  	  -->
              	      </script>
                      </td>
                  </tr>
                </table>
              </div>
            </dd>
        </div>
      </form>
<script type="text/javascript">
      var estado = new Array();
      	$(document).ready(
      		function()
      		{
      			$('#myAccordion').Accordion(
      				{
      					headerSelector	: 'dt',
      					panelSelector	: 'dd',
      					activeClass		: 'myAccordionActive',
      					hoverClass		: 'myAccordionHover',
      					panelHeight		: 300,
      					speed			: 300
      				}
      			);
      			$("#x_nombre_remitente").fcbkcomplete({
      			  complete_text:'Presione la tecla enter para ingresar una nueva palabra',
              newel: true
            });
            $("#x_numero").fcbkcomplete({
              complete_text:'Presione la tecla enter para ingresar un nuevo valor',
              newel: true
            });
            $("#x_oficio").fcbkcomplete({
              complete_text:'Presione la tecla enter para ingresar un nuevo valor',
              newel: true
            });
            $("#x_asunto").fcbkcomplete({
              complete_text:'Presione la tecla enter para ingresar una nueva palabra',
              newel: true
            });
            $("#x_anexo").fcbkcomplete({
              complete_text:'Presione la tecla enter para ingresar una nueva palabra',
              newel: true
            });
            $("#ejecutor2").fcbkcomplete({
              complete_text:'Presione la tecla enter para ingresar una nueva palabra vinculada con el Remitente Externo',
              newel:true
            });
            $("#x_tipo_documento1").click(function(){
              $("#plantillas").hide();
              $("#campos_formato").val("");
              $("#creador").hide();
              $("#creador").val("");
              $("#fecha_borrador").hide();
              $("#fecha_borrador").val("");
              $("#remitente").show();
              $("#aprobacion").hide();
              $("#treeboxbox_tree_aprobado").hide();
              $("#tr_ciudad_origen").show();
              $("#oficio_entrante").show();
            });
            $("#x_tipo_documento2").click(function(){
              $("#plantillas").show();
              $("#creador").show();
              $("#fecha_borrador").show();
              $("#remitente").hide();
              $("#remitente").val("");
              $("#aprobacion").show();
              $("#treeboxbox_tree_aprobado").show();
              $("#tr_ciudad_origen").hide();
              $("#oficio_entrante").hide();
            });
            $("#x_tipo_documento3").click(function(){
               $("#plantillas").hide();
              $("#campos_formato").val("");
              $("#creador").hide();
              $("#creador").val("");
              $("#fecha_borrador").hide();
              $("#fecha_borrador").val("");
              $("#remitente").show();
              $("#aprobacion").hide();
              $("#treeboxbox_tree_aprobado").hide();
              $("#tr_ciudad_origen").hide();
              $("#oficio_entrante").hide();
            });
            $("#x_tipo_documento1").click();
            $('#x_etiqueta').dropdownchecklist({width:200, maxDropHeight: 100});
         });
      </script>
      <?php include_once("footer.php");?>
    </body>
</html>