<?php
@session_start();
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."define.php");
if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
  @session_start();
  $_SESSION["LOGIN".LLAVE_SAIA]=LOGIN_LOGIN;
  $_SESSION["usuario_actual"]=FUNCIONARIO_CODIGO_LOGIN;
  $_SESSION["conexion_remota"]=1; 
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior.'pantallas/lib/librerias_cripto.php');
include_once($ruta_db_superior.'formatos/librerias/funciones_generales.php'); 
include_once($ruta_db_superior.'librerias_saia.php'); 

function generar_html_info_qr($datos){
	global $conn,$ruta_db_superior;
	
	$datos = json_decode($datos,true);
	$retorno=array();
	$retorno['exito']=0;	
	$retorno['html']='Contacte al administrador';	
	
	$_REQUEST['key_cripto']=$datos;
	$datos_decrypt=request_encriptado('key_cripto');
	$iddoc=intval($datos_decrypt['id']);

	if( !is_numeric($iddoc) ){
		return(json_encode($retorno));	
		die();
	}
	
	$documento=busca_filtro_tabla("","documento A","A.iddocumento=".$iddoc,"",$conn);
	$formato=busca_filtro_tabla("","formato A","A.nombre='".strtolower($documento[0]["plantilla"])."'","",$conn);

	$datos_fecha=date_parse($documento[0]["fecha"]);
	
	$firmas=busca_filtro_tabla("CONCAT(B.nombres,CONCAT(' ',B.apellidos)) AS nombre","buzon_salida A, funcionario B","A.origen=B.funcionario_codigo AND (A.nombre LIKE 'APROBADO' OR A.nombre LIKE 'REVISADO')AND A.archivo_idarchivo=".$iddoc,"", $conn);
	$nombres=array();
	for($i=0; $i<$firmas['numcampos']; $i++){
		$nombres[]=utf8_encode(html_entity_decode($firmas[$i]['nombre']));    
	}
	
	$elaboro=busca_filtro_tabla("","funcionario A","A.funcionario_codigo=".$documento[0]["ejecutor"],"",$conn);
	
	$respuestas=array();
	$respondidos=busca_filtro_tabla("","respuesta A, documento B","A.origen=".$documento[0]["iddocumento"]." AND A.destino=B.iddocumento","",$conn);
	for($i=0; $i<$respondidos['numcampos']; $i++){
		$respuestas[]=" Respuesta con <b>Radicado No</b> ".$respondidos[$i]["numero"].", <b>Asunto:</b> ".$respondidos[$i]["descripcion"];    
	}
	if(!$respondidos["numcampos"])$respuestas[]="Sin respuestas realizadas";
	
	$tipo_documento=busca_filtro_tabla("","serie A","A.idserie=".$documento[0]["serie"],"",$conn);
	if(!$tipo_documento["numcampos"])$tipo_documento[0]["nombre"]="Sin serie asignada";
	
	$tabla="";
	$tabla.="<table class='table' style='font-family:arial;width:100%;border-collapse:collapse' >";
	$tabla.="<tr>";
	$tabla.="<td class='encabezado_list' colspan='2' style='text-align:center;'><b>Informaci&oacute;n del documento</b></td>";
	$tabla.="</tr>";
	$tabla.="<tr>";
	$tabla.="<td style=''><b>Radicado No:</b> </td><td style=''>".$documento[0]["numero"]."</td>";
	$tabla.="</tr>";
	$tabla.="<tr>";
	$tabla.="<td><b>Asunto:</b> </td><td>".$documento[0]["descripcion"]."</td>";
	$tabla.="</tr>";
	$tabla.="<tr>";
	$tabla.="<td><b>Fecha:</b> </td><td>".$datos_fecha["day"]." ".mes($datos_fecha["month"])." del ".$datos_fecha["year"]."</td>";
	$tabla.="</tr>";
	$tabla.="<tr>";
	$tabla.="<td><b>Tipo de documento:</b> </td><td>".$tipo_documento[0]["nombre"]."</td>";
	$tabla.="</tr>";
	$tabla.="<tr>";
	$tabla.="<td><b>Personas que firman:</b> </td>";
	$tabla.="<td>".implode("<br />",$nombres)."</td>";
	$tabla.="</tr>";
	$tabla.="<tr>";
	$tabla.="<td><b>Respuestas al documento:</b> </td><td>".implode("<br />",$respuestas)."</td>";
	$tabla.="</tr>";
	$tabla.="<tr>";
	$tabla.="<td><b>Elabor&oacute;:</b> </td><td>".ucwords(strtolower($elaboro[0]["nombres"]." ".$elaboro[0]["apellidos"]))."</td>";
	$tabla.="</tr>";
	$tabla.="</table>";
	if($documento[0]["plantilla"]=='DESPACHO_INGRESADOS'){
		$documento=busca_filtro_tabla("","ft_despacho_ingresados","documento_iddocumento=".$iddoc,"",$conn);
		$documentos=explode(",",$documento[0]['docs_seleccionados']);
		$docs=array_filter($documentos);
		$registros=busca_filtro_tabla("","documento A"," A.iddocumento in(".implode(",",$docs).")","",$conn);
		$tabla.="<table class='table' style='font-family:arial;width:100%;border-collapse:collapse' border='1px'>";
		$tabla.='<tr style="height:70px">';
		$tabla.='<td style="text-align:center"><b>N° RADICADO</b></td>';
		$tabla.='<td style="text-align:center"><b>FECHA DE RECIBO(DD/MM/AAAA)</b></td>';
		$tabla.='<td style="text-align:center"><b>FOLIOS</b></td>';
		$tabla.='<td style="text-align:center"><b>REMITENTE</b></td>';
		$tabla.='<td style="text-align:center"><b>ASUNTO</b></td>';
		
		$tabla.='<td style="text-align:center"><b>ASIGNADA A (NOMBRE Y FIRMA)</b></td>';
		$tabla.='<td style="text-align:center"><b>FECHA DE ASIGNACIÓN</b></td>';
		
		$tabla.='<td style="text-align:center"><b>FIRMA DE QUIEN RECIBE</b></td>';	
		$tabla.='<td style="text-align:center"><b>FECHA DE RESPUESTA</b></td>';
		$tabla.='</tr>';
		
		for($i=0;$i<$registros["numcampos"];$i++){
			if($registros[$i]['plantilla']=='RADICACION_ENTRADA'){
				$documentos=busca_filtro_tabla("r.*,numero,iddocumento,fecha,paginas","ft_radicacion_entrada r,documento A","documento_iddocumento=iddocumento and A.iddocumento=".$registros[$i]['iddocumento'],"",$conn);
				$datos_remitente=busca_filtro_tabla("B.nombre,A.*","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$documentos[0]['persona_natural'],"",$conn);
				$datos_destino=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$documentos[0]['destino'],"",$conn);
			}else{
				$formato=strtolower($registros[$i]['plantilla']);
				$documentos=busca_filtro_tabla("r.*,numero,iddocumento,A.fecha,paginas,descripcion","ft_".$formato." r,documento A","documento_iddocumento=iddocumento and A.iddocumento=".$registros[$i]['iddocumento'],"",$conn);
				$datos_remitente=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$documentos[0]['dependencia'],"",$conn);
			}
			
			$buzon_salida=busca_filtro_tabla("","buzon_salida A","nombre='TRANSFERIDO' and A.archivo_idarchivo=".$documentos[0]["iddocumento"],"fecha asc",$conn);
			$fecha_respuesta=busca_filtro_tabla("","respuesta, documento","estado='APROBADO' and destino=iddocumento and origen=".$documentos[0]["iddocumento"],"",$conn);
	
			if($fecha_respuesta['numcampos']>0){
				$fecha=date('d-m-Y', strtotime($fecha_respuesta[0]['fecha']));
			}else{
				$fecha='';
			}
			$tabla.='<tr>';
			$tabla.='<td style="text-align:center">'.$documentos[0]["numero"].'</td>';
			$tabla.='<td style="text-align:center;">'.date('d-m-Y', strtotime($documentos[0]["fecha"])).'</td>';
			
			if($registros[$i]['plantilla']=='RADICACION_ENTRADA'){
				$tabla.='<td style="text-align:center;">'.$documentos[0]["numero_folios"].'</td>';
				$tabla.='<td style="text-align:left;">'.$datos_remitente[0]["nombre"].'</td>';
				$tabla.='<td style="text-align:left;">'.$documentos[0]["descripcion"].'</td>';
				$tabla.='<td style="text-align:center;">'.$datos_destino[0]['nombres']." ".$datos_destino[0]['apellidos'].'</td>';
			}else{
				$tabla.='<td style="text-align:center;">'.$documentos[0]["paginas"].'</td>';
				if($registros[$i]['plantilla']=='PQRSF'){
					$tabla.='<td style="text-align:left;">'.$documentos[0]["nombre"].'</td>';
				}else{
					$tabla.='<td style="text-align:center;">'.$datos_remitente[0]['nombres']." ".$datos_remitente[0]['apellidos'].'</td>';
				}
				$tabla.='<td style="text-align:left;">'.$documentos[0]["descripcion"].'</td>';
				if($registros[$i]['plantilla']=='CORREO_SAIA'){
					$tabla.='<td style="text-align:left;">'.$documentos[0]['para'].'</td>';
				}else{
					$tabla.='<td style="text-align:center;"></td>';
				}			
			}
			
			if($buzon_salida['numcampos']==0){
				$tabla.='<td style="text-align:center;"></td>';
			}else{
				$tabla.='<td style="text-align:center;">'.date('d-m-Y', strtotime($buzon_salida[0]['fecha'])).'</td>';
			}
			$tabla.='<td style="text-align:left;"></td>';
			$tabla.='<td style="text-align:center;">'.$fecha.'</td>';
			$tabla.='</tr>';
		}
		$tabla.='</table>';
	}

	$retorno['html']=estilo_bootstrap();
	$retorno['html'].=$tabla;
	$retorno['html'].=rastro_documento_info($iddoc);
	$retorno['html'].=mostrar_despacho_radicacion_info($iddoc);
	$retorno['exito']=1;
	return(json_encode($retorno));	
	
	
} //fin if generar_html_info_qr


function rastro_documento_info($x_doc,$filtro){
	global $conn;
 
 $html_retorno='';
 $condicion_radicador_salida='';

 $titulo="SEGUIMIENTO TOTAL DEL DOCUMENTO";
 if($filtro)$titulo="SEGUIMIENTO PERSONAL DEL DOCUMENTO";
 $cantidad_maxima_rastro=busca_filtro_tabla("","configuracion a","nombre='cantidad_maxima_rastro' and tipo='rastro'","",$conn);

 $cantidad=busca_filtro_tabla("count(*) as cant","buzon_salida","archivo_idarchivo=$x_doc and nombre not in ('LEIDO','ELIMINA_LEIDO','ELIMINA_APROBADO','ELIMINA_REVISADO','ELIMINA_TERMINADO','ELIMINA_TRANSFERIDO')","",$conn);
 if($cantidad[0]["cant"]>$cantidad_maxima_rastro[0]["valor"] && !$filtro){
 	$start=0;
	$limit=$cantidad_maxima_rastro[0]["valor"];
 	$recorrido = busca_filtro_tabla_limit("buzon_salida.*,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha_format","buzon_salida","archivo_idarchivo=$x_doc and nombre not in ('LEIDO','ELIMINA_LEIDO','ELIMINA_APROBADO','ELIMINA_REVISADO','ELIMINA_TERMINADO','ELIMINA_TRANSFERIDO')","order by idtransferencia desc",$start,($limit-1),$conn);
 }
 else if($filtro){
 	$recorrido = busca_filtro_tabla("buzon_salida.*,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha_format","buzon_salida","archivo_idarchivo=$x_doc and nombre not in ('LEIDO','ELIMINA_LEIDO','ELIMINA_APROBADO','ELIMINA_REVISADO','ELIMINA_TERMINADO','ELIMINA_TRANSFERIDO') AND destino='".usuario_actual('funcionario_codigo')."'","idtransferencia DESC",$conn);
 }
 else{
 	$recorrido = busca_filtro_tabla("buzon_salida.*,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha_format","buzon_salida","archivo_idarchivo=$x_doc and nombre not in ('LEIDO','ELIMINA_LEIDO','ELIMINA_APROBADO','ELIMINA_REVISADO','ELIMINA_TERMINADO','ELIMINA_TRANSFERIDO')","idtransferencia DESC",$conn);
 }
 $documento=busca_filtro_tabla("plantilla","documento","iddocumento=$x_doc","",$conn);
 if($recorrido["numcampos"]>0)
 {
 	$id_tabla="tabla_rastro";
 	if($filtro)$id_tabla="tabla_rastro_propio";
 	
 	$html_retorno.='
	<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" id="'.$id_tabla.'" name="'.$id_tabla.'" style="width:100%">
	   <tr class="encabezado_list">
		  <td colspan="6"><span class="phpmaker" style="color:#ffffff">'.$titulo.'</span>
		 </tr>
	   <tr class="encabezado_list">
	  	<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Origen</span></td>
	  	<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Acci&oacute;n</span></td>
	  	<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Destino</span></td>
	  	<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Fecha</span></td>
	  	<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Observaciones</span></td>
	   </tr> 	
 	
 	';
      for($i=0;$i<$recorrido["numcampos"];$i++)
      {
      	$sItemRowClass = " bgcolor=\"#FFFFFF\"";
      	if ($i % 2 <> 0)  // Display alternate color for rows
      		$sItemRowClass = " bgcolor=\"#F5F5F5\"";
        if($recorrido[$i]["nombre"]!='BORRADOR')
          $leidos=recorrido($x_doc,$recorrido[$i]["origen"],$recorrido[$i]["fecha_format"],"leido");
        $html_retorno.=('<tr'.$sItemRowClass.'><td><span class="phpmaker" ><a href="#" '.$leidos.'>'.utf8_encode(busca_entidad_ruta(1,$recorrido[$i]["origen"]))."</a></span></td>");

				$accion=str_replace("COPIA","Transferido con copia a",str_replace('TRANSFERIDO','Transferido a Destino Responsable',$recorrido[$i]["nombre"]));
        $html_retorno.=('<td><span class="phpmaker" >'.$accion."</span></td>");

        $sig="";
        //if($recorrido[$i]["nombre"]!='BORRADOR')
          $sig=recorrido($x_doc,$recorrido[$i]["destino"],$recorrido[$i]["fecha_format"],"siguiente");
        $leido = mostrar_leido($x_doc,$recorrido[$i]["destino"],$recorrido[$i]["fecha_format"]);
        if($recorrido[$i]["nombre"]=="DISTRIBUCION" && strpos($recorrido[$i]["notas"],"enviado por e-mail")===false)
          {if($documento[0]["plantilla"]=="")
             $html_retorno.=('<td><span class="phpmaker" ><a href="#" '.$sig.'>'.utf8_encode(busca_entidad_ruta(2,$recorrido[$i]["destino"])).'</a></span></td>');
           elseif($documento[0]["plantilla"]=="CARTA")
             {$destinos=busca_filtro_tabla("destinos","ft_carta","documento_iddocumento=$x_doc","",$conn);
              $codigos=explode(",",$destinos[0]["destinos"]);
              $html_retorno.=('<td><span class="phpmaker" >');
              foreach($codigos as $filacod)
                $html_retorno.= utf8_encode(busca_entidad_ruta(2,$filacod))."<br />";
              $html_retorno.= ('</span></td>');
             }
           else
             {$html_retorno.=('<td><span class="phpmaker" >');
              $html_retorno.= utf8_encode(busca_entidad_ruta(1,$recorrido[$i]["destino"]))."<br />";
              $html_retorno.= ('</span></td>');
             }
          }
        else
          $html_retorno.=('<td><span class="phpmaker" >'.$leido.'<a href="#" '.$sig.'>'.utf8_encode(busca_entidad_ruta(1,$recorrido[$i]["destino"])).'</a></span></td>');

        $html_retorno.=('<td><span class="phpmaker" >'.$recorrido[$i]["fecha_format"]."</span></td>");
        if($_SESSION["usuario_actual"]==$recorrido[$i]["origen"] || $_SESSION["usuario_actual"]==$recorrido[$i]["destino"] || $recorrido[$i]["ver_notas"]==1){
            if($recorrido[$i]["nombre"]=="COPIA" && $recorrido[$i]["ver_notas"]==0){
                $recorrido[$i]["notas"]='';
            }
             $html_retorno.=('<td><span class="phpmaker" >'.$recorrido[$i]["notas"]."</span></td>");
        }else{
             $html_retorno.=('<td><span class="phpmaker" >&nbsp;</span></td>');
        }
      }
	if($cantidad[0]["cant"]>$cantidad_maxima_rastro[0]["valor"] && !$filtro){
		$html_retorno.= ('<tr '.$sItemRowClass.' id="fila_mostrar_mas"><td id="mostrar_mas" onclick="mostrar_mas_rastro();" colspan="6" style="cursor:pointer" inicio="'.$cantidad_maxima_rastro[0]["valor"].'"><button class="btn dropdown-toggle btn-mini" data-toggle="dropdown">Ver mas...</button></td></tr>');
	}
	$html_retorno.= "</table>";
 }
elseif($datos[0]["tipo_radicado"]==2 && ($datos[0]["plantilla"]=='' || $datos[0]["plantilla"]== "null"))
 $html_retorno.= "<b>El documento fue realizado por radicaci&oacute;n de salida, por lo tanto no tiene rastro.</b>";
 
 
return($html_retorno); 
}

function recorrido($x_doc,$fun,$fecha,$tipo)
{
 global $conn;
 $texto = "";
 switch($tipo)
 {
  case "siguiente":
   $buzon_sig = busca_filtro_tabla("origen,destino,nombre,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","buzon_salida","archivo_idarchivo=$x_doc and origen=".$fun." and ".fecha_db_obtener("fecha","Y-m-d H:i:s")." >='$fecha' ","fecha DESC",$conn);

   if($buzon_sig["numcampos"]>0)
   {
    $texto .= "<table border=1>";
    for($j=0; $j<$buzon_sig["numcampos"]; $j++)
    {if($buzon_sig[$j]["nombre"]=='BORRADOR')
       $buzon_sig[$j]["nombre"]='LEIDO' ;
     if($buzon_sig[$j]["nombre"]=='LEIDO')
      $texto.= "<tr><td colspan = 4>".$buzon_sig[$j]["nombre"]." ".$buzon_sig[$j]["fecha"]."</td></tr>";
     else
      $texto.= "<tr><td>".$buzon_sig[$j]["nombre"]." </td><td> ".utf8_encode(busca_entidad_ruta(1,$buzon_sig[$j]["destino"]))." ".$buzon_sig[$j]["fecha"]."</td></tr>";
    }
    $texto .= "</table>";
   }
  break;
  case "leido":
   /*$transferencias = busca_filtro_tabla("destino,nombre,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","buzon_salida","archivo_idarchivo=$x_doc and origen=".$fun." and nombre not in('LEIDO','BORRADOR')","",$conn);
   if($transferencias["numcampos"]>0)
   { $texto .= "<table border=1><tr><td align=center>Destino</td><td align=center>Fecha de leido</td></tr>";
     for($i=0; $i<$transferencias["numcampos"]; $i++)
     { $buzon_sig = busca_filtro_tabla("destino,nombre,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","buzon_salida","archivo_idarchivo=$x_doc and nombre='LEIDO' AND origen=".$transferencias[$i]["destino"]." and ".fecha_db_obtener("fecha","Y-m-d H:i:s")." > '".$transferencias[$i]["fecha"]."'","",$conn);
       if($buzon_sig["numcampos"]>0)
         $texto .= "<tr><td> ".utf8_encode(busca_entidad_ruta(1,$buzon_sig[0]["destino"]))."</td><td>&nbsp;".$buzon_sig[0]["fecha"]."</tr>";
       else
         $texto .= "<tr><td>".utf8_encode(busca_entidad_ruta(1,$transferencias[$i]["destino"]))."</td><td>No se ha leido</tr>";
     }
   } */
  break;
 }
 if($texto!="")
 {
   $texto = 'onmouseout="hideTooltip()" onMouseOver=\'showTooltip(event,"'.$texto.'");return false\'';
 }
 return($texto);
}

function mostrar_leido($x_doc,$fun,$fecha)
{
 global $conn;
 $leido = busca_filtro_tabla("idtransferencia","buzon_salida","archivo_idarchivo=$x_doc and origen=$fun and (nombre='LEIDO' or nombre='BORRADOR') and ".fecha_db_obtener("fecha","Y-m-d H:i:s")." >= '$fecha'","",$conn);
 if($leido["numcampos"]>0)
  $texto.= "<img src='saia/images/leido.png' border='0'>";
 else
  $texto.= "<img src='saia/images/no_leido.png' border='0'>";
 return $texto;
}
function busca_entidad_ruta($tipo,$llave)
{
  global $conn;
  switch($tipo){
    case 1:// Funcionario
      $dato=busca_filtro_tabla("A.nombres, A.apellidos","funcionario A","A.funcionario_codigo='".$llave."'","",$conn);
      if($dato["numcampos"])
        return($dato[0]["nombres"]." ".$dato[0]["apellidos"]);
      else return("Funcionario no encontrado");
      break;
		case 5:
    $dato=busca_filtro_tabla("A.nombres, A.apellidos","funcionario A,dependencia_cargo","A.idfuncionario=funcionario_idfuncionario and iddependencia_cargo='".$llave."'","",$conn);

    if($dato["numcampos"])
      return($dato[0]["nombres"]." ".$dato[0]["apellidos"]);
    else return("Funcionario no encontrado");
  	break;
    case 2:// Ejecutor
      $dato=busca_filtro_tabla("b.nombre","datos_ejecutor A,ejecutor b","idejecutor=ejecutor_idejecutor and iddatos_ejecutor='".$llave."'","",$conn);
      //print_r($dato);
      if($dato["numcampos"])
        return(ucwords($dato[0]["nombre"]));
      else return("Destinatario no encontrado");
      break;
  }
}


function mostrar_despacho_radicacion_info($iddoc){
	global $conn,$ruta_db_superior;
	$html='<br><br><table class="table" style="width:100%;">';
	$iddoc=$iddoc;
	$formato_radicacion=busca_filtro_tabla("b.nombre","documento a, formato b","lower(a.plantilla)=b.nombre AND a.iddocumento=".$iddoc,"",$conn);
	if($formato_radicacion[0]['nombre']=='radicacion_entrada'){
		$html.='<tr><th class="encabezado_list" style="text-align:center;" colspan="5">Despacho de Correspondencia</th></tr>';
		$html.='
			<tr>
				<th class="encabezado_list" style="text-align:center;">Numero Planilla</th>
				<th class="encabezado_list" style="text-align:center;">Fecha de Creaci&oacute;n</th>
				<th class="encabezado_list" style="text-align:center;">Mensajero</th>
				<th class="encabezado_list" style="text-align:center;">Recorrido</th>
				<th class="encabezado_list" style="text-align:center;">Novedad</th>
			</tr>';		
		$datos_radicacion=busca_filtro_tabla("idft_radicacion_entrada","documento a, ft_radicacion_entrada b","a.iddocumento=b.documento_iddocumento AND b.documento_iddocumento=".$iddoc,"",$conn);
		$destino_radicacion=busca_filtro_tabla("idft_destino_radicacion","ft_destino_radicacion","ft_radicacion_entrada=".$datos_radicacion[0]['idft_radicacion_entrada'],"",$conn);
		for($i=0;$i<$destino_radicacion['numcampos'];$i++){
			$idft_destino_radicacion=$destino_radicacion[$i]['idft_destino_radicacion'];
			$planillas=busca_filtro_tabla("c.numero,c.iddocumento,c.descripcion,b.mensajero,b.idft_despacho_ingresados","ft_item_despacho_ingres a,ft_despacho_ingresados b, documento c","a.ft_despacho_ingresados=b.idft_despacho_ingresados AND b.documento_iddocumento=c.iddocumento AND c.estado NOT IN('ELIMINADO','ANULADO') AND a.ft_destino_radicacio=".$idft_destino_radicacion,"",$conn);
        	if($planillas['numcampos']){
            	for($j=0;$j<$planillas['numcampos'];$j++){
            		$funcionario=busca_filtro_tabla("nombres,apellidos","vfuncionario_dc","iddependencia_cargo=".$planillas[$j]['mensajero'],"",$conn);
            		$idformato_despacho_ingresados=busca_filtro_tabla("","documento a, formato b","lower(a.plantilla)=b.nombre AND a.iddocumento=".$planillas[$j]['iddocumento'],"",$conn);
            		$tiene_novedades=busca_filtro_tabla("novedad","ft_novedad_despacho","ft_despacho_ingresados=".$planillas[$j]['idft_despacho_ingresados']." GROUP BY novedad","",$conn);
					$cadena_novedad='Sin Novedad';
            		if($tiene_novedades['numcampos']){
            			$vector_novedades=extrae_campo($tiene_novedades,'novedad');
            			$vector_novedades=array_map('strtolower', $vector_novedades);
            			$vector_novedades=array_map('ucwords', $vector_novedades);
						$cadena_novedad='';
						for($x=0;$x<count($vector_novedades);$x++){
							$cadena_novedad.='- '.codifica_encabezado(html_entity_decode($vector_novedades[$x])).'<br>';
						}
            		}
            		
                	$html.='
                		<tr>
                			<td><div class="link kenlace_saia" enlace="ordenar.php?key='.$planillas[$j]['iddocumento'].'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado '.$planillas[$j]['numero'].'"><center><span class="badge">'.$planillas[$j]['numero'].'</span></center></div>
                			</td>                		
                			<td>'.codifica_encabezado(html_entity_decode($planillas[$j]['descripcion'])).'</td>
                			<td>'.codifica_encabezado(html_entity_decode($funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'])).'</td>
                			<td>'.mostrar_valor_campo('tipo_recorrido',$idformato_despacho_ingresados[0]['idformato'],$planillas[$j]['iddocumento'],1).'</td>
                			<td>'.$cadena_novedad.'</td>
                		</tr>';
            	} //fin for planillas
        	} //fin if planillas numcampos			
		} //fin for $destino_radicacion		
	} //fin if formato=='radicacion_entrada'
	$html.='</table>';
	return($html);
} //fin function

?>