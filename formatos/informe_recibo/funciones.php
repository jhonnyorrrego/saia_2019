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
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_bootstrap());
echo(estilo_bootstrap());
echo(librerias_notificaciones());


function fun_proveedor($idformato,$iddoc){
$provee=busca_filtro_tabla("A.nombre","ejecutor A,datos_ejecutor B,ft_informe_recibo C,ft_factura_proveedor D"," D.prooveedor=B.iddatos_ejecutor AND B.ejecutor_idejecutor=A.idejecutor AND  D.idft_factura_proveedor = C.ft_factura_proveedor and C.documento_iddocumento=".$iddoc,"",$conn);
//print_r($provee);
echo $provee[0]['nombre'];

}

function recibo_caja($idformato,$iddoc){
$factura=busca_filtro_tabla("","ft_factura_proveedor A,ft_informe_recibo B","A.idft_factura_proveedor=B.ft_factura_proveedor AND B.documento_iddocumento=".$iddoc,"",$conn);
//print_r($factura);
$area=busca_filtro_tabla("A.dependencia","vfuncionario_dc A,ft_informe_recibo B","A.iddependencia_cargo=".$factura[0]['dependencia']." AND B.documento_iddocumento=".$iddoc,"",$conn);
echo $area[0]['dependencia'];

}
function quien_recibe($idformato,$iddoc){
$factura=busca_filtro_tabla("","ft_factura_proveedor A,ft_informe_recibo B","A.idft_factura_proveedor=B.ft_factura_proveedor AND B.documento_iddocumento=".$iddoc,"",$conn);
//print_r($factura);
$recibe=busca_filtro_tabla("A.nombres","vfuncionario_dc A,ft_informe_recibo B","A.iddependencia_cargo=".$factura[0]['dependencia']." AND B.documento_iddocumento=".$iddoc,"",$conn);
echo $recibe[0]['nombres'];

}
function recibe_nit($idformato,$iddoc){
$factura=busca_filtro_tabla("","ft_factura_proveedor A,ft_informe_recibo B","A.idft_factura_proveedor=B.ft_factura_proveedor AND B.documento_iddocumento=".$iddoc,"",$conn);
//print_r($factura);
$recibe=busca_filtro_tabla("A.nombres","vfuncionario_dc A,ft_informe_recibo B","A.iddependencia_cargo=".$factura[0]['dependencia']." AND B.documento_iddocumento=".$iddoc,"",$conn);
echo $recibe[0]['nit'];

}


function proveedor_nit($idformato,$iddoc){
$provee=busca_filtro_tabla("A.identificacion","ejecutor A,datos_ejecutor B,ft_informe_recibo C,ft_factura_proveedor D"," D.prooveedor=B.iddatos_ejecutor AND B.ejecutor_idejecutor=A.idejecutor AND  D.idft_factura_proveedor = C.ft_factura_proveedor and C.documento_iddocumento=".$iddoc,"",$conn);
//print_r($provee);
echo $provee[0]['identificacion'];

}
function datos_factura($idformato,$iddoc){
$factura=busca_filtro_tabla("A.*,B.cantidad","ft_factura_proveedor A,ft_informe_recibo B","A.idft_factura_proveedor=B.ft_factura_proveedor AND B.documento_iddocumento=".$iddoc,"",$conn);
//print_r($factura);
//echo $factura[0]['nombres'];
$texto='<table style="; width: 100%;" border="1">
<tbody>
<tr>
<td style=font-size:12px><strong>Descripcion</strong></td>
<td style=font-size:12px><strong>Num factura</strong></td>
<td style=font-size:12px><strong>Valor</strong></td>
<td style=font-size:11px><strong>Cantidad</strong></td>
</tr>
<tr>
<td style=font-size:12px>'.$factura[0]['observaciones'].'</td>
<td style=font-size:12px>'.$factura[0]['num_factura'].'</td>
<td style=font-size:12px>$'.$factura[0]['valor_factura'].'</td>
<td style=font-size:12px>'.$factura[0]['cantidad'].'</td>
</tr>
</tbody>
</table>';
echo $texto;
}
function ver_factura($idformato,$iddoc){
	global $ruta_db_superior;
	$iddoc_papa=buscar_papa_formato($idformato,$iddoc,"ft_factura_proveedor");
	$url=$ruta_db_superior."ordenar.php?accion=mostrar&tipo_destino=1&mostrar_formato=1&key =".$iddoc_papa;
	echo "<a href='".$url."' target='centro'>Ver Factura</a>";
	//abrir_url($url,"centro");
}

function validar_devolucion_factura($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$item=busca_filtro_tabla("","ft_validacion_factura","ft_factura_proveedor=".$_REQUEST['padre'],"",$conn);
	if ($item['numcampos']==0) {
		?>
			<script>
				$('#div_contenido').css('pointer-events','none');  
			</script>
		<?php
		echo '<div class="alert alert-warning"><h2>Aun no se ha definido si esta factura es correcta</h2></div>';
	}elseif($item[0]['factura_correcta']==2) {
			?>
				<script>
					$('#div_contenido').css('pointer-events','none');  
				</script>
			<?php
			echo '<div class="alert alert-warning"><h2>Esta factura es incorrecta</h2></div>';
		}
	}

function enlace_item_causacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$dato=busca_filtro_tabla("","ft_informe_recibo A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);  //nombre tabla padre
	$informe_recibo=busca_filtro_tabla("","ft_informe_recibo","documento_iddocumento=".$iddoc,"",$conn);
	$valor=busca_filtro_tabla("valor_factura","ft_factura_proveedor","idft_factura_proveedor=".$informe_recibo[0]['ft_factura_proveedor'],"",$conn);
	$causacion=busca_filtro_tabla("","ft_causacion","ft_informe_recibo=".$informe_recibo[0]['idft_informe_recibo'],"",$conn);
	$faltante=$valor[0]['valor_factura'];
	for ($i=0; $i < $causacion['numcampos']; $i++) { 
		$faltante=$faltante-$causacion[$i]['valor_causacion'];
	}
	
	
		$item=busca_filtro_tabla("","ft_causacion","ft_informe_recibo=".$dato[0]['idft_informe_recibo'],"",$conn);	
		if($_REQUEST['tipo']!=5 && $faltante>0 && $dato[0]['estado']!='APROBADO'){
						
				echo '<a href="../causacion/adicionar_causacion.php?pantalla=padre&amp;idpadre='.$iddoc.'&amp;idformato='.$idformato.'&amp;padre='.$dato[0]['idft_informe_recibo'].'" target="_self">Causacion</a>'; 
		}

}

function mostrar_datos_item_causacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;

	$tabla='';
		
		$dato=busca_filtro_tabla("","ft_informe_recibo A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);

		
		if($dato['numcampos']!=0){
								
			$tabla.='
						<table style="width:100%; border-collapse: collapse;" border="1">
						<tbody>
						<tr class="encabezado_list">
							<td>Centro de costos</td>
							<td>Valor</td>
							<td>Observaciones</td>
						</tr>
			';
				
				$item=busca_filtro_tabla("","ft_causacion A, ft_informe_recibo B","idft_informe_recibo=ft_informe_recibo and A.ft_informe_recibo=".$dato[0]['idft_informe_recibo'],"",$conn);					
			

			if($item['numcampos']!=0){
				
						

			for($j=$item['numcampos']-1;$j>=0;$j--){

	
							$tabla.='		
									<tr>
										<td>'.$item[$j]['centro_costos'].'</td>
										<td>'.$item[$j]['valor_causacion'].'</td>
										<td>'.$item[$j]['observaciones_causa'].'</td>
									
							';				
							if($_REQUEST['tipo']!=5 && $dato[0]['estado']!='APROBADO'){
								$tabla.='
										<td id="registro_'.$item[$j]['idft_causacion'].'" style="width:10px;"><center><img src="'.$ruta_db_superior.'imagenes/delete.gif" class="guardar_seleccionado" idregistro="'.$item[$j]['idft_causacion'].'"  style="cursor:pointer"></center></td>
									</tr>								
								';		
							}
							else{
								$tabla.='
									</tr>
								';										
							}								

	
			
			}  //fin ciclo items
			
			
				$tabla.='	
					</tbody>
					</table>
				';	
				
				$tabla.='
					<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
					<script>
					$(document).ready(function(){
						$(".guardar_seleccionado").click(function(){
							var idregistro=$(this).attr("idregistro");
							
							if(confirm("En realidad desea borrar este elemento?")){
								$.ajax({
			                        type:"POST",
			                        url: "borrar_item.php",
			                        data: {
			                                        idft:idregistro,
			                                        tabla:"ft_causacion"
			                        },
			                        success: function(){
										location.reload();
			                        },
			                        error:function(){
			                        	alert("error consulta ajax");
			                        }
			                    }); 
			                }	  			
						});				
					});
					</script>						
				';
									
				echo($tabla);	
			}
		} 

}

function validar_causacion($idformato,$iddoc){
		global $conn,$ruta_db_superior;
		$dato=busca_filtro_tabla("","ft_informe_recibo A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);  //nombre tabla padre
	$informe_recibo=busca_filtro_tabla("","ft_informe_recibo","documento_iddocumento=".$iddoc,"",$conn);
	$valor=busca_filtro_tabla("valor_factura","ft_factura_proveedor","idft_factura_proveedor=".$informe_recibo[0]['ft_factura_proveedor'],"",$conn);
	$causacion=busca_filtro_tabla("","ft_causacion","ft_informe_recibo=".$informe_recibo[0]['idft_informe_recibo'],"",$conn);
	$faltante=$valor[0]['valor_factura'];
	for ($i=0; $i < $causacion['numcampos']; $i++) { 
		$faltante=$faltante-$causacion[$i]['valor_causacion'];
	}
		if($faltante>0){
			?>
			<script>
			notificacion_saia('Debe indicar a que centro de costos pertenece el dinero que aun no se ha asignado','warning','',4000);
			</script>
			<?php
			echo('<script>window.history.back();</script>');
			die();
		}		
	}
?>