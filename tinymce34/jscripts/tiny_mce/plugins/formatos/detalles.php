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
include_once($ruta_db_superior."librerias_saia.php");
if(isset($_REQUEST["tipo"])&&$_REQUEST["tipo"]&&isset($_REQUEST["id"])&&$_REQUEST["id"])
{$resultado=busca_filtro_tabla("",$_REQUEST["tipo"],"id".$_REQUEST["tipo"]."=".$_REQUEST["id"],"",$conn);
 echo('<div onclick="ajax_hideTooltip();" style="float:right;"><u>Cerrar</u></div><br><br>');
 if($resultado["numcampos"])
   {if($_REQUEST["tipo"]=="campos_formato")
      {
      	echo '<table style="border-collapse:collapse" border="1" align="center">
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
    else{
    	$ruta_formato='';
    	$formatos=busca_filtro_tabla("A.etiqueta,A.idformato,A.nombre,C.ruta,C.etiqueta AS etiqueta_funcion,B.funciones_formato_fk","formato A, funciones_formato_enlace B,funciones_formato C","A.idformato=B.formato_idformato AND B.funciones_formato_fk=C.idfunciones_formato AND funciones_formato_fk=".$_REQUEST["id"]."","GROUP BY A.idformato HAVING min(B.funciones_formato_fk)=B.funciones_formato_fk ORDER BY A.nombre,B.idfunciones_formato_enlace ASC",$conn);
    	// si el archivo existe dentro de la carpeta formatos
    	$ruta_final=$formatos[0]["nombre"] . "/" . $formatos[0]["ruta"];
    	if (is_file($ruta_db_superior . FORMATOS_CLIENTE . $formatos[0]["nombre"] . "/" . $formatos[0]["ruta"])) {
    		$ruta_formato = realpath($_SERVER["DOCUMENT_ROOT"] . "/" . RUTA_SAIA . FORMATOS_CLIENTE . $formatos[0]["nombre"] . "/" . $formatos[0]["ruta"]);
    	} elseif (is_file($ruta_db_superior . $formatos[0]["ruta"])) {
    		// si el archivo existe en la ruta especificada partiendo de la raiz
    		$ruta_formato = realpath($_SERVER["DOCUMENT_ROOT"] . "/" . RUTA_SAIA . $formatos[0]["ruta"]);
    	} else {
    		$ruta_formato = 'Error: ' . $formatos[0]["ruta"] . "|id=" . $formatos[0]["idfunciones_formato"];
    	}
    	$formatos=busca_filtro_tabla("etiqueta","formato A, funciones_formato_enlace B","A.idformato=B.formato_idformato AND funciones_formato_fk=".$_REQUEST["id"]."","B.idfunciones_formato_enlace ASC",$conn);
    	$nombres=extrae_campo($formatos,"etiqueta","U");
    	foreach($nombres AS $key=>$valor){
    		$nombres[$key]=codifica_encabezado(html_entity_decode($valor));
    	}
       echo '<table style="border-collapse:collapse" border="1" align="center">
             <tr>
             <td bgcolor="silver">Formatos:</td>
             <td>'.implode(", ",$nombres).'</td>
             </tr>
 			 <tr>
             <td bgcolor="silver">Nombre de la funci&oacute;n:</td>
             <td>'.$resultado[0]["nombre_funcion"].'</td>
             </tr>
             <tr>
             <td bgcolor="silver">Acciones:</td>
             <td>'.$resultado[0]["acciones"].'</td>
             </tr>
			 <tr>
             <td bgcolor="silver">Ruta:</td>
             <td>'.$ruta_formato.'</td>
             </tr>
             </table>';
      }  
   }
}  /*
Funciones:
Se debe mostrar las funciones vinculadas, acciones (a que pertenece la funcion adicionar,editar,mostrar).
*/
?>