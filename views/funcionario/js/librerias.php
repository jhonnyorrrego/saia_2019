<script>
    $(function() {
        let params = $('#script_grid').data('params');
        let baseUrl = params.baseUrl;

        $(document).on('click', '.new_action', function() {
            let type = $(this).data('type');
            let userId = $(this).data('id');

            switch (type) {
                case 'edit':
                    edit(userId);
                    break;
                case 'add_role':
                    addRole(userId);
                    break;
                case 'add_function':
                    addFunction(userId);
                    break;
            }
        });

        $(document).on('click', '.close_session', function() {
            let login = $(this).data('login');

            $.post(`${baseUrl}app/funcionario/cerrar_sesion_especifica.php`, {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                login: login
            }, function(response) {
                if (response.success) {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });
                    $('#table').bootstrapTable("refresh");
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            }, 'json');
        });

        function edit(userId) {
            top.topModal({
                url: `views/funcionario/adicionar.php`,
                params: {
                    userId: userId
                },
                size: 'modal-xl',
                title: 'Usuario',
                onSuccess: function() {
                    top.closeTopModal();
                    $('#table').bootstrapTable("refresh");
                },
                buttons: {
                    success: {
                        label: "Guardar",
                        class: "btn btn-complete"
                    },
                    cancel: {
                        label: "Cancelar",
                        class: "btn btn-danger"
                    }
                },
            });
        }

        function addRole(userId) {
            top.topModal({
                url: `views/dependencia_cargo/listado.php`,
                params: {
                    userId: userId
                },
                size: 'modal-xl',
                title: 'Listado de roles',
                buttons: {}
            });
        }

        function addFunction(userId) {
            top.topModal({
                url: `views/funciones/listado_funcionario.php`,
                params: {
                    userId: userId
                },
                size: 'modal-xl',
                title: 'Listado de funciones',
                buttons: {}
            });
        }

        window.successAdition = function(data) {
            addRole(data);
        }
    });
</script>