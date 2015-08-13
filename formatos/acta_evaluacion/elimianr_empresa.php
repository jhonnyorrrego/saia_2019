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




function numero_documento($idformato,$iddoc){
  global $conn;
$consulta=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
echo($consulta[0]["numero"]);
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
<td style="text-align: center; border: #000000 1px solid;">'.mostrar_valor_campo('objeto_contratacion',82,$iddoc,1).'</td>
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

if($consulta[0]["estado"]=='ACTIVO'){

$tabla1.="<a  href='../empresas/adicionar_empresas.php?pantalla=padre&idpadre=".$iddoc."&idformato=85&padre=".$consulta[0]["idft_acta_evaluacion"]."'>
<img width='16px' border=0 src='../../botones/formatos/adicionar.gif' />Adicionar empresas invitadas</a>";
echo($tabla1);
}
$cuentas=busca_filtro_tabla("","ft_empresas","ft_acta_evaluacion=".$consulta[0]["idft_acta_evaluacion"],"",$conn);

if($cuentas["numcampos"]){

$tabla.="<table border='1' width='100%' style='border-collapse:collapse' width='100%'>
         <tr class='encabezado_list'><td style='text-align: center; border: #000000 1px solid;'>No</td><td style='text-align: center; border: #000000 1px solid;'>Empresa</td><td style='text-align: center; border: #000000 1px solid;'>Entrega cotizacion</td><td style='text-align: center; border: #000000 1px solid;'>Acciones</td></tr>";

for($i=0;$i<$cuentas["numcampos"];$i++){
?>

<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
hs.outlineType = 'rounded-white';
</script>
<?php
if($consulta[0]["estado"]=='ACTIVO'){
$acciones="<a href='../empresas/mostrar_empresas.php?idformato=85&iddoc=".$cuentas[$i]["idft_empresas"]."' class='highslide' onclick='return hs.htmlExpand(this, { objectType: \'iframe\',width: 650, height:4000,preserveContent:false } )'style='text-decoration: underline; cursor:pointer;'' target='_blank'><img border=0 src='../../botones/comentarios/ver_documentos.png' /></a><a href='../empresas/editar_empresas.php?idformato=85&item=".$cuentas[$i]["idft_empresas"]."'><img border=0 src='../../botones/comentarios/editar_documento.png' /></a><a href='#' onclick='if(confirm('En realidad desea borrar este elemento?')) window.location='../librerias/funciones_item.php?formato=85&idpadre=".$iddoc."&accion=eliminar_item&tabla=ft_empresas&id=".$i."';'><img border=0 src='../../images/eliminar_pagina.png' /></a>";
}else{
$acciones="";
}
$ejecutor=busca_filtro_tabla("","datos_ejecutor a, ejecutor b","a.ejecutor_idejecutor=b.idejecutor and a.iddatos_ejecutor=".$cuentas[$i]["empresa"],"",$conn);
$tabla.="<tr><td style='text-align: center; border: #000000 1px solid;'>".$i."</td><td style='text-align: center; border: #000000 1px solid;'>".$ejecutor[0]["nombre"]."</td><td style='text-align: center; border: #000000 1px solid;'>".$cuentas[$i]["entrega_cotizacion"]."</td><td style='text-align: center; border: #000000 1px solid;'>".$acciones."</td></tr>";
}
$tabla.="</table>";  
 
echo($tabla);
}
}  

function llenar_aspectos_tecnicos($idformato,$iddoc){
  global $conn;
  $consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento and b.estado='APROBADO'","",$conn);
  if($consulta["numcampos"]){
  $tabla1="<a  href='../tecnico/adicionar_tecnico.php?padre=".$consulta[0]["idft_acta_evaluacion"]."&anterior=".$iddoc."&idformato=84'>
<img width='16px' border=0 src='../../botones/formatos/adicionar.gif' />Adicionar aspectos t&eacute;cnicos</a>";
   }
   echo($tabla1);
  }
  function llenar_aspectos_juridicos($idformato,$iddoc){
  global $conn;
  
  }
  function llenar_aspectos_economicos($idformato,$iddoc){
  global $conn;
  
  }
function tabla_empresas_invitadas($idformato,$iddoc){
  global $conn;
  
  
  }  
function aspectos_tecnicos_objeto($idformato,$iddoc){
  global $conn;
  $consulta=busca_filtro_tabla("","ft_acta_evaluacion a, documento b","a.documento_iddocumento=".$iddoc." and a.documento_iddocumento=b.iddocumento","",$conn);
  $tecnicos=busca_filtro_tabla("","ft_tecnico","ft_acta_evaluacion=".$consulta[0]["idft_acta_evaluacion"],"",$conn);
  echo(mostrar_valor_campo('aspectos_tecnicos',84,$tecnicos[0]["documento_iddocumento"],1));
  }
  
  function conclusion_tecnica_objeto($idformato,$iddoc){
  global $conn;
  
  
  }
  
  
    function aspectos_economicos_objeto($idformato,$iddoc){
  global $conn;
  
  
  }
  
    function conclusion_economicos_objeto($idformato,$iddoc){
  global $conn;
  
  
  }
  
    function aspectos_juridicos_objeto($idformato,$iddoc){
  global $conn;
  
  
  }
     function conclusion_juridicos_objeto($idformato,$iddoc){
  global $conn;
  
  
  }
     function ver_recomendacion($idformato,$iddoc){
  global $conn;
  
  
  }
  
    function tabla_forma_pago($idformato,$iddoc){
  global $conn;
  
  
  }
  
    function tabla_firmas($idformato,$iddoc){
  global $conn;
  
  
  }
?>
