$(function() {
    let params = $('#script_version_details').data('params');
    $('#script_version_details').removeAttr('data-params');

    $(document)
        .off('click', '.showFile')
        .on('click', '.showFile', function() {
            let route = params.baseUrl + $(this).data('route');
            top.topJsPanel({
                headerTitle: $(this).data('title'),
                contentSize: {
                    width: $(window).width() * 0.8,
                    height: $(window).height() * 0.9
                },
                content: `<iframe src="${route}" style="width: 100%; height: 100%; border:none;"></iframe>`
            });
        });

    (function init() {
        findDetails();
    })();

    function findDetails() {
        $.post(
            `${params.baseUrl}app/documento/detalles_version.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                versionId: params.versionId
            },
            function(response) {
                if (response.success) {
                    showFiles(response.data);
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

    function showFiles(data) {
        $('#pdf_container').append(
            $('<a>', {
                'data-route': data.pdf,
                'data-title': 'Documento',
                text: 'Ver Pdf',
                class: 'showFile cursor text-complete'
            })
        );

        if (data.attachments && data.attachments.length) {
            data.attachments.forEach((a, i) => {
                $('#attachments_container').append(
                    $('<li>', {
                        'data-route': a.route,
                        'data-title': 'Anexo',
                        text: a.label,
                        class: 'showFile cursor text-complete'
                    })
                );
            });

            $('#attachments_container')
                .parents('.row')
                .removeClass('d-none');
        }

        if (data.pages && data.pages.length) {
            data.pages.forEach((a, i) => {
                $('#pages_container').append(
                    $('<li>', {
                        'data-route': a.route,
                        'data-title': 'Página',
                        text: a.label,
                        class: 'showFile cursor text-complete'
                    })
                );
            });

            $('#pages_container')
                .parents('.row')
                .removeClass('d-none');
        }
    }
});
