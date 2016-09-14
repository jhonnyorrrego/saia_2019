<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
  

include_once($ruta_db_superior."db.php");


include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");

echo(estilo_bootstrap());



echo(librerias_jquery("1.7"));

  
echo(librerias_bootstrap());
echo(librerias_datepicker_bootstrap());
echo(librerias_notificaciones());


$paso=busca_filtro_tabla("A.nombre_paso, B.*","paso A, paso_actividad B","A.idpaso=B.paso_idpaso AND A.idpaso=".$_REQUEST["idpaso"]." AND B.estado=1","B.orden",$conn);


if($paso["numcampos"]){
  $nombre_paso=$paso[0]["nombre_paso"];
}
else{
  $paso2=busca_filtro_tabla("","paso","idpaso=".$_REQUEST["idpaso"],"",$conn);
  $nombre_paso=$paso2[0]["nombre_paso"];
}


?>
<style>
  .detalle_cargo legend{
    border-bottom: 0px;
    cursor:hand;
  }
</style>



Actividades del paso: <b> <?php echo($nombre_paso); ?></b><br>



<?php 
$texto='';
$texto.='<br><div><b><a href="'.$ruta_db_superior.'bpmn/paso/adicionar_actividades_paso.php?idpaso='.$_REQUEST["idpaso"].'"><i class="icon-plus"></i> Adicionar actividades del paso</a></b></div><br>';



if($paso["numcampos"]){
		
	
	$texto.='<table class="table">';
	$texto.='<thead><tr><th>Descripci&oacute;n</th><th>Responsable</th><th>Acciones</th><th>&nbsp;</th></tr></thead>';
	
	
	
	
	
	for($i=0;$i<$paso["numcampos"];$i++){
		
		
		
		$dato_usuarios=array();
		$texto_usuario='';
    $icono_tipo_actividad='';
    //Valida que la llave del usuario sea -1 para que aplique a cualquier funcionario
    if($paso[$i]["llave_entidad"]==-1){
      $usuarios["numcampos"]=1;
      $usuarios[0]["nombres"]='Cualquier usuario';
      $usuarios[0]["apellidos"]='';
      $usuarios[0]["cargo"]='Cualquier Usuario';
      $cargo["numcampos"]=0;
	 
	  
    }
    elseif($paso[$i]["llave_entidad"]==-2){
      $usuarios["numcampos"]=1;
      $usuarios[0]["nombres"]='Tomado de un Campo ';
      $usuarios[0]["apellidos"]='';
      $usuarios[0]["cargo"]='Tomado de un Campo ';
      $cargo["numcampos"]=0;        
    }
    else{
    	
		
      $usuarios=listado_funcionarios($paso[$i]["entidad_identidad"],$paso[$i]["llave_entidad"]);
      $cargo=busca_filtro_tabla("","cargo","idcargo IN(".$paso[$i]["llave_entidad"].")","",$conn);
      if($cargo["numcampos"]){
        $tipo_cargo=($cargo[0]["tipo_cargo"]==2)?" funcional ":" administrativo ";
      }  
    }
		if($usuarios["numcampos"]){
			for($j=0;$j<$usuarios["numcampos"];$j++){
				array_push($dato_usuarios,'<div class="detalle_cargo" tipo_actividad="4" idcargo="'.$usuarios[$j]["idcargo"].'"><legend>'.$usuarios[$j]["cargo"].'</legend></div>');
			}
      if($cargo["numcampos"]){
        $texto_usuario='<div class="detalle_cargo" tipo_actividad="4" idcargo="'.$cargo[0]["idcargo"].'"><legend>'.$cargo[0]["nombre"].'</legend></div>';
      }
      else{
        $texto_usuario=implode(", ",$dato_usuarios);
      }
		}
		else{
			$texto_usuario='<div class="badge badge-important">Usuarios no encontrados con el cargo '.$tipo_cargo.'<br>'.$cargo[0]["nombre"].'</div>';
		}
		//paso tipo=1 del sistema ; 0  manual.
		if($paso[$i]["tipo"]){
		  $icono_tipo_actividad.='<a  class="tooltip_saia" title="actividad del sistema"><i class="icon-cog actividad" tipo_actividad="1" idactividad="'.$paso[$i]["idpaso_actividad"].'" id="actividad_'.$paso[$i]["idpaso_actividad"].'"></i></a>';
		  $adicional_actividad=array();
		  if($usuarios["numcampos"]>2){
				array_push($adicional_actividad, "Existen varios funcionarios con el mismo cargo.");		  
		  }
		  if($paso[$i]["formato_idformato"] && $paso[$i]["llave_entidad"]!=-1){
			  $formato=busca_filtro_tabla("","formato","idformato=".$paso[$i]["formato_idformato"],"",$conn);
			  $permiso=new PERMISO();
			  $permiso->asignar_usuario($usuarios[0]["login"]);
			  $ok=$permiso->permiso_usuario($formato[0]["nombre"],1);
			  
			  if(!$ok){
				  array_push($adicional_actividad, "El usuario principal no cuenta con permisos en el formato");
			  }
		  }
		  if($paso[$i]["accion_idaccion"]){
		    //se obtienen los datos del modulo para mostrar la imagen de la accion
		    $accion=busca_filtro_tabla("B.imagen,A.etiqueta, B.enlace","accion A, modulo B","A.modulo_idmodulo=B.idmodulo AND A.idaccion=".$paso[$i]["accion_idaccion"],"",$conn);
		    if($accion["numcampos"]){
		      $icono_tipo_actividad.='<a border="0" class="tooltip_saia" title="'.$accion[0]["etiqueta"].'"><img src="'.$ruta_db_superior.$accion[0]["imagen"].'"></a>';
		    }
		    $texto_adicional_actividad='';
		    //print_r($adicional_actividad);
		    if(count($adicional_actividad)){
			    $texto_adicional_actividad='<ul><li>';
			    $texto_adicional_actividad.=implode('</li><li>', $adicional_actividad);
			    $texto_adicional_actividad.='</li></ul>';
				$icono_tipo_actividad.='<a border="0" class="tooltip_saia" title="'.$texto_adicional_actividad.'"><i class="icon-warning-sign"></i></a>';
		    }
		  }
		}
		else{
			$icono_tipo_actividad.='<a class="actividad tooltip_saia" title="actividad manual" tipo_actividad="2" idactividad="'.$paso[$i]["idpaso_actividad"].'" id="actividad_'.$paso[$i]["idpaso_actividad"].'"><i class="icon-user"></i></a>';
		}   
    $icono_editar='<a href="'.$ruta_db_superior.'bpmn/paso/editar_actividades_paso.php?idpaso_actividad='.$paso[$i]["idpaso_actividad"].'"><i class="icon-edit"></i></a>';
		$texto.='<tr><td>'.$paso[$i]["descripcion"].'</td><td>'.$texto_usuario.'</td><td>'.$icono_tipo_actividad.'</td><td>'.$icono_editar.'</td><td>  <span name="eliminar_actividad" valor="'.$paso[$i]["idpaso_actividad"].'" style="cursor:pointer;"><i class="icon-remove" ></i> </span></td></tr>';
		

		
	}
	$texto.='</table>';
	$texto.='<div id="detalles_actividad"></div>';
	
}



echo($texto);

///TODO: PILAS esta funcion se debe pasar a una libreria ya que se usa mucho
function listado_funcionarios($entidad,$llave_entidad){
	global $conn;
  if($llave_entidad==-1){
    $dato[0]["cargo"]="Cualquier usuario";
    $dato[0]["tipo_cargo"]=''; 
  }
	$condicion='';
	$funcionario_codigo=array();
	switch($entidad){
	    case 1://funcionario
	        $condicion="funcionario_codigo IN(".$llave_entidad.")";
	    break;
	    case 2://dependencia
	    		$condiciones=array();
	    		$dependencias=busca_filtro_tabla("","dependencia","iddependencia IN(".$llave_entidad.")","",$conn);
	    		$codigos=extrae_campo($dependencias,"cod_arbol");
	    		$cant_codigos=count($codigos);
	    		for($j=0;$j<$cant_codigos;$j++){
	    			array_push($condiciones,"cod_arbol_dep LIKE '".$codigos[$j].".%' ");
	    		}
	    		$condicion="(".implode(" OR ",$condiciones).")";
	    break;
	    case 3://ejecutor
	    break;
	    case 4://cargo
	        $condicion='idcargo IN('.$llave_entidad.")";
	    break;
	    case 5://dependencia cargo
	    		$condicion='iddependencia_cargo IN('.$llave_entidad.')';
	    break;            
	}
	$dato=busca_filtro_tabla("","vfuncionario_dc",$condicion." AND estado_dc=1 AND estado_dep=1 AND estado=1","GROUP BY funcionario_codigo",$conn);
	return($dato);
}

?>
<script type="text/javascript">
  $(document).ready(function(){
    $(".tooltip_saia").tooltip();
    $(".detalle_cargo").click(function(){
    var este=$(this);
    alert( este.val() );
    if(este.val()>=0){
        
    
        $.ajax({
          type:'POST',
          url: "<?php echo($ruta_db_superior);?>bpmn/paso/actividades_paso_detalle.php",
          data:"idcargo="+este.attr("idcargo")+"&tipo_accion="+este.attr("tipo_actividad"),
          success: function(html){
            if(html){
              var objeto=jQuery.parseJSON(html);
              if(objeto.exito){
                  //exito al cargar la informacion
                $("#detalles_actividad").html(objeto.html);
              } 
              else{
                //No es exitosa la carga de la informaion
              }   
            }
            else{
                //No se envia el registro html error 
            }
          }
        });
    }else{
        alert(este.value);
        if(este.val()==-1){ //cualquier usuario
             $("#detalles_actividad").html('<div class="alert alert-info">Cualquier Usuario</div>');
        }else{ //tomado de un campo
            $("#detalles_actividad").html('<div class="alert alert-info">Tomado de un Campo</div>');
        }
    }
    
    
  });
  });  
  
</script>
<script>
	$(document).ready(function(){				
		$('[name="eliminar_actividad"]').click(function(){	
			if(confirm('Esta seguro de eliminar la actividad')){
					var ruta='actividades_paso_admin.php?idpaso=<?php echo($_REQUEST['idpaso']); ?>';
                    $.ajax({
                        type:'POST',
                        dataType: 'json',
                        url: "<?php echo($ruta_db_superior);?>bpmn/paso/ejecutar_acciones.php",
                        data: {
                        	idpaso_actividad:$(this).attr('valor'),
                      		ejecutar_accion:1
                        },
                        success: function(datos){
                        	if(datos.exito=1){
	  							notificacion_saia('Actividad eliminada satisfactoriamente','success','',4000);
								window.location=ruta;                      		
                        	}
                        }
                    });	
                    
              } 		
		});
	});	
</script> 
			
