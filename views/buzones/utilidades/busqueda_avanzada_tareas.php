<script>
    $(function() {
        var baseUrl = $("script[data-baseurl]").data('baseurl');
        $('#right_workspace').load(`${baseUrl}views/tareas/calendario.php`);
        $('#header_list').html($('<h5>', {
            text: 'Resultados de búsqueda'
        }));

        $(document).on('click', '#table .task_info', function() {
            let options = {
                url: `views/tareas/crear.php`,
                params: {
                    id: $(this).data('task')
                },
                title: 'Tarea',
                centerAlign: false,
                size: "modal-lg",
                buttons: {}
            };

            top.topModal(options);
        });
    });
</script>