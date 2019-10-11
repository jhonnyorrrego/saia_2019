<script>
    $(function() {
        let params = $('#script_grid').data('params');
        let baseUrl = params.baseUrl;

        $(document).on('click', '.new_action', function() {
            let type = $(this).data('type');
            let carouselId = $(this).data('id');

            switch (type) {
                case 'edit':
                    edit(carouselId);
                    break;
                case 'show_items':
                    showItems(carouselId);
                    break;
            }
        });

        function edit(carouselId) {
            top.topModal({
                url: `views/carrusel/formulario.php`,
                params: {
                    carouselId: carouselId
                },
                size: 'modal-xl',
                title: 'Carrusel',
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

        function showItems(carouselId) {
            top.topModal({
                url: `views/carrusel/listado_items.php`,
                params: {
                    carouselId: carouselId
                },
                size: 'modal-xl',
                title: 'Listado de noticias',
                buttons: {}
            });
        }
    });
</script>