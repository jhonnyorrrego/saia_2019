<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once ($ruta_db_superior . "pantallas/qr/librerias.php");
include_once ($ruta_db_superior . "distribucion/funciones_distribucion.php");

/*ADICIONAR*/

function mostrar_radicado_entrada($idformato, $iddoc) {
	global $conn;
	$fecha = date('Y-m-d');
	if ($_REQUEST["iddoc"]) {
		$doc = busca_filtro_tabla("", "documento a", "iddocumento=" . $_REQUEST["iddoc"], "", $conn);
		echo '<td id="numero_radicado"><b>' . $doc[0]["numero"] . '</b></td>';
	} else {
		echo '<td id="numero_radicado">' . $fecha . "-<b>" . muestra_contador("radicacion_entrada") . '</b>-E</td>';
	}
}

/*EDITAR*/
function datos_editar_radicacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$datos=busca_filtro_tabla("","ft_radicacion_entrada","documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
    if($datos[0]['tipo_origen']==1){
        ?>
                <script>
                    $(document).ready(function(){
                        $('#tipo_origen1').parent().hide();
                        $('#tr_requiere_recogida').hide();
                        $('#area_responsable').parent().parent().hide();
                        $('#area_responsable').removeClass('required');
                        $('#destino').addClass('required');
                        $('#tr_tipo_destino').hide();
                        $('input:radio[name="tipo_destino"]').filter('[value="2"]').attr('checked', true);
                        $('#destino').parent().parent().show();
                        $('#copia_a').parent().parent().show();
                        $('#persona_natural_dest').parent().parent().hide();
                        $('#persona_natural_dest').removeClass('required');
                        $('#tr_tipo_mensajeria').hide();
                        $('[name="tipo_mensajeria"]').removeClass('required');
                        
                        //$('#fecha_oficio_entrada').addClass('required');
                        $('#fecha_oficio_entrada').removeClass('required');
                        $('#fecha_oficio_entrada').parent().parent().parent().show();
                        $('#numero_oficio').parent().parent().show();
                        $('#persona_natural').addClass('required');
                        $('#persona_natural').parent().parent().show();
                        
                        $('#numero_guia').parent().parent().show();
                    });
                </script>
        <?php
    }else{
        ?>
                    <script>        
                        $('#tipo_origen0').parent().hide();
                        
                        $('#area_responsable').parent().parent().show();
                        $('#area_responsable').addClass('required');
                        $('#tr_tipo_destino').show();
                        
                        $('#fecha_oficio_entrada').removeClass('required');
                        $('#fecha_oficio_entrada').parent().parent().parent().hide();
                        $('#numero_oficio').parent().parent().hide();
                        $('#persona_natural').removeClass('required');
                        $('#persona_natural').parent().parent().hide();
                        //$('#anexos_digitales').parent().parent().hide();
                        $('#tr_tipo_mensajeria').show();
                        $('[name="tipo_mensajeria"]').addClass('required');
                        
                        $('#numero_guia').parent().parent().hide();
                    </script>
        <?php
    }
    ?>
        <script>
            $(document).ready(function(){
                $('[name="tipo_destino"]').click(function(){
                    var tipo=$(this).val();
                    if(tipo==1){
                        $('#destino').removeClass('required');
                        $('#destino').parent().parent().hide();
                        $('#copia_a').parent().parent().hide();
                        $('#persona_natural_dest').parent().parent().show();
                        $('#persona_natural_dest').addClass('required');
                        
                    }else{
                        $('#destino').addClass('required');
                        $('#destino').parent().parent().show();
                        $('#copia_a').parent().parent().show();
                        $('#persona_natural_dest').parent().parent().hide();
                        $('#persona_natural_dest').removeClass('required');
                       
                    }
                });
            });
        </script>
    <?php
}

/*ADICIONAR-EDITAR*/

function quitar_descripcion_entrada($idformato,$iddoc){
	global $conn;
	?>
	<script>
	if($("#descripcion").val()=="Pendiente por llenar datos"){
		$("#descripcion").val("");
	}
	if($("#persona_natural").val()=="&nbsp;"){
		$("#persona_natural").val("");
	}
	if($("#destino").val()=="&nbsp;"){
		$("#destino").val("");
	}
	if($("#copia_a").val()=="&nbsp;"){
		$("#copia_a").val("");
	}
	$('#formulario_formatos').validate({
            submitHandler: function(form){
                var fecha = $("#fecha_oficio_entrada").val().split(" ");
				var f = new Date();
				var dia=f.getDate();
				var mes=(f.getMonth() +1);
				if(dia<10){
					dia='0'+dia;
				}
				if(mes<10){
					mes='0'+mes;
				}
				var fecha2=f.getFullYear() + "-" + mes + "-" + dia;
			
				if(fecha[0]>fecha2){
					$("#fecha_oficio_entrada").after("<font color='red'>La fecha es mayor a la de hoy</font>");
					$("#fecha_oficio_entrada").focus();
					$('#continuar').css('display','inherit');						
					$('#continuar').next('input').hide();					
					return false;
				}
				var destinos=$("#destino").val();
				$.post("contar_funcionarios.php",{destino:destinos},function(respuesta){
					if(respuesta==1){
						var confirmacion=confirm("Esta seguro de transferir el documento a los destinos seleccionadas?");
						if(!confirmacion){
						    $('#continuar').css('display','inherit');                       
                            $('#continuar').next('input').hide();
                            return false;
                        }
					}
					var copia=$("#copia_a").val();
                    $.post("contar_funcionarios.php",{destino:copia},function(respuesta){
                        if(respuesta==1){
                            var confirmacion=confirm("Esta seguro de transferir el documento con copia a las personas seleccionadas?");
                            if(!confirmacion){
                                $('#continuar').css('display','inherit');                       
                                $('#continuar').next('input').hide();
                                return false;
                            }
                        }
                        form.submit();
                    });
				});
            }        
        });
	</script>
	<?php
}

function serie_documental_radicacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	
	
	$dependencia_maestra=busca_filtro_tabla("iddependencia","dependencia","cod_padre=0 OR cod_padre IS NULL","",$conn);
	
	$dependencia_actual=busca_filtro_tabla("iddependencia","vfuncionario_dc","estado_dep=1 AND estado_dc=1 AND funcionario_codigo=".usuario_actual("funcionario_codigo"),"",$conn);
	$dependencia_principal=buscar_dependencias_principal($dependencia_actual[0]["iddependencia"]);
	$primeros_hijos=busca_filtro_tabla("iddependencia","dependencia","cod_padre=".$dependencia_principal,"",$conn);
	
	for($i=0;$i<$primeros_hijos['numcampos'];$i++){
	    $arreglo[]=$primeros_hijos[$i]['iddependencia'];
	}
	$cargo='"'.implode('","',$arreglo).'"';
	?>
	<script>
	$(document).ready(function(){
		tree_serie_idserie.setOnCheckHandler(onNodeSelect_dependencia_serie);
		
		function onNodeSelect_dependencia_serie(nodeId){
			tree_serie_idserie.setCheck(tree_serie_idserie.getAllChecked(),0 );
			tree_serie_idserie.setCheck(nodeId,1 );
			var ids=nodeId.split("sub");
			var idserie=ids[1];
			$('#serie_idserie').val(idserie);
			
		}
	    var dependencia_principal='<?php echo($dependencia_principal); ?>';
	    var cargado=[<?php echo($cargo); ?>];
	    cargado.push(dependencia_principal);

	    tree_destino.setOnCheckHandler(onNodeSelect);
	    
        function onNodeSelect(nodeId){
        	
        	var seleccionados=tree_destino.getAllChecked();
        	
	        var numeral=nodeId.indexOf("#");
	        
	        if(numeral>=0){
	            var padre=tree_destino.getParentId(nodeId);
	            padre=padre.replace("#","");
	            var dependencia=nodeId.replace("#","");
	        }else{
	            
	            var dependencia=tree_destino.getParentId(nodeId);
	            var padre=tree_destino.getParentId(dependencia);
	            
	            if(padre==0){  //SOLO PARA SU ORGANIZACION
	                padre='<?php echo($dependencia_maestra[0]['iddependencia']); ?>';
	            }
	            
	            padre=padre.replace("#","");
	            dependencia=dependencia.replace("#","");
	        }
	        
	       var parametro_adicional='';
	       if(dependencia=='<?php echo($dependencia_maestra[0]['iddependencia']); ?>'){
	           parametro_adicional='&carga_partes_dependencia=1';
	       }
	       
	       tree_serie_idserie.setXMLAutoLoading("<?php echo($ruta_db_superior); ?>test_dependencia_serie.php?tabla=dependencia&mostrar_nodos=dsa&sin_padre_dependencia=1&estado=1&cargar_series=1&carga_partes_serie=1&iddependencia="+dependencia+parametro_adicional);
	       tree_serie_idserie.smartRefreshItem("d"+padre);  
	       tree_serie_idserie.openItem( "d"+padre ); //ARBOL: expande nodo hasta el item indicado
	       
        }
        
        $('#tipo_origen1').click(function(){
            var dependencia=$('#dependencia').val();
            tree_serie_idserie.setOnLoadingEnd(obtener_dependencia(dependencia));
            
            function obtener_dependencia(rol){
                $.ajax({
                    type:'POST',
                    dataType: 'json',
                    url: "obtener_dependencia.php",
                    data: {
                     iddependencia_cargo:rol
                    },
                    async: false,
                    success: function(datos){
                        var x = Math.floor((Math.random() * 100000) + 1);
                        cargado.push(datos[1]);
                    }
                });  
            }
        });
        
	});
        
    </script>
    <?php
}
												
function buscar_dependencias_principal($iddependencia){
	$cod_dep=busca_filtro_tabla("cod_padre","dependencia","cod_padre is not null and iddependencia=".$iddependencia,"",$conn);
	
	if($cod_dep['numcampos']){
	    return(buscar_dependencias_principal($cod_dep[0]["cod_padre"]));
	}else{
		return($iddependencia);
	}
}
												
function tipo_radicado_radicacion($idformato,$iddoc){//en el adicionar
	global $conn,$ruta_db_superior;
    $funcionario_codigo=usuario_actual('funcionario_codigo');
    $cargo=busca_filtro_tabla("iddependencia,iddependencia_cargo","vfuncionario_dc a","estado_dc=1 AND a.funcionario_codigo=".$funcionario_codigo,"",$conn);
    $lista_iddependencia_cargo=implode(',',(extrae_campo($cargo,'iddependencia_cargo')));
	$dependencia_principal=buscar_dependencias_principal($cargo[0]["iddependencia"]);

	?>
        <script>
            $(document).ready(function(){
                var dependencia_principal='<?php echo($dependencia_principal); ?>';
                tipo_origen($("input:radio[name=tipo_origen]:checked").val());
                tipo_destino($("input:radio[name=tipo_destino]:checked").val());
                
                
                $('[name="tipo_origen"]').click(function(){
                    tipo_origen($(this).val());
                });
                
                $('[name="tipo_destino"]').click(function(){
                    tipo_destino($(this).val());
                });
                
		            $("[name='requiere_recogida']").change(function (){
		            	if($(this).val()==1){
		            		$("[name='tipo_mensajeria'][value=3]").attr("checked",false);
		            		$("[name='tipo_mensajeria'][value=3]").attr("disabled",true);
		            	}else{
		            		$("[name='tipo_mensajeria'][value=3]").attr("disabled",false);
		            	}
		            });
		            $("[name='requiere_recogida']:checked").trigger("change");
                
                
                <?php
                $permiso_mod=new Permiso();
		        $ok_permiso_radicacion_externa=$permiso_mod->acceso_modulo_perfil("permiso_radicacion_externa");
		        if(!$ok_permiso_radicacion_externa){
		            ?>
		            $('#tipo_origen0').parent().hide();
		            $('#tipo_origen1').attr('checked',true);
		            $('[name="tipo_origen"]').click();
		            tipo_origen(2);
		            <?php
		        }
                ?>
                
            });
            function tipo_origen(tipo){
                if(tipo==1){   //EXTERNO
                	$('#tr_requiere_recogida').hide();
                	
                	$('#empresa_transportado').parent().parent().show();
                	
                    $('[name="tipo_radicado"]').val('radicacion_entrada');
                    seleccionar_interno_actual(0);    
                    $('#area_responsable').parent().parent().hide();
                    $('#area_responsable').removeClass('required');
                    $('#destino').addClass('required');
                    $('#tr_tipo_destino').hide();
                    $('input:radio[name="tipo_destino"]').filter('[value="2"]').attr('checked', true);
                    $('#destino').parent().parent().show();
                    $('#copia_a').parent().parent().show();
                    $('#persona_natural_dest').parent().parent().hide();
                    $('#persona_natural_dest').removeClass('required');
                    $('#tr_tipo_mensajeria').hide();
                    $('[name="tipo_mensajeria"]').removeClass('required');
                        
                    //$('#fecha_oficio_entrada').addClass('required');
                    $('#fecha_oficio_entrada').removeClass('required');
                    $('#fecha_oficio_entrada').parent().parent().parent().show();
                    $('#numero_oficio').parent().parent().show();
                    $('#persona_natural').addClass('required');
                    $('#persona_natural').parent().parent().show();
                    //$('#anexos_digitales').parent().parent().show();
                    $('#numero_guia').parent().parent().show();
                    
                }else{ //INTERNO
                	$('#tr_requiere_recogida').show();
                	
                	$('#empresa_transportado').parent().parent().hide();
                
                    seleccionar_interno_actual(1);
                
                    $('[name="tipo_radicado"]').val('radicacion_salida');
                    $('[name="area_responsable"]').parent().parent().show();
                    $('#area_responsable').addClass('required');
                    $('#tr_tipo_destino').show();
                        
                    $('#fecha_oficio_entrada').removeClass('required');
                    $('#fecha_oficio_entrada').parent().parent().parent().hide();
                    $('#numero_oficio').parent().parent().hide();
                    $('#persona_natural').removeClass('required');
                    $('#persona_natural').parent().parent().hide();
                    //$('#anexos_digitales').parent().parent().hide();
                    $('#tr_tipo_mensajeria').show();
                    $('[name="tipo_mensajeria"]').addClass('required');
                                          
                    $('#numero_guia').parent().parent().hide();
                 }
	                  $.ajax({
	                      type:'POST',
	                      dataType: 'json',
						  async:false,
	                      url: "tipo_contador.php",
	                      data: {
	                          tipo_radicacion:tipo
	                      },
	                      success: function(datos){
	                          $('#numero_radicado').html(datos[0]);
	                      }
	                 });                   
            }
            function tipo_destino(tipo){
                if(tipo==1){
                        $('#destino').removeClass('required');
                        $('#destino').parent().parent().hide();
                        $('#copia_a').parent().parent().hide();
                        $('#persona_natural_dest').parent().parent().show();
                        $('#persona_natural_dest').addClass('required');
                        //$('#tipo_mensajeria0').parent().show();
                        
                        
                        refrescar_arbol_tipo_documental_funcionario_responsable();
                         
                    }else{
                        $('#destino').addClass('required');
                        $('#destino').parent().parent().show();
                        $('#copia_a').parent().parent().show();
                        $('#persona_natural_dest').parent().parent().hide();
                        $('#persona_natural_dest').removeClass('required');
                        //$('#tipo_mensajeria0').parent().hide();
                        
                        
                    }
            }
            
            tree_area_responsable.setOnCheckHandler(refrescar_arbol_tipo_documental_funcionario_responsable);
			        	
            function refrescar_arbol_tipo_documental_funcionario_responsable(){
				<?php 
				$dependencia_maestra=busca_filtro_tabla("iddependencia","dependencia","cod_padre=0 OR cod_padre IS NULL","",$conn);
				?>            	
            	if($("input:radio[name=tipo_origen]:checked").val()==2 && $("input:radio[name=tipo_destino]:checked").val()==1){
            		
            	
						var seleccionado=tree_area_responsable.getAllChecked();
			        	seleccionado=parseInt(seleccionado);
			        	if(seleccionado){
			        		var dependencia=tree_area_responsable.getParentId(seleccionado);
				            var padre=tree_area_responsable.getParentId(dependencia);

            	            if(padre==0){  //SOLO PARA SU ORGANIZACION
            	                padre='<?php echo($dependencia_maestra[0]['iddependencia']); ?>';
            	            }				            
				            
				            padre=padre.replace("#","");
				            dependencia=dependencia.replace("#","");

                	       var parametro_adicional='';
                	       if(dependencia=='<?php echo($dependencia_maestra[0]['iddependencia']); ?>'){
                	           parametro_adicional='&carga_partes_dependencia=1';
                	       }				            
				            
                	       tree_serie_idserie.setXMLAutoLoading("<?php echo($ruta_db_superior); ?>test_dependencia_serie.php?tabla=dependencia&mostrar_nodos=dsa&sin_padre_dependencia=1&estado=1&cargar_series=1&carga_partes_serie=1&iddependencia="+dependencia+parametro_adicional);
                	       tree_serie_idserie.smartRefreshItem("d"+padre);  
                	       tree_serie_idserie.openItem( "d"+padre ); //ARBOL: expande nodo hasta el item indicado	
			        	}  
			     }  	           
            
            }
            
            
            
            function seleccionar_interno_actual(seleccionar){

                if(seleccionar){
                   seleccion_reponsable_actual();
                   tree_area_responsable.setOnLoadingEnd(seleccion_reponsable_actual);
                }else{
                    tree_area_responsable.setCheck(tree_area_responsable.getAllChecked(),false);
                    tree_area_responsable.closeAllItems(); //ARBOL: cierra todo el arbol
                    $('#area_responsable').val('');                    
                }
            }
            
            
            function seleccion_reponsable_actual(){
                    var lista_iddependencia_cargo='<?php echo($lista_iddependencia_cargo); ?>';
                    var vector_iddependencia_cargo=lista_iddependencia_cargo.split(',');
                   
                    var sin_open=undefined;
                    
                    var iddependencia_cargo=parseInt(vector_iddependencia_cargo[0]);
                    sin_open=tree_area_responsable.openItem(iddependencia_cargo); //ARBOL: expande nodo hasta el item indicado
                    tree_area_responsable.setCheck(iddependencia_cargo,true);
                    
                    var str = tree_area_responsable.getAllChecked();
                    
                    var long=str.length;
                    for(i=0;i<long;i++){
                        str = str.replace(",", "");
                    }
                    $('#area_responsable').val(str); 
            }
        </script>
    <?php
}


/*MOSTRAR*/
function llenar_datos_funcion($idformato, $iddoc) {
	global $conn,$datos;
	$datos = busca_filtro_tabla("ft.*,d.estado,d.tipo_radicado", "ft_radicacion_entrada ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=" . $iddoc, "", $conn);
	if ($datos[0]["estado"] == 'INICIADO') {
		$sql = "UPDATE ft_radicacion_entrada SET tipo_origen=" . $datos[0]['tipo_radicado'] . " WHERE documento_iddocumento=" . $iddoc;
		phpmkr_query($sql);
		$texto = '<br><br><button class="btn btn-mini btn-warning" onclick="window.location=\'editar_radicacion_entrada.php?iddoc=' . $iddoc . '&idformato=' . $idformato . '\';">Llenar datos</button>';
		echo $texto;
	}
}

function mostrar_informacion_general_radicacion($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$datos = busca_filtro_tabla("serie_idserie,descripcion,descripcion_anexos,descripcion_general,tipo_origen,numero_oficio," . fecha_db_obtener("fecha_oficio_entrada", "Y-m-d") . " AS fecha_oficio_entrada," . fecha_db_obtener("fecha_radicacion_entrada", "Y-m-d") . " AS fecha_radicacion_entrada,numero_guia,empresa_transportado,requiere_recogida,tipo_mensajeria", "ft_radicacion_entrada", "documento_iddocumento=" . $iddoc, "", $conn);

	$documento = busca_filtro_tabla("numero,tipo_radicado," . fecha_db_obtener("fecha", "Y-m-d") . " AS fecha", "documento", "iddocumento=" . $iddoc, "", $conn);
	$tipo_documento = busca_filtro_tabla("nombre", "serie", "idserie=" . $datos[0]["serie_idserie"], "", $conn);
	$anexos = busca_filtro_tabla("etiqueta", "anexos", "documento_iddocumento=" . $iddoc, "", $conn);
	$nombre_anexos = '';
	$fecha_radicacion = $documento[0]['fecha'];
	if ($documento[0]['tipo_radicado'] == 1) {
		$tipo = "E";
	} else {
		$tipo = "I";
	}
	$numero_radicado = $datos[0]['fecha_radicacion_entrada'] . "-" . $documento[0]['numero'] . "-" . $tipo;

	for ($i = 0; $i < $anexos['numcampos']; $i++) {
		$nombre_anexos .= $anexos[$i]['etiqueta'];
		if ($i < $anexos['numcampos'] - 1) {
			$nombre_anexos .= ', ';
		}
	}

	$img = mostrar_codigo_qr($idformato, $iddoc, true);

	$tabla = '<table class="table table-bordered" style="width: 100%; text-align:left;" border="1">
  <tr>
    <td style="width: 23%;"><b>Fecha de radicaci&oacute;n:</b></td>
    <td style="width: 18%;">' . $fecha_radicacion . '</td>
    <td style="width: 18%;"><b>No. Radicado:</b></td>
    <td style="width: 18%;">' . $numero_radicado . '</td>
    <td style="text-align:center; width: 23%;" colspan="2" rowspan="3">' . $img . '</td>
  </tr>
  <tr>
    <td><b>Tipo de documento:</b></td>
    <td colspan="3">' . $tipo_documento[0]["nombre"] . '</td> 
  </tr>
  <tr>
    <td><b>Descripci&oacute;n o asunto:</b></td>
    <td colspan="3">' . $datos[0]["descripcion"] . '</td>
  </tr>
  </table>
  <table class="table table-bordered" style="width: 100%; font-size:10px; text-align:left;" border="1">';
	if ($datos[0]['tipo_origen'] == 1) {
		$empresa_transportadora = mostrar_valor_campo('empresa_transportado', $idformato, $iddoc, 1);
		$tabla .= "<tr>
      <td style='width:25%;'><strong>N&uacute;mero Oficio:</strong></td>
      <td colspan='2' style='width:25%;'>" . $datos[0]['numero_oficio'] . "</td>
      <td style='width:25%;'><strong>Fecha Oficio:</strong></td>
      <td colspan='2' style='width:25%;'>" . $datos[0]['fecha_oficio_entrada'] . "</td>
   </tr>
   <tr>
      <td><strong>N&uacute;mero Gu&iacute;a:</strong></td>
      <td colspan='2'>" . $datos[0]['numero_guia'] . "</td>
      <td><strong>Empresa Transportadora:</strong></td>
      <td colspan='2'>" . $empresa_transportadora . "</td>
   </tr>";
	} else {
		$recogida = ($datos[0]["requiere_recogida"] == 1) ? "Si" : "No";
		$entrega = ($datos[0]["tipo_mensajeria"] == 1) ? "Si" : "No";
		$tabla .= "<tr>
      <td style='width:25%;'><strong>Requiere servicio de recogida?:</strong></td>
      <td colspan=2 style='width:25%;'>" . $recogida . "</td>
      <td style='width:25%;'><strong>Requiere servicio de entrega?:</strong></td>
      <td colspan=2 style='width:25%;'>" . $entrega . "</td>
   </tr>";
	}

	$tabla .= '
	  <tr>
	    <td><b>Anexos digitales:</b></td>
	    <td colspan="2">' . $nombre_anexos . '</td>
	    <td><b>Anexos F&iacute;sicos:</b></td>
	    <td colspan="2">' . $datos[0]["descripcion_anexos"] . '</td>
	  </tr>';
	$tabla .= '</table>';
	echo $tabla;
}

function obtener_informacion_proveedor($idformato, $iddoc) {
	global $conn, $datos;
	if ($datos[0]['tipo_origen'] == 1) {
		$info = busca_filtro_tabla("", "datos_ejecutor B, ejecutor C", "B.ejecutor_idejecutor=C.idejecutor AND B.iddatos_ejecutor=" . $datos[0]["persona_natural"], "", $conn);
		if ($info["numcampos"]) {
			$texto = array();
			$texto[] = "<b>Nombre:</b> " . $info[0]["nombre"];
			$texto[] = "<b>Identificaci&oacute;n:</b> " . $info[0]["identificacion"];
			if($info[0]["cargo"]){
				$texto[] = "<b>Cargo:</b> " . $info[0]["cargo"];
			}
			if($info[0]["empresa"]){
				$texto[] = "<b>Empresa:</b>" . $info[0]["empresa"];
			}
			echo(implode(", &nbsp;", $texto));
		}
	} else {
		$array_concat = array(
			"nombres",
			"' '",
			"apellidos"
		);
		$cadena_concat = concatenar_cadena_sql($array_concat);
		$origen = busca_filtro_tabla($cadena_concat . " AS nombre, dependencia, cargo", "vfuncionario_dc", "iddependencia_cargo IN(" . $datos[0]['area_responsable'] . ")", "", $conn);
		if ($origen["numcampos"]) {
			$texto = array();
			$texto[] = "<b>Nombre:</b> " . $origen[0]["nombre"];
			$texto[] = "<b>Dependencia:</b> " . $origen[0]["dependencia"];
			$texto[] = "<b>Cargo:</b> " . $origen[0]["cargo"];
			echo(implode("<br />", $texto));
		}
	}
}

function mostrar_item_destino_radicacion($idformato, $iddoc) {
	global $conn;
	echo mostrar_listado_distribucion_documento($idformato, $iddoc, 1);
}

function mostrar_copia_electronica($idformato, $iddoc) {
	global $conn, $datos;
	$tabla = "";
	if ($datos[0]['tipo_destino'] == 2) {//INTERNO
		$info = mostrar_valor_campo('copia_a', $idformato, $iddoc, 1);
		if ($info) {
			$tabla = '<table class="table table-bordered" style="width: 100%;" border="1">';
			$tabla .= '<tr><td><b>Copia Electr&oacute;nica a:</b></td> <td>' . $info . '</td></tr>';
			$tabla .= '</table>';
		}
	}
	echo $tabla;
}

/*POSTERIOR EDITAR*/
function cambiar_estado($idformato, $iddoc) {
	global $conn;
	$doc = busca_filtro_tabla("estado", "documento A", "iddocumento=" . $iddoc, "", $conn);
	if ($doc[0]["estado"] == 'INICIADO') {
		$sql1 = "UPDATE documento SET estado='APROBADO' WHERE iddocumento=" . $iddoc;
		phpmkr_query($sql1);
		post_aprobar_rad_entrada($idformato, $iddoc);
	}
}

/*POSTERIOR APROBAR*/
function post_aprobar_rad_entrada($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	if ($_REQUEST["radicacion_rapida"] == 1) {
		$sql1 = "UPDATE documento SET estado='INICIADO' WHERE iddocumento=" . $iddoc;
		phpmkr_query($sql1);
	} else {
		ingresar_item_destino_radicacion($idformato, $iddoc);
		actualizar_campos_documento($idformato, $iddoc);
		actualizar_datos_documento($idformato, $iddoc);

		$datos = busca_filtro_tabla("d.estado,ft.tipo_mensajeria,ft.idft_radicacion_entrada,ft.destino,ft.tipo_origen,ft.tipo_destino,ft.descripcion", "ft_radicacion_entrada ft,documento d", "ft.documento_iddocumento=d.iddocumento and d.iddocumento=" . $iddoc, "", $conn);
		if ($datos[0]['tipo_destino'] == 2) {//INTERNO
			transferencia_automatica($idformato, $iddoc, "destino", 2);
		}
		transferencia_automatica($idformato, $iddoc, "copia_a", 2, '', 'COPIA');
		$sql1 = "UPDATE ft_radicacion_entrada SET despachado=1 WHERE documento_iddocumento=" . $iddoc;
		phpmkr_query($sql1);

		if ($datos[0]['tipo_mensajeria'] == 3) {// Entrega Personal/Medios Propios
			$tipo_destino = busca_filtro_tabla("tipo_destino,destino", "distribucion", "documento_iddocumento=" . $iddoc, "", $conn);
			for ($i = 0; $i < $tipo_destino['numcampos']; $i++) {
				if ($tipo_destino[$i]['tipo_destino'] == 1) {
					transferencia_automatica($idformato, $iddoc, $tipo_destino[$i]['destino'], 1);
				}
			}
		}

		if ($_REQUEST["digitalizacion"] == 1) {
			$enlace = "paginaadd.php?key=" . $iddoc . "&enlace2=formatos/radicacion_entrada/detalles_mostrar_radicacion_entrada.php?iddoc=" . $iddoc;
			abrir_url($ruta_db_superior . "colilla.php?target=_self&key=" . $iddoc . "&enlace=" . $enlace, "_self");
			die();
		} else if ($_REQUEST["digitalizacion"] == 0) {
			$enlace = "ordenar.php?key=" . $iddoc . "&accion=mostrar&mostrar_formato=1";
			abrir_url($ruta_db_superior . "colilla.php?target=_self&key=" . $iddoc . "&enlace=" . $enlace, '_self');
			die();
		}
	}
}

function ingresar_item_destino_radicacion($idformato, $iddoc) {//posterior al adicionar - editar
	global $conn, $ruta_db_superior;
	$datos = busca_filtro_tabla("a.tipo_origen,a.tipo_destino,a.tipo_mensajeria,a.requiere_recogida", "ft_radicacion_entrada a, documento b", " lower(b.estado)<>'iniciado' AND a.documento_iddocumento=b.iddocumento AND  a.documento_iddocumento=" . $iddoc, "", $conn);
	//area_responsable --->  origen
	//persona_natural ---> origen_externo
	//destino ---> destino
	//persona_natural_dest ---> destino_externo
	if ($datos['numcampos']) {
		$estado_distribucion = 1;
		if ($datos[0]['tipo_mensajeria'] == 3) {
			$estado_distribucion = 3;
		}

		if ($datos[0]['tipo_origen'] == 2 && $datos[0]['tipo_destino'] == 2) {//INT - INT
			if ($datos[0]['tipo_mensajeria'] != 3 && !$datos[0]['requiere_recogida']) {//no quiere recogida
				pre_ingresar_distribucion($iddoc, 'area_responsable', 1, 'destino', 1, 0, 1);
				//INT -INT
			} else {
				pre_ingresar_distribucion($iddoc, 'area_responsable', 1, 'destino', 1, $estado_distribucion);
				//INT -INT
			}
		}

		if ($datos[0]['tipo_origen'] == 2 && $datos[0]['tipo_destino'] == 1) {//INT - EXT
			if ($datos[0]['tipo_mensajeria'] != 3 && !$datos[0]['requiere_recogida']) {//no quiere recogida
				pre_ingresar_distribucion($iddoc, 'area_responsable', 1, 'persona_natural_dest', 2, 0, 1);
				//INT -EXT
			} else {
				pre_ingresar_distribucion($iddoc, 'area_responsable', 1, 'persona_natural_dest', 2, $estado_distribucion);
				//INT -EXT
			}
		}
		if ($datos[0]['tipo_origen'] == 1 && $datos[0]['tipo_destino'] == 2) {//EXT - INT
			pre_ingresar_distribucion($iddoc, 'persona_natural', 2, 'destino', 1, $estado_distribucion);
		}
	}
	return;
}

function actualizar_campos_documento($idformato, $iddoc) {
	global $conn;
	$datos = busca_filtro_tabla("persona_natural,anexos_fisicos,numero_oficio,numero_oficio,descripcion_anexos,fecha_oficio_entrada", "ft_radicacion_entrada A", "A.documento_iddocumento=" . $iddoc, "", $conn);
	if ($datos["numcampos"]) {
		$campo_formato = busca_filtro_tabla("A.valor", "campos_formato A", "A.formato_idformato=" . $idformato . " AND A.nombre='anexos_fisicos'", "", $conn);
		$valores = array();
		if ($campo_formato["numcampos"]) {
			$filas = explode(";", $campo_formato[0]["valor"]);
			$cant1 = count($filas);
			for ($i = 0; $i < $cant1; $i++) {
				$datos2 = explode(",", $filas[$i]);
				$valores[$datos2[0]] = $datos2[1];
			}
		}
		if ($datos[0]["persona_natural"]) {
			$ejecutor = busca_filtro_tabla("ciudad", "datos_ejecutor A, ejecutor B", "A.ejecutor_idejecutor=B.idejecutor AND iddatos_ejecutor=" . $datos[0]["persona_natural"], "", $conn);
		}
		$sql1 = "UPDATE documento SET oficio='" . $datos[0]["numero_oficio"] . "', anexo='" . $valores[$datos[0]["anexos_fisicos"]] . "', descripcion_anexo='" . $datos[0]["descripcion_anexos"] . "', fecha_oficio=" . fecha_db_almacenar($datos[0]["fecha_oficio_entrada"], 'Y-m-d H:i:s') . ", municipio_idmunicipio='" . $ejecutor[0]["ciudad"] . "' WHERE iddocumento=" . $iddoc;
		phpmkr_query($sql1);
	}
	return;
}
?>
