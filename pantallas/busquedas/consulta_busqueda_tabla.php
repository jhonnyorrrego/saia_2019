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
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Consulta de informaci&oacute;n</title>
<?php

include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/documento/librerias.php");
echo(librerias_html5());
echo(estilo_bootstrap("3.2"));
echo estilo_tabla_bootstrap("1.11");

$funciones=array();
$datos_componente=$_REQUEST["idbusqueda_componente"];
$datos_busqueda=busca_filtro_tabla("","busqueda A,busqueda_componente B","A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=".$datos_componente,"",$conn);
echo(librerias_jquery("1.8"));
echo(librerias_bootstrap("3.2"));
echo(librerias_notificaciones());
if($datos_busqueda[0]["ruta_libreria"]){
  $librerias=array_unique(explode(",",$datos_busqueda[0]["ruta_libreria"]));
  array_walk($librerias,"incluir_librerias_busqueda");
}
function incluir_librerias_busqueda($elemento,$indice){
  global $ruta_db_superior;
  include_once($ruta_db_superior.$elemento);
}

//echo librerias_tabla_bootstrap("1.11", false, true);
//echo librerias_tabla_bootstrap("1.11");
$exportar = !empty($datos_busqueda[0]["exportar"]);

echo librerias_tabla_bootstrap("1.11", false, false);

?>

</head>
<body>
  <div class="container" style="width:auto;">
  <div class="row">
    <form class="formulario_busqueda" accept-charset="UTF-8" action="" id="kformulario_saia" name="kformulario_saia" method="post" style="padding:0px;margin:0px;">
      <input type="hidden" name="sord" id="sord" value="desc">
      <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo(@$_REQUEST["idbusqueda_componente"]);?>">
      <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
      <input type="hidden" name="idbusqueda_filtro_temp" id="idbusqueda_filtro_temp" value="<?php echo(@$_REQUEST["idbusqueda_filtro_temp"]);?>">
      <input type="hidden" name="cantidad_total" id="cantidad_total" value="">
      <input type="hidden" name="rows" id="rows" value="20">
    </form>
  </div>
  <div id="div_resultados">
   <div class="btn-group" id="menu_buscador">
      <?php
        if($datos_busqueda[0]["busqueda_avanzada"]!=''){
          if(strpos($datos_busqueda[0]["busqueda_avanzada"],"?"))
            $datos_busqueda[0]["busqueda_avanzada"].="&";
          else
            $datos_busqueda[0]["busqueda_avanzada"].="?";
         $datos_busqueda[0]["busqueda_avanzada"].='idbusqueda_componente='.$datos_busqueda[0]["idbusqueda_componente"];
      ?>
        <button class="btn kenlace_saia" titulo="B&uacute;squeda <?php echo($datos_busqueda[0]['etiqueta']);?>" title="B&uacute;squeda <?php echo($datos_busqueda[0]['etiqueta']);?>" conector="iframe" enlace="<?php echo($datos_busqueda[0]['busqueda_avanzada']);?>">B&uacute;squeda &nbsp;</button>
      <?php
        }
      ?>
      <!-- <button class="btn dropdown-toggle" data-toggle="dropdown">Seleccionados &nbsp;
        <span class="caret">
        </span>&nbsp;
      </button>
      <ul class="dropdown-menu" id='listado_seleccionados'>
        <li><a href="#"><div id="filtrar_seleccionados">Alert seleccionados</div></a></li>
        <?php
          if($datos_busqueda[0]["acciones_seleccionados"]!=''){
            echo('<li class="nav-header">Acciones</li>');
          $acciones=explode(",",$datos_busqueda[0]["acciones_seleccionados"]);
          $cantidad=count($acciones);
          for($i=0;$i<$cantidad;$i++){
              echo($acciones[$i]());
          }

          }
        ?>
      </ul> -->
    <?php /*if(@$datos_busqueda[0]["enlace_adicionar"]){
      ?>
        <button class="btn kenlace_saia" conector="iframe" id="adicionar_pantalla" destino="_self" title="Adicionar <?php echo($datos_busqueda[0]["etiqueta"]); ?>" titulo="Adicionar <?php echo($datos_busqueda[0]["etiqueta"]); ?>" enlace="<?php echo($datos_busqueda[0]["enlace_adicionar"]); ?>">Adicionar</button></div></li>
      <?php
    }*/
    ?>
    <?php /*if(@$datos_busqueda[0]["menu_busqueda_superior"]){
        $funcion_menu=explode("@",$datos_busqueda[0]["menu_busqueda_superior"]);
        echo($funcion_menu[0](@$funcion_menu[1]));
    }*/
       ?>
       <button class="btn btn-primary exportar_listado_saia" enlace="pantallas/documento/busqueda_avanzada_documento.php" title="Exportar reporte" id="boton_exportar_excel" style="">Exportar a excel</button>
       <div class="pull-right" valign="middle"><iframe name="iframe_exportar_saia" id="iframe_exportar_saia" allowtransparency="1" frameborder="0" framespacing="2px" scrolling="no" width="100%" src=""  hspace="0" vspace="0" height="32px"></iframe></div>
      <?php

      $llave = null;
      preg_match("/(\w*)\.(\w*)/", $datos_busqueda[0]["llave"], $valor_campos);
      if(!empty($valor_campos)) {
          $llave = $valor_campos[2];
      } else {
        $llave = trim($datos_busqueda[0]["llave"]);
      }

    ?>
  </div>
  <table id="tabla_resultados"
  data-height=""
  data-pagination="true"
  data-toolbar="#menu_buscador"
  data-show-refresh="true"
  data-show-toggle="true"
  data-maintain-selected="true"
  >
    <thead>
      <tr>
        <th data-field="state" data-checkbox="true"></th>
        <?php
        $lcampos1=$datos_busqueda[0]["campos"];
        if($datos_busqueda[0]["campos_adicionales"]){
          $lcampos1.=','.$datos_busqueda[0]["campos_adicionales"];
        }
        $lcampos2=explode(",",$lcampos1);
        $lcampos=array();
        foreach($lcampos2 AS $key=>$valor){
          if(strpos($valor,".")){
            $valor_campos=explode(".", $valor);
            array_push($lcampos,trim($valor_campos[count($valor_campos)-1]));
          }
          else{
            array_push($lcampos,trim($valor));
          }
        }
        $info=explode("|-|",$datos_busqueda[0]["info"]);
        $can_info=count($info);
        for($i=0;$i<$can_info;$i++){
          $detalle_info=explode("|",$info[$i]);
          $dato_campo=str_replace(array("{*","*}"),"",$detalle_info[1]);
          if(!in_array($dato_campo,$lcampos)){
            $funcion=explode("@",$dato_campo);
            $dato_campo=$funcion[0];
          }
          echo('<th data-field="'.$dato_campo.'" data-align="'.$detalle_info[2].'" >'.$detalle_info[0].'</th>');

        }
        ?>
      </tr>
    </thead>
  </table>
</div>

<div class="cargando"></div>
</body>
</html>
<script>

var $table = $('#tabla_resultados');
var llave = "<?php echo($llave); ?>";
//var selections = [];
var selections=[[0,-1]];
var paginaActual = 1;

$body = $("body");

$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
    ajaxStop: function() { $body.removeClass("loading"); }
});
  function jsonConcat(o1, o2) {
   for (var key in o2) {
    o1[key] = o2[key];
   }
   return o1;
  }
$.fn.serializeObject = function(){
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

$(document).ready(function() {
    //var alto=$(window).height()-80;
    $table.bootstrapTable({
        method: 'get',
        cache: false,
        height: getHeight(),
        striped: true,
        pagination: true,
        minimumCountColumns: 1,
        clickToSelect: true,
        sidePagination: 'server',
        pageSize: $("#rows").val(),
        search: false,
        cardView:false,
        pageList:[5, 10, 25, 50, 100],
        paginationVAlign:'top',
        showColumns: true,
        maintainSelected: true,
        idField: llave,
        responseHandler: "responseHandler",
        icons : {
            refresh: 'glyphicon-refresh icon-refresh',
            toggle:  'glyphicon-list-alt icon-list-alt',
            columns: 'glyphicon-th icon-th',
            advancedSearchIcon: 'glyphicon-chevron-down'
        },
        rowStyle: function rowStyle(row, index) {
        	  return {
        	    classes: 'text-nowrap another-class',
        	    css: {"font-size": "10px"}
        	  };
        	}
    });

    $table.on('check.bs.table uncheck.bs.table ' +
            'check-all.bs.table uncheck-all.bs.table', function () {

    	// save your data, here just save the current page
        selections[paginaActual] = getIdSelections();
        // push or splice the selections if you want to save all data selections
    });
});

function responseHandler(res) {

	//console.log(res);
	var options = $table.bootstrapTable('getOptions');

    //Get the page number
    paginaActual = options.pageNumber;

    var total = res.records;
    res.total = total;
    if(res.rows) {
    $.each(res.rows, function (i, row) {
        row.state = $.inArray(row[llave], selections[paginaActual]) !== -1;
    });
    }
    //console.log(selections[paginaActual]);
    return res;
}

function getIdSelections() {
	//console.log($table.bootstrapTable('getSelections'));

    return $.map($table.bootstrapTable('getSelections'), function (row) {
        //console.log(row[llave]);
        return row[llave];
    });
}

function procesamiento_buscar(externo) {
    var data = $('#kformulario_saia').serializeObject();
    $('#tabla_resultados').bootstrapTable('refreshOptions', {
        url: 'servidor_busqueda.php',
        queryParams: function (params) {
            var pagina=1;
            if($("#rows").val()!=0) {
                pagina=(params.offset/$("#rows").val())+1
            }
            var q = {
                "rows": $("#rows").val(),
                "numfilas":$("#rows").val(),
                "actual_row": params.offset,
                "pagina":pagina,
                "search": params.search,
                "sort": params.sort,
                "order": params.order,
                "cantidad_total":$("#cantidad_total").val()
            };
            $.extend( data, q);
            //console.log(params);
            return data;
        },
        onLoadSuccess: function(data){
          $("#cantidad_total").val(data.total);
        }
    });
    return false;
}

function getHeight() {
    return $(window).height() - $('h1').outerHeight(true);
}

$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
      $("#ksubmit_saia").click();
    }
});

$(document).ready(function() {
  $("#filtrar_seleccionados").click(function(){
      alert('getSelections: ' + JSON.stringify($("#tabla_resultados").bootstrapTable('getSelections')));
  });
  procesamiento_buscar();
  $("#kformulario_saia").submit(function(){
      procesamiento_buscar();
      return true;
  });
});

</script>
<?php
echo(librerias_tooltips());
echo(librerias_acciones_kaiten());

if($datos_busqueda[0]["ruta_libreria_pantalla"]) {
  $librerias=explode(",",$datos_busqueda[0]["ruta_libreria_pantalla"]);
  foreach($librerias AS $key=>$valor){
    include_once($ruta_db_superior.$valor);
  }
}
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior."pantallas/lib/main.js");?>"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior."pantallas/lib/librerias_ventana_modal.js");?>"></script>
