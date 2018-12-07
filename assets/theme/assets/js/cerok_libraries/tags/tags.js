class Tags {
    constructor (userId){
        this.user = userId;
    }

    set baseUrl(route){
        this._baseurl = route
    }

    get baseUrl(){
        return this._baseurl ||
            Session.getBaseUrl() ||
            '';
    }

    set user(userId){
        this._user = userId
    }

    get user(){
        return this._user;
    }

    set tags(data){
        this._tags = data;
    }

    get tags(){
        return this._tags;
    }
    
    createList(){
        let response = new String();

        if(this.tags){
            if(!this.tags.length){
                response = Tags.noDataFound();
            }else{
                let data = [];
                this.tags.forEach(t => {
                    data.push(Tags.createTemplate(t));
                })

                response = data.join('');
            }
        }else{
            response = this.findTags();
        }

        return response;
    }

    findTags(){
        let instance = this;
        let ouput = new String();

        $.ajax({
            url: `${this.baseUrl}app/etiquetas/funcionario.php`,
            type: 'POST',
            async: false,
            dataType: 'json',
            data: {
                key: this.user
            },
            success: response => {
                if(response.success){
                    instance.tags = response.data;
                    ouput = instance.createList();
                }else{
                    toastr.error(response.message, 'Error!');
                }
            }
        });

        return ouput;
    }

    static createTemplate(tag){
        return `<li class="tag_item list-group-item d-flex justify-content-between align-items-center p-1" data-tagid="${tag.idetiqueta}">
            <input type="checkbox" class="checkbox_tag">
            <div class="">
                <input type="text" readOnly class="item_tag_name form-control text-dark bg-white" value="${tag.nombre}" style="border:0px">
                <small class="error pl-2" class="tag_name_error"></small>
            </div>
            <span>
                <span class="p-1 cursor delete_tag tag_options">
                    <i class="fa fa-trash"></i>
                </span>
                <span class="p-1 cursor edit_tag tag_options">
                    <i class="fa fa-edit"></i>
                </span>
                <span class="p-1 cursor save_tag tag_options" style="display:none">
                    <i class="fa fa-save"></i>
                </span>
            </span>
        </li>`;
    }

    static save(tag){
        let baseUrl = Session.getBaseUrl();

        $.post(`${baseUrl}app/etiquetas/guardar.php`, tag, (response) => {
            if(response.success){
                if(!parseInt(tag.idetiqueta))
                    $('li.tag_item[data-tagid=0]').attr('data-tagid', response.data);
            }else{
                toastr.error(response.message, 'Error!');
            }
        }, 'json');
    }

    static delete(tag){
        let baseUrl = Session.getBaseUrl();

        $.post(`${baseUrl}app/etiquetas/inactivar.php`, tag, (response) => {
            if(!response.success){
                toastr.error(response.message, 'Error!');
            }
        }, 'json');
    }

    static noDataFound(){
        return `<li class="list-group-item d-flex justify-content-between align-items-center py-1">
            <span>
                <span>Sin etiquetas</span>
            </span>
        </li>`;
    }

    static changeState(checkbox){
        if (checkbox.readOnly)
            checkbox.checked = checkbox.readOnly = false;
        else if (!checkbox.checked)
            checkbox.readOnly = checkbox.indeterminate = true;
    }
}