(function($) {
  var DEFAULT_CLASSES = {
    dropdown: "sf-input-dropdown open",
    dropdownItem: "sf-input-dropdown-item",
    dropdownItem2: "sf-input-dropdown-item2",
    selectedDropdownItem: "sf-input-selected-dropdown-item"
  };

  var KEY = {
    BACKSPACE: 8,
    TAB: 9,
    ENTER: 13,
    ESCAPE: 27,
    SPACE: 32,
    NUMPAD_ENTER: 108
  };

  var DEFAULT_SETTINGS = {
    searchDelay: 10,
    minChars: 1,
    propertyToSearch: "name",
    jsonContainer: null,
    qparams: '',
    animateDropdown: true,
    isAdd: false,
    sfinputLimit: null,
    sfinputDelimiter: ",",
    preventDuplicates: false,
    sfinputValue: "id",
    prePopulate: null,
    processPrePopulate: false,
    messages: {
      hint_text: "Input keyword for searching",
      no_results_text: "No data",
      searching_text: "Searching..."
    },
    resultsFormatter: function(item) {
      return "<li>" + item[this.propertyToSearch] + "</li>"
    },
    onResult: null,
    onAdd: null,
    onDelete: null,
    onReady: null
  };

  var methods = {
    init: function(url_or_data_or_function, options) {
      var settings = $.extend({}, DEFAULT_SETTINGS, options || {});

      return this.each(function() {
        $(this).data("sfInputObject", new $.ItemList(this, url_or_data_or_function, settings));
      });
    },
    clear: function() {
      this.data("sfInputObject").clear();
      return this;
    },
    add: function(item) {
      this.data("sfInputObject").add(item);
      return this;
    },
    remove: function(item) {
      this.data("sfInputObject").remove(item);
      return this;
    },
    get: function() {
      return this.data("sfInputObject").getTokens();
    }
  };

  $.fn.sfInput = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else {
      return methods.init.apply(this, arguments);
    }
  };

  $.ItemList = function(input, url_or_data, settings) {
    if ($.type(url_or_data) === "string" || $.type(url_or_data) === "function") {
      settings.url = url_or_data;
    } else if (typeof (url_or_data) === "object") {
      settings.local_data = url_or_data;
    }

    if (settings.classes) {
      settings.classes = $.extend({}, DEFAULT_CLASSES, settings.classes);
    } else if (settings.theme) {
      settings.classes = {};
      $.each(DEFAULT_CLASSES, function(key, value) {
        settings.classes[key] = value + "-" + settings.theme;
      });
    } else {
      settings.classes = DEFAULT_CLASSES;
    }

    var cache = new $.ItemList.Cache();
    var saved_items = [];
    var item_count = 0;
    var timeout;

    var input_box = $(input)
      .focus(function() {
        if (settings.sfinputLimit === null || settings.sfinputLimit !== item_count) {
          show_dropdown_hint();
        }
      })
      .blur(function() {
        hide_dropdown();
        $(this).val("");
      })
      .keydown(function(event) {
        switch (event.keyCode) {
          case KEY.BACKSPACE:
            if ($(this).val().length === 1) {
              hide_dropdown();
            } else {
              setTimeout(function() {
                do_search();
              }, 5);
            }
            break;
          case KEY.TAB:
          case KEY.ENTER:
          case KEY.NUMPAD_ENTER:
          case KEY.COMMA:
            if (selected_dropdown_item) {
              add_item($(selected_dropdown_item).data("sfinput"));
            } else {
              event.stopPropagation();
              event.preventDefault();
            }
            return false;
            break;
          case KEY.ESCAPE:
            hide_dropdown();
            return true;
          default:
            if (String.fromCharCode(event.which)) {
              setTimeout(function() {
                do_search();
              }, 5);
            }
            break;
        }
      });
    var selected_dropdown_item = null;
    var dropdown = $("<div>")
      .addClass(settings.classes.dropdown)
      .appendTo("body")
      .hide();
    if ($.isFunction(settings.onReady)) {
      settings.onReady.call();
    }

    this.clear = function() {

    };
    this.add = function(item) {
      add_item(item);
    };
    this.remove = function(item) {

    };
    this.getTokens = function() {
      return saved_items;
    };
    function add_item(item) {
      var callback = settings.onAdd;

      input_box.val("");
      hide_dropdown();
      if ($.isFunction(callback)) {
        callback.call(input_box, item);
      }
    }

    function delete_item(sfinput) {
      var callback = settings.onDelete;
      input_box.focus();
      if ($.isFunction(callback)) {
        callback.call(input_box, sfinput);
      }
    }

    function hide_dropdown() {
      dropdown.hide().empty();
      selected_dropdown_item = null;
    }

    function show_dropdown() {
      dropdown
        .css({
          position: "absolute",
          top: $(input_box).offset().top + $(input_box).outerHeight(),
          left: $(input_box).offset().left,
          zindex: 999
        })
        .show();
    }

    function show_dropdown_searching() {
      if (settings.messages.searching_text) {
        dropdown.html("<p>" + settings.messages.searching_text + "</p>");
        show_dropdown();
      }
    }

    function show_dropdown_hint() {
      if (settings.messages.hint_text) {
        dropdown.html("<p>" + settings.messages.hint_text + "</p>");
        show_dropdown();
      }
    }

    function highlight_term(value, term) {
      return value.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + term + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<b>$1</b>");
    }

    function find_value_and_highlight_term(template, value, term) {
      return template.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + value + ")(?![^<>]*>)(?![^&;]+;)", "g"), highlight_term(value, term));
    }

    function progress_dropdown(query, results) {
      if (results && results.length) {
        dropdown.empty();
        var dropdown_ul = $("<ul class=\"dropdown-questions\">")
          .appendTo(dropdown)
          .mouseover(function(event) {
            select_dropdown_item($(event.target).closest("li"));
          })
          .mousedown(function(event) {
            add_item($(event.target).closest("li").data("sfinput"));
            return false;
          })
          .hide();
        $.each(results, function(index, value) {
          var this_li = settings.resultsFormatter(value);
          this_li = find_value_and_highlight_term(this_li, value[settings.propertyToSearch], query);
          this_li = $(this_li).appendTo(dropdown_ul);
          if (index % 2) {
            this_li.addClass(settings.classes.dropdownItem);
          } else {
            this_li.addClass(settings.classes.dropdownItem2);
          }

          if (index === 0) {
            select_dropdown_item(this_li);
          }

          $.data(this_li.get(0), "sfinput", value);
        });
        show_dropdown();
        if (settings.animateDropdown) {
          dropdown_ul.slideDown("fast");
        } else {
          dropdown_ul.show();
        }
      } else {
        if (settings.messages.no_results_text) {
          dropdown.html("<p>" + settings.messages.no_results_text + "</p>");
          show_dropdown();
        }
      }
    }

    function select_dropdown_item(item) {
      if (item) {
        if (selected_dropdown_item) {
          deselect_dropdown_item($(selected_dropdown_item));
        }

        item.addClass(settings.classes.selectedDropdownItem);
        selected_dropdown_item = item.get(0);
      }
    }

    function deselect_dropdown_item(item) {
      item.removeClass(settings.classes.selectedDropdownItem);
      selected_dropdown_item = null;
    }

    function do_search() {
      var query = input_box.val().toLowerCase();
      if (query && query.length) {
        if (query.length >= settings.minChars) {
          show_dropdown_searching();
          clearTimeout(timeout);
          timeout = setTimeout(function() {
            run_search(query);
          }, settings.searchDelay);
        } else {
          hide_dropdown();
        }
      }
    }

    function run_search(query) {
      var cache_key = query + getUrl();
      var cached_results = cache.get(cache_key)
      cached_results = false;
      if (cached_results) {
        progress_dropdown(query, cached_results);
      } else {
        if (settings.url) {
          var url = getUrl();
          var ajax_params = {};
          ajax_params.data = {};
          if (url.indexOf("?") > -1) {
            var parts = url.split("?");
            ajax_params.url = parts[0];
            var param_array = parts[1].split("&");
            $.each(param_array, function(index, value) {
              var kv = value.split("=");
              ajax_params.data[kv[0]] = kv[1];
            });
          } else {
            ajax_params.url = url;
          }

          ajax_params.data['q'] = query;
          ajax_params.data['ids'] = input_box.data("ids");
          ajax_params.data['mid'] = $("#ItrainerTrainingMarketId").val();
          ajax_params.type = "GET";
          ajax_params.dataType = "json";
          ajax_params.success = function(results) {
            if ($.isFunction(settings.onResult)) {
              results = settings.onResult.call(input_box, results);
            }
            cache.add(cache_key, settings.jsonContainer ? results[settings.jsonContainer] : results);
            if (input_box.val().toLowerCase() === query) {
              progress_dropdown(query, settings.jsonContainer ? results[settings.jsonContainer] : results);
            }
          };
          $.ajax(ajax_params);
        } else if (settings.local_data) {
          var results = $.grep(settings.local_data, function(row) {
            return row[settings.propertyToSearch].toLowerCase().indexOf(query.toLowerCase()) > -1;
          });
          if ($.isFunction(settings.onResult)) {
            results = settings.onResult.call(input_box, results);
          }
          cache.add(cache_key, results);
          progress_dropdown(query, results);
        }
      }
    }

    function getUrl() {
      var url = settings.url;
      if (typeof settings.url === 'function') {
        url = settings.url.call();
      }
      return url;
    }
  };

  $.ItemList.Cache = function(options) {
    var settings = $.extend({
      max_size: 500
    }, options);
    var data = {};
    var size = 0;
    var flush = function() {
      data = {};
      size = 0;
    };
    this.add = function(query, results) {
      if (size > settings.max_size) {
        flush();
      }

      if (!data[query]) {
        size += 1;
      }

      data[query] = results;
    };
    this.get = function(query) {
      return data[query];
    };
  };
}(jQuery));
