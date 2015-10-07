<?php
$viewTypeClass = "choose-file-container-filename-view"; 
?>
<h1>Choose File</h1>
<div class="tab-pane well" id="div-use-existed-file">
  <div>
    <?php echo $this->Form->input('filter_name', array(
      'label' => 'Filter by name',
      'value' => $params['filterName'],
      'class' => 'form-control',
      'onInput' => 'FilePlugin.filter("'.$params['categoryCode'].'", "'.$params['id'].'")',
      'div' => 'form-group',
      'between' => '<i class="fa fa-spinner fa-spin filter-textbox" id="file-choose-file-filter-name"></i>'
    )); ?>
  </div>
  <div class="choose-file-container <?= $viewTypeClass ?>" id="choose-file-container-<?= $params['id'] ?>"> 
       <?php
      foreach ($files as $file_record){
        $file = $file_record['File'];
        echo $this->element('File.'.$itemInListTemplate, array(
          'file' => $file,
          'params'=>$params
        ));
      }
      ?>
  </div>
  <div style="clear: both; margin-top: 10px;">
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