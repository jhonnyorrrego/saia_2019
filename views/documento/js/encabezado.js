$(function () {
    let baseUrl = $("[data-baseurl]").data("baseurl");
    let documentId = $("[data-documentid]").data("documentid");

    (function init() {
        toggleGoBack();
        showFlag();
        findActions();
        findCounters();
        findMenu();
        $('[data-toggle="tooltip"]').tooltip();
    })();

    $("#go_back").on("click", function () {
        $("#mailbox,#right_workspace").toggleClass("d-none");
    });

    $(document)
        .off("click", "#show_comments,#discutir_documento")
        .on("click", "#show_comments,#discutir_documento", function () {
            let options = {
                url: `${baseUrl}views/documento/comentarios.php`,
                params: {
                    documentId: documentId
                },
                title: "Comentarios",
                size: "modal-lg",
                buttons: {}
            };
            top.topModal(options);
        });

    $(document)
        .off("click", "#show_documents,#vincular_otro_documento")
        .on("click", "#show_documents,#vincular_otro_documento", function () {
            let iframe = $('<iframe>', {
                src: `${baseUrl}views/documento/vinculados.php?documentId=${documentId}`
            }).css({
                width: '100%',
                height: '100%',
                border: 'none',
            });

            jsPanel.ziBase = 10000;
            jsPanel.create({
                headerTitle: 'Documentos vinculados',
                iconfont: 'fa',
                theme: 'dark',
                contentOverflow: 'hidden',
                position: {
                    my: "center-top",
                    at: "center-top"
                },
                contentSize: {
                    width: $(window).width() * 0.8,
                    height: $(window).height() * 0.9,
                },
                content: iframe.prop('outerHTML')
            });
        });

    $(document)
        .off("click", "#resend,#reenviar")
        .on("click", "#resend,#reenviar", function () {
            transferModal(1);
        });

    $(document)
        .off("click", "#reply,#responder")
        .on("click", "#reply,#responder", function () {
            let userInfo = $("#userInfo").data("info");
            transferModal(2, userInfo);
        });

    $(document)
        .off("click", "#responder_todos")
        .on("click", "#responder_todos", function () {
            transferModal(3);
        });

    $("#show_tree").on("click", function () {
        let options = {
            url: `${baseUrl}views/arbol/proceso_formato.php`,
            params: {
                documentId: documentId
            },
            title: "Proceso",
            size: "modal-sm",
            buttons: {
                cancel: {
                    label: "Cerrar",
                    class: "btn btn-danger"
                }
            }
        };
        top.topModal(options);
    });

    $("#show_task").on("click", function () {
        let options = {
            url: `${baseUrl}views/tareas/lista_documento.php`,
            params: {
                documentId: documentId
            },
            title: "Tareas",
            buttons: {
                cancel: {
                    label: "Cerrar",
                    class: "btn btn-danger"
                }
            }
        };
        top.topModal(options);
    });

    $("#priority_flag").on("click", function () {
        let flag = $("#priority_flag i"),
            priority = flag.hasClass("text-danger") ? 0 : 1,
            key = localStorage.getItem("key");

        $.post(
            `${baseUrl}app/documento/asignar_prioridad.php`,
            {
                priority: priority,
                selections: documentId,
                key: key
            },
            function (response) {
                if (response.success) {
                    top.notification({
                        message: response.message,
                        type: "success"
                    });

                    if (priority) {
                        flag.addClass("text-danger");
                        $(
                            `#table .priority_flag[data-key=${documentId}]`
                        ).removeClass("d-none");
                    } else {
                        flag.removeClass("text-danger");
                        $(
                            `#table .priority_flag[data-key=${documentId}]`
                        ).addClass("d-none");
                    }
                } else {
                    top.notification({
                        message: response.message,
                        type: "error",
                        title: "Error!"
                    });
                }
            },
            "json"
        );
    });

    /////// MENU INTERMEDIO ////////
    $(document)
        .off("click", "#crear_tarea,#etiquetar,#asignar_responsable")
        .on("click", "#crear_tarea,#etiquetar,#asignar_responsable", function () {
            let route = $(this).data("url");
            top.topModal({
                url: baseUrl + route,
                title: $(this).text(),
                params: {
                    documentId: documentId
                },
                buttons: {}
            });
        });

    $(document)
        .off("click", "#privacidad")
        .on("click", "#privacidad", function () {
            let route = $(this).data("url");
            top.topModal({
                url: baseUrl + route,
                title: $(this).text(),
                size: 'modal-lg',
                params: {
                    type: 'TIPO_DOCUMENTO',
                    typeId: documentId
                },
                buttons: {}
            });
        });

    $(document)
        .off("click", "#actualizar_pdf")
        .on("click", "#actualizar_pdf", function () {
            let route = $("#acordeon_container").attr("data-location");
            route += "&actualizar_pdf=1";

            $("#view_document").load(baseUrl + route);
        });

    $(document).off("click", "#anexos").on("click", "#anexos", function () {
        $("#show_files").click();
    });
    /////// FIN MENU INTERMEDIO /////
    window.addEventListener(
        "orientationchange",
        function () {
            setTimeout(() => {
                toggleGoBack();
            }, 500);
        },
        false
    );

    $(window).resize(function () {
        toggleGoBack();
    });

    function toggleGoBack() {
        if ($("#mailbox").is(":hidden")) {
            $("#go_back").show();
        } else {
            $("#go_back").hide();
        }
    }

    function showFlag() {
        if ($("#document_information .priority").is(":hidden")) {
            $("#document_information .priority")
                .removeClass("text-danger")
                .show();
        }
    }

    function transferModal(type, userInfo) {
        let options = {
            url: `${baseUrl}views/documento/reenviar.php`,
            params: {
                documentId: documentId,
                userInfo: userInfo,
                type: type
            },
            title: "Reenviar",
            size: "modal-lg",
            buttons: {
                success: {
                    label: "Enviar",
                    class: "btn btn-complete"
                },
                cancel: {
                    label: "Cancelar",
                    class: "btn btn-danger"
                }
            }
        };
        top.topModal(options);
    }

    function findActions() {
        $.post(
            `${baseUrl}app/documento/eventos_fab.php`,
            {
                key: localStorage.getItem("key"),
                token: localStorage.getItem("token"),
                documentId: documentId
            },
            function (response) {
                if (response.success) {
                    showFab(response.data);
                } else {
                    console.error("error al mostrar las acciones");
                }
            },
            "json"
        );
    }

    function showFab(actions) {
        if (actions.showFab) {
            let buttons = [];

            if (actions.reject.see) {
                buttons.push({
                    button: {
                        style: "small orange",
                        html: ""
                    },
                    icon: {
                        style: "fa fa-times",
                        html: ""
                    },
                    onClick: function () {
                        confirmDocument(false);
                    }
                });
            }

            if (actions.confirm.see) {
                buttons.push({
                    button: {
                        style: "small yellow",
                        html: ""
                    },
                    icon: {
                        style: "fa fa-check",
                        html: ""
                    },
                    onClick: function () {
                        confirmDocument(true);
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
                    icon: {
                        style: "fa fa-users",
                        html: ""
                    },
                    onClick: function () {
                        seeManagers(actions.managers.route)
                    }
                });
            }

            if (actions.return.see) {
                buttons.push({
                    button: {
                        style: "small yellow",
                        html: ""
                    },
                    icon: {
                        style: "fa fa-backward",
                        html: ""
                    },
                    onClick: function () {
                        window.open(actions.return.route, "_self");
                    }
                });
            }

            $('#fab').empty();
            new Fab({
                selector: "#fab",
                button: {
                    style: "blue",
                    html: ""
                },
                icon: {
                    style: "fa fa-arrow-left",
                    html: ""
                },
                // "top-left" || "top-right" || "bottom-left" || "bottom-right"
                position: "top-right",
                // "horizontal" || "vertical"
                direction: "horizontal",
                buttons: buttons
            });
        }
    }

    function confirmDocument(accept) {
        $.post(
            `${baseUrl}app/documento/confirmar.php`,
            {
                key: localStorage.getItem("key"),
                token: localStorage.getItem("token"),
                documentId: documentId,
                reject: !accept ? 1 : 0
            },
            function (response) {
                if (response.success) {
                    let route = baseUrl + "views/documento/acordeon.php";
                    $("#acordeon_container")
                        .parent()
                        .load(route, {
                            documentId: documentId
                        });
                } else {
                    top.notification({
                        type: "error",
                        message: response.message
                    });
                }
            },
            "json"
        );
    }

    function seeManagers(route) {
        top.topModal({
            url: baseUrl + route,
            size: 'modal-xl',
            title: 'Ruta actual asignada al documento',
            buttons: {},
            onSuccess: function () {
                findActions();
            }
        })
    }

    function findMenu() {
        $.post(
            `${baseUrl}app/documento/menu_intermedio.php`,
            {
                key: localStorage.getItem("key"),
                documentId: documentId
            },
            function (response) {
                if (response.success) {
                    createMenu(response.data);
                } else {
                    console.error("error al crear el menu");
                }
            },
            "json"
        );
    }

    function createMenu(data) {
        data.forEach(m => {
            $("#module_items").append(
                $("<span>", {
                    id: m.nombre,
                    class: "dropdown-item menu_options text-truncate cursor",
                    style: "line-height:28px;",
                    "data-url": m.enlace
                })
                    .append(
                        $("<i>", {
                            class: `${m.imagen} px-1`
                        })
                    )
                    .append(m.etiqueta)
            );
        });
    }

    function findCounters() {
        $.post(
            `${baseUrl}app/documento/contadores_encabezado.php`,
            {
                key: localStorage.getItem("key"),
                documentId: documentId
            },
            function (response) {
                if (response.success) {
                    showCounters(response.data);
                } else {
                    top.notification({
                        type: "error",
                        message: response.message
                    });
                }
            },
            "json"
        );
    }

    function showCounters(data) {
        if (data.comments) {
            $('#comments_counter').text(data.comments);
        }

        if (data.tasks) {
            $('#tasks_counter').text(data.tasks);
        }

        if (data.documents) {
            $('#documents_counter').text(data.documents);
        }
    }
});
