$(function () {
    let baseUrl = $('script[data-baseurl]').data('baseurl');
    let params = $('script[data-params]').data('params');
    let sizeFont = 0;

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
            $('#view_document').load(route, function () {
                sizeFont = $('#documento').find("p").css("font-size")
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

    window.addEventListener("orientationchange", function () {
        setTimeout(() => {
            setSize();
        }, 500);
    }, false);

    function setSize() {
        let sizeDocument = localStorage.getItem('breakpoint');
        setValores(sizeDocument);
    }

    function setValores(sizeDocument) {
        var xsFont = parseFloat(sizeFont);

        if (sizeDocument == 'sm') {
            var widthIni = 668;
        } else if (sizeDocument == 'xs') {
            var widthIni = 480;
        } else if (sizeDocument == 'xl') {
            var widthIni = 960;
        }

        var widthAct = parseFloat($(".page_content").css('width')) * xsFont / widthIni;
        var qrHeight = $("#qr").height();
        var width = $("#qr").width();
        if (sizeDocument == 'xs' || sizeDocument == 'sm') {
            $('#documento').css("font-size", widthAct + "px");
            $('#documento').find("p").css("font-size", widthAct + "px")
        }

        $('#documento').find("img")

        var contenidoImg = $("#documento").find("img:not('#qr,#logoEmpresa')");
        var contenidoQr = $("#documento").find('#qr');
        var contenidoLogo = $("#documento").find('#logoEmpresa');
        redimensionarQr(sizeDocument, widthAct);
        redimensionarLgEmpresa(sizeDocument, widthAct);
        contenidoImg.each(function (i) {
            var sizeImg = parseFloat($(this).attr("width"));

            if (sizeImg >= 50 && sizeDocument != 'xl') {
                sizeImg = sizeImg * 1.1;
            } else if (sizeImg <= 50 && sizeDocument == 'xl' && widthAct < '10') {
                sizeImg = sizeImg * 0.7;
            } else if (sizeImg <= 50 && sizeDocument == 'xl' && widthAct > '10') {
                sizeImg = sizeImg * 0.5;
            } else if (sizeImg <= 50 && sizeDocument == 'lg') {
                sizeImg = sizeImg * 1.2;
            }
            else if (sizeImg <= 50 && sizeDocument == 'xs') {
                sizeImg = sizeImg * 1.4;
            }
            else if (sizeImg <= 50 && sizeDocument == 'sm') {
                sizeImg = sizeImg * 1.4;
            } else if (sizeImg <= 50 && sizeDocument == 'md') {
                sizeImg = sizeImg * 1.5;
            }
            $(this).css("width", sizeImg + "%");
        });
    }
    function redimensionarQr(sizeDocument, widthAct) {
        var sizeImg = parseFloat($("#qr").attr("width"));
        var sizeH = parseFloat($("#qr").attr("width"));
        if (sizeDocument == 'xs' && widthAct < '8') {
            sizeImg = sizeImg * 0.7;
            sizeH = sizeH * 0.6;
            $("#qr").css("width", sizeImg + "%");
            $("#qr").css("height", sizeH + "%");
        } else if (sizeDocument == 'sm' && widthAct > '9') {
            sizeImg = sizeImg * 0.5;
            sizeH = sizeH * 0.8;
            $("#qr").css("width", sizeImg + "%");
            $("#qr").css("height", sizeH + "%");
        }
        else if (sizeDocument == 'sm' && widthAct < '8') {
            sizeImg = sizeImg * 0.9;
            sizeH = sizeH * 0.4;
            $("#qr").css("width", sizeImg + "%");
            $("#qr").css("height", sizeH + "%");
        }

    }
    function redimensionarLgEmpresa(sizeDocument, widthAct) {
        var sizeImg = parseFloat($("#logoEmpresa").attr("width"));
        var sizeH = parseFloat($("#logoEmpresa").attr("width"));
        if (sizeDocument == 'xs') {
            sizeImg = sizeImg * 2.5;
            $("#logoEmpresa").css("width", sizeImg + "px");        
        } else if (sizeDocument == 'sm' && widthAct < '8') {
            sizeImg = sizeImg * 2;
            $("#logoEmpresa").css("width", sizeImg + "%");
        } else if (sizeDocument == 'xl' && widthAct < 10) {
            sizeImg = sizeImg * 0.7;
            $("#logoEmpresa").css("width", sizeImg + "%");
        } else if (sizeDocument == 'xl' && widthAct > 10) {
            sizeImg = sizeImg * 1.1;
            $("#logoEmpresa").css("width", sizeImg + "%");
        }
    }
});