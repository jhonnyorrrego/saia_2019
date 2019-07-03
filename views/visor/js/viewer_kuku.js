$(document).ready(function () {
    var baseUrl = $('#viewer_script').data('baseurl');
    var params = $('#viewer_script').data('params');

    $('#viewer_script').removeAttr('data-params');

    (function find() {
        /*$kukuNode.html($('<div>', {
            class: 'progress-circle-indeterminate',
            id: 'loader'
        }));*/
        $.post(`${baseUrl}app/temporal/crear_anexo.php`, params, function (response) {
            if (response.success) {
                documentParser(baseUrl + response.data);
            } else {
                top.notification({
                    type: 'error',
                    message: response.message
                });
            }
        }, 'json');
    })();

    var $body = $('body');
    var $dragDropArea =  $("#drag-drop-area");
    var $uploadBtn =  $("#upload-btn");
    var $loading =  $("#parser-loading");
    var $modal =  $("#modal");
    var $modalCloseBtn =  $("#modal-close-btn");
    var $docxjsWrapper =$("#docxjs-wrapper");

    var instance = null;

    var stopEvent= function(e) {
        if(e.preventDefault) e.preventDefault();
        if(e.stopPropagation) e.stopPropagation();

        e.returnValue = false;
        e.cancelBubble = true;
        e.stopped = true;
    };

    var getInstanceOfFileType = function (file) {
        var fileExtension = null;
        if (file) {
            var fileName = file.name || file;
            fileExtension = fileName.split('.').pop();
        }
        return fileExtension;
    };

    var documentParser = function (file) {
        var fileType = getInstanceOfFileType(file);

        if (fileType) {
            if (fileType == 'docx') {
                instance = window.docxJS = window.createDocxJS ? window.createDocxJS() : new window.DocxJS();
            } else if (fileType == 'xlsx') {
                instance = window.cellJS = window.createCellJS ? window.createCellJS() : new window.CellJS();
            } else if (fileType == 'pptx') {
                instance = window.slideJS = window.createSlideJS ? window.createSlideJS() : new window.SlideJS();
            }

            if (instance) {
                $loading.show();
                var req = new XMLHttpRequest();
                req.open("GET", file, true);
                req.responseType = "blob";
                req.onload = function (e) {
                    let fileName = file.split('/').slice(-1).pop();
                    let blob = req.response;
                    blob.name = blob.fileName = fileName
                    
                    instance.parse(
                        blob,
                        function () {
                            $docxjsWrapper[0].filename = blob.name;
                            afterRender(file, fileType);
                            $loading.hide();
                        }, function (e) {
                            if(!$body.hasClass('is-docxjs-rendered')){
                                $docxjsWrapper.hide();
                            }
    
                            if(e.isError && e.msg){
                                alert(e.msg);
                            }
    
                            $loading.hide();
                        }, null
                    );
                };
                req.send();
            }
        }
    };

    var afterRender = function (file, fileType) {
        var element = $docxjsWrapper[0];
        $(element).css('height','calc(100% - 65px)');

        var loadingNode = document.createElement("div");
        loadingNode.setAttribute("class", 'docx-loading');
        element.parentNode.insertBefore(loadingNode, element);
        $modal.show();

        var endCallBackFn = function(result){
            if (result.isError) {
                if(!$body.hasClass('is-docxjs-rendered')){
                    $docxjsWrapper.hide();
                    $body.removeClass('is-docxjs-rendered');
                    element.innerHTML = "";

                    $modal.hide();
                    $body.addClass('rendered');
                }
            } else {
                $body.addClass('is-docxjs-rendered');
                console.log("Success Render");
            }

            loadingNode.parentNode.removeChild(loadingNode);
        };

        if (fileType === 'docx') {
            window.docxAfterRender(element, endCallBackFn);

        } else if (fileType === 'xlsx') {
            window.cellAfterRender(element, endCallBackFn);

        } else if (fileType === 'pptx') {
            window.slideAfterRender(element, endCallBackFn, 0);

        } else if (fileType === 'pdf') {
            window.pdfAfterRender(element, endCallBackFn, 0);
        }
    };

    $modalCloseBtn.on("click", function(e){
        $docxjsWrapper.empty();
        $modal.hide();

        instance.destroy(function(){
            instance = null;
        });
    });
});