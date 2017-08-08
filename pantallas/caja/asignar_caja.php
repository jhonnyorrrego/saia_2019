<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
$_REQUEST["tipo_entidad"]=1; 
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-responsive.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap_reescribir.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-iconos-segundarios.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-datetimepicker.min.css"/>
<?php include_once($ruta_db_superior."db.php"); 
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery-1.7.min.js"></script>
<?php include_once($ruta_db_superior."librerias_saia.php"); ?>
<form name="formulario_asignar_caja" id="formulario_asignar_caja" method="post">
<input type="hidden" name="idcaja" id="idcaja" value="<?php echo($_REQUEST["idcaja"]);?>">
<input type="hidden" id="cerrar_higslide" value="<?php echo(@$_REQUEST["cerrar_higslide"]);?>">
<legend>Asignar acceso caja <?php $caja=busca_filtro_tabla("","caja","idcaja=".$_REQUEST["idcaja"],"",$conn); echo($caja[0]["nombre"]);?></legend>
<div class="control-group element">
  <label class="control-label" for="nombre"><?php if(@$_REQUEST["tipo_entidad"]){
      echo"<input type='hidden' value='".$_REQUEST["tipo_entidad"]."' name='tipo_entidad' >";
      $entidad = busca_filtro_tabla("*","entidad","identidad=".$_REQUEST["tipo_entidad"],"nombre",$conn);
      echo($entidad[0]["nombre"]);
    }
    else{
      echo("Entidad");
    }?>*
  </label>
  <div class="controls"> 
    <?php
    if(@$_REQUEST["llave_entidad"]){
      echo "<input type='hidden' value='".$_REQUEST["llave_entidad"]."' name='  llave_entidad' >";
    }    
    if(@$_REQUEST["filtrar_caja"])
      echo "<input type='hidden' value='".$_REQUEST["filtrar_caja"]."' name='filtrar_caja' >";     
      
      if(@$_REQUEST["tipo_entidad"])
        echo '<script>$(document).ready(function(){valores_entidad("'.$_REQUEST["tipo_entidad"].'");});</script>';
      $select_entidad.="</select>";
      echo $select_entidad;
    ?>
    <div id="sub_entidad" class="arbol_saia">
    </div>
  </div>
</div>

<input type="hidden" name="key_formulario_saia" value="<?php echo(generar_llave_md5_saia());?>">
<input type="hidden"  name="ejecutar_caja" value="asignar_permiso_caja"/>
<input type="hidden"  name="tipo_retorno" value="1"/>
<div class="form-actions">
<button class="btn btn-primary" id="submit_formulario_asignar_caja">Aceptar</button>
<button class="btn" id="cancel_formulario_asignar_caja">Cancelar</button>
<div id="cargando_enviar" class="pull-right"></div>
</div>
</form>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.validate_v1.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/idiomas/jquery.validates.es.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/themes/default.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_notificaciones.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_codificacion.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap-datetimepicker.js"></script>
<?php
echo(librerias_arboles());
?>
<script type="text/javascript">
$(document).ready(function(){  
  var formulario_asignar_caja=$("#formulario_asignar_caja");
  formulario_asignar_caja.validate({  
    submitHandler: function(form) {
    }
  });
  $.ajax({
    url: "<?php echo($ruta_db_superior);?>pantallas/caja/arbol_caja_entidad.php" ,
    data:"entidad=caja<?php if(@$_REQUEST['filtrar_caja']) echo '&filtrar_caja='.$_REQUEST['filtrar_caja']; if(@$_REQUEST['tipo_entidad']) echo '&tipo_entidad='.$_REQUEST['tipo_entidad'] ; if(@$_REQUEST['llave_entidad']) echo '&llave_entidad='.$_REQUEST['llave_entidad'];?>",
    type: "POST",
    success: function(msg){
      $("#divcaja").html(msg);
    }
  });
  $("#submit_formulario_asignar_caja").click(function(){  
    $('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
		$(this).attr('disabled', 'disabled');  
    if(formulario_asignar_caja.valid()){
    <?php encriptar_sqli("formulario_asignar_caja",0,"form_info",$ruta_db_superior); ?>
      $.ajax({
        type:'POST',
        async:false,
        url: "<?php echo($ruta_db_superior);?>pantallas/caja/ejecutar_acciones.php",
        data: "rand="+Math.round(Math.random()*100000)+"&"+formulario_asignar_caja.serialize(),
        success: function(html){               
          if(html){                   
            var objeto=jQuery.parseJSON(html);                  
            if(objeto.exito){              
              $('#cargando_enviar').html("Terminado ...");  
              if($("#cerrar_higslide").val()){            
                $("#arbol_padre_actualizado", parent.document).val($("#cod_padre").val());
                parent.window.hs.getExpander().close();                  
              }
              notificacion_saia(objeto.mensaje,"success","",2500);
              window.open("detalles_caja.php?idcaja="+objeto.idcaja+"&idbusqueda_componente=<?php echo($_REQUEST['idbusqueda_componente']);?>&rand="+Math.round(Math.random()*100000),"_self");                                                                                                 	
            }
            else{
              $('#cargando_enviar').html("Terminado ...");
              notificacion_saia(objeto.mensaje,"error","",8500);
            }                  
          }          
        }
    	});
    }
    else{
      notificacion_saia("Formulario con errores","error","",8500);
    }
  });  
});
//funcion para cargar los elementos de la entidad seleccionada
function valores_entidad(identidad){
  if(identidad!=""){
    $.ajax({url: "<?php echo($ruta_db_superior);?>pantallas/caja/arbol_caja_entidad.php" ,
      data:"entidad="+identidad+"&cajas="+$("#caja_idcaja").val()+"<?php if(@$_REQUEST['tipo_entidad']) echo '&tipo_entidad='.$_REQUEST['tipo_entidad'] ; if(@$_REQUEST['llave_entidad']) echo '&llave_entidad='.$_REQUEST['llave_entidad']; ?>",
      type: "POST",
      success: function(msg){
        $("#sub_entidad").html(msg);
      }
    });        
  }       
}
function todos_check(elemento,campo){
  seleccionados=elemento.getAllLeafs();
  nodos=seleccionados.split(",");
  for(i=0;i<nodos.length;i++)
    elemento.setCheck(nodos[i],true);
  document.getElementById(campo).value=elemento.getAllChecked();   
} 
function ninguno_check(elemento,campo){
  seleccionados=elemento.getAllLeafs();
  nodos=seleccionados.split(",");
  for(i=0;i<nodos.length;i++)
    elemento.setCheck(nodos[i],false);
  document.getElementById(campo).value="";
} 
</script>