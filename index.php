<?php

require 'vendor/autoload.php';

$mandrill = new Mandrill('n4K2QMp31EgJx0umLxX4Ig');

if (!empty($_POST['mandrill_events'])) {	
	$payload = json_decode($_POST['mandrill_events'], true);

	if (!is_array($payload)) {
		exit;
	}

	foreach ($payload as $message) {
		if (isset($payload['msg']['raw_msg'])) {
			$raw_message = $payload['msg']['raw_msg'];

			$params = array(
				'raw_message' => $message['raw_msg'],
			);

			$mandrill->call('messages/send-raw.json', $params);
		}	
	}
	
}