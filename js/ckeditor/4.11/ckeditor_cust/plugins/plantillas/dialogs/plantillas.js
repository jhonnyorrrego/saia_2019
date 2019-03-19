/**
 * Copyright (c) 2014-2018, CKSource - Frederico Knabben. All rights reserved.
 * Licensed under the terms of the MIT License (see LICENSE.md).
 *
 * The plantillas plugin dialog window definition.
 *
 * Created out of the CKEditor Plugin SDK:
 * http://docs.ckeditor.com/ckeditor4/docs/#!/guide/plugin_sdk_sample_1
 */

// Our dialog definition.
CKEDITOR.dialog.add( 'plantillasDialog', function( editor ) {
	$.ajax({
		type: 'POST',
		url: "../../js/ckeditor/4.11/ckeditor_cust/plugins/plantillas/dialogs/archivos/plantillas_saia.php",
		data: {
			funcionario: localStorage.getItem('key')
		},
		success: function (response) {

			if (response) {
			}
		}
	});
	return {

		// Basic properties of the dialog window: title, minimum size.
		title: 'PLANTILLAS DE TEXTO',
		minWidth: 600,
		minHeight: 400,

		// Dialog window content definition.
		contents: [
			{
				// Definition of the Basic Settings dialog tab (page).
				// The tab content.
				
				elements: [
					{
						
						// Text input field for the plantillaseviation text.
						type: 'html',
						html: '<div id="plantillaSaia"></div>',

						// Validation checking whether the field is not empty.
						validate: CKEDITOR.dialog.validate.notEmpty( "plantillaseviation field cannot be empty." )
					},
					{
						// Text input field for the plantillaseviation title (explanation).
						type: 'text',
						id: 'title',
						label: 'Explanation',
						validate: CKEDITOR.dialog.validate.notEmpty( "Explanation field cannot be empty." )
					}
				]
			},

		],

		// This method is invoked once a user clicks the OK button, confirming the dialog.
		onOk: function() {

			// The context of this function is the dialog object itself.
			// http://docs.ckeditor.com/ckeditor4/docs/#!/api/CKEDITOR.dialog
			var dialog = this;

			// Create a new <plantillas> element.
			var plantillas = editor.document.createElement( 'plantillas' );

			// Set element attribute and text by getting the defined field values.
			plantillas.setAttribute( 'title', dialog.getValueOf( 'tab-basic', 'title' ) );
			plantillas.setText( dialog.getValueOf( 'tab-basic', 'plantillas' ) );

			// Now get yet another field value from the Advanced Settings tab.
			var id = dialog.getValueOf( 'tab-adv', 'id' );
			if ( id )
				plantillas.setAttribute( 'id', id );

			// Finally, insert the element into the editor at the caret position.
			editor.insertElement( plantillas );
		}
	};
});
