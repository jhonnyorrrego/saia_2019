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
include_once($ruta_db_superior."db.php");
//include_once($ruta_db_superior."formatos/seguimiento_riesgo/funciones.php");
//include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."pantallas/lib/librerias_notificaciones.php");
include_once($ruta_db_superior."librerias_saia.php");



function mostrar_nombre_parseo($idformato,$iddoc){
    global $conn,$consulta_parseo;   
    $consulta_parseo=busca_filtro_tabla("nombre,riesgo,descripcion,fuente_causa,consecuencia","ft_riesgos_proceso","documento_iddocumento=".$iddoc,"",$conn);
    echo( strip_tags(codifica_encabezado(html_entity_decode($consulta_parseo[0]['nombre']))) );
}
function mostrar_riesgo_parseo($idformato,$iddoc){
    global $conn,$consulta_parseo;
    echo( strip_tags(codifica_encabezado(html_entity_decode($consulta_parseo[0]['riesgo']))) );
}
function mostrar_descripcion_parseo($idformato,$iddoc){
    global $conn,$consulta_parseo;   
    echo( strip_tags(codifica_encabezado(html_entity_decode($consulta_parseo[0]['descripcion']))) );
}
function mostrar_fuente_causa_parseo($idformato,$iddoc){
    global $conn,$consulta_parseo; 
    echo( strip_tags(codifica_encabezado(html_entity_decode($consulta_parseo[0]['fuente_causa']))) );
}
function mostrar_consecuencia_parseo($idformato,$iddoc){
    global $conn,$consulta_parseo;  
    echo( strip_tags(codifica_encabezado(html_entity_decode($consulta_parseo[0]['consecuencia']))) );
}


function danio_riesgo($idformato,$iddoc){
global $conn;
$texto="";

$rotulo=validar_cuadrante($iddoc);
$texto.="<div style='width:100%; height=100%; background-color:".$rotulo["color"].";' >".$rotulo["nombre"]."</div>";
echo($texto);
} 

function editar_riesgos_proceso($idformato,$iddoc){
	global $conn;
 	
 	
    $formato=busca_filtro_tabla("","formato A","A.idformato=".$idformato,"",$conn); 	
	$ejecutor=busca_filtro_tabla("ejecutor","documento","iddocumento=".$iddoc,"",$conn);
	
	$area=busca_filtro_tabla("area_responsable","ft_riesgos_proceso","documento_iddocumento=".$iddoc,"",$conn);
	$funcionario=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia in (".$area[0]["area_responsable"].")","group by funcionario_codigo",$conn);
/*
	if(usuario_actual("login")=="ximena" || usuario_actual("login")=="0k"){
		?>
		<script type="text/javascript" src="../../js/jquery.js"></script>
		<script>
			$(document).ready(function() {
				$('#editar_riesgo').click(function(){			
					window.location="<?php echo $formato[0]['ruta_editar'].'?idformato='.$idformato.'&iddoc='.$iddoc; ?>";			   
				});		
			});		 
		</script>
		<a href='#' id='editar_riesgo'>Editar Riesgo</a>
		<?php			
	}	
	
	*/
    if(@$_REQUEST['tipo']!=5){
	if(usuario_actual("funcionario_codigo")==$ejecutor[0]["ejecutor"] || usuario_actual("login")=="0k"){		 
?>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script>
	$(document).ready(function() {
		$('#editar_riesgo').click(function(){			
			window.location="<?php echo $formato[0]['ruta_editar'].'?idformato='.$idformato.'&iddoc='.$iddoc; ?>";			   
		});		
	});		 
</script>
<a href='#' id='editar_riesgo'>Editar Riesgo</a>
<?php		
	}else{	
		for ($i=0; $i <$funcionario["numcampos"] ; $i++) { 
			if(usuario_actual("funcionario_codigo")==$funcionario[$i]["funcionario_codigo"]){
				?>
				<script type="text/javascript" src="../../js/jquery.js"></script>
				<script>
					$(document).ready(function() {
						$('#editar_riesgo').click(function(){			
							window.location="<?php echo $formato[0]['ruta_editar'].'?idformato='.$idformato.'&iddoc='.$iddoc; ?>";			   
						})
					});		 
				</script>
				<a href='#' id='editar_riesgo'>Editar Riesgo</a>
				<?php
			}
		}	
	}
	}
}

function impacto_nuevo($idformato,$iddoc)
{$etiquetas=array("5"=>"Leve","10"=>"Moderado","20"=>"Catastr&oacute;fico");
 $valores=recalcular_valores($iddoc);
 echo $etiquetas[$valores["impacto"]];
}

function probabilidad_nueva($idformato,$iddoc)
{$etiquetas=array("1"=>"Baja","2"=>"Media","3"=>"Alta");
 $valores=recalcular_valores($iddoc);
 //echo $etiquetas[$valores["probabilidad"]];
 echo mostrar_valor_campo("probabilidad",$idformato,$iddoc,1);
}

function ultimas_politicas($idformato,$iddoc)
{global $conn;

$idformato_riesgos_proceso=busca_filtro_tabla("idformato","formato","nombre='riesgos_proceso'","",$conn);

 $riesgo=busca_filtro_tabla("","ft_riesgos_proceso","documento_iddocumento=$iddoc","",$conn); 
 /* $seguimiento=busca_filtro_tabla("b.*","ft_seguimiento_riesgo b,documento c","b.ft_riesgos_proceso=".$riesgo[0]["idft_riesgos_proceso"]." AND b.documento_iddocumento=c.iddocumento and c.estado<>'ELIMINADO'","iddocumento desc",$conn);
  if($seguimiento["numcampos"])
    {$manejo=mostrar_valor_campo('manejo',14,$seguimiento[0]["documento_iddocumento"],1);
     $acciones=$seguimiento[0]["acciones"];
     $indicador=$seguimiento[0]["indicador"]; 
     $cronograma=$seguimiento[0]["cronograma"];
    }  
  else */
    {$manejo=mostrar_valor_campo('opciones_manejo',$idformato_riesgos_proceso[0]['idformato'],$iddoc,1);
     $acciones=$riesgo[0]["acciones"];
     $indicador=$riesgo[0]["indicador"];
     $cronograma=$riesgo[0]["cronograma"];
    } 
 echo htmlspecialchars_decode("<table WIDTH=100%>
       <tr><td class=encabezado WIDTH=30%>Opciones de manejo</td>
       <td>$manejo</td></tr>
       <tr><td class=encabezado>Acciones</td><td>$acciones</td></tr>
       <tr><td class=encabezado>Responsables</td><td>");
  if($seguimiento["numcampos"]){
     $idformato_seguimiento_riesgo=busca_filtro_tabla("idformato","formato","nombre='seguimiento_riesgo'","",$conn);
     listar_funcionarios($idformato_seguimiento_riesgo[0]['idformato'],"responsables",$seguimiento[0]["documento_iddocumento"]);      
  }else{
      listar_funcionarios($idformato_riesgos_proceso[0]['idformato'],"responsables",$iddoc);   
  }

  echo htmlspecialchars_decode("</td></tr>
       <tr><td class=encabezado>Indicador</td><td>$indicador</td></tr>
       <tr><td class=encabezado>Cronograma</td><td>$cronograma</td></tr>
       </table>");
}

function validar_cuadrante($iddoc)
{
 $valores=recalcular_valores($iddoc);

 $total=$valores["impacto"]*$valores["probabilidad"];
switch($total)
{case 5:
  $rotulo=array("color"=>"#CCFF66","nombre"=>"Riesgo Aceptable");
  break;
 case 10: 
  $rotulo=array("color"=>"#71cc1e","nombre"=>"Riesgo Tolerable");
  break;
 case 15:    
  $rotulo=array("color"=>"yellow","nombre"=>"Riesgo Moderado");
  break;
 case 20:    
  $rotulo=array("color"=>"#FFCC00","nombre"=>"Riesgo Moderado");
  break; 
 case 30:    
  $rotulo=array("color"=>"#FFC0A0","nombre"=>"Riesgo Importante");
  break; 
 case 40:    
  $rotulo=array("color"=>"#FF6060","nombre"=>"Riesgo Importante");
  break; 
 case 60:    
  $rotulo=array("color"=>"red","nombre"=>"Riesgo Inaceptable");
  break; 
}                 
return($rotulo);
}
function consecutivo_riesgo($idformato,$idcampo,$iddoc=NULL)
{global $conn;
  
 if($iddoc==NULL)
    {$riesgos=busca_filtro_tabla("idft_riesgos_proceso,consecutivo","ft_riesgos_proceso r,documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_proceso=".$_REQUEST["padre"]." AND r.estado<>'INACTIVO'","consecutivo asc",$conn);
    }
 else
    {$padre=busca_filtro_tabla("ft_proceso","ft_riesgos_proceso","documento_iddocumento=$iddoc","",$conn);
     $riesgos=busca_filtro_tabla("idft_riesgos_proceso,consecutivo","ft_riesgos_proceso r,documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_proceso=".$padre[0][0]." AND r.estado<>'INACTIVO'","consecutivo asc",$conn);   
    } 
 $j=1;
 for($i=0;$i<$riesgos["numcampos"];$i++)
   {if($riesgos[$i]["consecutivo"]<>$j)
      {$sql="update ".DB.".ft_riesgos_proceso set consecutivo=$j where idft_riesgos_proceso='".$riesgos[$i]["idft_riesgos_proceso"]."'";
       phpmkr_query($sql,$conn);
      }
    $j++;
   }
 
 if($iddoc==NULL) 
    $riesgos[0][0]=$j;
 else
    $riesgos=busca_filtro_tabla("consecutivo","ft_riesgos_proceso","documento_iddocumento=$iddoc","",$conn);     
 echo "<td><input type='text' id='consecutivo' name='consecutivo' value='".($riesgos[0][0])."' readonly='readonly'></td>"; 
}
function notificar_riesgo($idformato,$iddoc)
{global $conn;
$responsables=busca_filtro_tabla("responsables","ft_riesgos_proceso","documento_iddocumento=".$iddoc,"",$conn);
//print_r($responsables);die();
 if($responsables["numcampos"]){
  $datos["archivo_idarchivo"]=$iddoc;
  $datos["origen"]=usuario_actual("funcionario_codigo");
  $datos["nombre"]="TRANSFERIDO";
  $datos["tipo"]="";
  $datos["tipo_origen"]="1";      
  $datos["tipo_destino"]="1";
  $lista=explode(",",$responsables[0]["responsables"]);
  for($i=0;$i<count($lista);$i++)
  {if(strpos($lista[$i],"#")!==false)
    $lista[$i]=buscar_funcionarios(str_replace("#","",$lista[$i]),$lista[$i]);
   else
     $lista[$i]=array($lista[$i]);
   transferir_archivo_prueba($datos,$lista[$i],"");
  }  
}

}
function matriz_riesgo($idformato,$iddoc){
	global $conn;
	
	$retorno_cuadrante=cuadrante_funcion($idformato,$iddoc);

	$vector_retorno_cuadrante=explode('||',$retorno_cuadrante);
	$vector_texto=array('1_1'=>'','2_1'=>'','3_1'=>'','4_1'=>'','5_1'=>'','1_2'=>'','2_2'=>'','3_2'=>'','4_2'=>'','5_2'=>'','1_3'=>'','2_3'=>'','3_3'=>'','4_3'=>'','5_3'=>'','1_4'=>'','2_4'=>'','3_4'=>'','4_4'=>'','5_4'=>'','1_5'=>'','2_5'=>'','3_5'=>'','4_5'=>'','5_5'=>'');
	$vector_texto[$vector_retorno_cuadrante[0]]=$vector_retorno_cuadrante[1];
	
	?>
	<table border="1" width="100%" cellspacing="0" class="tabla_borde" style="border-collapse:collapse">
  <tbody>
    <tr>
      <td  style="background:#E7E7E9" rowspan="2" align="center" >PROBABILIDAD</td>
      <td  style="text-align: center;background:#E7E7E9" colspan="5" >IMPACTO</td>
    </tr>
    <tr>
      <td  style="text-align: center;background:#E7E7E9" >Insignificante<br />(1)</td>
      <td  style="text-align: center;background:#E7E7E9" >Menor<br />(2)</td>
      <td  style="text-align: center;background:#E7E7E9" >Moderado<br />(3)</td>
      <td  style="text-align: center;background:#E7E7E9" >Mayor<br />(4)</td>
      <td  style="text-align: center;background:#E7E7E9" >Catastr&oacute;fico<br />(5)</td>
    </tr>
    <tr>
      <td style="text-align:center;">Raro (1)</td>
      <td style="text-align:center;background-color: green;vertical-align:top;" id="1_1">B<br /><?php echo($vector_texto['1_1']); ?></td>
      <td style="text-align:center;background-color:green;vertical-align:top;" id="2_1">B<br /><?php echo($vector_texto['2_1']); ?></td>
      <td style="text-align:center;background-color:yellow;vertical-align:top;" id="3_1">M<br /><?php echo($vector_texto['3_1']); ?></td>
      <td style="text-align:center;background-color:#DAAAA6;vertical-align:top;" id="4_1">A<br /><?php echo($vector_texto['4_1']); ?></td>
      <td style="text-align:center;background-color:#DAAAA6;vertical-align:top;" id="5_1">A<br /><?php echo($vector_texto['5_1']); ?></td>
    </tr>
    <tr>
      <td style="text-align:center;">Improbable (2)</td>
      <td style="text-align:center;background-color:green;vertical-align:top;" id="1_2">B<br /><?php echo($vector_texto['1_2']); ?></td>
      <td style="text-align:center;background-color:green;vertical-align:top;" id="2_2">B<br /><?php echo($vector_texto['2_2']); ?></td>
      <td style="text-align:center; background-color:yellow;vertical-align:top;" id="3_2">M<br /><?php echo($vector_texto['3_2']); ?></td>
      <td style="text-align:center;background-color:#DAAAA6;vertical-align:top;" id="4_2">A<br /><?php echo($vector_texto['4_2']); ?></td>
      <td style="text-align:center;background-color:red;vertical-align:top;" id="5_2">E<br /><?php echo($vector_texto['5_2']); ?></td>
    </tr>
    <tr>
      <td style="text-align:center;">Posible (3)</td>
      <td style="text-align:center;background-color:green;vertical-align:top;" id="1_3">B<br /><?php echo($vector_texto['1_3']); ?></td>
      <td style="text-align:center;background-color:yellow;vertical-align:top;" id="2_3">M<br /><?php echo($vector_texto['2_3']); ?></td>
      <td style="text-align:center;background-color:#DAAAA6;vertical-align:top;" id="3_3">A<br /><?php echo($vector_texto['3_3']); ?></td>
      <td style="text-align:center;background-color:red;vertical-align:top;" id="4_3">E<br /><?php echo($vector_texto['4_3']); ?></td>
      <td style="text-align:center;background-color:red;vertical-align:top;" id="5_3">E<br /><?php echo($vector_texto['5_3']); ?></td>
    </tr>
    <tr>
      <td style="text-align: center;">Probable (4)</td>
      <td style="text-align:center;background-color:yellow; vertical-align:top;" id="1_4">M<br /><?php echo($vector_texto['1_4']); ?></td>
      <td style="text-align: center; background-color: #DAAAA6;  vertical-align:top;" id="2_4">A<br /><?php echo($vector_texto['2_4']); ?></td>
      <td style="text-align: center; background-color: #DAAAA6; vertical-align:top;" id="3_4">A<br /><?php echo($vector_texto['3_4']); ?></td>
      <td style="text-align: center; background-color: red; vertical-align:top;" id="4_4">E<br /><?php echo($vector_texto['4_4']); ?></td>
      <td style="text-align: center; background-color: red; vertical-align:top;" id="5_4">E<br /><?php echo($vector_texto['5_4']); ?></td>
    </tr>
    <tr>
      <td style="text-align:center;">Casi seguro (5)</td>
      <td style="text-align:center;background-color:#DAAAA6;vertical-align:top;" id="1_5">A<br /><?php echo($vector_texto['1_5']); ?></td>
      <td style="text-align:center;background-color:#DAAAA6;vertical-align:top;" id="2_5">A<br /><?php echo($vector_texto['2_5']); ?></td>
      <td style="text-align:center;background-color:red;vertical-align:top;" id="3_5">E<br /><?php echo($vector_texto['3_5']); ?></td>
      <td style="text-align:center;background-color:red;vertical-align:top;" id="4_5">E<br /><?php echo($vector_texto['4_5']); ?></td>
      <td style="text-align:center;background-color:red;vertical-align:top;" id="5_5">E<br /><?php echo($vector_texto['5_5']); ?></td>
    </tr>
    <tr>
    	<td colspan="6" style="text-align: left;">
    		B: Zona de riesgo baja: Asumir el riesgo<br>
    		M: Zona de riesgo moderada: Asumir el riesgo, reducir el riesgo<br>
    		A: Zona de riesgo Alta: Reducir el riesgo, evitar, compartir o transferir<br>
    		E: Zona de riesgo extrema: Reducir el riesgo, evitar, compartir o transferir
    	</td>
    </tr>
  </tbody>
</table>
	<?php
	
}
function cuadrante_funcion($idformato,$iddoc){
global $conn,$ruta_db_superior;
$texto="";
include_once($ruta_db_superior."formatos/riesgos_proceso/librerias_riesgos.php");

$riesgos=busca_filtro_tabla("impacto,probabilidad,descripcion AS nombre,idft_riesgos_proceso,consecutivo,documento_iddocumento ","ft_riesgos_proceso","estado<>'INACTIVO' $adicionales AND documento_iddocumento=".$iddoc,"idft_riesgos_proceso asc",$conn);

$seguimientos=busca_filtro_tabla("","ft_seguimiento_riesgo,documento","ft_riesgos_proceso=".$riesgos[$i]["idft_riesgos_proceso"]." AND documento_iddocumento=iddocumento and estado<>'ELIMINADO'","iddocumento asc",$conn);

$texto='';
$texto.='<a title="'.strip_tags(mostrar_valor_campo("descripcion",$idformato,$riesgos[$i]["documento_iddocumento"],1)).'" href="mostrar_riesgos_proceso.php?idformato='.$idformato.'&iddoc='.$riesgos[$i]["documento_iddocumento"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: '."'iframe'".',width: 550, height:400,preserveContent:false } )" style="text-decoration: underline; cursor:pointer;">Riesgo No.'.strip_tags($riesgos[0]["consecutivo"]).'</a>&nbsp;';

if($seguimientos["numcampos"])
	$texto.='<a href="listado_seguimientos_riesgos_proceso.php?idriesgo='.$riesgos[$i]["idft_riesgos_proceso"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: '."'iframe'".',width: 450, height:200,preserveContent:false } )" style="cursor:pointer;"><img src="../../images/arrow_out.png" width="10" height="10" border=0 /></a>';
     $texto.= "<br />";

$disminuir=valoraciones($riesgos[0]["idft_riesgos_proceso"]);
$probabilidad_auto=nuevo_punto_matriz($riesgos[0]["probabilidad"],$disminuir[0]);
$impacto_auto=nuevo_punto_matriz($riesgos[0]["impacto"],$disminuir[1]);

//llenar_evaluaciones_particular($impacto_auto,$probabilidad_auto,$texto);

$cadena_parseo=$impacto_auto.'_'.$probabilidad_auto.'||'.$texto;
return($cadena_parseo);


}

function llenar_evaluaciones_particular($impacto,$probabilidad,$texto){
	global $conn;
	
	?>
	<script>
	$(document).ready(function(){
	    $("#<?php echo $impacto; ?>_<?php echo $probabilidad; ?>").append('<?php echo str_replace("'","\'",$texto); ?>');
	});
	</script>
	<?php
}
function adicionar_control_riesgo($idformato,$iddoc){
	global $conn, $ruta_db_superior;
	if(@$_REQUEST['tipo']!=5){
	    $padre=busca_filtro_tabla("idft_riesgos_proceso, riesgo_antiguo","ft_riesgos_proceso a","documento_iddocumento=".$iddoc,"",$conn);
	    echo '<a href="'.$ruta_db_superior.'formatos/control_riesgos/adicionar_control_riesgos.php?padre='.$padre[0]["idft_riesgos_proceso"].'&anterior='.$iddoc.'">Adicionar Valoracion Control de Riesgo</a>';	    
	}

}
function fecha_bloqueada($idformato,$iddoc){//A.A
	echo "<td><input type='text' name='fecha_riesgo' value='".date('Y-m-d')."' readonly='readonly'/></td>";
}
function adicionar_acciones_riesgo($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	if(@$_REQUEST['tipo']!=5){
    	$padre=busca_filtro_tabla("idft_riesgos_proceso, riesgo_antiguo","ft_riesgos_proceso a","documento_iddocumento=".$iddoc,"",$conn);

		echo '<a href="'.$ruta_db_superior.'formatos/acciones_riesgo/adicionar_acciones_riesgo.php?padre='.$padre[0]["idft_riesgos_proceso"].'&anterior='.$iddoc.'">Adicionar Acciones</a>';
	}	
		//<a href="'.$ruta_db_superior.'formatos/seguimiento_riesgo/adicionar_seguimiento_riesgo.php?padre='.$padre[0]["idft_riesgos_proceso"].'&anterior='.$iddoc.'">Adicionar seguimiento</a>
}

function selecion_tipo_riesgo(){
	global $conn;	
	
	
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("input[name='tipo_riesgo']").click(function(){						
			if($(this).val() == 'Corrupcion'){
				$("#probabilidad0").parent().parent().hide();
				$("#probabilidad1").parent().parent().hide();
				$("#probabilidad3").parent().parent().hide();
				$("#impacto3").parent().parent().parent().parent().parent().parent().parent().hide();
			}else{
				$("#probabilidad0").parent().parent().show();
				$("#probabilidad1").parent().parent().show();
				$("#probabilidad3").parent().parent().show();
				$("#impacto3").parent().parent().parent().parent().parent().parent().parent().show();
			}
		});		
		tree_area_responsable.setOnLoadingEnd(desactivar_carga_hijos);
	});
	
	function desactivar_carga_hijos(){
		tree_area_responsable.enableThreeStateCheckboxes(0);		
	}
</script> 
<?php	
}

function validar_revision_aprobacion($idformato,$iddoc){
	/*global $conn,$ruta_db_superior;
	echo(librerias_notificaciones());		
	
	$proceso = busca_filtro_tabla("a.fecha_aprobacion_riesgo,a.fecha_revision_riesgo,a.nombre","
ft_proceso a","a.documento_iddocumento=".$_REQUEST['anterior'],"",$conn);
	
	if($proceso[0]['fecha_aprobacion_riesgo'] && $proceso[0]['fecha_revision_riesgo']){	
?>
<script type="text/javascript">
$(document).ready(function(){
	notificacion_saia('Los riesgo del proceso <b><?php echo($proceso[0]['nombre']);?></b> est&aacute;n aprobados y revisados.<br /> no es posible adicionar mas riesgos','warning','',6500);
})
</script>
<?php	
	abrir_url($ruta_db_superior.'formatos/proceso/mostrar_proceso.php?iddoc='.$_REQUEST['anterior'].'&idformato=9','_self');
	}*/
}

function validar_edicion_adicion_formatos_riesgo_aprobados($idformato, $iddoc){
	global $conn;		
	
	if($_REQUEST["anterior"]){
		$iddocumento = $_REQUEST["anterior"];
	}elseif($_REQUEST["iddoc"]){
		$iddocumento = $_REQUEST["iddoc"];
	}else{
		$iddocumento = $iddoc;
	}
		
	$datos_documento = obtener_datos_documento($iddocumento);	
	
	switch (trim($datos_documento["plantilla"])) {
		case 'proceso':
			$proceso = busca_filtro_tabla("a.lider_proceso,a.responsable,a.nombre","ft_proceso a","a.fecha_aprobacion_riesgo is not null and a.documento_iddocumento=".$datos_documento["iddocumento"],"",$conn);
		break;
		case 'riesgos_proceso':
			$proceso = busca_filtro_tabla("a.lider_proceso,a.responsable,a.nombre","ft_proceso a, ft_riesgos_proceso b","a.idft_proceso=b.ft_proceso and a.fecha_aprobacion_riesgo is not null and b.documento_iddocumento=".$datos_documento["iddocumento"],"",$conn);
		break;				
		case 'control_riesgos':
			$proceso = busca_filtro_tabla("a.lider_proceso,a.responsable,a.nombre","ft_proceso a, ft_riesgos_proceso b, ft_control_riesgos c","a.idft_proceso=b.ft_proceso and b.idft_riesgos_proceso=c.ft_riesgos_proceso and a.fecha_aprobacion_riesgo is not null and c.documento_iddocumento=".$datos_documento["iddocumento"],"",$conn);
		break;
		case 'acciones_riesgo':
			$proceso = busca_filtro_tabla("a.lider_proceso,a.responsable,a.nombre","ft_proceso a, ft_riesgos_proceso b, ft_acciones_riesgo c","a.idft_proceso=b.ft_proceso and b.idft_riesgos_proceso=c.ft_riesgos_proceso and a.fecha_aprobacion_riesgo is not null and c.documento_iddocumento=".$datos_documento["iddocumento"],"",$conn);
		break;
	}

	$lider_proceso = retornar_seleccionados($proceso[0]["lider_proceso"]);
	$responsable = retornar_seleccionados($proceso[0]["responsable"]);	
	$responsables = array_merge($lider_proceso, $responsable);
	$responsables[] = 1449;	
	
	/*if($proceso["numcampos"]){
		if(!in_array(usuario_actual("funcionario_codigo"), $responsables)){			
			notificaciones("<b>El proceso ".$proceso[0]["nombre"]." esta aprobado<br /> por tal motivo el formato solo puede ser adicionado o editado por el responsable o l&iacuteder del proceso.</b>","warning","9500");
			volver("1");
		}		
	}*/
}


//ADICIONAR
function validar_from_riesgos($idformato,$iddoc){
    global $conn,$ruta_db_superior;
    print_r($_REQUEST);
    if(@$_REQUEST['from_riesgos']){
        echo( librerias_jquery('1.7') );
        
        ?>
            <script>
                $(document).ready(function(){
                    $('[name="from_riesgos"]').val(1);
                });
            </script>
        <?php 
        
    }
}
//POSTERIOR ADICIONAR
function redireccionar_from_riesgos($idformato, $iddoc){
    global $conn,$ruta_db_superior; 
    
    $datos=busca_filtro_tabla("from_riesgos","ft_riesgos_proceso","documento_iddocumento=".$iddoc,"",$conn);
    if($datos[0]['from_riesgos']){
        redirecciona($ruta_db_superior."formatos/riesgos_proceso/mostrar_riesgos_proceso.php?iddoc=".$iddoc);
    }
    
}
?>