<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?".">");
include_once("db.php");
 
 echo("<tree id=\"0\">\n");  
 echo recorrer_nivel(0,0);
 echo("</tree>\n");
 //$cadena="";
 
function recorrer_nivel($iddoc,$padre)
  {global $conn;
   $cadena="";
   $padres=busca_filtro_tabla("","estructura_calidad","cod_padre=$padre AND estado=1","codigo",$conn);
   if($padres["numcampos"])
     {for($j=0;$j<$padres["numcampos"];$j++)
        {$resultado=busca_filtro_tabla("","doc_calidad A,documento B","iddocumento=documento_iddocumento AND estructura_idestructura=".$padres[$j]["idestructura_calidad"]." AND A.cod_padre=$iddoc AND B.numero<>0","",$conn);
        $cadena.="<item im0=\"iconTask.gif\" im1=\"iconJob.gif\" im2=\"iconJob.gif\" style=\"font-family:verdana; font-size:7pt;\" ";
         $cadena.="text=\"".html_entity_decode($padres[$j]["etiqueta"])."\" id=\"".$padres[$j]["idestructura_calidad"]."#$iddoc#1#".strtolower($padres[$j]["nombre"])."#\"";
         if(isset($_REQUEST["seleccionado"]) && $_REQUEST["seleccionado"]<>"")
           {$valores=explode(",",$_REQUEST["seleccionado"]);
            if($valores[0]==$padres[$j]["idestructura_calidad"] && $valores[1]==$iddoc)
                 $cadena.=" checked=\"1\" ";
           }
         if($resultado["numcampos"])
           {$cadena.=" child=\"1\" >\n";
            for($i=0;$i<$resultado["numcampos"];$i++)
              {$cadena_hijos="";
               $cadena_hijos=recorrer_nivel($resultado[$i]["iddocumento"],$resultado[$i]["estructura_idestructura"]);
               $tabla=strtolower($resultado[$i]["plantilla"]);
               $proceso=busca_filtro_tabla("nombre_".$tabla." as nombre",$tabla,"documento_iddocumento=".$resultado[$i]["iddocumento"],"",$conn);

               if($cadena_hijos<>"")
                  {$cadena.="<item im0=\"iconTask.gif\" im1=\"iconJob.gif\" im2=\"iconJob.gif\" style=\"font-family:verdana; font-size:7pt;\" ";
                   $cadena.="text=\"".html_entity_decode($proceso[0]["nombre"])."\" id=\"".$padres[$j]["idestructura_calidad"]."#".$resultado[$i]["iddocumento"]."#2#".strtolower($resultado[$i]["plantilla"])."#\" child=\"1\" nocheckbox=\"1\">\n";
                   $cadena.=$cadena_hijos."</item>\n";
                  }
               else   
                  {$cadena.="<item im0=\"iconTask.gif\" style=\"font-family:verdana; font-size:7pt;\" ";
                   $cadena.="text=\"".html_entity_decode($proceso[0]["nombre"])."\" id=\"".$padres[$j]["idestructura_calidad"]."#".$resultado[$i]["iddocumento"]."#2#".strtolower($resultado[$i]["plantilla"])."#\" child=\"0\" nocheckbox=\"1\" >\n";
                   $cadena.="</item>\n";
                  } 
              }
           }
         else 
            $cadena.=" child=\"0\" >\n";
         $cadena.="</item>\n";
        }
     }
   return($cadena);
  }  
?>
