<?php
include_once("header.php");
include_once("db.php");
//print_r($_REQUEST);
if(@$_REQUEST["accion"]){ 
  switch($_REQUEST["accion"]){
    case 'vincular':
    $padre=busca_filtro_tabla("tipo_registro","ft_ingreso_elementos","documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
    
    $fecha=fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s");
    if($padre[0][0]=="Entrada")
      $campo="fecha_ingreso";
    else
      $campo="fecha_salida";  
    $sql="insert into acceso_elemento(documento_iddocumento,ft_ingreso_elementos,$campo) values('".$_REQUEST["documento_iddocumento"]."','".$_REQUEST["anterior"]."',$fecha)";
   phpmkr_query($sql,$conn);
    $sql="insert into respuesta(destino,origen,plantilla) values('".$_REQUEST["documento_iddocumento"]."','".$_REQUEST["anterior"]."','ITEM_ELEMENTO_INGRESO')";
   phpmkr_query($sql,$conn);
    echo "<script>window.parent.ingreso.history.go(0);
          </script>";
   	break;	
  }
}
?>
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
 <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
 <script>
 
 $().ready(function() {
  
	function formatItem(row) {
		return row[2] + " (<strong>categoria: " + row[3] + "</strong>)";
	}
	function formatResult(row) { 
		 return row[2].replace(/(<.+?>)/gi, '');
	}
	$("#codigo_elemento").autocomplete('formatos/item_elemento_ingreso/buscar_items.php', {
		width: 500,
		max:20,
    scroll: true,
		scrollHeight: 150,
		matchContains: true,
    minChars:2,
    formatItem: formatItem,
    formatResult: function(row) {
		return row[2];
		}
	});
	$("#codigo_elemento").result(function(event, data, formatted) {
		if (data){          
     $("#tabla_items").show();               
     $("#categoria").empty();
     $("#categoria").append(data[3]);
     $("#descripcion").empty();
     $("#descripcion").append(data[4]);
     $("#idft_elemento_ingreso").val(data[0]);
     $("#documento_iddocumento").val(data[1]);   
     $("#fotos").empty();
     $("#botones").show();
     mostrar_fotos_item();   
    }
	});
	$("#editar_item").click(function(){
    $("#accion").val('editar');
    window.open("formatos/item_elemento_ingreso/editar_item_elemento_ingreso.php?anterior="+$("#anterior").val()+"&mostrar_menu_ingreso=1&iddoc="+$("#documento_iddocumento").val(),"_self");
  });
	$("#vincular_item").click(function(){
    $("#accion").val('vincular');
    $("#busqueda_item").submit();
  });
  $("#adicionar_item").click(function(){
    $("#accion").val('adicionar');
    window.open("formatos/item_elemento_ingreso/adicionar_item_elemento_ingreso.php?anterior="+$("#anterior").val()+"&codigo_elemento="+$("#codigo_elemento").val(),"_self");
  });
  function mostrar_fotos_item(){
   $.ajax({
    type:'POST',
    url:'formatos/ingreso_elementos/buscar_fotos.php',
    data:'elemento='+$("#codigo_elemento").val(),
    success: function(datos,exito){
      $("#fotos").append(datos);
    }
  });
  }
 });
 </script>
<?php
if(isset($_REQUEST["anterior"])&&$_REQUEST["anterior"])
{
?>
<form method="POST" action="#" name="busqueda_item" id="busqueda_item">
  <table class="tabla_noborde" border="1px" width="100%" style="border-collapse:collapse;">
   <tr>
    <td colspan="2">
      Buscar:  
      <input type="text" name="codigo_elemento" value="" id="codigo_elemento"> &nbsp; &nbsp; &nbsp; &nbsp;
      <input type="button" name="adicionar_item" id="adicionar_item" value="Adicionar Item">
      <input type="hidden" name="accion" id="accion" value="">
      <input type="hidden" name="idft_elemento_ingreso" id="idft_elemento_ingreso" value="">
      <input type="hidden" name="documento_iddocumento" id="documento_iddocumento" value="">
    </td>
   </tr>
  </table><br>
  <table id="tabla_items" class="tabla_noborde" border="1px" width="100%" style="border-collapse:collapse; display:none;">
   <tr> 
    <td class="encabezado" width="40%">
      Categoria:
    </td>
    <td>
      <div id="categoria">
      </div>
    </td>
   </tr>
   <tr> 
    <td class="encabezado">
      Descripcion:
    </td>
    <td>    
      <div id="descripcion">
      </div>
    </td>
   </tr>
   <tr> 
    <td class="encabezado_list" colspan="2">
      Fotos:
    </td>
   </tr>
   <tr>
    <td colspan="2" align="center">    
      <div id="fotos" align="center">
      </div>
    </td>
   </tr> 
   <tr>
    <td colspan="2" align="center">
      <div id="botones"  style="display:none;"> 
      <input type="hidden" name="anterior" id="anterior" value="<?php echo $_REQUEST["anterior"]; ?>">
      <input type="button" name="vincular_item" id="vincular_item" value="Vincular">
      <input type="button" name="editar_item" id="editar_item" value="Editar">
      </div>
    </td>
   </tr>
  </table>
</form>
<?php
}
else
  echo "Debe hacer primero el registro del ingreso.";
include_once("footer.php");
?>