<?php include_once ("db.php") ?>
<script text="javascript">
</script>
<?php
if(isset($_REQUEST["modulo"])&&($_REQUEST["modulo"]!=""))
{ $filtro="";
  if(isset($_REQUEST["filtro"])&&($_REQUEST["filtro"]!="") && $_REQUEST["filtro"] != usuario_actual("login"))
   $filtro = " and (permiso_admin=0 OR permiso_admin IS NULL)";
  $papa= busca_filtro_tabla("*","modulo A","A.idmodulo=".$_REQUEST["modulo"],"A.etiqueta",$conn);
  $sub = busca_filtro_tabla("*","modulo A","A.cod_padre=".$_REQUEST["modulo"].$filtro,"A.etiqueta",$conn);
  $todos= "" ;
  //print_r($sub);
  if($sub["numcampos"]>0)
  {$todos = "";
   echo "<table border='1' style='empty-cells:show; border-collapse:collapse; width:35px;'>";
   echo("<tr><td colspan='3'>".$papa[0]["ayuda"]."<hr></td></tr>");
   for($i=0; $i<$sub["numcampos"]; $i++)
   {$todos .= $sub[$i]["idmodulo"].",";
    if($i!=0 && $i % 3 ==0 )
      echo "</tr><tr>";
    echo "<td title='".$sub[$i]["ayuda"]."' style='border-style:solid; border-color:#CCCCCC;'><span class='phpmaker' >";
    echo "<input type='checkbox' id='modulo' name='x_modulo_idmodulo[]' value='".$sub[$i]["idmodulo"]."' >".$sub[$i]["etiqueta"]."</span></td>";
   }
   //Termina los espacios que quedan vacios en la tabla
   for(;($i%3)>0;$i++){
    echo("<td style='border-style:solid; border-color:#CCCCCC;'>&nbsp;</td>");
   }
  }
  if($todos!="")
   { echo "</tr><tr><td colspan='3' style='border-style:solid; border-color:#CCCCCC;'><center>";
     echo"<span class='phpmaker'><a href=\"javascript:todos_check('x_modulo_idmodulo[]');\">TODOS</a>&nbsp;|&nbsp;";
     echo"<a href=\"javascript:ninguno_check('x_modulo_idmodulo[]')\">NINGUNO</a></center></span></td>";
   }
 echo"</tr></table>";
?>
</span></td><?php
}
elseif(isset($_POST["grafo"])&& $_POST["grafo"]=='nodo')
{ //die("aqui");
 $sql="update nodo set posx=".$_POST["x"].", posy=".$_POST["y"]." where idnodo=".$_POST["id"]; 
 phpmkr_query($sql,$conn) or die("Fallo al ejecutar el sql" . phpmkr_error() . ' SQL:' . $sql); 
 echo"";
}
elseif(isset($_POST["entidad"])&&($_POST["entidad"]!=""))
{ 
  $orden = "nombre";
  $tabla = $_POST["entidad"];
  $campos = "id$tabla,nombre";
  if($_POST["entidad"]=="funcionario")
  { $orden = "nombre";
    $campos = "id".$tabla.",".concatenar_cadena_sql(array("nombres","' '","apellidos"))." as nombre";
    $id= 1;
  }
  elseif($tabla=="dependencia")
   $id=2;
  else
   $id=4;
  /*if(isset($_POST["serie"]) && $_POST["serie"]!="") 
  {  $asignacion = busca_filtro_tabla("llave_entidad","entidad_serie","entidad_identidad=$id and serie_idserie=".$_POST["serie"],"",$conn);  
    if($asignacion["numcampos"]>0)
    {$list="";
     for($i=0; $i<$asignacion["numcampos"]; $i++)
      $list .= $asignacion[$i]["llave_entidad"].",";
     $list = substr($list, 0, -1); 
     $entidad = busca_filtro_tabla($campos,"$tabla","id$tabla NOT IN($list) and estado=1",$orden,$conn);
     //echo $sql;   
    }
    else
     $entidad = busca_filtro_tabla($campos,"$tabla","estado=1",$orden,$conn);
  }
  else     */
   $entidad = busca_filtro_tabla($campos,"$tabla","estado=1",$orden,$conn);  
  if($entidad["numcampos"]>0)
  {$todos = "";
   //if(isset($_POST["serie"]) && $_POST["serie"]!="")
   //{
    echo "<table border='0'><tr>
          <td colspan=2>
          <label for='x_entidad_identidad[]' class='error'>Campo obligatorio</label></td>
          </tr><tr>";
    echo "<td><span class='phpmaker'>";
    echo "<input class='checkbox required' type='checkbox' id='entidad0' name='x_entidad_identidad[]' value='".$entidad[0]["id$tabla"]."'>".codifica_encabezado($entidad[0][$orden])."</span></td>"; 
 
    for($i=1; $i<$entidad["numcampos"]; $i++)
     {$todos .= $entidad[$i]["identidad"].",";
      if($i % 2 ==0 )
       echo "</tr><tr>";    
      echo "<td><span class='phpmaker'>";
      echo "<input class='checkbox' type='checkbox' id='entidad$i' name='x_entidad_identidad[]' value='".$entidad[$i]["id$tabla"]."'>".codifica_encabezado($entidad[$i][$orden])."</span></td>";     
      }
   /*}
   else
   {
    echo "<select name='x_entidad_identidad'>";
    for($i=0; $i<$entidad["numcampos"]; $i++)
     echo "<option value='".$entidad[$i]["id$tabla"]."'>".codifica_encabezado($entidad[$i][$orden])."</option>";
    echo "</select>";  
   }  */ 
  }
  if($todos!="")
   { echo "</tr><tr><td colspan='2'><center>";
     echo"<span class='phpmaker'><a href=\"javascript:todos_check('x_entidad_identidad[]');\">TODOS</a>&nbsp;|&nbsp;";
     echo"<a href=\"javascript:ninguno_check('x_entidad_identidad[]')\">NINGUNO</a></center></span></td>";
   }   
 echo"</tr></table>";
 echo "<input type='hidden' name='identidad' value=".$id.">";
?>
</span></td><?php	
}
else
{ 
$llave = @$_POST["key"];
if(isset($llave) && $llave!="")
{  
    $llave = $_POST["key"];
    $pag = $_POST["pag"];
   ?>
   <table border="1" align="center">
   <tr><td><?php
   echo "<a href=\"comentario_img.php?key=".$llave."&pag=".$pag."&accion=mostrar\" target=\"centro\">Mostrar comentarios</a>";?>
   </td><td><?php
   echo "<a href=\"comentario_img.php?key=".$llave."&pag=".$pag."&accion=adicionar\">Nuevo comentario</a>";?>
   </td><td><?php
   echo "<a href=\"paginaadd.php?key=".$llave."\">Nueva Pagina</a>";?>
   </table>
   <?php
}
else
{ $x=str_replace("px","",$_POST["x"]);
$y=str_replace("px","",$_POST["y"]);
$sql="update comentario_img set posx=".$x.", posy=".$y." where idcomentario_img=".$_POST["id"];
//echo $sql;
  phpmkr_query($sql,$conn) or error("Fallo al ejecutar el sql SQL:" . $sql);  
}
}
?>



