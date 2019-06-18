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
            }
        });

        function edit(userId) {
            top.topModal({
                url: `${baseUrl}views/remitente/adicionar.php`,
                params: {
                    userId: userId
                },
                size: 'modal-xl',
                title: 'Tercero',
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


    });
</script>