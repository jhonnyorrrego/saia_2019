<?php session_start(); ?>
<?php ob_start(); ?>
<?php
/*header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0*/ 
?>
<script type="text/javascript">
 function validar(t)
 {var cont=0;  
  var id="";
  var checkboxes =mostrar_permisos.modulo;
for (var x=0; x < checkboxes.length; x++) {
  if(!(checkboxes[x].checked)) 
  {
    id += checkboxes[x].value+"#";
    cont = cont + 1;
  }
}
 mostrar_permisos.total.value=cont;
 mostrar_permisos.id.value=id;
 mostrar_permisos.submit();
  return true;
 }
</script>
<?php include ("db.php") ?>
<?php include ("header.php")?>
<?php

if(isset($_POST["accion"]))
{
 $j=0; 
 $datos = explode('#',$_POST["id"]); 
 for($j=0; $j<(count($datos)-1); $j++)
 { 
   $sql= "delete from permiso where idpermiso= $datos[$j]";
   phpmkr_query($sql,$conn) or error("Falló la búsqueda" . phpmkr_error() . ' SQL: ' . $sql);   
 }
 redirecciona("funcionarioview.php?key=".$_POST["idfuncionario"]); 
}
else
{
  if(isset($_GET["idfuncionario"]))
   $idfuncionario = $_GET["idfuncionario"]; 
  $padre_base ="";
  $funcionario = busca_tabla("funcionario",$idfuncionario);
  //Busco los modulos que el funcionairio tiene permisos 
  $permisos = busca_filtro_tabla("*","permiso p, modulo m","p.modulo_idmodulo=m.idmodulo and p.funcionario_idfuncionario=$idfuncionario","cod_padre",$conn);
  $contador=0;
  echo '<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/permiso.gif" border="0">&nbsp;&nbsp;PERMISOS DE ACCESO PARA '.$funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"].'</span></p>';
  echo "<a href='permisoadd.php?idfuncionario=$idfuncionario'><span class='phpmaker'>Adicionar un nuevo permiso</span></a>&nbsp;&nbsp;&nbsp;&nbsp;
  <a href='funcionarioview.php?key=$idfuncionario'><span class='phpmaker'>Volver a detalles</span></a><br /><br />";  
  echo "<form name='mostrar_permisos' id='mostrar_permisos' action='mostrar_permisos.php' method='POST'>
        <table border='0'><tr>";
  echo "<input type='hidden' name='accion' value='admin'>"; 
  $j=0; $una_vez = true;
  for($i=0; $i<$permisos["numcampos"]; $i++)
  { 
     if($permisos[$i]["cod_padre"]== Null || $permisos[$i]["cod_padre"]== 0)    
      { if($permisos[$i]["nombre"]<>'radicacion' && $permisos[$i]["nombre"]<>'configuracion' && $permisos[$i]["nombre"]<>'documento')
        echo "<td><span class='phpmaker'><input type='checkbox' name='modulo' value='".$permisos[$i]["idpermiso"]."' checked>".$permisos[$i]["nombre"]."&nbsp;&nbsp;&nbsp;&nbsp;</span></td>";
        $j++;
        echo "</tr><tr>";
      }
      else    
       {$padre = busca_tabla("modulo",$permisos[$i]["cod_padre"]);     
        if($padre["numcampos"]>0)
        {  
           if($padre_base==$permisos[$i]["cod_padre"]) 
            { $contador++;
              if($padre_base=="" && $una_vez)
               { echo "<tr><td colspan='3'>".$padre[0]["nombre"]."&nbsp;</td></tr><tr>"; $una_vez=false;}           
            }
           else
               {$contador=0;
                echo "</tr><tr><td class='encabezado' colspan='3'><br />".strtoupper($padre[0]["nombre"])."&nbsp;<br /></td></tr><tr>";
                $una_vez = true;
               }
           $padre_base = $permisos[$i]["cod_padre"];      
           if(is_int(($contador)/3))
             echo "</tr><tr>";         
           echo "<td><span class='phpmaker'><input type='checkbox' name='modulo' value='".$permisos[$i]["idpermiso"]."' checked>".$permisos[$i]["nombre"]."&nbsp;&nbsp;&nbsp;&nbsp;</span></td>";         
        }  
       } 
  }  
  echo "<input type='hidden' name='total' value=''>";
  echo "<input type='hidden' name='id' value=''>"; 
  echo "<input type='hidden' name='idfuncionario' value='$idfuncionario'>";  
  echo "<tr><td colspan='3' align='center'><br />
        <input type='button' value='Guardar Cambios' onclick='javascript:if(confirm(\"Está seguro de modificar los permiso para el funcionario ".$funcionario[0]["nombres"]."\"))validar();return false;'></td></tr><table>";  
  echo "</form></table>";
}  
include("footer.php");
?>
