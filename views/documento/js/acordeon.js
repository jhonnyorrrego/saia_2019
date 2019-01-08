$(function () {
    let baseUrl = $('script[data-baseurl]').data('baseurl');
    let params = $('script[data-params]').data('params');
    
    $('#document_header').load(`${baseUrl}views/documento/encabezado.php?documentId=${params.documentId}&transferId=${params.transferId}`);
    $('#view_document').load('../../formatos/vincular_doc_expedie/mostrar_vincular_doc_expedie.php?iddoc=8');
});