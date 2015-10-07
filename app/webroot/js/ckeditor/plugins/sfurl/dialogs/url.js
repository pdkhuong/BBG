(function() {
  var urlDialog = function(editor, dialogType) {
    var plugin = CKEDITOR.plugins.url,
      IMAGE = 1,
      PDF = 2,
      PREVIEW = 4,
      CLEANUP = 8,
      regexGetSize = /^\s*(\d+)((px)|\%)?\s*$/i;

    var previewPreloader;

    var updatePreview = function(dialog) {
      if (!dialog.originalElement || !dialog.preview)
        return 1;

      dialog.commitContent(PREVIEW, dialog.preview);
      return 0;
    };

    function commitContent() {
      var args = arguments;
      var inlineStyleField = this.getContentElement('advanced', 'txtdlgGenStyle');
      inlineStyleField && inlineStyleField.commit.apply(inlineStyleField, args);

      this.foreach(function(widget) {
        if (widget.commit && widget.id != 'txtdlgGenStyle')
          widget.commit.apply(widget, args);
      });
    }

    // Avoid recursions.
    var incommit;

    function commitInternally(targetFields) {
      if (incommit)
        return;

      incommit = 1;

      var dialog = this.getDialog(),
        element = dialog.imageElement;
      if (element) {
        // Commit this field and broadcast to target fields.
        this.commit(IMAGE, element);

        targetFields = [].concat(targetFields);
        var length = targetFields.length,
          field;
        for (var i = 0; i < length; i++) {
          field = dialog.getContentElement.apply(dialog, targetFields[ i ].split(':'));
          // May cause recursion.
          field && field.setup(IMAGE, element);
        }
      }

      incommit = 0;
    };
    
    var resetSize = function(dialog) {
      var oImageOriginal = dialog.originalElement;
      if (oImageOriginal.getCustomData('isReady') == 'true') {
        var widthField = dialog.getContentElement('info', 'txtWidth'),
          heightField = dialog.getContentElement('info', 'txtHeight');
        widthField && widthField.setValue(oImageOriginal.$.width);
        heightField && heightField.setValue(oImageOriginal.$.height);
      }
      updatePreview(dialog);
    };

    var onImgLoadEvent = function() {
      // Image is ready.
      var original = this.originalElement;
      original.setCustomData('isReady', 'true');
      original.removeListener('load', onImgLoadEvent);
      original.removeListener('error', onImgLoadErrorEvent);
      original.removeListener('abort', onImgLoadErrorEvent);

      // Hide loader
      CKEDITOR.document.getById(imagePreviewLoaderId).setStyle('display', 'none');

      // New image -> new domensions
      if (!this.dontResetSize)
        resetSize(this);

      this.firstLoad = false;
      this.dontResetSize = false;
    };

    var onImgLoadErrorEvent = function() {
      // Error. Image is not loaded.
      var original = this.originalElement;
      original.removeListener('load', onImgLoadEvent);
      original.removeListener('error', onImgLoadErrorEvent);
      original.removeListener('abort', onImgLoadErrorEvent);

      // Set Error image.
      var noimage = CKEDITOR.getUrl(CKEDITOR.plugins.get('image').path + 'images/noimage.png');

      if (this.preview)
        this.preview.setAttribute('src', noimage);

      // Hide loader
      CKEDITOR.document.getById(imagePreviewLoaderId).setStyle('display', 'none');
    };

    var numbering = function(id) {
      return CKEDITOR.tools.getNextId() + '_' + id;
    },
      btnLockSizesId = numbering('btnLockSizes'),
      btnResetSizeId = numbering('btnResetSize'),
      imagePreviewLoaderId = numbering('ImagePreviewLoader'),
      previewLinkId = numbering('previewLink'),
      previewImageId = numbering('previewImage');
    return {
      title: 'URL Properties',
      minWidth: 400,
      minHeight: 200,
      contents:
        [
          {
            id: 'image_tab',
            label: 'Image',
            elements:
              [
                {
                  type: 'vbox',
                  padding: 0,
                  children: [
                    {
                      type: 'hbox',
                      widths: ['280px', '110px'],
                      align: 'right',
                      children: [
                        {
                          type: 'text',
                          id: 'txtUrl',
                          label: 'Path',
                          required: true,
                          onChange: function() {
                            var dialog = this.getDialog(),
                              newUrl = this.getValue();

                            //Update original image
                            if (newUrl.length > 0) //Prevent from load before onShow
                            {
                              dialog = this.getDialog();
                              var original = dialog.originalElement;

                              dialog.preview.removeStyle('display');

                              original.setCustomData('isReady', 'false');
                              // Show loader
                              var loader = CKEDITOR.document.getById(imagePreviewLoaderId);
                              if (loader)
                                loader.setStyle('display', '');

                              original.on('load', onImgLoadEvent, dialog);
                              original.on('error', onImgLoadErrorEvent, dialog);
                              original.on('abort', onImgLoadErrorEvent, dialog);
                              original.setAttribute('src', newUrl);

                              // Query the preloader to figure out the url impacted by based href.
                              previewPreloader.setAttribute('src', newUrl);
                              dialog.preview.setAttribute('src', previewPreloader.$.src);
//                              updatePreview(dialog);
                            }
                            // Dont show preview if no URL given.
                            else if (dialog.preview) {
                              dialog.preview.removeAttribute('src');
                              dialog.preview.setStyle('display', 'none');
                            }
                          },
                          setup: function(type, element) {
                            if (type == IMAGE) {
                              var url = element.data('cke-saved-link') || element.getAttribute('link');
                              var field = this;

                              this.getDialog().dontResetSize = true;

                              field.setValue(url);
                              field.setInitValue();
                            }
                          },
                          commit: function(type, element) {
                            if (type == IMAGE && (this.getValue() || this.isChanged())) {
                              element.data('cke-saved-link', this.getValue());
                              element.setAttribute('link', this.getValue());
                            } else if (type == CLEANUP) {
                              element.setAttribute('link', '');
                              element.removeAttribute('link');
                            }
                          },
                          validate: function() {
                            var dialog = this.getDialog();
                            if (dialog._.currentTabId == 'image_tab') {
                              CKEDITOR.dialog.validate.notEmpty("Path field cannot be empty");
                            }
                          }
                        },
                        {
                          type: 'button',
                          id: 'browse',
                          style: 'display:inline-block;margin-top:10px;',
                          align: 'center',
                          label: editor.lang.common.browseServer,
                          hidden: true,
                          filebrowser: {
                            action: 'Browse',
                            params: {allowed_extensions: ['png', 'jpg', 'gif']},
                            target: 'image_tab:txtUrl',
                          }
                        }
                      ]
                    }
                  ]
                },
                {
                  type: 'vbox',
                  padding: 0,
                  children: [
                    {
                      type: 'hbox',
                      widths: ['280px', '110px'],
                      align: 'right',
                      children: [
                        {
                          type: 'text',
                          id: 'txtName',
                          label: 'File name',
                          required: true,
                          validate: function() {
                            var dialog = this.getDialog();
                            if (dialog._.currentTabId == 'image_tab') {
                              CKEDITOR.dialog.validate.notEmpty("File name field cannot be empty");
                            }
                          },
                          setup: function(type, element)
                          {
                            if (type == IMAGE) {
                              this.setValue(element.getText());
                            }
                          },
                          commit: function(type, element)
                          {
                            if (type == IMAGE) {
                              element.setText(this.getValue());
                            }
                          }
                        },
                        {
                          type: 'text',
                          id: 'txtId',
                          label: 'File id',
                          required: true,
                          validate: function() {
                            var dialog = this.getDialog();
                            if (dialog._.currentTabId == 'image_tab') {
                              CKEDITOR.dialog.validate.notEmpty("File Id field cannot be empty");
                            }
                          },
                          setup: function(type, element)
                          {
                            if (type == IMAGE) {
                              var href = element.data('cke-saved-id');
                              if (!href)
                                href = element.getAttribute('id');
                              this.setValue(href);
                            }
                          },
                          commit: function(type, element)
                          {
                            if (type == IMAGE) {
                              if (this.getValue() || this.isChanged()) {
                                element.data('cke-saved-id', this.getValue());
                                element.setAttribute('id', this.getValue());
                              }
                            }
                          }
                        },
                      ]
                    }
                  ]
                },
                {
                  type: 'vbox',
                  height: '250px',
                  children: [
                    {
                      type: 'html',
                      id: 'htmlPreview',
                      style: 'width:380px;',
                      html: '<div class="plugin-url">' + CKEDITOR.tools.htmlEncode(editor.lang.common.preview) + '<br>' +
                        '<div id="' + imagePreviewLoaderId + '" class="ImagePreviewLoader" style="display:none"><div class="loading">&nbsp;</div></div>' +
                        '<div class="ImagePreviewBox" style="width:98%;"><a href="javascript:void(0)" target="_blank" onclick="return false;" id="' + previewLinkId + '">' +
                        '<img id="' + previewImageId + '" alt="" style="width:100%;" /></a></div></div>'
                    }
                  ]
                }
              ]
          },
          {
            id: 'pdf_tab',
            label: 'Pdf',
            elements:
              [
                {
                  type: 'vbox',
                  padding: 0,
                  children: [
                    {
                      type: 'hbox',
                      widths: ['280px', '110px'],
                      align: 'right',
                      children: [
                        {
                          type: 'text',
                          id: 'txtUrl',
                          label: 'Path',
                          required: true,
                          onChange: function() {
                          },
                          setup: function(type, element) {
                            if (type == PDF) {
                              var url = element.data('cke-saved-link') || element.getAttribute('link');
                              var field = this;

                              this.getDialog().dontResetSize = true;

                              field.setValue(url);
                              field.setInitValue();
                            }
                          },
                          commit: function(type, element) {
                            if (type == PDF && (this.getValue() || this.isChanged())) {
                              element.data('cke-saved-link', this.getValue());
                              element.setAttribute('link', this.getValue());
                            } else if (type == CLEANUP) {
                              element.setAttribute('link', '');
                              element.removeAttribute('link');
                            }
                          },
                          validate: function() {
                            var dialog = this.getDialog();
                            if (dialog._.currentTabId == 'pdf_tab') {
                              CKEDITOR.dialog.validate.notEmpty("Path field cannot be empty");
                            }
                          },
                        },
                        {
                          type: 'button',
                          id: 'browse',
                          style: 'display:inline-block;margin-top:10px;',
                          align: 'center',
                          label: editor.lang.common.browseServer,
                          hidden: true,
                          filebrowser: {
                            action: 'Browse',
                            params: {allowed_extensions: 'pdf'},
                            target: 'pdf_tab:txtUrl',
                          }
                        }
                      ]
                    }
                  ]
                },
                {
                  type: 'vbox',
                  padding: 0,
                  children: [
                    {
                      type: 'hbox',
                      widths: ['280px', '110px'],
                      align: 'right',
                      children: [
                        {
                          type: 'text',
                          id: 'txtName',
                          label: 'File name',
                          required: true,
                          validate: function() {
                            var dialog = this.getDialog();
                            if (dialog._.currentTabId == 'pdf_tab') {
                              CKEDITOR.dialog.validate.notEmpty("File name field cannot be empty");
                            }
                          },
                          setup: function(type, element)
                          {
                            if (type == PDF) {
                              this.setValue(element.getText());
                            }
                          },
                          commit: function(type, element)
                          {
                            if (type == PDF) {
                              element.setText(this.getValue());
                            }
                          }
                        },
                        {
                          type: 'text',
                          id: 'txtId',
                          label: 'File id',
                          required: true,
                          validate: function() {
                            var dialog = this.getDialog();
                            if (dialog._.currentTabId == 'pdf_tab') {
                              CKEDITOR.dialog.validate.notEmpty("File Id field cannot be empty");
                            }
                          },
                          setup: function(type, element)
                          {
                            if (type == PDF) {
                              var href = element.data('cke-saved-id');
                              if (!href)
                                href = element.getAttribute('id');
                              this.setValue(href);
                            }
                          },
                          commit: function(type, element)
                          {
                            if (type == PDF) {
                              if (this.getValue() || this.isChanged()) {
                                element.data('cke-saved-id', this.getValue());
                                element.setAttribute('id', this.getValue());
                              }
                            }
                          }
                        },
                      ]
                    }
                  ]
                },
              ]
          }
        ],
      onShow: function()
      {
//        var sel = editor.getSelection(),
//          element = sel.getStartElement();
        var editor = this.getParentEditor(),
          sel = editor.getSelection(),
          element = sel && sel.getStartElement();

        //Hide loader.
        CKEDITOR.document.getById(imagePreviewLoaderId).setStyle('display', 'none');
        // Create the preview before setup the dialog contents.
        previewPreloader = new CKEDITOR.dom.element('img', editor.document);
        this.preview = CKEDITOR.document.getById(previewImageId);

        // Copy of the image
        this.originalElement = editor.document.createElement('img');
        this.originalElement.setAttribute('alt', '');
        this.originalElement.setCustomData('isReady', 'false');

        if (element)
          element = element.getAscendant('url', true);

        if (!element || element.getName() != 'url' || element.data('cke-realelement'))
        {
          element = editor.document.createElement('url');
          this.insertMode = true;
        }
        else
          this.insertMode = false;

        this.element = element;
        var link = element.getAttribute('link') || '',
          ext = link.substring(link.lastIndexOf('.') + 1);
        if (ext.toLowerCase() === "pdf") {
          this.selectPage('pdf_tab');
          this.setupContent(PDF, this.element);
        } else {
          this.setupContent(IMAGE, this.element);
          // Dont show preview if no URL given.
          if (!CKEDITOR.tools.trim(this.getValueOf('image_tab', 'txtUrl'))) {
            this.preview.removeAttribute('src');
            this.preview.setStyle('display', 'none');
          }
        }
      },
      onHide: function() {
        if (this.preview)
          this.commitContent(CLEANUP, this.preview);

        if (this.originalElement) {
          this.originalElement.removeListener('load', onImgLoadEvent);
          this.originalElement.removeListener('error', onImgLoadErrorEvent);
          this.originalElement.removeListener('abort', onImgLoadErrorEvent);
          this.originalElement.remove();
          this.originalElement = false; // Dialog is closed.
        }

        delete this.imageElement;
      },
      onOk: function()
      {
        var dialog = this,
          url = this.element;

        if (this.insertMode)
          editor.insertElement(url);

        if (dialog._.currentTabId == 'image_tab') {
          this.commitContent(IMAGE, url);
        } else {
          this.commitContent(PDF, url);
        }
      }
    };
  };

  CKEDITOR.dialog.add('url', function(editor) {
    return urlDialog(editor, 'image');
  });
})();