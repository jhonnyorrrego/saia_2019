<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "controllers/autoload.php");

$files = Anexos::findAllByAttributes([
    'documento_iddocumento' => 8338
], [], 'idanexos desc', 0 , 3);

foreach ($files as $key => $Anexos) {
    $save = TemporalController::createTemporalFile($Anexos->ruta, $Anexos->tipo);
    if($save->success){
        $tipo = $Anexos->tipo;
        $$tipo = $ruta_db_superior . $save->route;
    }

    var_dump($Anexos->tipo);
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Render Example | Kukudocs JS Document Viewer</title>
    <meta name="author" content="KUKUDOCS">
    <meta name="description" content="An example of Page Control width kukudocs js document viewer">
</head>
<body>

<p style="font-size:24px; margin: 50px 0;"> Example of Page Control width kukudocs js document viewer </p>


<div class="container main-container">
    <button id="pdf">pdf</button>
    <button id="xlsx">xlsx</button>
    <button id="pptx">pptx</button>
    <button id="docx">docx</button>
    <button id="view-btn">Get File button</button>

    <!--control button-->
    <button id="prev-btn">prev button</button>
    <button id="next-btn">next button</button>

    <button id="zoom-in-btn">zoom in button</button>
    <button id="zoom-out-btn">zoom out button</button>

    <div id="kuku-viewer-node" style="width:1000px; height: 500px; border:1px solid #eee; margin: 20px 0;"></div>
</div>


<script type="text/javascript" src="../scripts/_lib/jquery.1.12.3.min.js"></script>
<script type="text/javascript" src="../scripts/docxjs/DocxJS.bundle.min.js"></script>
<script type="text/javascript" src="../scripts/celljs/CellJS.bundle.min.js"></script>
<script type="text/javascript" src="../scripts/slidejs/SlideJS.bundle.min.js"></script>
<script type="text/javascript" src="../scripts/pdfjs/PdfJS.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        var $kukuNode = $("#kuku-viewer-node");
        var $button = $("#view-btn");
        var $prevbutton = $("#prev-btn");
        var $nextbutton = $("#next-btn");
        var $zoomInbutton = $("#zoom-in-btn");
        var $zoomOutbutton = $("#zoom-out-btn");

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

        //Event
        $button.on('click', function (e) {
            stopEvent(e);

            var fileURL = prompt('Enter the url path to the file you have', 'Example - http://192.168.1.1/test.docx');

            if (fileURL) {
                documentParser(fileURL);
            } else {
                alert('no selected file');
            }
        });

        $('#pdf').on('click', function (e) {
            stopEvent(e);

            var fileURL = '<?= $pdf ?>';

            if (fileURL) {
                documentParser(fileURL);
            } else {
                alert('no selected file');
            }
        });

        $('#xlsx').on('click', function (e) {
            stopEvent(e);

            var fileURL = '<?= $xlsx ?>';

            if (fileURL) {
                documentParser(fileURL);
            } else {
                alert('no selected file');
            }
        });

        $('#pptx').on('click', function (e) {
            stopEvent(e);

            var fileURL = '<?= $pptx ?>';

            if (fileURL) {
                documentParser(fileURL);
            } else {
                alert('no selected file');
            }
        });


        $('#docx').on('click', function (e) {
            stopEvent(e);

            var fileURL = '<?= $docx?>';

            if (fileURL) {
                documentParser(fileURL);
            } else {
                alert('no selected file');
            }
        });


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
    });
</script>
</body>
</html>