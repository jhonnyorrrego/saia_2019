$(function () {
    let baseUrl = $('script[data-baseurl]').data('baseurl');
    var users = null;

    (function init() {
        if (typeof Users == 'undefined') {
            $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/users/users.js`, r => {
                showUserComponent();
            });
        } else {
            showUserComponent();
        }
    })();

    function showUserComponent() {
        users = new Users({
            selector: '#users_component',
            baseUrl: baseUrl,
            identificator: 'usuarios_asignar'
        });

        //findData();
    }

    $('#show_advanced').on('click', function () {
        $('#advanced,#show_advanced').toggleClass('d-none');
    });

    $('.new_accion').on('click', function () {
        let data = {
            key: localStorage.getItem('key'),
            type: $('#access_type').val(),
            typeId: $('#access_type_id').val(),
            users: users.getList(),
            accion: $(this).data('type'),
            notification: $('#send_notification').is(':checked')
        };

        if (data.users.length) {
            $.post(
                `${baseUrl}app/permisos/asignar.php`,
                data,
                function (response) {
                    if (response.success) {
                        top.notification({
                            type: 'success',
                            message: response.message
                        });
                        users.cleanList();
                    } else {
                        top.notification({
                            type: 'error',
                            message: response.message
                        });
                    }
                },
                'json'
            );
        } else {
            top.notification({
                type: 'error',
                message: 'Debe indicar los usuarios'
            });
        }
    });

    $('[name="private"]').on('change', function () {
        $.post(
            `${baseUrl}app/permisos/asignar.php`,
            {
                key: localStorage.getItem('key'),
                type: $('#access_type').val(),
                typeId: $('#access_type_id').val(),
                private: $(this).data('type')
            },
            function (response) {
                if (response.success) {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });
                    users.cleanList();
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );

    });

    function findData() {
        $('[name="key"]').val(localStorage.getItem('key'));
        $.post(
            `${baseUrl}app/permisos/consulta_datos_asignar.php`,
            $('#permissions').serialize(),
            function (response) {
                if (response.success) {
                    $(`[name='private'][value=${response.data.type}]`).trigger('click');

                    if (response.data.type == 3) {
                        users.setList(response.data.users);
                    }
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    }
});
