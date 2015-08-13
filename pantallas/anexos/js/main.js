/*
 * jQuery File Upload Plugin JS Example 6.7
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload();

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );
    // Load existing files:
    $('#fileupload').each(function () {
        var that = this;
        $.getJSON(this.action, function (result) {
            if (result && result.length) {
                $(that).fileupload('option', 'done')
                    .call(that, null, {result: result});
            }
        });
    });
    $('#fileupload').fileupload({
      add: function (e, data) {
          var jqXHR = data.submit()
              .success(function (result, textStatus, jqXHR) {//alert("Cargado");
              })
              .error(function (jqXHR, textStatus, errorThrown) {alert("Error");
              })
              .complete(function (result, textStatus, jqXHR) {//alert("Completo");
              });
      }
    });
    $('#fileupload').bind('fileuploadprogress', function (e, data) {
    // Log the current bitrate for this upload:
    console.log(data.bitrate);
});
	$('#fileupload').bind('fileuploaddone', function (e, data) {
    	$.post("insertar_csv.php",function(respuesta){
    		alert(respuesta);
    	});
	});
});
