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

require_once $ruta_db_superior . "controllers/autoload.php";

$opcion = $_REQUEST['opcion'];
if ($opcion) {
  if ($opcion == 1) {
    $idexpediente = $_REQUEST['idexpediente'];
    $Expediente = new Expediente($idexpediente);
    if (!$idexpediente || !$Expediente->getAccessUser("c")) {
      return;
    }
    $ids = $_REQUEST["idexpediente"];
  } else {
    $idexpediente = explode(",", $_REQUEST["ids"]);
    if (!count($idexpediente)) {
      return;
    }
    $ids = $_REQUEST["ids"];
  }
} else {
  return;
}

$params = [
  'idexpediente'=>$idexpediente,
  'baseUrl'=> $ruta_db_superior
];

include_once $ruta_db_superior . 'assets/librerias.php';
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>SAIA - SGDEA</title>
		<?= jquery() ?>
		<?= bootstrap() ?>
		<?= theme() ?>
    <?= icons() ?>
    <?= validate() ?>
    <?= select2() ?>
	</head>

  <body>
    <div class="container m-0 p-0 mw-100 mx-100">
      <div class="row mx-0">
        <div class="col-12">

            <form id="formularioExp" name="formularioExp" class="form-horizontal">
              <div class="form-group row">
                <label for="nombre" class="col-md-3 control-label">Nombre del funcionario</label>
                <div class="col-md-9">
                  <select class="form-control" id="nombre" name="nombre" placeholder="Nombre del funcionario" required="">
                  </select>
                </div>
              </div><br>
              
              <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" id="idexpediente" name="idexpediente" value="<?= $ids; ?>">
                  <button class="btn btn-primary" id="guardarPermiso">Compartir</button>
                </div>
              </div>
            </form>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Funcionario</th>
                  <th scope="col">Expediente</th>
                  <th scope="col">Eliminar</th>
                </tr>
              </thead>
              <tbody id="data-table">
              </tbody>
            </table>

        </div>
      </div>
    </div>
        
    <script type="text/javascript">
      $(document).ready(function (){
        var params=<?=json_encode($params)?>;

        var loadTable=function(){
          $.ajax({
            type : 'POST',
            async:false,
            url: `${params.baseUrl}pantallas/expediente/ejecutar_acciones.php`,
            data: {methodExp:'getPermisoExpedienteCont',idexpediente:params.idexpediente},
            dataType: 'json',
            success: function(response){
              if(response.exito){
                $("#data-table").empty();
                if(response.data.length){
                  $.each(response.data, function( index, row ) {
                    let tr=`<tr id="tr_${row.idpermiso}">
                      <td>${row.funcionario}</td>
                      <td>${row.nombreExpediente}</td>
                      <td><button class="btn btn-danger" data-id="${row.idpermiso}"><i class="fa fa-trash"></i></button></td>
                    </tr>`;
                    $("#data-table").append(tr);
                  });
                  
                }else{
                  $("#data-table").append('<tr id="row-0"><td colspan="3">SIN FUNCIONARIOS</td></tr>')
                }
              }else{
                top.notification({
                  message : response.message,
                  type : "error",
                  duration : 3000
                });
              }
            },
            error : function() {
              top.notification({
                message : "Error al procesar la solicitud",
                type : "error",
                duration : 3000
              });
            }
          });
        }
        loadTable();

        $(document).on("click",".btn-danger",function(){
          if(confirm("Esta seguro de Eliminar el permiso?")){
            var idpermisoExpediente=$(this).data("id");
            
            $.ajax({
              type : 'POST',
              async:false,
              url: `${params.baseUrl}pantallas/expediente/ejecutar_acciones.php`,
              data: {methodExp:'deletePemisoExpedienteCont',idpermiso:idpermisoExpediente},
              dataType: 'json',
              success: function(response){
                if(response.exito){
                  loadTable();
                  top.notification({
                    message : response.message,
                    type : "success",
                    duration : 3000
                  });
                }else{
                  top.notification({
                    message : response.message,
                    type : "error",
                    duration : 3000
                  });
                }
              },
              error : function() {
                top.notification({
                  message : "Error al procesar la solicitud",
                  type : "error",
                  duration : 3000
                });
              }
            });

          }
        });
        
        $('#nombre').select2({
          multiple:true,
          minimumInputLength: 4,
          ajax: {
            url: `${params.baseUrl}pantallas/expediente/ejecutar_acciones.php`,
            dataType: 'json',
            quietMillis: 1000,
            data: function (params) {
              var query = {
                search: params.term,
                methodExp: 'listFuncionarios'
              }
              return query;
            },
            processResults: function (data, params) {
                return {
                    results: data.results,
                    pagination: {
                        more: false
                    }
                };
            },
            cache:true
          }
        });

        $("#formularioExp").validate({
          rules : {
            nombre : {
              required : true
            },
            idexpediente : {
              required : true
            }
          },
          submitHandler : function(form) {
            $("#guardarPermiso").attr('disabled',true);
            let idexpediente=$("#idexpediente").val();
            let funcionario=$("#nombre").val();
            $('#nombre').val(null).trigger('change');
            $.ajax({
              type : 'POST',
              async:false,
              url: `${params.baseUrl}pantallas/expediente/ejecutar_acciones.php`,
              data: {methodExp:'insertPemisoExpedienteCont',idsExp:idexpediente,idfuncionario:funcionario},
              dataType: 'json',
              success: function(response){
                if(response.exito){
                  loadTable();
                  let typeMessage="success";
                  if(response.exito==2){
                    typeMessage="warning";
                  }
                  top.notification({
                    message : response.message,
                    type : typeMessage,
                    duration : 3000
                  });
                }else{
                  top.notification({
                    message : response.message,
                    type : "error",
                    duration : 3000
                  });
                }
              },
              error : function() {
                top.notification({
                  message : "Error al procesar la solicitud",
                  type : "error",
                  duration : 3000
                });
              }
            });
          }
        });

      });
    </script>
  </body>           
</s>