<?php 
?>

<div>
    <form id="frmActividad">
        <div class="form-group">
            <label for="nombre">Nombre del paso *</label>
            <input type="email" class="form-control" id="nombre" name="nombre" placeholder="Escriba el nombre del paso">
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipo_responsable" id="radioCargo1" value="cargo">
            <label class="form-check-label" for="radioCargo1">Rol o Cargo</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipo_responsable" id="radioCargo2" value="funcionario">
            <label class="form-check-label" for="radioCargo2">Funcionario</label>
        </div>
        <div class="form-group">
            <label class="my-0" for="funcionario" id="lbl_rol_func">Seleccione el rol</label>
            <select class="form-control" style="width:400px;" id="funcionario" placeholder="Qui&eacute;n es el responsable"></select>
        </div>

    </form>
</div>
<script>
    $('#funcionario').select2({
        language: "es",
        multiple: false,
        ajax: {
            url: function() {
                let tipo = $('input[name=tipo_responsable]:checked', '#frmActividad').val();
                if(tipo == 'funcionario') {
                    return 'buscar_funcionario.php';
                } else {
                    return 'buscar_cargo.php';
                }                
            },
            dataType: 'json',
            data: parametrosBusqueda,
            processResults: procesarResultados
        },
        placeholder: 'Buscar funcionario',
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 2,
        templateResult: formatearRespuesta,
        templateSelection: formatRepoSelection

    });
    $('#funcionario').on('select2:select', function (e) {
        //console.log(e.params.data);
        var datos = $tabla.bootstrapTable('getData');

        var existe = false;
        for (var key in datos) {
            var obj = datos[key];
            if (obj.idfuncionario == e.params.data.idfuncionario) {
                existe = true;
                break;
            }
        }
        if (!existe) {
            var datos = e.params.data;
            var id = guardarDestinatario(idnotificacion, e.params.data);
            e.params.data["iddestinatario"] = id;
            $tabla.bootstrapTable('append', e.params.data);
        }
        $(this).val(null).trigger('change');
    });

//$('#tabla_destinatarios tbody tr').append('<td><a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a><a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a></td>');
    function procesarResultados(data) {
        var datos = $.map(data, function (obj) {
            obj.id = obj.idfuncionario || obj.funcionario_codigo; // replace pk with your identifier
            obj.text = obj.nombres + " " + obj.apellidos;
            return obj;
        });
        return {
            results: datos
        };
    }

    function parametrosBusqueda(params) {
        var query = {
            termino: params.term,
            page: params.page || 1
        }

        // Query parameters will be ?search=[term]&page=[page]
        return query;
    }

    function formatearRespuesta(repo) {
        //console.log(repo);
        if (repo.loading) {
            return repo.text;
        }
        let nombre = repo.nombres + " " + repo.apellidos;
        var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + nombre + "</div>";

        if (repo.email) {
            markup += "<div class='select2-result-repository__description'>" + repo.email + "</div>";
        }
        return markup;
    }

    function formatRepoSelection(repo) {
        //console.log(repo);
        return repo.email || repo.text;
    }

    </script>