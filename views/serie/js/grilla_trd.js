$(function() {
    let params = $('#trd_report_script').data('params');

    (function init() {
        $('#trd_table').bootstrapTable({
            url: `${params.baseUrl}app/serie/reporte_trd.php`,
            queryParams: function(queryParams) {
                queryParams = $.extend(queryParams, {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    id: params.id
                });
                return queryParams;
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
            columns: [
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
                        align: 'center'
                    },
                    {
                        field: 'serie',
                        title: 'Serie',
                        filterControl: 'input',
                        align: 'center'
                    },
                    {
                        field: 'subSerie',
                        title: 'SubSerie',
                        filterControl: 'input',
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
            ]
        });
    })();
});
