<?php
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

include_once($ruta_db_superior."db.php");
if(isset($_REQUEST["tipo"])&&$_REQUEST["tipo"]&&isset($_REQUEST["id"])&&$_REQUEST["id"])
{$resultado=busca_filtro_tabla("",$_REQUEST["tipo"],"id".$_REQUEST["tipo"]."=".$_REQUEST["id"],"",$conn);
 if($resultado["numcampos"])
   {if($_REQUEST["tipo"]=="campos_formato")
      {echo '<table style="border-collapse:collapse" border="1" align="center">
             <tr>
             <td bgcolor="silver">Nombre:</td>
             <td>'.$resultado[0]["nombre"].'</td>
             </tr>
             <tr>
             <td bgcolor="silver">Tipo de dato:</td>
             <td>'.$resultado[0]["tipo_dato"].'</td>
             </tr>
             <tr>
             <td bgcolor="silver">Valor por defecto:</td>
             <td>'.$resultado[0]["predeterminado"].'</td>
             </tr>
             <tr>
             <td bgcolor="silver">Obligatoriedad:</td>
             <td>'.$resultado[0]["obligatoriedad"].'</td>
             </tr>
             <tr>
             <td bgcolor="silver">Etiqueta html:</td>
             <td>'.$resultado[0]["etiqueta_html"].'</td>
             </tr>
             <tr>
             <td bgcolor="silver">Ayuda:</td>
             <td>'.$resultado[0]["ayuda"].'</td>
             </tr>
             </table>';
      }
    else
      {$formatos=busca_filtro_tabla("etiqueta","formato","idformato in(".$resultado[0]["formato"].")","",$conn);
       $nombres=extrae_campo($formatos,"etiqueta","U"); 
       echo '<table style="border-collapse:collapse" border="1" align="center">
             <tr>
             <td bgcolor="silver">Formatos:</td>
             <td>'.implode(", ",$nombres).'</td>
             </tr>
             <tr>
             <td bgcolor="silver">Acciones:</td>
             <td>'.$resultado[0]["acciones"].'</td>
             </tr>
             </table>';
      }  
   }
}  /*
Funciones:
Se debe mostrar las funciones vinculadas, acciones (a que pertenece la funcion adicionar,editar,mostrar).
*/
?>