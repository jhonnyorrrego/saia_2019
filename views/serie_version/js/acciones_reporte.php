<script>
    $(function() {
        let params = $('#script_grid').data('params');
        $('#script_grid').removeAttr('data-params');

        $(document).on('click', '#activeInactive', function() {

            let estado = $(this).data('estado');
            let idversion = $(this).data('id');

            top.confirm({
                id: 'question',
                type: 'warning',
                message: '¿Está seguro de ' + estado + ' la TRD?',
                position: 'center',
                timeout: 0,
                overlay: true,
                overlayClose: true,
                closeOnEscape: true,
                closeOnClick: true,
                buttons: [
                    [
                        '<button><b>SI</b></button>',
                        function(instance, toast) {

                            instance.hide({
                                    transitionOut: 'fadeOut'
                                },
                                toast,
                                'button'
                            );

                            $.ajax({
                                type: 'POST',
                                url: `${params.baseUrl}app/trd/serie_version/actualizar_estado.php`,
                                data: {
                                    key: localStorage.getItem('key'),
                                    token: localStorage.getItem('token'),
                                    idversion: idversion
                                },
                                dataType: 'json',
                                success: function(response) {

                                    if (response.success) {
                                        top.notification({
                                            message: 'Datos actualizados!',
                                            type: 'success'
                                        });
                                        $('#table').bootstrapTable('refresh');
                                    } else {
                                        top.notification({
                                            message: response.message,
                                            type: 'error'
                                        });
                                    }
                                }
                            });
                        },
                        true
                    ],
                    [
                        '<button>NO</button>',
                        function(instance, toast) {
                            instance.hide({
                                    transitionOut: 'fadeOut'
                                },
                                toast,
                                'button'
                            );
                        },
                        true
                    ]
                ]
            });

        });

        $(document).on('click', '#deleteVersion', function() {

            top.confirm({
                id: 'question',
                type: 'error',
                message: '¿Está seguro de Eliminar la TRD?, esta opción es irreversible',
                position: 'center',
                timeout: 0,
                overlay: true,
                overlayClose: true,
                closeOnEscape: true,
                closeOnClick: true,
                buttons: [
                    [
                        '<button><b>SI</b></button>',
                        function(instance, toast) {

                            instance.hide({
                                    transitionOut: 'fadeOut'
                                },
                                toast,
                                'button'
                            );

                            $.ajax({
                                type: 'POST',
                                url: `${params.baseUrl}app/trd/serie_version/eliminar_trd.php`,
                                data: {
                                    key: localStorage.getItem('key'),
                                    token: localStorage.getItem('token'),
                                    delete: 1
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.success) {
                                        top.notification({
                                            message: 'Se ha eliminado!',
                                            type: 'success'
                                        });
                                        $('#table').bootstrapTable('refresh');
                                    } else {
                                        top.notification({
                                            message: response.message,
                                            type: 'error'
                                        });
                                    }
                                }
                            });
                        },
                        true
                    ],
                    [
                        '<button>NO</button>',
                        function(instance, toast) {
                            instance.hide({
                                    transitionOut: 'fadeOut'
                                },
                                toast,
                                'button'
                            );
                        },
                        true
                    ]
                ]
            });
        });


        $(document).on('click', '#activeVersion', function() {

            top.confirm({
                id: 'question',
                type: 'warning',
                message: '¿Está seguro de confirmar la TRD?, esta opción es irreversible',
                position: 'center',
                timeout: 0,
                overlay: true,
                overlayClose: true,
                closeOnEscape: true,
                closeOnClick: true,
                buttons: [
                    [
                        '<button><b>SI</b></button>',
                        function(instance, toast) {

                            instance.hide({
                                    transitionOut: 'fadeOut'
                                },
                                toast,
                                'button'
                            );

                            let optionsDefaults = {
                                url: `${params.baseUrl}views/serie_version/progress.php`,
                                size: 'modal-lg',
                                buttons: {},
                                backdrop: 'static',
                                keyboard: false,
                                title: 'Cargando .....'
                            };

                            $.ajax({
                                type: 'POST',
                                url: `${params.baseUrl}app/trd/serie_version/guardar_trd.php`,
                                data: {
                                    key: localStorage.getItem('key'),
                                    token: localStorage.getItem('token'),
                                    active: 1
                                },
                                dataType: 'json',
                                beforeSend: function() {
                                    top.topModal(optionsDefaults);
                                },
                                success: function(response) {
                                    top.closeTopModal();
                                    if (response.success) {
                                        top.notification({
                                            message: 'Datos actualizados!',
                                            type: 'success'
                                        });
                                        $('#table').bootstrapTable('refresh');
                                    } else {
                                        top.notification({
                                            message: response.message,
                                            type: 'error'
                                        });
                                    }
                                }
                            });
                        },
                        true
                    ],
                    [
                        '<button>NO</button>',
                        function(instance, toast) {
                            instance.hide({
                                    transitionOut: 'fadeOut'
                                },
                                toast,
                                'button'
                            );
                        },
                        true
                    ]
                ]
            });

        });

    });
</script>