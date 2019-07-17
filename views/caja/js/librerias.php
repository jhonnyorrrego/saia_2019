<script>
$(document).ready(function () {
  var baseUrl = $("script[data-baseurl]").data('baseurl');

  // Informacion de la caja
  $(document).on("click", ".infoCaja", function () {
    let idcaja = $(this).data("id");

    let options = {
      url: `${baseUrl}views/caja/informacion.php`,
      params: {
        idcaja: idcaja
      },
      size: "modal-lg",
      title: "",
      centerAlign: false,
      buttons: {}
    };
    top.topModal(options);

  });

  // Eliminar la Caja
  $(document).on("click", ".delCaja", function () {
    let idcaja = parseInt($(this).data("id"));

    top.confirm({
      drag: false,
      overlay: true,
      close: false,
      type: 'error',
      title: 'Eliminar!',
      message: 'Desea eliminar tambien los expedientes?',
      position: 'center',
      timeout: 0,
      inputs: [
        ['<select><option value="1">SI</option><option value="0">NO</option></select>']
      ],
      buttons: [
        [
          '<button><b>Confirmar</b></button>',
          function (instance, toast, button, e, inputs) {
            let select=inputs[0].options[inputs[0].selectedIndex].value;
              $.ajax({
                type: 'POST',
                url: `${baseUrl}app/expediente/ejecutar_acciones.php`,
                data: {
                  methodInstance:'deleteCajaCont',
                  nameInstance:'CajaController',
                  eliminar_expediente: select,
                  idcaja:idcaja
                },
                dataType: 'json',
                success: function (objeto) {
                    if (objeto.exito) {
                      $("#table").bootstrapTable('remove', {field: 'id',values: [idcaja]});
                      top.notification({
                        message: objeto.message,
                        type: "success",
                        duration: 3000
                      });
                    } else {
                      top.notification({
                        message: objeto.message,
                        type: "error",
                        duration: 3000
                      });
                    }
                },
                error: function () {
                    top.notification({
                      message: "Error al procesar la solicitud (eliminar caja)",
                      type: "error",
                      duration: 3000
                    });
                }
            });
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
          },
          true
        ],
        [
          '<button>Cancelar</button>',
          function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
          }
        ],
      ]
    });
  });

});

</script>