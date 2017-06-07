<?php
/*
<Archivo>
<Nombre>activar_documento.php</Nombre>
<Parametros>$_REQUEST["buscar"]:permite mostrar el fomulario de busqueda, $_REQUEST["key"]:numero de radicado, $_REQUEST["plantilla"]:tipo de plantilla</Parametros>
<ruta>saia1.06/activar_documento.php</ruta>
<Responsabilidades>permite buscar documentos por numero y plantilla y muestra el resultado y muestra enlace para activar el documento<Responsabilidades>
<Notas></Notas>
<Salida>Muestra en pantalla un formulario para busqueda de documento y muestra un listado con el resultado</Salida>
</Archivo>
*/
include_once("db.php");
include_once("header.php");
if(!isset($_REQUEST["buscar"]))
{
?>
<script>
function seleccionado(tipo)
{if(tipo=="plantilla")
   document.getElementById("tr_plantilla").style.display="";
 else
   document.getElementById("tr_plantilla").style.display="none";
}
</script>
<form accept="Activar" enctype="text/plain" action="" target="listado" name="form1">
  <a href="activar_documentolist.php?cmd=resetall" target="listado">Listado de Documentos Activados</a>
    <a/>
    <br/>
    <br/>
    <table border="0">
      <tr>
        <td class="encabezado"> Ingrese el N&uacute;mero de Radicado</td>
        <td bgcolor="#f5f5f5">
          <input type="text" accesskey="A" name="key" size="10"></td>
      </tr>
      <tr>
        <td class="encabezado"> Tipo de documento</td><td bgcolor="#f5f5f5">
        <input type="radio" name="tipo_documento" value="plantilla" onclick="seleccionado('plantilla')">Plantilla&nbsp;&nbsp;
        <input type="radio" name="tipo_documento" value="rad_entrada" onclick="seleccionado('entrada')" checked>Entrada </td>
       </tr>
       <tr id="tr_plantilla" style="display:none">
       <td class="encabezado">Plantilla</td> <td bgcolor="#f5f5f5">
         <?php
      $formatos = busca_filtro_tabla("distinct f.nombre,lower(f.etiqueta) as etiqueta","formato f","f.mostrar=1 or f.cod_padre>0","lower(f.etiqueta) asc", $conn);
       //print_r($formatos);
       ?>
          <select title="tipo" name="plantilla" id="">
<?php
       for($i=0; $i<$formatos["numcampos"]; $i++)
       {
        echo "<option value='".$formatos[$i]["nombre"]."'>".ucfirst($formatos[$i]["etiqueta"])."</option>";
       }
            ?>
          </select></td>
      </tr-->
    </table><br />
    <input type="hidden" name="func" value="1">
    <input type="submit" accesskey="r" name="buscar" value="Buscar" onclick="form1.action='activar_documento.php';">
</form>
<iframe name="listado" frameborder="no" id="listado" src="activar_documentolist.php?cmd=resetall" width="100%" height="400">
</iframe>
</html>
<?php
}
else if(@$_REQUEST["key"])
{
 if($_REQUEST["tipo_documento"]=="rad_entrada")
   $res= busca_filtro_tabla("","documento","documento.numero='".$_REQUEST["key"]."' AND documento.estado='APROBADO' and activa_admin=0 and tipo_radicado=1","fecha desc",$conn);
 else
   $res= busca_filtro_tabla("","documento","documento.numero='".$_REQUEST["key"]."' AND documento.estado='APROBADO' and activa_admin=0 and lower(plantilla)='".$_REQUEST["plantilla"]."'","fecha desc",$conn);
 //print_r($res)
?>
<b>DOCUMENTOS ENCONTRADOS</b><br />
<script>
document.getElementById("header").style.display="none";
document.getElementById("ocultar").style.display="none";
</script>
<table border="1" width="100%">
  <tr class="encabezado_list">
    <td>
      Fecha de radicaci&oacute;n</td>
    <td>
      N&uacute;mero de radicaci&oacute;n</td>
    <td>
      Descripcion</td>
    <td>
      Plantilla</td>
    <td colspan="2"></td>
  </tr>
<?php
 $ruta = strtolower($_REQUEST["plantilla"]);
  for($i=0;$i<$res["numcampos"];$i++)
     {echo "<tr><td>".$res[$i]["fecha"]."</td>
            <td>".$res[$i]["numero"]."&nbsp;</td>
            <td>".$res[$i]["descripcion"]."&nbsp;</td>
            <td>".$res[$i]["plantilla"]."&nbsp;</td>
            <td width='30px'>";
      echo "<a href='activar_documentofunc.php?func=1&key=".$res[$i]["iddocumento"]."'>Activar</a>";
      echo "&nbsp;</td>";
      echo "<td width='30px'>";
      if($res[$i]["plantilla"] != "")
      	echo "<a href='" . FORMATOS_CLIENTE . "$ruta/mostrar_$ruta.php?iddoc=".$res[$i]["iddocumento"]."'>Detalles</a>";
      echo "&nbsp;</td></tr>";
     }
  ?>
</table>
<?php
}
else alerta("Por Favor Seleccione un Documento",'error',4000);
include_once("footer.php");
?>
