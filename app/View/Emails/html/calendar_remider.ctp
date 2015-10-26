<?php
	$content = $emailContent;
?>
Hello <?= $content["receive_name"] ?>,
<br/><br/>
<div>Please click <a href="<?= Router::url(array('controller' => 'calendar', 'action' => 'edit', $content["id"]), true)?>">HERE</a> to view your calendar event.</div>
<br/><br/>
<div>
	The Event infomation:
	<ul>
		<li>
			Event name: <?php echo $content["name"];?>
		</li>
		<li>
			Event description: <?php echo $content["description"];?>
		</li>
		<li>
			Event from: <?php echo $content["from_date"];?>
		</li>
		<li>
			Event to: <?php echo $content["to_date"];?>
		</li>
		<li>
			Event customer(s): <?php echo implode(", ", $content["customers"]);?>
		</li>
		<li>
			Event lead(s): <?php echo implode(", ", $content["leads"]);?>
		</li>
		<li>
			Event vendor(s): <?php echo implode(", ", $content["vendors"]);?>
		</li>
		<li>
			Event staff(s): <?php echo implode(", ", $content["users"]);?>
		</li>
	</ul>
</div>
<br/><br/>
Regards,
<br/>
Noreply
