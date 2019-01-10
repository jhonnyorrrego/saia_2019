/**
 * $Id: editor_plugin_src.js 201 2007-02-12 15:56:56Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright © 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

(function() {
	var each = tinymce.each;

	tinymce.create('tinymce.plugins.plantillas_saiaPlugin', {
		init : function(ed, url) {
			var t = this;

			t.editor = ed;

			// Register commands
			ed.addCommand('mceplantillas_saia', function(ui) {
				ed.windowManager.open({
					file : url + '/pretextolist.php',
					width : ed.getParam('plantillas_saia_popup_width', 600),
					height : ed.getParam('plantillas_saia_popup_height', 600),
					inline : 1
				}, {
					plugin_url : url
				});
			});

			ed.addCommand('mceInsertplantillas_saia', t._insertplantillas_saia, t);

			// Register buttons
			ed.addButton('plantillas_saia', {title : 'plantillas_saia.desc', cmd : 'mceplantillas_saia',image : url+'/images/saia.gif'
});

			ed.onPreProcess.add(function(ed, o) {
				var dom = ed.dom;

				each(dom.select('div', o.node), function(e) {
					if (dom.hasClass(e, 'mceTmpl')) {
						each(dom.select('*', e), function(e) {
							if (dom.hasClass(e, ed.getParam('plantillas_saia_mdate_classes').replace(/\s+/g, '|')))
								e.innerHTML = t._getDateTime(new Date(), ed.getParam("plantillas_saia_mdate_format", ed.getLang("plantillas_saia.mdate_format")));
						});

						t._replaceVals(e);
					}
				});
			});
		},

		getInfo : function() {
			return {
				longname : 'plantillas_saia plugin',
				author : 'Moxiecode Systems AB',
				authorurl : 'http://www.moxiecode.com',
				infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/plantillas_saia',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		},

		_insertplantillas_saia : function(ui, v) {
			var t = this, ed = t.editor, h, el, dom = ed.dom, sel = ed.selection.getContent();

			h = v.content;

			each(t.editor.getParam('plantillas_saia_replace_values'), function(v, k) {
				if (typeof(v) != 'function')
					h = h.replace(new RegExp('\\{\\$' + k + '\\}', 'g'), v);
			});

			el = dom.create('div', null, h);

			function hasClass(n, c) {
				return new RegExp('\\b' + c + '\\b', 'g').test(n.className);
			};

			each(dom.select('*', el), function(n) {
				// Replace cdate
				if (hasClass(n, ed.getParam('plantillas_saia_cdate_classes', 'cdate').replace(/\s+/g, '|')))
					n.innerHTML = t._getDateTime(new Date(), ed.getParam("plantillas_saia_cdate_format", ed.getLang("plantillas_saia.cdate_format")));

				// Replace mdate
				if (hasClass(n, ed.getParam('plantillas_saia_mdate_classes', 'mdate').replace(/\s+/g, '|')))
					n.innerHTML = t._getDateTime(new Date(), ed.getParam("plantillas_saia_mdate_format", ed.getLang("plantillas_saia.mdate_format")));

				// Replace selection
				if (hasClass(n, ed.getParam('plantillas_saia_selected_content_classes', 'selcontent').replace(/\s+/g, '|')))
					n.innerHTML = sel;
			});

			t._replaceVals(el);

			ed.execCommand('mceInsertContent', false, el.innerHTML);
			ed.addVisual();
		},

		_replaceVals : function(e) {
			var dom = this.editor.dom, vl = this.editor.getParam('plantillas_saia_replace_values');

			each(dom.select('*', e), function(e) {
				each(vl, function(v, k) {
					if (dom.hasClass(e, k)) {
						if (typeof(vl[k]) == 'function')
							vl[k](e);
					}
				});
			});
		},

		_getDateTime : function(d, fmt) {
				if (!fmt)
					return "";

				function addZeros(value, len) {
					var i;

					value = "" + value;

					if (value.length < len) {
						for (i=0; i<(len-value.length); i++)
							value = "0" + value;
					}

					return value;
				}

				fmt = fmt.replace("%D", "%m/%d/%y");
				fmt = fmt.replace("%r", "%I:%M:%S %p");
				fmt = fmt.replace("%Y", "" + d.getFullYear());
				fmt = fmt.replace("%y", "" + d.getYear());
				fmt = fmt.replace("%m", addZeros(d.getMonth()+1, 2));
				fmt = fmt.replace("%d", addZeros(d.getDate(), 2));
				fmt = fmt.replace("%H", "" + addZeros(d.getHours(), 2));
				fmt = fmt.replace("%M", "" + addZeros(d.getMinutes(), 2));
				fmt = fmt.replace("%S", "" + addZeros(d.getSeconds(), 2));
				fmt = fmt.replace("%I", "" + ((d.getHours() + 11) % 12 + 1));
				fmt = fmt.replace("%p", "" + (d.getHours() < 12 ? "AM" : "PM"));
				fmt = fmt.replace("%B", "" + tinyMCE.getLang("plantillas_saia_months_long").split(',')[d.getMonth()]);
				fmt = fmt.replace("%b", "" + tinyMCE.getLang("plantillas_saia_months_short").split(',')[d.getMonth()]);
				fmt = fmt.replace("%A", "" + tinyMCE.getLang("plantillas_saia_day_long").split(',')[d.getDay()]);
				fmt = fmt.replace("%a", "" + tinyMCE.getLang("plantillas_saia_day_short").split(',')[d.getDay()]);
				fmt = fmt.replace("%%", "%");

				return fmt;
		}
	});

	// Register plugin
	tinymce.PluginManager.add('plantillas_saia', tinymce.plugins.plantillas_saiaPlugin);
})();
