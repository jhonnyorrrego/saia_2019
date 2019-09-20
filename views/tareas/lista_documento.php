<div class="container">
    <div class="row">
        <div class="col-12" id="task_list"></div>
    </div>
</div>
<script>
    $(function() {
        let baseUrl = Session.getBaseUrl();
        let params = JSON.parse('<?= json_encode($_REQUEST) ?>');

        if (typeof List == 'undefined') {
            $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/list/list.js`, function() {
                init();
            })
        } else {
            init();
        }

        function init() {
            let options = {
                selector: '#task_list',
                source: function() {
                    let data = [];

                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        async: false,
                        url: `${baseUrl}app/tareas/consulta_documento.php`,
                        data: {
                            key: localStorage.getItem('key'),
                            documentId: params.documentId
                        },
                        success: function(response) {
                            if (response.success) {
                                data = response.data;
                            } else {
                                top.notification({
                                    type: 'error',
                                    message: response.message
                                });
                            }
                        }
                    })

                    return data;
                },
                inlineButtons: [{
                    icon: 'fa fa-eye',
                    click: function(item) {
                        let options = {
                            url: `views/tareas/crear.php`,
                            title: 'Tarea',
                            params: {
                                id: item.id
                            },
                            centerAlign: false,
                            size: "modal-lg",
                            buttons: {}
                        };

                        top.topModal(options);
                    }
                }]
            };

            let list = new List(options);
        }
    });
</script>