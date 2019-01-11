$(function () {
    var baseUrl = $("[data-baseurl]").data("baseurl");
    var documentId = $("[data-documentid]").data("documentid");

    (function init() {
        toggleGoBack();
        showFlag();                
    })();
    
    $("#go_back").on('click', function(){                                
        $("#mailbox,#right_workspace", parent.document).toggleClass('d-none');                
    });

    $("#show_comments").on('click', function(){
        let options = {
            url: `${baseUrl}views/documento/comentarios.php`,
            params: {
                documentId: documentId
            },
            title: 'Comentarios',
            size: 'modal-lg',
            buttons: {}
        };
        top.topModal(options);
    });

    $("#show_tree").on('click', function(){
        let options = {
            url: `${baseUrl}views/arbol/proceso_formato.php`,
            params: {
                iddocumento: documentId
            },
            title: 'Proceso',
            size: 'modal-sm',
            buttons: {
                cancel: {
                    label: 'Cerrar',
                    class: 'btn btn-danger'
                }
            }
        };
        top.topModal(options);
    });
    
    $(".priority_flag").on('click', function(){
        let flag = $(this).find('.priority'),
            priority = flag.hasClass('text-danger') ? 0 : 1,
            key = localStorage.getItem('key');

        $.post(`${baseUrl}app/documento/asignar_prioridad.php`,{
            priority: priority,
            selections: documentId,
            key: key
        }, function(response){
            if(response.success){
                top.notification({
                    message: response.message,
                    type: 'success'
                });

                if(priority){
                    flag.addClass('text-danger');
                    $(`#table i[data-key=${documentId}]`).show();
                }else{
                    flag.removeClass('text-danger');
                    $(`#table i[data-key=${documentId}]`).hide();
                }
            }else{
                top.notification({
                    message: response.message,
                    type: 'error',
                    title: 'Error!'
                });
            }
        }, 'json')
    });

    /*var fab = new Fab({
        selector: "#fab",
        button: {
            style: "large blue",
            html: ""
        },
        icon:{
            style: "fa fa-chevron-up",
            html: ""
        },
        // "top-left" || "top-right" || "bottom-left" || "bottom-right"
        position: "bottom-right",
        // "horizontal" || "vertical"
        direction: "vertical",
        buttons:[
            <?php if ($documentActions["confirmar"]): ?>
                {
                    button: {
                        style: "small yellow",
                        html: ""
                    },
                    icon:{
                        style: "fa fa-check",
                        html: ""
                    },
                    onClick: function(){
                        if(window.parent.frames["arbol_formato"] !== undefined){
                            match_iddoc = window.parent.frames["arbol_formato"].location.href.match(/(iddoc)=([\d]+)/);
                            if(match_iddoc){
                                var parentDocumentId = match_iddoc[2];
                            }else{
                                var parentDocumentId = 0;
                            }
                        }else{
                            var parentDocumentId = documentId;
                        }
                        
                        var route = `${baseUrl}class_transferencia.php?iddoc=${documentId}&funcion=aprobar&anterior=${parentDocumentId}`;
                        window.open(route, "_self");
                    }
                },
            <?php endif; ?>
            <?php if ($documentActions["editar"]): ?>
                {
                    button: {
                        style: "small yellow",
                        html: ""
                    },
                    icon:{
                        style: "fa fa-edit",
                        html: ""
                    },
                    onClick: function(){
                        window.open("<?php echo $ruta_db_superior . FORMATOS_CLIENTE . $document[0]["nombre"] .'/'. $document[0]["ruta_editar"] ?>?iddoc=<?= $documentId ?>&idformato=<?= $document[0]["idformato"] ?>","_self");
                    }
                },
            <?php endif; ?>
            <?php if ($documentActions["ver_responsables"]): ?>
                {
                    button: {
                        style: "small yellow",
                        html: ""
                    },
                    icon:{
                        style: "fa fa-users",
                        html: ""
                    },
                    onClick: function(){
                        window.open(`${baseUrl}mostrar_ruta.php?doc=${documentId}`, "_self");
                    }
                },
            <?php endif; ?>
            <?php if ($documentActions["devolucion"]) : ?>
                {
                    button: {
                        style: "small yellow",
                        html: ""
                    },
                    icon:{
                        style: "fa fa-backward",
                        html: ""
                    },
                    onClick: function(){
                        window.open(`${baseUrl}class_transferencia.php?iddoc=${documentId}&funcion=formato_devolucion`,"_self");
                    }
                }
            <?php endif; ?>
        ]
    });*/

    window.addEventListener("orientationchange", function () {
        setTimeout(() => {
            toggleGoBack();
        }, 500);
    }, false);

    $(window).resize(function() {
        toggleGoBack();
    });

    function toggleGoBack(){                
        if($("#mailbox", parent.document).is(':hidden')){
            $("#go_back").show();
        }else{
            $("#go_back").hide();
        }
    }

    function showFlag(){                
        if($("#document_information .priority").is(':hidden')){
            $("#document_information .priority").removeClass('text-danger').show();
        }
    }

    /////// MENU INTERMEDIO ////////
    $(document).on('click', '#etiquetar', function(){
        top.topModal({
            url: `${baseUrl}views/documento/etiquetar.php`,
            title: 'Etiquetas',
            size: 'modal-sm',
            params: {
                selections: documentId
            },
            buttons: {
                success: {
                    label: 'Guardar',
                    class: 'btn btn-complete'
                },
                cancel: {
                    label: 'Cancelar',
                    class: 'btn btn-danger'
                }
            },
        })
    });
});