<?php
include_once("db.php");
?>
<script type="text/javascript" src="js/dhtml-suite-for-applications.js"></script>
<script>
function displayImage(imagePath,title,description)
	{
		var enlargerObj = new DHTMLSuite.imageEnlarger();
		enlargerObj.setIsDragable(true);
		enlargerObj.setIsModal(false);		
		DHTMLSuite.commonObj.setCssCacheStatus(false);
		enlargerObj.displayImage(imagePath,title,description);		
	}
</script>
<?php
include_once($ruta_db_superior."header.php");
 $doc = $_REQUEST["key"]; 
 leido(usuario_actual("funcionario_codigo"),$doc);
   $doc_anterior = busca_filtro_tabla("descripcion,numero","documento","iddocumento=$doc","",$conn);
   echo "<b>Se est&aacute; dando respuesta al documento: </b>&nbsp;&nbsp;".$doc_anterior[0]["numero"]." ".$doc_anterior[0]["descripcion"]."<br /><br />";  
   //Si el documento tiene imagenes escaneadas las muestra antes del formato de respuesta
   $imagenes=busca_filtro_tabla("consecutivo,imagen,ruta,pagina","pagina","id_documento=".$doc,"",$conn); 
    $codigo="";
    if($imagenes<>"")
       { 
        echo '<div id="mainContainer">
              <div id=" content">';                 
         for($i=0; $i<$imagenes["numcampos"]; $i++)
          {          
           ?>                
          		<a href="<?php echo($ruta_db_superior);?>mostrar_pagina_documento2.php?idpagina=<?php echo($imagenes[$i]["consecutivo"]);?>&idimagen=<?php echo($imagenes[$i]["imagen"]); ?>&ruta=<?php echo($imagenes[$i]["ruta"]);?>&key=<?php echo($doc); ?>" class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 650, height:4000,preserveContent:false })"><img src="<?php echo($ruta_db_superior.$imagenes[$i]["imagen"]);?>" border="0px"></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
           if($imagenes[$i]["pagina"]==(round($imagenes[$i]["pagina"]/8)*8))
            echo "<br><br>";
          }
          echo "</div></div>";
       }
   echo "<HR>";  
include_once($ruta_db_superior."footer.php"); 
?>
