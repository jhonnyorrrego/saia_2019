<?php

$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

include_once("../db.php");
include_once("../header.php");
include_once("../calendario/calendario.php");

include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery());
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("grafica_idgrafica","idfiltro_grafica","idfiltro","reporte","grafica","id");
desencriptar_sqli('form_info');

//print_r($_REQUEST);die();

?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
$().ready(function() {
	// validar los campos del formato
	$('#form1').validate({
		submitHandler: function(form) {
				<?php encriptar_sqli("form1",0,"form_info",$ruta_db_superior);?>
			    form.submit();
			    
			  }
	});
	
});
</script>
<?php
if($_REQUEST["accion"]=="listar" || $_REQUEST["accion"]=="editar" || $_REQUEST["accion"]=="adicionar")
echo "<br /><br /><a id='link_volver' href='listado_graficos.php'>VOLVER A GRAFICOS Y REPORTES</a>&nbsp;&nbsp;";
if($_REQUEST["accion"]=="editar" || $_REQUEST["accion"]=="adicionar")
echo "<a id='link_volver' href='elegir_filtro.php?accion=listar'>ADMINISTRACION GRAFICOS Y REPORTES</a>&nbsp;&nbsp;";
/************************************adicionar filtro***************************/
if($_REQUEST["accion"]=="guardar_adicionar")
{global $conn;
 //print_r($_REQUEST);die();
 if($_REQUEST["relacion"]=="reporte")
  $sql="insert into filtro_reporte(reporte_idreporte";
 else
  $sql="insert into filtro_grafica(grafica_idgrafica";
 $sql.=",campo,etiqueta_html,etiqueta,tipo_dato,codigo_sql) values('".$_REQUEST["grafica_idgrafica"]."','".$_REQUEST["campo"]."','".$_REQUEST["etiqueta_html"]."','".$_REQUEST["etiqueta"]."','".$_REQUEST["tipo_dato"]."','".str_replace("'","''",stripslashes($_REQUEST["codigo_sql"]))."')";
 phpmkr_query($sql,$conn);
 $id=phpmkr_insert_id();
 if($id>0)
   {alerta("Filtro adicionado.");
    redirecciona("elegir_filtro.php?accion=listar");
   }
 else
   {alerta("No se pudo adicionar el filtro.");
    echo "<script>window.history.go(-1);</script>";
   }  
 
} 
if($_REQUEST["accion"]=="guardar_editar")
{global $conn;
 if($_REQUEST["tipo"]=="reporte")
   $sql="update filtro_reporte set reporte_idreporte='".$_REQUEST["grafica_idgrafica"]."',campo='".$_REQUEST["campo"]."',etiqueta_html='".$_REQUEST["etiqueta_html"]."',etiqueta='".$_REQUEST["etiqueta"]."',tipo_dato='".$_REQUEST["tipo_dato"]."',codigo_sql='".str_replace("'","''",stripslashes($_REQUEST["codigo_sql"]))."' where idfiltro_reporte=".$_REQUEST["idfiltro_grafica"];
 else
   $sql="update filtro_grafica set grafica_idgrafica='".$_REQUEST["grafica_idgrafica"]."',campo='".$_REQUEST["campo"]."',etiqueta_html='".$_REQUEST["etiqueta_html"]."',etiqueta='".$_REQUEST["etiqueta"]."',tipo_dato='".$_REQUEST["tipo_dato"]."',codigo_sql='".str_replace("'","''",stripslashes($_REQUEST["codigo_sql"]))."' where idfiltro_grafica=".$_REQUEST["idfiltro_grafica"];

 phpmkr_query($sql,$conn);
 redirecciona("elegir_filtro.php?accion=listar");
 
}/*************************************mostrar detalles filtro**************************************/
elseif($_REQUEST["accion"]=="mostrar")
{global $conn;
 if($_REQUEST["tipo"]=="reporte")
   $filtro=busca_filtro_tabla("","filtro_reporte","idfiltro_reporte=".$_REQUEST["idfiltro"],"",$conn);
 else
   $filtro=busca_filtro_tabla("","filtro_grafica","idfiltro_grafica=".$_REQUEST["idfiltro"],"",$conn);
 $etiquetas=array("arbol"=>"Arbol","radio"=>"Boton de seleccion","checkbox"=>"Cuadro de chequeo","text"=>"Cuadro de Texto","fecha_simple"=>"Fecha","fecha_doble"=>"Fecha doble","select"=>"Lista desplegable");
 $tipos=array("fecha"=>"Fecha","int"=>"Numero","varchar"=>"Texto");
 ?>
 <table style="border-collapse:collapse" border="1" width=50%>
  <tr>
   <td class="encabezado">ETIQUETA</td>
   <td><?php echo $filtro[0]["etiqueta"]; ?>
   </td>
  </tr>
  <tr>
   <td class="encabezado"><?php echo strtoupper($_REQUEST["tipo"]); ?></td>
   <td>
   <?php
   if($_REQUEST["tipo"]=="reporte")
     $grafico=busca_filtro_tabla("nombre as etiqueta","reporte","idreporte=".$filtro[0]["reporte_idreporte"],"",$conn);
   else
     $grafico=busca_filtro_tabla("etiqueta","grafico","idgrafico=".$filtro[0]["grafica_idgrafica"],"",$conn);
   echo $grafico[0][0];
   ?>
   </td>
  </tr>
  <tr>
   <td class="encabezado">CAMPO</td>
   <td><?php echo $filtro[0]["campo"]; ?>
   </td>
  </tr>
  <tr>
   <td class="encabezado">ETIQUETA HTML</td>
   <td><?php echo $etiquetas[$filtro[0]["etiqueta_html"]]; ?>
   </td>
  </tr>
  <tr>
   <td class="encabezado">TIPO DATO</td>
   <td><?php echo $tipos[$filtro[0]["tipo_dato"]]; ?>
   </td>
  </tr>
  <tr>
   <td class="encabezado">CODIGO SQL</td>
   <td>
   <?php echo $filtro[0]["codigo_sql"]; ?>
   </td>
  </tr>
 </table>
 <script>
document.getElementById("header").style.display="none";
</script>
 <?php

}/************************ crear select *********************************************/
elseif($_REQUEST["accion"]=="crear_select")
{global $conn;
 if($_REQUEST["tipo"]=="grafico")
   $codigo=busca_filtro_tabla("etiqueta as nombre,idgrafico as id","grafico","estado=1","nombre asc",$conn);
 elseif($_REQUEST["tipo"]=="reporte")
   $codigo=busca_filtro_tabla("nombre,idreporte as id","reporte","estado=1","nombre asc",$conn); 
 $texto="<option value='' selected>Seleccionar...</option>";
 for($i=0;$i<$codigo["numcampos"];$i++)   
   {$texto.="<option value='".$codigo[$i]["id"]."'>".$codigo[$i]["nombre"]."</option>";
   }
 echo "@@$texto@@";  
}  
/************************adicionar filtro******************************************************/
elseif($_REQUEST["accion"]=="adicionar")
{global $conn;
 $graficos=busca_filtro_tabla("idgrafico,etiqueta","grafico","estado=1","",$conn);
 ?>
 
 <form name="form1"  id="form1" method="post">
 <table style="border-collapse:collapse" border="1" width=50%>
  <tr>
   <td class="encabezado">ETIQUETA*</td>
   <td><input type="text" name="etiqueta" class="required">
   </td>
  </tr>
  <tr>
   <td class="encabezado">GRAFICO/REPORTE*</td>
   <td>
   <input type="radio" id="grafico" value="grafico" name="relacion" checked>Gr&aacute;fico&nbsp;&nbsp;
   <input type="radio" id="reporte" value="reporte" name="relacion">Reporte
   </td>
  </tr>
  <tr>
   <td class="encabezado" id="titulo_relacion">GRAFICO*</td>
   <td>
   <select name=grafica_idgrafica id=grafica_idgrafica  class="required">
   <option value=''>Seleccionar...</option>
   <?php
   for($i=0;$i<$graficos["numcampos"];$i++)
     {echo "<option value='".$graficos[$i]["idgrafico"]."'>".$graficos[$i]["etiqueta"]."</option>";
     }
   ?>
   </select>
   <div id="cod_grafica" style="background-color:lightgray"></div>
   </td>
  </tr>
  <tr>
   <td class="encabezado">CAMPO*</td>
   <td><input type="text" name="campo" class="required">
   </td>
  </tr>
  <tr>
   <td class="encabezado">ETIQUETA HTML*</td>
   <td><select name="etiqueta_html" class="required">
   <option value='arbol'>Arbol</option>
   <option value='radio'>Boton de seleccion</option>
   <option value='checkbox'>Cuadro de chequeo</option>
   <option value='text' selected>Cuadro de Texto</option>
   <option value='fecha_simple'>Fecha</option>
   <option value='fecha_doble'>Fecha doble</option>
   <option value='select' >Lista desplegable</option>
   </select>
   </td>
  </tr>
  <tr>
   <td class="encabezado">TIPO DATO*</td>
   <td><select name="tipo_dato" class="required">
   <option value='fecha' selected>Fecha</option>
   <option value='int'>Numero</option>
   <option value='varchar' selected>Texto</option>
   </select>
   </td>
  </tr>
  <tr>
   <td class="encabezado">CODIGO SQL</td>
   <td><textarea name="codigo_sql" cols="50" rows="10"></textarea>
   </td>
  </tr>
  <tr>
   <td colspan=2 align=center><input type="submit" class=submit value="Guardar"> 
   <input type=hidden name="accion" value="guardar_adicionar"> 
   </td>
  </tr>
 </table>
 </form>
 <script>
$("#grafica_idgrafica").change(function () {
 if($("#grafico").attr("checked")==true)
   tipo="grafico";
 else
   tipo="reporte"; 
  $.ajax({
     type: "POST",
     url: "elegir_filtro.php",
     data: "accion=codigo_grafica&tipo="+tipo+"&idgrafica="+$("#grafica_idgrafica option:selected").val(),
     success: function(msg){
     texto=msg.split("@@");
     if(texto[1]!="")
       $("#cod_grafica").html("<b>Codigo:</b><br>"+texto[1]);
     else
       $("#cod_grafica").html("");  
     }
   });   
})
$("#grafico").click(function() {
if($("#grafico").attr("checked")==true)
  {$("#grafica_idgrafica").empty(); 
   $("#cod_grafica").empty();
   $("#grafica_idgrafica").append("<option value=''>Cargando...</option>");
   $.ajax({
     type: "POST",
     url: "elegir_filtro.php",
     data: "accion=crear_select&tipo=grafico",
     success: function(msg){
     texto=msg.split("@@");
     $("#grafica_idgrafica").empty();
     $("#grafica_idgrafica").append(texto[1]);  
     }
   }); 
  }
})
$("#reporte").click(function() {
if($("#reporte").attr("checked")==true)
  {$("#grafica_idgrafica").empty();
  $("#cod_grafica").empty(); 
   $("#grafica_idgrafica").append("<option value=''>Cargando...</option>"); 
   $.ajax({
     type: "POST",
     url: "elegir_filtro.php",
     data: "accion=crear_select&tipo=reporte",
     success: function(msg){
     texto=msg.split("@@");
     $("#grafica_idgrafica").empty();
     $("#grafica_idgrafica").append(texto[1]);
     }
   }); 
  }
})
</script>
 <?php
 //encriptar_sqli("form1",1,"form_info",$ruta_db_superior);
} 
/************************************buscar codigo sql de la grafica***********************/
elseif($_REQUEST["accion"]=="codigo_grafica")
{global $conn;
 if($_REQUEST["tipo"]=="grafico")
   $codigo=busca_filtro_tabla("sql_grafico","grafico","idgrafico=".$_REQUEST["idgrafica"],"",$conn);
 elseif($_REQUEST["tipo"]=="reporte")
   $codigo=busca_filtro_tabla("sql_reporte","reporte","idreporte=".$_REQUEST["idgrafica"],"",$conn);  
 echo "@@".$codigo[0][0]."@@";
}
/************************************eliminar filtro***************************/
elseif($_REQUEST["accion"]=="eliminar")
{global $conn;
 if($_REQUEST["tipo"]=="reporte")
   $sql="delete from filtro_reporte where idfiltro_reporte=".$_REQUEST["idfiltro"];
 else
   $sql="delete from filtro_grafica where idfiltro_grafica=".$_REQUEST["idfiltro"];  
 phpmkr_query($sql,$conn);
 alerta("Filtro eliminado.");
 redirecciona("elegir_filtro.php?accion=listar");
} /************************************editar filtro***************************/
elseif($_REQUEST["accion"]=="editar")
{global $conn;
 if($_REQUEST["tipo"]=="reporte")
   {$graficos=busca_filtro_tabla("idreporte as idgrafico,nombre as etiqueta","reporte","estado=1","",$conn);
 $filtro=busca_filtro_tabla("reporte_idreporte as grafica_idgrafica,idfiltro_reporte as idfiltro_grafica,filtro_reporte.*","filtro_reporte","idfiltro_reporte=".$_REQUEST["idfiltro"],"",$conn);
   }
 else
   {$graficos=busca_filtro_tabla("idgrafico,etiqueta","grafico","estado=1","",$conn);
 $filtro=busca_filtro_tabla("","filtro_grafica","idfiltro_grafica=".$_REQUEST["idfiltro"],"",$conn);
   }
 ?>
 <form name="form1"  id="form1" method="post">
 <table style="border-collapse:collapse" border="1" width=50%>
  <tr>
   <td class="encabezado">ETIQUETA*</td>
   <td><input type="text" name="etiqueta" class="required" value="<?php echo $filtro[0]["etiqueta"]; ?>">
   </td>
  </tr>
  <tr>
   <td class="encabezado"><?php echo strtoupper($_REQUEST["tipo"]); ?>*</td>
   <td>
   <select name=grafica_idgrafica id=grafica_idgrafica class="required">
   <option value=''>Seleccionar...</option>
   <?php
   for($i=0;$i<$graficos["numcampos"];$i++)
     {echo "<option value='".$graficos[$i]["idgrafico"]."' >".$graficos[$i]["etiqueta"]."</option>";
     }
   ?>
   </select>
   <div id="cod_grafica" style="background-color:lightgray"></div>
   </td>
  </tr>
  <tr>
   <td class="encabezado">CAMPO*</td>
   <td><input type="text" name="campo" class="required" value="<?php echo $filtro[0]["campo"]; ?>">
   </td>
  </tr>
  <tr>
   <td class="encabezado">ETIQUETA HTML*</td>
   <td><select name="etiqueta_html" id="etiqueta_html" class="required">
   <option value='arbol'>Arbol</option>
   <option value='radio'>Boton de seleccion</option>
   <option value='checkbox'>Cuadro de chequeo</option>
   <option value='text' selected>Cuadro de Texto</option>
   <option value='fecha_simple'>Fecha</option>
   <option value='fecha_doble'>Fecha doble</option>
   <option value='select' >Lista desplegable</option>
   </select>
   </td>
  </tr>
  <tr>
   <td class="encabezado">TIPO DATO*</td>
   <td><select name="tipo_dato" id="tipo_dato" class="required">
   <option value='fecha' selected>Fecha</option>
   <option value='int'>Numero</option>
   <option value='varchar' selected>Texto</option>
   </select>
   </td>
  </tr>
  <tr>
   <td class="encabezado">CODIGO SQL</td>
   <td><textarea name="codigo_sql" cols="50" rows="10"><?php echo $filtro[0]["codigo_sql"]; ?></textarea>
   </td>
  </tr>
  <tr>
   <td colspan=2 align=center><input type="submit" value="Guardar"> 
   <input type=hidden name="accion" value="guardar_editar">
   <input type=hidden name="tipo" value="<?php echo $_REQUEST["tipo"]; ?>">
   <input type=hidden name="idfiltro_grafica" value="<?php echo $filtro[0]["idfiltro_grafica"];?>"> 
   </td>
  </tr>
 </table>
 </form>
 <script>
 $('#grafica_idgrafica option[value=<?php echo $filtro[0]["grafica_idgrafica"]; ?>]').attr('selected', 'selected');
 $('#tipo_dato option[value=<?php echo $filtro[0]["tipo_dato"]; ?>]').attr('selected', 'selected');
 $('#etiqueta_html option[value=<?php echo $filtro[0]["etiqueta_html"]; ?>]').attr('selected', 'selected');
 $("#grafica_idgrafica").change(function () {
  $.ajax({
     type: "POST",
     url: "elegir_filtro.php",
     data: "accion=codigo_grafica&idgrafica="+$("#grafica_idgrafica option:selected").val(),
     success: function(msg){
     texto=msg.split("@@");
     if(texto[1]!="")
       $("#cod_grafica").html("<b>Codigo de la grafica:</b><br>"+texto[1]);
     else
       $("#cod_grafica").html("");  
     }
   }); 
  
})
</script>
 <?php
} /************************************elegir filtro***************************/
elseif($_REQUEST["accion"]=="elegir")
{global $conn;
 ?>
 
<?php
 if($_REQUEST["tipo"]=="reporte")
   $filtros=busca_filtro_tabla("","filtro_reporte","reporte_idreporte=".$_REQUEST["reporte"],"",$conn);
 else
   $filtros=busca_filtro_tabla("","filtro_grafica","grafica_idgrafica=".$_REQUEST["grafica"],"",$conn);
 include_once("../formatos/librerias/header_formato.php");
 if($filtros["numcampos"])
   {echo "<form name='form1' id='form1' method='post'>
          <script type='text/javascript' src='../js/dhtmlXCommon.js'></script>
<script type='text/javascript' src='../js/dhtmlXTree.js'></script>
    <link rel='STYLESHEET' type='text/css' href='../css/dhtmlXTree.css'>
          <table width=90% border=1 style='border-collapse:collapse'>
          <tr><td class='encabezado_list' colspan=3>OPCIONES DE FILTRO</td></tr>";
    for($i=0;$i<$filtros["numcampos"];$i++)
      {echo "<tr><td class=encabezado >".ucfirst($filtros[$i]["etiqueta"])."</td>";
       echo operador($filtros[$i],$i);
       echo campo($filtros[$i],$i);
       echo "</tr>";
      }
    echo "<tr><td colspan=3 align=center><input type='submit' value='Guardar'>
          <input type='hidden' name='accion' value='construir_filtro'>
          <input type='hidden' name='cuantos' value='$i'> 
          <input type='hidden' name='tipo' value='".$_REQUEST["tipo"]."'>
          </td></tr></table></form>";
   }
 else
   echo "No hay filtros creados.";
 echo '<script>
document.getElementById("header").style.display="none";
</script>';  
}/************************************listar filtros***************************/
elseif($_REQUEST["accion"]=="listar")
{global $conn;
 include_once("../header.php");
 $graficos=busca_filtro_tabla("","grafico","estado=1","",$conn);
 echo "<a href='elegir_filtro.php?accion=adicionar'>ADICIONAR FILTRO</a>&nbsp;&nbsp;&nbsp;<a href='graficoadd.php'>ADICIONAR GRAFICO</a>&nbsp;&nbsp;&nbsp;<a href='reporteadd.php'>ADICIONAR REPORTE</a>";
 if($graficos["numcampos"])
    {echo "<br /><br />
           <table border=1 width='80%' style='border-collapse:collapse'><tr><td class='encabezado_list' colspan=3>GRAFICO</td><td class='encabezado_list'>FILTROS</td></tr>";
     for($i=0;$i<$graficos["numcampos"];$i++)
        {echo "<tr>
               <td align='center'><a href='graficoedit.php?key=".$graficos[$i]["idgrafico"]."'>Editar</a></td>
               <td align='center'><a class=\"highslide\" onclick=\"return hs.htmlExpand(this, { objectType: 'iframe',width: 500, height:400,preserveContent:false } )\" href='graficoview.php?key=".$graficos[$i]["idgrafico"]."'>Ver</a></td>
               <td>".$graficos[$i]["etiqueta"]."</td>
               <td>";
         $filtros=busca_filtro_tabla("","filtro_grafica","grafica_idgrafica=".$graficos[$i]["idgrafico"],"",$conn);
         if($filtros["numcampos"]) 
           {echo "<table border=1 style='border-collapse:collapse'  width='100%' >
                  <tr BGCOLOR='silver' align=center><td>ETIQUETA</td><td>TIPO</td><td colspan=3>OPCIONES</td></tr>";
            for($j=0;$j<$filtros["numcampos"];$j++)
              {echo "<tr><td>".$filtros[$j]["etiqueta"]."</td><td>".$filtros[$j]["etiqueta_html"]."</td><td align='center'><a href='elegir_filtro.php?accion=editar&idfiltro=".$filtros[$j]["idfiltro_grafica"]."&tipo=grafico'>Editar</a></td><td align='center'><a href='#' onclick='if(confirm(\"Realmente desea eliminar el filtro?\")) window.location=\"elegir_filtro.php?accion=eliminar&idfiltro=".$filtros[$j]["idfiltro_grafica"]."&tipo=grafico\";'>Eliminar</a></td><td align='center'><a class=\"highslide\" onclick=\"return hs.htmlExpand(this, { objectType: 'iframe',width: 500, height:400,preserveContent:false } )\" href='elegir_filtro.php?accion=mostrar&idfiltro=".$filtros[$j]["idfiltro_grafica"]."&tipo=grafico' >Ver</a></td></tr>";
              }
            echo "</table>";
           }    
         echo "</td></tr>";
        }
     echo "</table>"; 
    
    }
 else
   echo "<br />No hay graficos disponibles."; 
 $reportes=busca_filtro_tabla("","reporte","estado=1","",$conn);
 if($reportes["numcampos"])
    {echo "<br /><br />
           <table border=1 width='80%' style='border-collapse:collapse'><tr><td class='encabezado_list' colspan=3>REPORTES</td><td class='encabezado_list'>FILTROS</td></tr>";
     for($i=0;$i<$reportes["numcampos"];$i++)
        {echo "<tr>
               <td align='center'><a href='reporteedit.php?key=".$reportes[$i]["idreporte"]."'>Editar</a></td>
               <td align='center'><a class=\"highslide\" onclick=\"return hs.htmlExpand(this, { objectType: 'iframe',width: 500, height:400,preserveContent:false } )\" href='reporteview.php?key=".$reportes[$i]["idreporte"]."'>Ver</a></td>
               <td>".$reportes[$i]["nombre"]."</td><td>";
        $filtros=busca_filtro_tabla("","filtro_reporte","reporte_idreporte=".$reportes[$i]["idreporte"],"",$conn);
         if($filtros["numcampos"]) 
           {echo "<table border=1 style='border-collapse:collapse'  width='100%' >
                  <tr BGCOLOR='silver' align=center><td>ETIQUETA</td><td>TIPO</td><td colspan=3>OPCIONES</td></tr>";
            for($j=0;$j<$filtros["numcampos"];$j++)
              {echo "<tr><td>".$filtros[$j]["etiqueta"]."</td><td>".$filtros[$j]["etiqueta_html"]."</td><td align='center'><a href='elegir_filtro.php?accion=editar&idfiltro=".$filtros[$j]["idfiltro_reporte"]."&tipo=reporte'>Editar</a></td><td align='center'><a href='#' onclick='if(confirm(\"Realmente desea eliminar el filtro?\")) window.location=\"elegir_filtro.php?accion=eliminar&idfiltro=".$filtros[$j]["idfiltro_reporte"]."&tipo=reporte\";'>Eliminar</a></td><td align='center'><a class=\"highslide\" onclick=\"return hs.htmlExpand(this, { objectType: 'iframe',width: 500, height:400,preserveContent:false } )\" href='elegir_filtro.php?accion=mostrar&idfiltro=".$filtros[$j]["idfiltro_reporte"]."&tipo=reporte' >Ver</a></td></tr>";
              }
            echo "</table>";
           } 
        echo "</td>";          
       } 
    }
 else
   echo "<br />No hay reportes disponibles."; 
 include_once("../footer.php");    
} 
/************************************construir filtro***************************/
elseif($_REQUEST["accion"]=="construir_filtro")
{$condiciones=array();
// print_r($_REQUEST);
 $etiquetas=array();
 for($i=0;$i<$_REQUEST["cuantos"];$i++)
   {
    if($_REQUEST["valor$i"]<>"" || is_array($_REQUEST["valor$i"]) || ($_REQUEST["operador$i"]=="fecha_doble" && $_REQUEST["valor".$i."1"]<>"" && $_REQUEST["valor".$i."2"]<>""))
      { //echo $_REQUEST["campo$i"]." ".$_REQUEST["operador$i"]." ".$_REQUEST["valor$i"]."<br /> ";
       $etiquetas[$i]="<b>".ucwords($_REQUEST["etiqueta$i"])." ";
       switch($_REQUEST["operador$i"])
         {case "like1": $cadena="lower(".$_REQUEST["campo$i"].") like '%".strtolower($_REQUEST["valor$i"])."%' ";
               $etiquetas[$i].=" similar a:</b> ".$_REQUEST["valoretiqueta$i"];
               break;
          case "like2": $cadena="lower(".$_REQUEST["campo$i"].") like '".strtolower($_REQUEST["valor$i"])."%' ";
               $etiquetas[$i].=" que empiece con:</b> ".$_REQUEST["valoretiqueta$i"];
               break;
          case "like3": $cadena="lower(".$_REQUEST["campo$i"].") like '%".strtolower($_REQUEST["valor$i"])."' ";
               $etiquetas[$i].=" que termine con:</b> ".$_REQUEST["valoretiqueta$i"];
               break; 
          case "igual": $cadena=$_REQUEST["campo$i"]." = '".$_REQUEST["valor$i"]."' ";
               $etiquetas[$i].=" igual a:</b> ".$_REQUEST["valoretiqueta$i"];
               break;
          case "mayor": $cadena=$_REQUEST["campo$i"]." >".$_REQUEST["valor$i"]." ";
               $etiquetas[$i].=" mayor que:</b> ".$_REQUEST["valoretiqueta$i"];
               break;
          case "menor": $cadena=$_REQUEST["campo$i"]." <".$_REQUEST["valor$i"]." ";
               $etiquetas[$i].=" menor que:</b> ".$_REQUEST["valoretiqueta$i"];
               break;   
          case "mayorigual": $cadena=$_REQUEST["campo$i"]." >=".$_REQUEST["valor$i"]." ";
               $etiquetas[$i].=" mayor o igual que:</b> ".$_REQUEST["valoretiqueta$i"];
               break;
          case "menorigual": $cadena=$_REQUEST["campo$i"]." <=".$_REQUEST["valor$i"]." ";
               $etiquetas[$i].=" menor o igual que:</b> ".$_REQUEST["valoretiqueta$i"];
               break;
          case "in": 
              $cadena=$_REQUEST["campo$i"]." in('".implode("','",$_REQUEST["valor$i"])."') ";
              $etiquetas[$i].=" que se encuentre entre:</b> ".$_REQUEST["valoretiqueta$i"];
               break;  
          case "arbol": 
              $valores=explode(",",$_REQUEST["valor$i"]);
              $cadena=" (";
              foreach($valores as $valor)
                $opciones[]=$_REQUEST["campo$i"]." like '%,$valor' or ".$_REQUEST["campo$i"]." like '$valor,%' or ".$_REQUEST["campo$i"]." like '$valor' or ".$_REQUEST["campo$i"]." like '%,$valor,%' "; 
              $cadena.=implode(" or ",$opciones);
              $cadena.=") ";
              $etiquetas[$i].=" que se encuentre entre:</b> ".$_REQUEST["valoretiqueta$i"];
              break;        
          case "fecha_doble": 
              $cadena=" (".fecha_db_obtener($_REQUEST["campo$i"],"Y-m-d").">='".$_REQUEST["valor".$i."1"]."' and ".fecha_db_obtener($_REQUEST["campo$i"],"Y-m-d")."<='".$_REQUEST["valor".$i."2"]."') ";
              $etiquetas[$i].=" que sea:</b> mayor o igual que ".$_REQUEST["valor".$i."1"]." y menor o igual que ".$_REQUEST["valor".$i."2"] ;
               break; 
          case "figual":$cadena=fecha_db_obtener($_REQUEST["campo$i"],"Y-m-d")."='".$_REQUEST["valor$i"]."'";
               $etiquetas[$i].=" igual a:</b> ".$_REQUEST["valor$i"];
               break;  
          case "fmayor": $cadena=fecha_db_obtener($_REQUEST["campo$i"],"Y-m-d").">'".$_REQUEST["valor$i"]."'";
               $etiquetas[$i].=" mayor que:</b> ".$_REQUEST["valor$i"];
               break;  
          case "fmenor": $cadena=fecha_db_obtener($_REQUEST["campo$i"],"Y-m-d")."<'".$_REQUEST["valor$i"]."'";
               $etiquetas[$i].=" menor que:</b> ".$_REQUEST["valor$i"];
               break;                                                 
         }
       
       $condiciones[]=$cadena;
      }
   }
   

 if(!empty($condiciones))
   {$condiciones=implode(" and ",$condiciones);
    $etiquetas=implode(" <b>y</b> <br />",$etiquetas);
    echo "<script>
          window.parent.document.getElementById(\"filtro".$_REQUEST["tipo"].$_REQUEST["id"]."\").value=\"$condiciones\"; 
          window.parent.document.getElementById(\"etiquetasfiltro".$_REQUEST["tipo"].$_REQUEST["id"]."\").value=\"$etiquetas\";
          window.parent.hs.close();
          </script>";
   }
}
include_once("../footer.php");
/************************************funciones***************************/
function operador($datos,$indice)
{switch($datos["etiqueta_html"])
   {case "text":
         if($datos["tipo_dato"]=="varchar")
           $texto="<td>
             <select name='operador$indice'>
             <option value='like1' selected >Similar a</option>
             <option value='like2'>Que empiece con</option>
             <option value='like3'>Que termine con</option>
             </td>";
         elseif($datos["tipo_dato"]=="int")
           $texto="<td>
             <select name='operador$indice'>
             <option value='igual' selected >Igual a</option>
             <option value='mayor'>Mayor que</option>
             <option value='menor'>Menor que</option>
             <option value='mayorigual'>Mayor o igual que</option>
             <option value='menorigual'>Menor o igual que</option>
             </td>";
         elseif($datos["tipo_dato"]=="fecha")
           $texto="<td>
             <select name='operador$indice'>
             <option value='figual' selected >Igual a</option>
             <option value='fmayor'>Mayor que</option>
             <option value='fmenor'>Menor que</option>
             </td>";          
         break;
    case "checkbox":
          $texto="<td>
             <select name='operador$indice'>
             <option value='in' selected >Entre</option> 
             </td>"; 
          break;
    case "arbol":
          $texto="<td>
             <select name='operador$indice'>
             <option value='arbol' selected >Entre</option> 
             </td>"; 
          break;      
    case "fecha_simple":
          $texto="<td>
             <select name='operador$indice'>
             <option value='figual' selected >Igual a</option>
             <option value='fmayor'>Mayor que</option>
             <option value='fmenor'>Menor que</option>
             </td>";
          break;      
    case "fecha_doble":
          $texto="<td>
             <select name='operador$indice'>
             <option value='fecha_doble' selected >Entre</option> 
             </td>"; 
          break;
    default:$texto="<td>
                <select name='operador$indice'>
                <option value='igual' selected >Igual a</option>
                </td>";
         break;     
   }
 return($texto);
}

function campo($datos,$indice)
{global $conn;

 if(strpos(strtolower($datos["codigo_sql"]),"select ")!==false&&$datos["etiqueta_html"]<>"text")
    {$datos_llenado=ejecuta_filtro_tabla($datos["codigo_sql"],$conn);

      if($datos_llenado["numcampos"]){
        $listado0=array();
        for($i=0;$i<$datos_llenado["numcampos"];$i++)
         {
array_push($listado0,html_entity_decode($datos_llenado[$i][0].",".trim(strip_tags(html_entity_decode($datos_llenado[$i][1])))));
         }
      $llenado=implode(";",$listado0);

    }
   } 
 elseif($datos["codigo_sql"]<>''&&$datos["etiqueta_html"]<>"text")
    {$llenado=html_entity_decode($datos["codigo_sql"]);
    } 
 else
    $llenado="";
 
 $listado3=array();                            
  if($llenado<>"" && $llenado<>"Null"){
    $listado1=explode(";",$llenado);
    
    $cont1=count($listado1);
    for($i=0;$i<$cont1;$i++){
      $listado2=explode(",",$listado1[$i]);
      array_push($listado3,$listado2);
    }
  }
  $cont3=count($listado3);

 switch($datos["etiqueta_html"])
   {case "text":$texto="<td><input type='hidden' name='campo$indice' value='".$datos["campo"]."'>
          <input type='text' onblur='valoretiqueta$indice.value=this.value' name='valor$indice' id='valor$indice'>";
         break;
    case "radio":$texto="<td>
          <input type='hidden' name='campo$indice' value='".$datos["campo"]."'>";
          
          for($j=0;$j<$cont3;$j++)
             {$texto.="<input onclick='valoretiqueta$indice.value=this.title' type='radio' name='valor$indice' value='".$listado3[$j][0]."' title='".utf8_encode($listado3[$j][1])."'>".utf8_encode($listado3[$j][1])."<br />";
             }
          $texto.="";
         break; 
    case "select":
         $texto="<td>
          <input type='hidden' name='campo$indice' value='".$datos["campo"]."'>
          <select onchange='valoretiqueta$indice.value=this.options[this.selectedIndex].text' name='valor$indice' ><option value=''>Seleccionar...</option>";
          
          for($j=0;$j<$cont3;$j++)
             {$texto.="<option value='".$listado3[$j][0]."'>".utf8_encode($listado3[$j][1])."</option>";
             }
          $texto.="</select>";
         break;  
    case "checkbox":
         $texto="<td>
          <input type='hidden' name='campo$indice' value='".$datos["campo"]."'>";
          
          for($j=0;$j<$cont3;$j++)
             {$texto.="<input type='checkbox' onclick='guardar_etiquetas_checkbox($indice,".$j.")' id='valor$indice".$j."' name='valor".$indice."[]' title='".utf8_encode($listado3[$j][1])."' value='".$listado3[$j][0]."'>".utf8_encode($listado3[$j][1])."<br />";
             }
          $texto.="";
         break;
    case "fecha_simple":
         $texto="<td>
          <input type='hidden' name='campo$indice' value='".$datos["campo"]."'>
          <input type='text' name='valor$indice' value=''>";
          $texto.=selector_fecha("valor$indice","form1","Y-m-d",date("m"),date("Y"),"default.css","../","AD:VALOR","VENTANA",false,false,7,00,"AM",1); 
          $texto.="";
         break; 
    case "fecha_doble":
         $texto="<td>
          <input type='hidden' name='campo$indice' value='".$datos["campo"]."'>";
         $texto.="<input type='text' name='valor".$indice."1' value=''>";
         $texto.=selector_fecha("valor".$indice."1","form1","Y-m-d",date("m"),date("Y"),"default.css","../","AD:VALOR","VENTANA",false,false,7,00,"AM",1);
         $texto.=" y <input type='text' name='valor".$indice."2' value=''>";
         $texto.=selector_fecha("valor".$indice."2","form1","Y-m-d",date("m"),date("Y"),"default.css","../","AD:VALOR","VENTANA",false,false,7,00,"AM",1);  
         $texto.="";
         break; 
    case "arbol":

         $arreglo=explode(";",$datos["codigo_sql"]);
         if(isset($arreglo) && $arreglo[0]!="")
           {$ruta="\"".$arreglo[0]."\"";
            $texto='<td >
            <input type="hidden" name="campo'.$indice.'" value="'.$datos["campo"].'"> 
            <input type="hidden" name="valor'.$indice.'" id="valor'.$indice.'">';
                 
            if($arreglo[4]){
                   $texto.='Buscar: <input type="text" id="stext_campo'.$indice.'" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_campo'.$indice.'.findItem(htmlentities(document.getElementById(\'stext_campo'.$indice.'\').value),1)"> <img src="../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_campo'.$indice.'.findItem(htmlentities(document.getElementById(\'stext_campo'.$indice.'\').value),0,1)"><img src="../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_campo'.$indice.'.findItem(htmlentities(document.getElementById(\'stext_campo'.$indice.'\').value))"><img src="../botones/general/siguiente.png"border="0px"></a> 
                          <br />';
                }
                $texto.='<div id="esperando_campo'.$indice.'"><img src="../imagenes/cargando.gif"></div><div id="treeboxbox_campo'.$indice.'" height="90%"></div>';
                  
                  $texto.='<script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_campo'.$indice.'=new dhtmlXTreeObject("treeboxbox_campo'.$indice.'","100%","100%",0);
                			tree_campo'.$indice.'.setImagePath("../imgs/");
                			tree_campo'.$indice.'.enableIEImageFix(true);';
                	if($arreglo[1]==1){
                		  $texto.='tree_campo'.$indice.'.enableCheckBoxes(1);
                			tree_campo'.$indice.'.enableThreeStateCheckboxes(1);';
                	}
                	else if($arreglo[1]==2){
                    $texto.='tree_campo'.$indice.'.enableCheckBoxes(1);
                    tree_campo'.$indice.'.enableRadioButtons(true);';
                      
                  }
                  
                	  $texto.='tree_campo'.$indice.'.setOnLoadingStart(cargando_campo'.$indice.');
                      tree_campo'.$indice.'.setOnLoadingEnd(fin_cargando_campo'.$indice.');';
                  if($arreglo[3]){
                    $texto.='tree_campo'.$indice.'.enableSmartXMLParsing(true);';
                  }
                  else
                    $texto.='tree_campo'.$indice.'.setXMLAutoLoading('.$ruta.');';
                 $texto.='tree_campo'.$indice.'.loadXML('.$ruta.');
                	        ';
                 if($arreglo[1]==1){
                      $texto.='
                      tree_campo'.$indice.'.setOnCheckHandler(onNodeSelect_campo'.$indice.');
                      function onNodeSelect_campo'.$indice.'(nodeId)
                      {valor_destino=document.getElementById("valor'.$indice.'");
                       destinos=tree_campo'.$indice.'.getAllChecked();
                       etiquetas=new Array();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(h=0;h<vector.length;h++)
                          {if(tree_campo'.$indice.'.getItemText(vector[h])!=0)
                             etiquetas[h]=tree_campo'.$indice.'.getItemText(vector[h]);
                          } 
                       for(i=0;i<vector.length;i++)
                          {
                           if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_campo'.$indice.'.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               
                               for(h=0;h<vectorh.length;h++)
                                  {if(vectorh[h].indexOf("_")!=-1)
                                      vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
                                   nuevo=eliminarItem(nuevo,vectorh[h]);
                                  } 
                              }
                          }
                       nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,""); 
                        
                       valor_destino.value=nuevo;
                       document.getElementById("valoretiqueta'.$indice.'").value=etiquetas.join(",");
                      }';
                    }
                  elseif($arreglo[1]==2){
                      $texto.='tree_campo'.$indice.'.setOnCheckHandler(onNodeSelect_campo'.$indice.');
                      function onNodeSelect_campo'.$indice.'(nodeId)
                      {valor_destino=document.getElementById("valor'.$indice.'");

                       if(tree_campo'.$indice.'.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_campo'.$indice.'.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                          document.getElementById("valoretiqueta'.$indice.'").value=tree_campo'.$indice.'.getItemText(nodeId);
                         }
                       else
                         {valor_destino.value="";
                          document.getElementById("valoretiqueta'.$indice.'").value="";
                         }
                      }';
                    }
                  $texto.="
                      function fin_cargando_campo".$indice."() {
                        if (browserType == \"gecko\" )
                           document.poppedLayer =
                               eval('document.getElementById(\"esperando_campo".$indice."\")');
                        else if (browserType == \"ie\")
                           document.poppedLayer =
                              eval('document.getElementById(\"esperando_campo".$indice."\")');
                        else
                           document.poppedLayer =
                              eval('document.layers[\"esperando_campo".$indice."\"]');
                        document.poppedLayer.style.display = \"none\";
                      }

                      function cargando_campo".$indice."() {
                        if (browserType == \"gecko\" )
                           document.poppedLayer =
                               eval('document.getElementById(\"esperando_campo".$indice."\")');
                        else if (browserType == \"ie\")
                           document.poppedLayer =
                              eval('document.getElementById(\"esperando_campo".$indice."\")');
                        else
                           document.poppedLayer =
                               eval('document.layers[\"esperando_campo".$indice."\"]');
                        document.poppedLayer.style.display = \"\";
                      }
                	";
             	$texto.="--></script>";
           }     
         break;                           
   }
 $texto.="<input type='hidden' name='etiqueta$indice' value='".$datos["etiqueta"]."'>
          <input type='hidden' name='valoretiqueta$indice' id='valoretiqueta$indice' value=''></td>";
 return($texto);

}

?>
<script>
function guardar_etiquetas_checkbox(indice,id)
{texto=document.getElementById("valor"+indice+id).title;
 estado=document.getElementById("valor"+indice+id).checked;
 elegidos=document.getElementById("valoretiqueta"+indice).value;

 if(elegidos!="")
   vector=elegidos.split(",");
 else
   vector=new Array();
     
 vector2=new Array();
 encontrado=0;
 j=0;
 for(i=0;i<vector.length;i++)
   {if(estado==false && vector[i]!=texto)
      {vector2[j]=vector[i];
       j++;
      }
      
    if(vector[i]==texto)
       encontrado=1;
       
   }
 if(estado==true && encontrado==0)
   vector[i]=texto;
 if(estado==false)
   vector=vector2;
   
 elegidos=document.getElementById("valoretiqueta"+indice).value=vector.join(',');        
}
</script> 