$(function() {
    let params = $('#component_script').data('params');
    $('#component_script').removeAttr('data-params');

    $(document)
        .off('click', '.seeReport')
        .on('click', '.seeReport', function() {
            let component = $(this).data('info');

            var params = {
                kConnector: 'iframe',
                url: `${component.url}?idbusqueda_componente=${component.id}`,
                kTitle: component.label
            };

            parent.crear_pantalla_busqueda(params);
        });

    (function init() {
        findComponents();
    })();

    function findComponents() {
        $.post(
            `${params.baseUrl}app/formato/listar_radicacion.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            },
            function(response) {
                if (response.success) {
                    createCards(response.data);
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    }

    function createCards(data) {
        data.forEach(c => {
            let template = `
                <div class="col-12 col-md-3">
                    <div class="card">
                        <div class="card-body py-2">${c.label}</div>
                        <div class="card-footer">
                            <button
                                data-info='${JSON.stringify(c)}'
                                class="btn btn-complete float-right seeReport">
                                Radicar
                            </button>
                        </div>
                    </div>
                </div>
            `;

            $('#component_list').append(template);
        });
    }
});
