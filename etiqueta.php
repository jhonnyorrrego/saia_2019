<?php
include_once("header.php");
include_once("db.php");
include_once("librerias_saia.php");
echo(estilo_bootstrap() );
echo(librerias_jquery("1.7"));
if(@$_REQUEST["key"] && @$_REQUEST["accion"]=='seleccionar_etiqueta'){
	$doc_menu=@$_REQUEST["key"];
	include_once("pantallas/documento/menu_principal_documento.php");
	echo(menu_principal_documento($doc_menu,1));
}

?>
<div  align="center">
<?php
menu_ordenar($_REQUEST["key"]);
?>
</div>

<?php
$usuario=usuario_actual("funcionario_codigo");
if(!isset($_REQUEST["accion"]))
{global $conn;
 ?>
 <script type="text/javascript" src="anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = 'anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
 <?php
 echo "<br><b>ETIQUETAS</b><br><br>
 <a href='etiqueta.php?accion=adicionar' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 400, height:200,preserveContent:false } )'>Adicionar</a>
 <br><br>";
 $etiquetas=busca_filtro_tabla("","etiqueta","funcionario='".$usuario."' and privada_saia=0","lower(nombre)",$conn);

 if($etiquetas["numcampos"])
   {
    echo "<table align='center' width='50%' border='1' style='border-collapse:collapse'>
          <tr class='encabezado_list'><td>NOMBRE ETIQUETA</td>
          <td>DOCUMENTOS</td>
          <td colspan='3'>OPCIONES</td>
          </tr>";
    for($i=0;$i<$etiquetas["numcampos"];$i++)
      {$documentos=busca_filtro_tabla("count(*)","documento_etiqueta,documento,etiqueta","etiqueta_idetiqueta=idetiqueta and funcionario='".$usuario."' and documento_iddocumento=iddocumento and estado<>'ELIMINADO' and etiqueta_idetiqueta='".$etiquetas[$i]["idetiqueta"]."'","",$conn);

       echo "<tr align='center'><td>".$etiquetas[$i]["nombre"]."</td>
            <td>".$documentos[0][0]."</td>
            <td><a href='etiqueta.php?accion=editar&key=".$etiquetas[$i]["idetiqueta"]."' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 400, height:200,preserveContent:false } )'>Editar</a></td>
            <td><a href='JavaScript:eliminar_etiqueta(\"".$etiquetas[$i]["idetiqueta"]."\")'>Eliminar</a></td>
            <td><a href='etiquetalist.php?etiqueta=".$etiquetas[$i]["idetiqueta"]."'>Ver documentos</a>
            </td></tr>";
     }

    $documentos=busca_filtro_tabla("count(*)","documento","iddocumento NOT IN (SELECT DISTINCT documento_iddocumento FROM documento_etiqueta, etiqueta WHERE etiqueta_idetiqueta = idetiqueta AND privada_saia=0 and funcionario = '$usuario') AND iddocumento IN (
SELECT DISTINCT archivo_idarchivo FROM buzon_salida b  WHERE (b.destino = '$usuario' OR origen='$usuario') and b.nombre not like 'ELIMINADO_%') AND estado<>'ELIMINADO'","",$conn);
  //  print_r($documentos);
    echo "<tr align='center'><td>Sin etiqueta</td>
            <td>".$documentos[0][0]."</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><a href='etiquetalist.php'>Ver documentos</a>
            </td></tr>";
    echo "</table>";
   }
 else
   echo "No hay etiquetas para mostrar.";
}
elseif($_REQUEST["accion"]=="eliminar")
{global $conn;
 $sql="delete from etiqueta where idetiqueta='".$_REQUEST["key"]."'";
 phpmkr_query($sql,$conn);
 $sql="delete from documento_etiqueta where etiqueta_idetiqueta='".$_REQUEST["key"]."'";
 phpmkr_query($sql,$conn);
 alerta("Etiqueta eliminada.");
 redirecciona("etiqueta.php");
}
elseif($_REQUEST["accion"]=="adicionar"||$_REQUEST["accion"]=="editar")
{global $conn;
 if($_REQUEST["accion"]=="editar")
   $dato=busca_filtro_tabla("","etiqueta","idetiqueta=".$_REQUEST["key"],"",$conn);
 echo "<br /><br /><p><span class='internos'>".strtoupper($_REQUEST["accion"]." Etiqueta")."</p></span><br /><br />";
 ?>
 <form name="form1" method="post">
 <table>
 <tr>
 <td class="encabezado">NOMBRE*</td>
 <td bgcolor="#F5F5F5"><input type="text" name="nombre" value="<?php echo @$dato[0]["nombre"]; ?>"></td>
 </tr>
 <td >
 	<br/>

 	<input type="button" class="btn btn-mini btn-danger" value="Cancelar" onclick="window.parent.hs.close();">
 <input type="button" value="Guardar"  class="btn btn-mini btn-primary" onclick="if(form1.nombre.value!='')form1.submit(); else alert('Debe llenar el campo nombre');">
 <input type="hidden" name="accion" value="guardar_<?php echo $_REQUEST["accion"]; ?>">
 <input type="hidden" name="key" value="<?php echo $_REQUEST["key"]; ?>">
 </td>
 </tr>
 </table>
 </form>
 <script>
 document.getElementById("header").style.display="none";
 document.getElementById("ocultar").style.display="none";
 </script>
 <?php
}
elseif($_REQUEST["accion"]=="guardar_adicionar")
{global $conn;
 $repetida=busca_filtro_tabla("","etiqueta","trim(lower(nombre)) like '".trim(strtolower($_REQUEST["nombre"]))."' and privada_saia=0 and funcionario='".$usuario."'","",$conn);
 //print_r($repetida);die();
 if($repetida["numcampos"])
   alerta("Ya existe una etiqueta con el mismo nombre.");
 else
   {$sql="insert into etiqueta(nombre,funcionario) values('".$_REQUEST["nombre"]."','".$usuario."')";
    phpmkr_query($sql,$conn);
    $id=phpmkr_insert_id();
    if($id)
      alerta("Etiqueta creada.");
    else
      alerta("No se pudo crear la etiqueta.");
   }
 echo '<script>window.parent.hs.close();window.parent.location=window.parent.location;</script>';
}
elseif($_REQUEST["accion"]=="guardar_editar")
{global $conn;
 $repetida=busca_filtro_tabla("","etiqueta","trim(lower(nombre)) like '".trim(strtolower($_REQUEST["nombre"]))."' and privada_saia=0 and funcionario='".$usuario."'","",$conn);
 if($repetida["numcampos"])
   alerta("Ya existe una etiqueta con el mismo nombre.");
 else
   {$sql="update etiqueta set nombre='".$_REQUEST["nombre"]."' where idetiqueta='".$_REQUEST["key"]."'";
    phpmkr_query($sql,$conn);
    alerta("Etiqueta editada.");
   }
 echo '<script>window.parent.hs.close();window.parent.location="etiqueta.php";</script>';
}
elseif($_REQUEST["accion"]=="seleccionar_etiqueta")
{global $conn;
 $etiquetas=busca_filtro_tabla("","etiqueta","funcionario=".$usuario." and privada_saia=0","lower(nombre) ",$conn);
 $documento=busca_filtro_tabla("etiqueta_idetiqueta","documento_etiqueta,etiqueta","etiqueta_idetiqueta=idetiqueta and documento_iddocumento=".$_REQUEST["key"]." and privada_saia=0 and funcionario=".$usuario,"",$conn);
 $seleccionados=extrae_campo($documento,"etiqueta_idetiqueta","U");

 ?>
 <link rel="stylesheet" type="text/css" href="dropdownlist/ui.dropdownchecklist.css" />
 <script type="text/javascript" src="dropdownlist/jquery.js"></script>
 <script type="text/javascript" src="dropdownlist/ui.core.js"></script>
 <script type="text/javascript" src="dropdownlist/ui.dropdownchecklist.js"></script>
 <script type="text/javascript" src="anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = 'anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
 <br /><br /><p><span class="internos">ETIQUETAR DOCUMENTO</span></p><br /><br /><form name='form1' method='post'>

		<ul class="nav nav-tabs">
		 <li ><a href='etiqueta.php?accion=adicionar' onclick='return hs.htmlExpand(this, { objectType: "iframe",width: 400, height:200,preserveContent:false } )'>Adicionar Etiqueta</a ></li>
		</ul>
 <br />
 <?php
 if($etiquetas['numcampos']){
 ?>
 <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC"  width="100%"><tr><td  class="encabezado">Etiquetas:
 </td><td bgcolor="#F5F5F5">

 <?php
 $max_etiquetas=1;
 for($i=0;$i<$etiquetas["numcampos"];$i++)
    {echo "<input type='checkbox' name='etiquetas[]' value='".$etiquetas[$i]["idetiqueta"]."'";
     if(in_array($etiquetas[$i]["idetiqueta"],$seleccionados)){
     	echo " checked ";
     }

     echo ">&nbsp;".$etiquetas[$i]["nombre"]."&nbsp;&nbsp;&nbsp;&nbsp;";

     if($max_etiquetas==4){
     	echo('<br/><br/>');
     	$max_etiquetas=1;
     }else{
     	$max_etiquetas++;
     }

    }
 ?>


 <!-- select id='etiquetas' name='etiquetas[]' multiple='multiple'>
 <?php
 for($i=0;$i<$etiquetas["numcampos"];$i++)
    {echo "<option value='".$etiquetas[$i]["idetiqueta"]."'";
     if(in_array($etiquetas[$i]["idetiqueta"],$seleccionados))
        echo " selected ";
     echo ">".$etiquetas[$i]["nombre"]."</option>";
    }
 ?>
 </select -->

 </td></tr>
 <tr><td colspan=2>
	<br/>
 <input type='hidden' name='documento' value='<?php echo $_REQUEST["key"]; ?>'>
 <input type='hidden' name='accion' value='etiquetar_documento'>
 </table>
 <?php
  }
 ?>

     <input type="button" class="btn btn-mini btn-danger" value="Cancelar" onclick="window.history.back(-1);">
 <?php
 if($etiquetas['numcampos']){
 ?>
    <input type="submit"  class="btn btn-mini btn-primary"value="Guardar">
  <?php
  }
 ?>
 </form>
 <script>
 $(document).ready(function() {
 $('#etiquetas').dropdownchecklist({width:200, maxDropHeight: 100});
 });
 //document.getElementById("header").style.display="none";
// document.getElementById("ocultar").style.display="none";
 </script>
 <?php
}
elseif($_REQUEST["accion"]=="etiquetar_documento"){
global $conn;
 $sql2="delete from documento_etiqueta where etiqueta_idetiqueta in(select idetiqueta from etiqueta where privada_saia=0 and funcionario='".$usuario."') and documento_iddocumento='".$_REQUEST["key"]."'";
 phpmkr_query($sql2,$conn);
 foreach($_REQUEST["etiquetas"] as $fila){
 	$sql2="insert into documento_etiqueta(documento_iddocumento,etiqueta_idetiqueta) values('".$_REQUEST["key"]."','$fila')";
    phpmkr_query($sql2,$conn);
   }
	$formato=busca_filtro_tabla("f.ruta_mostrar,f.nombre,f.idformato","documento d, formato f","lower(f.nombre)=lower(d.plantilla) and d.iddocumento=".$_REQUEST["key"],"",$conn);
  alerta("Documento Etiquetado.");  
  ?>
  <script>
      $("#div_actualizar_info_index",top.document).click();
  </script>
  <?php
  abrir_url(FORMATOS_CLIENTE.$formato[0]['nombre']."/".$formato[0]['ruta_mostrar']."?iddoc=".$_REQUEST["key"]."&idformato=".$formato[0]['idformato'],"_self");
}
include_once("footer.php");
?>
<script>
function eliminar_etiqueta(id)
{if(confirm("�En realidad desea eliminar la etiqueta?"))
   window.location="etiqueta.php?accion=eliminar&key="+id;
}
</script>
