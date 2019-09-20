$(function () {
    let baseUrl = $('script[data-baseurl]').data('baseurl');

    (function init() {
        $('#table_container').height(
            $(window).height() - $('#table_container').offset().top - 20
        );
        findProfileOptions();
    })();

    $('#treegrid').fancytree({
        extensions: ['filter', 'table'],
        icon: false,
        table: {
            indentation: 20 // indent 20px per node level
        },
        source: {
            url: `${baseUrl}app/arbol/arbol_modulos.php`
        },
        filter: {
            autoApply: true, // Re-apply last filter if lazy data is loaded
            autoExpand: true, // Expand all branches that contain matches while filtered
            counter: true, // Show a badge with number of matching child nodes near parent icons
            fuzzy: false, // Match single characters in order, e.g. 'fb' will match 'FooBar'
            hideExpandedCounter: true, // Hide counter badge if parent is expanded
            hideExpanders: false, // Hide expanders if all child nodes are hidden by filter
            highlight: true, // Highlight matches by wrapping inside <mark> tags
            leavesOnly: false, // Match end nodes only
            nodata: true, // Display a 'no data' status node if result is empty
            mode: 'hide' // Grayout unmatched nodes (pass "hide" to remove unmatched node instead)
        },
        renderColumns: function (event, data) {
            var node = data.node,
                $tdList = $(node.tr).find('>td');

            $tdList.eq(1).html(
                $('<input>', {
                    type: 'checkbox',
                    'data-id': node.key,
                    checked: node.selected
                })
            );
        }
    });

    let tree = $('#treegrid').fancytree('getTree');
    $('#search').keyup(function (e) {
        tree.filterNodes.call(tree, $(this).val());
    });

    $(document).on('click', ':checkbox', function () {
        addPermission($(this).data('id'), $(this).is(':checked'));
    });

    $('#profile').on('select2:select', function () {
        $('#treegrid').fancytree('option', 'source', {
            url: `${baseUrl}app/arbol/arbol_modulos.php`,
            data: {
                profile: $(this).val()
            }
        });
    });

    $('#profile_settings').on('click', function () {
        top.topModal({
            url: `views/permisos/perfiles.php`,
            title: 'Perfiles',
            buttons: {
                cancel: {
                    label: 'Cerrar',
                    class: 'btn btn-danger'
                }
            },
            afterHide: function (event) {
                findProfileOptions();
            }
        });
    });

    function addPermission(moduleId, add) {
        if ($('#profile').val()) {
            $.post(
                `${baseUrl}app/modulo/permiso_perfil.php`,
                {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    module: moduleId,
                    add: add ? 1 : 0,
                    profile: $('#profile').val()
                },
                function (response) {
                    if (response.success) {
                        top.notification({
                            type: 'success',
                            message: response.message
                        });
                    } else {
                        top.notification({
                            type: 'error',
                            message: response.message
                        });
                    }
                },
                'json'
            );
        } else {
            top.notification({
                type: 'error',
                message: 'Debe indicar un perfil'
            });
        }
    }

    function findProfileOptions() {
        $('#profile').empty();
        $('#profile').append('<option value="">Seleccione...</option>');
        $.post(
            `${baseUrl}app/funcionario/consulta_perfiles.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            },
            function (response) {
                if (response.success) {
                    response.data.forEach(element => {
                        $('#profile').append(
                            $('<option>', {
                                value: element.idperfil,
                                text: element.nombre
                            })
                        );
                    });
                    $('#profile').select2();
                }
            },
            'json'
        );
    }
});
