<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/generador/librerias.php");
include_once($ruta_db_superior."pantallas/lib/buscar_patron_archivo.php");
$_REQUEST["ruta"]=str_replace("../","",@$_REQUEST["ruta"]);
if(@$_REQUEST["pantalla_idpantalla"] && @$_REQUEST["ruta"]){  
  $campos=array();
  $lcampos=busca_filtro_tabla("","pantalla_campos","pantalla_idpantalla=".$_REQUEST["pantalla_idpantalla"],"",$conn);
  $listado_campos_formulario='<select name="lparametros" class="lparametros">';      
  if($lcampos["numcampos"]){              
    for($i=0;$i<$lcampos["numcampos"];$i++){
      $listado_campos_formulario.='<option value="'.$lcampos[$i]["idpantalla_campos"].'">'.$lcampos[$i]["etiqueta"].'</option>';
      array_push($campos,$lcampos[$i]["nombre"]);
    }
  }               
  $listado_campos_formulario.='</select>';
  $listado_funciones=buscar_patron_archivo($_REQUEST["ruta"],"function",0);         
}
else{
  alerta("No es posible vincular la libreria");
  die();  
}
if($listado_funciones["exito"]){
  $funciones=array();
?>
<input type="hidden" name="ruta" id="ruta" value="<?php echo($_REQUEST["ruta"]);?>">
<br />
<legend>Funciones vinculadas con el archivo <?php echo($_REQUEST["ruta"]);?> <button class="btn btn-mini btn-default" id="vincular_libreria_pantalla"><i class="icon-ok" title="Vincular Libreria"></i></button> </legend>
<br />                                           
<div class="accordion" id="acordion_libreria">  
<?php  
  foreach($listado_funciones["resultado"] AS $key=>$valor){
    $cant_funciones='';
    $pos1=strpos($valor,"(");
    $pos2=strpos($valor,")");
    $nombre=trim(substr($valor,8,($pos1-8)));        
    $dato=trim(substr($valor,8));
    if($nombre=='')continue;
    $funcion_bd=busca_filtro_tabla("C.idpantalla_funcion_exe, B.nombre","pantalla_libreria A, pantalla_funcion B, pantalla_funcion_exe C","A.idpantalla_libreria=B.fk_idpantalla_libreria AND B.idpantalla_funcion=C.fk_idpantalla_funcion AND A.ruta='".trim($_REQUEST["ruta"])."' AND B.nombre='".$nombre."'", "idpantalla_funcion_exe asc", $conn);
    $cant_funciones='<div class="badge pull-right" id="cantidad_'.$nombre.'">'.$funcion_bd["numcampos"].'</div>';
?> 
  <div >
    <div funcion="<?php echo($dato);?>" nombre="<?php echo($nombre);?>">
      <span>
      	&nbsp;-&nbsp;<?php echo($valor); ?>
      <span>
    </div>
    <div id="funcion_<?php echo($nombre);?>" class="accordion-body collapse">
    	<div class="accordion-inner" id="historial_funcion_<?php echo($nombre);?>">
    		
    	</div>
      <div class="accordion-inner" id="contenedor_funcion_<?php echo($nombre);?>">
       
      </div>
      <div class="form-actions">  	
		    <button type="button" class="btn btn-primary enviar_formulario_saia" formulario="formulario_<?php echo($nombre);?>" nombre="<?php echo($nombre);?>">Aceptar</button>
		    <button type="button" class="btn cancelar_formulario_saia" formulario="formulario_<?php echo($nombre);?>" nombre="<?php echo($nombre);?>" funcion="<?php echo($dato);?>">Cancel</button>
		    <div class="pull-right" id="cargando_enviar_<?php echo($nombre);?>"></div>
		  </div>
    </div>
  </div>
<?php
  }
?>
</div>  
<?php  
}
$input_variable_formulario='<input type="text" name="_dato" value="" class="lparametros">';
?>
<script type="text/javascript">
$(document).ready(function(){  
  $(".acordion_funcion").click(function(){
    var funcion=$(this).attr("funcion");
    var nombre_funcion=$(this).attr("nombre");
    $.ajax({
      type:'POST',
      url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias_funcion_exe.php",
      data: "llamado_funcion=historial_funcion&funcion="+funcion+"&idpantalla=<?php echo($_REQUEST['pantalla_idpantalla']);?>&pantalla_actual=<?php echo($_REQUEST['pantalla_idpantalla']);?>&ruta=<?php echo($_REQUEST['ruta']);?>&rand="+Math.round(Math.random()*100000),
      success: function(html){ 
      	if(html){
      		$("#historial_funcion_"+nombre_funcion).html(html);
      		
      	}      
      }    
    });
     
    $("#contenedor_funcion_"+nombre_funcion).html("cargando...");
    $("#contenedor_funcion_"+nombre_funcion).removeData();       
    $("#formulario_"+nombre_funcion).remove();
    $.ajax({
      type:'POST',
      url: "<?php echo($ruta_db_superior);?>pantallas/generador/detalle_pantalla_funcion.php",
      data: "funcion="+funcion+"&idpantalla=<?php echo($_REQUEST['pantalla_idpantalla']);?>&ruta=<?php echo($_REQUEST['ruta']);?>&rand="+Math.round(Math.random()*100000),
      success: function(html){                
        if(html){
          $("#contenedor_funcion_"+nombre_funcion).html("<form name='formulario_"+nombre_funcion+"' id='formulario_"+nombre_funcion+"'>"+html+"</form>");
        }          
      }    
    });
    /*if(!$(this).hasClass("alert-info")){
        $(this).removeClass("alert-info");
    }
    else{
        $(this).addClass("alert-info");
    }*/
  });
  $(document).on("click",".cargar_informacion_libreria",function(){
      var nombre_funcion=$(this).attr("nombre_funcion");
      var parametros=$("#formulario_"+nombre_funcion).find("#parametros").val().split(",");
      $.each(parametros,function(index,item){
        if(item){
      	    var tipo_parametro=$("#default_parametro_"+item).attr("tipo");
            $("#formulario_"+nombre_funcion).find("#div"+tipo_parametro+"_"+item).click();                  
            $("#formulario_"+nombre_funcion).find("[name='"+item+"_dato']").val($("#default_parametro_"+item).val());
        }
      });
  });
  $(".seleccion_variable_funcion_pantalla").live("change",function(){    
    var opcion=$(this).val();  
    var nombre=$(this).attr("name");
    nombre=nombre.replace("div_","");        
    if(opcion==1){      
      $("#"+$(this).attr("name")).html('<?php echo($listado_campos_formulario);?>');            
    }
    else if(opcion==2){          
      $("#"+$(this).attr("name")).html('<?php echo($input_variable_formulario);?>');            
    }
    else if(opcion==3){          
      $("#"+$(this).attr("name")).html('<?php echo($input_variable_formulario);?>');            
    }
    else if(opcion==4){          
      $("#"+$(this).attr("name")).html('<?php echo($input_variable_formulario);?>');
    }
    $("#"+$(this).attr("name")).find(".lparametros").attr("name",nombre+"_dato");
    $("#"+$(this).attr("name")).find(".lparametros").attr("id",nombre+"_dato");
  });
    $(".enviar_formulario_saia").live("click",function(){
      var formulario = $("#"+$(this).attr("formulario"));            
      var nombre_form = $(this).attr("nombre");   
      var nombre_funcion=nombre_form.replace("formulario_","");
      if(formulario.valid()){       
        $('#cargando_enviar_'+nombre_form).html("<div id='icon-cargando'></div>Procesando");                
        if (formulario.data('locked') == undefined && !formulario.data('locked')){
          $(this).attr('disabled', 'disabled');    
          var ruta=$("#ruta").val();                            
          $.ajax({
            type:'POST',
            url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php",
            data: "ejecutar_pantalla_campo=guardar_configurar_pantalla_libreria&tipo_retorno=1&accion=mostrar&ruta="+ruta+"&pantalla_idpantalla=<?php echo($_REQUEST['pantalla_idpantalla']);?>&rand="+Math.round(Math.random()*100000)+"&"+formulario.serialize(),
            beforeSend: function(){ formulario.data('locked', true);},
            success: function(html){                
              if(html){                                      
                var objeto=jQuery.parseJSON(html);                  
                if(objeto.exito){
                  $("#cantidad_"+nombre_funcion).html(objeto.cantidad);
                  $('#cargando_enviar_'+nombre_form).html("Terminado ...");
                  notificacion_saia(objeto.mensaje,"success","",2500);
                }
                else{
                  $('#cargando_enviar_'+nombre_form).html("Terminado ...");
                  notificacion_saia(objeto.mensaje,"error","",2500);
                }                              
              }          
            },
            complete: function(){ $(this).removeAttr('disabled');  $('#cargando_enviar_'+nombre_form).html(""); formulario.remove(); delete formulario; $("#funcion_"+nombre_form).collapse('hide'); $(".enviar_formulario_saia").removeAttr("disabled");}
          });
        }  
      }  
    });
          /*$.ajax({
          type:'POST',
          url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php",
          data: "ejecutar_pantalla_campo=guardar_configurar_pantalla_libreria&tipo_retorno=1&idpantalla_campos="+$("#idpantalla_libreria").val()+"&rand="+Math.round(Math.random()*100000)+"&"+formulario.serialize(),
          success: function(html){                
          if(html){          
          var objeto=jQuery.parseJSON(html);                  
          if(objeto.exito){
          $('#cargando_enviar').html("Terminado ...");
          notificacion_saia(objeto.mensaje,"success","",2500);                                                      
          $("#resultado_acciones",parent.document).html(objeto.mensaje);
          }
          else{
          $('#cargando_enviar').html("Terminado ...");
          notificacion_saia(objeto.mensaje,"error","",2500);
          }                  
          parent.hs.close();
          }          
          }
          });		
        }
        else{			
                $(".error").first().focus();			
        }
    });
	/*var formulario = $("#configurar_pantalla_libreria");
	formulario.validate();   
	$("#enviar_formulario_saia").click(function(){    
		if(formulario.valid()){
			$('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
			$(this).attr('disabled', 'disabled');*/
      /*var idconfigurar_pantalla_libreria=$("#idpantalla_libreria").val();
      $("#parametros_exe").val("");
      var cadena_valor='';
      $(".lparametros").each(function(index,val){
        var valor=$(this).val();                
        if(index==0){
          $("#parametros_exe").val(valor);
        }
        else{
          $("#parametros_exe").val($("#parametros_exe").val()+","+valor);
        }
      });*/
      /*$.ajax({
        type:'POST',
        url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php",
        data: "ejecutar_pantalla_campo=guardar_configurar_pantalla_libreria&tipo_retorno=1&idpantalla_campos="+$("#idpantalla_libreria").val()+"&rand="+Math.round(Math.random()*100000)+"&"+formulario.serialize(),
        success: function(html){                
          if(html){          
            var objeto=jQuery.parseJSON(html);                  
            if(objeto.exito){
              $('#cargando_enviar').html("Terminado ...");
              notificacion_saia(objeto.mensaje,"success","",2500);                                                      
              $("#resultado_acciones",parent.document).html(objeto.mensaje);
            }
            else{
              $('#cargando_enviar').html("Terminado ...");
              notificacion_saia(objeto.mensaje,"error","",2500);
            }                  
        	  parent.hs.close();
          }          
        }
    	});		
		}
		else{			
			$(".error").first().focus();			
		}
	});*/
	$(document).on("click",".cancelar_formulario_saia",function(){	
	    var nombre_funcion=$(this).attr("nombre");
	    var funcion=$(this).attr("funcion");
	    $.ajax({
          type:'POST',
          url: "<?php echo($ruta_db_superior);?>pantallas/generador/detalle_pantalla_funcion.php",
          data: "funcion="+funcion+"&idpantalla=<?php echo($_REQUEST['pantalla_idpantalla']);?>&ruta=<?php echo($_REQUEST['ruta']);?>&rand="+Math.round(Math.random()*100000),
          success: function(html){                
            if(html){
              $("#contenedor_funcion_"+nombre_funcion).html("<form name='formulario_"+nombre_funcion+"' id='formulario_"+nombre_funcion+"'>"+html+"</form>");
            }          
          }    
        });
	});
	$(".borrar_historial").live('click',function(){
		var confirmacion=confirm("Seguro que desea eliminar esta funcion?");
		if(confirmacion){
			var registro=$(this).attr("idregistro");
		var pantalla=$(this).attr("pantalla");
		var funcion=$(this).attr("funcion");
		var nombre_funcion=$(this).attr("nombre_funcion");
	    $.ajax({
	      type:'POST',
	      url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias_funcion_exe.php",
	      data: "llamado_funcion=borrar_funcion_historial&idregistro="+registro+"&rand="+Math.round(Math.random()*100000)+"&idpantalla="+pantalla+"&idpantalla_funcion="+funcion,
	      success: function(html){ 
	      	if(html){
	      		$("#historial_"+registro).remove();
	      		if(html=="-1"){
	      		    $("#cantidad_"+nombre_funcion).hide();
	      		}
	      		else{
	      		    $("#cantidad_"+nombre_funcion).show();
	      		    $("#cantidad_"+nombre_funcion).html(parseInt(html)+1);
	      		}
	      		notificacion_saia("Funcion eliminada","success","",2500);
	      	}      
	      }    
	    });
	  }
  });
  

  $('#vincular_libreria_pantalla').click(function(){
        $.ajax({
            type:'POST',
            dataType:'json',
            url:"<?php echo($ruta_db_superior);?>pantallas/generador/librerias_pantalla.php",
            data:{
                idpantalla:'<?php echo($_REQUEST['pantalla_idpantalla']); ?>',
                ruta_libreria:'<?php echo($_REQUEST['ruta']); ?>',
                funciones_vuncular:$('[name="funciones_vuncular[]"]').val(),
                ejecutar_datos_pantalla:'vincular_libreria_pantalla'
            },
            success:function(datos){
                if(datos.exito_libreria){
                    notificacion_saia('Libreria Creada con exito',"success","",2500);
                }
                if(datos.exito_include){
                    notificacion_saia('Libreria vinculada satisfactoriamente',"success","",2500);
                    
				//cargar el listado en librerias_en_uso
        		    $.ajax({
        	        type:'POST',
        	        url: '<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php?ejecutar_pantalla_campo=listado_archivos_incluidos',
        	        data:'idpantalla_campos='+$("#idpantalla").val(),
        	        success: function(html){
        	          if(html){
        	          	var objeto=jQuery.parseJSON(html);
        	            if(objeto.exito){
        	              $('#librerias_en_uso').html(objeto.codigo_html);
        	              //iniciar_tooltip();
        	            }
        	        	}
        	        }
        	    	});                    
                }       
                if(datos.existe_include){
                    notificacion_saia('<b>ATENCI&Oacute;N!</b><br>La libreria ya se encuentra vinculada',"warning","",2500);
                }                
                
            }
        });       
  });
  
  
});	
</script>