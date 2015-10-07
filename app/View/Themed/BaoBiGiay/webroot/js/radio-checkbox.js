(function($) {

  $.sf_radio_checkbox = function(element, options) {
    var defaults = {
      label: '',
      labelPosition: 'right',
      customClass: '',
      color: '',
      size: '24',
      onFoo: function() {
      }
    }

    var t = this;

    t.options = {}

    var el = $(element),
      e = element;

    t.init = function() {
      t.options = $.extend({}, defaults, options);
      el.parent().addClass('has-cool-child');
      el.css('display', 'none');

      var classType = el.data('type') !== undefined ? el.data('type') : el.attr('type');
      var label = el.data('label') !== undefined ? el.data('label').toString() : t.options.label.toString();
      var labelPosition = el.data('labelposition') !== undefined ? 'label' + el.data('labelposition') : 'label' + t.options.labelPosition;
      var customClass = el.data('customclass') !== undefined ? el.data('customclass') : t.options.customClass;
      var color = el.data('color') !== undefined ? el.data('color') : t.options.color;
      var disabled = el.prop('disabled') === true ? 'disabled' : '';
      var size = el.data('size') !== undefined ? el.data('size') : t.options.size;
      var containerClasses = ['cool' + classType + '-' + size, labelPosition, customClass, color].join(' ');
      el.wrap('<div class="clearfix ' + containerClasses + '"></div>').parent().html();

      var dom = [];
      var isChecked = el.prop('checked') ? 'checked' : '';

      if (labelPosition === 'labelright') {
        dom.push('<a href="#" class="' + isChecked + ' ' + disabled + '"></a>');
        if (label.length > 0) {
          dom.push('<label for="' + el.attr('id') + '">' + label + '</label>');
        }
      } else {
        if (label.length > 0) {
          dom.push('<label for="' + el.attr('id') + '">' + label + '</label>');
        }
        dom.push('<a href="#" class="' + isChecked + ' ' + disabled + '"></a>');
      }

      el.parent().append(dom.join('\n'));
      addCheckableEvents(el.parent());
    }

    t.check = function() {
      el.prop('checked', true).attr('checked', true).parent().find('a:first').addClass('checked');
    }

    t.uncheck = function() {
      el.prop('checked', false).attr('checked', false).parent().find('a:first').removeClass('checked');
    }

    t.enable = function() {
      el.removeAttr('disabled').parent().find('a:first').removeClass('disabled');
    }

    t.disable = function() {
      el.attr('disabled', 'disabled').parent().find('a:first').addClass('disabled');
    }

    t.destroy = function() {
      var clonedEl = el.clone();
      clonedEl.removeAttr('style').insertBefore(el.parent());
      el.parent().remove();
    }

    var addCheckableEvents = function(element) {
      if (window.ko) {
        $(element).on('change', function(e) {
          e.preventDefault();
          if (e.originalEvent === undefined) {
            var clickedParent = $(this).closest('.clearfix'),
              fakeCheckable = $(clickedParent).find('a:first'),
              isChecked = fakeCheckable.hasClass('checked');
            if (isChecked === true) {
              fakeCheckable.addClass('checked');
            } else {
              fakeCheckable.removeClass('checked');
            }
          }
        });
      }
      element.find('a:first, label').on('touchstart click', function(e) {
        e.preventDefault();
        var clickedParent = $(this).closest('.clearfix'),
          input = clickedParent.find('input'),
          fakeCheckable = clickedParent.find('a:first');
        if (fakeCheckable.hasClass('disabled') === true) {
          return;
        }
        if (input.prop('type') === 'radio') {
          $('input[name="' + input.attr('name') + '"]').each(function(index, el) {
            $(el).prop('checked', false).parent().find('a:first').removeClass('checked');
          });
        }

        if (window.ko) {
          ko.utils.triggerEvent(input[0], 'click');
        } else {
          if (input.prop('checked')) {
            input.prop('checked', false).change();
          } else {
            input.prop('checked', true).change();
          }
        }
        fakeCheckable.toggleClass('checked');
      });

      element.find('a:first').on('keyup', function(e) {
        if (e.keyCode === 32) {
          $(this).click();
        }
      });
    }

    t.init();
  }

  $.fn.sf_radio_checkbox = function(options) {
    return this.each(function() {
      if (undefined == $(this).data('sf_radio_checkbox')) {
        var plugin = new $.sf_radio_checkbox(this, options);
        $(this).data('sf_radio_checkbox', plugin);
      }
    });
  }
})(jQuery);