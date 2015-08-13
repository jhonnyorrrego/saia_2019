<?php
include_once("class_correo.php");
$correo=new correo_saia();
//para actualizar el listado de correos por ajax cuando cambie el nombre de la carpeta
if(isset($_REQUEST["accion"])&&$_REQUEST["accion"]=="actualizar_correos")
{$correo->actualizar_correos($_REQUEST["carpeta"]);   
}
elseif($correo->conexion_correcta()) //verfico que la conexion con el correo est� correcta antes de mostrar la pantalla
{include_once("../db.php");
 $ok=0;
 $permiso=new PERMISO();
 $ok=$permiso->acceso_modulo_perfil("configurar_campos_formato_correo");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="../css/flexigrid.css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/flexigrid.js"></script>
<script type="text/javascript" src="../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
    <link rel="stylesheet" type="text/css" href="../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script>
hs.graphicsDir = '../anexosdigitales/highslide-4.0.10/highslide/graphics/';
hs.outlineType = 'rounded-white';
function procesar_link(id,tipo)
{direccion="";
 ancho=800;
 alto=400;
 if(tipo==1) //mostrar mensaje
   direccion="procesar_acciones.php?accion=vista_previa&carpeta="+$("#carpetas option[selected]").val()+"&key="+id;
 else if(tipo==2) //configurar formato con los campos del mensaje
   direccion="procesar_acciones.php?accion=configurar_formatos&carpeta="+$("#carpetas option[selected]").val()+"&key="+id;
 else if(tipo==3) //eliminar email
   {if(confirm("�En realidad desea eliminar el mensaje?"))
      $.ajax({
      url: "procesar_acciones.php",
      type:"POST",
      data:"accion=eliminar_mensaje&carpeta="+$("#carpetas option[selected]").val()+"&idmensaje="+id,
      success: function(html){   
       alert("Mensaje marcado como eliminado.");       
       actualizar_grid(); 
      }
    }); 
   }
 else if(tipo==4) //redactar mensaje
   direccion="enviar_email.php";  
 else if(tipo==5) // marcar como no leido
   {$.ajax({
      url: "procesar_acciones.php",
      type:"POST",
      data:"accion=no_leido&carpeta="+$("#carpetas option[selected]").val()+"&idmensaje="+id,
      success: function(html){
       alert("Mensaje marcado como no leido.");  
       actualizar_grid(); 
      }
    });
   }
 else if(tipo==6) // formulario buscar
   direccion="procesar_acciones.php?accion=formulario_buscar&carpeta="+$("#carpetas option[selected]").val()+"&key="+id;        
 if(direccion!="")
    hs.htmlExpand(null, {src:direccion, objectType: 'iframe',width: ancho, height:alto,preserveContent:false } );
}
function actualizar_grid()
{$("#flex1").flexOptions({sql:"reiniciar_pagina=1"});
 $("#flex1").flexReload();
 $("#flex1").flexOptions({sql:""});
}
function actualizar()
{$("#flex1").hide();
	  $.ajax({
      url: "procesar_acciones.php",
      type:"POST",
      data:"accion=actualizar_correos&carpeta="+$("#carpetas option[selected]").val(),
      success: function(html){   
       actualizar_grid(); 
       $("#flex1").show();  
      }
    });  
}
$(document).ready(function(){
  $('#mensajes').ajaxStart(function() {
     $('#mensajes').html('<img src="../imagenes/cargando.gif" />Cargando datos...');
  });
  $('#mensajes').ajaxStop(function() {
     $('#mensajes').html('');
  });
	$("#carpetas").change(function(){
	  actualizar();
  })
  $("#actualizar").click(function(){
	  actualizar();
  })
	$("#flex1").flexigrid
			(
			{url: 'listado_correos_contenido.php',
			dataType: 'json',
			colModel : [
			  {display: 'Opciones', name : '', width : 70, align: 'left'},
        {display: 'Estado', name : 'estado', width :  30, align: 'center'},
        {display: 'De', name : 'de', width : 150, align: 'left'},
				{display: 'Asunto', name : 'asunto', width :  300, align: 'left'},
				{display: 'Fecha', name : 'fecha', width :  120, align: 'center'},
				
				],                                                             	
			sortname: "fecha",
			sortorder: "desc",
			pagestat:"Registros {from} a {to} de {total}",
			procmsg: 'Procesando, por favor espere ...',
			nomsg: 'No se encontraron registros que coincidan',
			showToggleBtn: false,
			usepager: true,  
			title: 'Correos',
			useRp: true,
			rp: 20,
			width:800,
			height: 200
			}
			);   
	
});    
</script>
<?php
include_once("../header.php");
    ?>
    <img class="imagen_internos" src="../botones/configuracion/email.png" border="0">&nbsp;&nbsp;<b>CORREO ELECTR&Oacute;NICO</b><br /><br />
<?php 
$carpetas=$correo->listar_carpetas();
$correo->actualizar_correos();
echo 'CARPETAS <select name="carpetas" id="carpetas">';
foreach($carpetas as $fila)
  {echo 'CARPETAS<option value="'.$fila.'" ';
   if($fila=="INBOX")
     echo ' selected ';
   echo '>'.$fila.'</option>';
  }
echo '</select>   <a id="actualizar" href="#"><img src="../botones/email/table_refresh.png" title="Actualizar listado" border="0" /></a>   <a id="redactar" href="#" onclick="procesar_link(0,4)"><img src="../botones/email/email_edit.png" border="0" title="Redactar mensaje"></a>  <a href="#" onclick="procesar_link(0,6)"><img src="../botones/email/magnifier.png"  border="0" title="Buscar Mensajes" /></a>  ';
if($ok)
  echo '<a id="configurar" href="#" onclick="procesar_link(0,2)"><img src="../botones/email/bullet_wrench.png"  border="0"title="Configurar Formatos" /></a>';
    ?>
    <br>
    <br>
    <form name="form1" id="form1">
      <div id="mensajes">
      </div>
      <table id='flex1'>
      </table>
<?php 
}
include_once("../footer.php");
      ?>