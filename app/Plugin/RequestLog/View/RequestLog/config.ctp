<?php
$this->HTML->script('libs/jquery.tmpl.min', array('inline' => false));
$this->Html->css('docs.min', array('inline' => false));
$this->Html->css('../js/select2/select2', array('inline' => false));
$this->Html->script('select2/select2.min', array('inline' => false));
?>
<h3><?= $this->Html->link(__("Request Log Configuration"), Router::url(array('controller' => 'RequestLog', 'action' => 'index')), array('style' => 'text-decoration: none')) ?> <button class="btn btn-success btn-sm" id="btn-save-requestlog"><i class="fa fa-save"></i> <span>Save</span></button></h3>
<hr/>
<?php
echo $this->Form->create('RequestLog', array(
  'novalidate' => true,
  'url' => Router::url(array('plugin' => 'RequestLog', 'controller' => 'RequestLog', 'action' => 'config')),
  'type' => 'get',
  'class' => 'form-horizontal'
));
?>

<strong>Logged Data</strong>
<div class="bs-docs-grid" id="rl-data-config">
  <div class="checkbox">
    <label>
      <input type="checkbox" name="data[Config][get_data]" value="1" class="config_get_data"> Get Data
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="data[Config][post_data]" value="1" class="config_post_data"> Post Data
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="data[Config][raw_data]" value="1" class="config_raw_data"> Raw Data
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="data[Config][file_data]" value="1" class="config_file_data"> File Data
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="data[Config][server_data]" value="1" class="config_server_data"> Server Data
    </label>
  </div>
</div>
<div class="bs-docs-grid" id="rl-config-list">
  <div class="row show-grid">
    <div class="col-md-3"><strong>Plugin</strong></div>
    <div class="col-md-3"><strong>Controller</strong></div>
    <div class="col-md-3"><strong>Action</strong></div>
    <div class="col-md-3 text-right"><button type="button" class="btn btn-success btn-sm btn-add"><i class="fa fa-plus"></i> Add config</button></div>
  </div>
</div>

<?php
echo $this->Form->end();
?>

<script id="template-requestlog-config" type="text/x-jquery-tmpl">
  <div class="row show-grid" data-id="rl-${rl_id}">
  <div class="col-md-3">
  <input type="hidden" name="data[Plugin][${rl_id}]" id="s-plugins-${rl_id}" style="width:100%;" tabindex="-1" class="select2-offscreen">
  </div>
  <div class="col-md-3">
  <input type="hidden" name="data[Controller][${rl_id}]" id="s-controllers-${rl_id}" style="width:100%;" tabindex="-1" class="select2-offscreen">
  </div>
  <div class="col-md-5">
  <input type="hidden" name="data[Actions][${rl_id}]" id="s-actions-${rl_id}" style="width:100%;" tabindex="-1" class="select2-offscreen">
  </div>
  <div class="col-md-1 text-center buttons"><button type="button" class="btn btn-danger btn-xs btn-del"><i class="fa fa-trash-o"></i></button></div>
  </div>
</script>

<script type="text/javascript">
  $(function() {
    $("#rl-config-list").on("click", ".btn-add", function(e) {
      e.preventDefault();
      add_config({});
    });

    $("#rl-config-list").on("click", ".btn-del", function(e) {
      e.preventDefault();
      remove_config($(this));

    });

    $("#btn-save-requestlog").on("click", function(e) {
      var t = $(this);
      e.preventDefault();
      $.ajax({
        url: '<?php echo Router::url(array('controller' => 'RequestLog', 'action' => 'config')); ?>',
        type: "POST",
        //dataType: "html",
        data: $("#RequestLogConfigForm").serialize(),
        error: function(data) {
          console.log(data);
        },
        beforeSend: function() {
          t.find('span').text('Saving...');
          t.prop("disabled", true);
        },
        complete: function() {
          t.prop("disabled", false);
          t.find('span').text('Save');
        },
        success: function(output) {
          var data = $.parseJSON(output);
          alert(data.messages);
        }
      });
    });

    function add_config(values) {
      var data = {},
        html = '',
        rl_id = unique();


      data.rl_id = rl_id;
      html = $("#template-requestlog-config").tmpl(data);

      $("#rl-config-list").append(html);

      $("#s-plugins-" + rl_id).select2({
        placeholder: "Select a plugin",
        allowClear: true,
        query: function(query) {
          var data = {results: []};

          $.each(sf.controllers.plugins, function(idx, item) {
            data.results.push({id: idx, text: idx});
          });

          query.callback(data);
        }
      }).on("change", function(e) {
        $("#s-controllers-" + rl_id).select2("val", "");
        $("#s-actions-" + rl_id).select2("val", "");
      });
      if (values.plugin) {
        $("#s-plugins-" + rl_id).select2("data", {id: values.plugin, text: values.plugin});
      }

      $("#s-controllers-" + rl_id).select2({
        placeholder: "Select a controller",
        allowClear: true,
        query: function(query) {
          var data = {results: []},
          selected_plugin = $("#s-plugins-" + rl_id).select2("val"),
            controllers;

          if (selected_plugin.length > 0) {
            controllers = sf.controllers.plugins[selected_plugin];
          } else {
            controllers = sf.controllers.system;
          }

          $.each(controllers, function(idx, item) {
            data.results.push({id: idx, text: idx});
          });

          query.callback(data);
        }
      }).on("change", function(e) {
        $("#s-actions-" + rl_id).select2("val", "");
      });
      if (values.controller) {
        $("#s-controllers-" + rl_id).select2("data", {id: values.controller, text: values.controller});
      }


      $("#s-actions-" + rl_id).select2({
        placeholder: "Select actions",
        allowClear: true,
        multiple: true,
        query: function(query) {
          var data = {results: []},
          selected_plugin = $("#s-plugins-" + rl_id).select2("val"),
            selected_controller = $("#s-controllers-" + rl_id).select2("val"),
            controllers = [];

          if (selected_plugin.length > 0) {
            if (selected_controller.length > 0) {
              controllers = sf.controllers.plugins[selected_plugin][selected_controller];
            }
          } else {
            if (selected_controller.length > 0) {
              controllers = sf.controllers.system[selected_controller];
            }
          }
          $.each(controllers, function(idx, item) {
            data.results.push({id: item, text: item});
          });
          query.callback(data);
        }
      });
      if (values.actions) {
        var data = [];
        $.each(values.actions, function() {
          data.push({id: this, text: this});
        });
        $("#s-actions-" + rl_id).select2("data", data);
      }
    }

    function remove_config(t) {
      var item = t.closest('div.row'),
        rl_id = 'rl-' + item.data('id');
      $("#s-plugins-" + rl_id).select2("destroy");
      $("#s-controllers-" + rl_id).select2("destroy");
      $("#s-actions-" + rl_id).select2("destroy");
      item.remove();
    }

    function init() {
      if (sf.rl_configs) {
        $.each(sf.rl_configs.system, function(controller, actions) {
          var data = {};
          data.controller = controller;
          data.actions = actions;
          add_config(data);
        });

        $.each(sf.rl_configs.plugins, function(plugin, controller) {
          var data = {};
          data.plugin = plugin;
          if ($.type(controller) == 'object') {
            $.each(controller, function(controller_name, actions) {
              data.controller = controller_name;
              data.actions = actions;
              add_config(data);
            });
          }
        });

        $.each(sf.rl_configs.config, function(idx, value) {
          if (value == 1) {
            $("#rl-data-config .config_" + idx).prop("checked", true);
          }
        });
      }
    }
    init();
  });
</script>

