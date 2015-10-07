<?php

//App::import('Component', 'Blocks.Blocks');
App::import('Helper', 'Blocks.Positions');
//App::import('Helper', 'Blocks.Elements');
//positions
$positions = array(
  'header' => 'Header',
  //'left' => 'Left',
  //'right' => 'Right',
  'footer' => 'Footer'
);

//default blocks
$default_blocks = array(
  'header' => array(
    array(
      'title' => '',
      'body' => '',
      'show_title' => true,
      'css_class' => '',
      'element' => 'main/top_menu'
    )
  ),
  'left' => array(
    array(
      'title' => '',
      'body' => '',
      'show_title' => true,
      'css_class' => '',
      'element' => 'main/sidebar'
    )
  ),
  'right' => array(
    array(
      'title' => 'Hot line',
      'body' => '<p><strong>0123456789</strong></p>',
      'show_title' => true,
      'css_class' => 'block-black',
      'element' => ''
    )
  ),
  'footer' => array(
    array(
      'title' => '',
      'body' => '',
      'show_title' => true,
      'css_class' => '',
      'element' => 'main/footer'
    )
  )
);

//config blocks by controller
$blocks = array(
  'Object' => array(
    'left' => array(
      array(
        'title' => 'Tool',
        'body' => '<ul class="todo-list"><li>Tool 1</li><li>Tool 2</li><li>Tool 3</li></ul>',
        'css_class' => '',
        'show_title' => true,
        'element' => ''
      ),
      array(
        'title' => 'Dynamic block',
        'body' => '{block:dynamic_block plugin=blocks controller=blocks action=view element=Blocks.list}',
        'css_class' => '',
        'show_title' => true,
        'element' => ''
      )
    )
        ));

Configure::write('SF.Blocks.Positions', $positions);
Configure::write('SF.Blocks.DefaultBlocks', $default_blocks);
Configure::write('SF.Blocks.Blocks', $blocks);
//the width of a block is from 1 to 12
Configure::write('SF.Blocks.Width', 3);
