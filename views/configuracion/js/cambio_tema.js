$(function() {
    let baseUrl = $('script[data-baseurl]').data('baseurl');

    setTimeout(() => {
        let color = localStorage.getItem('color');
        if (!$(`[name='theme'][value='${color}']`).length) {
            $('#example-color-input').val(color);
            $('#example-color-input').trigger('change');
            $(`[name='theme'][value='${color}']`).prop('checked', true);
        } else {
            $(`[name='theme'][value='${color}']`).prop('checked', true);
        }
    }, 0);

    $('#example-color-input').on('change', function() {
        $('#dinamic').val($(this).val());
        $('#dinamic_label').text($(this).val());
        $('#dinamic_color').css('background', $(this).val());
    });

    $('.color_container').on('click', function() {
        $(':radio').attr('checked', false);
        $(this)
            .find('input:radio')
            .attr('checked', true);
    });

    $('.color_container').hover(function() {
        $(this).css('cursor', 'pointer');
    });

    $('#saveColor').on('click', function() {
        var color = $("[name='theme']:checked").val();

        if (color) {
            $.post(
                baseUrl + 'app/configuracion/actualizar_color.php',
                {
                    key: localStorage.getItem('key'),
                    color: color
                },
                function(response) {
                    if (response.success) {
                        top.notification({
                            message: response.message,
                            type: 'success'
                        });

                        let style = `
                            .btn.bg-institutional:hover{background: ${color} !important;color: #ffff !important; opacity:0.8; border:none}
                            .btn.bg-institutional{border:none}
                            .bg-institutional{background: ${color} !important;color: #ffff !important}
                            .text-institutional{color: ${color} !important;}
                        `;
                        $('#institution_style', window.top.document).text(
                            style
                        );
                        window.top.localStorage.setItem('color', color);
                    } else {
                        top.notification({
                            message: response.message,
                            type: 'error',
                            title: 'Error!'
                        });
                    }
                },
                'json'
            );
        } else {
            top.notification({
                message: 'Debe Seleccionar un color',
                type: 'error',
                title: 'Error!'
            });
        }
    });
});
