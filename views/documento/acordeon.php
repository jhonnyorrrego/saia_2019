<div class="row mx-0 pt-1">
    <div class="col-12 px-0">
        <div class="mx-0">
            <div class="card-group horizontal" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="card card-default mb-0" id="first_occordion_card">
                    <div class="card-header py-2" role="tab" style="height:32px;min-height:32px;">
                        <h4 class="card-title">
                            <a class="p-0 text-capitalize" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                               Documento
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="collapse show" role="tabcard">
                        <div id="document_header"></div>
                        <div id="view_document"></div>
                    </div>
                </div>
                <div class="card card-default mb-0" style="display:none" id="filestab_accordion">
                    <div class="card-header py-2" role="tab" style="height:32px;min-height:32px;">
                        <h4 class="card-title">
                            <a class="p-0 text-capitalize" data-toggle="collapse" data-parent="#filestab_accordion" href="#files_tab" aria-expanded="false" aria-controls="files_tab">
                               Anexos
                            </a>
                        </h4>
                    </div>
                    <div id="files_tab" class="collapse" role="tabcard"></div>
                </div>
                <div class="card card-default mb-0" style="display:none" id="historytab_accordion">
                    <div class="card-header py-2" role="tab" id="headingTwo" style="height:32px;min-height:32px;">
                        <h4 class="card-title">
                            <a class="collapsed p-0 text-capitalize" data-toggle="collapse" data-parent="#historytab_accordion" href="#history_tab" aria-expanded="false" aria-controls="history_tab">
                            Trazabilidad del Documento
                            </a>
                        </h4>
                    </div>
                    <div id="history_tab" class="collapse" role="tabcard" aria-labelledby="headingTwo">
                        <div class="card-body px-1 py-0" id="history_content"></div>
                    </div>
                </div>
                <div class="card card-default mb-0" style="display:none" id="dinamictab_accordion">
                    <div class="card-header py-2" role="tab" id="headingThree" style="height:32px;min-height:32px;">
                        <h4 class="card-title">
                            <a class="collapsed p-0 text-capitalize" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Adicionar
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="collapse" role="tabcard" aria-labelledby="headingThree">
                        <div class="card-body px-1 py-0">
                            <iframe frameborder="0" id="iframe_dinamictab_accordion" width="100%" onload="this.height = window.innerHeight - 30" ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script data-params='<?= json_encode($_REQUEST) ?>'>
    $(function(){
        let baseUrl = $('script[data-baseurl]').data('baseurl');
        $.getScript(`${baseUrl}views/documento/js/acordeon.js`);
    })
</script>