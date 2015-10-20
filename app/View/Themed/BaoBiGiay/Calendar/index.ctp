<div class="page-title" id="page-titl">
  <div class="row">
    <div class="col-md-9">
      <h1><i class="fa fa-bars"></i>
        <?php echo __('Calendars') ?>
      </h1>
    </div>
    <div class="col-md-3 text-right">
      <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add'), Router::url(array('action' => 'edit')), array('class' => 'btn btn-inverse btn-large btn-primary', 'escape' => false, 'id' => '_addCustomer')); ?>
    </div>
  </div>
</div>

<div class="page-body">
  <div class="row">    
    <div class="col-md-12">
      <div class='table-responsive'>
        <div id='calendar'></div>
	  </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	var eventList = [
			{
				title: 'All Day Event 1234',
				start: '2015-02-01'
			},
			{
				title: 'Long Event',
				start: '2015-02-07',
				end: '2015-02-10'
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: '2015-02-09T16:00:00'
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: '2015-02-16T16:00:00'
			},
			{
				title: 'Conference',
				start: '2015-02-11',
				end: '2015-02-13'
			},
			{
				title: 'Meeting',
				start: '2015-02-12T10:30:00',
				end: '2015-02-12T12:30:00'
			},
			{
				title: 'Lunch',
				start: '2015-02-12T12:00:00'
			},
			{
				title: 'Meeting',
				start: '2015-02-12T14:30:00'
			},
			{
				title: 'Happy Hour',
				start: '2015-02-12T17:30:00'
			},
			{
				title: 'Dinner',
				start: '2015-02-12T20:00:00'
			},
			{
				title: 'Birthday Party',
				start: '2015-02-13T07:00:00'
			},
			{
				title: 'Click for Google',
				url: 'http://google.com/',
				start: '2015-02-28'
			}
		];
</script>
<?php
echo $this->Html->css('libs/fullcalendar/fullcalendar.css');
echo $this->Html->script('libs/moment.min.js');
echo $this->Html->script('libs/fullcalendar/fullcalendar.js');
echo $this->Html->script('libs/fullcalendar/lang-all.js');
echo $this->Html->script('calendar.js');
?>
