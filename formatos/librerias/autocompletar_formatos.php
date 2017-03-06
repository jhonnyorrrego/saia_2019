<?php
include_once("../../db.php");

if($_REQUEST["idcomponente"] && $_REQUEST["digitado"])
{$componente=busca_filtro_tabla("valor,nombre","campos_formato","idcampos_formato=".$_REQUEST["idcomponente"],"",$conn);

 if($componente["numcampos"])
   {$parametros=explode(";",$componente[0]["valor"]);
    /* parametros: campo a mostrar; campo a guardar en el hidden; tabla
      ej: concat(concat(nombres,' '),apellidos);idfuncionario;funcionario
    */
    $parametros[0]=str_replace('"',"'",stripslashes($parametros[0]));
    $parametros[1]=str_replace('"',"'",stripslashes($parametros[1]));
     $datos=busca_filtro_tabla($parametros[0]." as nombre,".$parametros[1]." as id",$parametros[2],"lower(".$parametros[0].") like '".strtolower(((trim($_REQUEST["digitado"]))))."%'","",$conn);
  
     if($datos["numcampos"])
       {for($i=0;$i<$datos["numcampos"];$i++)
          echo '<li onClick="fill(\''.$datos[$i]["id"].'\',\''.$datos[$i]["nombre"].'\','.$_REQUEST["idcomponente"].',\''.$componente[0]["nombre"].'\');" onmouseover="this.style.background=\'gray\'"; onmouseout="this.style.background=\'#F5F5F5\'"; >'.$datos[$i]["nombre"].'</li>';
       }
     else 
       {if($parametros[0]==$parametros[1])
          {echo '<li onClick="fill(\''.$_REQUEST["digitado"].'\',\''.$_REQUEST["digitado"].'\','.$_REQUEST["idcomponente"].',\''.$componente[0]["nombre"].'\');">'.$_REQUEST["digitado"].'</li>';
          }  
        else
          echo '<script>
                alert(\'Debe elegir un elemento ya registrado\');
                fill(\'\',\'\','.$_REQUEST["idcomponente"].',\''.$componente[0]["nombre"].'\');
                </script>';	
       }
  }      
} 
else 
 echo "<li>No hay coincidencias</li>";	         
?>
