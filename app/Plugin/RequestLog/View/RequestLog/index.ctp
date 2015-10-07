<?php
/**
 * @var $this view
 */
?>
<h3><?= $this->Html->link(__("Request Log"), Router::url(array('plugin' => 'RequestLog', 'controller' => 'RequestLog')), array('style' => 'text-decoration: none')) ?> <a href="<?php echo Router::url(array('controller' => 'RequestLog', 'action' => 'config')); ?>" class="text-success"><i class="fa fa-cog fa"></i></a></h3>
<hr/>
<?php
echo $this->Form->create('RequestLogModel', array(
  'novalidate' => true,
  'url' => Router::url(array('plugin' => 'RequestLog', 'controller' => 'RequestLog', 'action' => 'index')),
  'type' => 'get',
  'class' => 'form-horizontal'
));
?>
<?php
echo $this->Form->input('uri', array(
  'div' => 'col-md-3',
  'class' => 'form-control',
  'label' => array('text' => __("Uri")),
  'type' => 'text',
  'placeholder' => 'Type an Uri',
));
?>
<?php
echo $this->Form->input('user_id', array(
  'div' => 'col-md-1',
  'class' => 'form-control',
  'label' => array('text' => __("User ID")),
  'type' => 'number',
  'placeholder' => 'Number'
));
?>
<?php
echo $this->Form->input('controller', array(
  'div' => 'col-md-2',
  'class' => 'form-control',
  'label' => array('text' => __("Controller")),
  'type' => 'text',
  'placeholder' => 'Name of Controller'
));
?>
<?php
echo $this->Form->input('action', array(
  'div' => 'col-md-2',
  'class' => 'form-control',
  'label' => array('text' => __("Action")),
  'type' => 'text',
  'placeholder' => 'Name of Action'
));
?>
<?php
echo $this->Form->input('plugin', array(
  'empty' => 'Default',
  'div' => 'col-md-2',
  'class' => 'form-control',
));
?>
<?php
$options = array(
  'div' => 'col-sm-1',
  'label' => 'Search',
  'class' => 'btn btn-primary pull-right',
  'style' => 'margin-top: 1.9em; margin-bottom: 1em'
);
echo $this->Form->end($options);
?>

<div class="table-responsive">
  <table class="table table-bordered table-striped requestlog-dt">
    <thead>
      <tr>
        <td colspan="7" class="text-right">
          <?= $this->Html->link(__('Keep 10,000 rows'), Router::url(array('plugin' => 'RequestLog', 'controller' => 'RequestLog', 'action' => 'keep', 10000)), array('class' => 'btn btn-default btn-xs btn-edit')) ?>
          <?= $this->Html->link(__('Keep 100,000 rows'), Router::url(array('plugin' => 'RequestLog', 'controller' => 'RequestLog', 'action' => 'keep', 100000)), array('class' => 'btn btn-default btn-xs btn-edit')) ?>
        </td>
      </tr>
      <tr>
        <th>#                      </th>
        <th><?= __("URI") ?>         </th>
        <th><?= __("Created Time") ?></th>
        <th><?= __("User ID") ?>     </th>
        <th><?= __("Plugin") ?>      </th>
        <th><?= __("Controller") ?>  </th>
        <th><?= __("Action") ?>      </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($dataList as $data): ?>
        <tr>
          <td><?php echo $data['RequestLogModel']['id'] ?>            </td>
          <td><?php echo $this->Html->link($this->Text->truncate($data['RequestLogModel']['uri'], 70), Router::url(array('plugin' => 'RequestLog', 'controller' => 'RequestLog', 'action' => 'detail', $data['RequestLogModel']['id'], true)), array('target' => '_blank', 'title' => $data['RequestLogModel']['uri'], 'data-id' => $data['RequestLogModel']['id'])) ?></td>
          <td><?php echo $data['RequestLogModel']['created_time'] ?>  </td>
          <td><?php echo $data['RequestLogModel']['user_id'] ?>       </td>
          <td><?php echo $data['RequestLogModel']['plugin'] ?>        </td>
          <td><?php echo $data['RequestLogModel']['controller'] ?>    </td>
          <td><?php echo $data['RequestLogModel']['action'] ?>        </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    <?php if ($this->Paginator->param('pageCount') > 1) : ?>
      <tfoot>
        <tr>
          <td colspan="7">
            <?php echo $this->Paginator->pagination(array('ul' => 'pagination', 'url' => array('plugin' => 'RequestLog', 'controller' => 'RequestLog'))); ?>
          </td>
        </tr>
      </tfoot>
    <?php endif; ?>
  </table>
</div>

<div class="modal fade" id="requestlog-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>
<script type="text/javascript">
  $(function() {
    var _requestlog_modal = $("#requestlog-modal");

    _requestlog_modal.on('show.bs.modal', function(e) {
//
    });

    _requestlog_modal.on('shown.bs.modal', function(e) {

    });

    _requestlog_modal.on('hidden.bs.modal', function(e) {

    });

    $(".requestlog-dt").on("click", "tbody a", function(e) {
      e.preventDefault();
      $.when($.ajax({
        beforeSend: function(xhr) {
          _requestlog_modal.html("Loading...");
        },
        url: '/request-log/detail/' + $(this).data('id'),
        type: "POST",
        data: {},
        async: false
      })).then(function(data) {
        _requestlog_modal.html(data);
        _requestlog_modal.modal('show');
      });
    })
  });
</script>