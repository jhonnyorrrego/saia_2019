<?php
if(isset($_REQUEST["exportar"])&& $_REQUEST["exportar"])
{if($_REQUEST["exportar"]=="excel")
  {header('Content-Type: application/vnd.ms-excel');
	 header('Content-Disposition: attachment; filename=resultado_consulta.xls');
   header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
  }
 elseif($_REQUEST["exportar"]=="word")
  {header('Content-Type: application/vnd.ms-word');
   header("Content-Disposition: attachment; filename=resultado_consulta.doc");
   header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="funciones_buscador.js"></script>
<?php
include_once("db.php"); 
$campos_remitente=array();
if(!$_REQUEST["exportar"] )
  {include_once("header.php");
   $codigo_sql=parsear_datos_ingreso(); 
  }
else
  $codigo_sql=stripslashes($_REQUEST["sql"]." order by fecha desc");  
 
if(isset($_REQUEST["etiqueta_busqueda"])&&$_REQUEST["etiqueta_busqueda"])
  {$repetida=busca_filtro_tabla("","busqueda_usuario","lower(etiqueta) like '".strtolower($_REQUEST["etiqueta_busqueda"])."' and funcionario='".usuario_actual("funcionario_codigo")."'","",$conn);
  //print_r($repetida);
   if(!$repetida["numcampos"])
     {//echo "insertar_registro";
      phpmkr_query("insert into busqueda_usuario(etiqueta,funcionario) values('".$_REQUEST["etiqueta_busqueda"]."','".usuario_actual("funcionario_codigo")."')");
      $id=phpmkr_insert_id();
     }
   else
     {$id=$repetida[0]["idbusqueda_usuario"];
      phpmkr_query("delete from campo_busqueda_usuario where busqueda_usuario=$id");
     }
   if($id>0)
   {foreach($_REQUEST as $nombre=>$valor)
     {if(is_array($valor) && implode("@@",$valor)<>"")
        phpmkr_query("insert into campo_busqueda_usuario(busqueda_usuario,campo,valor) values('$id','$nombre','".implode("@@",$valor)."')");
      elseif($valor<>"" && $nombre<>"PHPSESSID" && $nombre<>"etiqueta_busqueda")
        phpmkr_query("insert into campo_busqueda_usuario(busqueda_usuario,campo,valor) values('$id','$nombre','$valor')");
     }
   }  
   //die("id:$id");
  }  
if(!$_REQUEST["exportar"])
{$radicador = new PERMISO();
 $permiso = false;
 $permiso=$radicador->acceso_modulo_perfil("lsalidas");
?>
<link rel="stylesheet" type="text/css" href="css/flexigrid.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/flexigrid.js"></script>    
<script type="text/javascript">
$(document).ready(function(){
	
	$("#flex1").flexigrid
			(
			{url: 'documento.busqueda_ajax.php',
			dataType: 'json',
			colModel : [
			<?php 
       if(@$_REQUEST["pagina_exp"])
         echo ",{display: 'Expediente', name :'', align: 'center', width : 50},";
       if(@$_REQUEST["vincular_documento"])
         echo "{display: 'Vincular', name :'', align: 'center', width : 50},";
       if($permiso) 
          echo "{display: 'Despacho', name :'', align: 'center', width : 50},";  
      ?> 	
        {display: 'Detalles', name : '', width : 50, align: 'center'},
				{display: 'Fecha', name : 'fecha', width :  120, sortable : true, align: 'center'},
				{display: 'N&uacute;mero', name : 'numero', width :  40, sortable : true, align: 'center'},
				{display: 'Remitente', name : 'remitente', width :  120, sortable : true, align: 'left'},
        {display: 'Descripci&oacute;n', name : 'descripcion', width :  200, sortable : true, align: 'left'},
				{display: 'Plantilla', name : 'plantilla', width :  80, sortable : false, align: 'center'},   
        {display: 'Serie', name : 'serie', width :  40, sortable : false},
        {display: 'Buz&oacute;n', name : '', width :  80, align: 'center'}	
				],                                                              
			searchitems : [
				{display: 'Numero', name : 'numero'},
				{display: 'Descripci&oacute;n', name : 'descripcion', isdefault: true}
				],
			<?php 
      if($permiso || @$_REQUEST["pagina_exp"] || @$_REQUEST["vincular_documento"]) 
        {echo "buttons : ["; 
         if(@$_REQUEST["pagina_exp"]) 
           echo "{name: 'Adicionar al expediente', onpress :almacenar_expediente},";
         if(@$_REQUEST["vincular_documento"]) 
           echo "{name: 'Vincular al Documento', onpress :vincular_documento},";     
         if($permiso)
           echo "{name: 'Despachar', onpress :despachar },";
         echo "{separator: true}],"; 
        }
      ?>	
			sortname: "fecha",
			sortorder: "desc",
			pagestat:"Registros {from} a {to} de {total}",
			procmsg: 'Procesando, por favor espere ...',
			nomsg: 'No se encontraron registros que coincidan',
			showToggleBtn: false,
			sql:"<?php echo $codigo_sql; ?>",
			<?php
      $adicionales=array(); 
      if(@$_REQUEST["pagina_exp"] || @$_REQUEST["vincular_documento"]){ 
        if(@$_REQUEST["pagina_exp"]){
          array_push($adicionales,'pagina_exp='.$_REQUEST["pagina_exp"]);
        }
        if(@$_REQUEST["vincular_documento"]){
          array_push($adicionales,'vincular_documento='.$_REQUEST["vincular_documento"]);
        }
        echo "adicionales:'".implode("& ",$adicionales)."',";
      } 
      ?>
			usepager: true,  
			title: 'Documentos',
			useRp: true,
			rp: 20,
			width: 940,
			height: 255
			}
			);   
	
});
</script>
</head>
<body> <br>
<?php if(!@$_REQUEST["pagina_exp"] && !@$_REQUEST["vincular_documento"]) {?>
<form name="resultados" id="resultados" action="" method="post">
<div style="position:absolute; top:15px; right:10px; width:100px;">
<a href="javascript:document.getElementById('exportar').value='excel'; document.getElementById('resultados').submit();"><img src="enlaces/excel.gif" border="0" alt="Exportar a Excel"></a>&nbsp;&nbsp;<a href="javascript:document.getElementById('exportar').value='word'; document.getElementById('resultados').submit();"><img src="enlaces/word.gif" border="0" alt="Exportar a Word"></a>
</div>
<input type="hidden" id="exportar" name="exportar" value="">
</form>
<?php
 }
else
{echo '<script>$("#header").hide();$("#ocultar").hide();</script>';
} 
?>
<input type="hidden" id="sql" name="sql" value="<?php echo $codigo_sql; ?>"> 
<?php 
} 
?>
<form name='datos' id='datos' method='post'>
<div id="espacio_datos">
<?php
if($_REQUEST["pagina_exp"])
 echo "<input type='hidden' name='expediente' id='idexpediente' value='".$_REQUEST['pagina_exp']."'>";
if(@$_REQUEST["vincular_documento"])
 echo "<input type='hidden' name='vincular_documento' id='iddocumento_origen' value='".$_REQUEST['vincular_documento']."'>";               
?>
</div>
<table><tr><td>
<b>BUSQUEDA DE DOCUMENTOS</b><br>
</td></tr><tr><td>

<?php                                       
if($_REQUEST["exportar"])
{$resultado=ejecuta_filtro_tabla($codigo_sql,$conn);
 echo "<table border=1 ><tr><td>FECHA</td>
        <td>NUMERO</td>
        <td>REMITENTE</td>
        <td>DESCRIPCION</td>
        <td>PLANTILLA</td>   
        <td>SERIE</td>
        <td>BUZON</td>
        </tr>";
 for($i=0;$i<$resultado["numcampos"];$i++) 
 {if($resultado[$i]["estado"]!='GESTION' && $resultado[$i]["estado"]!='CENTRAL' &&$resultado[$i]["estado"]!='HISTORICO'&& $resultado[$i]["estado"]!='ANULADO')                                
    $estado="Pendiente / Proceso";
  else
    $estado=$resultado[$i]["estado"];
$nombre_serie="No asignada";     
if($resultado[$i]["serie"]){
  $serie=busca_filtro_tabla("nombre","serie","idserie=".$resultado[$i]["serie"],"",$conn);
  if($serie["numcampos"])
    $nombre_serie=$serie[0]["nombre"];
}    
  echo '<tr><td>'.$resultado[$i]["fecha"].'</td>
        <td>'.$resultado[$i]["numero"].'</td>
        <td>'.$resultado[$i]["remitente"].'</td>
        <td>'.strip_tags(str_replace('<br />',' ',$resultado[$i]["descripcion"])).'</td>
        <td>'.$resultado[$i]["plantilla"].'</td>  
        <td>'.$nombre_serie.'</td>
        <td>'.$estado.'</td>
        </tr>';
 }
 echo "<script>document.getElementById('header').style.display='none';</script>";
}
else
 {echo "<table id='flex1'>";
 }
?>
</table>
</td></tr></table>
</form>
</body>
<?php
include_once("footer.php");

function parsear_datos_ingreso(){
$where_array=array("documento.estado<>'ELIMINADO'");
$wherebuzon=array();
$usuario=usuario_actual("funcionario_idfuncionario");
$cad='';
foreach($_REQUEST AS $llave=>$valor){
  
  switch ($llave){
    case 'x_anexo':
      $x=0;
      if($valor!=""){
        foreach($valor AS $key=>$val){
          if($x==0){
            if($cad!=''){
              $cad.=' OR ';
            }
            $cad.="(iddocumento IN (SELECT documento_iddocumento FROM anexos WHERE lower(etiqueta) LIKE '%".strtolower((($val)))."%'";
          }  
          else $cad.= " OR lower(etiqueta) LIKE '%".strtolower((($val)))."%'";  
          $x++;
        }
        $cad.='))';
        array_push($where_array,$cad);
      }     
    break;
    case 'x_etiqueta':
      if($valor!=""){
        array_push($where_array,'iddocumento IN(SELECT documento_iddocumento FROM documento_etiqueta WHERE etiqueta_idetiqueta IN('.implode(',',$valor).'))');
      }
    break;
   case 'x_asunto':
      $x=0;
      if($valor!=""){
        foreach($valor AS $key=>$val){
          if($x==0){
            if($cad!=''){
              $cad.=' OR ';
            }
            $cad.="( lower(descripcion) LIKE '%".strtolower((($val)))."%'";
          }
          else $cad.= " OR lower(descripcion) LIKE '%".strtolower((($val)))."%'";
          $x++;  
        }
        $cad.=')';
        array_push($where_array,$cad);
      }    
    break;    
    case 'x_fecha_borrador1':
      if($valor!="")
        array_push($where_array,fecha_db_obtener('documento.fecha_creacion','Y-m-d H:i:s').">'".$valor."'");
    break;  
    case 'x_fecha_borrador2':
      if($valor!="")
        array_push($where_array,fecha_db_obtener('documento.fecha_creacion','Y-m-d H:i:s')."<'".$valor."'");
    break;  
    case 'x_fecha_aprobacion1':
      if($valor!="")
        array_push($where_array,fecha_db_obtener('documento.fecha','Y-m-d H:i:s').">'".$valor."'");
    break;  
    case 'x_fecha_aprobacion2':
      if($valor!="")
        array_push($where_array,fecha_db_obtener('documento.fecha','Y-m-d H:i:s')."<'".$valor."'");
    break;     
    case 'x_ejecutor2'://cuando se trata de un documento de entrada
      //$cad='';
      $x=0;
      if(is_array($valor))
      {foreach($valor AS $key=>$val){
        if($x==0){
          if($cad!=''){
            $cad.=' OR ';
          }
          $cad.=" (lower(e.nombre)  LIKE '%".strtolower((($val)))."%'";
        }  
        else 
          $cad.= " OR lower(e.nombre) LIKE '%".strtolower((($val)))."%'";
        $x++;    
      }     
      $cad.=')'; 
      array_push($where_array,$cad); 
     }
    break;
    case 'x_serie':
      if($valor!=""){
        $array=explode(',',$valor);
        array_push($where_array,'serie IN('.implode(',',array_filter($array)).')');
      }
    break;
    case 'x_serie_total':
      if($valor!=""){
        $array=explode(',',$valor);
        array_push($where_array,'serie IN('.implode(',',array_filter($array)).')');
      }
    break;
    case 'pagina_exp':
      if($valor!=""){
        array_push($where_array,' iddocumento not in(select documento_iddocumento from expediente_doc where expediente_idexpediente='.$valor.' )');
      }
    break;
    case 'vincular_documento':
      if($valor!=""){
        array_push($where_array,' iddocumento <> '.$valor);
      }
    break;
    case 'x_ejecutor1'://cuando se trata de un documento interno
      if($valor!=""){
      $valor=preg_replace('/(.)(\,{2,})/','$1,', $valor);
      $valor=preg_replace('/(.)\,$/','$1', $valor);
      $array=explode(",",$valor);
      $nuevov=array();
      foreach($array as $fila)
        {if(!strpos($fila,"#"))
           $nuevov[]=$fila;
        }
      $valor=implode("','",$nuevov);  
      array_push($where_array,"ejecutor IN('".$valor."')");
      }
    break;
    case 'x_tipo_documento':
      if($valor==1)
        array_push($where_array," tipo_radicado='1' ");
      elseif($valor==3)
         array_push($where_array," tipo_radicado='2' and (plantilla is null or plantilla='') ");  
      elseif($valor==2)
         {if($_REQUEST["plantilla"]<>"")
            array_push($where_array," lower(plantilla)='".str_replace("ft_","",strtolower($_REQUEST["plantilla"]))."' ");
          else
            array_push($where_array," tipo_radicado>1 and (plantilla is not null and plantilla<>'') ");
         } 
    break;
    case 'x_numero':
      if($valor!="")
        array_push($where_array,'numero IN('.implode(",",$valor).')');  
    break;
    case 'x_oficio':
      if($valor!="")
        array_push($where_array,'oficio IN('.implode(",",$valor).')');  
    break;
    case 'x_municipio':
      if($valor!="")
        array_push($where_array,'municipio_idmunicipio='.$valor);  
    break;  
    //condiciones relacionas con las transferencias
    case 'x_fecha_transferencia1':
      if($valor!="")
        array_push($wherebuzon,fecha_db_obtener('b.fecha','Y-m-d H:i:s').">='".$valor."'");
    break;  
    case 'x_fecha_transferencia2':
      if($valor!="")
        array_push($wherebuzon,fecha_db_obtener('b.fecha','Y-m-d H:i:s')."<='".$valor."'");
    break;
    case 'x_busqueda_general':
      $usu=usuario_actual("funcionario_codigo");
      //Aqui valida el caso de las series totales si viene una serie total busca en todos los documentos con los demas criterios pero sin el criterio de que solo salgan mis documentos 
      if($valor=="0" && $_REQUEST["x_serie_total"]=="")
        array_push($wherebuzon,"(b.destino='$usu' or b.origen='$usu')");  
    break; 
    case 'x_transferido':
      $cadena='';   
      if($valor!=""){  
      $valor=preg_replace('/(.)(\,{2,})/','$1,', $valor);
      $valor=preg_replace('/(.)\,$/','$1', $valor);
      $array=explode(",",$valor);
      $nuevov=array();
      foreach($array as $fila)
        {if(!strpos($fila,"#"))
           $nuevov[]=$fila;
        }
      $valor=implode("','",$nuevov);    
      array_push($wherebuzon," (nombre='TRANSFERIDO' and b.destino in('$valor') )" );      
      }
    break; 
   case 'x_transferido2':
      $cadena='';   
      if($valor!=""){  
      $valor=preg_replace('/(.)(\,{2,})/','$1,', $valor);
      $valor=preg_replace('/(.)\,$/','$1', $valor);
      $array=explode(",",$valor);  
      $nuevov=array();
      foreach($array as $fila)
        {if(!strpos($fila,"#"))
           $nuevov[]=$fila;
        }
      $valor=implode("','",$nuevov);    
      array_push($wherebuzon," (nombre='TRANSFERIDO' and b.origen in('$valor') )" );      
      }
    break; 
   case 'x_aprobado':
      $cadena='';
      
      if($valor!=""){  
      $valor=preg_replace('/(.)(\,{2,})/','$1,', $valor);
      $valor=preg_replace('/(.)\,$/','$1', $valor);
      $array=explode(",",$valor);
      $nuevov=array();
      foreach($array as $fila)
        {if(!strpos($fila,"#"))
           $nuevov[]=$fila;
        }
      $valor=implode("','",$nuevov);
      array_push($wherebuzon," (b.origen in('$valor') and nombre in('APROBADO','REVISADO'))" );
      }
    break;  
  }
}
if($_REQUEST["x_tipo_documento"]==1 || $_REQUEST["x_tipo_documento"]==3){
  $cadenasql=("SELECT DISTINCT numero,iddocumento,descripcion,".fecha_db_obtener("documento.fecha","Y-m-d H:i:s")." as fecha,plantilla,estado,e.nombre as remitente, documento.serie FROM documento ,ejecutor e,datos_ejecutor d WHERE ejecutor=iddatos_ejecutor and ejecutor_idejecutor=idejecutor and (". implode(' AND ',$where_array)).') ';
}
else{
  $cadenasql=("SELECT DISTINCT numero,iddocumento,descripcion,".fecha_db_obtener("documento.fecha","Y-m-d H:i:s")." as fecha,plantilla,documento.estado,".concatenar_cadena_sql(array("f.nombres","' '","f.apellidos"))." as remitente, documento.serie FROM documento,funcionario f WHERE ejecutor=funcionario_codigo AND (". implode(' AND ',$where_array)).')';

}  
if(isset($_REQUEST["campos_formato"])&&($_REQUEST["campos_formato"]<>"")) {
  $cadenasql.=" AND iddocumento in ".stripslashes($_REQUEST["campos_formato"]);
}
if(trim(implode("",$wherebuzon))<>"") {
  $cadenasql.=" AND iddocumento in( select distinct archivo_idarchivo from buzon_salida b where ".implode(" and ",$wherebuzon).") ";   
}
return($cadenasql);
}
?>
