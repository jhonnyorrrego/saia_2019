<?php
include_once("../db.php");
include_once("../header.php");

$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."class_transferencia.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

if($_REQUEST["accion"]=="adicionar" || $_REQUEST["accion"]=="editar")
  {if(isset($_REQUEST["id"])&&$_REQUEST["id"])
     $contenido=busca_filtro_tabla("contenidos_carrusel.*,".fecha_db_obtener('fecha_inicio','Y-m-d')." as fecha_inicio,".fecha_db_obtener('fecha_fin','Y-m-d')." as fecha_fin","contenidos_carrusel","idcontenidos_carrusel=".$_REQUEST["id"],"",$conn); 
    
   include_once("../calendario/calendario.php");
   ?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/jquery.spin.js"></script>    
<script language="javascript" type="text/javascript" src="<?php echo $ruta_db_superior; ?>tinymce34/jscripts/tiny_mce/tiny_mce.js"></script>
<style>
	.error{
		color:red;
	}
</style>
<script language="javascript" type="text/javascript">
<!--
	// Notice: The simple theme does not use all options some of them are limited to the advanced theme
tinyMCE.init({
mode : "textareas",
theme : "advanced",
language : "es",
editor_selector: "tiny_avanzado2",
plugins : "formatos,spellchecker,pagebreak,style,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,image,cleanup,code,|,forecolor,backcolor",
theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,|,iespell,spellchecker,|,fullscreen",
spellchecker_languages : "+Espa=es,Ingles=en",
theme_advanced_buttons4 : "visualchars",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,tab_focus : ':prev,:next',
external_image_list_url : "librerias/image_list.js",
content_css : "librerias/estilo.css",
height:"300px",
width:"350px"
});
-->
</script>
    <script type='text/javascript'>
      $().ready(function() {
    	$('#form1').validate();
    	$.spin.imageBasePath = '../images/';
    	$('#orden').spin({min: 1});

    });
    opciones =
    [   ['Cut','Copy','Paste','PasteText','PasteFromWord'],
        ['Find','Replace','-','SelectAll','RemoveFormat'],
        ['Image','Flash','Table','HorizontalRule'],
        ['Link','Unlink'],['TextColor','BGColor'],['Source'] ,
        '/',
        ['Font','FontSize'],['Bold','Italic','Underline','Strike'],
        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote']        
    ];
    </script>
   <?php    
   echo "<br /><b>".ucwords($_REQUEST["accion"]." Contenido")."</b><br /><br /><form name='form1' method='post' id='form1' enctype='multipart/form-data'><table width=100%>";
   echo "<tr><td class='encabezado' width=20%>NOMBRE*</td><td><input class='required'  type='text' name='nombre' value='".@$contenido[0]["nombre"]."'></td></tr>";
   echo "<tr><td class='encabezado'>CARRUSEL*</td><td><select class='required'  type='text' name='carrusel_idcarrusel'>";
   $carrusel=busca_filtro_tabla("idcarrusel,nombre","carrusel","","nombre",$conn);
   for($i=0;$i<$carrusel["numcampos"];$i++)
      {echo "<option value='".$carrusel[$i]["idcarrusel"]."' ";
       if($carrusel[$i]["idcarrusel"]==@$contenido[0]["carrusel_idcarrusel"])
         echo " selected "; 
       echo ">".$carrusel[$i]["nombre"]."</option>";
      }
   echo "</select></td></tr>";
   echo "<tr><td class='encabezado'>FECHA DE PUBLICACI&Oacute;N*</td><td>".'<input type="text" readonly="true" name="fecha_inicio"  class="required dateISO"  id="fecha_inicio" value="'.@$contenido[0]["fecha_inicio"].'">';
   selector_fecha("fecha_inicio","form1","Y-m-d",date("m"),date("Y"),"default.css","../","AD:VALOR");
   echo "</td></tr>";
   echo "<tr><td class='encabezado'>FECHA CADUCIDAD*</td><td>";
   echo '<input type="text" readonly="true" name="fecha_fin"  class="required dateISO"  id="fecha_fin" value="'.@$contenido[0]["fecha_fin"].'">';
   selector_fecha("fecha_fin","form1","Y-m-d",date("m"),date("Y"),"default.css","../","AD:VALOR");
   echo "</td></tr>";
   echo "<tr><td class='encabezado'>CONTENIDO*</td><td><textarea class='required tiny_avanzado2' name='contenido' id='contenido'>".stripslashes(@$contenido[0]["contenido"])."</textarea></td></tr>";
   echo "<tr><td class='encabezado'>PREVISUALIZAR</td><td><textarea name='preview' id='preview' class=''>".stripslashes(@$contenido[0]["preview"])."</textarea></td></tr>";
   echo "<tr><td class='encabezado'>IMAGEN</td><td>";
   if($contenido[0]["imagen"]<>"")
     echo "<a href='".$ruta_db_superior.$contenido[0]["imagen"]."' target='_blank'>Ver Imagen Actual</a><br />Borrar Imagen<input type='checkbox' value='1' name='borrar_imagen'><br />Subir nueva <input type='file' name='imagen' id='imagen' >";
   else
     echo "<input type=file name='imagen' id='imagen' >";  
   echo "</td></tr>";
   echo "<tr><td class='encabezado' width=20%>ALINEACION DE LA IMAGEN</td><td>";
   $opciones=array("left"=>"Izquierda","right"=>"Derecha");
   foreach($opciones as $valor=>$nombre)
     {echo "<input type='radio' name='align' value='$valor' ";
      if($valor==@$contenido[0]["align"])
        echo " checked ";
      echo ">$nombre&nbsp;&nbsp;"; 
     }
   echo "</td></tr>";
   echo "<tr><td class='encabezado' width=20%>Orden*</td><td><input class='required'  type='input' name='orden' id='orden' value='".@$contenido[0]["orden"]."'></td></tr>";
   echo "<tr><td><input type='submit' value='Continuar'>
   <input type='hidden' name='id' value='".@$contenido[0]["idcontenidos_carrusel"]."'>
   <input type='hidden' name='accion' value='guardar_".@$_REQUEST["accion"]."'>
   </td></tr>";
   echo "</table></form>";
}
elseif($_REQUEST["accion"]=="guardar_adicionar")
{$campos=array("nombre","carrusel_idcarrusel","orden","align");
 $nombres[]="fecha_inicio";
 $nombres[]="fecha_fin";
 $valores[]=fecha_db_almacenar($_REQUEST["fecha_inicio"],"Y-m-d");
 $valores[]=fecha_db_almacenar($_REQUEST["fecha_fin"],"Y-m-d");
 $carrusel=busca_filtro_tabla("alto","carrusel","idcarrusel=".$_REQUEST["carrusel_idcarrusel"],"",$conn); 
 $nwidth=$carrusel[0]["alto"];
 $nheight=$carrusel[0]["alto"]; 
 //print_r($_REQUEST);
 foreach($campos as $fila)
   {$valores[]="'".$_REQUEST[$fila]."'";
    $nombres[]=$fila;
   }
 $sql="insert into contenidos_carrusel(".implode(",",$nombres).") values(".implode(",",$valores).")";
 phpmkr_query($sql,$conn);
 $id=phpmkr_insert_id();
 guardar_lob("contenido","contenidos_carrusel","idcontenidos_carrusel=".$id,$_REQUEST["contenido"],"texto",$conn);
 guardar_lob("preview","contenidos_carrusel","idcontenidos_carrusel=".$id,$_REQUEST["preview"],"texto",$conn);
 phpmkr_query($sql,$conn);
 if (is_uploaded_file($_FILES["imagen"]["tmp_name"])) 
     {
      $extension=explode(".",($_FILES["imagen"]["name"]));
	  $ultimo=count($extension);
	  $formato=$extension[$ultimo-1];
      $aleatorio=rand(5,15);
	  $aux="../../banco_imagenes/";
      $imagen_reducida=$ruta_db_superior.$aux;
      crear_destino($imagen_reducida);
      $imagen_reducida=$imagen_reducida.$aleatorio.".".$formato;
      if(copy($_FILES["imagen"]["tmp_name"],$imagen_reducida))
	  		$sql1="update contenidos_carrusel set imagen='".$aux.$aleatorio.".".$formato."' where idcontenidos_carrusel=".$id;
 			phpmkr_query($sql1,$conn);
			@unlink($_FILES["imagen"]["tmp_name"]);
      }
  
 header("location: sliderconfig.php");
}
elseif($_REQUEST["accion"]=="guardar_editar")
{$campos=array("nombre","carrusel_idcarrusel","orden","align");
 $valores[]="fecha_inicio=".fecha_db_almacenar($_REQUEST["fecha_inicio"],"Y-m-d");
 $valores[]="fecha_fin=".fecha_db_almacenar($_REQUEST["fecha_fin"],"Y-m-d");
 $carrusel=busca_filtro_tabla("alto","carrusel","idcarrusel=".$_REQUEST["carrusel_idcarrusel"],"",$conn); 
 $nwidth=$carrusel[0]["alto"];
 $nheight=$carrusel[0]["alto"]; 
 
 foreach($campos as $fila)
   {$valores[]=$fila."='".$_REQUEST[$fila]."'";
   }
 $sql1="update contenidos_carrusel set ".implode(",",$valores)." where idcontenidos_carrusel=".$_REQUEST["id"];
 phpmkr_query($sql1,$conn);
 guardar_lob("contenido","contenidos_carrusel","idcontenidos_carrusel=".$_REQUEST["id"],$_REQUEST["contenido"],"texto",$conn);
 guardar_lob("preview","contenidos_carrusel","idcontenidos_carrusel=".$_REQUEST["id"],$_REQUEST["preview"],"texto",$conn);
 
	if(@$_REQUEST["borrar_imagen"]){
		$contenido=busca_filtro_tabla("","contenidos_carrusel","idcontenidos_carrusel=".$_REQUEST["id"],"",$conn);
		if(MOTOR=="MySql")
		 phpmkr_query("update contenidos_carrusel set imagen=null where idcontenidos_carrusel=".$_REQUEST["id"]);
		 elseif(MOTOR=="Oracle")
		 phpmkr_query("update contenidos_carrusel set imagen=empty_blob() where idcontenidos_carrusel=".$_REQUEST["id"]);
		 @unlink($ruta_db_superior.$contenido[0]["imagen"]);
	}
 
 if (is_uploaded_file($_FILES["imagen"]["tmp_name"])) 
     {
      $extension=explode(".",($_FILES["imagen"]["name"]));
	  $ultimo=count($extension);
	  $formato=$extension[$ultimo-1];
      $aleatorio=rand(5,15);
	  $aux="../../banco_imagenes/";
      $imagen_reducida=$ruta_db_superior.$aux;
      crear_destino($imagen_reducida);
      $imagen_reducida=$imagen_reducida.$aleatorio.".".$formato;
      if(copy($_FILES["imagen"]["tmp_name"],$imagen_reducida))
	  		$sql1="update contenidos_carrusel set imagen='".$aux.$aleatorio.".".$formato."' where idcontenidos_carrusel=".$_REQUEST["id"];
 			phpmkr_query($sql1,$conn);
			@unlink($_FILES["imagen"]["tmp_name"]);
      }
 header("location: sliderconfig.php");
}
elseif($_REQUEST["accion"]=="eliminar")
{$sql="delete from contenidos_carrusel where idcontenidos_carrusel=".$_REQUEST["id"];
 phpmkr_query($sql,$conn);
 header("location: sliderconfig.php");
}
include_once("../footer.php");
?>
