class Modules {
    constructor(iduser){
        this.baseUrl = Session.getBaseUrl();
        this.user = iduser;
        this.load();
    }
    
    set baseUrl(route){
        this._baseUrl = route;
    }

    get baseUrl(){
        return this._baseUrl;
    }

    set user(iduser){
        this._iduser = iduser;
    }

    get user(){
        return this._iduser;
    }

    set modules(data) {
        this._modules = data;
    }

    get modules() {
        return this._modules;
    }

    load(){
        let instance = this;
        $.get(this.baseUrl + 'getModules.php',{
            iduser: this.user
        }, function(response){
            if(response.success){
                instance.modules = response.data;
                instance.show();
            }
        },'json');
    }

    show(){
        let html = Modules.createNodeList(this.modules);
        $("#module_list").append(html);

        $(".module_link").first().trigger('click');
    }

    static createNodeList(data){
        let nodes = [];

        data.forEach(module => {
            if (module.childs){
                var items = $('<li>').append(
                    $('<a>', {
                        href: 'javascript:;'
                    }).append(
                        $('<span>', {
                            class: 'title',
                            text: module.name
                        }),
                        $('<span>', {
                            class: 'arrow',
                        }),
                        $('<span>', {
                            class: 'icon-thumbnail'
                        }).append(
                            $('<i>', {
                                class: module.icon
                            })
                        )
                    ),
                    $('<ul>',{
                        class: 'sub-menu'
                    }).append(Modules.createNodeList(module.childs))
                );
            }else{
                var items = $('<li>').append(
                    $('<a>', {
                        href: '#',
                        class: 'detailed module_link',
                        url: Session.getBaseUrl() + module.url
                    }).append(
                        $('<span>', {
                            class: 'title',
                            text: module.name
                        }),
                        $('<span>', {
                            class: 'icon-thumbnail'
                        }).append(
                            $('<i>', {
                                class: module.icon
                            })
                        )
                    )
                );
            }

            nodes.push(items);
        });

        return nodes;
    }
}