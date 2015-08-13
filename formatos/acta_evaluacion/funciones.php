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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."class_transferencia.php");

?>

<?php


function numero_documento($idformato,$iddoc){
  global $conn;
$consulta=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
echo($consulta[0]["numero"]);?>
<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-full.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
hs.outlineType = 'rounded-white';
</script>
<?php
}


function ano_actual($idformato,$iddoc){
 global $conn;
$fecha=date("Y");
echo($fecha);
}

function tabla_participantes($idformato,$iddoc){
  global $conn;
 
$consulta=busca_filtro_tabla("","ft_acta_evaluacion","documento_iddocumento=".$iddoc,"",$conn);

$tecnico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consulta[0]["evaluador_tecnico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
$economico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consulta[0]["evaluador_economico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
$juridico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consulta[0]["evaluador_juridico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);

$tabla='<table style="border-collapse:collapse" width="100%">
<tbody>
<tr>
<td style="text-align: center; border: #000000 1px solid;"><strong>NOMBRE</strong></td>
<td style="text-align: center; border: #000000 1px solid;"><strong>EVALUADOR</strong></td>
</tr>
<tr>
<td style="text-align: center; border: #000000 1px solid;">'.$tecnico[0]["nombres"].' '.$tecnico[0]["apellidos"].'</td>
<td style="text-align: center; border: #000000 1px solid;">T&eacute;cnico</td>
</tr>
<tr>
<td style="text-align: center; border: #000000 1px solid;">'.$economico[0]["nombres"].' '.$economico[0]["apellidos"].'</td>
<td style="text-align: center; border: #000000 1px solid;">Econ&oacute;mico</td>
</tr>
<tr>
<td style="text-align: center; border: #000000 1px solid;">'.$juridico[0]["nombres"].' '.$juridico[0]["apellidos"].'</td>
<td style="text-align: center; border: #000000 1px solid;">Jur&iacute;dico</td>
</tr>
</tbody>
</table>'; 
echo($tabla); 
} 


function tabla_objeto_contratacion($idformato,$iddoc){
  global $conn;
$consulta=busca_filtro_tabla("","ft_acta_evaluacion","documento_iddocumento=".$iddoc,"",$conn);  
$tabla='<table style="border-collapse:collapse" width="100%">
<tbody>
<tr>
<td style="text-align: left; border: #000000 1px solid;"><b>Objeto Contrataci&oacute;n</b></td>
<td style="text-align: center; border: #000000 1px solid;" width="80%">'.mostrar_valor_campo('objeto_contratacion',82,$iddoc,1).'</td>
</tr>
</tbody>
</table>'; 
echo($tabla);
  }
?>
<script type="text/javascript" src="../../js/jquery.js"> </script>
<?php  
function llenar_empresas($idformato,$iddoc){

  global $conn;
  
  $consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=b.iddocumento and b.estado<>'ELIMINADO' and b.iddocumento=".$iddoc,"",$conn);
if($_REQUEST["tipo"]!=5){
	if($consulta[0]["estado"]=='ACTIVO' && $consulta[0]["ejecutor"]==usuario_actual("funcionario_codigo")){
	?>
	<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-full.js"></script>
	<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
	<script type='text/javascript'>
	hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
	hs.outlineType = 'rounded-white';
	</script>
	<?php
	$tabla1.="<a  href='../empresas/adicionar_empresas.php?pantalla=padre&idpadre=".$iddoc."&idformato=85&padre=".$consulta[0]["idft_acta_evaluacion"]."' style='text-decoration: underline; cursor:pointer;'>
	<img width='16px' style='border:0px' src='../../botones/formatos/adicionar.gif' />Adicionar empresas invitadas</a>";
	echo($tabla1);
	}
}
$cuentas=busca_filtro_tabla("","ft_empresas","ft_acta_evaluacion=".$consulta[0]["idft_acta_evaluacion"],"",$conn);
if($cuentas["numcampos"]){
?>

<?php
$tabla.="<table border='1' width='100%' style='border-collapse:collapse'>
         <tr class='encabezado_list'><td style='text-align: center; border: #000000 1px solid;'>No</td><td style='text-align: center; border: #000000 1px solid;'>Empresa</td><td style='text-align: center; border: #000000 1px solid;'>Entrega cotizacion</td>";
if($consulta[0]["estado"]=='ACTIVO'){         
$tabla.="<td style='text-align: center; border: #000000 1px solid;'>Acciones</td></tr>";
}else{
$tabla.="</tr>";
}
for($i=0;$i<$cuentas["numcampos"];$i++){
  if($consulta[0]["estado"]=='ACTIVO'){
    $acciones="<a href='../empresas/mostrar_empresas.php?idformato=85&iddoc=".$cuentas[$i]["idft_empresas"]."' ><img style='border:0px' src='../../botones/comentarios/ver_documentos.png' /></a>
    <a href='../empresas/editar_empresas.php?idformato=85&item=".$cuentas[$i]["idft_empresas"]."&iddoc=".$cuentas[$i]["idft_empresas"]."' style='text-decoration: underline; cursor:pointer;'>
    <img style='border:0px' src='../../botones/comentarios/editar_documento.png' /></a>
    
    <a onclick=\"if(confirm('En realidad desea borrar este elemento?'))window.location='../librerias/funciones_item.php?formato=85&idpadre=".$iddoc."&accion=eliminar_item&tabla=ft_empresas&id=".$cuentas[$i]["idft_empresas"]."';\" style='cursor:pointer'>
    <img border=0 src='../../images/eliminar_pagina.png'/></a>";
  }else{
    $acciones="";
  }
    $ejecutor=busca_filtro_tabla("","datos_ejecutor a, ejecutor b","a.ejecutor_idejecutor=b.idejecutor and a.iddatos_ejecutor=".$cuentas[$i]["empresa"],"",$conn);
    $tabla.="<tr><td style='text-align: center; border: #000000 1px solid;'>".($i+1)."</td><td style='text-align: center; border: #000000 1px solid;'>".$ejecutor[0]["nombre"]."</td><td style='text-align: center; border: #000000 1px solid;'>".$cuentas[$i]["entrega_cotizacion"]."</td>";
if($consulta[0]["estado"]=='ACTIVO'){         
$tabla.="<td style='text-align: center; border: #000000 1px solid;'>".$acciones."</td></tr>";
}else{
$tabla.="</tr>";
}    
}
$tabla.="</table>";  
echo($tabla);
}
}  

function llenar_aspectos_tecnicos($idformato,$iddoc){
  global $conn;
  ?>
  <script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-full.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
hs.outlineType = 'rounded-white';
</script>
  <?php
  if($_REQUEST["tipo"]!=5){
  $consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento  and b.estado='APROBADO'","",$conn);
  $tecnico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consulta[0]["evaluador_tecnico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
  $economico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consulta[0]["evaluador_economico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
  //devolucion
  $maximo=busca_filtro_tabla("Max(idtransferencia)","buzon_entrada","archivo_idarchivo=".$iddoc,"",$conn);
  $penultimo=$maximo[0][0]-1;
  $devolver=busca_filtro_tabla("","buzon_entrada","origen=".usuario_actual("funcionario_codigo")." and destino=".$economico[0]["funcionario_codigo"]." and nombre='DEVOLUCION' and archivo_idarchivo=".$iddoc." and idtransferencia=".$penultimo,"",$conn);
  
  
  //
  
  if((($consulta[0]["aspectos_tecnicos"]=='' || $consulta[0]["conclusion_tecnica"]=='') && ($tecnico[0]["funcionario_codigo"]==usuario_actual("funcionario_codigo"))) ||($devolver["numcampos"] && ($tecnico[0]["funcionario_codigo"]==usuario_actual("funcionario_codigo")))){
  $tabla1="<a  href='llenar_tecnico.php?iddoc=".$iddoc."' style='text-decoration: underline; cursor:pointer;'>
<img width='16px' style='border:0px' src='../../botones/formatos/adicionar.gif' />Adicionar aspectos t&eacute;cnicos</a>";
   echo($tabla1);
  }
   $consultar=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento","",$conn);
  $tecnico1=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consultar[0]["evaluador_tecnico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
   //print_r($consultar);
  if($consultar[0]["estado"]=="ACTIVO" && $tecnico1[0]["funcionario_codigo"]==usuario_actual("funcionario_codigo")){
  $tabla1="<a  href='llenar_tecnico.php?iddoc=".$iddoc."' style='text-decoration: underline; cursor:pointer;'>
<img width='16px' style='border:0px' src='../../botones/formatos/adicionar.gif' />Adicionar aspectos t&eacute;cnicos</a>";
   echo($tabla1);
  
  
  
  }
  }
  }
  function llenar_aspectos_juridicos($idformato,$iddoc){
  global $conn;
  if($_REQUEST["tipo"]!=5){
    $consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento and b.estado='APROBADO'","",$conn);
//if($consulta[0]["aspectos_juridicos"]=="" OR $consulta[0]["conclusion_juridica"]==""){
  $juridico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consulta[0]["evaluador_juridico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
  
   //devolucion
  $maximo=busca_filtro_tabla("Max(idtransferencia)","buzon_entrada","archivo_idarchivo=".$iddoc,"",$conn);
  $penultimo=$maximo[0][0]-1;
  $devolver=busca_filtro_tabla("","buzon_entrada","origen=".usuario_actual("funcionario_codigo")." and destino=".$consulta[0]["ejecutor"]." and nombre='DEVOLUCION' and archivo_idarchivo=".$iddoc." and idtransferencia=".$penultimo,"",$conn);
  //print_r($devolver);
  if((($consulta[0]["aspectos_juridicos"]=='' || $consulta[0]["conclusion_economica"]=='') && ($juridico[0]["funcionario_codigo"]==usuario_actual("funcionario_codigo"))) ||($devolver["numcampos"] && ($juridico[0]["funcionario_codigo"]==usuario_actual("funcionario_codigo"))) && ($consulta[0]["aspectos_economicos"]!='' || $consulta[0]["conclusion_economica"]!='')){
  
  //if($juridico[0]["funcionario_codigo"]==usuario_actual("funcionario_codigo") &&($consulta[0]["aspectos_economicos"]!='' || $consulta[0]["conclusion_economica"]!='')){
  $tabla1="<a  href='llenar_juridicado.php?iddoc=".$iddoc."' style='text-decoration: underline; cursor:pointer;'>
<img width='16px' style='border:0px' src='../../botones/formatos/adicionar.gif' />Adicionar aspectos juridicos</a>";
    echo($tabla1);
   }
  //}
  $consultar=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento","",$conn);
//if($consulta[0]["aspectos_juridicos"]=="" OR $consulta[0]["conclusion_juridica"]==""){
  $juridico1=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consultar[0]["evaluador_juridico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
  if($consultar[0]["estado"]=="ACTIVO" && $juridico1[0]["funcionario_codigo"]==usuario_actual("funcionario_codigo")){
   $tabla1="<a  href='llenar_juridicado.php?iddoc=".$iddoc."' style='text-decoration: underline; cursor:pointer;'>
<img width='16px' style='border:0px' src='../../botones/formatos/adicionar.gif' />Adicionar aspectos juridicos</a>";
    echo($tabla1);
  }
  }
  }
  function llenar_aspectos_economicos($idformato,$iddoc){
  global $conn;
  if($_REQUEST["tipo"]!=5){
  $consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento and b.estado='APROBADO'","",$conn);
  $economico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consulta[0]["evaluador_economico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
  $juridico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consulta[0]["evaluador_juridico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
    //devolucion
  $maximo=busca_filtro_tabla("Max(idtransferencia)","buzon_entrada","archivo_idarchivo=".$iddoc,"",$conn);
  $penultimo=$maximo[0][0]-1;
  $devolver=busca_filtro_tabla("","buzon_entrada","origen=".usuario_actual("funcionario_codigo")." and destino=".$juridico[0]["funcionario_codigo"]." and nombre='DEVOLUCION' and archivo_idarchivo=".$iddoc." and idtransferencia=".$penultimo,"",$conn);
  
  //
  
  //if($consulta[0]["aspectos_economicos"]=="" OR $consulta[0]["conclusion_economica"]==""){
  if((($consulta[0]["aspectos_economicos"]=='' || $consulta[0]["conclusion_economica"]=='') && ($economico[0]["funcionario_codigo"]==usuario_actual("funcionario_codigo"))) ||($devolver["numcampos"] && ($economico[0]["funcionario_codigo"]==usuario_actual("funcionario_codigo"))) && ($consulta[0]["aspectos_tecnicos"]!='' || $consulta[0]["conclusion_tecnica"]!='')){
  //if($economico[0]["funcionario_codigo"]==usuario_actual("funcionario_codigo")){
  $tabla1="<a  href='llenar_economico.php?iddoc=".$iddoc."' style='text-decoration: underline; cursor:pointer;'>
<img width='16px' style='border:0px' src='../../botones/formatos/adicionar.gif' />Adicionar aspectos econ&oacute;micos</a>";
    echo($tabla1);
   //}
  }
  
  $consultar=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento","",$conn);
  $economico1=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consultar[0]["evaluador_economico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
  if($consultar[0]["estado"]=="ACTIVO" && $economico1[0]["funcionario_codigo"]==usuario_actual("funcionario_codigo")){
  $tabla1="<a  href='llenar_economico.php?iddoc=".$iddoc."' style='text-decoration: underline; cursor:pointer;'>
<img width='16px' style='border:0px' src='../../botones/formatos/adicionar.gif' />Adicionar aspectos econ&oacute;micos</a>";
    echo($tabla1); 
  
  }
  }
  }
function tabla_empresas_invitadas($idformato,$iddoc){
  global $conn;
   $consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento","",$conn);
   echo($consulta[0]["valor"]);
  
  }  
function aspectos_tecnicos_objeto($idformato,$iddoc){
  global $conn;
  $consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento","",$conn);
  echo(mostrar_valor_campo('aspectos_tecnicos',82,$consulta[0]["documento_iddocumento"],1));
  }
  
  function conclusion_tecnica_objeto($idformato,$iddoc){
  global $conn;
  $consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento","",$conn);
  $tabla='<table border="0" width="100%" style="text-align: left; border: #000000 1px solid;">
<tbody>
<tr>
<td><b>CONCLUSI&Oacute;N TECNICA:</b><br>'.mostrar_valor_campo('conclusion_tecnica',82,$consulta[0]["documento_iddocumento"],1).'</td>
</tr>
</tbody>
</table>';
echo($tabla);
  }
  
  
    function aspectos_economicos_objeto($idformato,$iddoc){
  global $conn;
   global $conn;
  $consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento","",$conn);
  echo(mostrar_valor_campo('aspectos_economicos',82,$consulta[0]["documento_iddocumento"],1));
  
  }
  
    function conclusion_economicos_objeto($idformato,$iddoc){
  global $conn;
  $consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento","",$conn);
  $tabla='<table border="0" width="100%" style="text-align: left; border: #000000 1px solid;">
<tbody>
<tr>
<td><b>CONCLUSI&Oacute;N ECON&Oacute;MICA:</b><br>'.mostrar_valor_campo('conclusion_economica',82,$consulta[0]["documento_iddocumento"],1).'</td>
</tr>
</tbody>
</table>';
echo($tabla);
  
  }
  
    function aspectos_juridicos_objeto($idformato,$iddoc){
  global $conn;
 
  $consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento","",$conn);
  echo(mostrar_valor_campo('aspectos_juridicos',82,$consulta[0]["documento_iddocumento"],1));
  
  
  }
     function conclusion_juridicos_objeto($idformato,$iddoc){
  global $conn;
    $consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento","",$conn);
  $tabla='<table border="0" width="100%" style="text-align: left; border: #000000 1px solid;">
<tbody>
<tr>
<td><b>CONCLUSI&Oacute;N JURIDICA:</b><br>'.mostrar_valor_campo('conclusion_juridica',82,$consulta[0]["documento_iddocumento"],1).'</td>
</tr>
</tbody>
</table>';
echo($tabla);
  
  }
     function ver_recomendacion($idformato,$iddoc){
  global $conn;
   $consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento","",$conn);

echo(mostrar_valor_campo('recomendacion',82,$consulta[0]["documento_iddocumento"],1));
  
  }
  
    function tabla_forma_pago($idformato,$iddoc){
  global $conn;
  $consulta=busca_filtro_tabla("","ft_acta_evaluacion","documento_iddocumento=".$iddoc,"",$conn);

$tecnico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consulta[0]["interventor"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
echo($tecnico[0]["nombres"].' '.$tecnico[0]["apellidos"]);
  
  }
  
function tabla_firmas($idformato,$iddoc){
global $conn;
$ancho_firma=busca_filtro_tabla("valor",DB.".configuracion A","A.nombre='ancho_firma'","",$conn);
if(!$ancho_firma["numcampos"])
  $ancho_firma[0]["valor"]=200;
$alto_firma=busca_filtro_tabla("valor",DB.".configuracion A","A.nombre='alto_firma'","",$conn);
if(!$alto_firma["numcampos"])
  $alto_firma[0]["valor"]=100;
$consulta=busca_filtro_tabla("","ft_acta_evaluacion","documento_iddocumento=".$iddoc,"",$conn); 
$tecnico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consulta[0]["evaluador_tecnico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
$economico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consulta[0]["evaluador_economico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
$juridico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consulta[0]["evaluador_juridico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
if($consulta[0]["aprobacion_tecnico"]=='APROBADO'){
  $firma_tecnico='<img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/formatos/librerias/mostrar_foto.php?codigo='.$tecnico[0]["funcionario_codigo"].'" width="'.$ancho_firma[0]["valor"].'" height="'.$alto_firma[0]["valor"].'"/>';
}else{
  $firma_tecnico='<img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/firmas/faltante.jpg" width="'.$ancho_firma[0]["valor"].'" height="'.$alto_firma[0]["valor"].'">';
}
if($consulta[0]["aprobacion_economico"]=='APROBADO'){
  $firma_economico='<img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/formatos/librerias/mostrar_foto.php?codigo='.$economico[0]["funcionario_codigo"].'" width="'.$ancho_firma[0]["valor"].'" height="'.$alto_firma[0]["valor"].'"/>';
}else{
  $firma_economico='<img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/firmas/faltante.jpg" width="'.$ancho_firma[0]["valor"].'" height="'.$alto_firma[0]["valor"].'">';
}
if($consulta[0]["aprobacion_juridico"]=='APROBADO'){
  $firma_juridico='<src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/formatos/librerias/mostrar_foto.php?codigo='.$juridico[0]["funcionario_codigo"].'" width="'.$ancho_firma[0]["valor"].'" height="'.$alto_firma[0]["valor"].'"/>';
}else{
  $firma_juridico='<img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/firmas/faltante.jpg" width="'.$ancho_firma[0]["valor"].'" height="'.$alto_firma[0]["valor"].'">'; 
}
$tabla='<table style="border-collapse:collapse" width="100%">
<tbody>
<tr>
<td style="text-align: center; border: #000000 1px solid;">NOMBRE</td>
<td style="text-align: center; border: #000000 1px solid;">EVALUADOR</td>
<td style="text-align: center; border: #000000 1px solid;">FIRMA</td>
</tr>
<tr>
<td style="text-align: center; border: #000000 1px solid;">'.$tecnico[0]["nombres"].' '.$tecnico[0]["apellidos"].'</td>
<td style="text-align: center; border: #000000 1px solid;">T&eacute;cnico</td>
<td style="text-align: center; border: #000000 1px solid;">'.$firma_tecnico.'</td>
</tr>
<tr>
<td style="text-align: center; border: #000000 1px solid;">'.$economico[0]["nombres"].' '.$economico[0]["apellidos"].'</td>
<td style="text-align: center; border: #000000 1px solid;">Econ&oacute;mico</td>
<td style="text-align: center; border: #000000 1px solid;">'.$firma_economico.'</td>
</tr>
<tr>
<td style="text-align: center; border: #000000 1px solid;">'.$juridico[0]["nombres"].' '.$juridico[0]["apellidos"].'</td>
<td style="text-align: center; border: #000000 1px solid;">Jur&iacute;dico</td>
<td style="text-align: center; border: #000000 1px solid;">'.$firma_juridico.'</td>
</tr>
</tbody>
</table>';

echo($tabla);
  }
function transferencia_evaluadores($idformato,$iddoc){
  global $conn;
  
$consulta=busca_filtro_tabla("","ft_acta_evaluacion","documento_iddocumento=".$_POST["iddoc"],"",$conn); 

$tecnico=busca_filtro_tabla("","dependencia_cargo a, funcionario b","a.iddependencia_cargo=".$consulta[0]["evaluador_tecnico"]." and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
$fieldList["nombre"] = 'TRANSFERIDO';
$fieldList["fecha"] = date("Y-m-d H:i:s");
$fieldList["notas"] ="";
$fieldList["ver_notas"] = 1;
$fieldList["tipo_destino"] = 1;
$fieldList["archivo_idarchivo"] = $_POST["iddoc"];
$fieldList["origen"] = usuario_actual("funcionario_codigo");
$datos_adicionales["notas"]="'".$fieldList["notas"]."'";
$destinos=array($tecnico[0]["funcionario_codigo"]);
transferir_archivo_prueba($fieldList,$destinos,'');

}

function lista_ano($idformato,$idcampo,$iddoc=NULL){
global $conn;
$opciones='';
$anio=date("Y");
if($iddoc==NULL)
  $consulta[0]["lista"]=$anio;
else
  $consulta=busca_filtro_tabla("","ft_acta_evaluacion","documento_iddocumento=".$iddoc,"",$conn);  

for($i=1983;$i<($anio+2);$i++){
$opciones.='<option value="'.$i.'" ';
  if($i==$consulta[0]["lista"])
     $opciones.=' selected ';
  $opciones.='>'.html_entity_decode($i)."</option>";
}
if($opciones<>"")
$texto='<td><select name="lista" id="lista" class="required">'.$opciones.'</select></td>';
echo($texto);
}

function llenar_convenio($idformato,$iddoc){
global $conn;

echo "<script>$().ready(function() {
    $('#convenio').val(11);
});</script>"; 

}
function llenar_serie($idformato,$iddoc){
global $conn;

echo "<script>$().ready(function() {
    $('#serie_idserie').val(139);
});</script>"; 

}

function validar_llenado_clientes($idformato,$iddoc){
global $conn;
$consulta=busca_filtro_tabla("","ft_acta_evaluacion","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);

$empresas=busca_filtro_tabla("","ft_empresas","ft_acta_evaluacion=".$consulta[0]["idft_acta_evaluacion"],"",$conn);
if($empresas["numcampos"]==0){
alerta("Por favor llenar la informacion de las empresas invitadas");
die();

}

//die();
/*
$consulta=busca_filtro_tabla("","ft_acta_evaluacion","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
$empresas=busca_filtro_tabla("","ft_empresas","ft_acta_evaluacion=".$consulta[0]["idft_acta_evaluacion"],"",$conn);

if($empresas["numcampos"]==0 && $_REQUEST["funcion"]=='aprobar'){
print_r($_REQUEST);
$vacio="";
echo "<script>$().ready(function() {
    $('#funcion').val('".$vacio."');
});</script>"; 

alerta("Debe llenar la informacion de las empresas invitadas");
redirecciona("http://".RUTA_PDF."/formatos/acta_evaluacion/mostrar_acta_evaluacion.php?iddoc=".$_REQUEST["iddoc"]."&idformato=82&no_menu=1");
volver(1);
}*/
}

function validar_llenado_creador($idformato,$iddoc){
global $conn;
?>
  <script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-full.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
hs.outlineType = 'rounded-white';
</script>
  <?php
$consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento","",$conn);
if($_REQUEST["tipo"]!=5){
 if(($consulta[0]["recomendacion"]=='' || $consulta[0]["valor"]=='') && ($consulta[0]["ejecutor"]==usuario_actual("funcionario_codigo")) && ($consulta[0]["aspectos_juridicos"]!='' || $consulta[0]["conclusion_juridica"]!='')){
  $tabla1="<a  href='llenar_creador.php?iddoc=".$iddoc."' style='text-decoration: underline; cursor:pointer;'>
<img width='16px' style='border:0px' src='../../botones/formatos/adicionar.gif' />Registrar informaci&oacute;n</a>";
   echo($tabla1);
  }
}
}
function mensaje_empresa($idformato,$iddoc){
global $conn;
$consulta=busca_filtro_tabla("","ft_acta_evaluacion","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
$empresas=busca_filtro_tabla("","ft_empresas","ft_acta_evaluacion=".$consulta[0]["idft_acta_evaluacion"],"",$conn);
if($empresas["numcampos"]==0){
 echo("<font color='red'>RECUERDE REGISTRAR LAS EMPRESAS INVITADAS PARA QUE PUEDA DAR CLICK EN EL BOTON CONFIRMAR EL DOCUMENTO</font><br><br>");
}
}

function ver_descripcion($idformato,$iddoc){
global $conn;

$consulta=busca_filtro_tabla("","ft_acta_evaluacion","documento_iddocumento=".$_POST["iddoc"],"",$conn);

if($_POST["iddoc"]>0){
$texto="Solicitud de oferta: ".$consulta[0]["solitud_oferta"]."<br>Objeto de contrataci&oacute;n:".mostrar_valor_campo('objeto_contratacion',82,$_POST["iddoc"],1);
//$actualizacion="UPDATE documento set descripcion='".$texto."' where iddocumento=".$_POST["iddoc"];

//phpmkr_query($actualizacion,$conn);

}

//
}
?>
 
