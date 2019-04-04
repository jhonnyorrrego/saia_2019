$(document).ready(function () {
    var baseUrl = $('#viewer_script').data('baseurl');
    var params = $('#viewer_script').data('params');
    var $kukuNode = $("#kuku-viewer-node");
    var $button = $("#view-btn");
    var $prevbutton = $("#prev-btn");
    var $nextbutton = $("#next-btn");
    var $zoomInbutton = $("#zoom-in-btn");
    var $zoomOutbutton = $("#zoom-out-btn");
    $('#viewer_script').removeAttr('data-params');

    var instance = null, fileType = null;
    var docxJS = null, cellJS = null, slideJS = null, pdfJS = null;

    var documentParser = function (fileURL) {
        fileType = getInstanceOfFileType(fileURL);

        if (fileType) {
            if (instance) {
                /** destroy API
                 *  structure : destory(callback) **/
                instance.destroy();
            }

            if (fileType === 'docx') {
                if (!docxJS) {
                    docxJS = new DocxJS();
                }
                instance = docxJS;
            } else if (fileType === 'xlsx') {
                if (!cellJS) {
                    cellJS = new CellJS();
                }
                instance = cellJS;
            } else if (fileType === 'pptx') {
                if (!slideJS) {
                    slideJS = new SlideJS();
                }
                instance = slideJS;
            } else if (fileType === 'pdf') {
                if (!pdfJS) {
                    pdfJS = new PdfJS();
                }
                instance = pdfJS;

                instance.setCMapUrl('cmaps/');
            }

            if (instance) {

                var req = new XMLHttpRequest();


                /** Import remote files
                 * Check File URL & domain origin
                 * Enter the url path to the file you have.
                 * **/

                req.open("GET", fileURL, true);


                /** Blob Type Setting
                 * Response Type is Blob **/

                req.responseType = "blob";


                /** Blob Request
                 *  AJAX Request **/
                req.onload = function (e) {
                    var blob = req.response;


                    /** When you explicitly set the file name, use it as shown below.
                     * Be sure to enter an extension when you explicitly enter a file name.
                     *
                     * blob.name : Chrome & IE etc
                     * blob.fileName : Cross Browsing for Firefox
                     *
                     * Ext : pptx, docx, xlsx, pdf
                     * **/
                    blob.name = blob.fileName = 'Test.pptx';


                    /** parse API
                     *  structure : parse(file, successCallbackFn, errorCallbackFn) **/
                    instance.parse(
                        blob,
                        function () {
                            /** render API
                             *  structure : render(element, callbackFn, pageId) **/
                            instance.render($kukuNode[0], function () {
                                /*** After Renderer Logic ***/
                            });
                        },
                        function () {
                            console.log('document js viewer parsing error');
                        });
                };

                req.send();
            } else {
                console.log('no support files');
            }
        } else {
            console.log('no support files');
        }
    };

    //Utils
    var stopEvent = function (e) {
        if (e.preventDefault) e.preventDefault();
        if (e.stopPropagation) e.stopPropagation();
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

    $prevbutton.on('click', function (e) {
        stopEvent(e);
        if (instance) {
            if (fileType === 'docx') {
                console.log('no support prev page');
            } else if (fileType === 'xlsx') {
                /** getFileInfo API
                 *  structure : getFileInfo() **/
                var fileInfo = instance.getFileInfo();
                if (fileInfo.sheetNames) {
                    /** getCurrentId API
                     *  structure : getCurrentId() **/
                    currentId = instance.getCurrentId();
                    var sheetId = null, isFind = false;
                    $.each(fileInfo.sheetNames, function () {
                        if (currentId === this.sheetId) {
                            isFind = true
                        } else if (isFind === false) {
                            sheetId = this.sheetId;
                        }
                    });

                    if (sheetId && sheetId !== currentId) {
                        /** gotoPage API
                         *  structure : getCurrentId(pageId) **/
                        instance.gotoPage(sheetId);
                    }
                }
            } else if (fileType === 'pptx' || fileType === 'pdf') {
                currentId = instance.getCurrentId();
                instance.gotoPage(currentId - 1);
            }
        }
    });
    $nextbutton.on('click', function (e) {
        stopEvent(e);
        if (instance) {
            if (fileType === 'docx') {
                console.log('no support next page');
            } else if (fileType === 'xlsx') {
                var fileInfo = instance.getFileInfo();
                if (fileInfo.sheetNames) {
                    currentId = instance.getCurrentId();

                    var sheetId = null;
                    $.each(fileInfo.sheetNames, function () {
                        if (sheetId === -1) {
                            sheetId = this.sheetId;
                        }
                        if (currentId === this.sheetId) {
                            sheetId = -1;
                        }
                    });

                    if (sheetId && sheetId !== currentId) {
                        instance.gotoPage(sheetId);
                    }
                }
            } else if (fileType === 'pptx' || fileType === 'pdf') {
                currentId = instance.getCurrentId();
                instance.gotoPage(currentId + 1);
            }
        }
    });
    $zoomInbutton.on('click', function (e) {
        stopEvent(e);
        if (instance) {
            /** getZoom API
             *  structure : getZoom() **/
            var currentZoom = instance.getZoom();

            /** setZoom API
             *  structure : setZoom(zoomVal) **/
            instance.setZoom(currentZoom + 0.5);
        }
    });
    $zoomOutbutton.on('click', function (e) {
        stopEvent(e);
        var currentZoom = instance.getZoom();
        instance.setZoom(currentZoom - 0.5);
    });

    (function find() {
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
});