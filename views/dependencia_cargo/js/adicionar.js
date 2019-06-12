$(function() {
    let roleData = new Object();
    let params = $('#add_role_script').data('params');
    $('#add_role_script').removeAttr('data-params');

    $('#btn_success').on('click', function() {
        $('#role_form').trigger('submit');
    });

    (function init() {
        if (+params.roleId) {
            roleData = findRole();
        }

        createDependencyTree(roleData.dependency);
        createRoleTree(roleData.position);
        createPicker(roleData.initialDate, roleData.finalDate);
        showState(roleData.state);
    })();

    function findRole() {
        let data = null;
        $.ajax({
            type: 'POST',
            dataType: 'json',
            async: false,
            url: `${params.baseUrl}app/dependencia_cargo/detalles_rol.php`,
            data: {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                roleId: params.roleId
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
        });

        return data;
    }

    function createPicker(initialDate = null, finalDate = null) {
        $('#initial_date,#final_date').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD'
        });

        $('#initial_date')
            .data('DateTimePicker')
            .defaultDate(initialDate);
        $('#final_date')
            .data('DateTimePicker')
            .defaultDate(finalDate);
    }

    function createDependencyTree(checked = 0) {
        $('#dependency_tree').fancytree({
            icon: false,
            checkbox: true,
            selectMode: 1,
            source: {
                url: `${params.baseUrl}arboles/arbol_dependencia.php`,
                data: {
                    expandir: 1
                }
            },
            init: function() {
                if (checked) {
                    let tree = $('#dependency_tree').fancytree('getTree');
                    let node = tree.getNodeByKey(checked);
                    node.setSelected(true);
                    $("[name='dependency'").val(checked);
                }
            },
            click: function(event, data) {
                $("[name='dependency'").val(data.node.key);
            }
        });
    }

    function createRoleTree(checked = 0) {
        $('#role_tree').fancytree({
            icon: false,
            checkbox: true,
            selectMode: 1,
            source: {
                url: `${params.baseUrl}arboles/arbol_cargo.php`,
                data: {
                    expandir: 1
                }
            },
            init: function() {
                if (checked) {
                    let tree = $('#role_tree').fancytree('getTree');
                    let node = tree.getNodeByKey(checked);
                    node.setSelected(true);
                    $("[name='position'").val(checked);
                }
            },
            click: function(event, data) {
                $("[name='position'").val(data.node.key);
            }
        });
    }

    function showState(state = 0) {
        if (+params.roleId) {
            $(`[name='state'][value='${state}']`).prop('checked', true);
        } else {
            $('#state_container').hide();
        }
    }
});

jQuery.validator.addMethod(
    'greaterThan',
    function(value, element, params) {
        return (
            this.optional(element) ||
            new Date(value) >= new Date($(params).val())
        );
    },
    'La fecha final debe ser mayor a la inicial.'
);

$('#role_form').validate({
    ignore: '',
    rules: {
        dependency: {
            required: true
        },
        position: {
            required: true
        },
        initial_date: {
            required: true
        },
        final_date: {
            required: true,
            greaterThan: '#initial_date'
        },
        state: {
            required: true
        }
    },
    messages: {
        dependency: {
            required: 'Debe seleccionar una dependencia'
        },
        position: {
            required: 'Debe seleccionar un cargo'
        },
        initial_date: {
            required: 'Debe indicar la fecha inicial'
        },
        final_date: {
            required: 'Debe indicar la fecha final'
        },
        state: {
            required: 'Debe indicar un estado'
        }
    },
    submitHandler: function(form) {
        let params = $('#add_role_script').data('params');
        let data = $('#role_form').serialize();
        data =
            data +
            '&' +
            $.param({
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                roleId: params.roleId,
                userId: params.userId
            });

        $.post(
            `${params.baseUrl}app/dependencia_cargo/adicionar.php`,
            data,
            function(response) {
                if (response.success) {
                    top.notification({
                        message: response.message,
                        type: 'success'
                    });
                    top.closeTopModal();
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
