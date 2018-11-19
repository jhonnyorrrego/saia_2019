class Modules {
    constructor(iduser, grouperSelector, listSelector){
        if (this.setAttributes(iduser, grouperSelector, listSelector)){
            if(!this.modules[0].childs){
                let initialModule = Modules.getModuleById(0);
                this.find(initialModule);
            }else{
                this.show();
            }
        }else{
            console.error('invalid arguments');
        }
    }

    setAttributes(iduser, grouperSelector, listSelector){
        if(iduser && grouperSelector && listSelector){
            this.baseUrl = Session.getBaseUrl();
            this.user = iduser;
            this._grouperSelector = grouperSelector;
            this._listSelector = listSelector;
            this.defaultModule();

            return true;
        }else{
            return false;
        }
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
        data = JSON.stringify(data);
        localStorage.setItem('modules', data);
    }

    get modules() {
        let string = localStorage.getItem('modules');
        return JSON.parse(string);
    }

    defaultModule(){
        if (!localStorage.getItem('modules')){
            this.modules = [{ idmodule: 0 }];
        }        
    }

    find(parentModule){
        let instance = this;
        
        $.get(`${this.baseUrl}app/modulo/hijos_directos.php`,{
            iduser: this.user,
            parent: parentModule.idmodule
        }, function(response){
            if(response.success){
                parentModule.childs = response.data;

                instance.modules = instance.modules.map(m => {
                    if (parentModule.idmodule == m.idmodule) {
                        return parentModule;
                    }else{
                        return m;
                    }
                });

                instance.show();
            }
        },'json');
    }

    show(){
        let nodes = this.createNodes();

        if(nodes.groupers){
            $(this._grouperSelector).append(nodes.groupers);

            let groupers = this.modules[0].childs.find(m => m.type == "grouper");
            this.showList(groupers.idmodule);
        }else{
            $(this._listSelector).append(nodes.list);
        }
    }

    createNodes(data) {        
        if(!$(this._grouperSelector).children().length){
            return this.createGroupers();
        }else{
            return this.createList();
        }
    }

    createGroupers(){
        let groupers = this.modules[0].childs.filter(m => m.type == 'grouper');
        
        let row = $('<div>',{
            class: 'row'
        });
        
        groupers.forEach(g => {
            row.append($("<div>", {
                    class: "col-12 col-md-6 py-1 px-0 mx-0 grouper",
                    id: g.idmodule
                }).append($("<div>", {
                        class:"bg-complete text-center py-2 align-middle mx-auto",
                        height: 92,
                        width: 92
                    }).append($("<i>", {
                            class: `${g.icon} w-100 py-2`,
                            style: "font-size:1.8rem"
                        }),
                        g.name
                    )
                )
            );
        });

        let container = $('<div>',{
            class: 'container'
        }).append(row);

        return {groupers : container};
    }

    createList(){
        /*data.forEach(module => {
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

        return nodes;*/
    }

    showList(idmodule){
        let module = Modules.getModuleById(this.modules, idmodule);
        console.log(module);
    }
    
    static getModuleById(modules, idmodule){
        let totalModules = Modules.getTotalModules(modules);
        return totalModules.find(m => m.idmodule == idmodule);
    }

    static getTotalModules(modules){
        let total = [];
        modules.forEach(m => {
            total.push(m);

            if(m.childs){
                total = total.concat(Modules.getTotalModules(m.childs));
            }
        });

        return total;
    }
}