<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
?>    
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<?php
echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(librerias_arboles());
echo(estilo_bootstrap());
?>
</head>
<body>
<div id="div_contenido">
			<form method="POST" id="form_radicacion_rapida" action="<?php echo($ruta_db_superior); ?>colilla.php" ><br/><br />
                <table class="table-bordered" border="1" align="center">
                    <tr>
                        <td class="encabezado_list" colspan="2" align="center">Seleccione Tipo de Radicación</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" id="generar_consecutivo" name="generar_consecutivo">
                            <input type="hidden" name="enlace" id="enlace" value="pantallas/buscador_principal.php?idbusqueda=7">
                            <input type="hidden" name="enlace2" id="enlace2" value="formatos/radicacion_entrada/radicacion_rapida.php">
                            <?php
$adicional='';
if(@$_REQUEST["idcategoria_formato"]){
	$adicional="&idcategoria_formato=".$_REQUEST["idcategoria_formato"];
}
?>
	<div id="esperando_serie">
    <img src="<?php echo($ruta_db_superior); ?>imagenes/cargando.gif"></div>
	<div id="treeboxbox_tree_equipos" class="arbol_saia" style="height:89%;width:95%" ></div>
	<script type="text/javascript">
  <!--		
  	$(document).ready(function  () {
			top.setTitulo("Ingreso de documentos");  
	});	
  	
      var browserType;
      
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree_equipos=new dhtmlXTreeObject("treeboxbox_tree_equipos","100%","100%",0);
			tree_equipos.setImagePath("<?php echo $ruta_db_superior;?>imgs/");
			tree_equipos.enableTreeImages("false");
			tree_equipos.enableIEImageFix(true);
			//tree_equipos.setOnClickHandler(onNodeSelect);
			tree_equipos.setOnCheckHandler(onNodeSelect);
			tree_equipos.enableCheckBoxes(1);
            tree_equipos.enableRadioButtons(true);
			tree_equipos.setOnLoadingStart(cargando_serie);
            tree_equipos.setOnLoadingEnd(fin_cargando_serie);
            
            tree_equipos.setXMLAutoLoading("<?php echo($ruta_db_superior); ?>formatos/radicacion_entrada/test_radicacion_rapida.php");
      //tree_equipos.enableSmartXMLParsing(true);
			tree_equipos.loadXML("<?php echo($ruta_db_superior); ?>formatos/radicacion_entrada/test_radicacion_rapida.php");
	    function onNodeSelect(nodeId){
	     if(nodeId.indexOf('#',0)==-1){
            $('#generar_consecutivo').val(nodeId);
            if(nodeId=='radicacion_salida'){
                $('#enlace').val("ordenar.php?accion=mostrar&mostrar_formato=1");
            }else{
                $('#enlace').val("ordenar.php?accion=mostrar&mostrar_formato=1");  //ordenar.php?accion=mostrar&mostrar_formato=1
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
        tree_equipos.openAllItems(0);
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
	--> 		
	</script>
	        </td>
            </tr>
            <tr><td style="font-size:8pt;"  align="center">Descripci&oacuten General</td>
                <td align="center"><input type="text" class="required" id="descripcion_general" name="descripcion_general"/></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input class="btn btn-primary btn-mini" type="submit" value="Radicar" id="enviar" name="enviar"/></td>
            </tr>
        </table>
        <input type="hidden" name="target" value="_self">
    </form>
    <?php
    echo(librerias_validar_formulario(11));
    ?>
    <script>
        $(document).ready(function(){
            $( "#form_radicacion_rapida" ).validate({
               submitHandler: function(form){
                   var generar_consecutivo=$('#generar_consecutivo').val();
                   if(!generar_consecutivo || generar_consecutivo==''){
                       	top.noty({text: '<b>ATENCI&Oacute;N</b><br>De seleccionar una opci&oacute;n para radicar!',type: 'warning',layout: 'topCenter',timeout:2500});
                       return(false);
                   }
                    
                    form.submit();   
                }                 
            });
        });
    </script>