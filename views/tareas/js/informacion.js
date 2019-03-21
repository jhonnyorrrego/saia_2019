$(function() {
    let baseUrl = Session.getBaseUrl();
    let params = $('script[data-params]').data('params');

    (function init() {
        defineButtonLabel();

        if (!params.id) {
            createDatePicker();
            checkName();
        } else {
            findFormData(params.id);
        }
    })();

    $("#manager").select2({
        minimumInputLength: 3,
        language: 'es',
        ajax: {
            url: `${baseUrl}app/funcionario/autocompletar.php`,
            dataType: "json",
            data: function(params) {
                return {
                    term: params.term,
                    key: localStorage.getItem("key")
                };
            },
            processResults: function(response) {
                return response.success ? { results: response.data } : {};
            }
        }
    });

    $("#manager").on("select2:unselect", function(e) {
        let id = e.params.data.id;
        $(this)
            .find(`[value="${id}"]`)
            .remove();
    });

    $(document).on("keyup", "#name", function() {
        checkName();
    });

    $("#save_task").on("click", function() {
        let key = localStorage.getItem("key");
        let managers = $("#manager").val();
        let initial = moment($("#final_date").val(), "DD/MM/YYYY hh:mm a")
            .subtract(30, "minutes")
            .format("YYYY-MM-DD HH:mm:ss");
        let final = moment($("#final_date").val(), "DD/MM/YYYY hh:mm a").format(
            "YYYY-MM-DD HH:mm:ss"
        );

        data = {
            task: params.id || 0,
            key: key,
            name: $("#name").val(),
            managers: managers.length ? managers : [key],
            notification: $("#send_notification").is(":checked") ? 1 : 0,
            initialDate: initial,
            finalDate: final,
            description: $("#description").val(),
            documentId: params.documentId
        };

        $("#save_task,#spiner").toggle();
        $.post(
            `${baseUrl}/app/tareas/guardar.php`,
            data,
            function(response) {
                $("#save_task,#spiner").toggle();

                if (response.success) {
                    top.notification({
                        type: "success",
                        message: response.message
                    });

                    let newParams = JSON.stringify({ id: response.data });
                    $("script[data-params]").attr("data-params", newParams);
                    $(".tasktab.disabled").removeClass("disabled");
                    $("#iframe_workspace")
                        .contents()
                        .find(".fc-refresh-button")
                        .trigger("click");
                } else {
                    top.notification({
                        type: "error",
                        message: response.message
                    });
                }
            },
            "json"
        );
    });

    function findFormData(id) {
        $.post(
            `${baseUrl}app/tareas/consulta.php`,
            {
                key: localStorage.getItem("key"),
                task: id
            },
            function(response) {
                if (response.success) {
                    fillForm(response.data);
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

    function fillForm(data) {
        $("#name").val(data.task.nombre);
        let finaldate = moment(
            data.task.fecha_final,
            "YYYY-MM-DD HH:mm:ss"
        ).format("DD/MM/YYYY hh:mm a");
        $("#final_date").val(finaldate);
        $("#description").val(data.task.descripcion);
        fillSelect("#manager", data.users.managers);
    }

    function fillSelect(selector, data) {
        if (data.length) {
            data.forEach(u => {
                $(selector).append(
                    $("<option>", {
                        value: u.id,
                        text: u.name,
                        selected: true
                    })
                );
            });
        }
    }

    function checkName() {
        $("#save_task").attr(
            "disabled",
            $("#name").val().length ? false : true
        );
    }

    function createDatePicker() {
        let time = params.finalTime
            ? moment(params.finalTime, "YYYY-MM-DD HH:mm:ss")
            : moment();

        $("#final_date").datetimepicker({
            widgetPositioning: {
                horizontal: "auto",
                vertical: "bottom"
            },
            defaultDate: time,
            widgetParent: $("#modal_body"),
            keepOpen: true,
            locale: "es",
            format: "DD/MM/YYYY hh:mm a"
        });

        $("#final_date").on("dp.change", function(e) {
            $(this).trigger("click");
        });
    }

    function defineButtonLabel() {
        if (params.id) {
            $("#save_task").text("Guardar");
        } else {
            $("#save_task").text("Crear Tarea");
        }
    }
});
