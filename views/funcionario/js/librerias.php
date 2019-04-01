<script>
    $(function() {
        let baseUrl = $('script[data-baseurl]').data('baseurl');

        $(document).on('click', '.new_action', function() {
            let type = $(this).data('type');

            switch (type) {
                case 'edit':
                    edit($(this).data('id'));
                    break;
            }
        });

        function edit(userId) {
            top.topModal({
                url: `${baseUrl}views/funcionario/adicionar.php`,
                params: {
                    userId: userId
                },
                size: 'modal-xl',
                title: 'Usuario',
                onSuccess: function(){
                    top.closeTopModal();
                    $('#tabla_resultados').bootstrapTable("refresh");
                }
            })
        }
    });
</script> 