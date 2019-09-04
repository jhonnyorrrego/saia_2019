<script>
    $(function() {
        $(document).off('click', '.btn-cf').on('click', '.btn-cf', function() {
            console.log($(this).attr("editar_id"));
            top.topModal({
                url: $(this).attr("enlace"),
                params: {   
                    id: $(this).attr("editar_id"),
                    table: $(this).attr("table"),
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    type : 'editar'
                },
                size: 'modal-lg',
                title: 'Editar',
                buttons: { 
                    success: {
                        label: "Guardar",
                        class: "btn btn-complete"
                    }
                },
                onSuccess: function() {
                    $('#tabla_resultados').bootstrapTable("refresh");
                }
            });
        });
    });
</script> 