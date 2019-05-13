$(function () {
    let baseUrl = $('script[data-baseurl]').data('baseurl');
    let params = $('script[data-params]').data('params');
    let baseFontSize = 0;

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
        let route = `${baseUrl}views/documento/anexos.php`;
        $('#files_tab').load(route, {
            documentId: params.documentId
        });
        showTab('#filestab_accordion');
    });

    $(window).resize(function () {
        changeDocumentDimensions()
    });

    window.addEventListener(
        "orientationchange",
        function () {
            setTimeout(() => {
                changeDocumentDimensions();
            }, 500);
        },
        false
    );

    function showTab(selector) {
        $("#accordion [role='tabcard']").removeClass('show');
        $("#accordion [aria-expanded='true']").attr('aria-expanded', 'false').addClass('collapsed');
        $('#right_workspace').scrollTop($(selector).position().top);
        $(selector).show().find('a[data-toggle="collapse"]').trigger('click');
    }

    function getFormatInformation() {
        $.post(`${baseUrl}app/formato/consulta_rutas.php`, {
            documentId: params.documentId,
            key: localStorage.getItem('key'),
            token: localStorage.getItem('token')
        }, function (response) {
            let route = baseUrl + response.data.ruta_mostrar
            $('#view_document').load(route, function () {
                $('#acordeon_container').attr('data-location', response.data.ruta_mostrar);
                changeDocumentDimensions();
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

    function changeDocumentDimensions() {
        if (!baseFontSize) {
            baseFontSize = $('#documento').css('font-size');
            baseFontSize = +baseFontSize.replace('px', '');
        }
        
        let breakpoint = localStorage.getItem('breakpoint');
        let newFontSize = 0;

        if (breakpoint == 'md' || breakpoint == 'lg') {
            newFontSize = baseFontSize;
        } else {
            let mdBreakPoint = 992;
            let windowWidth = $(window).width();
            /**
             * 992 -> baseFontSize
             * windowWidth -> ?
             */
            newFontSize = (windowWidth * baseFontSize) / mdBreakPoint;           
        }

        $('#documento').css('font-size', newFontSize);
        /**
         * baseFontSize -> 100
         * newFontSize -> ?
         */
        let relation = (newFontSize * 100) / baseFontSize;
        changeImageSize(relation);
    }

    function changeImageSize(relation) {
        $("#documento img").each(function () {
            if (!$(this).attr('data-basedimensions')) {
                $(this).attr('data-basedimensions', JSON.stringify({
                    width: $(this).width(),
                    height: $(this).height()
                }));
            }

            let dimensions = JSON.parse($(this).attr('data-basedimensions'));
            /**
             * 100 -> baseDimension
             * relation -> ?
             */
            $(this).width((relation * dimensions.width) / 100);
            $(this).height((relation * dimensions.height) / 100);
        });
    }
});