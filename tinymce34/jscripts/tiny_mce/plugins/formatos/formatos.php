<?php session_start(); ?>
<?php ob_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php")&&filesize($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
<script type="text/javascript" src="../../tiny_mce_popup.js"></script>
<script type="text/javascript" src="jscripts/template.js"></script>
    <title>CAMPOS Y FUNCIONES
    </title>
    <style type='text/css'>      body,html{width:100%}        table{font-family:verdana;font-size:xx-small;}  	    img{		border:0px;	}
    </style>
<script type="text/javascript" src="js/ajax-dynamic-content.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/ajax-tooltip.js"></script>
    <link rel="stylesheet" href="css/ajax-tooltip.css" media="screen" type="text/css">
    <link rel="stylesheet" href="css/ajax-tooltip-demo.css" media="screen" type="text/css">
  </head>
  <body >
<?php
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("formato");
desencriptar_sqli('form_info');


include_once($ruta_db_superior."formatos/librerias/funciones.php");
if(isset($_REQUEST["formato"])&&$_REQUEST["formato"])
{$formato=$_REQUEST["formato"];
 if($_REQUEST["tipo"]=="funciones_formato")
   $where="formato like '$formato' or formato like '%,$formato' or formato like '$formato,%' or formato like '%,$formato,%'";
 else
   $where="formato_idformato=$formato";
 $titulo=" DEL FORMATO";
}
else
 {$where="";
  $titulo="";
 }
if(isset($_REQUEST["guardar"])&&$_REQUEST["guardar"]==1&&$_REQUEST["formato"])
{$nombre=$_REQUEST["nombre"];
    $acciones=implode(",",$_REQUEST["acciones"]);

 if($_REQUEST["tipo"]=="funciones_formato")
   {$sql="insert into funciones_formato(nombre,nombre_funcion,etiqueta,ruta,descripcion,acciones,formato) values('{*$nombre*}','$nombre','$nombre','".$_REQUEST["ruta"]."','".$_REQUEST["descripcion"]."','$acciones','".$_REQUEST["formato"]."')";

   }
/* else
   {$sql="insert into campos_formato(nombre,etiqueta,ayuda,acciones,formato_idformato,tipo_dato,longitud) values('$nombre','".$_REQUEST["etiqueta"]."','".$_REQUEST["descripcion"]."','$acciones','".$_REQUEST["formato"]."','VARCHAR',255)";
   }  */
   $sql1=$sql;

   $nombre_formato=busca_filtro_tabla("nombre","formato","idformato=".$_REQUEST['formato'],"",$conn);
   guardar_traza($sql,"ft_".$nombre_formato[0]['nombre']);
   phpmkr_query($sql1,$conn);



 redirecciona("?formato=".$_REQUEST["formato"]."&tipo=".$_REQUEST["tipo"]);
}
elseif(isset($_REQUEST["adicionar"])&&$_REQUEST["adicionar"]==1&&$_REQUEST["formato"])
{if($_REQUEST["tipo"]=="funciones_formato")
echo(librerias_jquery());
     echo "<b>ADICIONAR FUNCION </b>";
  /* else
     echo "<b>ADICIONAR CAMPO</b>";*/

   echo "<br /><br><a href='?tipo=".$_REQUEST["tipo"]."&formato=".$_REQUEST["formato"]."'>Listado</a><br>";
   ?>
   <script>
   		 $().ready(function() {
   		 	//Elimina espacios y convierte el texto en minuscula
   		 	$('#nombre').keyup(function(){
   		 		var texto=$(this).val();
				texto=texto.replace(/[^a-zA-Z0-9_]/,'')
				$(this).val(texto.toLowerCase());
			});
			});
         function validar(tipo)
           {if(tipo=='campos_formato' && form1.etiqueta.value!='' &&form1.nombre.value!=''){
               form1.submit();
            }else if(tipo=='funciones_formato' && form1.nombre.value!='' && form1.ruta.value!='' ){
               <?php encriptar_sqli('form1',0,'form_info',$ruta_db_superior);?>
               if(salida_sqli){
					$('#form1').submit();
				}
            }else
               alert('Debe llenar los campos obligatorios');
           }
         </script>
         <?php
         echo "
         <form method='post' name='form1' id='form1' >
         <table style='border-collapse:collapse'><tr>
         <td>Nombre*</td>
         <td><input type='text' name='nombre' class='required' id='nombre'></td></tr>";
  /* if($_REQUEST["tipo"]=="campos_formato")
     echo "<tr><td>Etiqueta*</td>
         <td title='campo'><input type='text' name='etiqueta' class='required' id='etiqueta'></td></tr>";
   else */
     echo "<tr><td>Ruta*</td>
         <td><input type='text' name='ruta' class='required' id='ruta'></td></tr>";
   echo  "<tr><td>Descripci&oacute;n</td>
		     <td>
         <input type='text' name='descripcion' id='descripcion' >
         </td>
	       </tr>";
	 echo '<tr>
		<td >Acciones</td>
		<td >
<input type="checkbox" name="acciones[]" value="a">Adicionar&nbsp;<input type="checkbox" name="acciones[]" value="m" checked>Mostrar&nbsp;<input type="checkbox" name="acciones[]" value="e">Editar&nbsp;</td>
	</tr><tr>
       <td colspan="2">
       <input type="button" value="Guardar" onclick="validar('."'".$_REQUEST["tipo"]."'".');"></td></tr>';
   echo"</table>
         <input type='hidden' name='formato' value='".$_REQUEST["formato"]."'>
         <input type='hidden' name='guardar' value='1'>
         <input type='hidden' name='tipo' value='".$_REQUEST["tipo"]."'>
         </form>";
}
elseif(isset($_REQUEST["tipo"])&&$_REQUEST["tipo"])
  {$resultado=busca_filtro_tabla("",$_REQUEST["tipo"],"$where","nombre asc",$conn);
   if($_REQUEST["tipo"]=="funciones_formato")
     echo "<b>FUNCIONES ".$titulo."</b><br><br>";
   else
     echo "<b>CAMPOS DEL FORMATO</b><br><br>";

   if(isset($_REQUEST["formato"])&&$_REQUEST["formato"])
    {$ordenar="";
     if($_REQUEST["tipo"]=="campos_formato")
     {
       echo "<a href='".$ruta_db_superior."formatos/campos_formatoadd.php?idformato=".$_REQUEST["formato"]."&pantalla=tiny'>Adicionar</a>&nbsp;&nbsp;&nbsp;<a href='".$ruta_db_superior."formatos/campos_formato_ordenar.php?idformato=".$_REQUEST["formato"]."&pantalla=tiny'>Ordenar</a>&nbsp;&nbsp;<a href='formatos.php?pantalla=funciones&formato=".$_REQUEST["formato"]."'>Funciones</a><br><br /><br>";
     }
    else
     echo "<br /><br /><a href='?formato=".$_REQUEST["formato"]."&adicionar=1&tipo=".$_REQUEST["tipo"]."'>Adicionar</a>$ordenar<br /><br>";
    }

   if($resultado["numcampos"])
   {echo '<script type="text/javascript" src="../../tiny_mce_popup.js"></script>
<script type="text/javascript" src="jscripts/template.js"></script>	';
    if($_REQUEST["tipo"]=="funciones_formato")
      $col="NOMBRE";
    else
      $col="ETIQUETA";
    echo "<table border='1' style='border-collapse:collapse;' align='center' class='productTable'>
         <tr align='center' bgcolor='lightgray'><td width='30%'>$col</td>
         <td colspan='4'>OPCIONES</td></tr>";
    for($i=0;$i<$resultado["numcampos"];$i++)
      {
       if($_REQUEST["tipo"]=="funciones_formato")
         {echo "<tr><td>".$resultado[$i]["etiqueta"]."</td><td align='center' valign='center'>".'<img onmouseover="ajax_showTooltip(window.event,\'detalles.php?tipo=funciones_formato&id='.$resultado[$i]["idfunciones_formato"].'\',this);return false" onmouseout="ajax_hideTooltip()" src="images/mostrar_nota.png"/>'."</td><td align='center'>";
          echo'<a title="'.$resultado[$i]["descripcion"].'" href="javascript:FormatosDialog.insert(\''.$resultado[$i]["nombre_funcion"].'\');" >Insertar</a></td>';
          if($_REQUEST["formato"])
           echo "<td  align='center'><a href='".$ruta_db_superior."formatos/funciones_formatoedit.php?idformato=".$_REQUEST["formato"]."&key=".$resultado[$i]["idfunciones_formato"]."&pantalla=tiny' >Editar</a></td>";

          if(isset($_REQUEST["formato"])&&$resultado[$i]["formato"]==$_REQUEST["formato"])
             echo "<td align='center'><a  href='".$ruta_db_superior."formatos/funciones_formatodelete.php?idformato=".$_REQUEST["formato"]."&key=".$resultado[$i]["idfunciones_formato"]."&pantalla=tiny' >Eliminar</a></td>";
          elseif(isset($_REQUEST["formato"]))
             echo "<td>&nbsp;</td>";

          echo "</tr>";
         }
       else
         {echo "<tr><td  align='center' >".$resultado[$i]["etiqueta"]."</td><td align='center' valign='center'>".'<img onmouseover="ajax_showTooltip(window.event,\'detalles.php?tipo=campos_formato&id='.$resultado[$i]["idcampos_formato"].'\',this);return false" onmouseout="ajax_hideTooltip()" src="images/mostrar_nota.png"/>'."</td>";
          echo'<td align="center"><a href="javascript:FormatosDialog.insert(\''.$resultado[$i]["nombre"].'\');" >Insertar</a>';
          echo "</td><td  align='center'><a  href='".$ruta_db_superior."formatos/campos_formatoedit.php?idformato=".$_REQUEST["formato"]."&key=".$resultado[$i]["idcampos_formato"]."&pantalla=tiny' >Editar</a></td>";
          echo "</td><td  align='center'><a  href='".$ruta_db_superior."formatos/campos_formatodelete.php?idformato=".$_REQUEST["formato"]."&key=".$resultado[$i]["idcampos_formato"]."&pantalla=tiny'>Eliminar</a></td>";
          echo "</tr>";
         }
      }
    echo "</table></body></html>";
    }
  }
else
{
?>
<table border=0 width="1024">
  <tr>
    <td colspan=2>
      <a href="formatos.php?tipo=campos_formato&formato=<?php echo $_REQUEST["formato"]; ?>">Campos</a></td>
  </tr>
  <tr><td width="512">
      <iframe width="512" frameborder=0 src="formatos.php?tipo=funciones_formato&formato=<?php echo $_REQUEST["formato"]; ?>"></iframe>
      </td>
      <td>
      <iframe frameborder=0 src="formatos.php?tipo=funciones_formato"></iframe>
      </td>
  </tr>
</table>
<?php
}

?>