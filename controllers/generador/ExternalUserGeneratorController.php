<?php

class ExternalUserGeneratorController extends ComponentFormGeneratorController implements IComponentGenerator
{
    public function __construct($Formato, $CamposFormato, $scope)
    {
        return parent::__construct($Formato, $CamposFormato, $scope);
    }

    /**
     * genera un componente en ambito de adicion
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-25
     */
    public function generateAditionComponent()
    {
        $content = <<<HTML
            <div class="form-group form-group-default form-group-default-select2">
                <label for="{$this->CamposFormato->nombre}">{$this->getLabel()}</label>
                <select class="form-control" id="{$this->CamposFormato->nombre}" multiple="multiple"></select>
            </div>
            <script>
                $(function(){
                    var select = $("#{$this->CamposFormato->nombre}");
                    select.select2({
                        minimumInputLength: 3,
                        language: 'es',
                        ajax: {
                            url: `<?= \$ruta_db_superior ?>app/tercero/autocompletar.php`,
                            dataType: 'json',
                            data: function(params) {
                                return {
                                    term: params.term,
                                    key: localStorage.getItem('key'),
                                    token: localStorage.getItem('token')
                                };
                            },
                            processResults: function(response) {
                                let options = response.data.length ? response.data : [{id: 9999, text: 'Crear tercero', showModal: true}];
                                return { results: options} 
                            }
                        }                        
                    }).on('select2:selecting', function (e) {
                        let data = e.params.args.data;

                        if(data.showModal){
                            e.preventDefault();

                            top.topModal({
                                url: 'views/tercero/formulario.php',
                                params: {}, //parametros a enviar a url
                                title: 'Tercero', //titulo
                                buttons: {
                                    success: {
                                        label: 'Enviar',
                                        class: 'btn btn-complete'
                                    },
                                    cancel: {
                                        label: 'Cerrar',
                                        class: 'btn btn-danger'
                                    }
                                },
                                onSuccess: function(data) {
                                    select.select2('close');
                                    var option = new Option(data.text, data.id, true, true);
                                    select.append(option).trigger('change');
                                    top.closeTopModal();
                                }
                            })
                        }
                    });
                });
            </script>
HTML;

        return $content;
    }

    /**
     * genera un componente en ambito de edicion
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-25
     */
    public function generateEditionComponente()
    {
        return $this->generateAditionComponent();
    }

    /**
     * muestra el valor almacenado en un documento
     * de un componente especifico
     *
     * @param CamposFormato $CamposFormato
     * @param integer $documentId
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-26
     */
    public static function showValue($CamposFormato, $documentId)
    {
        return parent::showValue($CamposFormato, $documentId);
    }
}
