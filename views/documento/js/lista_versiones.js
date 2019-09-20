$(function () {
    let params = $('#script_version_list').data('params');
    $('#script_version_list').removeAttr('data-params');

    (function init() {
        loadList();
    })();

    function loadList() {
        if (typeof List == 'undefined') {
            $.getScript(
                `${
                params.baseUrl
                }assets/theme/assets/js/cerok_libraries/list/list.js`,
                () => {
                    createList();
                }
            );
        } else {
            createList();
        }
    }

    function createList() {
        let options = {
            selector: '#versions_list',
            source: function () {
                let data = [];

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    async: false,
                    url: `${params.baseUrl}app/documento/lista_versiones.php`,
                    data: {
                        token: localStorage.getItem('token'),
                        key: localStorage.getItem('key'),
                        documentId: params.documentId
                    },
                    success: function (response) {
                        if (response.success) {
                            data = response.data;
                        } else {
                            top.notification({
                                type: 'error',
                                message: response.message
                            });
                        }
                    }
                });

                return data;
            },
            inlineButtons: [
                {
                    icon: 'fa fa-eye',
                    click: function (item) {
                        let options = {
                            url: `views/documento/detalles_version.php`,
                            title: 'Detalles de la versión ' + item.version,
                            params: {
                                versionId: item.id
                            },
                            buttons: {
                                cancel: {
                                    label: 'Volver',
                                    class: 'btn btn-danger'
                                }
                            }
                        };

                        top.topModal(options);
                    }
                }
            ]
        };

        let list = new List(options);
    }
});
