/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function(config) {
  // Define changes to default configuration here.
  // For the complete reference:
  // http://docs.ckeditor.com/#!/api/CKEDITOR.config

	
	config.toolbar = [
		//{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		//{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
		{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
		//{ name: 'tools', items: [ 'Maximize' ] },

		//{ name: 'others', items: [ '-' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline'] },

		{ name: 'styles', items: ['Font', 'FontSize' ] }
		//{ name: 'about', items: [ 'About' ] }
	];

	// Toolbar groups configuration.
//	config.toolbarGroups = [
//		//{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
//		//{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
////		{ name: 'insert' },
//		//{ name: 'forms' },
//		//{ name: 'tools' },
//    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
//    { name: 'links', groups: ['Url'] },
//    //{ name: 'others' },
//		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
//		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
//		{ name: 'styles' }
//		//{ name: 'colors' },
//		//{ name: 'about' }
//	];
	//config.extraPlugins = 'sfurl,sflink,divarea';
	config.extraPlugins = 'divarea';

  /*
   // The toolbar groups arrangement, optimized for a single toolbar row.
   config.toolbarGroups = [
   {name: 'document', groups: ['mode', 'document', 'doctools']},
   //		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
   //		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
   //		{ name: 'forms' },
   //		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
   {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
   {name: 'links'},
   {name: 'insert'},
   //		{ name: 'styles' },
   //		{ name: 'colors' },
   //		{ name: 'tools' },
   //		{ name: 'others' },
   //		{ name: 'about' }
   ];


   // The default plugins included in the basic setup define some buttons that
   // we don't want too have in a basic editor. We remove them here.

   config.extraPlugins = 'url';
   // Let's have it basic on dialogs as well.
   //	config.removeDialogTabs = 'link:advanced';

   */
  //config.removePlugins = 'link';
  //config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Underline,Strike,Subscript,Superscript,Print,Preview,Templates,Save,NewPage,Language,Iframe,PageBreak,SpecialChar,CreateDiv,Blockquote,Outdent,Indent,BidiLtr,BidiRtl,Table';
  //config.allowedContent = 'a[*]{*}(*);ul[*]{*}(*);ol;li[*]{*}(*);url[*]{*}(*);p[*]{*}(*);div[*]{*}(*);table[*]{*}(*);tr;td;span[*]{*}(*);strong;em';
  //config.filebrowserImageBrowseUrl = '/file/list_files?limit_file_size=1024&limit_nb_files=100&input_desc=0&input_name=1&input_order=1&is_list_filename_view=1&is_multi_lang=1&enable_upload_new=1&is_preview_image=1';
  //config.filebrowserImageWindowWidth = '960';
  //config.filebrowserImageWindowHeight = '640';
//  config.filebrowserImageBrowseUrl = '';
//  config.filebrowserBrowseUrl = '';
//	config.filebrowserFlashBrowseUrl = '';
//	config.filebrowserUploadUrl = '';
//	config.filebrowserImageUploadUrl = '';
//	config.filebrowserFlashUploadUrl = '';
//  config.contentsCss = 'contents.css';

};
