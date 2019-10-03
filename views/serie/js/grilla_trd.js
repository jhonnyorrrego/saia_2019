$(function () {
    let params = $('#trd_report_script').data('params');
    $('#trd_report_script').removeAttr('data-params');

    (function init() {
        createTable();
        showBtnAdd();
    })();

    function showBtnAdd() {
        (params.currentVersion == 1 && params.type == 'json_trd')
            ? modalAddEdit() : $("#btn_add").remove()
    }

    function modalAddEdit() {
        $("#btn_add").show();

        $('#btn_add').on('click', function () {
            top.topModal({
                url: `views/serie/adicionar.php`,
                size: 'modal-xl',
                title: 'Crear',
                params: {
                    sourceTemp: 0
                },
                onSuccess: function (data) {
                    top.closeTopModal();
                    refreshTable();
                },
                buttons: {
                    success: {
                        label: 'Guardar',
                        class: 'btn btn-complete'
                    },
                    cancel: {
                        label: 'Cancelar',
                        class: 'btn btn-danger'
                    }
                }
            });
        });

        $(document).on('click', '.edit-serie', function () {

            let parameters = $(this)[0].dataset;

            top.topModal({
                url: `views/serie/editar.php`,
                size: 'modal-xl',
                title: 'Actualizar',
                params: parameters,
                onSuccess: function () {
                    top.closeTopModal();
                    refreshTable();
                },
                buttons: {
                    success: {
                        label: 'Guardar',
                        class: 'btn btn-complete'
                    },
                    cancel: {
                        label: 'Cancelar',
                        class: 'btn btn-danger'
                    }
                }
            });
        });
    }

    function createTable() {
        $('#trd_table').bootstrapTable({
            url: `${params.baseUrl}app/trd/serie_version/reporte_trd.php`,
            queryParams: function (queryParams) {
                queryParams = $.extend(queryParams, {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    id: params.id,
                    type: params.type,
                    generateTRD: () => {
                        return $("#generateTRD").val();
                    }
                });
                return queryParams;
            },
            responseHandler: function (response) {
                $("#generateTRD").val(0);

                if (params.currentVersion == 1 && params.type == 'json_trd') {

                    for (let index = 0; index < response.rows.length; index++) {
                        let dataParams = {
                            'idserie': response.rows[index].idserie,
                            'idsubserie': response.rows[index].idsubserie,
                            'idtipo': response.rows[index].idtipo,
                            'iddependencia': response.rows[index].iddependencia
                        };
                        response.rows[index].opciones = templateOptions(dataParams);
                    }
                }
                return response;
            },
            toolbar: '#toolbar',
            search: true,
            showSearchButton: true,
            showColumns: true,
            icons: {
                search: 'fa fa-search',
                refresh: 'fa-refresh',
                columns: 'fa fa-th-list',
                export: 'fa fa-download'
            },
            classes: 'table table-hover table-bordered mt-0',
            theadClasses: 'thead-light',
            queryParamsType: 'other',
            pagination: true,
            paginationSuccessivelySize: 1,
            paginationPagesBySide: 1,
            filterControl: true,
            showExport: true,
            exportTypes: ['csv', 'txt', 'excel', 'pdf'],
            exportDataType: 'all',
            exportOptions: {
                fileName: 'TRD',
                jspdf: {
                    orientation: 'l',
                    margins: { left: 10, right: 10, top: 30, bottom: 30 },
                    autotable: {
                        styles: {
                            cellPadding: 2,
                            rowHeight: 20,
                            fontStyle: 'normal',
                            overflow: 'linebreak',
                            valign: 'middle'
                        },
                        tableWidth: 'wrap'
                    }
                }
            },
            columns: getColumns()
        });

        $(".keep-open").before("<div class='refresh-table btn-group'><button class='btn btn-secondary' title='Actualizar' id='btn_refresh'><i class='fa fa-refresh'></i></button></div>");

        $('#btn_refresh').on('click', function () {
            refreshTable();
        });
    }

    function refreshTable() {
        $("#generateTRD").val(1);
        $('#trd_table').bootstrapTable("refresh");
    }

    function templateOptions(data) {

        let onlyType = 1;
        let btnSubserie = '';
        if (data.idsubserie) {
            onlyType = 0;
            btnSubserie = `<a href="#" target="_self" data-type="2" data-idserie="${data.idsubserie}" data-onlytype="${onlyType}" data-iddependencia="${data.iddependencia}" class="dropdown-item edit-serie">
                <i class="fa fa-edit"></i> Editar Subserie
            </a>`;
        }

        let template = `<div class="dropdown f-20">
            <button class="btn mx-1" 
                type="button" 
                data-toggle="dropdown" 
                aria-haspopup="true" 
                aria-expanded="false"
            >
                <i class="fa fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                <a href="#" target="_self" data-type="1" data-idserie="${data.idserie}" data-onlytype="${onlyType}" data-iddependencia="${data.iddependencia}" class="dropdown-item edit-serie">
                    <i class="fa fa-edit"></i> Editar Serie
                </a>
                
                ${btnSubserie}

                <a href="#" target="_self" data-type="3" data-idserie="${data.idtipo}" data-onlytype="${onlyType}" data-iddependencia="${data.iddependencia}" class="dropdown-item edit-serie">
                    <i class="fa fa-edit"></i> Editar Tipo documental
                </a>
            </div>
        </div>`;
        return template;
    }

    function getColumns() {
        return params.type == 'json_clasificacion'
            ? clasificationColumns()
            : trdColumns();
    }

    function trdColumns() {
        return params.currentVersion == 1
            ? trdCurrentVersionColumns()
            : trdPreviousVersionColumns();
    }

    function trdPreviousVersionColumns() {
        return [
            [
                {
                    title: 'Códigos',
                    colspan: 3,
                    align: 'center'
                },
                {
                    title: 'Descripción documental',
                    colspan: 3,
                    align: 'center'
                },
                {
                    title: 'Retención',
                    colspan: 2,
                    align: 'center'
                },
                {
                    title: 'Soporte',
                    colspan: 2,
                    align: 'center'
                },
                {
                    title: 'Disposición',
                    colspan: 4,
                    align: 'center'
                },
                {
                    field: 'procedimiento',
                    title: 'Procedimiento',
                    rowspan: 2,
                    align: 'center'
                }
            ],
            [
                {
                    field: 'dependencia',
                    title: 'Dependencia',
                    filterControl: 'select',
                    align: 'center'
                },
                {
                    field: 'serie',
                    title: 'Serie',
                    filterControl: 'select',
                    align: 'center'
                },
                {
                    field: 'subSerie',
                    title: 'SubSerie',
                    filterControl: 'select',
                    align: 'center'
                },
                {
                    field: 'serieDocumental',
                    title: 'Serie Documental',
                    filterControl: 'input',
                    align: 'center'
                },
                {
                    field: 'subSerieDocumental',
                    title: 'SubSerie Documental',
                    filterControl: 'input',
                    align: 'center'
                },
                {
                    field: 'tipoDocumental',
                    title: 'Tipo Documental',
                    filterControl: 'input',
                    align: 'center'
                },
                { field: 'gestion', title: 'Gestion', align: 'center' },
                { field: 'central', title: 'Central', align: 'center' },
                { field: 'p', title: 'P', align: 'center' },
                { field: 'el', title: 'El', align: 'center' },
                { field: 'e', title: 'E', align: 'center' },
                { field: 's', title: 'S', align: 'center' },
                { field: 'ct', title: 'Ct', align: 'center' },
                { field: 'md', title: 'Md', align: 'center' }
            ]
        ];
    }

    function trdCurrentVersionColumns() {
        return [
            [
                {
                    title: 'Códigos',
                    colspan: 3,
                    align: 'center'
                },
                {
                    title: 'Descripción documental',
                    colspan: 3,
                    align: 'center'
                },
                {
                    title: 'Retención',
                    colspan: 2,
                    align: 'center'
                },
                {
                    title: 'Soporte',
                    colspan: 2,
                    align: 'center'
                },
                {
                    title: 'Disposición',
                    colspan: 4,
                    align: 'center'
                },
                {
                    field: 'procedimiento',
                    title: 'Procedimiento',
                    rowspan: 2,
                    align: 'center'
                },
                {
                    field: 'opciones',
                    title: 'Opciones',
                    rowspan: 2,
                    align: 'center'
                }
            ],
            [
                {
                    field: 'dependencia',
                    title: 'Dependencia',
                    filterControl: 'select',
                    align: 'center'
                },
                {
                    field: 'serie',
                    title: 'Serie',
                    filterControl: 'select',
                    align: 'center'
                },
                {
                    field: 'subSerie',
                    title: 'SubSerie',
                    filterControl: 'select',
                    align: 'center'
                },
                {
                    field: 'serieDocumental',
                    title: 'Serie Documental',
                    filterControl: 'input',
                    align: 'center'
                },
                {
                    field: 'subSerieDocumental',
                    title: 'SubSerie Documental',
                    filterControl: 'input',
                    align: 'center'
                },
                {
                    field: 'tipoDocumental',
                    title: 'Tipo Documental',
                    filterControl: 'input',
                    align: 'center'
                },
                { field: 'gestion', title: 'Gestion', align: 'center' },
                { field: 'central', title: 'Central', align: 'center' },
                { field: 'p', title: 'P', align: 'center' },
                { field: 'el', title: 'El', align: 'center' },
                { field: 'e', title: 'E', align: 'center' },
                { field: 's', title: 'S', align: 'center' },
                { field: 'ct', title: 'Ct', align: 'center' },
                { field: 'md', title: 'Md', align: 'center' }
            ]
        ];
    }

    function clasificationColumns() {
        return [
            {
                field: 'No',
                title: 'No.',
                align: 'center'
            },
            {
                field: 'SiglaDependencia',
                title: 'Sigla Dependencia',
                align: 'center'
            },
            {
                field: 'codigoDependencia',
                title: 'Código Dependencia',
                filterControl: 'select',
                align: 'center'
            },
            {
                field: 'CodigoSerie',
                title: 'Código Serie',
                filterControl: 'select',
                align: 'center'
            },
            {
                field: 'serieDocumental',
                title: 'Serie documental',
                filterControl: 'input',
                align: 'center'
            },
            {
                field: 'subSerie',
                title: 'Código subserie',
                filterControl: 'select',
                align: 'center'
            },
            {
                field: 'subSerieDocumental',
                title: 'Subserie Documental',
                filterControl: 'input',
                align: 'center'
            }
        ];
    }

});
