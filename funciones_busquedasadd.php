<?php
include_once("db.php");
include_once("header.php");
?>
<a href="busquedaadd.php?accion=listar">Regresar al listado</a>  
<br><br><b>ADICIONAR FUNCION A UN LISTADO</b><br><br>
<?php
if(isset($_REQUEST["accion"]))
{switch (trim($_REQUEST["accion"]))
   {case 'guardar_adicionar':
     $sql="INSERT INTO funciones_busqueda(idfunciones_busqueda,etiqueta,tipo,busquedas_idbusqueda,orden,pagina,parametros) VALUES('".$_REQUEST["idfunciones_busqueda"]."','".$_REQUEST["etiqueta"]."','".$_REQUEST["tipo"]."','".$_REQUEST["busquedas_idbusqueda"]."','".$_REQUEST["orden"]."','".$_REQUEST["pagina"]."','".$_REQUEST["parametros"]."')";
     $insertado=ejecuta_sql($sql);
    $busqueda=busca_filtro_tabla("","funciones_busqueda","idfunciones_busqueda=".$_REQUEST["idfunciones_busqueda"],"",$conn);
     if($busqueda["numcampos"])
       alerta("Creado.",'success',4000);
     else 
       alerta("No se pudo crear.",'error',4000);
    break;
    case 'guardar_editar':
    
     $sql="UPDATE funciones_busqueda SET etiqueta='".$_REQUEST["etiqueta"]."',tipo='".$_REQUEST["tipo"]."',busquedas_idbusqueda='".$_REQUEST["busquedas_idbusqueda"]."',orden='".$_REQUEST["orden"]."',pagina='".$_REQUEST["pagina"]."',parametros='".$_REQUEST["parametros"]."' WHERE idfunciones_busqueda='".$_REQUEST["idfunciones_busqueda"]."'";
     $insertado=ejecuta_sql($sql);
     if($insertado)
       alerta("Actualizado.",'success',4000);
     else 
       alerta("No se pudo actualizar.",'error',4000);  
    break;
    case 'guardar_eliminar':
    /* $sql="DELETE FROM modulo WHERE idmodulo='".$_REQUEST["idmodulo"]."'";
     ejecuta_sql($sql);
     alerta("Modulo Eliminado."); */
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
   }
   
}

function select_busquedas($valor=0)
{$modulos=busca_filtro_tabla("idbusquedas,etiqueta","busquedas","","etiqueta asc",$conn);
 $select_mod="<select name='busquedas_idbusqueda' class='required' id='busquedas_idbusqueda'><option value='' selected>Ninguno</option>";
 for($i=0;$i<$modulos["numcampos"];$i++)
    {
     $select_mod.="<option value='".$modulos[$i]["idbusquedas"]."'";
     if($valor==$modulos[$i]["idbusquedas"])
        $select_mod.=" selected ";
     $select_mod.=" >".$modulos[$i]["etiqueta"]."</option>";
    }
 $select_mod.="</select>";
 return($select_mod);   
}

function formato_adicionar($idmodulo=NULL,$ver=0)
{
 if($idmodulo<>NULL)
    {$modulo=busca_filtro_tabla("","funciones_busqueda","idfunciones_busqueda=$idmodulo","",$conn);
     if(!$modulo["numcampos"])
        {alerta('Modulo no encontrado.','error',4000);
        }
    }
 else   
   {$modulo[0]["tipo"]="link";
    $modulo[0]["orden"]="0"; 
    $numero=busca_filtro_tabla("max(idfunciones_busqueda)","funciones_busqueda","","",$conn);
    $modulo[0]["idfunciones_busqueda"]=$numero[0][0]+1;
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
<td class="encabezado" width="20%">ID*</td>
<td><input size="60" readonly=true type="text" class="required" name="idfunciones_busqueda" id="idfunciones_busqueda" value="<?php echo @$modulo[0]["idfunciones_busqueda"]; ?>"></td>
</tr>
<tr>
<td class="encabezado" width="20%">ETIQUETA*</td>
<td><input size="60" type="text" class="required" name="etiqueta" id="etiqueta" value="<?php echo @$modulo[0]["etiqueta"]; ?>"></td>
</tr> 
<tr>
<td class="encabezado" >BUSQUEDA*</td>
<td>
<?php echo select_busquedas(@$modulo[0]["busquedas_idbusqueda"]); ?>
</td>
</tr>
<tr>
<td class="encabezado" >PAGINA*</td>
<td><input size="60" type="text" class="required" name="pagina"  id="pagina" value="<?php echo @$modulo[0]["pagina"]; ?>"></td>
</tr> 
<tr>
<td class="encabezado" >PARAMETROS</td>
<td><input size="60" type="text" name="parametros" id="parametros" value="<?php echo @$modulo[0]["parametros"]; ?>"></td>
</tr> 
<tr>
<td class="encabezado" >TIPO*</td>
<td><input type="text" name="tipo" class="required"  id="tipo" value="<?php echo @$modulo[0]["tipo"]; ?>"></td>
</tr> 
<tr>
<td class="encabezado" >ORDEN*</td>
<td><input size="60" type="text" class="required" name="orden"  id="orden" value="<?php echo @$modulo[0]["orden"]; ?>"></td>
</tr> 
<tr>
<td id="div_submit" >
<input type="hidden" name="accion" id="accion" value="<?php echo "guardar_".$_REQUEST["accion"]; ?>">
<input type="submit" class="submit" value="Guardar"  name="guardar_modulo" id="guardar_modulo"></td>
</tr>           
</table>
</form>
<?php
}

include_once("footer.php");
?>