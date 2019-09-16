$(function () {
    let params = $('#transportadora_script').data('params');
    let id = params.id;
    let table = params.table;
    $('#btn_success').on('click', function () {
        $('#transportadora_form').trigger('submit');
    });

    if (id != '') {
        $.post(
            `${params.baseUrl}app/cf/acciones.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                id: id,
                type: 'edit',
                table: table
            },
            function (response) {
                if (response.success) {
                    fillForm(response.data);
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            "json"
        );
    }

    function fillForm(data) {
        for (let attribute in data) {
            let e = $(`[name='${attribute}']`);
            if (e.length && attribute != 'estado') {
                e.val(data[attribute]).trigger('change');
                $(`[name='${attribute}']`).attr("disabled", true);
            } else if (attribute == 'estado') {
                $(`[name='estado'][value=${data.estado}]`).prop('checked', true);
            }
        }
    }
});

$("#transportadora_form").validate({
    ignore: '',
    rules: {
        nombre: {
            required: true
        }
    },
    messages: {
        nombre: {
            required: "Campo requerido"
        }
    },
    errorPlacement: function (error, element) {
        let node = element[0];

        if (
            node.tagName == "SELECT" &&
            node.className.indexOf("select2") !== false
        ) {
            error.addClass("pl-3");
            element.next().append(error);
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function (form) {
        let params = $("#transportadora_script").data('params');
        let data = $("#transportadora_form").serialize();
        data = data + '&' + $.param({
            key: localStorage.getItem("key"),
            token: localStorage.getItem('token'),
            id: params.id,
            table: params.table
        });

        $.post(
            `${params.baseUrl}app/cf/adicionar.php`,
            data,
            function (response) {
                if (response.success) {
                    top.notification({
                        message: response.message,
                        type: "success"
                    });
                    top.closeTopModal();
                    top.successModalEvent();
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
    }
});
