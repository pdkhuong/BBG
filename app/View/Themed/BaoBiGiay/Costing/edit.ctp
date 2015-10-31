<h3>
  <? if (isset($this->data['Costing']['id']) && $this->data['Costing']['id'] > 0): ?>
    <?= __('Edit Costing') ?>: <?= $this->data['Costing']['id'] ?>
  <? else: ?>
    <?= __('Add Costing') ?>
  <? endif; ?>
</h3>

<hr />
<div class="well form-horizontal page-body posts form">
<?php
  echo $this->Form->create('Costing', array(
    'novalidate' => true,
    'inputDefaults' => array(
      //'div' => 'form-group',
      'label' => array(
        'class' => 'col col-md-3 control-label text-left'
      ),
      'wrapInput' => 'col col-md-3',
      'class' => 'form-control'
    ),
  ));
  ?>
  <div class="form-group">
    <?php echo $this->Form->input('quantity', array('label' => array('text' => __('Quantity')))) ?>
    <?php echo $this->Form->input('exchange', array('label' => array('text' => __('Exchange (VND)')))) ?>
  </div>
  <div class="form-group">
    <?php
    echo $this->Form->input('customer_id',
      array('options' => $listCustomer,
        'selected'=>NULL,
        'label' => array('text' => __('Customer')),
        'empty' => __("Please select customer..."),
      )
    );
    ?>
    <?php
    echo $this->Form->input('product_id',
      array('options' => $listProduct,
        'selected'=>NULL,
        'empty' => __("Please select product..."),
      )
    );
    ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('spec_length', array('label' => array('text' => __('Specification Length (cm)')))) ?>
    <?php echo $this->Form->input('spec_width', array('label' => array('text' => __('Specification Width (cm)')))) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('paper_length', array('label' => array('text' => __('Paper Length (cm)')))) ?>
    <?php echo $this->Form->input('paper_width', array('label' => array('text' => __('Paper Width (cm)')))) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('paper_substance', array('label' => array('text' => __('Paper Substance (gsm)')))) ?>
    <?php echo $this->Form->input('paper_cutting', array('label' => array('text' => __('Paper Cutting (outs)')))) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('paper_price_ton', array('label' => array('text' => __('Paper Price (/Ton)')))) ?>
    <?php echo $this->Form->input('paper_price_ram', array('label' => array('text' => __('Paper Price (/Ram)')))) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('printing_color', array('label' => array('text' => __('Printing Color (Colors)')))) ?>
    <?php echo $this->Form->input('printing_coverage', array('label' => array('text' => __('Printing Coverage (%)')))) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('printing_cost', array('label' => array('text' => __('Printing Cost (pass)')))) ?>
    <?php echo $this->Form->input('printing_films', array('label' => array('text' => __('Printing Films (set)')))) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('vanish_oil', array('label' => array('text' => __('Vanish Oil (pass)')))) ?>
    <?php echo $this->Form->input('vanish_uv', array('label' => array('text' => __('Vanish UV (pass)')))) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('vanish_opp', array('label' => array('text' => __('Vanish OPP (pass)')))) ?>
    <?php echo $this->Form->input('ply', array('label' => array('text' => __('PLY (pass)')))) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('limination', array('label' => array('text' => __('Limination (pass)')))) ?>
    <?php echo $this->Form->input('die_cut', array('label' => array('text' => __('Die-Cut (pass)')))) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('gluing_1', array('label' => array('text' => __('Gluing %s (pass)', $settings['gluing_1'])))) ?>
    <?php echo $this->Form->input('gluing_2', array('label' => array('text' => __('Gluing %s (pass)', $settings['gluing_2'])))) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('gluing_3', array('label' => array('text' => __('Gluing %s (pass)', $settings['gluing_3'])))) ?>
    <?php echo $this->Form->input('packaging', array('label' => array('text' => __('Packaging (%)')))) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('transportation', array('label' => array('text' => __('Transportation (%)')))) ?>
    <?php echo $this->Form->input('mk', array('label' => array('text' => __('MK (%)')))) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('inner_surf_substance', array('label' => array('text' => __('Inner Surf Substance')))) ?>
    <?php echo $this->Form->input('inner_surf_price', array('label' => array('text' => __('Inner Surf Price')))) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('b_flute_substance', array('label' => array('text' => __('B - Flute Substance')))) ?>
    <?php echo $this->Form->input('b_flute_price', array('label' => array('text' => __('B - Flute Price')))) ?>
  </div>
  <div class="form-group">
    <?php echo $this->Form->input('e_flute_substance', array('label' => array('text' => __('E - Flute Substance')))) ?>
    <?php echo $this->Form->input('e_flute_price', array('label' => array('text' => __('E - Flute Price')))) ?>
  </div>
  <div class="form-group">
  <?php
  if($listUser){
    echo $this->Form->input('user_id',
        array(
            'options' => $listUser,
            'empty' => __("Select person in charged ..."),
            'label' => array('text' => __('Person In Charged'))
        )
    );
  }
  ?>
  </div>
  <div class="form-group ">
    <div class="col col-md-3 text-left">
      <?php
      echo $this->Form->button('<i class="fa fa-save"></i> ' . __('Save'), array('class' => 'btn btn-primary', 'type' => 'submit', 'escape' => false));
      echo ' ';
      echo $this->Html->link(__('Cancel'), Router::url(array("action" => "index")), array('class' => 'btn btn-default'));
      ?>
    </div>
  </div>
  <?php
  echo $this->Form->input('id', array('type' => 'hidden'));
  //echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary'));
  echo $this->Form->end();
  ?>
</div>
<?php
echo $this->Html->css('bootstrap-datetimepicker.css');
echo $this->Html->script('libs/moment.js');
echo $this->Html->script('libs/bootstrap-datetimepicker.js');
echo $this->Html->script('costing.js');
?>