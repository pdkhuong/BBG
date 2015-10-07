<?php
echo $this->Html->script('sfreport', array('inline' => false));
?>

<h3>Table Reports</h3>
<button id="reload1" class="reload">Reload All</button>
<hr>
<div class="ReportContainer reload1" data-report_type="table" data-option_url="/SrfDataSets?ds=reportoption&rpt=test"
		 data-query_url="/SrfDataSets?ds=object_type">
	<div class="report">
		<table id="test" class="table"></table>
	</div>
</div>

<div class="ReportContainer reload1" data-report_type="table" data-option_url="/SrfDataSets?ds=reportoption&rpt=object_type"
		 data-query_url="/SrfDataSets?ds=object_type">
	<div class="report">
		<table id="test2" class="table"></table>
	</div>
</div>
