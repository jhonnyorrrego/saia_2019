$(function () {
    let baseUrl = $('script[data-baseurl]').data('baseurl');
    let users = null;
    let root = NaN;

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
        $('#button_actions').html(buttonActions(0));

        users = new Users({
            selector: '#users_component',
            baseUrl: baseUrl,
            identificator: 'usuarios_asignar'
        });
    }

    $('#show_advanced').on('click', function () {
        $('#advanced').removeClass('d-none');
        $('#show_advanced').parent().parent().addClass('d-none');
        findData();
    });

    $(document).off('click', '.new_accion').on('click', '.new_accion', function () {
        let data = {
            key: localStorage.getItem('key'),
            type: $('#access_type').val(),
            typeId: $('#access_type_id').val(),
            accion: $(this).data('type'),
        };

        if ($(this).data('specific') > 0) {
            data.users = [$(this).data('specific')];
        } else {
            data.users = users.getList();
            data.notification = $('#send_notification').is(':checked');
        }

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

                        if ($("#advanced").is(':visible')) {
                            findData();
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

                    findData();
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
        $.post(
            `${baseUrl}app/permisos/consulta_datos_asignar.php`,
            {
                key: localStorage.getItem('key'),
                type: $('#access_type').val(),
                typeId: $('#access_type_id').val()
            },
            function (response) {
                if (response.success) {
                    $(`[name='private'][data-type='${response.data.type}']`).prop('checked', 'true');

                    createTable(response.data.users);
                    $('#button_actions').html(buttonActions(0));
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

    function createTable(userList) {
        checkRootAccess();
        $('#user_list').html(`
            <thead>
                <tr>
                    <td>Usuario</td>
                    <td></td>
                </tr>
            </thead>
        `);

        Object.values(userList).forEach(i => {
            switch (i.action) {
                case '1':
                    var icon = 'fa fa-eye';
                    var className = '';
                    break;
                case '2':
                    var icon = 'fa fa-edit';
                    var className = '';
                    break;
                case '3':
                    var icon = 'fa fa-legal';
                    var className = 'd-none';
                    break;
            }
            $('#user_list').append(`
                <tr>
                    <td>
                        ${i.name}
                        ${buttonActions(i.userId, icon)}
                    </td>
                    <td>
                        <button class="btn btn-link new_accion ${className}" data-type="delete" data-specific="${i.userId}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `);
        });

        $('button > i.fa-legal').parent().addClass('disabled');
    }

    function buttonActions(specific = 0, icon = 'fa fa-ellipsis-v') {
        if (isNaN(root)) {
            checkRootAccess();
        }

        let manager = root ? `<a href="#" class="dropdown-item new_accion" data-type="manager" data-specific="${specific}">
            <i class="fa fa-legal"></i> Propietario
        </a>` : '';

        return `<div class="dropdown float-right">
            <button class="btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="${icon}"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                <a href="#" class="dropdown-item new_accion" data-type="see" data-specific="${specific}">
                    <i class="fa fa-eye"></i> Ver
                </a>
                <a href="#" class="dropdown-item new_accion" data-type="edit" data-specific="${specific}">
                    <i class="fa fa-edit"></i> Editar
                </a>
                ${manager}
            </div>
        </div>`;
    }

    function checkRootAccess() {
        $.ajax({
            url: `${baseUrl}app/permisos/permiso_funcionario.php`,
            type: 'POST',
            dataType: 'json',
            async: false,
            data: {
                key: localStorage.getItem('key'),
                sourceReference: $('#access_type').val(),
                typeId: $('#access_type_id').val(),
            },
            success: function (response) {
                if (response.success) {
                    root = response.data.delete;

                    if (!response.data.edit) {
                        top.closeTopModal();
                        top.notification({
                            type: 'error',
                            message: 'No tienes acceso a la privacidad'
                        });
                    }
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            }
        });
    }
});
