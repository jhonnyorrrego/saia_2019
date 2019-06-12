<script>
    $(function() {
        let baseUrl = $('script[data-baseurl]').data('baseurl');

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
                    $('#tabla_resultados').bootstrapTable("refresh");
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
                url: `${baseUrl}views/funcionario/adicionar.php`,
                params: {
                    userId: userId
                },
                size: 'modal-xl',
                title: 'Usuario',
                onSuccess: function() {
                    top.closeTopModal();
                    $('#tabla_resultados').bootstrapTable("refresh");
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

        function addRole(userId){
            top.topModal({
                url: `${baseUrl}views/funcionario/asignar_rol.php`,
                params: {
                    userId: userId
                },
                size: 'modal-xl',
                title: 'Usuario',
                buttons: {}
            });
        }
    });
</script>