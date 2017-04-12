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
include_once($ruta_db_superior."librerias_saia.php"); 
include_once($ruta_db_superior."db.php");
usuario_actual();
?>
<htm>
<head>
<?php
$ewCurSec = 0; // Initialise
// Initialize common variables
$x_idpermiso_perfil = Null;
$x_modulo_idmodulo = Null;
$x_modulo = Null;
$x_perfil_idperfil = Null;
$x_caracteristica_propio = Null;
$x_caracteristica_grupo = Null;
$x_caracteristica_total = Null;
echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
echo(librerias_notificaciones());
echo(librerias_arboles());
?>
</head>
<body>
		<script type="text/javascript" src="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
		 <link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
		 <script type='text/javascript'>
		   hs.graphicsDir = '<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
		   hs.outlineType = 'rounded-white';
		</script>   
		<a style="display:none;" id="enlace_highslide" class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 300, height: 100,preserveContent:false} )" >I</a>
<div class="container">
		<h5>ADICIONAR PERMISO PERFIL</h5>
		<br/>
		<ul class="nav nav-tabs">
		  <li class="active"><a href="permiso_perfiladd.php">Adicionar Permiso</a></li>
		     <li><a href="perfiladd.php">Adicionar Perfil</a></li>
		</ul>		
<?php
if(isset($_REQUEST["pantalla"]))
  echo '<input type="hidden" name="pantalla" value="'.$_REQUEST["pantalla"].'">';
?>
<p>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" style="width:100%;">
    <tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PERFIL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">		
<?php
 echo "<input type='hidden' name='perfil_seleccionado' id='perfil_seleccionado' value='$sKey'>";
?>
<select name="x_perfil_idperfil" id="x_perfil_idperfil" class="required"><option value="0">Seleccionar...</option>
<?php
$x_perfil_idperfilList = "<label for='x_perfil_idperfil[]' class='error'>Campo obligatorio</label><br />";
$sSqlWrk = "SELECT DISTINCT A.idperfil, A.nombre FROM perfil A" . " ORDER BY A.nombre Asc";
$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		if(strtolower($datawrk["nombre"])=="administrador"&&(usuario_actual('login')!="cerok"||usuario_actual('perfil')!=1))continue;
		$x_perfil_idperfilList.='<option value="'.htmlspecialchars($datawrk[0]).'" ';
		if ($datawrk["idperfil"] == $sKey) {
			$x_perfil_idperfilList .= "' selected ";
		}
		$x_perfil_idperfilList.='>'.$datawrk["nombre"].'</option>';
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
echo $x_perfil_idperfilList;
?>
</select>
</td>
</tr>
  <tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">MODULO*</span></td>
		<td bgcolor="#F5F5F5">
    <input type="hidden" class="required" name="x_modulo_idmodulo" id="x_modulo_idmodulo"  value="" >
        <br />
          Buscar:<br><input type="text" id="stext_3" width="200px" size="20">
          <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,1)">
          <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
          <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,0,1)">
          <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
          <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value)">
          <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a>
        <br /><div id="esperando_modulo">
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
    		tree3.enableTreeImages("false");
            tree3.enableCheckBoxes(1);
    		tree3.setOnLoadingStart(cargando_serie);
            tree3.setOnLoadingEnd(fin_cargando_serie);
    		tree3.loadXML("test_permiso_modulo.php?filtro_perfil=1&entidad=perfil&llave_entidad=<?php echo $sKey; echo $condicion; ?>");
    		tree3.setOnCheckHandler(onNodeSelect);
    		tree3.setOnClickHandler(high_slide_permiso_crear_formato);
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
          function onNodeSelect(nodeId){
        	$.ajax({
        	    url: '<?php echo($ruta_db_superior);?>pantallas/permisos/validar_permiso_perfil.php', 
                type:'POST',
                data:'perfil='+$('#x_perfil_idperfil :selected').val()+"&modulo="+nodeId+"&nombre_perfil="+$('#x_perfil_idperfil :selected').text()+"&nombre_modulo="+tree3.getItemText(nodeId),
                success: function(retorno){
                    var datos=jQuery.parseJSON(retorno); 
                    if(datos["exito"]==0){
                        if(tree3.isItemChecked(nodeId)===0){
                            tree3.setCheck(nodeId, true);
                        }
                        else{
                            tree3.setCheck(nodeId, false);
                        }
                    }
                    notificacion_saia(datos["mensaje"],datos["tipo_mensaje"],"topRight",3000);
                }
        	});
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
          function high_slide_permiso_crear_formato(nodeId){
            var idperfil=parseInt($('#x_perfil_idperfil').val());
            if(idperfil){   
                $.ajax({
                    type:'POST',
                    dataType: 'html',
                    url: "<?php echo($ruta_db_superior); ?>pantallas/permisos/validar_permiso_perfil.php",
                    data: {
                        valida_modulo_formato:1,
                        idmodulo:nodeId
                    },
                    success: function(exito){
                        exito=parseInt(exito);
                        if(exito){ //es formato
                            var enlace="<?php echo($ruta_db_superior); ?>pantallas/permisos/validar_permiso_perfil.php?valida_permiso_crear_formato=1&idmodulo="+nodeId+"&idperfil="+idperfil;
                            $('#enlace_highslide').attr('href',enlace);
                            $('#enlace_highslide').click();
                           // hs.htmlExpand(this, { objectType: 'iframe',width: 500, height: 200,preserveContent:false, src:enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});	
                        }
                    }
                });   
            }    
          }
          
          
          $(document).ready(function(){
              $("#x_perfil_idperfil").change(function() {
                 if($('#x_perfil_idperfil :selected').val()!="")
                   {tree3.deleteChildItems(0);
                    tree3.loadXML('test_permiso_modulo.php?filtro_perfil=1&entidad=perfil&llave_entidad='+$('#x_perfil_idperfil :selected').val());
                   }
              });
          });
    	-->
    	</script>
  </td>
</tr>
</table>
</body>
</html>