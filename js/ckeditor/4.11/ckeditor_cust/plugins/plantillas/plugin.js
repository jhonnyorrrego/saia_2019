/**
 * Copyright (c) 2014-2018, CKSource - Frederico Knabben. All rights reserved.
 * Licensed under the terms of the MIT License (see LICENSE.md).
 *
 * Basic sample plugin inserting plantillaseviation elements into the CKEditor editing area.
 *
 * Created out of the CKEditor Plugin SDK:
 * http://docs.ckeditor.com/ckeditor4/docs/#!/guide/plugin_sdk_sample_1
 */

// Register the plugin within the editor.
CKEDITOR.plugins.add( 'plantillas', {

	// Register the icons.
	icons: 'saia',

	// The plugin initialization logic goes inside this method.
	init: function( editor ) {

		// Define an editor command that opens our dialog window.
		editor.addCommand( 'plantillas', new CKEDITOR.dialogCommand( 'plantillasDialog' ) );

		// Create a toolbar button that executes the above command.
		editor.ui.addButton( 'saia', {

			// The text part of the button (if available) and the tooltip.
			label: 'Insert plantillaseviation',

			// The command to execute on click.
			command: 'plantillas',

			// The button placement in the toolbar (toolbar group name).
			toolbar: 'insert'
		});

		// Register our dialog file -- this.path is the plugin folder path.
		CKEDITOR.dialog.add( 'plantillasDialog', this.path + 'dialogs/plantillas.js' );
	}
});
