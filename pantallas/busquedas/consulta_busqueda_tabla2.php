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
ini_set("display_errors",true);
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/documento/librerias.php");

echo(estilo_bootstrap("3.2"));
echo estilo_tabla_bootstrap("1.11");

$funciones=array();
$datos_componente=$_REQUEST["idbusqueda_componente"];
$datos_busqueda=busca_filtro_tabla("","busqueda A,busqueda_componente B","A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=".$datos_componente,"",$conn);
echo(librerias_jquery("1.8"));
echo(librerias_bootstrap("3.2"));
echo librerias_tabla_bootstrap("1.11");

if($datos_busqueda[0]["ruta_libreria"]){
  $librerias=array_unique(explode(",",$datos_busqueda[0]["ruta_libreria"]));
  array_walk($librerias,"incluir_librerias_busqueda");
}

function incluir_librerias_busqueda($elemento,$indice){
  global $ruta_db_superior;
  include_once($ruta_db_superior.$elemento);
}


?>

</head>
<body>
  <div class="container">
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

  <div class="row">

  <table id="tabla_resultados" data-toggle="tabla_resultados"
  data-url="servidor_busqueda.php"
  data-side-pagination="server"
  data-height="100%" data-pagination="true" data-toolbar="#menu_buscador" data-show-refresh="true" data-show-toggle="true"
           data-page-size="5" data-page-list="[5, 10, 20, 50, 100, 200]"
           data-pagination-first-text="Primero"
           data-pagination-pre-text="Anterior"
           data-pagination-next-text="Siguiente"
           data-pagination-last-text="Ultimo">
    <thead>
      <tr>
        <th data-field="<?php echo($llave); ?>" data-checkbox="true"></th>
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
</div>

</body>

<script>
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
    console.log(o);
    return o;
};

$(document).ready(function() {
    var alto=$(document).height()-80;
    $('#tabla_resultados').bootstrapTable({
        method: 'get',
        cache: false,
        striped: true,
        minimumCountColumns: 1,
        clickToSelect: true,
        sidePagination: 'server',
        search: true,
        cardView:false,
        showColumns: true,
        pageSize: 5,
        icons : {
            refresh: 'glyphicon-refresh icon-refresh',
            toggle:  'glyphicon-list-alt icon-list-alt',
            columns: 'glyphicon-th icon-th'
        }
    });
});

function procesamiento_buscar(externo) {
    var data = $('#kformulario_saia').serializeObject();
    $('#tabla_resultados').bootstrapTable('refreshOptions', {
        url: 'servidor_busqueda.php',
        queryParams: function (params) {
            var pagina=1;
            if($("#rows").val()!=0) {
                pagina=(params.offset/$("#rows").val())+1
            }
            console.log(params);
            var q = {
                "rows": 5,
                "numfilas":5,
                "actual_row": params.offset,
                "pagina":pagina,
                "search": params.search,
                "sort": params.sort,
                "order": params.order,
                "cantidad_total":$("#cantidad_total").val()
            };
            $.extend( data, q);
            //console.log(q);
            return data;
        },
        responseHandler: function(res) {
            //console.log(res);
            var total = res.cantidad_total;
            res.total = total;
            return res;
        },
        onLoadSuccess: function(data){
            //Total trae el numero de paginas, cantidad_total trae el total de registros, records trae el total de registros
            var total = data.cantidad_total;
            //data.total = total;
          $("#cantidad_total").val(total);
          //console.log(data);
          //$(".page-list").toggle();
          //$(".pagination").css("display", "block");
        }
    });
    return false;
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
</html>
