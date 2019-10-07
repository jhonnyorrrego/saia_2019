$(function() {
    let params = $('#area_script').data('params');
    let baseUrl = params.baseUrl;
    let myDropzone = null;

    (function init() {
        if (params.id) {
            findData(params.id);
        } else {
            createTree(params.parent);
        }
    })();

    $('#btn_success').on('click', function() {
        $('#area_form').trigger('submit');
    });

    function findData(id) {
        $.post(
            `${params.baseUrl}app/cargo/consulta_datos.php`,
            {
                key: localStorage.getItem('key'),
                id: id
            },
            function(response) {
                if (response.success) {
                    fillForm(response.data);
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

    function fillForm(data) {
        for (let attribute in data) {
            let e = $(`[name='${attribute}']`);
            if (e.length && attribute != 'estado' && attribute != 'logo') {
                e.val(data[attribute]).trigger('change');
            } else if (attribute == 'estado') {
                $(`[name='estado'][value=${data.estado}]`).prop(
                    'checked',
                    true
                );
            }
        }
        createTree(data.cod_padre, [data.key]);
    }

    function createTree(parentId, unSelectables = []) {
        $('#areas_tree').fancytree({
            icon: false,
            checkbox: true,
            selectMode: 1,
            source: {
                url: `${baseUrl}app/arbol/arbol_cargo.php`,
                data: {
                    expandir: 1,
                    unSelectables: unSelectables
                }
            },
            init: function() {
                if (parentId) {
                    let tree = $('#areas_tree').fancytree('getTree');
                    let node = tree.getNodeByKey(parentId);
                    node.setSelected(true);
                    $("[name='cod_padre'").val(parentId);
                }
            },
            click: function(event, data) {
                $("[name='cod_padre'").val(data.node.key);
            }
        });
    }
});

$('#area_form').validate({
    ignore: '',
    rules: {
        nombre: {
            required: true
        },
        tipo_cargo: {
            required: true
        }
    },
    messages: {
        nombre: {
            required: 'Campo requerido'
        },
        tipo_cargo: {
            required: 'Debe seleccionar un tipo'
        }
    },
    errorPlacement: function(error, element) {
        let node = element[0];

        if (
            node.tagName == 'SELECT' &&
            node.className.indexOf('select2') !== false
        ) {
            error.addClass('pl-3');
            element.next().append(error);
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
        let params = $('#area_script').data('params');
        let data = $('#area_form').serialize();
        data =
            data +
            '&' +
            $.param({
                key: localStorage.getItem('key'),
                id: params.id
            });

        $.post(
            `${params.baseUrl}app/cargo/adicionar.php`,
            data,
            function(response) {
                if (response.success) {
                    top.notification({
                        message: response.message,
                        type: response.data.notificationType || 'success'
                    });
                    top.successModalEvent();
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
    }
});
