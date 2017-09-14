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
include_once($ruta_db_superior."formatos/librerias_funciones_generales.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery('1.7'));
echo(librerias_notificaciones());

function campo_fecha_ruta($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$fecha=date('Y-m-d');
	?>
	<script>
	    $(document).ready(function(){
	       $('#fecha_ruta_distribuc').attr('readonly', true);
	       $('#fecha_ruta_distribuc').val('<?php echo $fecha;?>'); 
	    });
	</script>
	<?php
}

function enlace_item_dependencias_ruta($idformato,$iddoc){
		global $conn, $ruta_db_superior;
		
		
			$dato=busca_filtro_tabla("","ft_ruta_distribucion A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);  //nombre tabla padre
			
		if($_REQUEST['tipo']!=5){
						
				echo '<a href="../dependencias_ruta/adicionar_dependencias_ruta.php?pantalla=padre&amp;idpadre='.$iddoc.'&amp;idformato='.$idformato.'&amp;padre='.$dato[0]['idft_ruta_distribucion'].'" target="_self">Dependencias de la Ruta</a>'; //
		}
}

function mostrar_datos_dependencias_ruta($idformato,$iddoc){
		global $conn, $ruta_db_superior;
		$select="<select name='estado[]' style='width:100px;'>
                      <option value='1'>Activo</option>
                      <option value='2'>Inactivo</option>
                </select>
		";
		$tabla='';
		
		$dato=busca_filtro_tabla("","ft_ruta_distribucion A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);  //nombre tabla padre

		
		
		if($dato['numcampos']!=0){
								
			$tabla.='   <form id="item_prerequisitos" action="guardar_datos_dependencias.php">
						<table style="width:100%; border-collapse: collapse;" border="1">
						<tbody>
						<tr class="encabezado_list">
						    <td>Fecha</td>
						   
						    <td>Dependencia</td>
						    <td>Descripción</td>
						    <td>Estado</td>
						</tr>
			';
				
				$item=busca_filtro_tabla("","ft_dependencias_ruta A, ft_ruta_distribucion B","idft_ruta_distribucion=ft_ruta_distribucion and A.ft_ruta_distribucion=".$dato[0]['idft_ruta_distribucion'],"",$conn);					
			

			if($item['numcampos']!=0){
				
			$estado=array(1=>"Activo",2=>"Inactivo");				

			for($j=$item['numcampos']-1;$j>=0;$j--){
                    
                    $dependencia=busca_filtro_tabla('','dependencia','iddependencia='.$item[$j]['dependencia_asignada'],'',conn);
	               
							$tabla.='		
									<tr>
										<td>'.$item[$j]['fecha_item_dependenc'].'</td>
										
										<input type="hidden" name="dependencia_asignada[]" value="'.$item[$j]['dependencia_asignada'].'">
										<td>'.$dependencia[0]['nombre'].'</td>';
							if($item[$j]['descripcion_dependen']==''){
							    $tabla.='<td><input name="descripcion[]" type="text" style="width:200px;" value=""></td>';
							}else{
							    $tabla.='<td>'.$item[$j]['descripcion_dependen'].'</td>
							    <input type="hidden" name="descripcion[]" value="'.$item[$j]['descripcion_dependen'].'"> 
							    ';
							}
							$seleccionar=array(1=>"",2=>"");
		                    $seleccionar[$item[$j]['estado_dependencia']]='selected';
							$tabla.='
										<td><select class="cambio_estado_dependencia" data-idft_ruta_distribucion='.$dato[0]['idft_ruta_distribucion'].' data-idft='.$item[$j]['dependencia_asignada'].' name="estado[]" style="width:100px;">
                                              <option value="1" '.$seleccionar[1].'>Activo</option>
                                              <option value="2" '.$seleccionar[2].'>Inactivo</option>
                                        </select></td>
					                    </tr>
							';				
							

	
			
			}  //fin ciclo items
			
			
				$tabla.='	
					</tbody>
					</table><br>
					<input class="btn btn-mini btn-primary" style="float:right;" type="submit" value="Guardar Cambios"/>
					</form>
				';	
				
				$tabla.='
					
					<script>
					$(document).ready(function(){
						$(".cambio_estado_dependencia").change(function(){
							var estado=$(this).val();
							var idft=$(this).attr("data-idft");
							var idft_ruta_distribucion=$(this).attr("data-idft_ruta_distribucion");
				
							$.ajax({
			                        type:"POST",
			                       	dataType: "json",
			                        url: "actualizar_estado_dependencias.php",
			                        data: {
			                                        idft:idft,
			                                        estado:estado,
			                                        idft_ruta_distribucion:idft_ruta_distribucion
			                        },
			                        success: function(datos){
			                        	
										var color="success";
										if(!datos.exito){
											color="warning";
										}
			                            notificacion_saia(datos.mensaje,color,"",4000);
										location.reload();
			                        }
			                    }); 	
			                	  			
						});				
					});
					</script>						
				';
									
				echo($tabla);	
			}
		} 
    
}

function enlace_item_funcionarios_ruta($idformato,$iddoc){
		global $conn, $ruta_db_superior;
		
		
			$dato=busca_filtro_tabla("","ft_ruta_distribucion A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);  //nombre tabla padre
			
		if($_REQUEST['tipo']!=5){
						
				echo '<a href="../funcionarios_ruta/adicionar_funcionarios_ruta.php?pantalla=padre&amp;idpadre='.$iddoc.'&amp;idformato='.$idformato.'&amp;padre='.$dato[0]['idft_ruta_distribucion'].'" target="_self">Mensajeros de la Ruta</a>'; //
		}
}


function mostrar_datos_funcionarios_ruta($idformato,$iddoc){
		global $conn, $ruta_db_superior;
		
		$tabla='';
		
		$dato=busca_filtro_tabla("","ft_ruta_distribucion A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);  //nombre tabla padre

		
		
		if($dato['numcampos']!=0){
								
			$tabla.='
						<table style="width:100%; border-collapse: collapse; text-align:center;" border="1">
						<tbody>
						<tr class="encabezado_list">
						    <td>Fecha</td>
						   
						    <td>Mensajero</td>
						    <td>Estado</td>
						    <td>Asignar Ruta</td>
						</tr>
			';
				
				$item=busca_filtro_tabla("","ft_funcionarios_ruta A, ft_ruta_distribucion B","idft_ruta_distribucion=ft_ruta_distribucion and A.ft_ruta_distribucion=".$dato[0]['idft_ruta_distribucion'],"",$conn);					
			

			if($item['numcampos']!=0){
				
			$estado=array(1=>"Activo",2=>"Inactivo");			

			for($j=$item['numcampos']-1;$j>=0;$j--){
                    $array_concat=array("nombres","' '","apellidos");
					$cadena_concat=concatenar_cadena_sql($array_concat);                    
                    $mensajero=busca_filtro_tabla($cadena_concat.' AS nombre','vfuncionario_dc','iddependencia_cargo='.$item[$j]['mensajero_ruta'],'',$conn);
                    
                            $seleccionar=array(1=>"",2=>"");
		                    $seleccionar[$item[$j]['estado_mensajero']]='selected';
	               
	               
							$boton_asginar_ruta='
								<button class="asignar_distribuciones" idft_ruta_distribucion="'.$dato[0]['idft_ruta_distribucion'].'" mensajero_ruta="'.$item[$j]['mensajero_ruta'].'" >
									<i class="icon-ok"></i>
								</button>
							';	
							if($item[$j]['estado_mensajero']==2){
								$boton_asginar_ruta='';
							}		   
				   
							$tabla.='		
									<tr>
										<td>'.$item[$j]['fecha_mensajero'].'</td>
										
									
										<td>'.$mensajero[0]['nombre'].'</td>
										<td><select class="cambio_estado" name="estado[]" data-idft="'.$item[$j]['idft_funcionarios_ruta'].'"  mensajero_ruta="'.$item[$j]['mensajero_ruta'].'" style="width:100px;">
                                              <option value="1" '.$seleccionar[1].'>Activo</option>
                                              <option value="2" '.$seleccionar[2].'>Inactivo</option>
                                        </select></td>
                                        <td>
                                        	'.$boton_asginar_ruta.'
                                        </td>
					                    </tr>
							';				

	
			
			}  //fin ciclo items
			
			
				$tabla.='	
					</tbody>
					</table><br>
					
				';	
				
				$tabla.='
					
					<script>
					$(document).ready(function(){
						$(".asignar_distribuciones").click(function(){
							var idft_ruta_distribucion=$(this).attr("idft_ruta_distribucion");
							var mensajero_ruta=$(this).attr("mensajero_ruta");
							$.ajax({
			                        type:"POST",
			                        url: "actualizar_mensajero_distribuciones_inactivas.php",
			                        data: {
			                        	idft_ruta_distribucion:idft_ruta_distribucion,
			                        	mensajero_ruta:mensajero_ruta
			                        },
			                        success: function(datos){
			                            notificacion_saia("Se ha asignado este mensajero a las distribuciones inactivas de la ruta","success","",4000);
										
			                        }
			                 }); 	
						});
						
						
						$(".cambio_estado").change(function(){
							var estado=$(this).val();
							var idft=$(this).attr("data-idft");
							var mensajero_ruta=$(this).attr("mensajero_ruta");
							$.ajax({
			                        type:"POST",
			                        url: "actualizar_estado_mensajeros.php",
			                        data: {
			                                        idft:idft,
			                                        estado:estado,
			                                        idft_ruta_distribucion:'.$dato[0]['idft_ruta_distribucion'].',
			                                        iddependencia_cargo_mensajero:mensajero_ruta
			                        },
			                        success: function(datos){
			                            notificacion_saia("Estado del funcionario actualizado correctamente","success","",4000);
										location.reload();
			                        }
			                    }); 	
			                	  			
						});				
					});
					</script>						
				';
									
				echo($tabla);	
			}
		} 
    
}

function crear_items_ruta_distribucion($idformato,$iddoc){
	global $conn, $ruta_db_superior;
    
    $datos=busca_filtro_tabla("","ft_ruta_distribucion","documento_iddocumento=".$iddoc,"",$conn);
    
    $dependencias=explode(",",$datos[0]['asignar_dependencias']);
    $mensajeros=explode(",",$datos[0]['asignar_mensajeros']);
    $fecha_almacenar=fecha_db_almacenar(date('Y-m-d'),'Y-m-d');
    for($i=0;$i<count($dependencias);$i++){
    	
		$busca_dep=busca_filtro_tabla("idft_dependencias_ruta,estado","ft_dependencias_ruta a,ft_ruta_distribucion b,documento c","lower(c.estado)='aprobado' AND b.documento_iddocumento=c.iddocumento AND a.ft_ruta_distribucion=b.idft_ruta_distribucion AND  a.estado_dependencia=1 AND a.ft_ruta_distribucion<>".$datos[0]['idft_ruta_distribucion']." AND a.dependencia_asignada=".$dependencias[$i],"",$conn);
		$estado_dependencia=1;
		if($busca_dep['numcampos']){
			$estado_dependencia=2;
		}
		
        $cadena="INSERT INTO ft_dependencias_ruta (fecha_item_dependenc,dependencia_asignada,estado_dependencia,ft_ruta_distribucion,orden_dependencia) VALUES (".$fecha_almacenar.",".$dependencias[$i].",".$estado_dependencia.",".$datos[0]['idft_ruta_distribucion'].",".($i+1).")";
        phpmkr_query($cadena);
    }
    for($i=0;$i<count($mensajeros);$i++){
        $cadena="INSERT INTO ft_funcionarios_ruta (fecha_mensajero,mensajero_ruta,estado_mensajero,ft_ruta_distribucion) VALUES (".$fecha_almacenar.",".$mensajeros[$i].",1,".$datos[0]['idft_ruta_distribucion'].")";
        phpmkr_query($cadena);
    }
}



function vincular_dependencia_ruta_distribucion($idformato,$iddoc){  //POSTERIOR AL APROBAR
	global $conn,$ruta_db_superior;
	
	$datos=busca_filtro_tabla("a.idft_ruta_distribucion,b.dependencia_asignada","ft_ruta_distribucion a, ft_dependencias_ruta b","b.estado_dependencia=1 AND a.idft_ruta_distribucion=b.ft_ruta_distribucion AND a.documento_iddocumento=".$iddoc,"",$conn);
	if($datos['numcampos']){
		include_once($ruta_db_superior."distribucion/funciones_distribucion.php");
		for($i=0;$i<$datos['numcampos'];$i++){		
			actualizar_dependencia_ruta_distribucion($datos[$i]['idft_ruta_distribucion'],$datos[$i]['dependencia_asignada'],1);			
		}		
	}
}

function validar_nombre_ruta_distribucion($idformato,$iddoc){ //ADICIONAR
	global $conn,$ruta_db_superior;
	?>
	<script>
		$(document).ready(function(){
			$('#nombre_ruta').blur(function(){
				$.ajax({
			        type: "POST",
			        dataType: 'json',
			        data: { 
			                nombre_ruta:$(this).val()
			              },
			        url: "validar_nombre_ruta_distribucion.php",
			        success : function(data) {
			        	if(data.existe){
			        		$('#nombre_ruta').val('');
			        		$('#nombre_ruta').focus();
			        		top.noty({text: '<b>ATENCI&Oacute;N</b><br>El nombre de la ruta ya existe!',type: 'warning',layout: 'topCenter',timeout:2500});
			        	}
			        }
			    }); 
				
			});
		});
	</script>
	<?php	
}


?>