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
echo(estilo_bootstrap());
$campos=busca_filtro_tabla("","pantalla_componente B","idpantalla_componente=".$_REQUEST["idpantalla_componente"],"",$conn);
for($i=0;$i<$campos["numcampos"];$i++){
	$librerias=explode(",",$campos[$i]["librerias"]);
	foreach($librerias AS $key=>$libreria){
		$extension=explode(".",$libreria);
		$cant=count($extension);
    if($extension[$cant-1]!==''){            	
  		switch($extension[($cant-1)]){
  	    case "php":           
  	      include_once($ruta_db_superior.$libreria);
  	    break;
  	    case "js":
  	      $texto='<script type="text/javascript" src="'.$ruta_db_superior.$libreria.'"></script>';
  	    break;
  	    case "css": 
  	      $texto='<link rel="stylesheet" type="text/css" href="'.$ruta_db_superior.$libreria.'"/>';    
  	    break;
  	    default:
  	      $texto=""; //retorna un vacio si no existe el tipo
  	    break;
  	  }
  		echo($texto);    
  	}
  }
}
$accionesa="checked";
$accionese="checked";
$accionesb="checked";
$acciones1="";
$accionesp="";
if(@$_REQUEST["idpantalla_campos"]){    
  $pantalla_campos=get_pantalla_campos($_REQUEST["idpantalla_campos"],0);
  $obligatoriedad_si='';
  $obligatoriedad_no='';    
  if($pantalla_campos[0]["obligatoriedad"])
    $obligatoriedad_si=' checked="checked"';
  else 
    $obligatoriedad_no=' checked="checked"';
    
  $accionesa="";
	$accionese="";
	$accionesb="";
	$acciones1="";
	$accionesp="";
	$acciones_guardadas=explode(",",$pantalla_campos[0]["acciones"]);
	if(in_array("a",$acciones_guardadas))$accionesa="checked";
	if(in_array("e",$acciones_guardadas))$accionese="checked";
	if(in_array("b",$acciones_guardadas))$accionesb="checked";
	if(in_array("1",$acciones_guardadas))$acciones1="checked";
	if(in_array("p",$acciones_guardadas))$accionesp="checked";
}
else{
  alerta("No es posible Editar el Campo");
}
$items=false;
if(strpos(strtoupper($pantalla_campos[0]["valor"]),"SELECT")!==false){
	$valor_llenado1=$pantalla_campos[0]["valor"];
}
else{
	$valor_llenado2=$pantalla_campos[0]["valor"];
	$filas=explode("|",$valor_llenado2);
	$cant=count($filas);
	$items=true;
}
$almacenar0='checked';
$almacenar1='';

$tipo_arbol0='';
$tipo_arbol1='';
$tipo_arbol2='';
$tipo_arbol3='';
$tipo_arbol4='';
$tipo_arbol5='';

$ruta_xml='';
$tipo_control='2';
$modo_calcular_nodos='0';
$forma_carga='1';
$busqueda='1';

if($pantalla_campos[0]["valor"]){
	$valores=explode("|",$pantalla_campos[0]["valor"]);
	$ruta_xml=$valores[0];//Ruta del test
	//$tipo_control=$valores[1];//1=checkbox, 2=Radio
	//$modo_calcular_nodos=$valores[2];//Modo de calcular numero de nodos. defecto=0
	//$forma_carga=$valores[3];//0=Autoloading, 1=smartxml. defecto=1
	//$busqueda=$valores[4];//0=No, 1=si. defecto=1
	$almacenar=$valores[5];//0=iddatos, 1=valor_dato. defecto=0
	$tipo_arbol=$valores[6];//0=funcionarios, 1=series, 2=dependencias, 3=otro, 4=Sale de la tabla enviada a pantallas/lib/arbol_pantallas.php?tabla=nombre_tabla, 5=rol
	$parametros=$valores[7];
	
	$almacenar0='';
	$almacenar1='';
	if($almacenar==0)$almacenar0='checked';
	if($almacenar==1)$almacenar1='checked';
	
	if($tipo_arbol==0)$tipo_arbol0='checked';
	if($tipo_arbol==1)$tipo_arbol1='checked';
	if($tipo_arbol==2)$tipo_arbol2='checked';
	if($tipo_arbol==3)$tipo_arbol3='checked';
	if($tipo_arbol==4)$tipo_arbol4='checked';
	if($tipo_arbol==5)$tipo_arbol5='checked';
}
?>
<form method="POST" action="" class="form-horizontal" name="editar_pantalla_campo" id="editar_pantalla_campo">
  <fieldset id="content_form_name">
    <legend>Editar Campos</legend>
  </fieldset>
  <div class="control-group">
    <label class="control-label" for="tabla">Tabla</label>
    <div class="controls">
      <?php 
          $tablas=array();
          $ltablas=$conn->Lista_Tabla();          
          foreach($ltablas AS $key=>$valor){          
            if($valor[0]!=''){  
              array_push($tablas,$valor[0]);              
            }            
          }
          $tablas_campos=  busca_filtro_tabla("tabla", "pantalla_campos", "tabla<>''", "GROUP BY tabla", $conn);
          for($i=0;$i<$tablas_campos["numcampos"];$i++){
            array_push($tablas,$tablas_campos[$i]["tabla"]);
          }
          $tablas=array_unique($tablas);
        ?>        
    <input type="text" data-provide="typeahead" data-items="4" name="fs_tabla" id="tabla" data-source='[<?php echo('"'.implode('","',$tablas)).'"';?>]' value="<?php echo($pantalla_campos[0]['tabla']);?>">                   
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="nombre">Nombre *</label>
    <div class="controls">
      <input type="text" name="fs_nombre" id="nombre" placeholder="Nombre" value="<?php echo(@$pantalla_campos[0]["nombre"]);?>" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="etiqueta">Etiqueta *</label>
    <div class="controls">
      <input type="text" name="fs_etiqueta" id="etiqueta" placeholder="Etiqueta" value="<?php echo(@$pantalla_campos[0]["etiqueta"]);?>" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="obligatoriedad">Obligatoriedad</label>
    <div class="controls">
      <label class="control-label" for="obligatorio">
        <input type="radio" name="fs_obligatoriedad" id="obligatorio" value="1" <?php echo($obligatoriedad_si);?> required>
        Obligatorio
      </label>
      <label class="control-label" for="radios-1">
        <input type="radio" name="fs_obligatoriedad" id="opcional" value="0" <?php echo($obligatoriedad_no);?>>
        Opcional
      </label>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label">Formularios *</label>
    <div class="controls">
      <label class="checkbox inline" for="acciones_0">
        <input type="checkbox" name="fs_acciones[]" id="acciones_0" value="a" <?php echo($accionesa); ?>>
        Adicionar
      </label>
      <label class="checkbox inline" for="acciones_1">
        <input type="checkbox" name="fs_acciones[]" id="acciones_1" value="e" <?php echo($accionese); ?>>
        Editar
      </label>
      <label class="checkbox inline" for="acciones_2">
        <input type="checkbox" name="fs_acciones[]" id="acciones_2" value="b" <?php echo($accionesb); ?>>
        Buscar
      </label>
      <label class="checkbox inline" for="acciones_5">
        <input type="checkbox" name="fs_acciones[]" id="acciones_5" value="1" <?php echo($acciones1); ?>>
        Autoguardado
      </label>
      <label class="checkbox inline" for="acciones_6">
        <input type="checkbox" name="fs_acciones[]" id="acciones_6" value="p" <?php echo($accionesp); ?>>
        Descripci&oacute;n
      </label>
    </div>
  </div>
  
  <input type="hidden" name="fs_valor" id="valor" value="<?php echo(@$pantalla_campos[0]["valor"]);?>" required>

  <input type="hidden" id="tipo_control" value="<?php echo(@$tipo_control);?>">
  <input type="hidden" id="modo_calcular_nodos" value="<?php echo(@$modo_calcular_nodos);?>">
  <input type="hidden" id="forma_carga" value="<?php echo(@$forma_carga);?>">
  <input type="hidden" id="busqueda" value="<?php echo(@$busqueda);?>">
  
  <div class="control-group">
    <label class="control-label" for="valor">Almacenar</label>
    <div class="controls">
    	<label class="radio inline" for="almacenar">        
        <input type="radio" name="almacenar" id="almacenar_0" value="0" <?php echo $almacenar0; ?>>
        Iddato
      </label>
      <label class="radio inline" for="almacenar">        
        <input type="radio" name="almacenar" id="almacenar_1" value="1" <?php echo $almacenar1; ?>>
        Valor del dato
      </label>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="valor">Tipo de arbol</label>
    <div class="controls">
    	<label class="radio inline" for="tipo_arbol">        
        <input type="radio" name="tipo_arbol" id="tipo_arbol_0" value="0" <?php echo $tipo_arbol0; ?>>
        Funcionarios
      </label>
      <label class="radio inline" for="tipo_arbol">        
        <input type="radio" name="tipo_arbol" id="tipo_arbol_1" value="1" <?php echo $tipo_arbol1; ?>>
        Series
      </label>
      <label class="radio inline" for="tipo_arbol">        
        <input type="radio" name="tipo_arbol" id="tipo_arbol_2" value="2" <?php echo $tipo_arbol2; ?>>
        Dependencias
      </label>
      <label class="radio inline" for="tipo_arbol">        
        <input type="radio" name="tipo_arbol" id="tipo_arbol_3" value="3" <?php echo $tipo_arbol3; ?>>
        Otro
      </label>
      <label class="radio inline" for="tipo_arbol">        
        <input type="radio" name="tipo_arbol" id="tipo_arbol_4" value="4" <?php echo $tipo_arbol4; ?>>
        Sale de la tabla enviada (pantallas/lib/arbol_pantallas.php?tabla=nombre_tabla)
      </label>
      <label class="radio inline" for="tipo_arbol">        
        <input type="radio" name="tipo_arbol" id="tipo_arbol_5" value="5" <?php echo $tipo_arbol5; ?>>
        Rol
      </label>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="valor">Ruta xml</label>
    <div class="controls">
    	<input type="text" id="ruta_xml" value="<?php echo(@$ruta_xml);?>" required>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="parametros">Parametros(parametro enviar,request que recibe;)</label>
    <div class="controls">
    	<input type="text" id="parametros" value="<?php echo(@$parametros);?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="predeterminado">Valor predeterminado</label>
    <div class="controls">
      <input type="text" name="fs_predeterminado" id="predeterminado" placeholder="Valor predeterminado" value="<?php echo(@$pantalla_campos[0]["predeterminado"]);?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="ayuda">Ayuda *</label>
    <div class="controls">
      <textarea name="fs_ayuda" id="ayuda" placeholder="Ayuda" required><?php echo(@$pantalla_campos[0]["ayuda"]);?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="placeholder">Marcador</label>
    <div class="controls">
      <input type="text" name="fs_placeholder" id="placeholder" placeholder="Marcador" value="<?php echo(@$pantalla_campos[0]["placeholder"]);?>">
    </div>
  </div>
  <div class="form-actions">
  	<input type="hidden" name="idpantalla_campos" id="idpantalla_campos" value="<?php echo($_REQUEST["idpantalla_campos"]); ?>">
    <button type="button" class="btn btn-primary" id="enviar_formulario_saia">Aceptar</button>
    <button type="button" class="btn" id="cancelar_formulario_saia">Cancel</button>
    <div class="pull-right" id="cargando_enviar"></div>
  </div>
</form>
<?php
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());
echo(librerias_validar_formulario());
echo(librerias_notificaciones());
?>
<script type="text/javascript">
$(document).ready(function(){
	var formulario = $("#editar_pantalla_campo");
	formulario.validate({
    rules: {
      "fs_acciones[]": {
        required: true,
        minlength:1            
      }
    }
  });
	$("#enviar_formulario_saia").click(function(){    		
    var idpantalla_campo=$("#idpantalla_campos").val();
		if(formulario.valid()){
			$('#cargando_enviar').html("Procesando <i id='icon-cargando'>&nbsp;</i>");
			$(this).attr('disabled', 'disabled');
			parsear_valor_arbol();
			$.ajax({
        type:'POST',
        url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php",
        data: "ejecutar_pantalla_campo=set_pantalla_campos&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+formulario.serialize(),
        success: function(html){                
          if(html){          
            var objeto=jQuery.parseJSON(html);                  
            if(objeto.exito){
            	var tree=window.parent.tree_<?php echo $campos[0]["nombre"]; ?>;
              $('#cargando_enviar').html("Terminado ...");
              tree.deleteChildItems(0);
              tree.loadXML("<?php echo($ruta_db_superior);?>saia/"+$("#ruta_xml").val());
              window.parent.hs.close();
            }
        	}
        }
    	});		
		}
		else{			
			$(".error").first().focus();			
		}
	});
	$("#cancelar_formulario_saia").click(function(){		
		parent.hs.close();
	});
	$('input[name$="tipo_arbol"]').click(function(){
		var valor=$(this).val();
		if(valor==0){
			$("#ruta_xml").val("pantallas/lib/arbol_funcionarios.php");
		}
		if(valor==1){
			$("#ruta_xml").val("pantallas/lib/arbol_serie_funcionario.php");
		}
		if(valor==2){
			$("#ruta_xml").val("pantallas/lib/arbol_pantallas.php?tabla=dependencia&estado=1");
		}
		if(valor==3){
			$("#ruta_xml").val("");
		}
		if(valor==4){
			$("#ruta_xml").val("");
		}
		if(valor==5){
			$("#ruta_xml").val("pantallas/lib/arbol_funcionarios.php?rol=1");
		}
	});
});	
function parsear_valor_arbol(){
	var ruta_xml=$("#ruta_xml").val();
	var tipo_control=$("#tipo_control").val();
	var modo_calcular_nodos=$("#modo_calcular_nodos").val();
	var forma_carga=$("#forma_carga").val();
	var busqueda=$("#busqueda").val();
	var almacenar=$("input[name='almacenar']:checked").val();
	var tipo_arbol=$("input[name='tipo_arbol']:checked").val();
	var parametros=$("#parametros").val();
	var cadena=ruta_xml+"|"+tipo_control+"|"+modo_calcular_nodos+"|"+forma_carga+"|"+busqueda+"|"+almacenar+"|"+tipo_arbol+"|"+parametros;
	$("#valor").val(cadena);
}
</script>