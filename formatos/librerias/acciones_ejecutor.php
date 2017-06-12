<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<?php
include_once("../../db.php");
include_once("../../librerias_saia.php");
	$raiz_saia='../../';
	echo(librerias_jquery('1.7'));
	echo(librerias_notificaciones());	
$campos_auto=explode(",",$_REQUEST["campos_auto"]);
$campos=explode(",",$_REQUEST["campos"]);
$etiquetas=array("titulo"=>"T&iacute;tulo","direccion"=>"Direcci&oacute;n","telefono"=>"Tel&eacute;fono","email"=>"Email","ciudad"=>"Ciudad","empresa"=>"Nombres y apellidos","identificacion"=>"Identificaci&oacute;n","nombre"=>"Nombres y apellidos","nombre_pj"=>"Entidad");
//Se adiciona el componente vacio porque no funciona la comparacion estricta 
$orden_campos_pn=array("","titulo","direccion","telefono","email","ciudad");
$orden_campos_pj=array("","direccion","ciudad","empresa","telefono","email");
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
</head>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type='text/javascript' src='../../js/jquery.autocomplete.js'></script>
<script type='text/javascript' src='../../js/jquery.bgiframe.min.js'></script>
<link rel="stylesheet" type="text/css" href="../../css/jquery.autocomplete.css" />
<style >
  body, input, select{
   font-family:verdana;
   font-size:x-small
  }
  table{
    border:0px groove;
  }
  input{
  width:200px;
  }
  .rotulo_nombre{
    width:400px;
    overflow:hidden;
    border:1px solid;
    float:left;
  }
  .rotulo_documento{
    width:200px;
    left:408px;
    overflow:hidden;
    border:1px solid;
    float:left;
  }
  .rotulo_accion{
    width:10px;
    left:6010px;
    overflow:hidden;
    border:1px solid;
    float:left;
  }

  .boton{
    border:1px solid;
    float:left;
    text-transform:UPPERCASE;
    border-color:gray;
    cursor:pointer;
    padding:3px;
    border-width: 2px;
    background-color: buttonface;
    border-style: outset;
    border-color: buttonface;
    border-image: initial;
    -webkit-appearance: push-button;
    padding: 2px 6px 3px;
  }
</style>
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
$().ready(function() {
	


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
    
	$("#nombre_ejecutor").autocomplete('../librerias/seleccionar_ejecutor.php?tipo=nombre', {
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
	$("#nombre_ejecutor").result(function(event, data, formatted) {
		if (data){
      $("#identificacion_ejecutor").val(data[2]);
      $("#codigo_ejecutor").val(data[5]);
			llenar_ejecutor(data[0]);
			if("unico"=="<?php echo $_REQUEST['tipo'];?>")
        {iddatos_ejecutor(data[0],data[4]);
        }
		}
	});
	$("#identificacion_ejecutor").result(function(event, data, formatted) {
		if (data){
		  $("#nombre_ejecutor").val(data[4]);
		  $("#codigo_ejecutor").val(data[5]);
			llenar_ejecutor(data[0]);
			if("unico"=="<?php echo $_REQUEST['tipo'];?>")
        {iddatos_ejecutor(data[0],data[4]);
        }
		}
	});
	/*$("#identificacion_ejecutor").keyup(function (event){
   if(event.keyCode<96 || event.keyCode>105)
     {actual=$("#identificacion_ejecutor").val();
      if(isNaN(actual)||actual.indexOf(".")>0)
      {if(isNaN(parseInt(actual)))
          $("#identificacion_ejecutor").val("");
         else
          $("#identificacion_ejecutor").val(parseInt(actual));
        }
     }
  });*/
   $("#identificacion_ejecutor").keyup(function (event){
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
	});
	//------------------------------------------Nuevo campo codigo------------------------------------------
	$("#codigo_ejecutor").autocomplete('../librerias/seleccionar_ejecutor.php?tipo=codigo', {
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
	});

	$("#codigo_ejecutor").keyup(function (event){
		$("#codigo_ejecutor").focus();
   if(event.keyCode<96 || event.keyCode>105)
     {actual=$("#codigo_ejecutor").val();
      if(isNaN(actual)||actual.indexOf(".")>0)
      {if(isNaN(parseInt(actual)))
          $("#codigo_ejecutor").val("");
         else
          $("#codigo_ejecutor").val(parseInt(actual));
        }
     }
  });

	//------------------------------------------------------------------------------------------------------
	$("#actualizar").click(function(){
    //titulo_ejecutor
    if($("#titulo_ejecutor").attr("type")=="text")
     	titulo=$("#titulo_ejecutor").val();
    else
      titulo=$("#titulo_ejecutor").find(':selected').val();

    //ciudad residencia
    if($("#ciudad").attr("type")=="hidden")
         ciudad=$("#ciudad").val();
       else
         ciudad=$("#ciudad").find(':selected').val();

    //lugar_expedicion
    if($("#lugar_expedicion").attr("type")=="hidden")
   	     lugar_exp=$("#lugar_expedicion").val();
     	 else
         lugar_exp=$("#lugar_expedicion").find(':selected').val();

    //lugar_nacimiento
    if($("#lugar_nacimiento").attr("type")=="hidden")
     	   ciudad_nac=$("#lugar_nacimiento").val();
     	 else
         ciudad_nac=$("#lugar_nacimiento").find(':selected').val();

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
        	//alert(datos);
          vector=datos.split("|");
          if("unico"=="<?php echo $_REQUEST['tipo'];?>")
            {$("#estado_actualizacion").html(vector[1]);
            }
          else
            {cadena="<option value='"+vector[0]+"' selected>"+vector[1]+"</option>";
             $("#estado_actualizacion").append(cadena);
            }

          $("#destinos_seleccionados").val(vector[0]);
          //$("#nombre_ejecutor").val("");
          //$("#identificacion_ejecutor").val("");
          //$("#codigo_ejecutor").val("");
          llenar_llamado();
          //llenar_ejecutor(0);
          notificacion_saia('<b>ATENCI&Oacute;N</b><br>Remitente actualizado satisfactoriamente','success','',4000);
          
        }
      });
    }
    else {
      alert("debe seleccionar el nombre");
    }
  });
  $("#limpiar").click(function(){
    $("#nombre_ejecutor").val("");
    $("#identificacion_ejecutor").val("");
    $("#codigo_ejecutor").val("");
    $("#destinos_seleccionados").val("");
    llenar_ejecutor(0);
  });
  $("#borrar_todos").click(function(){
    $("#estado_actualizacion").empty();
    if("multiple"=="<?php echo $_REQUEST['tipo'];?>")
      $("#estado_actualizacion").append('<option value="0">Listado de Seleccionados</option>');
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
      }
      else{
          $("#label_nombre").html('<?php echo($etiquetas["nombre"]);?>');
      }
      llenar_ejecutor($("#idejecutor").val());
  });
  $("#eliminar").click(function(){
    var f=$("#estado_actualizacion").find(":selected");
    if(f.val()!=0)
      {f.remove();
       campo_padre=(parent.<?php echo $_REQUEST["formulario_autocompletar"].".".$_REQUEST["campo_autocompletar"];?>);
       aux=eliminarItem(campo_padre.value,f.val());
       campo_padre.value=aux;
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
</script>
</head>
<body>
<form name="form1" id="form1">
  <table>
  <tr>
    <td width="150">
      <label>Seleccionados:</label>
    </td>
    <td>
    <?php
    if(isset($_REQUEST["iddoc"])&&$_REQUEST["iddoc"])
        {$destinos=busca_filtro_tabla($_REQUEST["campo_autocompletar"],$_REQUEST["tabla"],"documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
        if($destinos["numcapos"]);
         {$lista=busca_filtro_tabla("iddatos_ejecutor,nombre","datos_ejecutor,ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor in(".$destinos[0][0].")","nombre",$conn);

         }
         echo "<input type=hidden name='iddoc' value='".$_REQUEST["iddoc"]."'>";
        }

        if(isset($_REQUEST["destinos"])&&$_REQUEST["destinos"])
        {
        	if(@$_REQUEST["iddoc"]){
        		$iddoc=$_REQUEST["iddoc"];
        	}
			else{
				$iddoc=0;
			}
        	$destinos=busca_filtro_tabla($_REQUEST["campo_autocompletar"],$_REQUEST["tabla"],"documento_iddocumento=".$iddoc,"",$conn);
        if(@$destinos["numcapos"]);
         {$lista=busca_filtro_tabla("iddatos_ejecutor,nombre","datos_ejecutor,ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor in(".$_REQUEST["destinos"].")","nombre",$conn);
		if($_REQUEST["tipo"]!='unico'){
			for($i=0;$i<$lista["numcampos"];$i++)
				echo $lista[$i]["nombre"]."<br>";
	         }
		 }
        }
    if($_REQUEST["tipo"]=="multiple")
     {
    ?>
    </tr>
    <tr><td>
    <?php

        ?>
      <select id="estado_actualizacion" name="seleccionados_ejecutor" width="300">
        <option value="0">Listado de Seleccionados</option>
       <?php
       if(isset($lista)&&$lista["numcampos"])
       {for($i=0;$i<$lista["numcampos"];$i++)
          echo "<option value='".$lista[$i]["iddatos_ejecutor"]."'>".$lista[$i]["nombre"]."</option>";
       }
       ?>
      </select></td><td><div id="eliminar" class="boton">Quitar</div></td></tr></table>
      <?php
      }
    elseif($_REQUEST["tipo"]=="unico")
      {
       echo "<label id='estado_actualizacion'>".@$lista[0]["nombre"]."</label>";
      }
      ?>
    </td>
  </tr>
 </table>
 <table width="500px">
    <tr>
        <td colspan="2">
            Persona natural <input type="radio" name="tipo_ejecutor" value="1" class="tipo_ejecutor" id="tipo_ejecutor1" style="width:20px;" checked="checked">&nbsp;&nbsp;Persona Jur&iacute;dica <input type="radio" name="tipo_ejecutor" value="2" class="tipo_ejecutor" id="tipo_ejecutor2" style="width:20px">
        </td>
    </tr>     
  <?php
      foreach($campos_auto as $nombre){
          if($nombre<>"")
          echo '<tr>
                <td width="150">
                  <label id="label_'.$nombre.'">'.$etiquetas[$nombre].':</label>
                </td>
                <td>
                  <input type="text" id="'.$nombre.'_ejecutor" name="'.$nombre.'" /><br />
                </td>
              </tr>';
         }
         if($_REQUEST["tipo"]=="unico")
 {?>
</table>
<div id="datos_ejecutor">
</div>
<table width="500px">
  <tr >
    <td width="20%">
      <div id="borrar_todos" class="boton">QUITAR TODOS</div>
    </td>
    <td width="80%" align="left">
      <div id="actualizar" class="boton">ACTUALIZAR DATOS</div>
    </td>
  </tr>
</table>
<input type="hidden"  id="destinos_seleccionados" name="destinos_seleccionados">
</form>
</body>
</html>
 <?php
 }
 else
 {
     ?>
</table>
<div id="datos_ejecutor">
</div>
<table width="500px">
  <tr >
    <td width="30%">
      <div id="limpiar" class="boton">LIMPIAR FORMULARIO</div>
    </td>
    <td width="20%">
      <div id="borrar_todos" class="boton">QUITAR TODOS</div>
    </td>
    <td width="50%">
      <div id="actualizar" class="boton">ACTUALIZAR DATOS</div>
    </td>
  </tr>
</table>
<input type="hidden"  id="destinos_seleccionados" name="destinos_seleccionados">
<input type="hidden" id="idejecutor" name="idejecutor_temp" value="">
</form>
</body>
</html>
 <?php
 }
 
 if(@$_REQUEST['funcion']){
 	$funcion_parametros=explode('@',$_REQUEST['funcion']);
	if(count($funcion_parametros)>1){
		echo($funcion_parametros[0](implode(',',$funcion_parametros[1])));
	}else{
		echo($_REQUEST['funcion']());
	}	 
 }

 ?>
