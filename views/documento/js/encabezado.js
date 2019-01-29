$(function () {
    var baseUrl = $("[data-baseurl]").data("baseurl");
    var documentId = $("[data-documentid]").data("documentid");

    (function init() {
        toggleGoBack();
        showFlag();
        showFab();
        $('[data-toggle="tooltip"]').tooltip();
    })();
    
    $("#go_back").on('click', function(){                                
        $("#mailbox,#right_workspace").toggleClass('d-none');                
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
                documentId: documentId
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

    $("#show_task").on('click', function(){
        let options = {
            url: `${baseUrl}views/tareas/lista_documento.php`,
            params: {
                documentId: documentId
            },
            title: 'Tareas',
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

     /////// MENU INTERMEDIO ////////
    $('.menu_options').on('click', function () {
        let route = $(this).data('url');
        top.topModal({
            url: baseUrl + route,
            title: $(this).text(),
            params: {
                documentId: documentId
            },
            buttons: {}
        })
    });

    window.addEventListener("orientationchange", function () {
        setTimeout(() => {
            toggleGoBack();
        }, 500);
    }, false);

    $(window).resize(function() {
        toggleGoBack();
    });

    function toggleGoBack(){                
        if($("#mailbox").is(':hidden')){
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

    function showFab() {
        let actions = $('script[data-documentactions]').data('documentactions');
        $('script[data-documentactions]').attr('data-documentactions', '');
        
        if (actions.showFab) {
            let buttons = [];

            if (actions.confirm.see) {
                buttons.push({
                    button: {
                        style: "small yellow",
                        html: ""
                    },
                    icon:{
                        style: "fa fa-check",
                        html: ""
                    },
                    onClick: function(){                        
                        window.open(actions.confirm.route, "_self");
                    }
                });
            }

            if (actions.edit.see) {
                buttons.push({
                    button: {
                        style: "small yellow",
                        html: ""
                    },
                    icon: {
                        style: "fa fa-edit",
                        html: ""
                    },
                    onClick: function () {                        
                        window.open(actions.edit.route, "_self");
                    }
                });
            }

            if (actions.managers.see) {
                buttons.push({
                    button: {
                        style: "small yellow",
                        html: ""
                    },
                    icon:{
                        style: "fa fa-users",
                        html: ""
                    },
                    onClick: function(){
                        window.open(actions.managers.route, "_self");
                    }
                });
            }

            if (actions.return.see) {
                buttons.push({
                    button: {
                        style: "small yellow",
                        html: ""
                    },
                    icon:{
                        style: "fa fa-backward",
                        html: ""
                    },
                    onClick: function(){
                        window.open(actions.return.route,"_self");
                    }
                });
            }

            var fab = new Fab({
                selector: "#fab",
                button: {
                    style: "blue",
                    html: ""
                },
                icon:{
                    style: "fa fa-arrow-left",
                    html: ""
                },
                // "top-left" || "top-right" || "bottom-left" || "bottom-right"
                position: "bottom-right",
                // "horizontal" || "vertical"
                direction: "horizontal",
                buttons: buttons
            });
        }
    }
});