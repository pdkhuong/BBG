<?php
$this->HTML->script('flot/jquery.flot.min', array('inline' => false));
$this->HTML->script('flot/jquery.flot.crosshair', array('inline' => false));
$this->HTML->script('flot/jquery.flot.pie', array('inline' => false));
$this->HTML->script('flot/jquery.flot.resize', array('inline' => false));
$this->HTML->script('flot/jquery.flot.stack', array('inline' => false));
$this->HTML->script('flot/jquery.flot.tooltip.min', array('inline' => false));
$this->HTML->script('dashboard', array('inline' => false));
?>
<div class="page-title">
  <div class="row">
    <div class="col-md-9">
      <h1><i class="fa fa-bars"></i>
        <?php echo __('Dashboard') ?>
      </h1>
      <h4>Overview, stats, chart and more</h4>
    </div>
    <div class="col-md-3 text-right">

    </div>
  </div>
</div>

<div class="page-body">
  <div class="row">
    <div class="col-md-12">
      <div class="block block-black">
        <div class="block-title">
          <h3><i class="fa fa-bar-chart-o"></i> Latest Statistics</h3>
          <div class="block-tool">
            <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
            <!--<a data-action="close" href="#"><i class="fa fa-times-circle"></i></a>-->
          </div>
        </div>
        <div class="block-body">
          <div class="row">
            <div class="col-sm-6 col-lg-3">
              <div class="panel panel-metric panel-metric-sm">
                <div class="panel-body panel-body-danger">
                  <div class="metric-content metric-icon">
                    <div class="value">
                      2014/08
                    </div>
                    <div class="icon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <header>
                      <h3 class="thin">Upcoming Event</h3>
                    </header>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="panel panel-metric panel-metric-sm">
                <div class="panel-body panel-body-primary">
                  <div class="metric-content metric-icon">
                    <div class="value">
                      2395
                    </div>
                    <div class="icon">
                      <i class="fa fa-tablet"></i>
                    </div>
                    <header>
                      <h3 class="thin">Deployed iPads</h3>
                    </header>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="panel panel-metric panel-metric-sm">
                <div class="panel-body panel-body-success">
                  <div class="metric-content metric-icon">
                    <div class="value">
                      2.200
                    </div>
                    <div class="icon">
                      <i class="fa fa-users"></i>
                    </div>
                    <header>
                      <h3 class="thin">Total Visitors</h3>
                    </header>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="panel panel-metric panel-metric-sm">
                <div class="panel-body panel-body-inverse">
                  <div class="metric-content metric-icon">
                    <div class="value">
                      20:30
                    </div>
                    <div class="icon">
                      <i class="fa fa-map-marker"></i>
                    </div>
                    <header>
                      <h3 class="thin">Avg. Time on Site</h3>
                    </header>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-7">
      <div class="block block-black">
        <div class="block-title">
          <h3><i class="fa fa-bar-chart-o"></i> Visitors</h3>
          <div class="block-tool">
            <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
            <!--<a data-action="close" href="#"><i class="fa fa-times-circle"></i></a>-->
          </div>
        </div>
        <div class="block-body">
          <div id="visitors-chart" style="margin-top: 20px; position: relative; height: 234px; padding: 0px;"><canvas class="flot-base" width="631" height="234" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 631px; height: 234px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 220px; left: 26px; text-align: center;">8</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 220px; left: 86px; text-align: center;">9</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 220px; left: 142px; text-align: center;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 220px; left: 202px; text-align: center;">11</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 220px; left: 261px; text-align: center;">12</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 220px; left: 321px; text-align: center;">13</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 220px; left: 381px; text-align: center;">14</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 220px; left: 440px; text-align: center;">15</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 220px; left: 500px; text-align: center;">16</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 220px; left: 559px; text-align: center;">17</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 57px; top: 220px; left: 619px; text-align: center;">18</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 208px; left: 18px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 166px; left: 6px; text-align: right;">200</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 125px; left: 6px; text-align: right;">400</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 83px; left: 6px; text-align: right;">600</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 42px; left: 6px; text-align: right;">800</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 0px; text-align: right;">1000</div></div></div><canvas class="flot-overlay" width="631" height="234" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 631px; height: 234px;"></canvas><div class="legend"><div style="position: absolute; width: 114px; height: 16px; top: -18px; right: 6px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:-18px;right:6px;;font-size:smaller;color:#3f3f3f"><tbody><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(136,187,200);overflow:hidden"></div></div></td><td class="legendLabel">Visits&nbsp;&nbsp;</td><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(237,122,83);overflow:hidden"></div></div></td><td class="legendLabel">Prospect&nbsp;&nbsp;</td></tr></tbody></table></div></div>
        </div>
      </div>
    </div>

    <div class="col-md-5">
      <div class="block block-black">
        <div class="block-title">
          <h3><i class="fa fa-calendar"></i>Events</h3>
          <div class="block-tool">
            <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
            <!--<a data-action="close" href="#"><i class="fa fa-times-circle"></i></a>-->
          </div>
        </div>
        <div class="block-body">
          <ul class="todo-list">
            <?php if(!empty($eventFinish)):?>
              <li>
                <div class="todo-desc">
                  <p><a href="#"><?= $eventFinish['TradeshowEvent']['name'] ?></a></p>
                </div>
                <div class="todo-actions">
                  <span class="label label-success">Finished</span>
                </div>
              </li>
            <?php endif;?>
            <?php foreach($eventNews as $event):?>
              <li>
                <div class="todo-desc">
                  <p><a href="#"><?= $event['TradeshowEvent']['name'] ?></a></p>
                </div>
                <div class="todo-actions">
                  <span class="label label-<?php if($event['TradeshowEvent']['openingStatus']==0): ?>danger<?php else: ?>info<?php endif; ?>">
                    <?php if($event['TradeshowEvent']['openingStatus']==0): ?>In progress<?php else: ?>Upcoming<?php endif; ?>
                  </span>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
