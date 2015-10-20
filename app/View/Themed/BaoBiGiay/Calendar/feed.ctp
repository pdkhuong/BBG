<?php
	$json = array();
	if(count($dataList)){
		foreach($dataList as $event){
			$item['id'] = $event["Calendar"]["id"];
			$item['title'] = $event["Calendar"]["name"];
			$item['start'] = $event["Calendar"]["from_date"];
			$item['end'] = $event["Calendar"]["to_date"];
			$item['url'] = Router::url(array('action' => 'edit', $event['Calendar']['id']));
			$json[] = $item;
		}
	}
	$jsonText = json_encode($json);
	echo $jsonText;
?>
