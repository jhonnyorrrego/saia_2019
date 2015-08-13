tinyMCEPopup.requireLangPack();

var FormatosDialog = {
	init : function(ed) {
		tinyMCEPopup.resizeToInnerSize();
	},

	insert : function(nombre) {
		var ed = tinyMCEPopup.editor, dom = ed.dom;
    nombre=nombre.replace(/[\*\{\}]/g,'');
    
		tinyMCEPopup.execCommand('mceInsertContent', false, '{*'+nombre+'*}'
    
    ); 

		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(FormatosDialog.init, FormatosDialog);
