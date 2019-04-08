$(function() {
    let baseUrl = $("script[data-baseurl]").data("baseurl");
    let route = new String();
    let dropzone = null;

    (function init() {
        showImage();
        dropzone = createFileInput();
    })();

    $("#save_logo").on("click", function() {
        if (route.length) {
            $.post(
                `${baseUrl}app/configuracion/cambio_logo.php`,
                {
                    key: localStorage.getItem("key"),
                    route: route
                },
                function(response) {
                    if (response.success) {
                        top.notification({
                            type: "success",
                            message: response.message
                        });

                        localStorage.setItem("logo", route);

                        $("#client_image", top.document).attr("src", baseUrl + route);
                        showImage();
                    } else {
                        top.notification({
                            type: "error",
                            message: response.message
                        });
                    }
                },
                "json"
            );
        } else {
            top.notification({
                type: "error",
                message: "Debes cargar una imagen"
            });
        }
    });

    $("#remove_logo").on("click", function() {
        dropzone.removeAllFiles();
        route = new String();
    });

    function createFileInput() {
        $("#file").addClass("dropzone");
        return new Dropzone("#file", {
            url: `${baseUrl}app/temporal/cargar_anexos.php`,
            dictDefaultMessage:
                "Haga clic para elegir un archivo o Arrastre acá el archivo.",
            maxFilesize: 3,
            maxFiles: 1,
            dictFileTooBig: "Tamaño máximo {{maxFilesize}} MB",
            dictMaxFilesExceeded: "Máximo 1 archivo",
            params: {
                key: localStorage.getItem("key"),
                dir: "logo"
            },
            paramName: "file",
            init: function() {
                this.on("success", function(file, response) {
                    response = JSON.parse(response);

                    if (response.success) {
                        route = response.data[0];

                        showImage(route);
                    } else {
                        top.notification({
                            type: "error",
                            message: response.message
                        });
                    }
                });
            }
        });
    }

    function showImage(route = "") {
        if (!route) {
            route = localStorage.getItem("logo");
        }

        $("#logo").attr("src", baseUrl + route);
    }
});
