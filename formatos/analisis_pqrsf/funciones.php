<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}    
include_once($ruta_db_superior."db.php"); 

function mostrar_item($idformato,$iddoc){

$idft=busca_filtro_tabla("idft_analisis_pqrsf,estado","ft_analisis_pqrsf,documento","iddocumento=documento_iddocumento and documento_iddocumento=".$iddoc,"",$conn);
if($idft[0]['estado']!='APROBADO' && $_REQUEST['tipo']!=5){
	echo '<a href="../item_causas_pqrsf/adicionar_item_causas_pqrsf.php?pantalla=padre&amp;idpadre='.$_REQUEST['iddoc'].'&amp;idformato=314&amp;padre='.$idft[0][0].'"><img width="16px" border="0" src="../../botones/formatos/adicionar.gif">Adicionar Items</a>';	
}

$item=busca_filtro_tabla("I.accion_causa,nombres, apellidos,".fecha_db_obtener('I.fecha_limite','Y-m-d')." as fecha_limite,idft_item_causas_pqrsf","ft_item_causas_pqrsf I,vfuncionario_dc F","F.iddependencia_cargo=I.responsable AND I.ft_analisis_pqrsf=".$idft[0][0],"",$conn);

$html='<table  style="border-collapse: collapse; font-size: 12px; width: 100%;" border="1">';
$html.="<tr align='center'><th>Accion</th> <th>Responsable</th> <th>Fecha Limite</th>";
if($idft[0]['estado']!='APROBADO' && $_REQUEST['tipo']!=5){
	$html.="<th>Acciones</th>";
}
$html.="</tr>";
for($i=0;$i<$item['numcampos'];$i++){
	$html.='<tr> <td>'.$item[$i]['accion_causa'].'</td> <td>'.ucwords(strtolower($item[$i]['nombres'].' '.$item[$i]['apellidos'])).'</td> <td>'.$item[$i]['fecha_limite'].'</td>';
	if($idft[0]['estado']!='APROBADO' && $_REQUEST['tipo']!=5){
		$html.='<td>
			<a href="#" onclick="if(confirm(&quot;En realidad desea borrar este elemento?&quot;)) window.location=&quot;../librerias/funciones_item.php?formato=314&amp;idpadre='.$_REQUEST['iddoc'].'&amp;accion=eliminar_item&amp;tabla=ft_item_causas_pqrsf&amp;id='.$item[$i]['idft_item_causas_pqrsf'].'&quot;;">
			<img border="0" src="../../images/eliminar_pagina.png"></a>	</td>';
	}
	$html.='</tr>';
}	
$html.="</table>";
if($item['numcampos']>0){
	echo $html;
}

}

function transferir_responsa($idformato,$iddoc){
	$parte_sql="SELECT idft_analisis_pqrsf FROM ft_analisis_pqrsf WHERE documento_iddocumento=".$iddoc;
	$item=busca_filtro_tabla("","ft_item_causas_pqrsf","transferido=1 and ft_analisis_pqrsf=(".$parte_sql.")","",$conn);
	
	for($i=0;$i<$item['numcampos'];$i++){
		transferir_desde_papa($idformato,$iddoc,$item[$i]['responsable'],1,"Transferencia desde Planeacion y Analisis");
		$update="UPDATE ft_item_causas_pqrsf SET transferido=0 WHERE idft_item_causas_pqrsf=".$item[$i]['idft_item_causas_pqrsf'];
		phpmkr_query($update);
	}
	
}
 function valida_item_formato_pqrsf($idformato,$iddoc){
 	global $conn,$ruta_db_superior;
 	
	$valida_item=busca_filtro_tabla("","ft_item_causas_pqrsf a,ft_analisis_pqrsf b","a.ft_analisis_pqrsf=b.idft_analisis_pqrsf and b.documento_iddocumento=".$iddoc,"",$conn);	
		
	if(!$valida_item['numcampos']){
		alerta('No puede confirmar el documento sin adicionar un analisis de causas ');
		redirecciona($ruta_db_superior.'formatos/analisis_pqrsf/mostrar_analisis_pqrsf.php?iddoc='.$iddoc.'&idformato='.$idformato);
	}
}

?>