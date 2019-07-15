$(function() {
    let baseUrl = $('script[data-baseurl]').data('baseurl');

    $('#btn_success').on('click', function() {
        /**
         * el siguiente fragmento de codifo fue copiado
         * de una version de saia inferior ya que la busqueda
         * se debia conservar igual
         */
        var filtro_actual = $('#filtro_adicional').val();
        var tablas = filtro_actual.split('@');
        var fin = strpos(tablas[0], ', (');
        if (fin) {
            tablas[0] = tablas[0].substr(0, fin);
        }
        var fin_camp = strpos(tablas[1], ' and (');
        if (fin_camp) {
            tablas[1] = tablas[1].substr(0, fin_camp);
        }
        var nuevas_tablas = tablas[0];
        var nuevos_campos = tablas[1];

        var valor1 = $('[name="bqsaia_z@destino"]').val();
        var valor2 = $('[name="bqsaia_z@origen__1"]').val();
        var valor3 = $('[name="bqsaia_a@ejecutor"]').val();
        var valor4 = $('[name="bqsaia_w@destino"]').val();

        if (
            (valor1 != '' && valor1 != undefined) ||
            (valor2 != '' && valor2 != undefined) ||
            (valor3 != '' && valor3 != undefined)
        ) {
            if (!strpos(nuevas_tablas, 'uzon_salida z')) {
                nuevas_tablas += ',buzon_salida z';
                nuevos_campos += ' AND iddocumento=z.archivo_idarchivo';
            }
        }
        if (valor4 != '' && valor4 != undefined) {
            if (!strpos(nuevas_tablas, 'uzon_entrada w')) {
                nuevas_tablas += ',buzon_entrada w';
                nuevos_campos += ' AND iddocumento=w.archivo_idarchivo';
            }
        } else {
            nuevas_tablas = nuevas_tablas.replace(',buzon_entrada w', '');
            nuevos_campos = nuevos_campos.replace(
                ' AND iddocumento=w.archivo_idarchivo',
                ''
            );
        }

        $('#filtro_adicional').val(nuevas_tablas + ' @ ' + nuevos_campos);
        /**
         * fin fragmento de codigo copiado
         */

        if (valor1) {
            $("[name='bksaiacondicion_z@nombre__1']").val('in');
            $("[name='bqsaia_z@nombre__1']").val("'transferido'");
        }
        if (valor2) {
            $("[name='bksaiacondicion_z@nombre__2']").val('in');
            $("[name='bqsaia_z@nombre__2']").val("'transferido'");
        }
        if (valor4) {
            $("[name='bksaiacondicion_w@nombre']").val('in');
            $("[name='bqsaia_w@nombre']").val("'aprobado'");
        }

        $.post(
            `${baseUrl}pantallas/busquedas/procesa_filtro_busqueda.php`,
            $('#kformulario_saia').serialize(),
            function(data) {
                if (data.exito) {
                    top.successModalEvent(data);
                } else {
                    top.notification({
                        message: data.mensaje,
                        type: 'error'
                    });
                }
            },
            'json'
        );
    });

    (function init() {
        createPicker();
        createFormatTree();
        createUserTree();
    })();

    function createPicker() {
        $('#fecha_inicial,#fecha_final').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD'
        });
    }

    function createFormatTree() {
        $('#format_tree').fancytree({
            icon: false,
            checkbox: true,
            selectMode: 2,
            source: {
                url: `${baseUrl}arboles/arbol_formatos.php`,
                data: {
                    expandir: 0
                }
            },
            click: function(event, data) {
                setTimeout(() => {
                    let nodes = $('#format_tree')
                        .fancytree('getTree')
                        .getSelectedNodes();

                    ids = [];
                    nodes.forEach(n => {
                        ids.push(n.key);
                    });

                    $('#formatId').val(ids.join(','));
                }, 250);
            }
        });
    }

    function createUserTree() {
        $.post(
            `${baseUrl}arboles/arbol_funcionario.php`,
            {
                checkbox: 2,
                idcampofun: 'funcionario_codigo'
            },
            function(response) {
                paintUserTree(response);
            },
            'json'
        );
    }

    function paintUserTree(data) {
        $('.user_tree').fancytree({
            icon: false,
            checkbox: true,
            selectMode: 2,
            source: data,
            click: function(event, data) {
                setTimeout(() => {
                    let nodes = $(this)
                        .fancytree('getTree')
                        .getSelectedNodes();

                    ids = [];
                    nodes.forEach(n => {
                        ids.push(n.key);
                    });

                    $(this)
                        .siblings('.treeValue')
                        .val(ids.join(','));
                }, 250);
            }
        });
    }

    function strpos(haystack, needle, offset) {
        var i = (haystack + '').indexOf(needle, offset || 0);
        return i === -1 ? false : i;
    }
});
