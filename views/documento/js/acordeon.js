$(function () {
    let key = localStorage.getItem('key');
    let baseUrl = $('script[data-baseurl]').data('baseurl');
    let params = $('script[data-params]').data('params');

    (function init() {
        getFormatInformation();    
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
                    url: `pantallas/formato/listar_formatos.php?idcategoria_formato=${param}%26anterior=${params.documentId}`,
                    kTitle: title
                }
            ]);
            let route = `${baseUrl}views/dashboard/kaiten_dashboard.php?panels=${data}`;
            $('#iframe_dinamictab_accordion').attr('src', route);
            showTab('#dinamictab_accordion');
        }
    });

    $(document).off("click", "#show_history");
    $(document).on("click", "#show_history", function () {
        let route = `${baseUrl}views/documento/linea_tiempo.php`;
        $('#history_content').load(route, {
            documentId: params.documentId
        });
        showTab('#historytab_accordion');
    });

    $(document).off("click", "#show_files");
    $(document).on("click", "#show_files", function () {
        let route = `${baseUrl}views/pagina/pagina.php`;
        $('#files_tab').load(route, {
            documentId: params.documentId
        });
        showTab('#filestab_accordion');
    });    

    function showTab(selector) {
        $("#accordion [role='tabcard']").removeClass('show');
        $("#accordion [aria-expanded='true']").attr('aria-expanded', 'false').addClass('collapsed');
        $('#right_workspace').scrollTop($(selector).position().top);
        $(selector).show().find('a[data-toggle="collapse"]').trigger('click');
    }

    function getFormatInformation() {
        $.post(`${baseUrl}app/formato/consulta_rutas.php`, {
            documentId: params.documentId,
            key: localStorage.getItem('key')
        }, function (response) {
            let route = baseUrl + response.data.ruta_mostrar
            $('#view_document').load(route,function(){
                setSize();
            });
        }, 'json');
    }

    function loadHeader() {
        let route = `${baseUrl}views/documento/encabezado.php?documentId=${params.documentId}`;
        
        if (params.transferId) {
            route += `&transferId=${params.transferId}`;
        }
            
        $('#document_header').load(route);
    }

    function setSize() {
        let sizeDocument = localStorage.getItem('breakpoint');
        
            if (sizeDocument == 'xs') {
                var sizeFont = parseFloat($('#documento').css("font-size"));
                sizeFont = Math.round(sizeFont * 0.4);
                var sizeEncabezado = parseFloat($(".page_margin_top").css('height'));
                sizeEncabezado = Math.round(sizeEncabezado * 0.6);
                var sizePie = parseFloat($(".page_content").css('height'));
                sizePie = Math.round(sizePie * 0.600);
                $(".page_margin_top").css('height', sizeEncabezado+"px");
                $(".page_content").css('height', sizePie + "px");
                $('#documento').css("font-size", sizeFont+"px");
                $('#documento').find("img")
                $('#documento').find("p").css("font-size", sizeFont+"px")
                var contenidoImg = $("#documento").find("img");
                contenidoImg.each(function (i) { 
                    var sizeImg = parseFloat($(this).attr("width")); 
                    sizeImg = sizeImg * 2;
                    $(this).css("width", sizeImg+"%");
                });
                //$('#documento').find("p").css("font-size", "7px")
            }
    }
});