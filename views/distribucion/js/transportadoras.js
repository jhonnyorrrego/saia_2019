$(function () {
    let params = $('#transportadora_script').data('params');
    let id = params.id;
    $('#btn_success').on('click', function () {
        $('#transportadora_form').trigger('submit');
    });

    if(id != ''){
        $.post(
            `${params.baseUrl}app/cf/acciones.php`,
            data,
            function (response) {
                console.log("11");
                if (response.success) { 
                    //fillForm(response.data);
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
                    $("#tabla_resultados").bootstrapTable('refresh');
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
