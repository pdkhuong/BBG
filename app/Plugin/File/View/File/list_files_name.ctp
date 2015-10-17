<h1>Choose File</h1>
<!--  use existed file -->
<div class="tab-pane well" id="div-use-existed-file">
  <div>
    <?php echo $this->Form->input('filter_name', array(
      'label' => 'Filter by name',
      'value' => $params['filterName'],
      'onInput' => 'FilePlugin.filter("'.$params['categoryCode'].'", "'.$params['id'].'")',
      'class' => 'form-control',
      'div' => 'form-group',
      'between' => '<i class="fa fa-spinner fa-spin filter-textbox" id="file-choose-file-filter-name"></i>'
    )); ?>
  </div>

  <div class="choose-file-container choose-file-container-filename-view">
    <table class="table table-hover table-striped">
    <thead>
      <tr>
        <th>Filename</th>
        <th>Type</th>
        <th>Size</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="choose-file-container-<?= $params['id'] ?>">
      <?php foreach ($files as $file_record):
  $file = $file_record['File'];
  $file_model = $file_record['FileModel'];
  ?>
  <tr id="file-choose-file-row-<?= $file['id'] ?>">
    <td><?php echo $this->element('File.file_item_name', 
      array('file' => $file, 'params'=>$params)); ?> 
    </td>
    <td class="file-choose-file-show-file-info"><?= $file['file_type'] ?></td>
    <td class="file-choose-file-show-file-info"><?= $this->File->formatBytes($file['size']);?></td>
    <td class="file-choose-file-show-file-info">
      <div>
      <button type="button" class="choose-files-choose-one" data-fileid="<?= $file['id'] ?>" data-categorycode="<?= $params['categoryCode'] ?>" data-id="<?php echo $params['id']?>" data-lang="<?php echo $params['lang']?>">
        <span class="glyphicon glyphicon-plus"></span>
      </button>
        </div>
    </td>
  </tr>
<?php endforeach; ?>
    </tbody>
    </table>
  </div>

  <div style="margin-top: 10px;">
    <input type="button" value="Done" class="btn btn-large btn-primary" id="btn-close-file">
  </div>
</div>
<script>
  //scroll ajax add more element
    var lastScrollTop = 0;
    $(".choose-file-container").scroll(function() {
      var scrollTop = $(this).scrollTop();
      //scroll up will not add more element
      if (scrollTop < lastScrollTop){
        lastScrollTop = scrollTop;
        return;
      }
      lastScrollTop = scrollTop;
      if (FilePlugin.globalVariable.page > FilePlugin.globalVariable.pageCount){
        return;
      }
      //scrolled to end of div
      //if(scrollTop + $(this).height() >= $(this)[0].scrollHeight - 20) {
        FilePlugin.onEventInputFilter("<?php echo $params['categoryCode']?>", "<?php echo $params['id']?>");
      //}
    });
</script>