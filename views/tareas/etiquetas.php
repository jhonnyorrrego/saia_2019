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
    <div class="row">
        <div class="col-12 float-right">
            <button class="btn btn-complete" id="save_tags">Guardar</button>
        </div>
    </div>
</div>