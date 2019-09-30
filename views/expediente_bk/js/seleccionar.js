$(document).ready(function () {
    var params = $("#scriptSeleccionar").data("params");

    var configuracion = {
        icon: false,
        lazy: false,
        autoScroll: true,
        strings: {
            loadError: "Error en la carga!",
            moreData: "Mas...",
            noData: "Cargando...."
        },
        selectMode: 1,
        source: {
            url: `${params.baseUrl}app/arbol/arbol_expediente_funcionario.php`,
            data: {
                'onlyExp': 1
            }
        }
    };
    $("#treebox").fancytree(configuracion);

    $("#formulario").validate({
        submitHandler: function (form) {
            let selExp = $('#treebox').fancytree('getTree').getSelectedNodes();
            if (selExp.length) {
                let idexp = selExp[0].data.idexpediente;
                let options = {
                    url: `views/expediente/adicionar_expediente.php`,
                    params: {
                        codPadre: idexp,
                        panelId: -1
                    },
                    size: "modal-lg",
                    title: "ADICIONAR EXPEDIENTE/SEPARADOR",
                    centerAlign: false,
                    buttons: {}
                };
                top.topModal(options);
            } else {
                top.notification({
                    message: 'Por favor seleccione el expediente superior',
                    type: "error",
                    duration: 3000
                });
                return false;
            }
        }
    });
});
