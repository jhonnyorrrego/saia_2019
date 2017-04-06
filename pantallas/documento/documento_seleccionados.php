<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
if(@$_REQUEST["iddoc"] || @$_REQUEST["key"]){
	menu_principal_documento($_REQUEST["iddoc"],@$_REQUEST["vista"]);
}
echo(estilo_bootstrap());
echo(librerias_arboles());
$usuario=usuario_actual("idfuncionario");
?> 
<br>
<div class="container">
Buscar:<br><input type="text" id="stext_3" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,1)">
      <img src="<?php echo($ruta_db_superior);?>botones/general/anterior.png" border="0px" alt="Anterior"></a>
      <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,0,1)">
    <img src="<?php echo($ruta_db_superior);?>botones/general/buscar.png" border="0px" alt="Buscar"></a>
    <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value)">
    <img src="<?php echo($ruta_db_superior);?>botones/general/siguiente.png" border="0px" alt="Siguiente"></a>  
  <br /><div id="esperando_serie">
  <img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif"></div>
  <div id="treeboxbox_tree3" class="arboles_saia"></div>  
<div >
  <div class="btn btn-primary" id="vincular">Vincular</div> <div class="btn btn-warning" id="vincular_quitar">Vincular y Deseleccionar Documento</div>
</div>  
</div>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_ventana_modal.js"></script>
<script type="text/javascript">
<!--
    var browserType;
    if (document.layers) {browserType = "nn4"}
    if (document.all) {browserType = "ie"}
    if (window.navigator.userAgent.toLowerCase().match("gecko")) {
       browserType= "gecko"
    }
		var tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","300",0);
		tree3.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
		tree3.enableIEImageFix(true);
		tree3.enableCheckBoxes(1);
		tree3.setOnLoadingStart(cargando_serie);
    tree3.setOnLoadingEnd(fin_cargando_serie);
    tree3.enableSmartXMLParsing(true);
    tree3.setOnClickHandler(onNodeSelect);
    tree3.setOnCheckHandler(onNodeCheck);        
		tree3.loadXML("<?php echo($ruta_db_superior);?>pantallas/documento/test_documento_por_vincular.php?seleccionado=<?php echo $x_seleccionados; ?>&iddocumento=<?php echo($_REQUEST['iddoc']);?>");
    
    function onNodeSelect(nodeId){
      var variable=nodeId.split("_");
      if(variable[0]=="documento"){
        ruta_modal="ordenar.php?key="+variable[1];      
      }  
      else if(variable[0]=="pagina"){  
        padre=tree3.getParentId(nodeId);
        variable=padre.split("_");        
        ruta_modal="pantallas/documento/listado_paginas.php?iddoc="+variable[1];
      }                                               
      else if(variable[0]=="anexos"){  
        padre=tree3.getParentId(nodeId);
        variable=padre.split("_");
        ruta_modal="anexos_digitales/anexos_documento.php?key="+variable[1];
      }
      abrir_ventana_modal(ruta_modal,"670",0,"",variable[0]);
    }
    function onNodeCheck(nodeId){
      var checked=tree3.isItemChecked(nodeId);
      var variable=nodeId.split("_");  
      if(variable[0]=="lpaginas" || variable[0]=="lanexos"){         
        tree3.setSubChecked(nodeId,checked);
      } 
      if(variable[0]=="pagina" || variable[0]=="anexo"){
        padre=tree3.getParentId(nodeId);
        variable=padre.split("_");
        cantidad=tree3.getSubItems(padre).split(",");
        cantidad2=0;
        for(i=0;i<cantidad.length;i++){
          if(tree3.isItemChecked(cantidad[i])){
            cantidad2++;
          }
        }
        if(cantidad2==cantidad.length){
          tree3.setCheck(padre,1);
        }
        else if(cantidad2==0){
          tree3.setCheck(padre,0);
        }
        else{
          tree3.setCheck(padre,"unsure");
        }
      }                                              
    }
    function fin_cargando_serie() {
      if (browserType == "gecko" )
         document.poppedLayer =
             eval('document.getElementById("esperando_serie")');
      else if (browserType == "ie")
         document.poppedLayer =
            eval('document.getElementById("esperando_serie")');
      else
         document.poppedLayer =
            eval('document.layers["esperando_serie"]');
      document.poppedLayer.style.visibility = "hidden";
    }
    function cargando_serie() {
      if (browserType == "gecko" )
         document.poppedLayer =
             eval('document.getElementById("esperando_serie")');
      else if (browserType == "ie")
         document.poppedLayer =
            eval('document.getElementById("esperando_serie")');
      else
         document.poppedLayer =
             eval('document.layers["esperando_serie"]');
      document.poppedLayer.style.visibility = "visible";
    }              
    $(document).ready(function(){
      $("#vincular").click(function(){
        var exito=1;
        var variable=tree3.getAllChecked();           
        $.post('<?php echo($ruta_db_superior."pantallas/documento/vincular_documento.php");?>',{documento_iddocumento:<?php echo($_REQUEST['iddoc']); ?>,idfuncionario:<?php echo($usuario);?>,arreglo:variable}, function(resultado){
          if(resultado){            
            var objeto=jQuery.parseJSON(resultado);      
            $.each(objeto,function(i,item){                 
             validar_exito_vinculado(0);
             top.noty({text:item.mensaje, type:item.tipo, layout:"topCenter", timeout:5000});
            }); 
          }
        });                          
      });
      $("#vincular_quitar").click(function(){
        var variable=tree3.getAllChecked();           
        $.post('<?php echo($ruta_db_superior."pantallas/documento/vincular_documento.php");?>',{documento_iddocumento:<?php echo($_REQUEST['iddoc']); ?>,idfuncionario:<?php echo($usuario);?>,arreglo:variable,deseleccionar:1}, function(resultado){
          if(resultado){            
            var objeto=jQuery.parseJSON(resultado);      
            $.each(objeto,function(i,item){                 
                top.noty({text:item.mensaje, type:item.tipo, layout:"topCenter", timeout:5000});
            });
            validar_exito_vinculado(1);
          }
        });        
      });
    });  
    function validar_exito_vinculado(recargar){
	    var open_tab_vinculado=$("#arbol_formato",parent.document).contents().find("#cantidad_documentos_relacionados").closest("li").hasClass("active");
	    if(open_tab_vinculado===false){
	        $("#arbol_formato",parent.document).contents().find("#cantidad_documentos_relacionados").click();
	    }
	    else{
	        $("#arbol_formato",parent.document).contents().find("#arbol_documento").click();
	        $("#arbol_formato",parent.document).contents().find("#documentos_relacionados").click();
	    }
        if(recargar)
            document.location.reload();              
    }
--> 		
</script>