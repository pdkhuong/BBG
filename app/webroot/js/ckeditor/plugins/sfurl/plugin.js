(function() {
  CKEDITOR.plugins.add('sfurl', {
    requires: 'dialog',
    init: function(editor)
    {
      var iconPath = this.path + 'images/icon.png';
      var pluginName = 'url';

      CKEDITOR.dialog.add(pluginName, this.path + 'dialogs/url.js');
      editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName));
      editor.ui.addButton('Url',
        {
          label: 'Insert Url',
          toolbar: 'insert',
          command: pluginName,
          icon: iconPath
        });

      if (editor.contextMenu)
      {
        editor.addMenuGroup('myGroup');
        editor.addMenuItem('urlItem',
          {
            label: 'Edit Url',
            icon: iconPath,
            command: pluginName,
            group: 'myGroup'
          });
        editor.contextMenu.addListener(function(element)
        {
//          if (element)
//            element = element.getAscendant('url', true);
//          if (element && !element.isReadOnly() && !element.data('cke-realelement'))
//            return {urlItem: CKEDITOR.TRISTATE_OFF};
//          return null;
          if ( getSelectedUrl( editor, element ) )
						return { urlItem: CKEDITOR.TRISTATE_OFF };
        });
      }
    }
  });
  
  function getSelectedUrl(editor) {
    var selection = editor.getSelection();
		var selectedElement = selection.getSelectedElement();
		if ( selectedElement && selectedElement.is( 'url' ) && !selectedElement.data('cke-realelement') && !selectedElement.isReadOnly() )
			return selectedElement;

		var range = selection.getRanges()[ 0 ];

		if ( range ) {
			range.shrink( CKEDITOR.SHRINK_TEXT );
			return editor.elementPath( range.getCommonAncestor() ).contains( 'url', 1 );
		}
		return null;
  }
  
  function getFileInfo(fileurl){
    alert(fileurl);
  }

})();
