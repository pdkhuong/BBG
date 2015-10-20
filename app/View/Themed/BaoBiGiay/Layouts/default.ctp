<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2013.
 * @package       View.Layouts
 * @since         SF v 1.0
 * @license
 */
?>
<?php echo $this->Html->docType('html5'); ?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $this->Html->charset(); ?>
    <title><?php echo $title_for_layout; ?></title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->fetch('meta');
    echo $this->Html->css(array(
      'font-gesta',
      'bootstrap.min',
      'font-awesome.min',
      'main',
      //'theme',
      'radio-checkbox',
      'jquery.ui',
      'sfinput',
    ));
    echo $this->fetch('css');

    echo $this->Html->script(array(
      'libs/jquery-1.11.3.min',
      'libs/jquery-ui.min',
      'libs/bootstrap.min',
      'libs/jquery.tmpl.min',
      'ckeditor/ckeditor',
      'libs/jquery.gritter.min',
      'radio-checkbox',
      'common',
      'core',
      'sfinput',
    ));
    echo $this->Layout->js();
    echo $this->fetch('script');
    ?>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body class="side-left wide">
    <div id="wrap">
        <?php echo $this->element('main/top_section'); ?>
      <?php echo $this->element('main/left_menu'); ?>
      <div id="content">
          <div class="outer">
              <div class="inner">
                  <?php echo $this->Layout->sessionFlash(); ?>
                  <?php echo $this->element('main/breadcrumbs'); ?>
                  <?php echo $this->fetch('content'); ?>
              </div>
          </div>
      </div>
    </div>
    <?php echo $this->Positions->blocks('footer'); ?>

    <?php if (Configure::read('debug') > 1): ?>
      <div class="container">
        <div class="well well-sm">
          <p>SQL Debug:</p>
          <small>
            <?php echo $this->element('sql_dump'); ?>
          </small>
        </div>
      </div>
    <?php endif; ?>

  </body>
</html>
