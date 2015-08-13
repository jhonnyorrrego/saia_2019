<?php
include_once("db.php");

$formato=busca_filtro_tabla("","formato","idformato=".$_REQUEST["idformato"],"",$conn);
if (@$_REQUEST["export"] == "excel")
  {
  	header('Content-Type: application/vnd.ms-excel');
  	header("Content-Disposition: attachment; filename=".$formato[0]["etiqueta"].".xls");
  	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  }
elseif (@$_REQUEST["export"] == "word")
  {header('Content-Type: application/vnd.ms-word');
   header("Content-Disposition: attachment; filename=".$formato[0]["etiqueta"].".doc");
   header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  }
else
{ include_once("header.php");
 $ruta="listado_por_plantilla.php?idformato=".$_REQUEST["idformato"];
?>
<br>
<table border=0 width=100%>
  <tr><td>
      <img src="botones/configuracion/buscar_general.png" border=0></td>
    <td width=90%><b>LISTADO DE DOCUMENTOS POR PLANTILLA</b></td>
    <td >
      <a href="<?php echo $ruta;?>&export=word">
        <img src="enlaces/word.gif" border="0" alt="Exportar a Word"></a></td>
    <td >
      <a href="<?php echo $ruta;?>&export=excel">
        <img src="enlaces/excel.gif" border="0" alt="Exportar a Excel"></a></td>
  </tr>
</table>
<br>
<?php
}
//************ listado de documento de cierta plantilla *******//
if(isset($_REQUEST["idformato"]))
{ //para la paginacion y el ordenar
 $encontrados=busca_filtro_tabla("count(a.numero) as cuantos","documento a,".$formato[0]["nombre_tabla"]." b","a.estado<>'ELIMINADO' and documento_iddocumento=iddocumento","",$conn);
if(!isset($_REQUEST["export"]))
{
 echo "<br><a href='listado_por_plantilla.php'>Elegir otra plantilla</a>&nbsp;&nbsp;&nbsp;<a href='busqueda_documentos.php?tipo_b=todos'>Buscar Documentos</a>
 &nbsp;&nbsp;&nbsp;<a href='listado_por_plantilla.php?ndisplayrecs=".$encontrados[0]["cuantos"]."&idformato=".$_REQUEST["idformato"]."'>Mostrar Todos</a>
 <center><b>".strtoupper(html_entity_decode($formato[0]["etiqueta"]))."</b>
 &nbsp;&nbsp;&nbsp;</center>
 <br><br>";
}
//******* paginacion ******************************************

 if(isset($_REQUEST["ndisplayrecs"])&&$_REQUEST["ndisplayrecs"])
   $nDisplayRecs=$_REQUEST["ndisplayrecs"];
 else
   $nDisplayRecs=10;
 //mostrar todos al exportar
 if(@$_REQUEST["export"])
   $nDisplayRecs=$encontrados[0]["cuantos"];

 $nTotalRecs=$encontrados[0]["cuantos"];
 $nStartRec = 1;
 if (isset($_REQUEST["pageno"]) && is_numeric($_REQUEST["pageno"]))
  {
   $nPageNo = $_REQUEST["pageno"];
	 $nStartRec = ($nPageNo-1)*$nDisplayRecs+1;
	 if ($nStartRec <= 0)
   		$nStartRec = 1;
	 elseif ($nStartRec >= (($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1)
		$nStartRec = (($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1;
	 $_REQUEST["start"]=$nStartRec;
  }
 if(isset($_REQUEST["start"]))
   $nStartRec = $_REQUEST["start"];

  //***********************************************************
 //****************ordenar resultado por**************
 if(isset($_REQUEST["ordenarpor"]))
  {$ordenarpor=" order by ".$_REQUEST["ordenarpor"];
   if(isset($_REQUEST["orden"]))
     {if($_REQUEST["orden"]=="asc")
         $orden="desc";
      else
         $orden="asc";
     }
   else
     {$_REQUEST["orden"]="asc";
      $orden="desc";
     }
  }
 else
  {$ordenarpor=" order by a.fecha ";
   $_REQUEST["orden"]="desc";
   $orden=" asc ";
  }
 if($_REQUEST["ordenarpor"]=="a.numero")
   $ordenarpor="order by cast(a.numero as unsigned) "  ;

 $ordenarpor.=" ".$_REQUEST["orden"];
 //*******************************************************
 $documentos=busca_filtro_tabla("a.numero,a.descripcion,a.fecha,a.iddocumento","documento a,".$formato[0]["nombre_tabla"]." b","a.estado<>'ELIMINADO' and documento_iddocumento=iddocumento $ordenarpor limit ".($nStartRec-1).",$nDisplayRecs","",$conn);
 if($nTotalRecs)
   {
    echo '<form name="transferir_plantillas" id="transferir_plantillas" method="POST" action="transferenciaadd_plantillas.php">
          <table align="center" border="0" cellspacing="1" cellpadding="4">
          <tr>
          <td class="encabezado_list"><a class="encabezado_list" href="'.$ruta.'&ordenarpor=a.numero&orden='.$orden.'">N&Uacute;MERO DE RADICADO</a></td>
          <td class="encabezado_list"><a class="encabezado_list" href="'.$ruta.'&ordenarpor=a.fecha&orden='.$orden.'">FECHA</a></td>
          <td class="encabezado_list"><a class="encabezado_list" href="'.$ruta.'&ordenarpor=a.descripcion&orden='.$orden.'">DESCRIPCI&Oacute;N</a></td>';
    if($formato[0]["nombre"]=="tramite" || $formato[0]["cod_padre"]==59)
      {
       echo '<td class="encabezado_list">NOMBRE CLIENTE</td>
             <td class="encabezado_list">TIPO DE TR&Aacute;MITE</td>';
      }
    echo  '<td class="encabezado_list">FORMATO</td>
           <td class="encabezado_list">PADRE</td>
           <td class="encabezado_list" colspan="2">TRANSFERIR</td>
          </tr>';
    for($i=0;$i<$documentos["numcampos"];$i++)
    {echo '<tr bgcolor="#F5F5F5"><td>'.$documentos[$i]["numero"].'</td>
           <td>'.$documentos[$i]["fecha"].'</td>
           <td>'.$documentos[$i]["descripcion"].'</td>';
     if($formato[0]["nombre"]=="tramite" || $formato[0]["cod_padre"]==59)
      {
     if($formato[0]["nombre"]=="tramite")
       $datos_tramite=busca_filtro_tabla("tramite, c.nombre","ft_tramite b, ejecutor c, datos_ejecutor d","b.documento_iddocumento =".$documentos[$i]["iddocumento"]." AND ejecutor_idejecutor = idejecutor AND iddatos_ejecutor = b.cliente","",$conn);
     else
       $datos_tramite=busca_filtro_tabla("tramite, c.nombre","ft_tramite b, ejecutor c, datos_ejecutor d,".$formato[0]["nombre_tabla"]." a","a.documento_iddocumento =".$documentos[$i]["iddocumento"]." AND b.idft_tramite = a.ft_tramite AND ejecutor_idejecutor = idejecutor
AND iddatos_ejecutor = b.cliente","",$conn);
      //print_r($datos_tramite);
       echo '<td>'.$datos_tramite[0]["nombre"].'</td>
             <td>'.$datos_tramite[0]["tramite"].'</td>';
      }
     if(!isset($_REQUEST["export"]))
     {
     echo '<td><a href="ordenar.php?accion=mostrar&mostrar_formato=1&key='.$documentos[$i]["iddocumento"].'">Detalles</a></td>';
     $padre=busca_filtro_tabla("origen","respuesta","destino='".$documentos[$i]["iddocumento"]."'","",$conn);
     if($padre["numcampos"]&&$formato[0]["cod_padre"]>0)
       echo '<td><a href=ordenar.php?accion=mostrar&mostrar_formato=1&key='.$padre[0]["origen"].'>Detalle</a></td>';
     else
       echo '<td></td>';
     echo '<td align="center"><input type="checkbox" name="transferir_'.$documentos[$i]["iddocumento"].'"></td></tr>';
     }
    }
    echo '<tr><td colspan="5" align="center"><input type="hidden" name="docs" id="docs" value="">
          <input type="button" value="Transferir" onclick="transferir();"></td></tr>';
   //********** paginacion *************************//
   if ($nTotalRecs > 0 && !isset($_REQUEST["export"])) {
	 $rsEof = ($nTotalRecs < ($nStartRec + $nDisplayRecs));
	 $PrevStart = $nStartRec - $nDisplayRecs;
	 if ($PrevStart < 1)
    $PrevStart = 1;
	 $NextStart = $nStartRec + $nDisplayRecs;
	 if ($NextStart > $nTotalRecs) { $NextStart = $nStartRec ; }
	 $LastStart = intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1;

	  ?>
</form>
</table>
<script>
    function validar(evento,valor)
     {var teclaPresionada=(document.all) ? evento.keyCode : evento.which;
      if(teclaPresionada==9 || teclaPresionada==13)
      	{ultima="<?php echo intval(($nTotalRecs-1)/$nDisplayRecs+1);?>";
         if(valor>ultima)
           valor=ultima;
         if(valor<1)
          valor=1
         window.location="<?php echo $ruta?>"+"&pageno="+valor;
      	}
     }

     function transferir()
     { var elementos=0;
       var docs="";
       for(i=0;i<document.getElementById("transferir_plantillas").elements.length;i=i+1)
        {var objeto=document.getElementById("transferir_plantillas").elements[i];
         if(objeto.checked==true && objeto.name.indexOf("transferir_")==0)
            {docs+=objeto.name.substring(objeto.name.indexOf("_")+1,objeto.name.length)+",";
             elementos+=1;
            }
        }
       if(elementos==0)
        {alert("Seleccione por lo menos un documento.")}
       else
        {document.getElementById("docs").value=docs;
         ///document.getElementById("transferir_plantillas").action="../despachar.php";
         document.getElementById("transferir_plantillas").submit();
        }
     }

    </script>

<table border="0" align="center" cellspacing="0" cellpadding="0">
  <tr><td>
      <span class="phpmaker">P&aacute;gina&nbsp;
      </span></td>
    <!--first page button-->
    <?php if ($nStartRec == 1) { ?>	<td>
      <img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
    <?php } else { ?>	<td>
      <a href="<?php echo $ruta."&start=1"; ?>">
        <img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
    <?php } ?>
    <!--previous page button-->
    <?php if ($PrevStart == $nStartRec) { ?>	<td>
      <img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
    <?php } else { ?>	<td>
      <a  href="<?php echo $ruta."&start=".$PrevStart; ?>">
        <img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
    <?php } ?>
    <!--current page number-->	<td>
      <input type="text" name="pageno" id="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" onkeyup="validar(event,this.value);" size="4"></td>
    <!--next page button-->
    <?php if ($NextStart == $nStartRec) { ?>	<td>
      <img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
    <?php } else { ?>	<td>
      <a href="<?php echo $ruta."&start=".$NextStart; ?>">
        <img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></td>
    <?php  } ?>
    <!--last page button-->
    <?php if ($LastStart == $nStartRec) { ?>	<td>
      <img src="images/lastdisab.gif" alt="Último" width="16" height="16" border="0"></td>
    <?php } else { ?>	<td>
      <a href="<?php echo $ruta."&start=".$LastStart; ?>">
        <img src="images/last.gif" alt="Último" width="16" height="16" border="0"></td>
    <?php } ?>	<td>
      <span class="phpmaker">&nbsp;de
        <?php echo intval(($nTotalRecs-1)/$nDisplayRecs+1);?>
      </span></td>
  </tr>
  <tr>
    <td colspan=7 align=center>
<?php if ($nStartRec > $nTotalRecs) { $nStartRec = $nTotalRecs; }
	$nStopRec = $nStartRec + $nDisplayRecs - 1;
	$nRecCount = $nTotalRecs - 1;
	if ($rsEof) { $nRecCount = $nTotalRecs; }
      	if ($nStopRec > $nRecCount) { $nStopRec = $nRecCount; } ?>
      <span class="phpmaker">Registros
        <?php echo $nStartRec; ?> a
        <?php echo $nStopRec; ?> de
        <?php echo $nTotalRecs; ?>
      </span>
      <?php } ?>		</td>
  </tr>
</table>
<?php
    //*****************************************************
   }
 else
   {echo "No se encontraron documentos para la plantilla especificada.";
   }
}
else//********* listado de plantillas ************************//
{
  $plantilla=busca_filtro_tabla("","formato","","idformato",$conn);
  echo '<table align="center" border="1" style="border-collapse:collapse" cellpadding=8>
        <tr><td class="encabezado_list">PLANTILLAS DISPONIBLES</td></tr>';
 $permiso=new PERMISO();
  for($i=0;$i<$plantilla["numcampos"];$i++)
    {$ruta="?idformato=".$plantilla[$i]["idformato"];
     echo '<tr><td align=center >';
     agrega_boton("texto","",$ruta,"centro",utf8_encode(strtoupper(html_entity_decode($plantilla[$i]["etiqueta"]))),"",strtolower(utf8_encode($plantilla[$i]["nombre"])));
     echo '</td></tr>';
    }
  echo '</table>';

}
include_once("footer.php");
?>
