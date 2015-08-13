<?php
include_once("db.php");
include_once("formatos/librerias/estilo_formulario.php");

if($_REQUEST["accion"]=="ver")
{
$permisos=busca_filtro_tabla("nombres,apellidos,permisos,idpermiso_documento","permiso_documento,funcionario","funcionario=funcionario_codigo and documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);

?>
<B>PERMISOS SOBRE EL DOCUMENTO</B><br /><br />
<a href="?accion=adicionar&iddoc=<?php echo $_REQUEST["iddoc"]; ?>">Adicionar</a><br /><br />
<table border="1" style="border-collapse:collapse">
<tr class="encabezado_list"><td>Funcionario</td><td>Modificar</td><td>Eliminar</td><td>Editar Responsables</td><td></td></tr>
<?php
for($i=0;$i<$permisos["numcampos"];$i++)
 {$perm=explode(",",$permisos[$i]["permisos"]);
  echo "<tr align='center'><td>".ucwords($permisos[$i]["nombres"]." ".$permisos[$i]["apellidos"])."</td><td>";
  if(in_array("m",$perm))
    echo "X";
  echo "</td><td>";
  if(in_array("e",$perm))
    echo "X";
  echo "</td><td>";
  if(in_array("r",$perm))
    echo "X";
  echo "</td><td><a href='?accion=editar&id=".$permisos[$i]["idpermiso_documento"]."' ".'class="highslide" onclick="return hs.htmlExpand( this, {		objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',outlineWhileAnimating: true, preserveContent: false } )"'.">Editar</a></td></tr>";
 } 
?>
</table> 
<?php
}
elseif($_REQUEST["accion"]=="editar")
{$permisos=busca_filtro_tabla("nombres,apellidos,permisos,idpermiso_documento,funcionario_codigo,documento_iddocumento","permiso_documento,funcionario","funcionario=funcionario_codigo and idpermiso_documento=".$_REQUEST["id"],"",$conn);
?>
<B>EDITAR PERMISOS SOBRE EL DOCUMENTO</B><br /><br />
<form name="form1" method="post">
 <table border="1" style="border-collapse:collapse">
<tr class="encabezado_list"><td>Funcionario</td><td>Modificar</td><td>Eliminar</td><td>Editar Responsables</td></tr>
<?php
 $perm=explode(",",$permisos[0]["permisos"]);
  echo "<tr align='center'><td>".ucwords($permisos[0]["nombres"]." ".$permisos[0]["apellidos"])."</td><td><input type='checkbox' name='permisos[]' value='m' ";
  if(in_array("m",$perm))
    echo " checked ";
  echo "></td><td><input type='checkbox' name='permisos[]' value='e' ";
  if(in_array("e",$perm))
    echo " checked ";
  echo "></td><td><input type='checkbox' name='permisos[]' value='r' ";
  if(in_array("r",$perm))
    echo " checked ";
  echo "></td></tr>";
?>
<tr><td colspan=4 align=center>
<input type=hidden name="accion" value="guardar"> 
<input type=hidden value="<?php echo $permisos[0]["funcionario_codigo"]; ?>" name="funcionario">
<input type=hidden value="<?php echo $permisos[0]["documento_iddocumento"]; ?>" name="iddoc">
<input type="submit" value="Guardar"></td></tr>
</table></form> 
<?php
}
elseif($_REQUEST["accion"]=="adicionar")
{
?>
<B>ADICIONAR PERMISOS SOBRE EL DOCUMENTO</B><br /><br />
<form name="form1" method="post">
 <table border="1" style="border-collapse:collapse">
<tr class="encabezado_list"><td>Funcionario</td><td>Modificar</td><td>Eliminar</td><td>Editar Responsables</td></tr>
<tr align='center'><td> <select name="funcionario">
<?php
  $funcionarios=busca_filtro_tabla("nombres,apellidos,funcionario_codigo","funcionario","estado=1","lower(nombres),lower(apellidos)",$conn);
  for($i=0;$i<$funcionarios["numcampos"];$i++)
     echo "<option value='".$funcionarios[$i]["funcionario_codigo"]."'>".$funcionarios[$i]["nombres"]." ".$funcionarios[$i]["apellidos"]."</option>";
?>
</select></td>
<td><input type='checkbox' name='permisos[]' value='m' ></td>
<td><input type='checkbox' name='permisos[]' value='e' ></td>
<td><input type='checkbox' name='permisos[]' value='r' ></td></tr>
<tr><td colspan=4 align=center>
<input type=hidden name="accion" value="guardar"> 
<input type=hidden value="<?php echo $_REQUEST["iddoc"]; ?>" name="iddoc">
<input type="submit" value="Guardar"></td></tr>
</table></form> 
<?php
}
elseif($_REQUEST["accion"]=="guardar")
{ 
 if(@$_REQUEST["funcionario"] && @$_REQUEST["iddoc"])
    {$permisos=implode(",",@$_REQUEST["permisos"]);
     $existe=busca_filtro_tabla("idpermiso_documento","permiso_documento","funcionario='".$_REQUEST["funcionario"]."' and documento_iddocumento='".$_REQUEST["iddoc"]."'","",$conn);
     
     if($permisos=="")
       $sql="delete from permiso_documento where funcionario='".$_REQUEST["funcionario"]."' and documento_iddocumento='".$_REQUEST["iddoc"]."'";
     elseif($existe["numcampos"])
       $sql="update permiso_documento set permisos='".$permisos."' where idpermiso_documento=".$existe[0]["idpermiso_documento"];
     else
      $sql="insert into permiso_documento(funcionario,documento_iddocumento,permisos) values('".$_REQUEST["funcionario"]."','".$_REQUEST["iddoc"]."','".$permisos."')";  
     phpmkr_query($sql,$conn);
    }
// die("doc ".$_REQUEST["iddoc"]);   
 redirecciona("permisos_documento.php?accion=ver&iddoc=".$_REQUEST["iddoc"]);   
}
?>