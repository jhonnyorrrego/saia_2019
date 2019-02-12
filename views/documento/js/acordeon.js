$(function () {
    let key = localStorage.getItem('key');
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
            $('#view_document').load(route,function(){
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
        if (sizeDocument == 'xs') {              
            setValores(sizeDocument);
        }
        if (sizeDocument == 'sm') {
            setValores(sizeDocument);
        }
        if (sizeDocument == 'lg') {
            setValores(sizeDocument);
        }
        if (sizeDocument == 'md') {
            setValores(sizeDocument);
        }
    }

    function setValores(sizeDocument){
        var xsFont = parseFloat(sizeFont);

        if(sizeDocument == 'sm'){
            var widthIni = 668;
        }else if(sizeDocument == 'xs'){
            var widthIni = 480;
        }
        
        var widthAct = parseFloat($(".page_content").css('width')) * xsFont /  widthIni;
        if (sizeDocument == 'xs' || sizeDocument == 'sm'){
            $('#documento').css("font-size", widthAct + "px");
            $('#documento').find("p").css("font-size", widthAct + "px")
        }
        
        $('#documento').find("img")
      
        var contenidoImg = $("#documento").find("img");
        contenidoImg.each(function (i) {
            var sizeImg = parseFloat($(this).attr("width"));          
            if (sizeImg >= 50 && sizeDocument != 'xl'){
                sizeImg = sizeImg * 1.1;
            }else if(sizeImg <= 50 && sizeDocument =='lg'){
                sizeImg = sizeImg * 1.2;
            }
            else if (sizeImg <= 50 && sizeDocument == 'xs') {
                sizeImg = sizeImg * 1.7;
            }
            else if (sizeImg <= 50 && sizeDocument == 'sm') {
                sizeImg = sizeImg * 1.5;
            } else if (sizeImg <= 50 && sizeDocument == 'md') {
                sizeImg = sizeImg * 1.4;
            }
            $(this).css("width", sizeImg + "%");
        });
    }
});