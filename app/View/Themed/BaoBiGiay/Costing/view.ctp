<h3>
  <?= __('Costing') ?>
</h3>
<hr>
<div class='table-responsive'>
  <table cellpadding='0' cellspacing='0' class='table table-striped'>
    <tbody>
      <?php if($data):?>
        <?php foreach($data as $irow => $row):?>
          <?php if($irow==1):?>
            <td></td>
            <td colspan="9"><?php echo $row[1]?></td>
          <?php else:?>
          <tr>
            <?php for($col = 0; $col < 10; $col ++):?>
              <td><?php if(isset($row[$col])) echo $row[$col]?></td>
            <?php endfor?>
          </tr>
          <?php endif?>
        <?php endforeach;?>
      <?php endif;?>
    </tbody>

  </table>
</div>

<?= $this->Html->link(__('Back to list'), Router::url(array('plugin' => false, 'controller' => 'Costing', 'action' => 'index')), array('class' => 'btn btn-primary')) ?> &nbsp;
