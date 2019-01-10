(function(){tinymce.PluginManager.requireLangPack("tablegrid");tinymce.create("tinymce.plugins.TableGrid",{createControl:function(f,a){var d=this,b=d.ed;if(f==="tablegrid"){var e=a.createSplitButton("grid",{title:"tablegrid.create_table",image:d.url+"/img/table-grid.gif",onclick:function(){b.execCommand("mceInsertTable")}});e.showMenu=function(){d.ed.execCommand("openTableGridPopup")};return e}return null},init:function(a,b){var c=this,d=tinymce.DOM;c.url=b;c.ed=a;c.popupIsVisible=0;c.tableGridSelectionBoookmark=null;a.addCommand("openTableGridPopup",function(){c._showPopup()});a.onClick.add(function(f,g){c._hidePopup()});a.onNodeChange.add(function(f,e,h){var g;h=f.selection.getStart();g=f.dom.getParent(h,"td,th,caption");e.setActive("grid",h.nodeName==="TABLE"||!!g);if(g&&g.nodeName==="CAPTION"){g=0}e.setDisabled("delete_table",!g);e.setDisabled("delete_col",!g);e.setDisabled("delete_table",!g);e.setDisabled("delete_row",!g);e.setDisabled("col_after",!g);e.setDisabled("col_before",!g);e.setDisabled("row_after",!g);e.setDisabled("row_before",!g);e.setDisabled("row_props",!g);e.setDisabled("cell_props",!g);e.setDisabled("split_cells",!g);e.setDisabled("merge_cells",!g)});a.onInit.add(function(f,e){d.loadCSS(b+"/css/tablegrid.css");c._createPopup()});d.bind(document,"mousedown",function(h){var f=d.getParent(h.target,".tg-popup-container");var g=h.target.id===a.id+"_grid_open";if(!g&&!f){c._hidePopup()}})},getInfo:function(){return{longname:"Table Grid",author:"thomas@mr-andersen.no",authorurl:"http://www.mr-andersen.no.com",infourl:"http://www.mr-andersen.no.com",version:"1.1"}},_createPopup:function(){var j=this,f=j.ed,d=tinymce.DOM;var i,h,g,c,e,a,b;i=d.create("table",{cellpadding:0,cellspacing:0,id:f.id+"-tg-popup-container","class":"tg-popup-container",style:"display:none"});h=d.create("tbody");g=d.create("tr");c=d.create("td");d.add(i,h);d.add(h,g);d.add(g,c);e=d.create("div",{id:f.id+"-tg-grid-wrapper","class":"tg-grid-wrapper"});a=j._createGrid();g=d.create("tr");c=d.create("td");b=d.create("div",{id:f.id+"-tg-popup-footer","class":"tg-popup-footer"},"0 x 0");d.bind(b,"mouseover",function(l){var k=f.getLang("tablegrid.close_grid");l.target.innerHTML=k;l.target.title=k});d.bind(b,"click",function(k){j._hidePopup()});d.add(c,e);d.add(e,a);d.add(h,g);d.add(g,c);d.add(c,b);d.add(d.select("body",document)[0],i)},_showPopup:function(i){var k=this,h=k.ed,f=tinymce.DOM;var a=f.select("#"+h.id+"-tg-popup-container",document)[0];if(tinymce.isIE){h.focus();k.tableGridSelectionBoookmark=h.selection.getBookmark()}if(k.popupIsVisible){return k._hidePopup()}var d=f.select("#"+h.id+"_grid",document)[0];var j=f.getPos(d,document.getElementsByTagName("body")[0]);var g=f.getRect(d);var b=j.y+g.h;var e=j.x;f.addClass(d,"mceSplitButtonSelected");f.show(a);f.setStyles(a,{top:(b+"px"),left:(e+"px")});k.popupIsVisible=1},_hidePopup:function(){var c=this,b=c.ed,e=tinymce.DOM;var a=e.select("#"+b.id+"-tg-popup-container",document)[0];var d=e.select("#"+b.id+"_grid",document)[0];if(!a){return}e.removeClass(d,"mceSplitButtonSelected");e.hide(a);c._clearGrid();c.popupIsVisible=0},_createGrid:function(){var m=this,g=m.ed,d=tinymce.DOM,h,c,b,f,e;var l=parseInt(g.getParam("tablegrid_row_size"))||10;var k=parseInt(g.getParam("tablegrid_col_size"))||10;var a=d.create("table",{"class":"tg-grid",cellSpacing:1,cellPadding:0});b=d.create("tbody");for(f=0;f<l;f++){h=d.create("tr",{});d.add(b,h);for(e=0;e<k;e++){c=m._createCell(f,e);d.add(h,c)}}d.add(a,b);return a},_createCell:function(g,e){var i=this,d=i.ed,b=tinymce.DOM,h,f;var a=b.create("td");var c=b.create("a",{row:g,col:e,"class":"tg-blank"},"");b.add(a,c);b.bind(c,"mouseover",function(j){i._fillCells(j.target)},document);b.bind(c,"click",function(j){h=parseInt(b.getAttrib(j.target,"row"))+1;f=parseInt(b.getAttrib(j.target,"col"))+1;i._insert(h,f);i._hidePopup()},document);return a},_fillCells:function(e){var o=this,h=o.ed,d=tinymce.DOM;var b=d.select("#"+h.id+"-tg-popup-container",document)[0];var a=d.select("#"+h.id+"-tg-grid-wrapper",document)[0];var l=d.select("#"+h.id+"-tg-popup-footer",b)[0];var n=d.select("tr",a);var k=parseInt(d.getAttrib(e,"row"))+1,g=parseInt(d.getAttrib(e,"col"))+1;var m,f,c;for(f=0;f<n.length;f++){m=d.select("a",n[f]);for(c=0;c<m.length;c++){if(c<g&&f<k){d.setAttrib(m[c],"class","tg-fill-color");l.innerHTML=(f+1)+" x "+(c+1)}else{d.setAttrib(m[c],"class","tg-blank")}}}},_clearGrid:function(){var d=this,b=d.ed,f=tinymce.DOM,c;var a=f.select("#"+b.id+"-tg-popup-container",document)[0];var g=f.select("#"+b.id+"-tg-popup-footer",a)[0];var e=f.select("a",a);g.innerHTML="0 x 0";f.setAttrib(e,"class","tg-blank")},_insert:function(a,b){var l=this,h=l.ed,c=h.dom,k=h.selection,e,d;var g='<table width="100%" border="0" class="mceItemTable" _mce_new="1">\n';g+="<tbody>\n";for(e=0;e<a;e++){g+="<tr>\n";for(d=0;d<b;d++){if(!tinymce.isIE){g+='<td><br _mce_bogus="1" /></td>\n'}else{g+="<td></td>\n"}}g+="</tr>\n"}g+="</tbody>\n";g+="</table>\n";if(tinymce.isIE){h.selection.moveToBookmark(l.tableGridSelectionBoookmark)}h.execCommand("mceBeginUndoLevel");if(h.settings.fix_table_elements){var f="";h.focus();h.selection.setContent('<br class="_mce_marker" />');tinymce.each("h1,h2,h3,h4,h5,h6,p".split(","),function(i){if(f){f+=","}f+=i+" ._mce_marker"});tinymce.each(h.dom.select(f),function(i){h.dom.split(h.dom.getParent(i,"h1,h2,h3,h4,h5,h6,p"),i)});c.setOuterHTML(c.select("br._mce_marker")[0],g)}else{h.execCommand("mceInsertContent",false,g)}tinymce.each(c.select("table[_mce_new]"),function(i){var j=c.select("td",i);h.selection.select(j[0],true);h.selection.collapse(true);c.setAttrib(i,"_mce_new","")});h.addVisual();h.execCommand("mceEndUndoLevel")}});tinymce.PluginManager.add("tablegrid",tinymce.plugins.TableGrid)})();