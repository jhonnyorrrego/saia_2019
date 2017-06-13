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
echo(librerias_notificaciones());

function campo_fecha_ruta($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$dependencia_mensajeros=busca_filtro_tabla("iddependencia","dependencia","lower(nombre)='mensajeros' OR lower(nombre)='mensajero'","",$conn);
	$fecha=date('Y-m-d');
	?>
	<script>
	    $(document).ready(function(){
	       $('#fecha_ruta_distribuc').attr('readonly', true);
	       $('#fecha_ruta_distribuc').val('<?php echo $fecha;?>'); 
	       recargar=1;
	       tree_asignar_mensajeros.setOnLoadingEnd(recargar_arbol_asignar_mensajeros);
	       
	       function recargar_arbol_asignar_mensajeros(){
	       	<?php
	       		if($dependencia_mensajeros['numcampos']){
	       	?>
		       		if(recargar){
		       			recargar=0;
		       			tree_asignar_mensajeros.deleteItem('agrupador_<?php echo($dependencia_mensajeros[0]['iddependencia']); ?>');	
		       			tree_asignar_mensajeros.loadXML("<?php echo($ruta_db_superior); ?>test.php?iddependencia=<?php echo($dependencia_mensajeros[0]['iddependencia']); ?>&rol=1&agrupar=1");	       			
		       		}	   
	       	<?php       			
	       		}
	       	?>	    		
	       }
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
						    <td>Código</td>
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
										<td>'.$item[$j]['dependencia_asignada'].'</td>
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
										<td><select class="cambio_estado_dependencia" data-idft='.$item[$j]['dependencia_asignada'].' name="estado[]" style="width:100px;">
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
							$.ajax({
			                        type:"POST",
			                        url: "actualizar_estado_dependencias.php",
			                        data: {
			                                        idft:idft,
			                                        estado:estado
			                        },
			                        success: function(datos){
			                            notificacion_saia("Estado de la dependencia actualizado correctamente","success","",4000);
										location.reload();
			                        },
			                        error:function(){
			                        	alert("error consulta ajax");
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
						    <td>Código</td>
						    <td>Mensajero</td>
						    <td>Estado</td>
						</tr>
			';
				
				$item=busca_filtro_tabla("","ft_funcionarios_ruta A, ft_ruta_distribucion B","idft_ruta_distribucion=ft_ruta_distribucion and A.ft_ruta_distribucion=".$dato[0]['idft_ruta_distribucion'],"",$conn);					
			

			if($item['numcampos']!=0){
				
			$estado=array(1=>"Activo",2=>"Inactivo");			

			for($j=$item['numcampos']-1;$j>=0;$j--){
                    $array_concat=array("nombres","' '","apellidos");
					$cadena_concat=concatenar_cadena_sql($array_concat);                    
                    $mensajero=busca_filtro_tabla($cadena_concat.' AS nombre','vfuncionario_dc','iddependencia_cargo='.$item[$j]['mensajero_ruta'],'',conn);
                    
                            $seleccionar=array(1=>"",2=>"");
		                    $seleccionar[$item[$j]['estado_mensajero']]='selected';
	               
							$tabla.='		
									<tr>
										<td>'.$item[$j]['fecha_mensajero'].'</td>
										<td>'.$item[$j]['mensajero_ruta'].'</td>
									
										<td>'.$mensajero[0]['nombre'].'</td>
										<td><select class="cambio_estado" name="estado[]" data-idft="'.$item[$j]['idft_funcionarios_ruta'].'" style="width:100px;">
                                              <option value="1" '.$seleccionar[1].'>Activo</option>
                                              <option value="2" '.$seleccionar[2].'>Inactivo</option>
                                        </select></td>
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
						$(".cambio_estado").change(function(){
							var estado=$(this).val();
							var idft=$(this).attr("data-idft");
							$.ajax({
			                        type:"POST",
			                        url: "actualizar_estado_mensajeros.php",
			                        data: {
			                                        idft:idft,
			                                        estado:estado
			                        },
			                        success: function(datos){
			                            notificacion_saia("Estado del funcionario actualizado correctamente","success","",4000);
										location.reload();
			                        },
			                        error:function(){
			                        	alert("error consulta ajax");
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
        $cadena="INSERT INTO ft_dependencias_ruta (fecha_item_dependenc,dependencia_asignada,estado_dependencia,ft_ruta_distribucion,orden_dependencia) VALUES (".$fecha_almacenar.",".$dependencias[$i].",1,".$datos[0]['idft_ruta_distribucion'].",".($i+1).")";
        phpmkr_query($cadena);
    }
    for($i=0;$i<count($mensajeros);$i++){
        $cadena="INSERT INTO ft_funcionarios_ruta (fecha_mensajero,mensajero_ruta,estado_mensajero,ft_ruta_distribucion) VALUES (".$fecha_almacenar.",".$mensajeros[$i].",1,".$datos[0]['idft_ruta_distribucion'].")";
        phpmkr_query($cadena);
    }
}








?>