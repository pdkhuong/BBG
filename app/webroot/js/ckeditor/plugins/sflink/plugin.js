(function() {
  CKEDITOR.plugins.add('sflink', {
    init: function(editor) {
      var iconPath = this.path + 'images/link.png';
      var pluginName = 'sflink',
        dialogName = 'sfLinkDialog';

      editor.addCommand(pluginName, new CKEDITOR.dialogCommand(dialogName));

      editor.ui.addButton('SimpleLink', {
        label: 'Insert a Link',
        command: pluginName,
        icon: iconPath
      });

      if (editor.contextMenu) {
        editor.addMenuGroup('myGroup');
        editor.addMenuItem('linkItem', {
          label: 'Edit Link',
          icon: iconPath,
          command: pluginName,
          group: 'myGroup'
        });
        editor.contextMenu.addListener(function(element) {
          if (getSelectedLink(editor, element))
            return {linkItem: CKEDITOR.TRISTATE_OFF};
        });
      }

      CKEDITOR.dialog.add(dialogName, function(editor) {
        return {
          title: 'Link Properties',
          minWidth: 400,
          minHeight: 200,
          contents:
            [
              {
                id: 'general',
                label: 'Settings',
                elements:
                  [
                    {
                      type: 'text',
                      id: 'name',
                      label: 'Name',
                      validate: CKEDITOR.dialog.validate.notEmpty('The Name field cannot be empty.'),
                      required: true,
                      commit: function(element) {
                        element.setText(this.getValue());
                      },
                      setup: function(element) {
                        this.setValue(element.getText());
                      },
                    },
                    {
                      type: 'text',
                      id: 'url',
                      label: 'URL',
                      validate: CKEDITOR.dialog.validate.notEmpty('The link must have a URL.'),
                      required: true,
                      commit: function(element) {
                        if (this.getValue() || this.isChanged()) {
                          element.data('cke-saved-href', this.getValue());
                          element.setAttribute('href', this.getValue());
                        }
                      },
                      setup: function(element) {
                        var href = element.data('cke-saved-href');
                        if (!href)
                          href = element.getAttribute('href');
                        this.setValue(href);
                      },
                    },
                  ]
              }
            ],
          onOk: function() {
            var dialog = this,
              link = this.element;

            if (this.insertMode)
              editor.insertElement(link);

            this.commitContent(link);

          },
          onShow: function() {
            var editor = this.getParentEditor(),
              sel = editor.getSelection(),
              element = sel && sel.getStartElement();

            if (element)
              element = element.getAscendant('a', true);

            if (!element || element.getName() != 'a' || element.data('cke-realelement'))
            {
              element = editor.document.createElement('a');
              this.insertMode = true;
            }
            else
              this.insertMode = false;

            this.element = element;
            this.setupContent(this.element);
          }
        };
      });
    }
  });

  function getSelectedLink(editor) {
    var selection = editor.getSelection();
    var selectedElement = selection.getSelectedElement();
    if (selectedElement && selectedElement.is('a') && !selectedElement.data('cke-realelement') && !selectedElement.isReadOnly())
      return selectedElement;

    var range = selection.getRanges()[ 0 ];

    if (range) {
      range.shrink(CKEDITOR.SHRINK_TEXT);
      return editor.elementPath(range.getCommonAncestor()).contains('a', 1);
    }
    return null;
  }

  function getFileInfo(fileurl) {
    alert(fileurl);
  }
})();