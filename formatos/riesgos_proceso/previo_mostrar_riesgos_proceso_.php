<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior.'librerias_saia.php');

echo(estilo_bootstrap());

include_once('../../db.php');
include_once('../librerias/estilo_formulario.php');
include_once('../librerias/funciones_generales.php');
include_once('librerias_riesgos.php');

$formato=busca_filtro_tabla("","formato","nombre_tabla LIKE 'ft_riesgos_proceso'","",$conn);
$prob[0]="La materializaci&oacute;n del riesgo ocurre con frecuencia";
$prob[1]="Es posible que suceda el da&ntilde;o alguna vez";
$prob[2]="No es esperable que se materialice el riesgo, aunque puede ser concebible";
$imp[0]="Consecuencias reversibles con poca inversi&oacute;n";
$imp[1]="Consecuencias parciales, de costosa y compleja reparaci&oacute;n";
$imp[2]="Destrucci&oacute;n total, muy dif&iacute;cil renovar";
?>
<?php include ("../../header.php");
//print_r($_REQUEST); ?>
<script type="text/javascript" src="../../js/tooltips_riesgos.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<style>.alineados{   padding: 0;   margin: 0;   border: 0;   background-color:#CCCCCC;   text-shadow: #333 1px 1px 3px;   text-align: center;   cursor: pointer;   display:inline; } 
.tabla_borde img{
border:0px;
}
</style>
<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<style type="text/css">	#dhtmlgoodies_tooltip{ 		background-color:#EEE; 		border:1px solid #000; 		position:absolute; 		display:none; 		z-index:30000; 		padding:2px; 		font-size:0.9em; 		-moz-border-radius:6px;	/* Rounded edges in Firefox */ 		font-family: "Trebuchet MS", "Lucida Sans Unicode", Arial, sans-serif; 	} 	#dhtmlgoodies_tooltipShadow{ 		position:absolute; 		background-color:#555; 		display:none; 		z-index:10000; 		opacity:0.7; 		filter:alpha(opacity=70); 		-khtml-opacity: 0.7; 		-moz-opacity: 0.7; 		-moz-border-radius:6px;	/* Rounded edges in Firefox */ 	} 	a{ 		color: #000000; 		text-decoration:none;		; 	} 	a:hover{ 		border-bottom:1px dotted #317082; 		color: #000000; 	} 	
</style>
<p><br />
<?php                 
   if(@$_REQUEST["enlace_adicionar_formato"] && @$_REQUEST["iddoc"]){
      $formato=busca_filtro_tabla("","formato","nombre_tabla LIKE 'ft_riesgos_proceso'","",$conn);
      /*if($formato["numcampos"]){
        agrega_boton("texto","../../botones/formatos/adicionar.gif","../../responder.php?idformato=".$formato[0]["idformato"]."&iddoc=".$_REQUEST["padre"],"","Adicionar ".$formato[0]["etiqueta"],$formato[0]["nombre_tabla"],"","",0);
        echo("<br /><br />");
        $alto_frame="94%";
      }*/
    }
?>
  <table cellpadding=2 border=1 width=100% bordercolor=silver style="border-collapse:collapse">
    <tr>
    	<td><a href="mostrar_riesgos_resumen.php?llave=<?php echo(@$_REQUEST["llave"]);?>">VER COMO LISTADO</a></td>
        <!--td><a href="previo_mostrar_riesgos_proceso.php?llave=<?php echo(@$_REQUEST["llave"]);?>">VER COMO CUADRO DE MANDO</a></td-->
        <td>
        <div>
          <a href="#" onclick="return hs.htmlExpand(this)">POLITICAS DE ADMINISTRACI&Oacute;N</a>
          <div class="highslide-maincontent">
            <table border=1 cellpadding=2 style="border-collapse:collapse" bordercolor="gray">
              <tr>
                <td colspan=2 class="encabezado_list">POLITICAS DE ADMINISTRACI&Oacute;N DEL RIESGO</td>
              </tr>
              <tr>
                <td colspan=2 align="center" bgcolor=silver>OPCIONES DE MANEJO</td>
              </tr>
              <tr>
                <td align="center"><b>EVITAR</b></td><td> Tomar las medidas encaminadas a prevenir su materializaci&oacute;n. 
                  <tr>
                    <td align="center"><b>REDUCIR</b></td><td> Tomar medidas encaminadas a disminuir tanto la probabilidad como el impacto. 
                      <tr>
                        <td align="center"><b>COMPARTIR O TRANSFERIR</b></td><td> Medidas para traspasar las p&eacute;rdidas a otras organizaciones, como es el caso de los seguros. 
                          <tr>
                            <td align="center"><b>ASUMIR</b></td><td> Aceptar la p&eacute;rdida residual probable y elaborar planes de contingencia. </td>
                          </tr>
            </table>
          </div>
        </div></td>
        <td>
        	<div>
          		<a href="#" onclick="return hs.htmlExpand(this)">CALIFICACI&Oacute;N</a>
          		<div class="highslide-maincontent">
            	<table border=1 cellpadding=2 style="border-collapse:collapse" bordercolor="gray">
              <tr>
                <td colspan=2 class="encabezado_list">CALIFICACI&Oacute;N DEL RIESGO</td>
              </tr>
              <tr align="center" bgcolor=silver>
                <td >INTERPRETACI&Oacute;N</td><td>ACCIONES</td>
              </tr>
              <!--tr>
                <td align="center"><b>RIESGO TOLERABLE</b></td>
                <td align=justify>No se requiere una acci&oacute;n inmediata ni mejorar las acciones preventivas. Sin embargo, se requieren seguimientos peri&oacute;dicos para asegurar que se mantiene la eficacia de las medidas de control existentes. </td>
              </tr>
              <tr>
                <td align="center"><b>RIESGO MODERADO</b> </td>
                <td align=justify>Se deben hacer esfuerzos para reducir el riesgo. Las acciones que se determinen para el efecto deben tener un tiempo especificado para su implementaci&oacute;n. Puede que se requieran recursos considerables. </td>
              </tr>
              <tr>
                <td align="center"><b>RIESGO INTOLERABLE</b></td>
                <td align=justify>Se requieren acciones inmediatas. No deberia continuarse con el proceso hasta que el riesgo haya sido intervenido, con el fin de evitar que el impacto aumente. </td>
              </tr-->
           <tr>
                <td align="center"><b>RIESGO ACEPTABLE</b></td>
                <td align=justify>La Entidad puede asumirlo, es decir,el riesgo se encuentra en un nivel que puede aceptarlo sin necesidad de tomar otras medidas de control diferentes a las que se poseen. </td>
              </tr>
           <tr>
                <td align="center"><b>RIESGO INACEPTABLE</b></td>
                <td align=justify>Es aconsejable eliminar la actividad que genera el riesgo en la medida que sea posible, de lo contrario se deben implementar controles de prevenci&oacute;n para evitar la Probabilidad del riesgo, de Protecci&oacute;n para disminuir el Impacto o compartir o transferir el riesgo si es posible a trav&eacute;s de p&oacute;lizas de seguros u otras opciones que est&eacute;n disponibles.</td>
              </tr> 
          <tr>
                <td align="center"><b>RIESGO TOLERABLE, MODERADO, IMPORTANTE</b></td>
                <td align=justify>
                Si el riesgo se sit&uacute;a en cualquiera de las zonas se deben tomar medidas para llevar los Riesgos a la Zona Aceptable o Tolerable, en lo posible. <br><br>Las medidas dependen de la celda en la cual se ubica el riesgo, as&iacute;: <br><br><b>Los Riesgos de Impacto leve y Probabilidad alta</b> se previenen.<br><br><b>Los Riesgos con Impacto moderado y Probabilidad leve</b> se reduce o se comparte el riesgo, si es posible. Tambi&eacute;n es viable combinar estas medidas con evitar el riesgo cuando &eacute;ste presente una <b>Probabilidad alta y media, y el Impacto sea moderado o catastr&oacute;fico</b></b>.<br><br><b>Cuando la Probabilidad del riesgo sea media y su Impacto leve</b>, se debe realizar un an&aacute;lisis del costo beneficio con el que se pueda decidir entre reducir el riesgo, asumirlo o compartirlo. <br><br><b>Cuando el riesgo tenga una Probabilidad baja y Impacto catastr&oacute;fico</b> se debe tratar de compartir el riesgo y evitar la entidad en caso de que &eacute;ste se presente. <br><br>Siempre que el riesgo sea calificado con <b>Impacto catastr&oacute;fico</b> la Entidad debe dise&ntilde;ar planes de contingencia, para protegerse en caso de su ocurrencia.                                      
                </td>
              </tr>          
          </table>
          </div>
        </div></td>
    </tr>
    <tr>
    	<td><a href="guia_adm_riesgo_meci.pdf" target="_blank">GU&Iacute;A ADMINISTRACI&Oacute;N DE RIESGOS</a></td>
        <td colspan="2"><a href="capitulo1_3_meci.html" onclick="return hs.htmlExpand(this, { objectType: 'iframe' } )">TERMINOLOG&Iacute;A</a></td>
    </tr>
   <tr><td colspan="3">  
        <a title="Los riesgos en los cuales <?php echo usuario_actual('nombres').' '.usuario_actual('apellidos'); ?> aparece como responsable en la administraci&oacute;n del riesgo" href="<?php echo 'previo_mostrar_riesgos_proceso.php?llave='.$_REQUEST["llave"].'&responsable='.usuario_actual('funcionario_codigo');?>" target="_self">MIS RESPONSABILIDADES SOBRE LA ADMINISTRACI&Oacute;N DEL RIESGO</a></td></tr>      
  </table><br /><br /><br />
</p>
<table border="1" width="100%" cellspacing="0" class="tabla_borde">
  <tbody>
    <tr>
      <td  style=" border: windowtext 0.5pt solid;" rowspan="3" align="center" >PROBABILIDAD</td>
      <td  style=" border: windowtext 0.5pt solid; text-align: center;" onmouseout="hideTooltip()" onMouseOver="showTooltip(event,'<?php echo $prob[0]; ?>');return false">Alta<br />(3)</td>
      <td  style=" border: windowtext 0.5pt solid; border: 0.5pt solid windowtext; text-align: center; background-color: yellow; vertical-align:top;">
        <p> 
          <label ><b>Riesgo Moderado</b><br />
            <?php echo(cuadrante(5,3)); ?>
        </p></td>
      <td  style=" border: windowtext 0.5pt solid; border: 0.5pt solid windowtext; text-align: center; background-color: #FFC0A0;  vertical-align:top;"  ><b>Riesgo Importante</b><br />
        <?php echo(cuadrante(10,3)); ?></td>
      <td  style=" border: windowtext 0.5pt solid; border: 0.5pt solid windowtext; text-align: center; background-color: red; vertical-align:top;">
        <p><b>Riesgo Inaceptable</b><br />
          <?php echo(cuadrante(20,3)); ?>
        </p></td>
    </tr>
    <tr>
      <td  style=" border: windowtext 0.5pt solid; text-align: center;" onmouseout="hideTooltip()" onMouseOver="showTooltip(event,'<?php echo $prob[1]; ?>');return false">Media<br />(2)</td>
      <td  style=" border: windowtext 0.5pt solid; border: 0.5pt solid windowtext; text-align: center; background-color: #71cc1e;  vertical-align:top;"><b>Riesgo Tolerabl</b>e<br />
        <?php echo(cuadrante(5,2)); ?></td>
      <td  style=" border: windowtext 0.5pt solid; border: 0.5pt solid windowtext; text-align: center; background-color: #FFCC00;  vertical-align:top;"><b>Riesgo Moderado</b><br />
        <?php echo(cuadrante(10,2)); ?></td>
      <td  style=" border: windowtext 0.5pt solid; border: 0.5pt solid windowtext; text-align: center; background-color: #FF6060;  vertical-align:top;"><b>Riesgo Importante</b><br />
        <?php echo(cuadrante(20,2)); ?></td>
    </tr>
    <tr>
      <td  style=" border: windowtext 0.5pt solid; text-align: center;" onmouseout="hideTooltip()" onMouseOver="showTooltip(event,'<?php echo $prob[2]; ?>');return false">Baja<br />(1)</td>
      <td  style=" border: windowtext 0.5pt solid; border: 0.5pt solid windowtext; text-align: center; background-color: #CCFF66; vertical-align:top;"><b>Riesgo Aceptable</b><br />
        <?php echo(cuadrante(5,1)); ?></td>
      <td  style=" border: windowtext 0.5pt solid; border: 0.5pt solid windowtext; text-align: center; background-color: #71cc1e; vertical-align:top;"><b>Riesgo Tolerable</b><br />
        <?php echo(cuadrante(10,1)); ?></td>
      <td  style=" border: windowtext 0.5pt solid; border: 0.5pt solid windowtext; text-align: center; background-color: #FFCC00; vertical-align:top;"><b>Riesgo Moderado</b><br />
        <?php echo(cuadrante(20,1)); ?></td>
    </tr>
    <tr>
      <td  style=" border: windowtext 0.5pt solid; " rowspan="2" colspan=2>&nbsp;</td>
      <td  style=" border: windowtext 0.5pt solid; text-align: center;" onmouseout="hideTooltip()" onMouseOver="showTooltip(event,'<?php echo $imp[0]; ?>');return false">Leve<br />(5)</td>
      <td  style=" border: windowtext 0.5pt solid; text-align: center;" onmouseout="hideTooltip()" onMouseOver="showTooltip(event,'<?php echo $imp[1]; ?>');return false">Moderado<br />(10)</td>
      <td  style=" border: windowtext 0.5pt solid; text-align: center;" onmouseout="hideTooltip()" onMouseOver="showTooltip(event,'<?php echo $imp[2]; ?>');return false">Catastr&oacute;fico<br />(20)</td>
    </tr>
    <tr>
      <td  style=" border: windowtext 0.5pt solid; text-align: center;" colspan="3" >IMPACTO</td>
    </tr>
  </tbody>
</table>
</p>
<p>&nbsp;
</p>
</p>
<?php

include_once($ruta_db_superior.'formatos/riesgos_proceso/mostrar_riesgos_tipo_corrupcion.php');
function cuadrante($impacto,$probabilidad){
global $conn,$formato,$proceso;
$texto="";
$dato=explode("-",$_REQUEST["llave"]); 
if(isset($_REQUEST["responsable"])&&$_REQUEST["responsable"])
  {$resp=$_REQUEST["responsable"];
   $adicionales=" and (responsables like '$resp' or responsables like '%,$resp' or responsables like '$resp,%' or responsables like '%,$resp,%')";
  }
else
  $adicionales="";  
$riesgos=busca_filtro_tabla("impacto,probabilidad,descripcion AS nombre,idft_riesgos_proceso,consecutivo,documento_iddocumento ","ft_riesgos_proceso","estado<>'INACTIVO' $adicionales AND ft_proceso=".$dato[2],"idft_riesgos_proceso asc",$conn);
//print_r($riesgos);
for($i=0;$i<$riesgos["numcampos"];$i++)
{//
  $seguimientos=busca_filtro_tabla("","ft_seguimiento_riesgo,documento","ft_riesgos_proceso=".$riesgos[$i]["idft_riesgos_proceso"]." AND documento_iddocumento=iddocumento and estado<>'ELIMINADO'","iddocumento asc",$conn);
 
  if($seguimientos["numcampos"]){ 
   for($j=0;$j<$seguimientos["numcampos"];$j++) 
    {if($seguimientos[$j]["probabilidad"]<>2)                                                
       {if($seguimientos[$j]["probabilidad"]==1 && $riesgos[$i]["probabilidad"]>1)
         $riesgos[$i]["probabilidad"]--;
        elseif($seguimientos[$j]["probabilidad"]==3 && $riesgos[$i]["probabilidad"]<3) 
         $riesgos[$i]["probabilidad"]++;
       }  
     if($seguimientos[$j]["impacto"]<>2) 
       {if($seguimientos[$j]["impacto"]==1 && $riesgos[$i]["impacto"]>5)
          $riesgos[$i]["impacto"]/=2;
        elseif($seguimientos[$j]["impacto"]==3 && $riesgos[$i]["impacto"]<20) 
          $riesgos[$i]["impacto"]*=2;
       } 
    }
 
  }
 if($riesgos[$i]["impacto"]==$impacto&&$riesgos[$i]["probabilidad"]==$probabilidad)
    {$texto.='<a title="'.strip_tags(mostrar_valor_campo("descripcion",$formato[0]["idformato"],$riesgos[$i]["documento_iddocumento"],1)).'" href="mostrar_riesgos_proceso_1.php?idformato='.$formato[0]["idformato"].'&iddoc='.$riesgos[$i]["documento_iddocumento"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: '."'iframe'".',width: 550, height:400,preserveContent:false } )" style="text-decoration: underline; cursor:pointer;">Riesgo No.'.strip_tags($riesgos[$i]["consecutivo"]).'</a>&nbsp;';
    if($seguimientos["numcampos"])
       $texto.='<!--a href="listado_seguimientos_riesgos_proceso.php?idriesgo='.$riesgos[$i]["idft_riesgos_proceso"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: '."'iframe'".',width: 450, height:200,preserveContent:false } )" style="cursor:pointer;"><img src="../../images/arrow_out.png" width="10" height="10" border=0 /></a-->';
     $texto.= "<br />"; 
    }   
  
}
//print_r($riesgos);die();
return($texto);
}
include_once("../../footer.php");
?>