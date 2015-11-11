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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
global $raiz_saia;
$raiz_saia=$ruta_db_superior;
echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
echo(librerias_arboles());
echo(librerias_bootstrap());
echo(librerias_datepicker_bootstrap());

$version=@$_REQUEST["idversion_documento"];
$iddoc=@$_REQUEST["iddoc"];
$datos=busca_filtro_tabla(fecha_db_obtener('a.fecha','Y-m-d H:i:s')." as x_fecha, a.*","version_documento a","a.idversion_documento=".$version,"",$conn);
$datos_fecha=date_parse($datos[0]["x_fecha"]);
$fecha=$datos[0]["version"]." (".$datos_fecha["day"]." de ".mes($datos_fecha["month"])." del ".$datos_fecha["year"]." a las ".$datos_fecha["hour"].":".$datos_fecha["minute"].")";
?>
<div class="container">
    <legend id="prueba">Version <?php echo($fecha); ?></legend>
	<div class="control-group element">
        <div class="controls">
            <span class="phpmaker">
            <div id="esperando_version"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
        	<div id="treeboxbox_tree2" class="arbol_saia"></div>
            </span>
      </div>
    </div>
</div>
<script>
$(document).ready(function(){
    var browserType;
    if (document.layers) {browserType = "nn4"}
    if (document.all) {browserType = "ie"}
    if (window.navigator.userAgent.toLowerCase().match("gecko")) {
       browserType= "gecko"
    }
    tree2=new dhtmlXTreeObject("treeboxbox_tree2","","",0);
  	tree2.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
  	tree2.enableIEImageFix(true);
    
    tree2.setOnLoadingStart(cargando_version);
    tree2.setOnLoadingEnd(fin_cargando_version);
    tree2.enableSmartXMLParsing(true);
    tree2.setOnClickHandler(onNodeSelect_version);
    tree2.setXMLAutoLoading("test_versiones.php?idversion_documento=<?php echo($version); ?>&iddoc=<?php echo($iddoc); ?>");	
  	tree2.loadXML("test_versiones.php?idversion_documento=<?php echo($version); ?>&iddoc=<?php echo($iddoc); ?>");
      
    function fin_cargando_version() {
      if (browserType == "gecko" )
        document.poppedLayer = eval('document.getElementById("esperando_version")');
      else if (browserType == "ie")
        document.poppedLayer = eval('document.getElementById("esperando_version")');
      else
        document.poppedLayer = eval('document.layers["esperando_version"]');
      document.poppedLayer.style.display = "none";
      tree2.openAllItems(0);
    }
    function cargando_version() {
      if (browserType == "gecko" )
        document.poppedLayer = eval('document.getElementById("esperando_version")');
      else if (browserType == "ie")
        document.poppedLayer = eval('document.getElementById("esperando_version")');
      else
        document.poppedLayer = eval('document.layers["esperando_version"]');
      document.poppedLayer.style.display = "";
    }
    function onNodeSelect_version(nodeId){
        var llave=0;
        llave=nodeId;
        var datos=llave.split("-");
        if(datos[1]){
            var conexion="abrir_anexo.php?id="+llave;
            window.open(conexion,"_blank");
        }
    }
    
});
</script>
<?php
echo(librerias_highslide());
?>
<script>
$(document).ready(function(){
	hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
	hs.outlineType = 'rounded-white';
});
</script>