class Modules {
    constructor(token, iduser, grouperSelector, listSelector) {
        if (this.setAttributes(token, iduser, grouperSelector, listSelector)) {
            this.find(0);
        } else {
            console.error("invalid arguments");
            Session.close();
        }
    }

    setAttributes(token, iduser, grouperSelector, listSelector) {
        if (token && iduser && grouperSelector && listSelector) {
            this.baseUrl = Session.getBaseUrl();
            this.token = token;
            this.user = iduser;
            this._grouperSelector = grouperSelector;
            this._listSelector = listSelector;
            this.defaultModule();

            return true;
        } else {
            return false;
        }
    }

    set baseUrl(route) {
        this._baseUrl = route;
    }

    get baseUrl() {
        return this._baseUrl;
    }

    set user(iduser) {
        this._iduser = iduser;
    }

    get user() {
        return this._iduser;
    }

    set token(token) {
        this._token = token;
    }

    get token() {
        return this._token;
    }

    set modules(data) {
        data = JSON.stringify(data);
        localStorage.setItem("modules", data);
    }

    get modules() {
        let string = localStorage.getItem("modules");
        return JSON.parse(string);
    }

    get groupers() {
        let initialModule = Modules.findModule(this.modules, 0);
        return initialModule.childs.filter(m => m.type == 0);
    }

    defaultModule() {
        if (!localStorage.getItem("modules")) {
            this.modules = [
                {
                    idmodule: 0,
                    isParent: 1,
                    type: 0
                }
            ];
        }
    }

    find(idmodule, url = "") {
        let parentModule = Modules.findModule(this.modules, idmodule);
        url = url || "app/modulo/hijos_directos.php";

        if (
            (!parentModule.childs && parentModule.isParent) ||
            parentModule.url
        ) {
            let instance = this;
            let grouper = parentModule.type == 0 ? 1 : 0;

            $.post(
                this.baseUrl + url,
                {
                    key: this.user,
                    token: this.token,
                    parent: idmodule,
                    grouper: grouper
                },
                function (response) {
                    if (response.success) {
                        if (response.data.length) {
                            parentModule.childs = response.data;
                            instance.modules = Modules.changeModule(
                                instance.modules,
                                idmodule,
                                parentModule
                            );

                            if (idmodule === 0) {
                                let module = response.data.find(m => m.type == 1);
                                localStorage.setItem('dashboard', btoa(module.url));
                                instance.showDashboard(module.url);
                            }

                            instance.show(idmodule);
                        }
                    }
                },
                "json"
            );
        } else {
            this.show(idmodule);
        }
    }

    show(idmodule) {
        let nodes = this.createNodes(idmodule);

        if (nodes.groupers) {
            $(this._grouperSelector).html(nodes.groupers);

            let grouper = this.groupers[0];
            this.find(grouper.idmodule);
        } else {
            if (this.groupers.find(m => m.idmodule == idmodule)) {
                $(this._listSelector).empty();
                nodes.list.forEach(i => $(this._listSelector).append(i));
            } else {
                let module = Modules.findModule(this.modules, idmodule);
                let selector = $(`#${idmodule} > .child_list`);

                if (
                    !selector.children().length ||
                    (module.url && module.isParent)
                ) {
                    selector.html(nodes.list);
                }
            }
        }
    }

    createNodes(idmodule) {
        if (!idmodule) {
            return this.createGroupers();
        } else {
            return this.createList(idmodule);
        }
    }

    createGroupers() {
        let row = $("<div>", {
            class: "row p-0 m-0 justify-content-center"
        });

        let backgrounds = [
            "bg-complete",
            "bg-danger",
            "bg-primary",
            "bg-warning"
        ];

        this.groupers.forEach((g, i) => {
            row.append(`
                <div data-name="${g.identificator}" class="col-12 col-md-auto grouper cursor text-center p-1" id="${
                g.idmodule
                }">
                    <table class="mx-auto">
                        <tbody>
                            <tr>
                                <td class="align-middle ${
                backgrounds[i]
                }" style="height: 100px;width: 100px;">
                                    <i class="${
                g.icon
                } w-100 py-2" style="font-size:2.5rem"></i>
                                    <span class="d-block text-truncate" title="${
                g.name
                }">${g.name}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `);
        });

        return { groupers: row };
    }

    createList(idmodule) {
        let module = Modules.findModule(this.modules, idmodule);
        let list = [];

        module.childs.forEach(m => {
            if (m.isParent) {
                list.push(Modules.createParent(m));
            } else {
                list.push(Modules.createChild(m));
            }
        });

        return { list: list };
    }

    showDashboard(route) {
        route = this.baseUrl + route;
        document.getElementById('iframe_workspace').src = route;
    }

    static findModule(modules, idmodule) {
        let module = 0;

        for (let m of modules) {
            if (m.idmodule == idmodule) {
                module = m;
            } else if (m.childs) {
                module = Modules.findModule(m.childs, idmodule);
            }

            if (module) break;
        }

        return module;
    }

    static changeModule(modules, idmodule, data) {
        return modules.map(m => {
            if (m.idmodule == idmodule) {
                return data;
            } else if (m.childs) {
                m.childs = Modules.changeModule(m.childs, idmodule, data);
            }

            return m;
        });
    }

    static createParent(module) {
        return $("<li>", {
            class: "parent_item",
            id: module.idmodule
        })
            .append(
                $("<a>", {
                    href: "javascript:;"
                }).append(
                    $("<span>", {
                        class: "title",
                        text: module.name
                    }),
                    $("<span>", {
                        class: "arrow"
                    }),
                    $("<span>", {
                        class: "icon-thumbnail"
                    }).append(
                        $("<i>", {
                            class: module.icon
                        })
                    )
                ),
                $("<ul>", {
                    class: "sub-menu child_list"
                })
            )
            .attr("data-url", module.url)
            .attr("data-name", module.identificator)
    }

    static createChild(module) {
        return $("<li>").append(
            $("<a>", {
                href: "#",
                class: "detailed module_link",
                'data-name': module.identificator,
                url: Session.getBaseUrl() + module.url
            }).append(
                $("<span>", {
                    class: "title",
                    text: module.name
                }),
                $("<span>", {
                    class: "icon-thumbnail"
                }).append(
                    $("<i>", {
                        class: module.icon
                    })
                )
            )
        );
    }
}
