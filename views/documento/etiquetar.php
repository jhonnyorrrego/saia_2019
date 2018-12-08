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
</div>
<script>
    $(function(){
        let baseUrl = Session.getBaseUrl();
        let userId = localStorage.getItem('key');
        let selections = '<?= $_REQUEST['selections'] ?>';

        if(typeof Tags == 'undefined'){
            $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/tags/tags.js`, r => {
                $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/tags/tag_events.js`, r => {
                    var tags = new Tags(userId);
                    $('#tag_list').html(tags.createList());
                }); 
            });
        }else{
            var tags = new Tags(userId);
            $('#tag_list').html(tags.createList());
        }

        $('#btn_success').on('click', e => {
            let tags = [];

            $('.checkbox_tag:checked').each((i,c) => {
                tags.push($(c).parents('li.tag_item').data('tagid'));
            });

            $.post(`${baseUrl}app/etiquetas/enlace_documento.php`, {
                key: userId,
                selections: selections,
                tags: tags.join()
            }, function(response){
                if(response.success){
                    toastr.success('Documentos etiquetados');
                    $('#close_modal').trigger('click');
                }else{
                    toastr.error(response.message, 'Error!');
                }
            }, 'json')
        });
    });
</script>