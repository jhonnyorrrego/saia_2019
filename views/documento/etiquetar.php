<div class="container-fluid p-0">
    <div class="row mx-0">
        <div class="col-12 p-0">
            <ul class="list-group" id="tag_list"></ul>
        </div>
    </div>
    <div class="row mx-0 align-items-center">
        <div class="col pl-0">
            <div class="form-group my-2">
                <input id="tag_name" class="form-control" type="text" placeholder="Nombre." style="display:none">
                <small class="error pl-2" id="tag_name_error"></small>
            </div>
        </div>
        <div class="col-auto">
            <span class="cursor" id="add_tag">
                <i class="fa fa-plus"></i>
            </span>
            <span class="cursor" id="save_tag" style="display:none">
                <i class="fa fa-save"></i>
            </span>
        </div>
    </div>
    <div class="row pt-2">
        <div class="col-12">
            <button class="btn btn-complete float-right" id="save_relation">Guardar</button>
        </div>
    </div>
</div>
<script>
    $(function() {
        let baseUrl = Session.getBaseUrl();
        let userId = localStorage.getItem('key');
        let selections = '<?= $_REQUEST["selections"] ? $_REQUEST["selections"] : $_REQUEST["documentId"]  ?>';

        if (typeof Tags == 'undefined') {
            $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/tags/tags.js`, r => {
                $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/tags/tag_events.js`, r => {
                    showTags(userId, selections);
                });
            });
        } else {
            showTags(userId, selections);
        }

        $('#save_relation').on('click', e => {
            let tags = {};

            $('.checkbox_tag').each(function(i, c) {
                let tagId = $(c).parents('li.tag_item').data('tagid');

                if ($(c).is(':checked')) {
                    tags[tagId] = 1;
                } else if ($(c).is(':indeterminate')) {
                    tags[tagId] = 2;
                } else {
                    tags[tagId] = 0;
                }
            });

            $.post(`${baseUrl}app/etiquetas/enlace_documento.php`, {
                key: userId,
                selections: selections,
                tags: tags
            }, function(response) {
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
            }, 'json')
        });

        function showTags(userId, selections) {
            var tags = new Tags(userId);
            tags.selections = selections;
            $('#tag_list').html(tags.createList());
            tags.check();
        }
    });
</script>