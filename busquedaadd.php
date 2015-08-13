<?php
include_once("db.php");
include_once("header.php");
?>
<a href="busquedaadd.php?accion=listar">Regresar al listado</a>
<br><br><b><?php echo strtoupper($_REQUEST["accion"]); ?> LISTADO</b><br><br>
<?php
if(isset($_REQUEST["key"]))
  $_REQUEST["idmodulo"]=$_REQUEST["key"];

if(isset($_REQUEST["accion"]))
{switch (trim($_REQUEST["accion"]))
   {case 'guardar_adicionar':
     if(MOTOR=="Oracle")
       $_REQUEST["codigo"]=str_replace("'","''",$_REQUEST["codigo"]);
     $sql="INSERT INTO busquedas(idbusquedas,etiqueta,codigo,tipo_b,llave,ordenado,orden,modulo_idmodulo,tablas) VALUES('".$_REQUEST["idbusquedas"]."','".$_REQUEST["etiqueta"]."','".$_REQUEST["codigo"]."','".$_REQUEST["tipo_b"]."','".$_REQUEST["llave"]."','".$_REQUEST["ordenado"]."','".$_REQUEST["orden"]."','".$_REQUEST["modulo_idmodulo"]."','".$_REQUEST["tablas"]."')";
     $insertado=ejecuta_sql($sql);
     $busqueda=busca_filtro_tabla("","busquedas","idbusquedas=".$_REQUEST["idbusquedas"],"",$conn);
     if($busqueda["numcampos"])
       {alerta("Listado creado.");
        redirecciona("busquedaadd.php?accion=listar"); 
       }
     else 
       {alerta("No se pudo crear el Listado.");
        volver(1);
       } 
    break;
    case 'guardar_editar': 
    if(MOTOR=="Oracle")
       $_REQUEST["codigo"]=str_replace("'","''",$_REQUEST["codigo"]) ;
     $sql1="UPDATE busquedas SET etiqueta='".$_REQUEST["etiqueta"]."',codigo='".$_REQUEST["codigo"]."',tipo_b='".$_REQUEST["tipo_b"]."',llave='".$_REQUEST["llave"]."',ordenado='".$_REQUEST["ordenado"]."',orden='".$_REQUEST["orden"]."',modulo_idmodulo='".$_REQUEST["modulo_idmodulo"]."',tablas='".$_REQUEST["tablas"]."' WHERE idbusquedas='".$_REQUEST["idbusquedas"]."'";
     $conn->Ejecutar_Sql($sql1);
     alerta("Listado actualizado.");
    redirecciona("busquedaadd.php?accion=listar"); 
    break;
    case 'guardar_eliminar':
     $sql="DELETE FROM busquedas WHERE idbusquedas='".$_REQUEST["idbusquedas"]."'";
    ejecuta_sql($sql);
    alerta("Listado Eliminado.");
    redirecciona("busquedaadd.php?accion=listar");
    break;
    case 'adicionar':
     formato_adicionar();
    break;
    case 'editar':
     formato_adicionar($_REQUEST["idmodulo"]);
    break;
    case 'ver':
      formato_adicionar($_REQUEST["idmodulo"],1);
    break;
    case 'eliminar':
      formato_adicionar($_REQUEST["idmodulo"],2);
    break;
    case 'listar':
    $datos=busca_filtro_tabla("","busquedas","etiqueta='listados'","",$conn);
 //   print_r($datos);die();
    $funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=".$datos[0][0],"",$conn);
if($funciones<>"")
  {for($i=0; $i<$funciones["numcampos"]; $i++)
      {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
      }
   $id_func=implode(",",$id_func);
  }

  if($datos["numcampos"])
    {
  ?>
  <form name=form1 action="buscador/index.php" method="post">
  <input type="hidden" name="busqueda" value="busqueda">
  <input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
  <input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
  <input type="hidden" name="registros" value="10">
  <input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
  <input type="hidden" name="ordenar" value="<?php echo $datos[0]["ordenado"]; ?>">
  <input type="hidden" name="tablas" value="tablas">
  <input type="hidden" name="tabla" value="busquedas">
  <input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
  <input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
  <input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
  <input type="hidden" name="sql" value="<?php echo $datos[0]["codigo"]; ?>">
  <input type="image" src="<?php echo "/".RUTA_SCRIPT."/imagenes/cargando.gif"; ?>">
  </form>  
  <script>
  form1.submit();
  </script>
  <?php  
    }
    break;
   }
   
}

function select_modulos($valor=0)
{$modulos=busca_filtro_tabla("idmodulo,etiqueta,nombre","modulo","","cod_padre,etiqueta asc",$conn);
 $select_mod="<select name='modulo_idmodulo' id='modulo_idmodulo'><option value='0' selected>Ninguno</option>";
 for($i=0;$i<$modulos["numcampos"];$i++)
    {
     $select_mod.="<option value='".$modulos[$i]["idmodulo"]."'";
     if($valor==$modulos[$i]["idmodulo"])
        $select_mod.=" selected ";
     $select_mod.=" >".$modulos[$i]["etiqueta"]." (".$modulos[$i]["nombre"].")</option>";
    }
 $select_mod.="</select>";
 return($select_mod);   
}

function formato_adicionar($idmodulo=NULL,$ver=0)
{if($idmodulo<>NULL)
    {$modulo=busca_filtro_tabla("","busquedas","idbusquedas=$idmodulo","",$conn);   
     if(!$modulo["numcampos"])
        {alerta('Busqueda no encontrada.');
        }
    }
 else
   {$modulo[0]["tipo_b"]="listado";
    $modulo[0]["orden"]="asc";
    $numero=busca_filtro_tabla("max(idbusquedas)","busquedas","","",$conn);
    $modulo[0]["idbusquedas"]=$numero[0][0]+1;
   }   
    
?> 
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/cmxforms.js"></script>
<script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#form1').validate();
	
});
</script>
<?php
if($ver==1)
  {
  ?>
   <script type='text/javascript'>
  $().ready(function() {
	$("input").attr("readonly","true");
  $("select").attr("disabled","disabled");		
  $("#div_submit").html("");
});
</script>
  <?php
  }
if($ver==2)
  {
  ?>
   <script type='text/javascript'>
  $().ready(function() {
	$("input").attr("readonly","true");
  $("select").attr("disabled","disabled");
  $("#accion").val("guardar_eliminar");		
  $("#guardar_modulo").val("Eliminar");
});
</script>
  <?php
  }  

?>
<form action="" method="post" id="form1" name="form1">
<table width="100%">
<tr>
<td class="encabezado" width="20%">IDBUSQUEDAS*</td>
<td><input size="60" type="text" class="required" name="idbusquedas" id="idbusquedas" value="<?php echo @$modulo[0]["idbusquedas"]; ?>"></td>
</tr>
<tr>
<td class="encabezado" width="20%">ETIQUETA*</td>
<td><input size="60" type="text" class="required" name="etiqueta" id="etiqueta" value="<?php echo @$modulo[0]["etiqueta"]; ?>"></td>
</tr> 
<tr>
<td class="encabezado" >CONSULTA*</td>
<td><textarea class="required" name="codigo" cols=60 rows=20 id="codigo" ><?php echo @$modulo[0]["codigo"]; ?></textarea></td>
</tr>
<tr>
<td class="encabezado" >TIPO*</td>
<td><input size="60" type="text" class="required" name="tipo_b"  id="tipo_b" value="<?php echo @$modulo[0]["tipo_b"]; ?>"></td>
</tr> 
<tr>
<td class="encabezado" >LLAVE*</td>
<td><input size="60" type="text" class="required" name="llave" id="llave" value="<?php echo @$modulo[0]["llave"]; ?>"></td>
</tr> 
<tr>
<td class="encabezado" >ORDENADO</td>
<td><input size="60" type="text" name="ordenado"  id="ordenado"value="<?php echo @$modulo[0]["ordenado"]; ?>"></td>
</tr> 
<tr>
<td class="encabezado" >ORDEN</td>
<td><input size="60" type="text" class="required" name="orden"  id="orden" value="<?php echo @$modulo[0]["orden"]; ?>"></td>
</tr> 
<tr>
<td class="encabezado" >TABLAS</td>
<td><input size="60" type="text" name="tablas"  id="tablas" value="<?php echo @$modulo[0]["tablas"]; ?>"></td>
</tr> 
<tr>
<td class="encabezado" >MODULO</td>
<td>
<?php echo select_modulos(@$modulo[0]["modulo_idmodulo"]); ?>
<input type="hidden" name="accion" id="accion" value="<?php echo "guardar_".$_REQUEST["accion"]; ?>">
<input type="hidden" name="idmodulo" value="<?php echo $_REQUEST["idmodulo"]; ?>">
<input type="hidden" name="grafico" value="0">
</td>
</tr>      
<tr>
<td id="div_submit" ><input type="submit" class="submit" value="Guardar"  name="guardar_modulo" id="guardar_modulo"></td>
</tr>           
</table>
</form>
<?php
}

include_once("footer.php");
?>