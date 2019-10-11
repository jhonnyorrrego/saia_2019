<script>
    $(function() {
        let params = $('#script_grid').data('params');
        let baseUrl = params.baseUrl;

        $(document).on('click', '.new_action', function() {
            let type = $(this).data('type');
            let configurationId = $(this).data('id');

            switch (type) {
                case 'edit':
                    edit(configurationId);
                    break;
            }
        });

        function edit(configurationId) {
            top.topModal({
                url: `views/configuracion/formulario.php`,
                params: {
                    configurationId: configurationId
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
    });
</script>