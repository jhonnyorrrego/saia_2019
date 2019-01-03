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
  include_once ($ruta_db_superior . "librerias_saia.php");
  include_once ($ruta_db_superior . "assets/librerias.php");

  $campos_auto = explode(",", $_REQUEST["campos_auto"]);
  $campos = explode(",", $_REQUEST["campos"]);
  $etiquetas = array(
    "titulo"=>"T&iacute;tulo",
    "cargo" => "Cargo",
    "direccion"=>"Direcci&oacute;n",
    "telefono"=>"Tel&eacute;fono",
    "email"=>"Email",
    "ciudad"=>"Ciudad",
    "empresa"=>"Contacto",
    "identificacion"=>"Identificaci&oacute;n",
    "nombre"=>"Nombres y apellidos",
    "nombre_pj"=>"Entidad"
  );
  //Se adiciona el componente vacio porque no funciona la comparacion estricta 
  $orden_campos_pn=array("",
    "titulo","direccion","cargo","telefono","email","ciudad");
  $orden_campos_pj=array("","direccion","cargo","ciudad","empresa","telefono","email");
  foreach($campos AS $key=>$valor){
    $id_arreglo1=array_search(trim($valor),$orden_campos_pj);
    if($id_arreglo1===false){
        unset($orden_campos_pj[$id_arreglo1]);
    }
    $id_arreglo2=array_search(trim($valor),$orden_campos_pn);
    if($id_arreglo2===false){
        unset($orden_campos_pn[$id_arreglo2]);
    }
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= icons() ?>
    <?= librerias_notificaciones() ?>	
  </head>
    <link href="../../assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../../assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link class="main-stylesheet" href="../../assets/theme/pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!--<link rel="stylesheet" type="text/css" href="../../css/jquery.autocomplete.css" />-->
  </head>
  <body>
    <div class="container-fluid container-fixed-lg col-lg-8">
    <div class="card card-default">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
      <div class="form-group">
        <form name="form1" id="form1" class="form-horizontal">
            <?php
            if(isset($_REQUEST["iddoc"]) && $_REQUEST["iddoc"]){
              $destinos=busca_filtro_tabla($_REQUEST["campo_autocompletar"],$_REQUEST["tabla"],"documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
                if($destinos["numcampos"]){
                  $lista=busca_filtro_tabla("iddatos_ejecutor,nombre","datos_ejecutor,ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor in(".$destinos[0][0].")","nombre",$conn);
                 }else{
                    echo "<input type=hidden name='iddoc' value='".$_REQUEST["iddoc"]."'>";
                  }         
                }
                if(isset($_REQUEST["destinos"]) && $_REQUEST["destinos"]){
                	if(@$_REQUEST["iddoc"]){
                		$iddoc=$_REQUEST["iddoc"];
                	}else{
        				    $iddoc=0;
        			    }
                	$destinos=busca_filtro_tabla($_REQUEST["campo_autocompletar"],$_REQUEST["tabla"],"documento_iddocumento=".$iddoc,"",$conn);
                  if($destinos["numcampos"]){
                    $lista=busca_filtro_tabla("iddatos_ejecutor,nombre","datos_ejecutor,ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor in(".$_REQUEST["destinos"].")","nombre",$conn);
                  	if($_REQUEST["tipo"]!='unico'){
                  		for($i=0;$i<$lista["numcampos"];$i++){
                  			echo "<div class='datos_ejecutor' id='de_".$lista[$i]["iddatos_ejecutor"]."' >".$lista[$i]["nombre"]."</div>";
                      }
                    }
              	  }
                } 
            if($_REQUEST["tipo"]=="multiple"){
              ?>
              <div id="div_seleccionados_multiple" class="row">

                    <label for="estado_actualizacion" class ="col-5 control-label">Seleccionados:</label>

                    <select style="width:40%;" data-init-plugin="select2" id="estado_actualizacion" name="seleccionados_ejecutor">
        	           <option value="0">Listado de Seleccionados</option>
        			       <?php
        			       if(isset($lista)&&$lista["numcampos"]){
        			       	for($i=0;$i<$lista["numcampos"];$i++){
        			          echo "<optgroup label='Listado de Seleccionados'>
        			          <option value='".$lista[$i]["iddatos_ejecutor"]."'>".$lista[$i]["nombre"]."</option></optgroup>";
                      }
        			       }
        		        ?>
          			    </select>

                  <div class="col-auto">
                    <span id="eliminar" class="label label-success"  style="cursor:pointer">Quitar</span>
                  </div>

              </div>                   
              <?php
              }else if($_REQUEST["tipo"]=="unico"){
               echo "<label id='estado_actualizacion'>".@$lista[0]["nombre"]."</label>";
              }
              ?>
              <div class="row">      
              	<div class="radio radio-success">
                  <input type="radio" value="1" name="tipo_ejecutor" id="tipo_ejecutor1" checked="checked" class="tipo_ejecutor">
                  <label for="tipo_ejecutor1">Persona natural</label>
                  <input type="radio"  value="2" name="tipo_ejecutor" id="tipo_ejecutor2" value="2" class="tipo_ejecutor">
                  <label for="tipo_ejecutor2">Persona Jur&iacute;dica</label>
                </div>
              </div>         
          <?php
              foreach($campos_auto as $nombre){
                if($nombre<>""){
                  echo '
                  <div class="row">
                  <label class="col-5" for="'.$nombre.'_ejecutor" id="label_'.$nombre.'">'.$etiquetas[$nombre].':</label>
                  <input class="col-6" type="text" id="'.$nombre.'_ejecutor" name="'.$nombre.'" />
                  </div>';
                }
              }
              if($_REQUEST["tipo"]=="unico"){
                ?>
                <div id="datos_ejecutor"></div>
                <div class="row">
                  <div class="col-auto p-1 m-0">
                  	<span id="borrar_todos" class="label label-success"  style="cursor:pointer">Quitar todos</span>
                  </div>
                      <div class="col-auto p-1 m-0"><span id="actualizar"  class="label label-success"  style="cursor:pointer">Actualizar datos</span>
                	</div>
                </div>
                <input type="hidden"  id="destinos_seleccionados" name="destinos_seleccionados">        
             <?php
              }else{
                ?>
              <div id="datos_ejecutor"></div>
              <div class="row">
               	<div class="col-auto p-1 m-0"> 
                    <span id="limpiar"  class="label label-danger"  style="cursor:pointer">Limpiar formulario</span>
                </div> 
                <div class="col-auto p-1 m-0"> 
                    <span id="borrar_todos" class="label label-success"  style="cursor:pointer">Quitar todos</span>
                </div> 
                <div class="col-auto p-1 m-0"> 
                  <span id="actualizar"  class="label label-success"  style="cursor:pointer">Actualizar datos</span>
                </div> 
              </div>
              <input type="hidden"  id="destinos_seleccionados" name="destinos_seleccionados">
              <input type="hidden" id="idejecutor" name="idejecutor_temp" value="">
              <?php
              }
              ?>
        </form>
      </div>
            </div>
      </div>
    </div>
  </div>
  </div>
   <script type="text/javascript">
  function eliminarItem(conjunto, valor){
    j=0;
    vector=new Array();
    lista=conjunto.split(",");
    for(ind=0; ind<lista.length; ind++)
       {
        if (lista[ind] != valor)
          {vector[j]=lista[ind];
           j=j+1;
          }
        }
    return (vector.join(","));
  }
  $(function() {
  	$("#nombre_ejecutor").hide();
	$("#nombre_ejecutor").parent().append("<input class='col-6' type='text' id='buscar_nombre' size='50' name='buscar_nombre'><div id='ul_completar' class='ac_results' style='cursor:pointer'></div>");
	
	$("#buscar_nombre").keyup(function (){
		if($(this).val()==0 || $(this).val()==""){
			alert("Ingrese el nombre");
		}else{
			$("#ul_completar").load( "<?php echo $ruta_db_superior;?>formatos/librerias/seleccionar_ejecutor.php?tipo=nombre", { nombre: $(this).val() },function(response){
				if(response){
					$("#ul_completar").html(response);
				}else{
					$("#nombre_ejecutor").val($("#buscar_nombre").val());
				}
			});
		}
	});
		
  $("#nombre_ejecutor").addClass("form-control"); 
  llenar_ejecutor(0); 
  <?php 
    if(@$_REQUEST['funcion_javascript']){
       $funcion_parametros=explode('@',$_REQUEST['funcion_javascript']);      
      if(intval(count($funcion_parametros))>1){
        echo(''.$funcion_parametros[0].'('.$funcion_parametros[1].');');
      }else{
        echo(''.$_REQUEST['funcion_javascript'].'();');
      }  
    }
  ?>    
  function findValueCallback(event, data, formatted) {
    $("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
  }
  function formatItem(row) {
    return row[1] + " (<strong>Documento: " + row[2] + "</strong>)";
  }
  function formatResult(row) {
    return row[1].replace(/(<.+?>)/gi, '');
  }
  function iddatos_ejecutor(idejecutor,nombre){
  $("#idejecutor").val(idejecutor);
    $.ajax({
      type:'POST',
      url:'ultimo_dato_ejecutor.php',
      data:'idejecutor='+idejecutor,
      success: function(datos,exito){
        vector=datos.split("|");
        $("#destinos_seleccionados").val(vector[1]);
        $("#estado_actualizacion").html(nombre);
        llenar_llamado();
      }
    });
  }   
  /*$("#nombre_ejecutor").autocomplete('../librerias/seleccionar_ejecutor.php?tipo=nombre', {
  width: 500,
  max:20,
  scroll: false,
  scrollHeight: 150,
  matchContains: true,
  minChars:4,
  formatItem: formatItem,
    formatResult: function(row) {
    return row[4];
    }
  }); 
  $("#nombre_ejecutor").result(function(event, data, formatted){
    if(data){
      $("#identificacion_ejecutor").val(data[2]);
      $("#codigo_ejecutor").val(data[5]);
      llenar_ejecutor(data[0]);
      if("unico"=="<?php echo $_REQUEST['tipo'];?>"){
          iddatos_ejecutor(data[0],data[4]);
      }
    }
  });
  $("#identificacion_ejecutor").result(function(event, data, formatted) {
    if(data){
      $("#nombre_ejecutor").val(data[4]);
      $("#codigo_ejecutor").val(data[5]);
      llenar_ejecutor(data[0]);
      if("unico"=="<?php echo $_REQUEST['tipo'];?>"){
        iddatos_ejecutor(data[0],data[4]);
      }
    }
  });*/
  /*$("#identificacion_ejecutor").keyup(function (event){
  $("#identificacion_ejecutor").focus();
    this.value = (this.value + '').replace(/[^0-9a-zA-Z]/g, '');
  });
  $("#identificacion_ejecutor").autocomplete('../librerias/seleccionar_ejecutor.php?tipo=identificacion', {
    width: 500,
    max:20,
    scroll: false,
    scrollHeight: 200,
    matchContains: true,
    minChars:4,
    formatItem: formatItem,
    formatResult: function(row) {
      return row[2];
    }
  });*/
    //------------------------------------------Nuevo campo codigo------------------------------------------
  /*$("#codigo_ejecutor").autocomplete('../librerias/seleccionar_ejecutor.php?tipo=codigo', {
    width: 500,
    max:20,
    scroll: false,
    scrollHeight: 150,
    matchContains: true,
    minChars:4,
    formatItem: formatItem,
    formatResult: function(row) {
    return row[5];
    }
  });
  $("#codigo_ejecutor").result(function(event, data, formatted) {
    if (data){
      $("#identificacion_ejecutor").val(data[2]);
      $("#nombre_ejecutor").val(data[4]);
      llenar_ejecutor(data[0]);
    }
  });*/
  $("#codigo_ejecutor").keyup(function (event){
    $("#codigo_ejecutor").focus();
    if(event.keyCode<96 || event.keyCode>105){
      actual=$("#codigo_ejecutor").val();
      if(isNaN(actual)||actual.indexOf(".")>0){
        if(isNaN(parseInt(actual))){
          $("#codigo_ejecutor").val("");
        }else{
          $("#codigo_ejecutor").val(parseInt(actual));
        }
      }
    }
  });
    //------------------------------------------------------------------------------------------------------
  $("#actualizar").click(function(e){
    e.preventDefault();
    //titulo_ejecutor
    if($("#titulo_ejecutor").attr("type")=="text"){
      titulo=$("#titulo_ejecutor").val();
    }else{
      titulo=$("#titulo_ejecutor").find(':selected').val();
    }
    //ciudad residencia
    if($("#ciudad").attr("type")=="hidden"){
      ciudad=$("#ciudad").val();
    }else{
      ciudad=$("#ciudad").find(':selected').val();
    }
    //lugar_expedicion
    if($("#lugar_expedicion").attr("type")=="hidden"){
      lugar_exp=$("#lugar_expedicion").val();
    }else{
      lugar_exp=$("#lugar_expedicion").find(':selected').val();
    }
    //lugar_nacimiento
    if($("#lugar_nacimiento").attr("type")=="hidden"){
      ciudad_nac=$("#lugar_nacimiento").val();
    }else{
      ciudad_nac=$("#lugar_nacimiento").find(':selected').val();
    }

    if($("#nombre_ejecutor").val()!=""){
      $.ajax({
        type:'POST',
        url:'actualizar_ejecutor.php',
        data:{
          seleccionados_ejecutor:$("#seleccionados_ejecutor").val(),
          iddatos_ejecutor:$("#iddatos_ejecutor").val(),
          nombre:$("#nombre_ejecutor").val(),
          campos:"<?php echo $_REQUEST['campos']; ?>",
          titulo:titulo,
          ciudad:ciudad,
          lugar_expedicion:lugar_exp,
          lugar_nacimiento:ciudad_nac,
          sexo:$("#sexo_ejecutor").find(':selected').val(),
          tipo_documento:$("#tipo_documento_ejecutor").find(':selected').val(),
          estado_civil:$("#estado_civil_ejecutor").find(':selected').val(),
          apodo:$("#apodo_ejecutor").val(),
          estudios:$("#estudios_ejecutor").val(),
          fecha_nacimiento:$("#fecha_nacimiento").val(),
          barrio:$("#barrio_ejecutor").val(),
          sector:+$("#sector_ejecutor").val(),
          direccion:$("#direccion_ejecutor").val(),
          telefono:$("#telefono_ejecutor").val(),
          cargo:$("#cargo_ejecutor").val(),
          empresa:$("#empresa_ejecutor").val(),
          email:$("#email_ejecutor").val(),
          identificacion:$("#identificacion_ejecutor").val(),
          celular:$("#celular_ejecutor").val(),
          codigo:$("#codigo_ejecutor").val(),
          tipo_ejecutor:$(".tipo_ejecutor:checked").val(),
        },
        success: function(datos,exito){
        vector=datos.split("|");
          if("unico"=="<?php echo $_REQUEST['tipo'];?>"){
            $("#estado_actualizacion").html(vector[1]);
          }else{
          	$("#estado_actualizacion").append($("<option>",{
				id:vector[0],
				text:$("#nombre_ejecutor").val()				
			}))
            /*cadena="<option value='"+vector[0]+"' selected>"+vector[1]+"</option>";
            $("#estado_actualizacion").append(cadena);*/
          }
          $("#destinos_seleccionados").val(vector[0]);
          llenar_llamado();
          notificacion_saia('<b>ATENCI&Oacute;N</b><br>Remitente actualizado satisfactoriamente','success','',4000);        
        }
      });
    }else{
      alert("debe seleccionar el nombre");
    }
  });
    $("#limpiar").click(function(e){
      e.preventDefault();
      $("#nombre_ejecutor").val("");
      $("#identificacion_ejecutor").val("");
      $("#codigo_ejecutor").val("");
      $("#destinos_seleccionados").val("");
      llenar_ejecutor(0);
    });
    $("#borrar_todos").click(function(e){
      e.preventDefault();
      $("#estado_actualizacion").empty();
      if("multiple"=="<?php echo $_REQUEST['tipo'];?>"){
        $("#estado_actualizacion").append('<option value="0">Listado de Seleccionados</option>');
      }
      $("#nombre_ejecutor").val("");
      $("#identificacion_ejecutor").val("");
      $("#codigo_ejecutor").val("");
      $("#destinos_seleccionados").val("");
      llenar_ejecutor(0);
      <?php if(@$_REQUEST["formulario_autocompletar"] && @$_REQUEST["campo_autocompletar"]){
      echo('var campo=window.parent.document.'.$_REQUEST["formulario_autocompletar"].'.'.$_REQUEST["campo_autocompletar"].";");
      echo 'campo.value="";';} ?>
    });
    $("#estado_actualizacion").bind("change", function() {
          //alert($(this).text())
          //llenar_ejecutor();
    });
    $(".tipo_ejecutor").click(function(){
        if($(this).val()==2){
          $("#label_nombre").html('<?php echo($etiquetas["nombre_pj"]);?>');
        }else{
          $("#label_nombre").html('<?php echo($etiquetas["nombre"]);?>');
        }
        llenar_ejecutor($("#idejecutor").val());
    });
    $("#eliminar").click(function(e){  
      var f=$("#estado_actualizacion").find(":selected");
      if(f.val()!=0){
         $("#de_"+f.val()).remove();
         f.remove();
         campo_padre=(parent.<?php echo $_REQUEST["formulario_autocompletar"].".".$_REQUEST["campo_autocompletar"];?>);
         campo_padre.value=($("#estado_actualizacion option").map(function() {if($(this).val()!=="0"){return $(this).val();} else return;}).get());
        }   
    });
    function mostrar_ejecutor(){
      var selected = $("#seleccionados_ejecutor option:selected");
      if(selected.val() != 0){
      //alert(selected.text());
      }
    }
    function llenar_llamado(){
      <?php
         if(@$_REQUEST["formulario_autocompletar"] && @$_REQUEST["campo_autocompletar"]){
          echo('var campo=window.parent.document.'.$_REQUEST["formulario_autocompletar"].'.'.$_REQUEST["campo_autocompletar"].";");
      }
      ?>
      if($("#destinos_seleccionados").val()>0){
      if(campo.value=="" || "unico"=="<?php echo $_REQUEST['tipo'];?>")
      campo.value=$("#destinos_seleccionados").val();
      else
      campo.value+=","+$("#destinos_seleccionados").val();
      }
     // alert(campo.value);
    }
    function llenar_ejecutor(id){
      var lista_campos='';
      var tipo_ejecutor=$(".tipo_ejecutor:checked").val();
      $("#idejecutor").val(id);
      if(tipo_ejecutor==2){
          //persona juridica
          lista_campos='<?php echo(implode(',',$orden_campos_pj));?>';
      }
      else{
          //Persona natural
          lista_campos='<?php echo(implode(',',$orden_campos_pn));?>';
      }
      $.ajax({
        type:'POST',
        url:'generar_ejecutor.php',
        data:'idejecutor='+id+"&campos="+lista_campos,
        success: function(datos,exito){
          $("#datos_ejecutor").empty();
          $("#datos_ejecutor").append(datos);
        }
      });
    }
  });
  
	function cargar_datos(idejecutor,nombre,identificacion,direccion,titulo,telefono,cargo,email){			
		$("#ul_completar").empty();
		
		if(idejecutor!=0){			
			$("#identificacion_ejecutor").val(identificacion);
			$("#direccion_ejecutor").val(direccion);
			$("#nombre_ejecutor").val(nombre);
			$("#buscar_nombre").val(nombre);			
			$("#telefono_ejecutor").val(telefono);
			$("#cargo_ejecutor").val(cargo);
			$("#email_ejecutor").val(email);
			
			/*if(!$("#informacion_buscar_nombre").length){
				$("#buscar_nombre").after("<table id='informacion_buscar_nombre'></table>");
			}
			$("#informacion_buscar_nombre").append("<tr id='fila_"+idejecutor+"'><td>"+nombre+"</td><td><img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' registro='"+idejecutor+"' onclick='eliminar_asociado("+idejecutor+");'></td></tr>");*/
			
			
			/*if($("#nombre_ejecutor").val()!=''){
				$("#nombre_ejecutor").val($("#buscar_nombre").val());
				
			}
			else{
				$("#nombre_ejecutor").val(idejecutor);
			}
			$("#buscar_nombre").val("");*/
		}
	};
	function eliminar_asociado(idejecutor){
		$("#fila_"+idejecutor).remove();
		var datos=$("#nombre_ejecutor").val().split(",");
		var cantidad=datos.length;
		var nuevos_datos=new Array();
		var a=0;
		for(var i=0;i<cantidad;i++){
			if(idejecutor!=datos[i]){
				nuevos_datos[a]=datos[i];
				a++;
			}
		}
		var datos_guardar=nuevos_datos.join(",");
		$("#nombre_ejecutor").val(datos_guardar);
	} 
  </script>
  <!--<script type="text/javascript" src="../../js/jquery.js"></script>
  <script type='text/javascript' src='../../js/jquery.autocomplete.js'></script>
  <script type='text/javascript' src='../../js/jquery.bgiframe.min.js'></script>-->
  <script src="../../assets/theme/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
  <script src="../../assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <script type="text/javascript" src="../../assets/theme/assets/plugins/select2/js/select2.full.min.js"></script>
  </body>
</html>
<?php
if(@$_REQUEST['funcion']){
	$funcion_parametros=explode('@',$_REQUEST['funcion']);
  if(count($funcion_parametros)>1){
  	echo($funcion_parametros[0](implode(',',$funcion_parametros[1])));
  }else{
  	echo($_REQUEST['funcion']());
  }	 
}
?>
