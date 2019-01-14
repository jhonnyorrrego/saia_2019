$(function () {
    let key = localStorage.getItem('key');
    let baseUrl = $('script[data-baseurl]').data('baseurl');
    let params = $('script[data-params]').data('params');

    (function init() {
        loadDocument();
        loadHeader();
    })();

    $(document).off("click", ".new_add");
    $(document).on("click", ".new_add", function () {
        let type = $(this).data('type');
        
        if (type == 'comunication' || type == 'process') {
            let param = type == 'comunication' ? 5 : 3;
            let title = type == 'comunication' ? 'Comunicaciones' : 'Tramites generales';
            var data = JSON.stringify([
                {
                    kConnector: "html.page",
                    url: "pantallas/formato/listar_proceso_formatos.php",
                    kTitle: "Procesos"
                },
                {
                    kConnector: "html.page",
                    url: "pantallas/formato/listar_formatos.php?idcategoria_formato=" + param,
                    kTitle: title
                }
            ]);
            let route = `${baseUrl}views/dashboard/kaiten_dashboard.php?panels=${data}`;
            $('#iframe_dinamictab_acordion').attr('src', route);
            $('#dinamictab_acordion').show();
            $('#first_ocordion_card').find('a[data-toggle="collapse"]').trigger('click');
            $('#right_workspace').scrollTop($('#dinamictab_acordion').position().top);
        }
    });

    function loadHeader() {
        let route = `${baseUrl}views/documento/encabezado.php?documentId=${params.documentId}`;
        
        if (params.transferId) {
            route += `&transferId=${params.transferId}`;
        }
            
        $('#document_header').load(route);
    }

    function loadDocument() {
        let route = `${baseUrl}formatos/${params.format}/mostrar_${params.format}.php?iddoc=${params.documentId}&key=${key}`;
        $('#view_document').load(route);
    }
});