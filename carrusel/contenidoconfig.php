<?php
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


include_once("../db.php");
include_once("../header.php");
include_once($ruta_db_superior . "librerias_saia.php");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("id","carrusel_idcarrusel");
desencriptar_sqli('form_info');
echo(librerias_jquery());

echo(estilo_bootstrap());



?>
<div class="container">
		<h5>CONFIGURACI&Oacute;N DE CARRUSEL Y CONTENIDOS RELACIONADOS</h5>
		<br/>
		

<?php

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
    	$('#form1').validate({
    		submitHandler: function(form) {
				<?php encriptar_sqli("form1",0,"form_info",$ruta_db_superior);?>
			    form.submit();
			    
			  }
    	});
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
    
		<ul class="nav nav-tabs">
		
			 <li ><a href='sliderconfig.php'>Inicio</a ></li>
		<?php if($_REQUEST["accion"]=='adicionar'){ ?>
					
				 <li><a href='sliderconfig.php?accion=adicionar'>Adicionar Carrusel</a ></li>
				 <li  class="active"><a href='contenidoconfig.php?accion=adicionar'>Adicionar Contenido</a ></li>
		<?php }else{ ?>	
				
				  <li ><a href='sliderconfig.php?accion=adicionar'>Adicionar Carrusel</a ></li>
			      <li><a href='contenidoconfig.php?accion=adicionar'>Adicionar Contenido</a ></li>
			      <li class="active"><a href='#'>Editar Contenido</a ></li>
		<?php } ?>			
			
		</ul>		
		<br/>   
    
   <?php    
   echo "<br /><fieldset><legend>".ucwords($_REQUEST["accion"]." contenido")."</legend></fieldset><br /><br /><form name='form1' method='post' id='form1' enctype='multipart/form-data'><table class='table table-bordered table-striped'>";
   echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;'>NOMBRE*</td><td><input class='required'  type='text' name='nombre' value='".@$contenido[0]["nombre"]."'></td></tr>";
   echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;'>CARRUSEL*</td><td><select class='required'  type='text' name='carrusel_idcarrusel'>";
   $carrusel=busca_filtro_tabla("idcarrusel,nombre","carrusel","","nombre",$conn);
   for($i=0;$i<$carrusel["numcampos"];$i++)
      {echo "<option value='".$carrusel[$i]["idcarrusel"]."' ";
       if($carrusel[$i]["idcarrusel"]==@$contenido[0]["carrusel_idcarrusel"])
         echo " selected "; 
       echo ">".$carrusel[$i]["nombre"]."</option>";
      }
   echo "</select></td></tr>";
   echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;'>FECHA DE PUBLICACI&Oacute;N*</td><td>".'<input type="text" readonly="true" name="fecha_inicio"  class="required dateISO"  id="fecha_inicio" value="'.@$contenido[0]["fecha_inicio"].'">';
   selector_fecha("fecha_inicio","form1","Y-m-d",date("m"),date("Y"),"default.css","../","AD:VALOR");
   echo "</td></tr>";
   echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;'>FECHA CADUCIDAD*</td><td>";
   echo '<input type="text" readonly="true" name="fecha_fin"  class="required dateISO"  id="fecha_fin" value="'.@$contenido[0]["fecha_fin"].'">';
   selector_fecha("fecha_fin","form1","Y-m-d",date("m"),date("Y"),"default.css","../","AD:VALOR");
   echo "</td></tr>";
   echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;'>CONTENIDO*</td><td><textarea class='required tiny_avanzado2' name='contenido' id='contenido'>".stripslashes(@$contenido[0]["contenido"])."</textarea></td></tr>";
   echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;'>PREVISUALIZAR</td><td><textarea name='preview' id='preview' class=''>".stripslashes(@$contenido[0]["preview"])."</textarea></td></tr>";
   echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;'>IMAGEN</td><td>";
   if($contenido[0]["imagen"]<>"")
     echo "<a href='".$ruta_db_superior.'filesystem/mostrar_binario.php?ruta='.base64_encode($contenido[0]["imagen"])."' target='_blank'>Ver Imagen Actual</a><br />Borrar Imagen<input type='checkbox' value='1' name='borrar_imagen'><br />Subir nueva <input type='file' name='imagen' id='imagen' >";
   else
     echo "<input type=file name='imagen' id='imagen' >";  
   echo "</td></tr>";
   echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;' width=20%>ALINEACION DE LA IMAGEN</td><td>";
   $opciones=array("left"=>"Izquierda","right"=>"Derecha");
   foreach($opciones as $valor=>$nombre)
     {echo "<input type='radio' name='align' value='$valor' ";
      if($valor==@$contenido[0]["align"])
        echo " checked ";
      echo ">$nombre&nbsp;&nbsp;"; 
     }
   echo "</td></tr>";
   echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;' width=20%>Orden*</td><td><input class='required'  type='input' name='orden' id='orden' value='".@$contenido[0]["orden"]."'></td></tr>";
   echo "<tr><td><input class='btn btn-primary' type='submit' value='Continuar'>
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
		 
		require_once $ruta_db_superior . 'StorageUtils.php';
		require_once $ruta_db_superior . 'filesystem/SaiaStorage.php';
		 
      $extension=explode(".",($_FILES["imagen"]["name"]));
	  $ultimo=count($extension);
	  $formato=$extension[$ultimo-1];
      $aleatorio=rand(5,15);
	  $aux=RUTA_CARRUSEL_IMAGENES;
	  $tipo_almacenamiento = new SaiaStorage("imagenes");
      $imagen_reducida=$aux;
      $imagen_reducida=$imagen_reducida.$aleatorio.".".$formato;
	  $resultado = $tipo_almacenamiento->almacenar_recurso($imagen_reducida, $_FILES["imagen"]["tmp_name"], false);
	  $ruta_anexos = array("servidor" => $tipo_almacenamiento->get_ruta_servidor(), "ruta" =>$imagen_reducida);	
	  $ruta_anexos=json_encode($ruta_anexos);	  
      if($tipo_almacenamiento->get_filesystem()->has($imagen_reducida)){
		  $sql1="update contenidos_carrusel set imagen='".$ruta_anexos."' where idcontenidos_carrusel=".$id;
 			phpmkr_query($sql1,$conn);
			@unlink($_FILES["imagen"]["tmp_name"]);
	  }  
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
 
 
		require_once $ruta_db_superior . 'StorageUtils.php';
		require_once $ruta_db_superior . 'filesystem/SaiaStorage.php'; 
 
	if(@$_REQUEST["borrar_imagen"]){
		$contenido=busca_filtro_tabla("","contenidos_carrusel","idcontenidos_carrusel=".$_REQUEST["id"],"",$conn);
		if(MOTOR=="MySql")
		 phpmkr_query("update contenidos_carrusel set imagen=null where idcontenidos_carrusel=".$_REQUEST["id"]);
		 elseif(MOTOR=="Oracle")
		 phpmkr_query("update contenidos_carrusel set imagen=empty_blob() where idcontenidos_carrusel=".$_REQUEST["id"]);
		 
		 $arr_almacen = StorageUtils::resolver_ruta($contenido[0]["imagen"]);
		 $arr_almacen['clase']->get_filesystem()->delete($arr_almacen["ruta"]);
		 //@unlink($ruta_db_superior.$contenido[0]["imagen"]);
	}
 
 if (is_uploaded_file($_FILES["imagen"]["tmp_name"])) 
     {
      $extension=explode(".",($_FILES["imagen"]["name"]));
	  $ultimo=count($extension);
	  $formato=$extension[$ultimo-1];
      $aleatorio=rand(5,15);
	  $aux=RUTA_CARRUSEL_IMAGENES;
	  $tipo_almacenamiento = new SaiaStorage("imagenes");
      $imagen_reducida=$aux;
      $imagen_reducida=$imagen_reducida.$aleatorio.".".$formato;
	  $resultado = $tipo_almacenamiento->almacenar_recurso($imagen_reducida, $_FILES["imagen"]["tmp_name"], false);
	  $ruta_anexos = array("servidor" => $tipo_almacenamiento->get_ruta_servidor(), "ruta" =>$imagen_reducida);	
	  $ruta_anexos=json_encode($ruta_anexos);	  
	  if($tipo_almacenamiento->get_filesystem()->has($imagen_reducida)){
		  $sql1="update contenidos_carrusel set imagen='".$ruta_anexos."' where idcontenidos_carrusel=".$_REQUEST["id"];
 			phpmkr_query($sql1,$conn);
			@unlink($_FILES["imagen"]["tmp_name"]);
      }
      }
 redirecciona("sliderconfig.php");
}
elseif($_REQUEST["accion"]=="eliminar")
{$sql="delete from contenidos_carrusel where idcontenidos_carrusel=".$_REQUEST["id"];
 phpmkr_query($sql,$conn);
 header("location: sliderconfig.php");
}
include_once("../footer.php");
?>
</div>
